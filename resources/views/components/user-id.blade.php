<div class="border-b-1 border-dust p-2 border-dashed w-full">
    <div class="flex items-center justify-between w-full gap-2">
        <div class="flex gap-3">
            <a href="{{ route('home') }}" style="font-family: VT323"
                class="flex items-center text-dust hover:text-gold transition-colors font-mono text-sm ">
                <x-terminal-icon /> cd ~ home
            </a>
            <span class="text-rim">|</span>
            @if (url()->previous() !== url()->current() && url()->previous() !== '')
                <a href="{{ url()->previous() }}" style="font-family: VT323"
                    class="flex items-center text-dust hover:text-gold transition-colors font-mono text-sm ">
                    <x-terminal-icon /> cd ..
                </a>
            @else
                <p style="font-family: VT323" class="flex items-center text-dust  font-mono text-sm cursor-pointer">
                    <x-terminal-icon /> cd ..
                </p>
            @endif
        </div>
        <div class="flex gap-3 items-center">
            <div
                class="relative w-[42px] h-[42px] flex items-center justify-center rounded-md border border-sent-border capitalize shrink-0 overflow-hidden">
                <span class="text-[15px] font-bold text-gold">{{ $userName[0] }}</span>
                <span class="absolute right-1.5 top-1/2 -translate-y-1/2 w-[2px] h-4 bg-dust animate-blink"></span>
            </div>
            <div>
                <p class="text-sm text-gold">{{ $userName }}</p>
                <p class="text-xs text-dust">#{{ substr($userId, 0, 8) }}</p>
            </div>
        </div>
        <div class="flex items-center justify-center gap-3">
            <p
                class="py-1 px-2 rounded-2xl flex items-center gap-2 text-xs {{ $userStatus ? 'text-online bg-online-dim border border-online-border' : 'text-offline bg-offline-dim border border-offline-border' }}">
                @if ($userStatus)
                    <x-online-icon />
                    <span>Online</span>
                @else
                    <x-offline-icon />
                    <span>Offline</span>
                @endif
            </p>
            <a href="#">
                <x-settings-icon />
            </a>
            <a href="#">
                <x-profile-icon />
            </a>
        </div>
    </div>
</div>
