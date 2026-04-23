@extends('components.layout.MainLayout')

@section('title',"Home")

@section('content')
    <div class="w-[40%] box-shadow p-6">
        <h1 class="font-bold text-gold flex items-center gap-2 text-2xl"> <x-terminal-icon/>Welcome Again pop</h1>
        <div class="flex gap-3 justify-center">
            <x-link :url="route('chat-list')">Start Chat</x-link>
            <x-link :url="route('home')" >Add New Friend</x-link>
        </div>
    </div>
@endsection