@extends('components.layout.MainLayout')

@section('title', 'Settings')

@section('content')
    <div class="w-[80%] lg:w-[40%] box-shadow bg-card overflow-scroll">
        <div class="border-b-2 border-dust pb-2 border-dashed">
            <h1 class="font-bold text-gold flex items-center gap-2 text-2xl"> <x-terminal-icon />Settings</h1>
        </div>

        <form class="px-5 pt-5 overflow-scroll" method="POST" action="{{ route('save-settings', ['user' => auth()->user()->user_key]) }}">
            @csrf
            <div class="mb-8">
                <div
                    class="text-[10px] tracking-[3px] text-[var(--color-cocoa)] uppercase mb-4
                        border-b border-[var(--color-rim)] pb-2">
                    // 0x01 — Theme
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                    @foreach ($themes as $key => $meta)
                        <label class="cursor-pointer">
                            <input type="radio" name="theme" value="{{ $key }}" class="sr-only peer"
                                {{ ($s['theme'] ?? 'default') === $key ? 'checked' : '' }}>
                            <div
                                class="flex flex-col items-center gap-2 px-3 py-4 rounded
                                    border border-[var(--color-rim)]
                                    bg-[var(--color-card)]
                                    peer-checked:border-[var(--color-gold)]
                                    peer-checked:bg-[var(--color-input)]
                                    hover:border-[var(--color-gold-dim)]
                                    transition-colors duration-150">
                                <span
                                    class="w-5 h-5 rounded-full border-2 border-[var(--color-rim)]
                                         peer-checked:border-[var(--color-gold)]"
                                    style="background:{{ $meta['dot'] }}">
                                </span>
                                <span class="text-xs text-[var(--color-oat)] tracking-widest">
                                    {{ $meta['label'] }}
                                </span>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="mb-8">
                <div
                    class="text-[10px] tracking-[3px] text-[var(--color-cocoa)] uppercase mb-4
                        border-b border-[var(--color-rim)] pb-2">
                    // 0x02 — Font
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-5">
                    @foreach ($fonts as $key => $meta)
                        <label class="cursor-pointer">
                            <input type="radio" name="font" value="{{ $key }}" class="sr-only peer"
                                {{ ($s['font'] ?? 'default') === $key ? 'checked' : '' }}>
                            <div
                                class="px-3 py-3 rounded border border-[var(--color-rim)]
                                    bg-[var(--color-card)]
                                    peer-checked:border-[var(--color-gold)]
                                    peer-checked:bg-[var(--color-input)]
                                    hover:border-[var(--color-gold-dim)]
                                    transition-colors duration-150">
                                <p class="text-base text-[var(--color-cream)] mb-1 leading-tight"
                                    style="font-family: {{ $fontFamilies[$key] }}">
                                    AaBbCc
                                </p>
                                <p class="text-[10px] text-[var(--color-cocoa)] tracking-wider">
                                    {{ $meta['label'] }}
                                </p>
                            </div>
                        </label>
                    @endforeach
                </div>

                {{-- Font size --}}
                {{-- <div
                    class="flex items-center gap-4 px-4 py-3 rounded border border-[var(--color-rim)]
                        bg-[var(--color-card)]">
                    <span class="text-xs text-[var(--color-cocoa)] tracking-widest min-w-[70px]">
                        SIZE
                    </span>
                    <input type="range" name="font_size" min="12" max="20" step="1"
                        value="{{ $s['font_size'] ?? 12 }}" class="flex-1 accent-[var(--color-gold)] cursor-pointer"
                        oninput="document.getElementById('fs-val').textContent = this.value + 'px'">
                    <span id="fs-val" class="text-xs text-[var(--color-gold)] min-w-[32px] text-right">
                        {{ $s['font_size'] ?? 12 }}px
                    </span>
                </div> --}}
            </div>

            <div class="w-fit mx-auto sticky bottom-0 pt-4 pb-6 bg-[var(--color-page)]">
                <button type="submit"
                    class="w-full px-5 py-3 text-sm tracking-[3px] uppercase
                           border border-[var(--color-gold)]
                           text-[var(--color-gold)]
                           bg-transparent
                           hover:bg-[var(--color-sent-bubble)]
                           active:scale-[0.99]
                           transition-all duration-150 rounded cursor-pointer">
                     Apply Changes 
                </button>
            </div>

        </form>

    </div>
@endsection
