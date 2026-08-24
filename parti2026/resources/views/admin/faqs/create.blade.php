@extends('layouts.admin')

@section('title', 'Tambah FAQ Baru')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Tambah FAQ Baru</h2>
    <a href="{{ route('admin.faqs.index') }}" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white font-medium rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
        Kembali
    </a>
</div>

<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 md:p-8">
    <form action="{{ route('admin.faqs.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Kategori</label>
                <input type="text" name="category" value="{{ old('category', 'Umum') }}" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#27C93F] focus:border-transparent outline-none transition-all" required placeholder="Contoh: Umum, Pendaftaran, Futsal">
                @error('category') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Urutan Tampil</label>
                <input type="number" name="order" value="{{ old('order', 1) }}" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#27C93F] focus:border-transparent outline-none transition-all" required min="1">
                <p class="text-xs text-gray-500 mt-1">Angka terkecil akan tampil paling atas.</p>
                @error('order') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Pertanyaan</label>
            <input type="text" name="question" value="{{ old('question') }}" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#27C93F] focus:border-transparent outline-none transition-all" required placeholder="Tuliskan pertanyaan...">
            @error('question') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Jawaban</label>
            <textarea name="answer" rows="5" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#27C93F] focus:border-transparent outline-none transition-all" required placeholder="Tuliskan jawaban yang informatif...">{{ old('answer') }}</textarea>
            @error('answer') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-3 mt-4">
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-5 h-5 text-[#27C93F] rounded border-gray-300 focus:ring-[#27C93F]">
            <label for="is_active" class="text-sm font-semibold text-gray-700 dark:text-gray-300">Tampilkan FAQ ini (Aktif)</label>
        </div>

        <div class="pt-4 flex justify-end">
            <button type="submit" class="px-6 py-3 bg-[#27C93F] text-black font-bold rounded-xl shadow-lg hover:bg-[#1fa032] transition-colors">
                Simpan FAQ
            </button>
        </div>
    </form>
</div>
@endsection
