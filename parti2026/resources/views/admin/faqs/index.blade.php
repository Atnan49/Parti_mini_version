@extends('layouts.admin')

@section('title', 'Manajemen FAQ (Q&A)')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Manajemen FAQ</h2>
        <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Kelola daftar pertanyaan yang sering diajukan di halaman utama.</p>
    </div>
    <a href="{{ route('admin.faqs.create') }}" class="px-4 py-2 bg-[#27C93F] text-black font-bold rounded-xl shadow-lg hover:bg-[#1fa032] transition-colors flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah FAQ
    </a>
</div>

<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-600 dark:text-gray-400">
            <thead class="bg-gray-50 dark:bg-gray-900/50 text-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-6 py-4 font-semibold">Urutan</th>
                    <th class="px-6 py-4 font-semibold">Kategori</th>
                    <th class="px-6 py-4 font-semibold">Pertanyaan</th>
                    <th class="px-6 py-4 font-semibold text-center">Status</th>
                    <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse ($faqs as $faq)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4 font-mono">{{ $faq->order }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            <span class="px-3 py-1 bg-gray-100 dark:bg-gray-700 rounded-full text-xs">{{ $faq->category }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900 dark:text-white">{{ $faq->question }}</div>
                            <div class="text-xs mt-1 text-gray-500 line-clamp-1">{{ Str::limit($faq->answer, 60) }}</div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($faq->is_active)
                                <span class="px-3 py-1 bg-green-100 text-green-700 dark:bg-green-500/20 dark:text-green-400 rounded-full text-xs font-medium">Aktif</span>
                            @else
                                <span class="px-3 py-1 bg-red-100 text-red-700 dark:bg-red-500/20 dark:text-red-400 rounded-full text-xs font-medium">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.faqs.edit', $faq) }}" class="p-2 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition-colors" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                            Belum ada data FAQ. <a href="{{ route('admin.faqs.create') }}" class="text-[#27C93F] hover:underline">Tambah sekarang</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
