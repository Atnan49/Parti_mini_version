@extends('layouts.public')

@section('title', 'PARTI Himatif UMS')

@section('content')
@php
    // Data galeri momen PARTI periode sebelumnya untuk tampilan animasi canvas 3D
    $menuItems = collect([
        [
            'image' => asset('image/moment/hero_moment.png'),
            'link' => '#',
            'title' => 'Momen 1',
            'description' => 'Kilas Balik PARTI'
        ],
        [
            'image' => asset('image/moment/moment2.png'),
            'link' => '#',
            'title' => 'Momen 2',
            'description' => 'Kilas Balik PARTI'
        ],
        [
            'image' => asset('image/moment/moment3.png'),
            'link' => '#',
            'title' => 'Momen 3',
            'description' => 'Kilas Balik PARTI'
        ],
        [
            'image' => asset('image/moment/moment4.png'),
            'link' => '#',
            'title' => 'Momen 4',
            'description' => 'Kilas Balik PARTI'
        ]
    ]);
@endphp

<!-- HERO SECTION -->
<section class="relative min-h-[80vh] flex items-center py-12 md:py-24 overflow-hidden">
    <!-- WebGL InfiniteMenu in background (hidden on mobile to prevent clutter and save CPU) -->
    <div x-data="{
        items: {{ $menuItems->toJson() }},
        activeItem: null,
        isMoving: false,
        init() {
            if (this.items && this.items.length > 0) {
                window.initInfiniteMenu(
                    this.$refs.canvas, 
                    this.items, 
                    (item) => { this.activeItem = item; }, 
                    (moving) => { this.isMoving = moving; },
                    0.85
                );
            }
        }
    }" class="hidden md:block absolute inset-y-0 right-0 w-1/2 z-0 overflow-hidden pointer-events-auto animate-fade-in">
        <canvas x-ref="canvas" id="infinite-grid-menu-canvas" class="w-full h-[450px] absolute top-1/2 -translate-y-1/2 left-0 opacity-95 dark:opacity-90 transition-opacity duration-500"></canvas>
    </div>

    <!-- Main Content -->
    <div class="w-full max-w-[1140px] mx-auto px-6 md:px-8 relative z-10 pointer-events-none my-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center text-center md:text-left">
            <!-- macOS Terminal Window Container -->
            <div class="pointer-events-auto text-left mx-auto md:mx-0 w-full rounded-[28px] ios-glass overflow-hidden">
                <!-- Window Title Bar -->
                <div class="relative flex items-center justify-between px-5 py-3.5 border-b border-line bg-black/[0.03] dark:bg-white/[0.03]">
                    <div class="flex items-center gap-1.5 z-10">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#FF5F56] inline-block shadow-sm"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-[#FFBD2E] inline-block shadow-sm"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-[#27C93F] inline-block shadow-sm"></span>
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <span class="font-mono text-[9px] tracking-wider uppercase text-ink-soft/60 select-none font-semibold">parti - terminal</span>
                    </div>
                    <div class="w-10"></div>
                </div>
                <!-- Window Content -->
                <div class="p-6 sm:p-8 md:p-10">
                    <span class="font-mono text-[11px] tracking-[0.2em] uppercase text-ember flex items-center gap-2.5 before:content-[''] before:w-[20px] before:h-[1px] before:bg-ember animate-fade-in font-bold">
                        PARTI — HIMATIF UMS
                    </span>
                    
                    <h1 class="font-display font-bold leading-[1.05] text-[32px] sm:text-[38px] md:text-[46px] mt-4 mb-5 text-ink uppercase tracking-tight">
                        PARADE TEKNIK<br><span class="text-transparent bg-clip-text bg-gradient-to-r from-ember to-gold">INFORMATIKA</span>
                    </h1>
                    
                    <p class="font-display text-[15px] sm:text-[17px] italic text-ink-soft mb-5 border-l-2 border-gold pl-4 max-w-[46ch]">
                        Wadah Inovasi, Kreativitas, dan Kolaborasi Teknologi
                    </p>
                    
                    <p class="text-[14px] sm:text-[14.5px] leading-relaxed text-ink-soft max-w-[50ch] mb-8">
                        PARTI (Parade Teknik Informatika) adalah rangkaian event tahunan terbesar yang diselenggarakan oleh HIMATIF UMS. Berbagai sub-acara kompetisi, seminar, dan workshop dirancang untuk mengasah potensi, keilmuan, serta semangat berinovasi mahasiswa dan publik.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row items-center gap-4">
                        <a href="#sub-acara" class="w-full sm:w-auto bg-gradient-to-r from-ember to-ember-dark text-white font-semibold text-[13px] px-[28px] py-[13px] rounded-full inline-flex items-center justify-center gap-2 transition-all duration-300 hover:shadow-[0_8px_20px_-4px_rgba(255,107,0,0.4)] hover:-translate-y-0.5 active:translate-y-0 text-center uppercase tracking-wider font-mono shadow-sm">
                            Jelajahi Acara ↓
                        </a>
                        <a href="#tentang" class="w-full sm:w-auto font-mono text-[11px] text-ink-soft hover:text-ember transition-colors text-center py-2 relative group font-bold">
                            [ Tentang PARTI ]
                        </a>
                    </div>
                </div>
            </div>

            <!-- Empty space for WebGL Menu placement on desktop -->
            <div class="hidden md:block h-[400px] pointer-events-none"></div>
        </div>
    </div>
</section>

<!-- SECTION SPONSOR LOGOLOOP (Ditempatkan Tepat Di Bawah Section Hero) -->
<x-sponsor-section :sponsors="$sponsors" />

<!-- TENTANG SECTION (macOS Floating Pane) -->
<section class="py-6 px-4 max-w-[1140px] mx-auto z-10 relative" id="tentang">
    <div class="ios-glass rounded-[32px] p-8 md:p-14">
        <div class="grid grid-cols-1 md:grid-cols-[0.8fr_1.2fr] gap-12 md:gap-16 items-center text-center md:text-left">
            <!-- iOS Glass Logo Panel -->
            <div class="relative max-w-[180px] md:max-w-[260px] mx-auto md:mx-0 w-full flex items-center justify-center p-8 bg-white/80 dark:bg-white/[0.03] rounded-[28px] border border-line shadow-sm animate-float">
                <img src="{{ asset('logo.png') }}" alt="Logo PARTI" class="w-full h-auto drop-shadow-sm hover:scale-105 transition-transform duration-500">
            </div>
            
            <div>
                <span class="font-mono text-[11px] tracking-[0.2em] uppercase text-ember flex items-center justify-center md:justify-start gap-2.5 before:content-[''] before:w-[20px] before:h-[1px] before:bg-ember font-bold">
                    Tentang Event
                </span>
                <h2 class="font-display font-bold text-[26px] sm:text-[32px] md:text-[42px] mt-4 mb-2 text-ink uppercase tracking-tight">PARADE TEKNIK INFORMATIKA</h2>
                <span class="font-mono text-[10px] tracking-[0.15em] text-gold uppercase mb-6 block font-bold">
                    Diselenggarakan oleh Himpunan Mahasiswa Teknik Informatika (HIMATIF) UMS
                </span>
                <p class="text-ink-soft leading-relaxed mb-4 text-[14.5px] sm:text-[15px]">
                    Parti (Parade Teknik Informatika) adalah event tahunan terbesar yang diselenggarakan oleh HIMPUNAN MAHASISWA TEKNIK INFORMATIKA UMS. Event ini dirancang sebagai wadah kolaborasi, inovasi, dan ekspresi bagi mahasiswa serta publik di bidang teknologi dan kreatif.
                </p>
                <p class="text-ink-soft leading-relaxed mb-6 text-[14.5px] sm:text-[15px]">
                    Sebagai platform tahunan yang dinamis, di dalam PARTI terdapat beberapa sub event yang dirancang khusus untuk memadukan kompetensi sains, kreativitas seni, dan kepekaan sosial guna menciptakan sinergi positif yang berkelanjutan bagi masyarakat luas.
                </p>
                <div class="mt-6 px-6 py-5 bg-white/90 dark:bg-white/[0.04] border border-line/80 rounded-[22px] font-display italic text-[14.5px] sm:text-[16px] text-ink shadow-sm text-left leading-relaxed">
                    “Merajut inovasi teknologi, kreativitas, dan kolaborasi dalam harmoni tahunan.”
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SUB ACARA SECTION (Modular Grid Section) -->
<section class="py-12 px-4 max-w-[1140px] mx-auto z-10 relative" id="sub-acara">
    <div class="flex flex-col md:flex-row justify-between items-center md:items-end mb-10 gap-4 text-center md:text-left px-4">
        <div>
            <span class="font-mono text-[11px] tracking-[0.2em] uppercase text-ember flex items-center justify-center md:justify-start gap-2.5 before:content-[''] before:w-[20px] before:h-[1px] before:bg-ember font-bold">
                Rangkaian Acara
            </span>
            <h2 class="font-display font-bold text-[26px] sm:text-[32px] md:text-[40px] mt-4 text-ink uppercase tracking-tight">Rangkaian Sub Acara</h2>
        </div>
        <p class="text-ink-soft max-w-[40ch] text-[14px] leading-relaxed">
            Rangkaian sub acara terstruktur yang saling menopang secara jadwal maupun kolaborasi.
        </p>
    </div>

    <!-- iOS style cards grid -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 md:gap-8">
        @forelse($subEvents as $subEvent)
        <a href="{{ route('sub-event.show', $subEvent->slug) }}" 
           class="w-full group flex flex-col ios-glass rounded-[24px] p-6 sm:p-7 md:p-8 relative overflow-hidden text-left transition-premium hover:-translate-y-1 hover:shadow-lg">
            
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
                <span class="font-mono text-[10px] text-ember bg-orange-500/10 border border-orange-500/20 px-3.5 py-1 rounded-full font-bold whitespace-nowrap">
                    @if($subEvent->date_start)
                        @if($subEvent->date_end && $subEvent->date_start != $subEvent->date_end)
                            {{ $subEvent->date_start->translatedFormat('j') }} - {{ $subEvent->date_end->translatedFormat('j M Y') }}
                        @else
                            {{ $subEvent->date_start->translatedFormat('j M Y') }}
                        @endif
                    @else
                        TBD
                    @endif
                </span>

                <!-- LED status badges -->
                <span class="font-mono text-[9px] tracking-[0.05em] uppercase px-3 py-1 rounded-full font-bold flex items-center gap-1.5 whitespace-nowrap border
                        @if($subEvent->registration_button_state === 'open') bg-emerald-500/10 text-emerald-500 border-emerald-500/20 dark:bg-emerald-500/5
                        @elseif($subEvent->registration_button_state === 'closed') bg-rose-500/10 text-rose-500 border-rose-500/25 dark:bg-rose-500/5
                        @else bg-amber-500/10 text-amber-500 border-amber-500/20 dark:bg-amber-500/5 @endif">
                    <span class="w-1.5 h-1.5 rounded-full inline-block
                            @if($subEvent->registration_button_state === 'open') bg-emerald-500 glowing-beacon
                            @elseif($subEvent->registration_button_state === 'closed') bg-rose-500
                            @else bg-amber-500 glowing-beacon @endif"></span>
                    @if($subEvent->registration_button_state === 'open')
                        Pendaftaran Buka
                    @elseif($subEvent->registration_button_state === 'closed')
                        Pendaftaran Tutup
                    @else
                        Segera Dibuka
                    @endif
                </span>
            </div>

            <span class="text-[11px] tracking-widest text-gold font-bold uppercase mb-2 block font-mono">{{ $subEvent->tagline }}</span>
            <h3 class="font-display text-[18px] sm:text-[21px] mb-3 leading-snug text-ink group-hover:text-ember transition-colors duration-300 uppercase font-bold">{{ $subEvent->name }}</h3>
            <p class="text-[13.5px] sm:text-[14px] text-ink-soft leading-relaxed mb-6">{{ Str::limit($subEvent->description, 130) }}</p>

            <div class="font-mono text-[10px] tracking-wide text-ink-soft/80 border-t border-line pt-4 mt-auto flex flex-col gap-1.5">
                <div>
                    <span class="text-gold font-bold">FORMAT</span> · {{ $subEvent->type }}
                </div>
                @if($subEvent->location)
                <div>
                    <span class="text-gold font-bold">LOKASI</span> · {{ $subEvent->location }}
                </div>
                @endif
            </div>
        </a>
        @empty
        <div class="col-span-full py-16 text-center border border-line rounded-[24px] bg-white/60 dark:bg-white/[0.02] backdrop-blur-md">
            <p class="font-mono text-ink-soft uppercase text-[12px] tracking-wider">Acara PARTI {{ session('active_year', config('parti.active_year', 2026)) }} sedang disiapkan.</p>
        </div>
        @endforelse
    </div>
</section>

<!-- TIMELINE SECTION (macOS Floating Pane) -->
<section class="py-6 px-4 max-w-[1140px] mx-auto z-10 relative mb-12" id="timeline">
    <div class="ios-glass rounded-[32px] p-8 md:p-14">
        <span class="font-mono text-[11px] tracking-[0.2em] uppercase text-ember flex items-center justify-center md:justify-start gap-2.5 before:content-[''] before:w-[20px] before:h-[1px] before:bg-ember font-bold">
            Alur Waktu
        </span>
        <h2 class="font-display font-bold text-[26px] sm:text-[32px] md:text-[40px] mt-4 mb-12 md:mb-16 text-ink uppercase tracking-tight">Timeline PARTI {{ session('active_year', config('parti.active_year', 2026)) }}</h2>

        <div class="relative grid grid-cols-1 md:grid-cols-4 gap-10 md:gap-0 pl-4 md:pl-0">
            <!-- Line across desktop nodes -->
            <div class="hidden md:block absolute top-[9px] left-0 right-0 h-[2px] bg-black/10 dark:bg-white/10 z-0"></div>
            <!-- Line down mobile nodes -->
            <div class="block md:hidden absolute top-[10px] bottom-[10px] left-[9px] w-[2px] bg-black/10 dark:bg-white/10 z-0"></div>

            @forelse($timeline as $item)
            <div class="group relative pl-8 md:pl-0 pr-5 z-10 flex flex-col items-start text-left">
                <!-- Apple-style bullet point -->
                <div class="absolute left-0 top-[3px] md:relative md:top-auto md:left-auto w-4.5 h-4.5 rounded-full bg-paper border-2 border-ember md:mb-6 z-20 transition-all duration-300 group-hover:bg-ember group-hover:scale-110 shadow-sm"></div>

                <span class="font-mono text-[10px] text-orange-600 dark:text-orange-400 bg-orange-500/10 border border-orange-500/20 px-2.5 py-0.5 rounded-full font-bold tracking-wider mb-3.5 inline-block">
                    {{ $item->date ? $item->date->translatedFormat('d M') : 'TBD' }}
                </span>
                <h4 class="font-display text-[15px] sm:text-[16px] mb-2 text-ink group-hover:text-ember transition-colors duration-300 font-bold uppercase tracking-wide leading-snug">{{ $item->title }}</h4>
                <p class="text-[13px] text-ink-soft leading-relaxed pr-2">{{ $item->description }}</p>
            </div>
            @empty
            <div class="col-span-full text-center py-8">
                <p class="font-mono text-ink-soft uppercase text-[11px] tracking-widest">Timeline belum diumumkan.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
