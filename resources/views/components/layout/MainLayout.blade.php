<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <div class="relative flex flex-col justify-start items-center h-screen bg-black pt-10 gap-10">
            @if (url()->previous() !== url()->current() && url()->previous() !== '')
                <a href="{{ url()->previous() }}"
                    class="absolute left-70 top-15 flex items-center text-dust hover:text-gold transition-colors font-mono text-sm ">
                    <x-terminal-icon /> cd ..
                </a>
            @endif
            @php
             $user = auth()->user();
            @endphp
            <x-user-id :user_name="$user->user_name" :user_status="$user->status" :user_id="$user->user_key" />
        @yield('content')
    </div>
</body>

</html>
