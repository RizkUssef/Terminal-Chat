@extends('components.layout.MainLayout')

@section('title', 'Chat')

@section('content')
    <div class="w-[40%] box-shadow h-[70vh] pb-6 bg-chat-bg">
        <x-chat-id :userId="$conversation_partner->user_key" :userName="$conversation_partner->user_name" :userStatus="$conversation_partner->status" />
        <div class="p-5 flex flex-col gap-2 h-[52vh] overflow-scroll">
            @foreach ($conversation->messages as $message)
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
        </div>
        <form action="{{ route('send-message', ['conversation' => $conversation->conversation_key]) }}" class="" method="POST">
            @csrf
            <div class="flex justify-between items-baseline px-5">
                <x-message-input userName="pop" type="text" name="message" placeholder="Message ..." />
                <x-message-send>Exec_</x-message-send>
            </div>
        </form>
    </div>
@endsection
