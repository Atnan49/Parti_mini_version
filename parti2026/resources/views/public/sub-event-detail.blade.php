@extends('layouts.public')

@section('title', $subEvent->name . ' — PARTI ' . config('parti.active_year', 2026))
@section('meta_description', $subEvent->tagline ?? $subEvent->name)

@section('content')
<!-- DETAIL PAGE HEADER -->
<section class="bg-paper-warm border-b border-line py-16 md:py-24">
    <div class="max-w-[1180px] mx-auto px-8">
        <div class="flex items-center gap-3.5 mb-5.5">
            <a href="{{ route('home') }}" class="font-mono text-[12px] text-ink-soft hover:text-ember transition-colors flex items-center gap-2">
                ← Kembali ke Beranda
            </a>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <span class="font-mono text-[12px] tracking-[0.22em] uppercase text-ember-dark flex items-center gap-2.5 before:content-[''] before:w-[22px] before:h-[1px] before:bg-ember-dark">
                    Sub Acara
                </span>
                <h1 class="font-display font-bold text-[36px] md:text-[52px] mt-4 mb-2 text-ink uppercase">
                    {{ $subEvent->name }}
                </h1>
                <p class="font-display text-[17px] italic text-ink-soft">
                    {{ $subEvent->tagline }}
                </p>
            </div>

            <div class="flex items-center gap-4.5 bg-paper border border-line px-5 py-3.5 rounded-[4px]">
                <div class="w-2.5 h-2.5 rounded-full 
                    @if($subEvent->registration_button_state === 'open') bg-emerald-500
                    @elseif($subEvent->registration_button_state === 'closed') bg-rose-500
                    @else bg-amber-500 @endif"></div>
                <div class="text-left">
                    <div class="font-mono text-[10px] tracking-[0.05em] uppercase text-ink-soft">Status Pendaftaran</div>
                    <div class="font-semibold text-[14px]">
                        @if($subEvent->registration_button_state === 'open')
                            Pendaftaran Dibuka
                        @elseif($subEvent->registration_button_state === 'closed')
                            Pendaftaran Ditutup
                        @else
                            Segera Dibuka
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- DETAIL CONTENT -->
<section class="py-20 bg-paper">
    <div class="max-w-[1180px] mx-auto px-8 grid grid-cols-1 md:grid-cols-[1.25fr_0.75fr] gap-16">
        <!-- Left Column: Details -->
        <div>
            <h3 class="font-mono text-[12px] tracking-[0.15em] uppercase text-ember mb-5 block">Deskripsi Acara</h3>
            <div class="text-ink-soft leading-[1.8] text-[16px] space-y-6">
                {!! nl2br(e($subEvent->description)) !!}
            </div>

            <!-- Downloadable Documents Section -->
            @if($subEvent->documents->isNotEmpty())
                <div class="mt-14 border border-line rounded-[4px] p-6.5 bg-[#FAF6EE] text-left">
                    <h4 class="font-display font-semibold text-[18px] text-ink mb-4.5 flex items-center gap-2">
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
            <div class="bg-paper-warm border border-line rounded-[4px] p-7.5 shadow-sm">
                <h4 class="font-display font-bold text-[18px] text-ink mb-5">Pendaftaran</h4>
                
                @if($subEvent->registration_button_state === 'open')
                    <a href="{{ $subEvent->gform_link }}" target="_blank" rel="noopener noreferrer" class="w-full text-center bg-ember text-white font-semibold text-[14.5px] px-[24px] py-[15px] rounded-[2px] inline-flex items-center justify-center gap-2.5 transition-all duration-200 hover:bg-ember-dark hover:-translate-y-[1px] shadow-[0_10px_24px_-10px_rgba(226,101,11,0.55)]">
                        Daftar Sekarang (Google Form)
                    </a>
                @elseif($subEvent->registration_button_state === 'closed')
                    <button disabled class="w-full text-center bg-ink-soft/14 text-ink-soft/50 font-semibold text-[14.5px] px-[24px] py-[15px] rounded-[2px] inline-flex items-center justify-center cursor-not-allowed">
                        Pendaftaran Ditutup
                    </button>
                @else
                    <button disabled class="w-full text-center bg-ink-soft/14 text-ink-soft/50 font-semibold text-[14.5px] px-[24px] py-[15px] rounded-[2px] inline-flex items-center justify-center cursor-not-allowed">
                        Segera Dibuka
                    </button>
                @endif
            </div>

            <!-- Event Details -->
            <div class="bg-paper border border-line rounded-[4px] p-7.5 space-y-5.5">
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

                @if($subEvent->pj_names)
                    <div>
                        <h5 class="font-mono text-[10px] tracking-[0.1em] uppercase text-ink-soft mb-1.5">Penanggung Jawab</h5>
                        <p class="font-semibold text-[14.5px] text-ink">
                            {{ implode(' & ', $subEvent->pj_names) }}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
