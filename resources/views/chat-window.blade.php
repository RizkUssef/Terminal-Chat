@extends('components.layout.MainLayout')

@section('title', 'Chat')

@section('content')
    <div class="w-[80%] md:w-[40%] box-shadow h-[80vh] pb-6 bg-chat-bg">
        <x-chat-id :userId="$conversation_partner->user_key" :userName="$conversation_partner->user_name" :userStatus="$conversation_partner->status" />
        <div id="messages-list" class="p-5 flex flex-col gap-2 h-[62vh] overflow-scroll">
            {{-- this is where the messages will be inserted and rendered --}}
            @foreach ($messages->reverse()  as $message)
                @if ($message->sender_id == auth()->id())
                    @php
                        $time = $message->created_at['time'];
                    @endphp
                    <x-sent-bubble-message :message="$message->message" :time="$time" :isRead="$message->status" />
                @else
                    @php
                        $time = $message->created_at['time'];
                    @endphp
                    <x-recv-bubble-message :message="$message->message" :time="$time" :isRead="$message->status" />
                @endif
            @endforeach
            {{-- hidden templates, Blade renders them once --}}
            <template id="tpl-sent">
                <x-sent-bubble-message message="__BODY__" time="__TIME__" :isRead="false" />
            </template>
            <template id="tpl-recv">
                <x-recv-bubble-message message="__BODY__" time="__TIME__" :isRead="false" />
            </template>
        </div>
        {{-- <form action="{{ route('send-message', ['conversation' => $conversation->conversation_key]) }}" class="" method="POST"> --}}
        <form id="message-form" class="">
            @csrf
            <div class="flex justify-between items-baseline px-5">
                <x-message-input userName="pop" type="text" name="message" placeholder="Message ..." />
                <x-message-send>Exec_</x-message-send>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        // 1. On page load — scroll to bottom immediately
        document.addEventListener('DOMContentLoaded', function() {
            scrollToBottom();
        });
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
            await fetch('{{ route('send-message', ['conversation' => $conversation->conversation_key]) }}', {
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
        // ── SCROLL ──
        function scrollToBottom() {
            const container = document.getElementById('messages-list');
            container.scrollTop = container.scrollHeight;
        }
    </script>
@endsection
