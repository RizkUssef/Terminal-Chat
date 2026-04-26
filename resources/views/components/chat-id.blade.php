<div class="border-b-1 border-dust py-2 px-6 border-dashed w-full">
    <div class="flex items-center justify-between gap-2">
        <div class="flex gap-3 items-center">
            <div
                class="relative w-[42px] h-[42px] flex items-center justify-center rounded-md bg-[#0d0d0d] border border-sent-border shrink-0 capitalize">
                <span class="absolute left-[3px] text-xl font-bold text-dust leading-none">[</span>
                <span class="text-sm font-bold text-gold-dim z-10">{{ $userName[0] }}</span>
                <span class="absolute right-[3px] text-xl font-bold text-dust leading-none">]</span>
            </div>
            <div>
                <p class="text-sm text-gold">{{ $userName }}</p>
                <p class="text-xs text-dust">#{{ substr($userId, 0, 8) }}</p>
            </div>
        </div>
        <div>
            <p class="text-xs {{ $userStatus ? 'text-sage' : 'text-error' }}">
                {{ $userStatus ? 'Online' : 'Offline' }}
            </p>
        </div>
    </div>
</div>
