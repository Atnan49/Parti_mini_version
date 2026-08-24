@extends('layouts.public')

@section('title', 'Q&A - PARTI Himatif UMS')

@section('content')
<section class="py-24 relative overflow-hidden bg-paper">
    <div class="container mx-auto px-6 max-w-4xl relative z-10">
        <!-- Header -->
        <div class="text-center mb-16">
            <h1 class="font-display text-4xl md:text-5xl font-bold text-ink mb-4">Pertanyaan yang Sering Diajukan</h1>
            <p class="text-ink-soft text-lg max-w-2xl mx-auto">Jawaban cepat untuk pertanyaan seputar rangkaian acara PARTI Himatif UMS.</p>
        </div>

        @if($faqs->isEmpty())
            <div class="text-center text-ink-soft/70 py-12">
                <p>Belum ada FAQ yang tersedia saat ini.</p>
            </div>
        @else
            <!-- FAQ Accordion Container -->
            <div x-data="{ activeAccordion: null }" class="space-y-8">
                @foreach($faqs as $category => $categoryFaqs)
                    <div class="mb-10">
                        <h2 class="text-2xl font-bold text-ink mb-6 border-b border-line pb-2">{{ $category }}</h2>
                        
                        <div class="space-y-4">
                            @foreach($categoryFaqs as $faq)
                                <div class="border border-line rounded-2xl bg-paper-warm overflow-hidden transition-all duration-300" 
                                     :class="activeAccordion === {{ $faq->id }} ? 'shadow-md ring-1 ring-ember' : 'hover:border-ink/20'">
                                    
                                    <button @click="activeAccordion = activeAccordion === {{ $faq->id }} ? null : {{ $faq->id }}" 
                                            class="w-full flex items-center justify-between p-6 text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-ember rounded-2xl">
                                        <span class="font-bold text-ink text-lg">{{ $faq->question }}</span>
                                        <div class="flex-shrink-0 ml-4 w-8 h-8 rounded-full bg-ink/5 flex items-center justify-center transition-transform duration-300"
                                             :class="activeAccordion === {{ $faq->id }} ? 'rotate-180 bg-ember text-white' : 'text-ink'">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </button>
                                    
                                    <div x-show="activeAccordion === {{ $faq->id }}" 
                                         x-collapse
                                         class="px-6 pb-6 text-ink-soft prose prose-ink dark:prose-invert max-w-none">
                                        {!! nl2br(e($faq->answer)) !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
