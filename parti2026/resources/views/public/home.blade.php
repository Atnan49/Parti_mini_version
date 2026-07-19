@extends('layouts.public')

@section('title', 'PARTI ' . config('parti.active_year', 2026) . ' | Vanguard of Tech')

@section('content')
@php
    // ponytail: static moments from last year's PARTI to prevent blank canvas when database is empty
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
{{-- ponytail: all sections are placed directly here to avoid the overhead of multiple Blade component files --}}

<!-- HERO SECTION -->
<!-- ponytail: split Hero layout into 2 sides (text on left, moment photo on right with seamless blending) -->
<section class="relative py-12 md:py-24 overflow-hidden hero-pattern-bg">
    <!-- Ambient Background Glows -->
    <div class="absolute top-0 right-0 w-[45%] h-[60%] bg-gradient-to-bl from-gold-soft/14 via-ember/5 to-transparent blur-[120px] rounded-full pointer-events-none animate-pulse-glow"></div>
    <div class="absolute -bottom-10 -left-10 w-[350px] h-[350px] bg-gold/5 blur-[100px] rounded-full pointer-events-none"></div>

    <!-- ponytail: interactive 3D WebGL InfiniteMenu running in absolute background on the right half (reposisi di mobile ke area bawah) -->
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
    }" class="absolute bottom-0 left-0 md:left-auto md:right-0 w-full md:w-1/2 h-[300px] sm:h-[380px] md:h-full z-0 overflow-hidden pointer-events-auto animate-fade-in">
        <canvas x-ref="canvas" id="infinite-grid-menu-canvas"></canvas>

        <!-- Left fade overlay - blending into text background (desktop only) -->
        <div class="hidden md:block absolute inset-y-0 left-0 w-1/3 bg-gradient-to-r from-[#FDF9F1] via-[#FDF9F1]/90 to-transparent pointer-events-none z-10"></div>
        <!-- Top fade overlay (mobile/tablet only) -->
        <div class="block md:hidden absolute inset-x-0 top-0 h-1/4 bg-gradient-to-b from-[#FDF9F1] via-[#FDF9F1]/90 to-transparent pointer-events-none z-10"></div>
        <!-- Bottom fade overlay for mobile transition or desktop integration -->
        <div class="absolute inset-x-0 bottom-0 h-1/4 bg-gradient-to-t from-[#FDF9F1] via-[#FDF9F1]/80 to-transparent pointer-events-none z-10"></div>
    </div>

    <!-- Main Content Overlaid on top of background -->
    <div class="max-w-[1180px] mx-auto px-6 md:px-8 grid grid-cols-1 md:grid-cols-2 gap-12 items-center text-center md:text-left relative z-10 pointer-events-none">
        <div class="pointer-events-auto">
            <span class="font-mono text-[12px] tracking-[0.22em] uppercase text-ember-dark flex items-center justify-center md:justify-start gap-2.5 before:content-[''] before:w-[22px] before:h-[1px] before:bg-ember-dark animate-fade-in">
                PARTI - HIMATIF UMS
            </span>
            <h1 class="font-display font-bold leading-[1.1] md:leading-[0.98] text-[36px] sm:text-[48px] md:text-[80px] mt-5 mb-6 text-ink uppercase tracking-tight">
                VANGUARD<br><span class="text-transparent bg-clip-text bg-gradient-to-r from-ember to-gold">OF TECH</span>
            </h1>
            <p class="font-display text-[17px] sm:text-[19px] italic text-ink-soft mb-6 border-l-0 md:border-l-2 border-gold pl-0 md:pl-4 max-w-[46ch] mx-auto md:mx-0">
                Panggung Inovasi dan Kolaborasi Teknologi
            </p>
            <p class="text-[15px] sm:text-[16px] leading-[1.75] text-ink-soft max-w-[52ch] mb-8 mx-auto md:mx-0">
                Dunia terus melangkah dalam akselerasi digital. PARTI {{ session('active_year', config('parti.active_year', 2026)) }} hadir
                sebagai wadah kreativitas, keilmuan, dan aksi nyata mahasiswa untuk menyatukan keberanian bereksplorasi,
                ketekunan berkarya, dan sinergi positif dalam menghadapi tantangan era masa depan.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center md:justify-start gap-4 sm:gap-6">
                <a href="#sub-acara" class="w-full sm:w-auto bg-gradient-to-r from-ember to-ember-dark text-white font-semibold text-[14.5px] px-[32px] py-[16px] rounded-[2px] inline-flex items-center justify-center gap-2.5 transition-all duration-300 hover:shadow-[0_12px_28px_-6px_rgba(226,101,11,0.5)] hover:-translate-y-0.5 active:translate-y-0">
                    Jelajahi Sub Acara →
                </a>
                <a href="#tentang" class="w-full sm:w-auto font-mono text-[13px] text-ink-soft border-b border-line/80 pb-[2px] transition-all duration-300 hover:text-ember hover:border-ember text-center py-2">
                    Tentang PARTI
                </a>
            </div>
        </div>

        <!-- Right Column Placeholder (empty on grid to reserve layout structure) -->
        <div class="h-[320px] sm:h-[400px] md:h-[450px] pointer-events-none"></div>
    </div>
    <!-- Subtle fade-out bottom overlay -->
    <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-paper to-transparent pointer-events-none"></div>
</section>

<!-- TENTANG SECTION -->
<section class="py-14 md:py-20 bg-paper relative overflow-hidden" id="tentang">
    <!-- Subtle Background Gold Glow -->
    <div class="absolute top-1/2 left-0 -translate-y-1/2 w-[300px] h-[300px] bg-gold/5 blur-[100px] rounded-full pointer-events-none"></div>

    <div class="max-w-[1180px] mx-auto px-6 md:px-8 grid grid-cols-1 md:grid-cols-[0.85fr_1.15fr] gap-12 md:gap-16 items-center text-center md:text-left relative z-10">
        <div class="relative max-w-[180px] md:max-w-[300px] mx-auto md:mx-0 w-full flex items-center justify-center p-8 bg-white/40 backdrop-blur-md border border-white/60 rounded-[12px] shadow-[0_16px_36px_-12px_rgba(28,20,11,0.05)] animate-float">
            <!-- Tech brackets -->
            <div class="absolute top-3 left-3 w-4 h-4 border-t-2 border-l-2 border-ember/60"></div>
            <div class="absolute bottom-3 right-3 w-4 h-4 border-b-2 border-r-2 border-ember/60"></div>
            <img src="{{ asset('logo.png') }}" alt="Logo PARTI" class="w-full h-auto drop-shadow-[0_10px_20px_rgba(28,20,11,0.06)] hover:scale-105 transition-transform duration-500">
        </div>
        <div>
            <span class="font-mono text-[12px] tracking-[0.22em] uppercase text-ember-dark flex items-center justify-center md:justify-start gap-2.5 before:content-[''] before:w-[22px] before:h-[1px] before:bg-ember-dark">
                Tentang Event
            </span>
            <h2 class="font-display text-[26px] sm:text-[32px] md:text-[42px] mt-4 mb-2 text-ink uppercase tracking-tight">PARADE TEKNIK INFORMATIKA</h2>
            <span class="font-mono text-[11px] tracking-[0.15em] text-ember-dark uppercase mb-6 block font-semibold">
                Diselenggarakan oleh Himpunan Mahasiswa Teknik Informatika (HIMATIF) UMS
            </span>
            <p class="text-ink-soft leading-[1.75] mb-4 text-[14.5px] sm:text-[15.5px]">
                Parti (Parade Teknik Informatika) adalah event tahunan terbesar yang diselenggarakan oleh HIMPUNAN MAHASISWA TEKNIK INFORMATIKA UMS. Event ini dirancang sebagai wadah kolaborasi, inovasi, dan ekspresi bagi mahasiswa serta publik di bidang teknologi dan kreatif.
            </p>
            <p class="text-ink-soft leading-[1.75] mb-4 text-[15.5px]">
                Sebagai platform tahunan yang dinamis, di dalam PARTI terdapat beberapa sub event yang dirancang khusus untuk memadukan kompetensi sains, kreativitas seni, dan kepekaan sosial guna menciptakan sinergi positif yang berkelanjutan bagi masyarakat luas.
            </p>
            <div class="mt-[26px] p-5 border-l-2 border-ember bg-paper-warm/80 backdrop-blur-sm border border-line/40 rounded-[2px] font-display italic text-[15px] sm:text-[16px] text-ink shadow-[0_4px_12px_rgba(28,20,11,0.02)] text-left">
                “Merajut inovasi teknologi, kreativitas, dan kolaborasi dalam harmoni tahunan.”
            </div>
        </div>
    </div>
</section>

<!-- SPONSORS SECTION -->
@if($sponsors->isNotEmpty())
<section class="py-10 md:py-14 bg-paper border-t border-line">
    <div class="max-w-[1180px] mx-auto px-8 text-center">
        <span class="font-mono text-[11px] tracking-[0.15em] uppercase text-ember-dark mb-8 block">Didukung Oleh</span>

        @foreach(['PLATINUM', 'GOLD', 'SILVER', 'BRONZE'] as $tier)
        @php
        $tierSponsors = $sponsors->where('tier', $tier);
        @endphp
        @if($tierSponsors->isNotEmpty())
        <div class="mb-10">
            <div class="flex items-center justify-center gap-3 mb-6">
                <span class="h-[1px] w-8 bg-line"></span>
                <span class="font-mono text-[10px] tracking-[0.2em] text-ink-soft uppercase">{{ $tier }} SPONSORS</span>
                <span class="h-[1px] w-8 bg-line"></span>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-8 md:gap-12">
                @foreach($tierSponsors as $sponsor)
                <a href="{{ $sponsor->website_url ?? '#' }}" target="_blank" rel="noopener noreferrer" class="group transition-transform hover:scale-105 duration-200">
                    @if($sponsor->logo_path)
                    <img src="{{ $sponsor->logo_url }}" alt="{{ $sponsor->name }}"
                        class="object-contain filter grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-300
                                                @if($tier === 'PLATINUM') h-[60px] md:h-[75px] @elseif($tier === 'GOLD') h-[50px] md:h-[60px] @else h-[40px] md:h-[45px] @endif">
                    @else
                    <span class="font-display font-bold text-[#8A7A62] group-hover:text-ember transition-colors
                                                @if($tier === 'PLATINUM') text-[20px] md:text-[24px] @elseif($tier === 'GOLD') text-[16px] md:text-[20px] @else text-[14px] md:text-[16px] @endif">
                        {{ $sponsor->name }}
                    </span>
                    @endif
                </a>
                @endforeach
            </div>
        </div>
        @endif
        @endforeach
    </div>
</section>
@endif

<!-- SUB ACARA SECTION -->
<section class="bg-gradient-to-b from-paper-warm via-paper-warm/40 to-paper border-t border-line/60 py-14 md:py-20" id="sub-acara">
    <div class="max-w-[1180px] mx-auto px-6 md:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center md:items-end mb-10 md:mb-[52px] gap-4 md:gap-5 text-center md:text-left">
            <div>
                <span class="font-mono text-[12px] tracking-[0.22em] uppercase text-ember-dark flex items-center justify-center md:justify-start gap-2.5 before:content-[''] before:w-[22px] before:h-[1px] before:bg-ember-dark">
                    Rangkaian Acara
                </span>
                <h2 class="font-display text-[26px] sm:text-[32px] md:text-[40px] mt-3.5 text-ink uppercase tracking-tight">Rangkaian Sub Acara</h2>
            </div>
            <p class="text-ink-soft max-w-[40ch] text-[14px] sm:text-[14.5px] leading-relaxed mx-auto md:mx-0">
                Dari pembuka hingga penutup, setiap sub acara dirancang saling menopang, baik secara jadwal maupun pendanaan.
            </p>
        </div>

        {{-- ponytail: responsive flex carousel on mobile, standard grid on desktop, 3 cols on xl, 4 cols on 3xl --}}
        <div class="flex overflow-x-auto snap-x snap-mandatory gap-5 pb-6 -mx-6 px-6 scrollbar-none md:grid md:grid-cols-2 md:gap-8 md:overflow-visible md:pb-0 md:px-0 md:mx-0">
            @forelse($subEvents as $subEvent)
            <a href="{{ route('sub-event.show', $subEvent->slug) }}" class="w-[280px] sm:w-[320px] md:w-auto flex-shrink-0 snap-start snap-always group card flex flex-col bg-white/40 backdrop-blur-md border border-white/60 rounded-[8px] p-5 sm:p-7 md:p-8 relative transition-all duration-500 ease-premium hover:-translate-y-2 overflow-hidden text-left
                @if($subEvent->registration_button_state === 'open') hover:border-emerald-300 hover:shadow-[0_20px_40px_-15px_rgba(16,185,129,0.15)]
                @elseif($subEvent->registration_button_state === 'closed') hover:border-rose-300 hover:shadow-[0_20px_40px_-15px_rgba(244,63,94,0.15)]
                @else hover:border-amber-300 hover:shadow-[0_20px_40px_-15px_rgba(245,158,11,0.15)] @endif">
                <!-- Tech brackets on card hover -->
                <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-transparent group-hover:border-ember/60 transition-colors duration-500"></div>
                <div class="absolute bottom-0 right-0 w-3 h-3 border-b-2 border-r-2 border-transparent group-hover:border-ember/60 transition-colors duration-500"></div>

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3 sm:gap-4">
                    <span class="font-mono text-[11px] text-ember-dark bg-[#FFF3E5] border border-ember/10 px-2.5 py-1 rounded-[3px] font-semibold whitespace-nowrap">
                        @if($subEvent->date_start)
                        @if($subEvent->date_end && $subEvent->date_start != $subEvent->date_end)
                        {{ $subEvent->date_start->translatedFormat('j') }} s/d {{ $subEvent->date_end->translatedFormat('j M Y') }}
                        @else
                        {{ $subEvent->date_start->translatedFormat('j M Y') }}
                        @endif
                        @else
                        TBD
                        @endif
                    </span>

                    <span class="font-mono text-[10px] tracking-[0.06em] uppercase px-2.5 py-0.5 rounded-[4px] font-bold flex items-center gap-1.5 whitespace-nowrap border
                            @if($subEvent->registration_button_state === 'open') bg-emerald-50/70 text-emerald-700 border-emerald-200/50
                            @elseif($subEvent->registration_button_state === 'closed') bg-rose-50/70 text-rose-700 border-rose-200/50
                            @else bg-amber-50/70 text-amber-700 border-amber-200/50 @endif">
                        <span class="w-1.5 h-1.5 rounded-full inline-block 
                                @if($subEvent->registration_button_state === 'open') bg-emerald-500
                                @elseif($subEvent->registration_button_state === 'closed') bg-rose-500
                                @else bg-amber-500 @endif"></span>
                        @if($subEvent->registration_button_state === 'open')
                        Pendaftaran Buka
                        @elseif($subEvent->registration_button_state === 'closed')
                        Pendaftaran Tutup
                        @else
                        Segera Dibuka
                        @endif
                    </span>
                </div>

                <span class="text-[12px] tracking-wide text-ember-dark font-bold uppercase mb-2 block">{{ $subEvent->tagline }}</span>
                <h3 class="font-display text-[19px] sm:text-[22px] mb-2.5 leading-[1.3] text-ink group-hover:text-ember transition-colors duration-300 uppercase font-bold">{{ $subEvent->name }}</h3>
                <p class="text-[14px] sm:text-[14.5px] text-ink-soft leading-[1.65] mb-[22px]">{{ Str::limit($subEvent->description, 140) }}</p>

                <div class="font-mono text-[11px] tracking-wide text-ink-soft/80 border-t border-dashed border-line pt-4 mt-auto flex flex-col gap-1">
                    <div>
                        <span class="text-gold font-bold">DILAKSANAKAN</span> · {{ $subEvent->type }}
                    </div>
                    @if($subEvent->location)
                    <div>
                        <span class="text-gold font-bold">LOKASI</span> · {{ $subEvent->location }}
                    </div>
                    @endif
                </div>
            </a>
            @empty
            <div class="col-span-full py-16 text-center border border-dashed border-line rounded-[6px] bg-paper">
                <p class="font-display text-ink-soft text-[18px]">Rangkaian acara PARTI {{ session('active_year', config('parti.active_year', 2026)) }} sedang disiapkan.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- TIMELINE SECTION -->
<section class="py-14 md:py-20 bg-paper relative overflow-hidden" id="timeline">
    <!-- Ambient Background Glow -->
    <div class="absolute bottom-0 right-0 w-[300px] h-[300px] bg-gold/5 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="max-w-[1180px] mx-auto px-6 md:px-8 text-center md:text-left relative z-10">
        <span class="font-mono text-[12px] tracking-[0.22em] uppercase text-ember-dark flex items-center justify-center md:justify-start gap-2.5 before:content-[''] before:w-[22px] before:h-[1px] before:bg-ember-dark">
            Alur Waktu
        </span>
        <h2 class="font-display text-[26px] sm:text-[32px] md:text-[40px] mt-3.5 mb-10 md:mb-16 text-ink uppercase tracking-tight">Timeline PARTI {{ session('active_year', config('parti.active_year', 2026)) }}</h2>

        <div class="relative grid grid-cols-1 md:grid-cols-4 gap-10 md:gap-0 pl-4 md:pl-0">
            <!-- Line across desktop nodes -->
            <div class="hidden md:block absolute top-[9px] left-0 right-0 h-[3px] bg-gradient-to-r from-ember via-gold to-gold-soft/40 shadow-[0_0_8px_rgba(226,101,11,0.2)] z-0"></div>
            <!-- Line down mobile nodes -->
            <div class="block md:hidden absolute top-[10px] bottom-[10px] left-[9px] w-[3px] bg-gradient-to-b from-ember via-gold to-gold-soft/40 shadow-[0_0_8px_rgba(226,101,11,0.2)] z-0"></div>

            @forelse($timeline as $item)
            <div class="group relative pl-8 md:pl-0 pr-5 z-10 flex flex-col items-start text-left">
                <!-- Bullet Node -->
                <div class="absolute left-0 top-[2.5px] md:relative md:top-auto md:left-auto w-5 h-5 rounded-full bg-paper border-2 border-ember md:mb-6 z-20 transition-all duration-300 glowing-beacon group-hover:scale-110 group-hover:bg-ember-dark group-hover:border-ember"></div>

                <span class="font-mono text-[11px] text-ember-dark bg-[#FFF3E5] border border-ember/10 px-2.5 py-0.5 rounded-[3px] font-bold tracking-wider mb-3.5 inline-block">
                    {{ $item->date ? $item->date->translatedFormat('d M') : 'TBD' }}
                </span>
                <h4 class="font-display text-[16px] sm:text-[17px] mb-2 text-ink group-hover:text-ember transition-colors duration-300 font-bold uppercase">{{ $item->title }}</h4>
                <p class="text-[13px] sm:text-[13.5px] text-ink-soft leading-relaxed pr-2">{{ $item->description }}</p>
            </div>
            @empty
            <div class="col-span-full text-center py-8">
                <p class="text-ink-soft">Timeline belum diumumkan.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
