@extends('components.layout.AuthLayout')

@section('title', 'Register')

@section('content')
    <div class="w-[40%]">

        <h1 class="text-2xl font-bold text-gold flex items-center gap-2 text-4xl"> <x-terminal-icon/>Register</h1>

        <form method="POST" action="{{ route('register') }}" class="mt-6 bg-card shadow-2xl p-6 box-shadow rounded-lg flex flex-col ">
            @csrf
            <x-input label="Name" type="text" name="name" />
            <x-input label="User Name" type="text" name="user_name" />
            <x-input label="Email" type="email" name="email" />
            <x-input label="Password" type="password" name="password" />
            <x-input label="Password Confirmation" type="password" name="password_confirmation" />
            <a class="text-gold self-end mt-3">Login?</a>
            <x-button>Submit</x-button>
        </form>
    </div>
@endsection