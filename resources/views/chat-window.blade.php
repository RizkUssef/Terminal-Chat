@extends('components.layout.MainLayout')

@section('title', 'Chat')

@section('content')
    <div id="toast-container" class="fixed top-5 right-5 z-50 flex flex-col gap-2 pointer-events-none"></div>
    <div class="w-[80%] md:w-[40%] box-shadow h-[80vh] pb-6 bg-chat-bg">
        <x-chat-id :userId="$conversation_partner->user_key" :userName="$conversation_partner->user_name" :userStatus="$conversation_partner->isOnline()" :lastSeenAt="$conversation_partner->last_seen_at" />
        <div id="messages-list" class="p-5 flex flex-col gap-2 h-[62vh] overflow-scroll">
            {{-- this is where the messages will be inserted and rendered --}}
            @if (!$messages->isEmpty())
                @foreach ($messages as $date => $group)
                    {{-- Date separator badge --}}
                    <div class="date-separator">
                        <span class="date-badge">
                            @php
                                $day = \Carbon\Carbon::parse($date);
                            @endphp

                            @if ($day->isToday())
                                Today
                            @elseif ($day->isYesterday())
                                Yesterday
                            @else
                                {{ $day->format('l, M j') }} {{-- e.g. "Monday, Apr 21" --}}
                            @endif
                        </span>
                    </div>
                    @foreach ($group->reverse() as $message)
                        @if ($message->sender_id == auth()->id())
                            @php
                                $time = $message->created_at['time'];
                                $is_read = $message->read_at ? true : false;
                            @endphp
                            <x-sent-bubble-message :message="$message->message" :time="$time" :isRead="$is_read" />
                        @else
                            @php
                                $time = $message->created_at['time'];
                                $is_read = $message->read_at ? true : false;
                            @endphp
                            <x-recv-bubble-message :message="$message->message" :time="$time" :isRead="$is_read" />
                        @endif
                    @endforeach
                @endforeach
            @elseif ($messages->isEmpty())
                {{-- also not dissapear automatically --}}
                <p class="text-center text-gold-dim">No messages yet.</p>
            @endif
            {{-- hidden templates, Blade renders them once --}}
            <template id="tpl-sent">
                <x-sent-bubble-message message="__BODY__" time="__TIME__" :isRead="false" />
            </template>
            <template id="tpl-recv">
                <x-recv-bubble-message message="__BODY__" time="__TIME__" :isRead="false" />
            </template>
        </div>
        {{-- Hidden audio element for notifications --}}
        <audio id="notification-sound" src="{{ url('storage/sounds/notify1.mp3') }}" preload="auto"></audio>

        {{-- <form action="{{ route('send-message', ['conversation' => $conversation->conversation_key]) }}" class="" method="POST"> --}}
        <form id="message-form" class="">
            @csrf
            <div class="flex justify-between items-baseline px-5">
                <x-message-input :userName="@auth()->user()->user_name" type="text" name="message" placeholder="Message ..." />
                <x-message-send>Exec_</x-message-send>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        // error that (the recive message not appear automatically) window.Echo is undefined at the time your script runs — the echo.js loads after your inline script.
        // Fix — wrap your Echo code in a DOMContentLoaded listener in your blade view:
        document.addEventListener('DOMContentLoaded', function() {
            // Request Notification Permission
            if ("Notification" in window && Notification.permission !== "granted" && Notification.permission !==
                "denied") {
                Notification.requestPermission();
            }

            // 1. On page load — scroll to bottom immediately
            scrollToBottom();

            // ── SEND ──
            // ── SEND: intercept form submit, send via fetch ──
            document.getElementById('message-form').addEventListener('submit', async function(e) {
                e.preventDefault(); // stop page reload
                const input = document.getElementById('message');
                const body = input.value.trim();
                if (!body) return;

                // show sender's own message immediately (no waiting for server)
                const nowTime = new Date().toLocaleTimeString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                });
                appendMessage(body, true, nowTime);
                input.value = ''; // clear input

                // send to server silently
                await fetch(
                    '{{ route('send-message', ['conversation' => $conversation->conversation_key]) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            message: body
                        }),
                    });
            });
            // ── LISTEN ──
            // ── RECEIVE: listen for other user's messages via Reverb ──
            window.Echo.private('conversation.{{ $conversation->id }}')
                .listen('.message.sent', (e) => {
                    // this fires automatically when the other user sends a message
                    if (e.sender_id !== {{ auth()->id() }}) {
                        appendMessage(e.body, false, e.time);
                        triggerNotifications(e.body);
                    }
                });

            // ── APPEND ──
            // ── APPEND: build bubble HTML and add to chat window ──
            function appendMessage(body, isSent, time) {
                const tpl = document.getElementById(isSent ? 'tpl-sent' : 'tpl-recv');
                let html = tpl.innerHTML
                    .replace('__BODY__', body)
                    .replace('__TIME__', time);

                document.getElementById('messages-list').insertAdjacentHTML('beforeend', html);
                document.getElementById('messages-list').scrollTop = 99999;
            }
            // ── NOTIFICATIONS (SOUND & TOAST) ──
            function triggerNotifications(messageBody) {
                // Trigger ONLY if the user is not currently focused on the page
                if (document.hidden || !document.hasFocus()) {
                    // 1. Play Sound
                    const sound = document.getElementById('notification-sound');
                    if (sound) {
                        sound.play().catch(error => {
                            console.log(
                                'Audio autoplay prevented by browser. User must interact with the page first.',
                                error);
                        });
                    }

                    // 2. System Notification (Browser Toast)
                    if ("Notification" in window && Notification.permission === "granted") {
                        const notif = new Notification("New Message", {
                            body: messageBody
                        });
                        notif.onclick = () => {
                            window.focus();
                            notif.close();
                        };
                    }

                    // 3. In-App Toast
                    const container = document.getElementById('toast-container');
                    if (container) {
                        const toast = document.createElement('div');
                        toast.className =
                            'bg-[#1E1E1E] border border-gray-600 text-white px-4 py-3 rounded-lg shadow-2xl transition-opacity duration-300';
                        toast.innerText = messageBody;
                        container.appendChild(toast);

                        setTimeout(() => {
                            toast.classList.add('opacity-0');
                            setTimeout(() => toast.remove(), 300);
                        }, 4000);
                    }
                }
            }

            // ── SCROLL ──
            function scrollToBottom() {
                const container = document.getElementById('messages-list');
                container.scrollTop = container.scrollHeight;
            }
        });
    </script>
@endsection
