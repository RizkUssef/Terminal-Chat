<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <div class="flex flex-col justify-start items-center h-screen bg-black pt-10 gap-10">
        {{-- <x-user-id :user_name="auth()->user()->user_name" :user_status="auth()->user()->status" :user_id="auth()->user()->id"/> --}}
        <x-user-id user_name="ui pom" user_status="online" user_id="1545" />
        @yield('content')
    </div>
</body>

</html>
