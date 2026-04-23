@extends('components.layout.MainLayout')

@section('title', 'Chat')

@section('content')
    <div class="w-[40%] box-shadow pb-6 bg-chat-bg">
        <x-chat-id userId="888" userName="kol" userStatus="offline" />
        <div class="p-5 flex flex-col gap-2 h-[65vh] overflow-scroll">
            <x-recv-bubble-message message="Lorem ipsum dolor sit amet consectetur adipisicing." time="10.52"/>
            <x-recv-bubble-message message="Lorem ipsum dolor" time="10.52"/>
            <x-sent-bubble-message message="Lorem ipsum dolor" time="10.52"/>
            <x-recv-bubble-message message="Lorem ipsum dolor" time="10.52"/>
            <x-sent-bubble-message message="Lorem ipsum dolor" time="10.52"/>
            <x-recv-bubble-message message="Lorem ipsum dolor sit amet consectetur adipisicing." time="10.52"/>
        </div>
    </div>
@endsection
