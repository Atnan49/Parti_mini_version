@extends('layouts.public')

@section('title', 'PARTI ' . config('parti.active_year', 2026) . ' — Vanguard of Tech')

@section('content')
{{-- ponytail: all sections are placed directly here to avoid the overhead of multiple Blade component files --}}

<!-- HERO SECTION -->
<section class="relative py-24 md:py-32 overflow-hidden bg-paper">
    <div class="max-w-[1180px] mx-auto px-8 grid grid-cols-1 md:grid-cols-[1.15fr_0.85fr] gap-12 items-center">
        <div>
            <span class="font-mono text-[12px] tracking-[0.22em] uppercase text-ember-dark flex items-center gap-2.5 before:content-[''] before:w-[22px] before:h-[1px] before:bg-ember-dark">
                HIMATIF UMS — Medieval / Golden Heritage
            </span>
            <h1 class="font-display font-bold leading-[0.98] text-[46px] md:text-[84px] mt-5 mb-5.5 text-ink uppercase">
                VANGUARD<br><span class="text-ember">OF TECH</span>
            </h1>
            <p class="font-display text-[19px] italic text-ink-soft mb-5.5 border-l-2 border-gold pl-4 max-w-[46ch]">
                Memimpin perubahan menuju Digital Renaissance
            </p>
            <p class="text-[16px] leading-[1.75] text-ink-soft max-w-[52ch] mb-8.5">
                Dari benteng batu dan lembaran naskah, peradaban bermula. PARTI {{ config('parti.active_year', 2026) }} mengangkat
                semangat ksatria abad pertengahan sebagai metafora perjalanan teknologi masa kini —
                pencarian, keberanian, dan ketekunan dalam menghadapi tantangan zaman.
            </p>
            <div class="flex items-center gap-6">
                <a href="#sub-acara" class="bg-ember text-white font-semibold text-[14.5px] px-[30px] py-[15px] rounded-[2px] inline-flex items-center gap-2.5 transition-all duration-200 hover:bg-ember-dark hover:-translate-y-[1px] shadow-[0_10px_24px_-10px_rgba(226,101,11,0.55)]">
                    Jelajahi Sub Acara →
                </a>
                <a href="#maskot" class="font-mono text-[13px] text-ink-soft border-b border-line pb-[2px] transition-colors duration-200 hover:text-ember-dark hover:border-ember-dark">
                    Kenali Aurelius Vantor
                </a>
            </div>
        </div>

        <div class="relative flex items-center justify-center order-first md:order-none max-w-[260px] md:max-w-none mx-auto w-full">
            <div class="absolute w-[120%] h-[120%] border border-dashed border-gold-soft rounded-full animate-[spin_60s_linear_infinite]"></div>
            <svg class="w-full h-auto max-h-[340px]" width="300" height="340" viewBox="0 0 300 340" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M150 20 L260 55 V150 C260 230 210 290 150 320 C90 290 40 230 40 150 V55 L150 20Z" class="animate-[draw_2.2s_ease_forwards] [stroke-dasharray:1400] [stroke-dashoffset:1400]" stroke="#B0801E" stroke-width="2"/>
                <path d="M150 50 L235 78 V148 C235 212 195 260 150 285 C105 260 65 212 65 148 V78 L150 50Z" class="animate-[draw_2.2s_ease_forwards] [stroke-dasharray:1400] [stroke-dashoffset:1400]" stroke="#E2650B" stroke-width="1.5"/>
                <line x1="150" y1="90" x2="150" y2="240" class="animate-[draw_2.2s_ease_forwards] [stroke-dasharray:1400] [stroke-dashoffset:1400]" stroke="#E2650B" stroke-width="2"/>
                <line x1="112" y1="105" x2="188" y2="105" class="animate-[draw_2.2s_ease_forwards] [stroke-dasharray:1400] [stroke-dashoffset:1400]" stroke="#B0801E" stroke-width="1.5"/>
                <line x1="105" y1="140" x2="150" y2="120" class="animate-[draw_2.2s_ease_forwards] [stroke-dasharray:1400] [stroke-dashoffset:1400]" stroke="#B0801E" stroke-width="1.5"/>
                <line x1="195" y1="140" x2="150" y2="120" class="animate-[draw_2.2s_ease_forwards] [stroke-dasharray:1400] [stroke-dashoffset:1400]" stroke="#B0801E" stroke-width="1.5"/>
                <circle cx="150" cy="90" r="6" class="animate-[draw_2.2s_ease_forwards] [stroke-dasharray:1400] [stroke-dashoffset:1400]" stroke="#E2650B" stroke-width="2"/>
                <circle cx="112" cy="105" r="3" class="animate-[draw_2.2s_ease_forwards] [stroke-dasharray:1400] [stroke-dashoffset:1400]" stroke="#B0801E" stroke-width="1.5"/>
                <circle cx="188" cy="105" r="3" class="animate-[draw_2.2s_ease_forwards] [stroke-dasharray:1400] [stroke-dashoffset:1400]" stroke="#B0801E" stroke-width="1.5"/>
                <circle cx="105" cy="140" r="3" class="animate-[draw_2.2s_ease_forwards] [stroke-dasharray:1400] [stroke-dashoffset:1400]" stroke="#B0801E" stroke-width="1.5"/>
                <circle cx="195" cy="140" r="3" class="animate-[draw_2.2s_ease_forwards] [stroke-dasharray:1400] [stroke-dashoffset:1400]" stroke="#B0801E" stroke-width="1.5"/>
                <path d="M150 175 L165 210 L150 240 L135 210 Z" class="animate-[draw_2.2s_ease_forwards] [stroke-dasharray:1400] [stroke-dashoffset:1400]" stroke="#E2650B" stroke-width="2"/>
            </svg>
        </div>
    </div>
</section>


<!-- MASKOT SECTION -->
<section class="py-24 bg-paper" id="maskot">
    <div class="max-w-[1180px] mx-auto px-8 grid grid-cols-1 md:grid-cols-[0.85fr_1.15fr] gap-16 items-center">
        <div class="aspect-[1/1.15] bg-gradient-to-br from-[#FFF7EA] to-white border border-line rounded-[6px] relative flex items-center justify-center shadow-[0_30px_60px_-30px_rgba(180,80,10,0.28)] p-[14px]">
            <div class="absolute inset-[14px] border border-gold-soft rounded-[4px] pointer-events-none"></div>
            <svg class="w-[52%] h-auto" viewBox="0 0 200 240" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 10 L180 40 V115 C180 175 145 215 100 232 C55 215 20 175 20 115 V40 L100 10Z" stroke="#B0801E" stroke-width="2"/>
                <circle cx="100" cy="95" r="34" stroke="#E2650B" stroke-width="2"/>
                <path d="M76 95 Q100 65 124 95" stroke="#E2650B" stroke-width="2"/>
                <path d="M70 130 L130 130 L118 165 L82 165 Z" stroke="#B0801E" stroke-width="1.5"/>
                <line x1="60" y1="60" x2="45" y2="45" stroke="#B0801E" stroke-width="1.5"/>
                <line x1="140" y1="60" x2="155" y2="45" stroke="#B0801E" stroke-width="1.5"/>
            </svg>
        </div>
        <div>
            <span class="font-mono text-[12px] tracking-[0.22em] uppercase text-ember-dark flex items-center gap-2.5 before:content-[''] before:w-[22px] before:h-[1px] before:bg-ember-dark">
                Maskot Resmi
            </span>
            <h2 class="font-display text-[30px] md:text-[42px] mt-4 mb-2 text-ink">Aurelius Vantor</h2>
            <span class="font-mono text-[12px] tracking-[0.15em] text-ember-dark uppercase mb-5.5 block">
                Aurelius — kemuliaan &amp; cahaya keemasan · Vantor — vanguard, barisan terdepan
            </span>
            <p class="text-ink-soft leading-[1.75] mb-4 text-[15.5px]">
                Sosok muda berjubah kebesaran yang merepresentasikan pelopor era transformasi
                digital, terinspirasi dari figur ksatria abad pertengahan. Ia menjembatani dua
                zaman — dari benteng batu menuju jaringan digital — membawa nilai kepemimpinan,
                keberanian, dan tanggung jawab dalam memimpin perubahan.
            </p>
            <p class="text-ink-soft leading-[1.75] mb-4 text-[15.5px]">
                Aurelius Vantor berkomunikasi dengan nada tenang dan berwibawa, menyajikan
                pemahaman tentang peran generasi masa kini sebagai pelopor pembangun masa depan
                digital yang adaptif dan bijaksana.
            </p>
            <div class="mt-[26px] p-5 border-l-2 border-ember bg-paper-warm font-display italic text-[16px] text-ink">
                “Melampaui tembok benteng, memimpin arus Renaissance digital.”
            </div>
        </div>
    </div>
</section>

<!-- SPONSORS SECTION -->
@if($sponsors->isNotEmpty())
<section class="py-16 bg-paper border-t border-line">
    <div class="max-w-[1180px] mx-auto px-8 text-center">
        <span class="font-mono text-[11px] tracking-[0.15em] uppercase text-ember-dark mb-8 block">Didukung Oleh</span>
        
        <!-- Group Sponsors by Tier -->
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
<section class="bg-paper-warm border-t border-line py-24" id="sub-acara">
    <div class="max-w-[1180px] mx-auto px-8">
        <div class="flex justify-between items-end mb-[52px] flex-wrap gap-5 text-left">
            <div>
                <span class="font-mono text-[12px] tracking-[0.22em] uppercase text-ember-dark flex items-center gap-2.5 before:content-[''] before:w-[22px] before:h-[1px] before:bg-ember-dark">
                    Rangkaian Acara
                </span>
                <h2 class="font-display text-[30px] md:text-[40px] mt-3.5 text-ink">Empat Sub Acara</h2>
            </div>
            <p class="text-ink-soft max-w-[40ch] text-[14.5px]">
                Dari pembuka hingga penutup, setiap sub acara dirancang saling menopang — secara jadwal maupun pendanaan.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5.5">
            @forelse($subEvents as $subEvent)
                <a href="{{ route('sub-event.show', $subEvent->slug) }}" class="card block bg-paper border border-line rounded-[4px] p-[30px] relative transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_26px_46px_-28px_rgba(28,20,11,0.25)] before:content-[''] before:absolute before:top-0 before:left-0 before:w-[3px] before:h-0 before:bg-ember before:transition-all before:duration-300 hover:before:h-full overflow-hidden text-left">
                    <div class="flex justify-between items-start mb-[18px] gap-2">
                        <span class="font-mono text-[12px] text-ember-dark bg-[#FDEEDD] px-2.5 py-1 rounded-[2px] whitespace-nowrap">
                            @if($subEvent->date_start)
                                @if($subEvent->date_end && $subEvent->date_start != $subEvent->date_end)
                                    {{ $subEvent->date_start->translatedFormat('j') }}–{{ $subEvent->date_end->translatedFormat('j M Y') }}
                                @else
                                    {{ $subEvent->date_start->translatedFormat('j M Y') }}
                                @endif
                            @else
                                TBD
                            @endif
                        </span>
                        
                        <span class="font-mono text-[10.5px] tracking-[0.06em] uppercase text-ink-soft flex items-center gap-1.5 whitespace-nowrap">
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

                    <span class="text-[12.5px] text-ember-dark font-semibold mb-3 block">{{ $subEvent->tagline }}</span>
                    <h3 class="font-display text-[21px] mb-1.5 leading-[1.3] text-ink">{{ $subEvent->name }}</h3>
                    <p class="text-[14.5px] text-ink-soft leading-[1.65] mb-[18px]">{{ Str::limit($subEvent->description, 140) }}</p>
                    
                    @if($subEvent->pj_names)
                        <div class="font-mono text-[11.5px] text-ink-soft border-t border-dashed border-line pt-3.5 mt-2">
                            PJ · {{ implode(' & ', $subEvent->pj_names) }}
                        </div>
                    @endif
                </a>
            @empty
                <div class="col-span-2 py-16 text-center border border-dashed border-line rounded-[4px] bg-paper">
                    <p class="font-display text-ink-soft text-[18px]">Rangkaian acara PARTI {{ config('parti.active_year', 2026) }} sedang disiapkan.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- TIMELINE SECTION -->
<section class="py-24 bg-paper" id="timeline">
    <div class="max-w-[1180px] mx-auto px-8 text-left">
        <span class="font-mono text-[12px] tracking-[0.22em] uppercase text-ember-dark flex items-center gap-2.5 before:content-[''] before:w-[22px] before:h-[1px] before:bg-ember-dark">
            Alur Waktu
        </span>
        <h2 class="font-display text-[30px] md:text-[40px] mt-3.5 mb-12 text-ink">Timeline PARTI {{ config('parti.active_year', 2026) }}</h2>

        <div class="relative grid grid-cols-1 md:grid-cols-4 mt-[60px] gap-6 md:gap-0">
            <!-- Line across desktop nodes -->
            <div class="hidden md:block absolute top-[9px] left-0 right-0 h-[1px] bg-line z-0"></div>

            @forelse($timeline as $item)
                <div class="relative pr-5 z-10">
                    <div class="w-[18px] h-[18px] rounded-full bg-paper border-2 border-ember mb-5.5 z-20 relative"></div>
                    <span class="font-mono text-[12px] text-ember-dark mb-2 block font-semibold">
                        {{ $item->date ? $item->date->translatedFormat('d M') : 'TBD' }}
                    </span>
                    <h4 class="font-display text-[16.5px] mb-1.5 text-ink">{{ $item->title }}</h4>
                    <p class="text-[13px] text-ink-soft leading-[1.6]">{{ $item->description }}</p>
                </div>
            @empty
                <div class="col-span-4 text-center py-8">
                    <p class="text-ink-soft">Timeline belum diumumkan.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
