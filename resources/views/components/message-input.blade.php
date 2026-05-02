<div style="font-family: VT323" class="flex relative flex-1">
    <span style="font-family: VT323" class="absolute bottom-0 left-1 px-3 py-2 text-sm border-r border-rim bg-[#0d0c0a] select-none font-mono w-30">
        <span class="text-oat">{{\Illuminate\Support\Str::limit($userName, 5, '')  }}..</span>
        <span class="text-dust">@</span>
        <span class="text-gold">chat</span>
        <span class="text-oat"> ~$</span>
    </span>
    <input id="{{ $name }}" type="{{ $type }}" name="{{ $name }}" required
        placeholder="{{ $placeholder }}"
        class="mt-1 block flex-1 px-3 pl-32 py-2 border-l text-cream placeholder-dust bg-input rounded-md shadow-sm focus:outline-none focus:border-gold  sm:text-sm">
</div>
