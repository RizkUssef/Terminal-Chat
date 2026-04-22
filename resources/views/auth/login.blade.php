@extends('components.layout.AuthLayout')

@section('title', 'Login')

@section('content')
    <div class="w-[40%]">

        <h1 class="font-bold text-gold flex items-center gap-2 text-4xl"> <x-terminal-icon/>Login</h1>

        <form method="POST" action="{{ route('login') }}" class="mt-6 bg-card shadow-2xl p-6 box-shadow rounded-lg flex flex-col ">
            @csrf
            <x-input label="Email" type="email" name="email" />
            <x-input label="Password" type="password" name="password" />
            <a class="text-gold self-end mt-3">Forget Password?</a>
            <x-button>Submit</x-button>
        </form>
    </div>
@endsection
