@extends('components.layout.MainLayout')

@section('title', 'Chat List')

@section('content')
    <div class="w-[40%] box-shadow py-6 bg-card">
        <div class="border-b-2 border-dust pb-2 border-dashed">
            <h1 class="font-bold text-gold flex items-center gap-2 text-2xl"> <x-terminal-icon />Chat List</h1>
        </div>
        <div class="flex flex-col gap-1 justify-center w-full">
            <table class="text-gold border-b-2 border-dust border-dashed">
                <thead class="text-start border-b-2 border-dust border-dashed">
                    <th  class="text-start w-[70%]">User Name</th>
                    <th  class="text-start w-[15%]">User ID</th>
                    <th  class="text-start w-[15%]">User Status</th>
                </thead>
                <tbody>
                    <x-chat-item userName="ko" userId="5454" userStatus="offline" />
                    <x-chat-item userName="ko" userId="5454" userStatus="online" />
                    <x-chat-item userName="ko" userId="5454" userStatus="online" />
                    <x-chat-item userName="ko" userId="5454" userStatus="offline" />
                    <x-chat-item userName="ko" userId="5454" userStatus="online" />
                    <x-chat-item userName="ko" userId="5454" userStatus="offline" />
                </tbody>
            </table>
        </div>
    </div>
    <x-link :url="route('add-new-friend')">Add New Friend</x-link>
@endsection
