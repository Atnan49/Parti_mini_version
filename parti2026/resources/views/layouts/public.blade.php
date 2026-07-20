<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ 
          darkMode: localStorage.getItem('darkMode') === 'true' || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
      }"
      :class="{ 'dark': darkMode }"
      x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))">
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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Space+Grotesk:wght@400;500;600;700&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Styles and Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body x-data="{
          isPageLoaded: false,
          showSplash: true,
          logoVisible: false,
          logoExiting: false,
          progress: 0,
          _interval: null,
          _done: false,
          startLoading() {
              this._interval = setInterval(() => {
                  if (this.progress < 90) {
                      this.progress = Math.min(90, this.progress + (90 - this.progress) * 0.08);
                  }
              }, 50);
              if (document.readyState === 'complete') {
                  this.finishLoading();
              } else {
                  window.addEventListener('load', () => this.finishLoading());
              }
          },
          finishLoading() {
              if (this._done) return;
              this._done = true;
              clearInterval(this._interval);
              this.progress = 100;
              
              setTimeout(() => { this.logoVisible = true; }, 500);
              setTimeout(() => { this.logoExiting = true; }, 1800);
              setTimeout(() => { this.isPageLoaded = true; }, 2100);
              setTimeout(() => { this.showSplash = false; }, 2800);
          }
      }"
      x-init="startLoading()"
      class="bg-paper text-ink font-body antialiased overflow-x-hidden mac-aurora-bg min-h-screen flex flex-col transition-colors duration-500">

    <!-- macOS style Splash Screen Loader -->
    <div x-show="showSplash" 
         x-cloak
         class="fixed inset-0 z-[100] bg-paper transition-opacity duration-700 ease-premium"
         :class="isPageLoaded ? 'opacity-0 pointer-events-none' : 'opacity-100'">

        <!-- Center Logo & Minimal Progress Ring -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center gap-5 z-10 pointer-events-none">
            <div class="reveal-logo transition-all duration-700 ease-premium"
                 :class="logoExiting 
                     ? 'opacity-0 scale-[0.94] blur-md' 
                     : (logoVisible ? 'reveal-logo-visible' : 'reveal-logo-hidden')">
                <img src="{{ asset('logo.png') }}" alt="Logo PARTI" 
                     class="h-16 w-auto drop-shadow-sm">
            </div>

            <div class="flex flex-col items-center gap-1.5 reveal-text transition-all duration-700 ease-premium"
                 :class="logoExiting 
                     ? 'opacity-0 scale-[0.96] blur-sm' 
                     : (logoVisible ? 'reveal-text-visible' : 'reveal-text-hidden')">
                <span class="font-display font-bold text-[18px] md:text-[22px] tracking-[0.15em] text-ink uppercase whitespace-nowrap">PARTI {{ config('parti.active_year', 2026) }}</span>
                <div class="flex items-center gap-2 mt-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-ember animate-ping"></span>
                    <span class="font-mono text-[9px] tracking-wider text-ink-soft/60 uppercase">System Initializing</span>
                </div>
            </div>
        </div>
    </div>

    <!-- macOS Floating Dock Navbar -->
    <header class="sticky top-0 z-50 w-full transition-all duration-[1000ms] ease-premium transform"
            :class="isPageLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 -translate-y-4'">
        <nav x-data="{ mobileMenuOpen: false }" 
             class="mx-4 md:mx-auto mt-4 max-w-[1140px] rounded-2xl md:rounded-full bg-white/70 dark:bg-[#121218]/70 backdrop-blur-xl border border-line shadow-[0_10px_30px_rgba(0,0,0,0.03)] px-5 py-3 md:px-8 md:py-3.5 transition-all duration-300">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="font-display font-bold text-[17px] sm:text-[19px] text-ink flex items-center gap-2.5 hover:opacity-90 transition-opacity">
                    <img src="{{ asset('logo.png') }}" alt="Logo PARTI" class="h-7 w-auto">
                    <span class="tracking-wide">PARTI {{ config('parti.active_year', 2026) }}</span>
                </a>
                
                <div class="hidden md:flex gap-[28px] text-[14px] font-medium text-ink-soft">
                    <a href="{{ route('home') }}#tentang" class="hover:text-ember transition-colors py-1">Tentang</a>
                    <a href="{{ route('home') }}#sub-acara" class="hover:text-ember transition-colors py-1">Sub Acara</a>
                    <a href="{{ route('home') }}#timeline" class="hover:text-ember transition-colors py-1">Timeline</a>
                </div>

                <div class="hidden md:flex items-center gap-4">
                    <!-- Theme Toggle Switch -->
                    <button @click="darkMode = !darkMode" class="p-2 rounded-full border border-line text-ink hover:bg-paper-warm hover:text-ember transition-all cursor-pointer" aria-label="Toggle Theme">
                        <!-- Sun icon (shown in dark mode) -->
                        <svg x-show="darkMode" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="5"></circle>
                            <line x1="12" y1="1" x2="12" y2="3"></line>
                            <line x1="12" y1="21" x2="12" y2="23"></line>
                            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                            <line x1="1" y1="12" x2="3" y2="12"></line>
                            <line x1="21" y1="12" x2="23" y2="12"></line>
                            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                        </svg>
                        <!-- Moon icon (shown in light mode) -->
                        <svg x-show="!darkMode" class="w-4 h-4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                        </svg>
                    </button>

                    <a class="font-mono text-[11px] tracking-wide uppercase bg-ink text-paper px-[18px] py-[8px] rounded-full transition-all duration-300 hover:opacity-90 shadow-sm" href="{{ route('home') }}#sub-acara">
                        Jelajahi Acara
                    </a>
                </div>

                <!-- Mobile Navbar Controls -->
                <div class="flex items-center gap-3.5 md:hidden">
                    <!-- Theme Toggle for Mobile -->
                    <button @click="darkMode = !darkMode" class="p-2 rounded-full border border-line text-ink hover:bg-paper-warm hover:text-ember transition-all cursor-pointer" aria-label="Toggle Theme">
                        <svg x-show="darkMode" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="5"></circle>
                            <line x1="12" y1="1" x2="12" y2="3"></line>
                            <line x1="12" y1="21" x2="12" y2="23"></line>
                            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                            <line x1="1" y1="12" x2="3" y2="12"></line>
                            <line x1="21" y1="12" x2="23" y2="12"></line>
                            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                        </svg>
                        <svg x-show="!darkMode" class="w-4 h-4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                        </svg>
                    </button>

                    <!-- Hamburger Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-ink focus:outline-none p-1.5 hover:text-ember transition-colors" aria-label="Toggle Menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu Dropdown (iOS-like sheet) -->
            <div x-show="mobileMenuOpen" 
                 x-cloak
                 x-transition:enter="transition ease-out duration-250"
                 x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                 class="md:hidden bg-white/95 dark:bg-[#08080A]/95 rounded-xl border border-line mt-3 py-4 px-5 shadow-lg">
                <div class="flex flex-col gap-3.5 text-[14px] font-medium text-ink-soft">
                    <a href="{{ route('home') }}#tentang" @click="mobileMenuOpen = false" class="hover:text-ember py-2 border-b border-line/30 transition-colors">Tentang</a>
                    <a href="{{ route('home') }}#sub-acara" @click="mobileMenuOpen = false" class="hover:text-ember py-2 border-b border-line/30 transition-colors">Sub Acara</a>
                    <a href="{{ route('home') }}#timeline" @click="mobileMenuOpen = false" class="hover:text-ember py-2 border-b border-line/30 transition-colors">Timeline</a>
                    <a class="font-mono text-[11px] tracking-wide uppercase bg-ink text-paper px-[20px] py-[10px] rounded-full text-center mt-2 hover:opacity-90 transition-all duration-300 shadow-sm" href="{{ route('home') }}#sub-acara" @click="mobileMenuOpen = false">
                        Jelajahi Acara
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="flex-grow transition-all duration-[1000ms] ease-premium transform delay-[200ms]"
          :class="isPageLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'">
        @yield('content')
    </main>

    <!-- Footer (iOS modular panel) -->
    <footer class="bg-paper-warm border-t border-line text-ink pt-16 pb-[34px] transition-opacity duration-[1000ms] ease-premium delay-[300ms]"
            :class="isPageLoaded ? 'opacity-100' : 'opacity-0'">
        <div class="w-full max-w-[1140px] mx-auto px-6 md:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start pb-11 border-b border-line/60 gap-8">
                <div>
                    <div class="font-display text-[20px] font-bold flex items-center gap-2.5">
                        <img src="{{ asset('logo.png') }}" alt="Logo PARTI" class="h-7 w-auto">
                        <span class="tracking-wide">PARTI <span class="text-ember">{{ config('parti.active_year', 2026) }}</span></span>
                    </div>
                    <p class="text-[13px] text-ink-soft mt-2.5 max-w-[32ch]">Vanguard of Tech | HIMATIF Universitas Muhammadiyah Surakarta.</p>
                </div>
                <div class="flex flex-wrap gap-12 sm:gap-16">
                    <div class="text-left">
                        <h5 class="font-mono text-[10px] tracking-[0.15em] uppercase text-ember font-bold mb-4">Acara</h5>
                        @forelse($footerSubEvents as $sub)
                            <a href="{{ route('sub-event.show', $sub->slug) }}" class="block text-[13px] text-ink-soft mb-2.5 hover:text-ember transition-colors">{{ $sub->name }}</a>
                        @empty
                            <a href="#sub-acara" class="block text-[13px] text-ink-soft mb-2.5 hover:text-ember transition-colors">Lihat Semua Acara</a>
                        @endforelse
                    </div>
                    <div class="text-left">
                        <h5 class="font-mono text-[10px] tracking-[0.15em] uppercase text-ember font-bold mb-4">Jelajah</h5>
                        <a href="#tentang" class="block text-[13px] text-ink-soft mb-2.5 hover:text-ember transition-colors">Tentang</a>
                        <a href="#timeline" class="block text-[13px] text-ink-soft mb-2.5 hover:text-ember transition-colors">Timeline</a>
                    </div>
                    <div class="text-left">
                        <h5 class="font-mono text-[10px] tracking-[0.15em] uppercase text-ember font-bold mb-4">Media Sosial</h5>
                        @if(config('parti.socials.parti.instagram'))
                            <a href="{{ config('parti.socials.parti.instagram') }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-[13px] text-ink-soft mb-2.5 hover:text-ember transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"></path>
                                    <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                                </svg>
                                Instagram
                            </a>
                        @endif
                        @if(config('parti.socials.parti.tiktok'))
                            <a href="{{ config('parti.socials.parti.tiktok') }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-[13px] text-ink-soft mb-2.5 hover:text-ember transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"></path>
                                </svg>
                                TikTok
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="pt-7 flex flex-col sm:flex-row justify-between text-[11.5px] text-ink-soft/75 gap-2.5">
                <span>© {{ config('parti.active_year', 2026) }} HIMATIF UMS. Seluruh hak cipta dilindungi.</span>
                <span class="font-mono uppercase tracking-wider text-gold font-bold">Vanguard macOS Edition</span>
            </div>
        </div>
    </footer>
</body>
</html>
