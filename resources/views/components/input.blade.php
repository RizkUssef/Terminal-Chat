<div class="mt-4">
    <label for="{{ $name }}" class="block text-oat text-sm font-medium">{{ $label }}</label>
    <div class="relative">
        <span class="absolute inset-y-0 left-0 flex items-center pl-1 text-dust ">
            <x-terminal-icon />
        </span>
        <input id="{{ $name }}" type="{{ $type }}" name="{{ $name }}" required
            placeholder="{{ $placeholder }}"
            class="mt-1 block w-full px-3 pl-6 py-2 border-l text-cream placeholder-dust bg-input rounded-md shadow-sm focus:outline-none focus:border-gold focus:border-b sm:text-sm">
    </div>
</div>
