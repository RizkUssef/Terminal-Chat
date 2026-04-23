@extends('components.layout.MainLayout')

@section('title', 'Add New Friend')

@section('content')
<div class="w-[40%]">
        <h1 class="font-bold text-gold flex items-center gap-2 text-4xl"> <x-terminal-icon/>Add New Friend</h1>

        <form method="POST" action="{{ route('add-new-friend') }}" class="mt-6 bg-card shadow-2xl p-6 box-shadow rounded-lg flex flex-col ">
            @csrf
            <x-input label="User Name" type="text" name="user_name" />
            <x-button>Submit</x-button>
        </form>
    </div>
@endsection