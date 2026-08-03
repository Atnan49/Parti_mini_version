@extends('layouts.public')

@section('title', 'Tentang PARTI | Parade Teknik Informatika HIMATIF UMS')
@section('meta_description', 'Tentang PARTI (Parade Teknik Informatika), event tahunan terbesar yang diselenggarakan oleh HIMPUNAN MAHASISWA TEKNIK INFORMATIKA UMS.')

@section('content')
<!-- HERO ABOUT HEADER -->
<section class="relative py-12 px-4 max-w-[1140px] mx-auto z-10">
    <div class="ios-glass rounded-[32px] p-8 md:p-14 relative overflow-hidden">
        <div class="flex items-center gap-3.5 mb-6">
            <a href="{{ route('home') }}" class="font-mono text-[11px] text-ink-soft hover:text-ember transition-colors flex items-center gap-2 font-bold uppercase tracking-wider">
                ← Kembali ke Beranda
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-[0.8fr_1.2fr] gap-12 md:gap-16 items-center text-center md:text-left">
            <!-- iOS Glass Logo Panel -->
            <div class="relative max-w-[200px] md:max-w-[280px] mx-auto md:mx-0 w-full flex items-center justify-center p-8 ios-glass rounded-[28px] animate-float">
                <img src="{{ asset('logo.png') }}" alt="Logo PARTI" class="w-full h-auto drop-shadow-sm hover:scale-105 transition-transform duration-500">
            </div>
            
            <div>
                <span class="font-mono text-[11px] tracking-[0.2em] uppercase text-ink flex items-center justify-center md:justify-start gap-2.5 before:content-[''] before:w-[20px] before:h-[1px] before:bg-ember font-bold">
                    Tentang Event
                </span>
                <h1 class="font-display font-bold text-[28px] sm:text-[36px] md:text-[46px] mt-4 mb-2 text-ink uppercase tracking-tight leading-tight">
                    PARADE TEKNIK INFORMATIKA
                </h1>
                <span class="font-mono text-[11px] tracking-[0.15em] text-gold uppercase mb-6 block font-bold">
                    Diselenggarakan oleh Himpunan Mahasiswa Teknik Informatika (HIMATIF) UMS
                </span>
                <p class="text-ink-soft leading-relaxed mb-4 text-[15px] sm:text-[16px]">
                    PARTI (Parade Teknik Informatika) adalah event tahunan terbesar yang diselenggarakan oleh HIMPUNAN MAHASISWA TEKNIK INFORMATIKA UMS. Event ini dirancang sebagai wadah kolaborasi, inovasi, dan ekspresi bagi mahasiswa serta publik di bidang teknologi dan kreatif.
                </p>
                <p class="text-ink-soft leading-relaxed mb-6 text-[15px] sm:text-[16px]">
                    Sebagai platform tahunan yang dinamis, di dalam PARTI terdapat beberapa sub event yang dirancang khusus untuk memadukan kompetensi sains, kreativitas seni, dan kepekaan sosial guna menciptakan sinergi positif yang berkelanjutan bagi masyarakat luas.
                </p>
                <div class="px-6 py-5 ios-glass rounded-[22px] font-display italic text-[15px] sm:text-[17px] text-ink shadow-sm text-left leading-relaxed">
                    “Merajut inovasi teknologi, kreativitas, dan kolaborasi dalam harmoni tahunan.”
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PILAR UTAMA & VALUE EVENT -->
<section class="py-6 px-4 max-w-[1140px] mx-auto z-10 relative">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
        <div class="ios-glass rounded-[24px] p-7 text-left space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-orange-500/10 border border-orange-500/20 flex items-center justify-center text-ember font-mono text-[20px] font-bold">
                01
            </div>
            <h3 class="font-display font-bold text-[18px] text-ink uppercase tracking-tight">Inovasi Teknologi</h3>
            <p class="text-[14px] text-ink-soft leading-relaxed">
                Mendorong pengembangan solusi teknologi tepat guna, kompetisi pengkodean, serta literasi digital yang relevan dengan perkembangan industri global.
            </p>
        </div>

        <div class="ios-glass rounded-[24px] p-7 text-left space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-gold font-mono text-[20px] font-bold">
                02
            </div>
            <h3 class="font-display font-bold text-[18px] text-ink uppercase tracking-tight">Kolaborasi Inklusif</h3>
            <p class="text-[14px] text-ink-soft leading-relaxed">
                Membangun jejaring sinergi antara mahasiswa, akademisi, praktisi industri, sekolah, dan masyarakat luas melalui rangkaian webinar dan lomba.
            </p>
        </div>

        <div class="ios-glass rounded-[24px] p-7 text-left space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-500 font-mono text-[20px] font-bold">
                03
            </div>
            <h3 class="font-display font-bold text-[18px] text-ink uppercase tracking-tight">Dampak Sosial</h3>
            <p class="text-[14px] text-ink-soft leading-relaxed">
                Menyebarkan kebermanfaatan nyata bagi sesama melalui aksi kepedulian sosial dan penyaluran donasi kegiatan bakti sosial.
            </p>
        </div>
    </div>
</section>

<!-- SECTION SPONSOR & MITRA -->
<x-sponsor-section :sponsors="$sponsors" />
@endsection
