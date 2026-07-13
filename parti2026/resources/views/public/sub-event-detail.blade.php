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

            <!-- Share Event Card -->
            <div class="bg-paper border border-line rounded-[4px] p-6 sm:p-8 space-y-4">
                <h5 class="font-mono text-[11px] tracking-[0.1em] uppercase text-ember font-bold">Bagikan Acara</h5>
                <p class="text-[13px] text-ink-soft leading-relaxed">
                    Ajak rekan-rekanmu untuk bergabung dengan membagikan informasi acara ini!
                </p>
                <div class="flex flex-wrap gap-2.5">
                    <!-- WhatsApp -->
                    <a href="https://api.whatsapp.com/send?text={{ rawurlencode($subEvent->name . ' — PARTI ' . config('parti.active_year', 2026) . ': ' . request()->url()) }}" 
                       target="_blank" rel="noopener noreferrer" 
                       class="flex items-center justify-center w-10 h-10 rounded-full border border-line hover:border-emerald-500 hover:bg-emerald-50 text-ink-soft hover:text-emerald-600 transition-colors"
                       title="Bagikan ke WhatsApp">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.012 2c-5.506 0-9.989 4.478-9.99 9.984a9.96 9.96 0 001.335 4.992L2 22l5.163-1.355a9.95 9.95 0 004.847 1.256h.004c5.507 0 9.99-4.478 9.99-9.986 0-2.67-1.037-5.178-2.924-7.065A9.92 9.92 0 0012.012 2zm5.836 14.16c-.32.9-1.859 1.76-2.548 1.83-.58.06-1.34.1-3.83-.93-3.19-1.32-5.25-4.57-5.41-4.79-.16-.22-1.28-1.71-1.28-3.26 0-1.55.81-2.31 1.1-2.61.29-.3.63-.38.84-.38.21 0 .42 0 .61.01.2.01.47-.08.73.56.27.65.91 2.24.99 2.4.08.16.13.35.03.55-.1.2-.15.3-.3.48-.15.18-.32.4-.46.54-.15.15-.31.31-.13.62.18.3.79 1.3 1.69 2.1 1.16 1.03 2.13 1.35 2.43 1.5.3.15.48.13.66-.08.18-.22.79-.92 1.01-1.23.21-.32.43-.27.73-.16.3.11 1.91.9 2.24 1.06.33.16.55.24.63.38.08.14.08.82-.24 1.72z"/>
                        </svg>
                    </a>
                    <!-- Twitter / X -->
                    <a href="https://twitter.com/intent/tweet?text={{ rawurlencode($subEvent->name . ' — PARTI ' . config('parti.active_year', 2026)) }}&url={{ rawurlencode(request()->url()) }}" 
                       target="_blank" rel="noopener noreferrer" 
                       class="flex items-center justify-center w-10 h-10 rounded-full border border-line hover:border-sky-500 hover:bg-sky-50 text-ink-soft hover:text-sky-600 transition-colors"
                       title="Bagikan ke X">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>
                    <!-- Telegram -->
                    <a href="https://t.me/share/url?url={{ rawurlencode(request()->url()) }}&text={{ rawurlencode($subEvent->name . ' — PARTI ' . config('parti.active_year', 2026)) }}" 
                       target="_blank" rel="noopener noreferrer" 
                       class="flex items-center justify-center w-10 h-10 rounded-full border border-line hover:border-blue-400 hover:bg-blue-50 text-ink-soft hover:text-blue-500 transition-colors"
                       title="Bagikan ke Telegram">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.99-.65-.35-1.01.22-1.59.15-.15 2.71-2.48 2.76-2.69.01-.03.01-.14-.07-.2-.08-.06-.19-.04-.27-.02-.12.02-1.96 1.24-5.54 3.65-.52.36-.99.53-1.41.52-.46-.01-1.35-.26-2.01-.48-.81-.27-1.46-.42-1.4-.89.03-.25.38-.51 1.07-.78 4.2-1.83 7-3.04 8.4-3.63 4-.16 4.83.69 4.84.81z"/>
                        </svg>
                    </a>
                    <!-- Copy Link Button -->
                    <div x-data="{ copied: false }">
                        <button @click="navigator.clipboard.writeText('{{ request()->url() }}').then(() => { copied = true; setTimeout(() => copied = false, 2000) })"
                                class="flex items-center justify-center w-10 h-10 rounded-full border border-line text-ink-soft hover:bg-paper-warm transition-all"
                                :class="copied ? 'border-emerald-500 text-emerald-600 bg-emerald-50' : 'hover:border-ember hover:text-ember'"
                                :title="copied ? 'Tautan disalin!' : 'Salin Tautan'">
                            <!-- Copy icon -->
                            <svg x-show="!copied" class="w-5 h-5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <rect width="14" height="14" x="8" y="8" rx="2" ry="2"></rect>
                                <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"></path>
                            </svg>
                            <!-- Success Check icon -->
                            <svg x-show="copied" x-cloak class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </button>
                    </div>
                </div>
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
</section>

{{-- ponytail: Structured Data for Google Event Rich Snippets --}}
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Event",
  "name": "{{ $subEvent->name }}",
  "startDate": "{{ $subEvent->date_start ? $subEvent->date_start->toIso8601String() : '' }}",
  "endDate": "{{ $subEvent->date_end ? $subEvent->date_end->toIso8601String() : ($subEvent->date_start ? $subEvent->date_start->toIso8601String() : '') }}",
  "eventAttendanceMode": "https://schema.org/{{ $subEvent->type === 'ONLINE' ? 'OnlineEventAttendanceMode' : ($subEvent->type === 'OFFLINE' ? 'OfflineEventAttendanceMode' : 'MixedEventAttendanceMode') }}",
  "eventStatus": "https://schema.org/EventScheduled",
  "location": {
    "@type": "{{ $subEvent->type === 'ONLINE' ? 'VirtualLocation' : 'Place' }}",
    @if($subEvent->type === 'ONLINE')
    "url": "{{ $subEvent->gform_link ?? request()->url() }}"
    @else
    "name": "{{ $subEvent->location ?? 'Universitas Muhammadiyah Surakarta' }}",
    "address": {
      "@type": "PostalAddress",
      "addressLocality": "Surakarta",
      "addressRegion": "Jawa Tengah",
      "addressCountry": "ID"
    }
    @endif
  },
  "image": [
    "{{ asset('logo.png') }}"
  ],
  "description": "{{ Str::limit(strip_tags($subEvent->description), 160) }}",
  "organizer": {
    "@type": "Organization",
    "name": "HIMATIF UMS",
    "url": "https://www.instagram.com/himatifums/"
  }
}
</script>
@endsection

