<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <div class="relative flex flex-col justify-start items-center h-screen bg-black gap-10">
            @php
             $user = auth()->user();
            @endphp
            <x-user-id :user_name="$user->user_name" :user_status="$user->status" :user_id="$user->user_key" />
        @yield('content')
    </div>
</body>

</html>
