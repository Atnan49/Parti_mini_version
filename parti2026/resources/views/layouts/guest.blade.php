<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PARTI 2026') }} | Panel Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;900&family=Cinzel+Decorative:wght@700;900&family=Work+Sans:wght@400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-body text-ink antialiased bg-paper-warm flex items-center justify-center min-h-screen relative overflow-hidden">
        <!-- Background glows -->
        <div class="absolute top-0 right-0 w-[350px] h-[350px] bg-gold-soft/10 blur-[100px] rounded-full pointer-events-none animate-pulse-glow"></div>
        <div class="absolute bottom-0 left-0 w-[250px] h-[250px] bg-ember/5 blur-[80px] rounded-full pointer-events-none"></div>

        <div class="w-full sm:max-w-md px-8 py-10 bg-white border border-line rounded-[6px] shadow-[0_20px_50px_-20px_rgba(28,20,11,0.08)] relative z-10 mx-4">
            <div class="flex flex-col items-center mb-8">
                <a href="/">
                    <img src="{{ asset('logo.png') }}" alt="Logo PARTI" class="h-16 w-auto drop-shadow-md hover:scale-105 transition-transform duration-300">
                </a>
                <h1 class="font-display font-bold text-[22px] tracking-wide text-ink mt-4 uppercase">PARTI {{ config('parti.active_year', 2026) }}</h1>
                <span class="font-mono text-[10px] tracking-[0.15em] text-ember-dark uppercase mt-1">Vanguard of Tech Admin</span>
            </div>
            
            {{ $slot }}
        </div>
    </body>
</html>


