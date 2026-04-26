<div
    class="bg-sent-bubble border-sent-border border-solid border-1 rounded-2xl rounded-br-none p-3 text-sent-text w-fit max-w-[50%] flex flex-col gap-1 self-end">
    <p>{{ $message }}</p>
    <div class="self-end flex items-center gap-1">
        <p class="text-xs text-timestamp">{{ $time }}</p>
        @if ($isRead)
            <x-read-icon />
        @else
            <x-unread-icon />
        @endif
    </div>
</div>
