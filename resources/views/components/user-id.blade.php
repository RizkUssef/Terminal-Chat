<div class="border-b-1 border-dust py-2 border-dashed w-[40%]">
    <div class="flex items-center justify-between gap-2">
        <div class="flex gap-3 items-center">
            <div
                class="w-10 h-10 rounded-full bg-dust flex items-center justify-center capitalize text-sm text-[#0a0806] font-bold">
                {{ $userName[0] }}
            </div>
            <div>
                <p class="text-sm text-gold">{{ $userName }}</p>
                <p class="text-xs text-dust">#{{ $userId }}</p>
            </div>
        </div>
        <div>
            <p class="text-xs text-sage">{{ $userStatus }}</p>
        </div>
    </div>
</div>
