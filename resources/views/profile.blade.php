@extends('components.layout.MainLayout')

@section('title', 'Profile')

@section('content')
    <div class="w-[80%] lg:w-[40%] box-shadow bg-card">
        <div class="border-b-2 border-dust pb-2 border-dashed">
            <h1 class="font-bold text-gold flex items-center gap-2 text-2xl"> <x-terminal-icon />Profile</h1>
        </div>
        <div class="flex flex-col text-gold gap-1 justify-center w-full py-5">
            <div class="flex items-center gap-50 text-sm">
                <div>
                    <div class="flex gap-2">
                        <h1>user name : </h1>
                        <p class="text-cocoa">{{ $user->user_name }}</p>
                    </div>
                    <div class="flex gap-2">
                        <h1>email : </h1>
                        <p class="text-cocoa">{{ $user->email }}</p>
                    </div>
                    <div class="flex gap-2">
                        <h1>user id : </h1>
                        <p class="text-cocoa">#{{ substr($user->user_key, 0, 8) }}</p>
                    </div>
                    <div class="flex gap-2">
                        <h1>user status : </h1>
                        <p
                            class="py-1 px-2 rounded-2xl flex items-center gap-2 text-xs {{ $user->isOnline() ? 'text-online bg-online-dim border border-online-border' : 'text-offline bg-offline-dim border border-offline-border' }}">
                            @if ($user->isOnline())
                                <x-online-icon />
                                <span>Online</span>
                            @else
                                <x-offline-icon />
                                <span>Offline</span>
                                <p class="text-xs self-center w-fit mx-auto text-dust">
                                    {{ $lastSeenAt?->diffForHumans(null, false, true, 1) }}</p>
                            @endif
                        </p>
                    </div>
                </div>
                <div>
                    <div class="flex gap-2">
                        <h1>Messages : </h1>
                        <p class="text-cocoa">{{ $user->messages()->count() }}</p>
                    </div>
                    <div class="flex gap-2">
                        <h1>Conversations : </h1>
                        <p class="text-cocoa">{{ $user->conversations()->count() }}</p>
                    </div>
                    <div class="flex gap-2">
                        <h1>joined at : </h1>
                        <p class="text-cocoa">{{ $user->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-link :url="route('user-convs')">Back to Chats</x-link>
@endsection
