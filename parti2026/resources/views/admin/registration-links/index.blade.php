@extends('layouts.admin')

@section('title', 'Tautan Pendaftaran — PARTI ' . $year)

@section('content')
<div class="space-y-6 text-left">
    <!-- Header -->
    <div>
        <h1 class="font-display font-bold text-2xl text-ink uppercase tracking-wide">Tautan Pendaftaran</h1>
        <p class="text-ink-soft text-sm mt-1">Perbarui tautan Google Form pendaftaran per sub-acara untuk tahun aktif {{ $year }}.</p>
    </div>

    <!-- Sub Events Links List -->
    <div class="bg-white border border-line rounded-[6px] shadow-sm overflow-hidden">
        <div class="p-6 border-b border-line">
            <h3 class="font-display font-bold text-base text-ink uppercase tracking-wide">Daftar Sub Acara</h3>
        </div>

        <div class="divide-y divide-line/60">
            @forelse($subEvents as $subEvent)
                <div class="p-6 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                    <!-- Left: Sub Event Info -->
                    <div class="space-y-2 lg:max-w-md">
                        <div class="flex items-center gap-2.5 flex-wrap">
                            <h4 class="font-display font-bold text-lg text-ink uppercase">{{ $subEvent->name }}</h4>
                            <span class="font-mono text-[9px] tracking-wider px-2 py-0.5 rounded-[3px] border font-bold uppercase
                                @if($subEvent->status === 'PUBLISHED') bg-emerald-50 text-emerald-700 border-emerald-200
                                @elseif($subEvent->status === 'CLOSED') bg-rose-50 text-rose-700 border-rose-200
                                @else bg-amber-50 text-amber-700 border-amber-200 @endif">
                                {{ $subEvent->status }}
                            </span>
                        </div>
                        <p class="text-xs text-ink-soft/80 italic">{{ $subEvent->tagline }}</p>
                        
                        <!-- Last update metadata -->
                        @if($subEvent->gform_updated_by)
                            <div class="font-mono text-[10px] text-ink-soft/60 pt-2 flex flex-col gap-0.5">
                                <span>Diperbarui oleh: <span class="font-semibold">{{ $subEvent->gformUpdatedBy->name }}</span></span>
                                <span>Pada: <span class="font-semibold">{{ $subEvent->gform_updated_at->translatedFormat('j M Y, H:i') }}</span></span>
                            </div>
                        @else
                            <div class="font-mono text-[10px] text-ink-soft/40 pt-2">
                                Belum pernah diperbarui.
                            </div>
                        @endif
                    </div>

                    <!-- Right: Form Update Link -->
                    <div class="flex-1 lg:max-w-xl">
                        <form method="POST" action="{{ route('admin.registration-links.update', $subEvent->id) }}" class="space-y-2">
                            @csrf
                            @method('PUT')
                            
                            <div class="flex flex-col sm:flex-row gap-2">
                                <div class="flex-grow relative">
                                    <input type="url" name="gform_link" value="{{ old('gform_link', $subEvent->gform_link) }}" 
                                           placeholder="https://docs.google.com/forms/d/..." 
                                           class="w-full border border-line rounded-[2px] px-3.5 py-2 text-sm bg-paper-warm/10 focus:outline-none focus:border-ember focus:ring-1 focus:ring-ember transition-colors" />
                                </div>
                                <button type="submit" class="bg-gradient-to-r from-ember to-ember-dark text-white font-semibold text-xs px-5 py-2 rounded-[2px] transition-premium hover:shadow-[0_8px_16px_-4px_rgba(226,101,11,0.4)] whitespace-nowrap">
                                    Simpan Tautan
                                </button>
                            </div>
                            
                            @error('gform_link', $subEvent->id)
                                <p class="text-xs text-rose-600 font-medium">{{ $message }}</p>
                            @enderror

                            <!-- Preview link -->
                            @if($subEvent->gform_link)
                                <div class="text-[11px] flex items-center gap-1">
                                    <span class="text-emerald-600">🔗</span>
                                    <a href="{{ $subEvent->gform_link }}" target="_blank" rel="noopener noreferrer" class="text-ink-soft hover:text-ember underline truncate block max-w-sm sm:max-w-md font-mono">
                                        {{ $subEvent->gform_link }}
                                    </a>
                                </div>
                            @else
                                <div class="text-[11px] text-amber-600 flex items-center gap-1 font-mono">
                                    <span>⏳</span>
                                    <span>Tautan kosong. Tombol di web publik akan berstatus "Segera Dibuka".</span>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-ink-soft/60">
                    Belum ada sub-acara terdaftar untuk tahun {{ $year }}. Hubungi Superadmin untuk membuat sub-acara.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
