@extends('components.layout.MainLayout')

@section('title', 'Chat List')

@section('content')
    <div class="w-[80%] lg:w-[40%] box-shadow py-6 bg-card">
        <div class="border-b-2 border-dust pb-2 border-dashed">
            <h1 class="font-bold text-gold flex items-center gap-2 text-2xl"> <x-terminal-icon />Chat List</h1>
        </div>
        <div class="flex flex-col gap-1 justify-center w-full">

            <table class="text-gold border-b-2 border-dust border-dashed">
                <thead class="text-start border-b-2 border-dust border-dashed">
                    <th class="text-start w-[60%]">User Name</th>
                    <th class="text-start w-[20%]">User ID</th>
                    <th class="text-start w-[20%]">User Status</th>
                </thead>
                <tbody>
                    @foreach ($conversations_members as $conversation)
                        @php $partner = $conversation->users->first() @endphp
                        <x-chat-item :conversationKey="$conversation->conversation_key" :userName="$partner->user_name" :userId="$partner->user_key" :userStatus="$partner->isOnline()" />
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <x-link :url="route('add-new-friend')">Add New Friend</x-link>
@endsection
