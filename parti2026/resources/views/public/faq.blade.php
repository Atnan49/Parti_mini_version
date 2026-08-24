@extends('layouts.public')

@section('title', 'Pertanyaan Sering Diajukan (FAQ) | PARTI HIMATIF UMS')
@section('meta_description', 'Pusat bantuan dan FAQ seputar pendaftaran, sub-acara, dan alur kegiatan PARTI HIMATIF UMS.')

@section('content')
<section class="relative py-12 px-4 max-w-[1140px] mx-auto z-10" 
         x-data="{
             activeCategory: 'SEMUA',
             searchQuery: '',
             activeAccordion: null,
             filterMatch(faqCategory, faqQuestion, faqAnswer) {
                 const matchesCat = this.activeCategory === 'SEMUA' || this.activeCategory.toLowerCase() === faqCategory.toLowerCase();
                 const q = this.searchQuery.toLowerCase().trim();
                 const matchesQuery = !q || faqQuestion.toLowerCase().includes(q) || faqAnswer.toLowerCase().includes(q);
                 return matchesCat && matchesQuery;
             }
         }">

    <!-- HERO HEADER CARD -->
    <div class="ios-glass rounded-[32px] p-8 md:p-14 relative overflow-hidden mb-12 shadow-sm border border-line">
        <!-- Ambient Ambient Glow Backdrop -->
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-ember/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-ember/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="flex items-center justify-between gap-4 mb-6 relative z-10">
            <a href="{{ route('home') }}" class="font-mono text-[11px] text-ink-soft hover:text-ember transition-colors flex items-center gap-2 font-bold uppercase tracking-wider">
                ← Kembali ke Beranda
            </a>
            @php $totalCount = $faqs->flatten()->count(); @endphp
            <span class="font-mono text-[10px] bg-ember/10 text-ember border border-ember/20 px-3 py-1 rounded-full font-bold uppercase tracking-wider">
                {{ $totalCount }} Pertanyaan Tersedia
            </span>
        </div>

        <div class="max-w-3xl mx-auto text-center relative z-10">
            <span class="font-mono text-[11px] tracking-[0.2em] uppercase text-ink inline-flex items-center justify-center gap-2.5 before:content-[''] before:w-[20px] before:h-[1px] before:bg-ember after:content-[''] after:w-[20px] after:h-[1px] after:bg-ember font-bold mb-3">
                PUSAT BANTUAN & FAQ
            </span>
            
            <h1 class="font-display font-bold text-[32px] sm:text-[44px] md:text-[54px] text-ink uppercase tracking-tight leading-tight mb-4">
                PERTANYAAN FREKUEN
            </h1>

            <p class="text-ink-soft text-[15px] sm:text-[17px] leading-relaxed max-w-2xl mx-auto mb-8">
                Temukan jawaban lengkap seputar pendaftaran, kompetisi, petunjuk teknis, dan pelaksanaan PARTI {{ session('active_year', config('parti.active_year', 2026)) }}.
            </p>

            <!-- LIVE SEARCH BAR -->
            <div class="relative max-w-xl mx-auto mb-8">
                <div class="relative flex items-center">
                    <svg class="w-5 h-5 absolute left-4 text-ink-soft/60 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" 
                           x-model="searchQuery" 
                           placeholder="Ketik kata kunci... (contoh: pendaftaran, biaya, sertifikat)" 
                           class="w-full bg-paper/90 border border-line/80 rounded-full pl-12 pr-12 py-3.5 text-sm text-ink placeholder:text-ink-soft/50 focus:outline-none focus:border-ember focus:ring-2 focus:ring-ember/20 transition-all shadow-sm">
                    <button x-show="searchQuery" 
                            @click="searchQuery = ''" 
                            x-cloak 
                            class="absolute right-4 text-ink-soft/60 hover:text-ember text-xs font-mono font-bold uppercase transition-colors p-1">
                        ✕ Clear
                    </button>
                </div>
            </div>

            <!-- CATEGORY FILTER PILLS -->
            @php
                $categories = $faqs->keys()->toArray();
            @endphp
            @if(count($categories) > 0)
                <div class="flex items-center justify-center flex-wrap gap-2 sm:gap-2.5">
                    <button @click="activeCategory = 'SEMUA'" 
                            :class="activeCategory === 'SEMUA' ? 'bg-ember text-white border-ember shadow-[0_4px_14px_rgba(226,101,11,0.3)] scale-[1.02]' : 'bg-paper-warm/80 text-ink-soft hover:text-ink border-line hover:border-ember/40'" 
                            class="font-mono text-[11px] font-bold uppercase tracking-wider px-4 py-2 rounded-full border transition-all duration-200 cursor-pointer">
                        Semua Kategori
                    </button>
                    @foreach($categories as $cat)
                        <button @click="activeCategory = '{{ $cat }}'" 
                                :class="activeCategory === '{{ $cat }}' ? 'bg-ember text-white border-ember shadow-[0_4px_14px_rgba(226,101,11,0.3)] scale-[1.02]' : 'bg-paper-warm/80 text-ink-soft hover:text-ink border-line hover:border-ember/40'" 
                                class="font-mono text-[11px] font-bold uppercase tracking-wider px-4 py-2 rounded-full border transition-all duration-200 cursor-pointer">
                            {{ $cat }}
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- FAQ LIST CONTAINER -->
    <div class="space-y-12 max-w-4xl mx-auto">
        @if($faqs->isEmpty())
            <div class="ios-glass rounded-[28px] p-12 text-center border border-line">
                <div class="w-16 h-16 rounded-full bg-paper-warm/80 border border-line flex items-center justify-center mx-auto mb-4 text-2xl">
                    💡
                </div>
                <h3 class="font-display font-bold text-lg text-ink uppercase mb-2">Belum Ada Pertanyaan</h3>
                <p class="text-ink-soft text-sm max-w-md mx-auto">Data FAQ saat ini belum dipublikasikan oleh panitia. Silakan kembali lagi nanti.</p>
            </div>
        @else
            @php $globalCounter = 0; @endphp
            @foreach($faqs as $category => $categoryFaqs)
                <div class="space-y-4" x-show="activeCategory === 'SEMUA' || activeCategory.toLowerCase() === '{{ strtolower($category) }}'">
                    <!-- Category Header Banner -->
                    <div class="flex items-center justify-between pt-2 pb-3 border-b border-line/60">
                        <div class="flex items-center gap-3">
                            <span class="w-2.5 h-2.5 rounded-full bg-ember inline-block"></span>
                            <h2 class="font-display font-bold text-lg sm:text-xl text-ink uppercase tracking-wide">
                                {{ $category }}
                            </h2>
                        </div>
                        <span class="font-mono text-[10px] text-ink-soft/60 bg-paper-warm border border-line px-2.5 py-0.5 rounded-full font-bold uppercase">
                            {{ count($categoryFaqs) }} Pertanyaan
                        </span>
                    </div>

                    <!-- Accordion Group -->
                    <div class="space-y-3">
                        @foreach($categoryFaqs as $faq)
                            @php $globalCounter++; @endphp
                            <div x-show="filterMatch('{{ addslashes($category) }}', '{{ addslashes($faq->question) }}', '{{ addslashes($faq->answer) }}')"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 class="ios-glass rounded-[20px] border border-line/70 overflow-hidden transition-all duration-300 shadow-sm"
                                 :class="activeAccordion === {{ $faq->id }} ? 'ring-1 ring-ember/40 border-ember/40 bg-paper-warm/50 shadow-md' : 'hover:border-ember/30 hover:bg-paper-warm/20'">
                                
                                <button @click="activeAccordion = activeAccordion === {{ $faq->id }} ? null : {{ $faq->id }}" 
                                        class="w-full flex items-center justify-between p-5 sm:p-6 text-left focus:outline-none cursor-pointer group">
                                    
                                    <div class="flex items-center gap-3.5 sm:gap-4 pr-4">
                                        <span class="font-mono text-[12px] font-bold text-ember/70 group-hover:text-ember transition-colors">
                                            {{ sprintf('%02d', $globalCounter) }}
                                        </span>
                                        <span class="font-display font-bold text-[15px] sm:text-[17px] text-ink group-hover:text-ember transition-colors leading-snug">
                                            {{ $faq->question }}
                                        </span>
                                    </div>
                                    
                                    <div class="flex-shrink-0 w-8 h-8 rounded-full border border-line/80 bg-paper/90 flex items-center justify-center text-ink transition-all duration-300 group-hover:border-ember/50"
                                         :class="activeAccordion === {{ $faq->id }} ? 'rotate-180 bg-ember text-white border-ember shadow-sm' : ''">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </button>
                                
                                <div x-show="activeAccordion === {{ $faq->id }}" 
                                     x-collapse
                                     x-cloak>
                                    <div class="px-5 sm:px-6 pb-6 pt-3 text-ink-soft text-[14px] sm:text-[15px] leading-relaxed border-t border-line/40 font-body ml-7 sm:ml-8">
                                        {!! nl2br(e($faq->answer)) !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <!-- SEARCH NO RESULTS FALLBACK -->
            <div x-show="searchQuery && $el.parentElement.querySelectorAll('[x-show*=\'filterMatch\']:not([style*=\'display: none\'])').length === 0"
                 x-cloak
                 class="ios-glass rounded-[28px] p-12 text-center border border-line">
                <div class="w-16 h-16 rounded-full bg-paper-warm/80 border border-line flex items-center justify-center mx-auto mb-4 text-2xl">
                    🔍
                </div>
                <h3 class="font-display font-bold text-lg text-ink uppercase mb-2">Tidak Ada Hasil</h3>
                <p class="text-ink-soft text-sm max-w-md mx-auto">Tidak ditemukan pertanyaan yang mengandung kata kunci "<span x-text="searchQuery" class="font-semibold text-ember"></span>". Coba gunakan kata kunci lainnya.</p>
            </div>
        @endif
    </div>

    <!-- CONTACT HELP BANNER -->
    <div class="mt-16 max-w-4xl mx-auto ios-glass rounded-[28px] p-8 md:p-10 text-center relative overflow-hidden border border-line shadow-sm">
        <div class="max-w-2xl mx-auto">
            <span class="font-mono text-[10px] tracking-[0.2em] uppercase text-ember font-bold block mb-2">MASIH PERLU BANTUAN?</span>
            <h3 class="font-display font-bold text-xl sm:text-2xl text-ink uppercase mb-3">Hubungi Panitia PARTI</h3>
            <p class="text-ink-soft text-sm mb-6">Apabila Anda membutuhkan informasi lebih lanjut yang belum tercantum di atas, silakan hubungi tim panitia kami.</p>
            
            <div class="flex items-center justify-center gap-3.5 flex-wrap">
                @if(config('parti.socials.parti.instagram'))
                    <a href="{{ config('parti.socials.parti.instagram') }}" target="_blank" rel="noopener noreferrer" 
                       class="font-mono text-[11px] font-bold tracking-wider uppercase bg-ink text-paper px-6 py-3 rounded-full transition-all hover:opacity-90 shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"></path>
                            <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                        </svg>
                        Instagram @PARTI
                    </a>
                @endif
                <a href="{{ route('home') }}#sub-acara" 
                   class="font-mono text-[11px] font-bold tracking-wider uppercase bg-paper-warm border border-line text-ink px-6 py-3 rounded-full transition-all hover:border-ember hover:text-ember shadow-sm">
                    Jelajahi Sub Acara ↗
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
