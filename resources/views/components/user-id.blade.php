<div class="border-b-1 border-dust py-2 border-dashed w-[40%]">
    <div class="flex items-center justify-between gap-2">
        <div class="flex gap-3 items-center">
            <div
                class="w-10 h-10 rounded-full bg-dust flex items-center justify-center capitalize text-sm text-[#0a0806] font-bold">
                {{ $userName[0] }}
            </div>
            <div>
                <p class="text-sm text-gold">{{ $userName }}</p>
                <p class="text-xs text-dust">#{{ substr($userId, 0, 8) }}</p>
            </div>
        </div>
        <div class="flex items-center justify-center gap-3">
            <p class="text-xs {{ $userStatus ? 'text-sage' : 'text-error' }}">{{ $userStatus ? 'Online' : 'Offline' }}</p>
            <a href="#">
                <x-settings-icon />
            </a>
            <a href="#">
                <x-profile-icon />
            </a>
        </div>
    </div>
</div>
