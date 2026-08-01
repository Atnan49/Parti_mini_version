{{--
  Komponen: Kartu Sponsor Individual
  Tujuan: Menampilkan logo atau badge nama sponsor secara terisolasi.
  Mendukung tiga varian ukuran (large, medium, small), status unggulan (isFeatured),
  serta interaksi hover/tap dengan tooltip nama sponsor dan opsi navigasi tautan luar.
--}}

@props([
    'sponsor',
    'size' => 'medium',
    'loading' => 'lazy',
    'isFeatured' => false
])

@php
    $sizeClasses = [
        'large' => 'px-4 sm:px-6 py-2.5 sm:py-3.5 min-h-[48px] sm:min-h-[58px] min-w-[130px] sm:min-w-[160px] rounded-xl sm:rounded-2xl border-gold/40 bg-gold/5 dark:bg-gold/10 shadow-sm',
        'medium' => 'px-3.5 sm:px-5 py-2 sm:py-3 min-h-[42px] sm:min-h-[50px] min-w-[110px] sm:min-w-[130px] rounded-lg sm:rounded-xl border-line/60 bg-white/40 dark:bg-white/[0.04]',
        'small' => 'px-3 sm:px-4 py-1.5 sm:py-2.5 min-h-[36px] sm:min-h-[44px] min-w-[95px] sm:min-w-[110px] rounded-md sm:rounded-lg border-line/40 bg-white/30 dark:bg-white/[0.02]',
    ];

    $imgClasses = [
        'large' => 'h-[28px] sm:h-[40px]',
        'medium' => 'h-[22px] sm:h-[32px]',
        'small' => 'h-[18px] sm:h-[25px]',
    ];

    $hasUrl = !empty($sponsor->website_url);
    
    // Periksa apakah file gambar logo fisik tersedia dan valid
    $hasValidLogo = false;
    if (!empty($sponsor->logo_path)) {
        $fullPath = storage_path('app/public/' . $sponsor->logo_path);
        if (file_exists($fullPath) && filesize($fullPath) > 20) {
            $hasValidLogo = true;
        }
    }
@endphp

<div class="relative group/card shrink-0 inline-flex items-center"
     x-data="{ isHovered: false }"
     @mouseenter="isHovered = true"
     @mouseleave="isHovered = false"
     @focusin="isHovered = true"
     @focusout="isHovered = false"
     @touchstart="isHovered = true"
     @click.away="isHovered = false">

    <!-- Tooltip Melayang (Nama Sponsor Saat Di-hover / Di-tap) -->
    <div x-show="isHovered"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-1 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-1 scale-95"
         x-cloak
         class="absolute -top-9 sm:-top-10 left-1/2 -translate-x-1/2 z-40 pointer-events-none whitespace-nowrap">
        <div class="bg-paper-warm dark:bg-black/95 text-ink text-[9.5px] sm:text-[10.5px] font-mono px-2.5 sm:px-3 py-0.5 sm:py-1 rounded-lg border border-gold/40 shadow-xl flex items-center gap-1.5">
            <span class="w-1.5 h-1.5 rounded-full bg-ember animate-pulse"></span>
            <span class="font-bold">{{ $sponsor->name }}</span>
            @if($isFeatured)
                <span class="text-[9px] text-gold uppercase tracking-wider font-semibold">★</span>
            @endif
        </div>
        <div class="w-2 h-2 bg-paper-warm dark:bg-black/95 border-r border-b border-gold/40 rotate-45 mx-auto -mt-1"></div>
    </div>

    <!-- Kartu Sponsor (Navigasi Link Website / Kotak Tampilan) -->
    <{{ $hasUrl ? 'a' : 'div' }}
        @if($hasUrl)
            href="{{ $sponsor->website_url }}"
            target="_blank"
            rel="noopener sponsored"
        @endif
        tabindex="0"
        :class="{
            '-translate-y-0.5 sm:-translate-y-1 scale-105 shadow-md border-gold/50 bg-white/90 dark:bg-white/[0.09]': isHovered,
            '{{ $sizeClasses[$size] }}': !isHovered
        }"
        class="{{ $sizeClasses[$size] }} flex items-center justify-center relative border transition-all duration-300 cursor-pointer focus:outline-none focus:ring-2 focus:ring-ember/50">
        
        @if($hasValidLogo)
            <img src="{{ $sponsor->logo_url }}" 
                 alt="{{ $sponsor->name }}" 
                 loading="{{ $loading }}"
                 :class="{
                    'grayscale-0 opacity-100 scale-105': isHovered,
                    'grayscale contrast-125 opacity-75 sm:opacity-80': !isHovered
                 }"
                 class="{{ $imgClasses[$size] }} w-auto max-w-[100px] sm:max-w-[140px] object-contain transition-all duration-300 filter-gpu">
        @else
            <div class="flex items-center gap-1.5 sm:gap-2 px-0.5 sm:px-1">
                <span class="w-1.5 h-1.5 rounded-full bg-gold/80 transition-colors" :class="{ 'bg-ember': isHovered }"></span>
                <span :class="{ 'text-ember': isHovered, 'text-ink font-bold': !isHovered }"
                      class="font-mono text-[10.5px] sm:text-[12.5px] uppercase tracking-wider transition-colors text-center whitespace-nowrap">
                    {{ $sponsor->name }}
                </span>
            </div>
        @endif
    </{{ $hasUrl ? 'a' : 'div' }}>
</div>
