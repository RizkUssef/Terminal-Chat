<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body >
    <div style="font-family: VT323" class="relative font-pixelify flex flex-col justify-start items-center h-screen bg-black gap-10">
        @php
            $user = auth()->user();
        @endphp
        <x-user-id :user_name="$user->user_name" :user_status="$user->isOnline()" :user_id="$user->user_key" :lastSeenAt="$user->last_seen_at"/>
        @yield('content')
    </div>
    @yield('scripts')
</body>

</html>
