<div class="flex items-center justify-end mt-4">
    <a href="{{ $url }}" 
        class="bg-transparent text-gold-dim cursor-pointer px-6 font-bold rounded-lg py-2.5 text-sm flex items-center gap-2
               hover:opacity-90 hover:bg-gold-dim hover:text-[#0a0806] transition-all duration-300 mt-1 border-solid border-2 border-gold">
       <x-terminal-icon/> {{ $slot }}
    </a>
</div>
