<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PARTI Himatif UMS') }} | Panel Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-body text-ink antialiased bg-paper hero-pattern-bg flex items-center justify-center min-h-screen relative overflow-hidden transition-colors duration-300">
        <!-- Background glows (cyber accent) -->
        <div class="absolute top-0 right-0 w-[350px] h-[350px] bg-gold/5 blur-[100px] rounded-full pointer-events-none animate-pulse-glow"></div>
        <div class="absolute bottom-0 left-0 w-[250px] h-[250px] bg-ember/5 blur-[80px] rounded-full pointer-events-none"></div>

        <div class="w-full sm:max-w-md px-8 py-10 bg-paper-warm/90 backdrop-blur-md border border-line rounded-[24px] shadow-[0_20px_50px_-20px_rgba(0,0,0,0.45)] relative z-10 mx-4">
            <div class="flex flex-col items-center mb-8">
                <a href="/">
                    <img src="{{ asset('logo.png') }}" alt="Logo PARTI" class="h-14 w-auto drop-shadow-md hover:scale-105 transition-transform duration-300">
                </a>
                <h1 class="font-display font-bold text-[20px] tracking-wide text-ink mt-4 uppercase">PARTI {{ config('parti.active_year', 2026) }}</h1>
                <span class="font-mono text-[9px] tracking-[0.15em] text-ember font-bold uppercase mt-1">Vanguard of Tech Admin</span>
            </div>
            
            {{ $slot }}
        </div>
    </body>
</html>
