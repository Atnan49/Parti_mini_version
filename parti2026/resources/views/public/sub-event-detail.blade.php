@extends('layouts.public')

@section('title', $subEvent->name . ' — PARTI ' . config('parti.active_year', 2026))
@section('meta_description', $subEvent->tagline ?? $subEvent->name)
@section('og_title', $subEvent->name . ' — PARTI ' . config('parti.active_year', 2026))
@section('og_description', $subEvent->tagline ?? Str::limit($subEvent->description, 150))

@section('content')
<!-- DETAIL PAGE HEADER -->
<section class="relative bg-gradient-to-r from-paper-warm via-paper-warm/40 to-paper border-b border-line/60 py-16 md:py-24 overflow-hidden">
    <!-- Ambient Background Glows -->
    <div class="absolute top-0 right-0 w-[350px] h-[350px] bg-gold-soft/10 blur-[100px] rounded-full pointer-events-none animate-pulse-glow"></div>
    <div class="absolute bottom-0 left-0 w-[250px] h-[250px] bg-ember/5 blur-[80px] rounded-full pointer-events-none"></div>

    <div class="max-w-[1180px] mx-auto px-6 md:px-8 relative z-10">
        <div class="flex items-center gap-3.5 mb-6">
            <a href="{{ route('home') }}" class="font-mono text-[12px] text-ink-soft hover:text-ember transition-colors flex items-center gap-2 font-bold uppercase tracking-wider">
                ← Kembali ke Beranda
            </a>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <span class="font-mono text-[12px] tracking-[0.22em] uppercase text-ember-dark flex items-center gap-2.5 before:content-[''] before:w-[22px] before:h-[1px] before:bg-ember-dark">
                    Sub Acara
                </span>
                <h1 class="font-display font-bold text-[30px] sm:text-[36px] md:text-[52px] mt-4 mb-2 text-ink uppercase tracking-tight">
                    {{ $subEvent->name }}
                </h1>
                <p class="font-display text-[16px] sm:text-[17px] italic text-ink-soft border-l-2 border-gold pl-4 mt-2">
                    {{ $subEvent->tagline }}
                </p>
            </div>

            <div class="flex items-center gap-4 bg-paper border border-line/80 px-6 py-4 rounded-[6px] shadow-[0_4px_20px_-10px_rgba(28,20,11,0.05)]">
                <span class="font-mono text-[10px] tracking-[0.06em] uppercase px-3 py-1 rounded-[4px] font-bold flex items-center gap-1.5 whitespace-nowrap border
                    @if($subEvent->registration_button_state === 'open') bg-emerald-50/70 text-emerald-700 border-emerald-200/50
                    @elseif($subEvent->registration_button_state === 'closed') bg-rose-50/70 text-rose-700 border-rose-200/50
                    @else bg-amber-50/70 text-amber-700 border-amber-200/50 @endif">
                    <span class="w-2 h-2 rounded-full inline-block 
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
        </div>
    </div>
</section>

<!-- DETAIL CONTENT -->
<section class="py-20 bg-paper">
    <div class="max-w-[1180px] mx-auto px-6 md:px-8 grid grid-cols-1 md:grid-cols-[1.25fr_0.75fr] gap-12 md:gap-16">
        <!-- Left Column: Details -->
        <div>
            <h3 class="font-mono text-[12px] tracking-[0.15em] uppercase text-ember mb-5 block">Deskripsi Acara</h3>
            <div class="text-ink-soft leading-[1.8] text-[15px] sm:text-[16px] space-y-6">
                {!! nl2br(e($subEvent->description)) !!}
            </div>

            <!-- Downloadable Documents Section -->
            @if($subEvent->documents->isNotEmpty())
                <div class="mt-14 border border-line rounded-[4px] p-6 sm:p-8 bg-[#FAF6EE] text-left">
                    <h4 class="font-display font-semibold text-[18px] text-ink mb-4 flex items-center gap-2">
                        📄 Unduh Dokumen Template
                    </h4>
                    <p class="text-[13.5px] text-ink-soft mb-6 leading-relaxed">
                        Harap unduh dan lengkapi dokumen template di bawah ini sebelum melanjutkan ke formulir pendaftaran.
                    </p>
                    <div class="space-y-3.5">
                        @foreach($subEvent->documents as $doc)
                            <div class="flex items-center justify-between bg-paper border border-line p-3.5 rounded-[2px] gap-4">
                                <div class="flex items-center gap-3">
                                    <span class="font-mono text-[10px] bg-ember/14 text-ember px-2 py-0.5 rounded font-bold uppercase">
                                        {{ $doc->file_type }}
                                    </span>
                                    <span class="font-semibold text-[14.5px] text-ink">{{ $doc->label }}</span>
                                    <span class="text-[11.5px] text-ink-soft">({{ $doc->file_size_formatted }})</span>
                                </div>
                                <a href="{{ route('document.download', $doc->id) }}" class="font-mono text-[12px] text-ember hover:text-ember-dark font-semibold border-b border-ember hover:border-ember-dark pb-0.5">
                                    Unduh File ↓
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Right Column: Metadata & Action -->
        <div class="space-y-8 text-left">
            <!-- Registration Action Card -->
            <div class="bg-gradient-to-br from-[#FFFBF4] to-paper border border-line/80 rounded-[6px] p-6 sm:p-8 shadow-[0_4px_20px_-10px_rgba(28,20,11,0.06)]">
                <h4 class="font-display font-bold text-[18px] text-ink uppercase tracking-wider mb-5">Pendaftaran</h4>
                
                @if($subEvent->registration_button_state === 'open')
                    <a href="{{ $subEvent->gform_link }}" target="_blank" rel="noopener noreferrer" class="w-full text-center bg-gradient-to-r from-ember to-ember-dark text-white font-semibold text-[14.5px] px-[24px] py-[15px] rounded-[3px] inline-flex items-center justify-center gap-2.5 transition-all duration-300 hover:shadow-[0_12px_28px_-6px_rgba(226,101,11,0.5)] hover:-translate-y-0.5 active:translate-y-0">
                        Daftar Sekarang (Google Form)
                    </a>
                @elseif($subEvent->registration_button_state === 'closed')
                    <button disabled class="w-full text-center bg-ink-soft/10 text-ink-soft/40 font-semibold text-[14.5px] px-[24px] py-[15px] rounded-[3px] inline-flex items-center justify-center cursor-not-allowed border border-line/20">
                        Pendaftaran Ditutup
                    </button>
                @else
                    <button disabled class="w-full text-center bg-ink-soft/10 text-ink-soft/40 font-semibold text-[14.5px] px-[24px] py-[15px] rounded-[3px] inline-flex items-center justify-center cursor-not-allowed border border-line/20">
                        Segera Dibuka
                    </button>
                @endif
            </div>

            <!-- Event Details -->
            <div class="bg-paper border border-line rounded-[4px] p-6 sm:p-8 space-y-6">
                <div>
                    <h5 class="font-mono text-[10px] tracking-[0.1em] uppercase text-ink-soft mb-1.5">Pelaksanaan</h5>
                    <p class="font-semibold text-[14.5px] text-ink">
                        @if($subEvent->date_start)
                            @if($subEvent->date_end && $subEvent->date_start != $subEvent->date_end)
                                {{ $subEvent->date_start->translatedFormat('d M') }} s/d {{ $subEvent->date_end->translatedFormat('d M Y') }}
                            @else
                                {{ $subEvent->date_start->translatedFormat('d M Y') }}
                            @endif
                        @else
                            TBD (Akan Diumumkan)
                        @endif
                    </p>
                </div>

                @if($subEvent->htm_tiers)
                    <div>
                        <h5 class="font-mono text-[10px] tracking-[0.1em] uppercase text-ink-soft mb-1.5">Harga Tiket masuk</h5>
                        <div class="space-y-1.5">
                            @foreach($subEvent->htm_tiers as $tier)
                                <div class="flex justify-between items-center text-[14px]">
                                    <span class="text-ink-soft">{{ $tier['label'] }}</span>
                                    <span class="font-semibold text-ink">
                                        @if(empty($tier['price']) || $tier['price'] == 0)
                                            Gratis
                                        @else
                                            Rp {{ number_format($tier['price'], 0, ',', '.') }}
                                        @endif
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="space-y-4">
                    <div>
                        <h5 class="font-mono text-[10px] tracking-[0.1em] uppercase text-ink-soft mb-1.5 font-bold">Pelaksanaan Acara</h5>
                        <p class="font-semibold text-[14.5px] text-ink">
                            {{ $subEvent->type }}
                        </p>
                    </div>
                    @if($subEvent->location)
                        <div>
                            <h5 class="font-mono text-[10px] tracking-[0.1em] uppercase text-ink-soft mb-1.5 font-bold">Lokasi Tempat Acara</h5>
                            <p class="font-semibold text-[14.5px] text-ink">
                                {{ $subEvent->location }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
