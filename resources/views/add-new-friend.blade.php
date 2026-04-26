@extends('components.layout.MainLayout')

@section('title', 'Add New Friend')

@section('content')
    <div class="w-[40%]">
        <h1 class="font-bold text-gold flex items-center gap-2 text-4xl"> <x-terminal-icon />Add New Friend</h1>

        <form method="POST" action="{{ route('create-conv') }}"
            class="mt-6 bg-card shadow-2xl p-6 box-shadow rounded-lg flex flex-col ">
            @csrf
            <x-input label="User" type="text" name="user" placeholder="Enter user name or email..." />
            <x-button>Submit</x-button>
        </form>
    </div>
    <x-link :url="route('user-convs')">Back to Chats</x-link>
@endsection
