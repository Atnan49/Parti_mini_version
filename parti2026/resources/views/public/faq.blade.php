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
    <div class="ios-glass rounded-[32px] p-8 md:p-14 relative overflow-hidden mb-10">
        <div class="flex items-center gap-3.5 mb-6">
            <a href="{{ route('home') }}" class="font-mono text-[11px] text-ink-soft hover:text-ember transition-colors flex items-center gap-2 font-bold uppercase tracking-wider">
                ← Kembali ke Beranda
            </a>
        </div>

        <div class="max-w-3xl mx-auto text-center">
            <span class="font-mono text-[11px] tracking-[0.2em] uppercase text-ink inline-flex items-center justify-center gap-2.5 before:content-[''] before:w-[20px] before:h-[1px] before:bg-ember after:content-[''] after:w-[20px] after:h-[1px] after:bg-ember font-bold mb-3">
                PUSAT BANTUAN & INFORMATION HUB
            </span>
            
            <h1 class="font-display font-bold text-[30px] sm:text-[40px] md:text-[50px] text-ink uppercase tracking-tight leading-tight mb-4">
                PERTANYAAN FREKUEN (FAQ)
            </h1>

            <p class="text-ink-soft text-[15px] sm:text-[17px] leading-relaxed max-w-2xl mx-auto mb-8">
                Temukan jawaban cepat terkait pendaftaran, alur kegiatan, sub-acara, dan informasi seputar pelaksanaan PARTI {{ session('active_year', config('parti.active_year', 2026)) }}.
            </p>

            <!-- LIVE SEARCH BAR -->
            <div class="relative max-w-xl mx-auto mb-8">
                <div class="relative flex items-center">
                    <svg class="w-5 h-5 absolute left-4 text-ink-soft/60 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" 
                           x-model="searchQuery" 
                           placeholder="Cari pertanyaan... (contoh: pendaftaran, tanggal, sertifikat)" 
                           class="w-full bg-paper/80 border border-line rounded-full pl-12 pr-10 py-3.5 text-sm text-ink placeholder:text-ink-soft/50 focus:outline-none focus:border-ember focus:ring-1 focus:ring-ember transition-all shadow-inner">
                    <button x-show="searchQuery" 
                            @click="searchQuery = ''" 
                            x-cloak 
                            class="absolute right-4 text-ink-soft hover:text-ember text-xs font-mono font-bold uppercase transition-colors">
                        ✕ Clear
                    </button>
                </div>
            </div>

            <!-- CATEGORY FILTER PILLS -->
            @php
                $categories = $faqs->keys()->toArray();
            @endphp
            @if(count($categories) > 0)
                <div class="flex items-center justify-center flex-wrap gap-2 sm:gap-3">
                    <button @click="activeCategory = 'SEMUA'" 
                            :class="activeCategory === 'SEMUA' ? 'bg-ink text-paper border-ink shadow-sm' : 'bg-paper/60 text-ink-soft hover:text-ink border-line hover:border-ink/30'" 
                            class="font-mono text-[11px] font-bold uppercase tracking-wider px-4 py-2 rounded-full border transition-all">
                        Semua Kategori
                    </button>
                    @foreach($categories as $cat)
                        <button @click="activeCategory = '{{ $cat }}'" 
                                :class="activeCategory === '{{ $cat }}' ? 'bg-ink text-paper border-ink shadow-sm' : 'bg-paper/60 text-ink-soft hover:text-ink border-line hover:border-ink/30'" 
                                class="font-mono text-[11px] font-bold uppercase tracking-wider px-4 py-2 rounded-full border transition-all">
                            {{ $cat }}
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- FAQ LIST CONTAINER -->
    <div class="space-y-10">
        @if($faqs->isEmpty())
            <div class="ios-glass rounded-[28px] p-12 text-center">
                <div class="w-16 h-16 rounded-full bg-paper-warm/80 border border-line flex items-center justify-center mx-auto mb-4 text-2xl">
                    ❓
                </div>
                <h3 class="font-display font-bold text-lg text-ink uppercase mb-2">Belum Ada Pertanyaan</h3>
                <p class="text-ink-soft text-sm max-w-md mx-auto">Saat ini belum ada data FAQ yang dipublikasikan oleh panitia. Silakan kembali lagi nanti.</p>
            </div>
        @else
            @php $totalFaqCount = 0; @endphp
            @foreach($faqs as $category => $categoryFaqs)
                <div class="space-y-4" x-show="activeCategory === 'SEMUA' || activeCategory.toLowerCase() === '{{ strtolower($category) }}'">
                    <!-- Category Subheading -->
                    <div class="flex items-center gap-3 pt-4 pb-2 border-b border-line/60">
                        <span class="w-2 h-2 rounded-full bg-ember"></span>
                        <h2 class="font-display font-bold text-lg sm:text-xl text-ink uppercase tracking-wide">
                            {{ $category }}
                        </h2>
                        <span class="font-mono text-[11px] text-ink-soft/60 font-bold">({{ count($categoryFaqs) }})</span>
                    </div>

                    <div class="space-y-3">
                        @foreach($categoryFaqs as $faq)
                            @php $totalFaqCount++; @endphp
                            <div x-show="filterMatch('{{ addslashes($category) }}', '{{ addslashes($faq->question) }}', '{{ addslashes($faq->answer) }}')"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 class="ios-glass rounded-[22px] border border-line/80 overflow-hidden transition-all duration-300 hover:border-ember/40 shadow-sm"
                                 :class="activeAccordion === {{ $faq->id }} ? 'ring-1 ring-ember/50 border-ember/50 bg-paper-warm/40' : ''">
                                
                                <button @click="activeAccordion = activeAccordion === {{ $faq->id }} ? null : {{ $faq->id }}" 
                                        class="w-full flex items-center justify-between p-5 sm:p-6 text-left focus:outline-none cursor-pointer group">
                                    <span class="font-display font-bold text-[15px] sm:text-[17px] text-ink group-hover:text-ember transition-colors leading-snug pr-4">
                                        {{ $faq->question }}
                                    </span>
                                    
                                    <div class="flex-shrink-0 w-8 h-8 rounded-full border border-line/80 bg-paper/80 flex items-center justify-center text-ink transition-all duration-300 group-hover:border-ember/50"
                                         :class="activeAccordion === {{ $faq->id }} ? 'rotate-180 bg-ember text-white border-ember' : ''">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </button>
                                
                                <div x-show="activeAccordion === {{ $faq->id }}" 
                                     x-collapse
                                     x-cloak>
                                    <div class="px-5 sm:px-6 pb-6 pt-2 text-ink-soft text-[14px] sm:text-[15px] leading-relaxed border-t border-line/40 font-body">
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
                 class="ios-glass rounded-[28px] p-12 text-center">
                <div class="w-16 h-16 rounded-full bg-paper-warm/80 border border-line flex items-center justify-center mx-auto mb-4 text-2xl">
                    🔍
                </div>
                <h3 class="font-display font-bold text-lg text-ink uppercase mb-2">Pertanyaan Tidak Ditemukan</h3>
                <p class="text-ink-soft text-sm max-w-md mx-auto">Tidak ditemukan pertanyaan yang cocok dengan kata kunci "<span x-text="searchQuery" class="font-semibold text-ink"></span>". Coba gunakan kata kunci lain.</p>
            </div>
        @endif
    </div>

    <!-- CONTACT HELP BANNER -->
    <div class="mt-16 ios-glass rounded-[28px] p-8 md:p-10 text-center relative overflow-hidden border border-line">
        <div class="max-w-2xl mx-auto">
            <span class="font-mono text-[10px] tracking-[0.2em] uppercase text-ember font-bold block mb-2">MASIH PUNYA PERTANYAAN LAIN?</span>
            <h3 class="font-display font-bold text-xl sm:text-2xl text-ink uppercase mb-3">Hubungi Panitia Langsung</h3>
            <p class="text-ink-soft text-sm mb-6">Jika pertanyaan Anda belum terjawab di sini, silakan hubungi tim sekretariat atau panitia PARTI melalui kanal resmi kami.</p>
            
            <div class="flex items-center justify-center gap-4 flex-wrap">
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
                    Lihat Sub Acara ↗
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
