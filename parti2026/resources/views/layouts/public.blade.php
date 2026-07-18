<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'PARTI ' . config('parti.active_year', 2026) . ' | Vanguard of Tech')</title>
    <meta name="description" content="@yield('meta_description', 'Website PARTI ' . config('parti.active_year', 2026) . ' UMS | Vanguard of Tech, platform informasi dan pendaftaran rangkaian acara HIMATIF UMS.')">

    <!-- Open Graph / Facebook SEO -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:site_name" content="PARTI {{ config('parti.active_year', 2026) }} UMS">
    <meta property="og:title" content="@yield('og_title', 'PARTI ' . config('parti.active_year', 2026) . ' | Vanguard of Tech')">
    <meta property="og:description" content="@yield('og_description', 'Website PARTI ' . config('parti.active_year', 2026) . ' UMS | Vanguard of Tech, platform informasi dan pendaftaran rangkaian acara HIMATIF UMS.')">
    <meta property="og:image" content="@yield('og_image', asset('logo.png'))">

    <!-- Twitter SEO -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ request()->url() }}">
    <meta property="twitter:title" content="@yield('og_title', 'PARTI ' . config('parti.active_year', 2026) . ' | Vanguard of Tech')">
    <meta property="twitter:description" content="@yield('og_description', 'Website PARTI ' . config('parti.active_year', 2026) . ' UMS | Vanguard of Tech, platform informasi dan pendaftaran rangkaian acara HIMATIF UMS.')">
    <meta property="twitter:image" content="@yield('og_image', asset('logo.png'))">
    @if(config('parti.seo.twitter_handle'))
    <meta property="twitter:site" content="{{ config('parti.seo.twitter_handle') }}">
    <meta property="twitter:creator" content="{{ config('parti.seo.twitter_handle') }}">
    @endif

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;900&family=Cinzel+Decorative:wght@700;900&family=Work+Sans:wght@400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

    <!-- Styles and Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body x-data="{ isPageLoaded: false, showSplash: true }" 
      x-init="window.addEventListener('load', () => {
          setTimeout(() => { isPageLoaded = true; }, 100);
          setTimeout(() => { showSplash = false; }, 1500);
      })"
      class="bg-paper text-ink font-body antialiased overflow-x-hidden">

    <!-- Splash Screen Loader -->
    <!-- ponytail: elegant page load animation with logo sliding to top-left -->
    <div x-show="showSplash" 
         x-cloak
         class="fixed inset-0 z-[100] flex items-center justify-center bg-[#FDF9F1] transition-opacity duration-[1000ms] ease-premium"
         :class="isPageLoaded ? 'opacity-0 pointer-events-none' : 'opacity-100'">
        <div class="flex flex-col items-center gap-4 transition-all duration-[1200ms] ease-premium"
             :class="isPageLoaded ? '-translate-x-[calc(50vw-120px)] -translate-y-[calc(50vh-50px)] scale-[0.25] opacity-0' : 'scale-100 opacity-100'">
            <img src="{{ asset('logo.png') }}" alt="Logo PARTI" class="h-24 w-auto drop-shadow-[0_10px_25px_rgba(176,128,30,0.15)] animate-pulse-glow">
            <span class="font-display font-semibold text-[26px] tracking-[0.2em] text-ink uppercase">PARTI {{ config('parti.active_year', 2026) }}</span>
        </div>
    </div>

    <!-- Navbar -->
    <nav x-data="{ mobileMenuOpen: false }" 
         class="sticky top-0 z-50 bg-white/70 backdrop-blur-lg border-b border-line/60 shadow-[0_2px_20px_-10px_rgba(28,20,11,0.05)] transition-all duration-[1000ms] ease-premium transform"
         :class="isPageLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 -translate-y-4'">
        <div class="w-full mx-auto px-6 md:px-12 xl:px-20 py-4 md:py-6 flex items-center justify-between">
            <a href="{{ route('home') }}" class="font-display-decorative font-bold text-[18px] sm:text-[21px] text-ink flex items-center gap-2.5 hover:opacity-90 transition-opacity">
                {{-- ponytail: replaced pulsing dot with brand logo --}}
                <img src="{{ asset('logo.png') }}" alt="Logo PARTI" class="h-7 sm:h-8 w-auto">
                PARTI {{ config('parti.active_year', 2026) }}
            </a>
            
            <div class="hidden md:flex gap-[38px] text-[15px] font-medium text-ink-soft">
                <a href="{{ route('home') }}#tentang" class="hover:text-ember transition-colors relative py-1.5 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] after:bg-ember after:transition-all after:duration-300 hover:after:w-full">Tentang</a>
                <a href="{{ route('home') }}#sub-acara" class="hover:text-ember transition-colors relative py-1.5 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] after:bg-ember after:transition-all after:duration-300 hover:after:w-full">Sub Acara</a>
                <a href="{{ route('home') }}#timeline" class="hover:text-ember transition-colors relative py-1.5 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] after:bg-ember after:transition-all after:duration-300 hover:after:w-full">Timeline</a>
            </div>

            <a class="hidden md:inline-block font-mono text-[12px] tracking-[0.05em] uppercase border border-ink/80 px-[20px] py-[10px] rounded-[2px] transition-all duration-300 hover:bg-ink hover:text-white" href="{{ route('home') }}#sub-acara">
                Lihat Acara
            </a>

            <!-- Hamburger Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-ink focus:outline-none p-1.5 hover:text-ember transition-colors animate-fade-in" aria-label="Toggle Menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileMenuOpen" 
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="md:hidden bg-white/95 backdrop-blur-lg border-b border-line/60 py-4 px-6 shadow-inner animate-fade-in">
            <div class="flex flex-col gap-4 text-[15px] font-medium text-ink-soft">
                <a href="{{ route('home') }}#tentang" @click="mobileMenuOpen = false" class="hover:text-ember py-2 border-b border-line/30 transition-colors">Tentang</a>
                <a href="{{ route('home') }}#sub-acara" @click="mobileMenuOpen = false" class="hover:text-ember py-2 border-b border-line/30 transition-colors">Sub Acara</a>
                <a href="{{ route('home') }}#timeline" @click="mobileMenuOpen = false" class="hover:text-ember py-2 border-b border-line/30 transition-colors">Timeline</a>
                <a class="font-mono text-[12px] tracking-[0.05em] uppercase border border-ink/80 px-[20px] py-[10px] rounded-[2px] text-center mt-2 hover:bg-ink hover:text-white transition-all duration-300" href="{{ route('home') }}#sub-acara" @click="mobileMenuOpen = false">
                    Lihat Acara
                </a>
            </div>
        </div>
    </nav>



    <!-- Main Content -->
    <main class="transition-all duration-[1000ms] ease-premium transform delay-[300ms]"
          :class="isPageLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-ink text-[#F4EBDB] pt-16 pb-[34px] transition-opacity duration-[1000ms] ease-premium delay-[500ms]"
            :class="isPageLoaded ? 'opacity-100' : 'opacity-0'">
        <div class="w-full mx-auto px-6 md:px-12 xl:px-20">
            <div class="flex flex-col md:flex-row justify-between items-start pb-11 border-b border-[#F4EBDB]/14 gap-8">
                <div>
                    <div class="font-display-decorative text-[22px] font-bold flex items-center gap-2.5">
                        {{-- ponytail: added brand logo in the footer --}}
                        <img src="{{ asset('logo.png') }}" alt="Logo PARTI" class="h-8 w-auto">
                        PARTI <span class="text-ember">{{ config('parti.active_year', 2026) }}</span>
                    </div>
                    <p class="text-[13px] text-[#B8A98D] mt-2.5 max-w-[32ch]">Vanguard of Tech | HIMATIF Universitas Muhammadiyah Surakarta.</p>
                </div>
                <div class="flex flex-wrap gap-12 sm:gap-16">
                    <div class="text-left">
                        <h5 class="font-mono text-[11px] tracking-[0.12em] uppercase text-ember mb-3.5">Acara</h5>
                        @forelse($footerSubEvents as $sub)
                            <a href="{{ route('sub-event.show', $sub->slug) }}" class="block text-[13.5px] text-[#D8CAB2] mb-2.5 hover:text-white transition-colors">{{ $sub->name }}</a>
                        @empty
                            <a href="#sub-acara" class="block text-[13.5px] text-[#D8CAB2] mb-2.5 hover:text-white transition-colors">Lihat Semua Acara</a>
                        @endforelse
                    </div>
                    <div class="text-left">
                        <h5 class="font-mono text-[11px] tracking-[0.12em] uppercase text-ember mb-3.5">Jelajah</h5>
                        <a href="#tentang" class="block text-[13.5px] text-[#D8CAB2] mb-2.5 hover:text-white transition-colors">Tentang</a>
                        <a href="#timeline" class="block text-[13.5px] text-[#D8CAB2] mb-2.5 hover:text-white transition-colors">Timeline</a>
                    </div>
                    <div class="text-left font-sans">
                        <h5 class="font-mono text-[11px] tracking-[0.12em] uppercase text-ember mb-3.5">Media Sosial PARTI</h5>
                        @if(config('parti.socials.parti.instagram'))
                            <a href="{{ config('parti.socials.parti.instagram') }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-[13.5px] text-[#D8CAB2] mb-2.5 hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"></path>
                                    <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                                </svg>
                                Instagram
                            </a>
                        @endif
                        @if(config('parti.socials.parti.tiktok'))
                            <a href="{{ config('parti.socials.parti.tiktok') }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-[13.5px] text-[#D8CAB2] mb-2.5 hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"></path>
                                </svg>
                                TikTok
                            </a>
                        @endif
                    </div>
                    <div class="text-left font-sans">
                        <h5 class="font-mono text-[11px] tracking-[0.12em] uppercase text-ember mb-3.5">Media Sosial HIMATIF</h5>
                        @if(config('parti.socials.himatif.instagram'))
                            <a href="{{ config('parti.socials.himatif.instagram') }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-[13.5px] text-[#D8CAB2] mb-2.5 hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"></path>
                                    <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                                </svg>
                                Instagram
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="pt-7 flex flex-col md:flex-row justify-between text-[12px] text-[#A29377] gap-2.5">
                <span>© {{ config('parti.active_year', 2026) }} HIMATIF UMS. Seluruh hak cipta dilindungi.</span>
                <span>Golden Heritage Edition</span>
            </div>
        </div>
    </footer>
</body>
</html>

