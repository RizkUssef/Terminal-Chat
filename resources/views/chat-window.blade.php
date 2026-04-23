@extends('components.layout.MainLayout')

@section('title', 'Chat')

@section('content')
    <div class="w-[40%] box-shadow h-[70vh] pb-6 bg-chat-bg">
        <x-chat-id userId="888" userName="kol" userStatus="offline" />
        <div class="p-5 flex flex-col gap-2 h-[52vh] overflow-scroll">
            <x-recv-bubble-message message="Lorem ipsum dolor sit amet consectetur adipisicing." time="10.52" :isRead="true" />
            <x-recv-bubble-message message="Lorem ipsum dolor" time="10.52" :isRead="false" />
            <x-sent-bubble-message message="Lorem ipsum dolor" time="10.52" :isRead="true" />
            <x-recv-bubble-message message="Lorem ipsum dolor" time="10.52" :isRead="false" />
            <x-sent-bubble-message message="Lorem ipsum dolor" time="10.52" :isRead="true" />
            <x-recv-bubble-message message="Lorem ipsum dolor sit amet consectetur adipisicing." time="10.52" :isRead="true" />
        </div>
        <form action="" class="">
            @csrf
            <div class="flex justify-between items-baseline px-5">
                <x-message-input userName="pop" type="text" name="message" placeholder="Message ..." />
                <x-message-send>Exec_</x-message-send>
            </div>
        </form>
    </div>
@endsection
