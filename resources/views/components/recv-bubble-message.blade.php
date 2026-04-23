<div
    class="bg-recv-bubble border-recv-border border-solid border-1 rounded-2xl rounded-bl-none p-3 text-recv-text w-fit max-w-[50%] flex flex-col gap-1">
    <p>{{ $message }}</p>
    <div class="self-end flex items-center gap-1">
        <p class="text-xs text-timestamp">{{ $time }}</p>
        @if ($isRead === true)
            <x-read-icon />
        @else
            <x-unread-icon />
        @endif
    </div>
</div>
