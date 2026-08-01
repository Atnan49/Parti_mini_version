{{--
  Komponen: Section Sponsor Bertingkat
  Tujuan: Menampilkan daftar mitra/sponsor yang dikelompokkan per tier (Platinum, Gold,
  Silver, & Bronze) dengan hierarki visual terpisah. Baris pertama menyajikan Platinum & Gold
  dengan ukuran kartu lebih besar, sedangkan baris kedua menyajikan Silver & Bronze secara mengalir.
--}}

@props([
    'sponsors' => collect()
])

@php
    $platinumSponsors = $sponsors->where('tier', \App\Models\Sponsor::TIER_PLATINUM);
    $goldSponsors = $sponsors->where('tier', \App\Models\Sponsor::TIER_GOLD);
    $silverBronzeSponsors = $sponsors->whereIn('tier', [\App\Models\Sponsor::TIER_SILVER, \App\Models\Sponsor::TIER_BRONZE]);

    $line1Sponsors = $platinumSponsors->concat($goldSponsors);
    $line2Sponsors = $silverBronzeSponsors;

    $hasAnySponsors = $sponsors->isNotEmpty();
@endphp


@if($hasAnySponsors)
<section class="py-4 sm:py-8 px-2.5 sm:px-4 max-w-[1140px] mx-auto z-10 relative" id="mitra-sponsor">
    <div class="ios-glass rounded-[24px] sm:rounded-[32px] p-4 sm:p-8 md:p-10 text-center relative overflow-hidden">
        
        <!-- Judul Section -->
        <div class="mb-4 sm:mb-8">
            <span class="font-mono text-[9.5px] sm:text-[11px] tracking-[0.2em] uppercase text-ember flex items-center justify-center gap-2 before:content-[''] before:w-[14px] sm:before:w-[20px] before:h-[1px] before:bg-ember after:content-[''] after:w-[14px] sm:after:w-[20px] after:h-[1px] after:bg-ember font-bold">
                Kemitraan & Kolaborasi
            </span>
            <h2 class="font-display font-bold text-[18px] sm:text-[28px] md:text-[34px] mt-1.5 sm:mt-2 text-ink uppercase tracking-tight">
                DIDUKUNG OLEH
            </h2>
        </div>

        <!-- Kontainer Utama Running Marquee Sponsor -->
        <div class="space-y-3.5 sm:space-y-5">
            
            <!-- BARIS 1: Sponsor Utama Platinum (Paling Kiri + Link Website) & Gold -->
            @if($line1Sponsors->isNotEmpty())
            <div class="logoloop-container logoloop-fade-mask py-1.5 sm:py-2">
                <div class="inline-flex items-center gap-3.5 sm:gap-6 animate-logoloop-left whitespace-nowrap">
                    <!-- Salinan Jalur 1 (Trek Asli) -->
                    <div class="flex items-center gap-3.5 sm:gap-6">
                        @foreach($line1Sponsors as $sponsor)
                            <x-sponsor-card :sponsor="$sponsor" 
                                            :size="$sponsor->tier === \App\Models\Sponsor::TIER_PLATINUM ? 'large' : 'medium'" 
                                            :isFeatured="$sponsor->tier === \App\Models\Sponsor::TIER_PLATINUM" 
                                            loading="eager" />
                        @endforeach
                    </div>

                    <!-- Salinan Jalur 2 (Pengulangan Animasi Tanpa Putus) -->
                    <div class="flex items-center gap-3.5 sm:gap-6" aria-hidden="true">
                        @foreach($line1Sponsors as $sponsor)
                            <x-sponsor-card :sponsor="$sponsor" 
                                            :size="$sponsor->tier === \App\Models\Sponsor::TIER_PLATINUM ? 'large' : 'medium'" 
                                            :isFeatured="$sponsor->tier === \App\Models\Sponsor::TIER_PLATINUM" 
                                            loading="lazy" />
                        @endforeach
                    </div>

                    <!-- Salinan Jalur 3 (Jangkauan Layar Lebar) -->
                    <div class="flex items-center gap-3.5 sm:gap-6" aria-hidden="true">
                        @foreach($line1Sponsors as $sponsor)
                            <x-sponsor-card :sponsor="$sponsor" 
                                            :size="$sponsor->tier === \App\Models\Sponsor::TIER_PLATINUM ? 'large' : 'medium'" 
                                            :isFeatured="$sponsor->tier === \App\Models\Sponsor::TIER_PLATINUM" 
                                            loading="lazy" />
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- BARIS 2: Sponsor Pendukung Silver & Bronze (Mengalir di Baris Bawah) -->
            @if($line2Sponsors->isNotEmpty())
            <div class="logoloop-container logoloop-fade-mask py-1.5 sm:py-2 border-t border-line/30 pt-3 sm:pt-4">
                <div class="inline-flex items-center gap-3 sm:gap-5 animate-logoloop-left-fast whitespace-nowrap">
                    <!-- Salinan Jalur 1 (Trek Asli) -->
                    <div class="flex items-center gap-3 sm:gap-5">
                        @foreach($line2Sponsors as $sponsor)
                            <x-sponsor-card :sponsor="$sponsor" size="small" loading="lazy" />
                        @endforeach
                    </div>

                    <!-- Salinan Jalur 2 (Pengulangan Animasi Tanpa Putus) -->
                    <div class="flex items-center gap-3 sm:gap-5" aria-hidden="true">
                        @foreach($line2Sponsors as $sponsor)
                            <x-sponsor-card :sponsor="$sponsor" size="small" loading="lazy" />
                        @endforeach
                    </div>

                    <!-- Salinan Jalur 3 (Jangkauan Layar Lebar) -->
                    <div class="flex items-center gap-3 sm:gap-5" aria-hidden="true">
                        @foreach($line2Sponsors as $sponsor)
                            <x-sponsor-card :sponsor="$sponsor" size="small" loading="lazy" />
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

        </div>

    </div>
</section>
@endif
