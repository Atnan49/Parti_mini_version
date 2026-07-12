<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'PARTI 2026 — Vanguard of Tech')</title>
    <meta name="description" content="@yield('meta_description', 'Website PARTI 2026 UMS — Vanguard of Tech, platform informasi dan pendaftaran rangkaian acara Himatif UMS.')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;900&family=Cinzel+Decorative:wght@700;900&family=Work+Sans:wght@400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

    <!-- Styles and Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-paper text-ink font-body antialiased overflow-x-hidden">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-white/86 backdrop-blur-md border-bottom border-line border-b">
        <div class="max-w-[1180px] mx-auto px-8 py-[18px] flex items-center justify-between">
            <div class="font-display-decorative font-bold text-[19px] text-ink flex items-center gap-2.5">
                <span class="w-2 hash-dot h-2 bg-ember rounded-full inline-block"></span>
                PARTI {{ config('parti.active_year', 2026) }}
            </div>
            
            <div class="hidden md:flex gap-[34px] text-[14px] font-medium text-ink-soft">
                <a href="#filosofi" class="hover:text-ember-dark transition-colors relative py-1">Filosofi</a>
                <a href="#maskot" class="hover:text-ember-dark transition-colors relative py-1">Maskot</a>
                <a href="#sub-acara" class="hover:text-ember-dark transition-colors relative py-1">Sub Acara</a>
                <a href="#timeline" class="hover:text-ember-dark transition-colors relative py-1">Timeline</a>
            </div>

            <a class="font-mono text-[12px] tracking-[0.05em] border border-ink px-[18px] py-[9px] rounded-[2px] transition-all duration-200 hover:bg-ink hover:text-white" href="#sub-acara">
                Lihat Acara
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-ink text-[#F4EBDB] pt-16 pb-[34px]">
        <div class="max-w-[1180px] mx-auto px-8">
            <div class="flex flex-col md:flex-row justify-between items-start pb-11 border-b border-[#F4EBDB]/14 gap-8">
                <div>
                    <div class="font-display-decorative text-[22px] font-bold">PARTI <span class="text-ember">{{ config('parti.active_year', 2026) }}</span></div>
                    <p class="text-[13px] text-[#B8A98D] mt-2.5 max-w-[32ch]">Vanguard of Tech — HIMATIF Universitas Muhammadiyah Surakarta.</p>
                </div>
                <div class="flex gap-16 md:gap-16">
                    <div class="text-left">
                        <h5 class="font-mono text-[11px] tracking-[0.12em] uppercase text-ember mb-3.5">Acara</h5>
                        <a href="#sub-acara" class="block text-[13.5px] text-[#D8CAB2] mb-2.5 hover:text-white transition-colors">Webinar Nasional</a>
                        <a href="#sub-acara" class="block text-[13.5px] text-[#D8CAB2] mb-2.5 hover:text-white transition-colors">Web Programming</a>
                        <a href="#sub-acara" class="block text-[13.5px] text-[#D8CAB2] mb-2.5 hover:text-white transition-colors">Lomba Futsal</a>
                        <a href="#sub-acara" class="block text-[13.5px] text-[#D8CAB2] mb-2.5 hover:text-white transition-colors">Bakti Sosial</a>
                    </div>
                    <div class="text-left">
                        <h5 class="font-mono text-[11px] tracking-[0.12em] uppercase text-ember mb-3.5">Jelajah</h5>
                        <a href="#filosofi" class="block text-[13.5px] text-[#D8CAB2] mb-2.5 hover:text-white transition-colors">Filosofi</a>
                        <a href="#maskot" class="block text-[13.5px] text-[#D8CAB2] mb-2.5 hover:text-white transition-colors">Maskot</a>
                        <a href="#timeline" class="block text-[13.5px] text-[#D8CAB2] mb-2.5 hover:text-white transition-colors">Timeline</a>
                    </div>
                </div>
            </div>
            <div class="pt-7 flex flex-col md:flex-row justify-between text-[12px] text-[#8A7A62] gap-2.5">
                <span>© {{ config('parti.active_year', 2026) }} HIMATIF UMS. Seluruh hak cipta dilindungi.</span>
                <span>Golden Heritage Edition</span>
            </div>
        </div>
    </footer>
</body>
</html>
