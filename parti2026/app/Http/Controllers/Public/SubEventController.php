<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\SubEvent;
use App\Models\SubEventDocument;

class SubEventController extends Controller
{
    public function show(string $slug)
    {
        // Cari data detail sub-acara aktif berdasarkan slug di database, tampilkan 404 jika tidak ditemukan
        $year = session('active_year', config('parti.active_year', 2026));
        $subEvent = SubEvent::where('year', $year)
            ->where('slug', $slug)
            ->published()
            ->notDeleted()
            ->with(['documents' => function ($query) {
                $query->orderBy('order');
            }])
            ->firstOrFail();

        return view('public.sub-event-detail', compact('subEvent'));
    }

    public function download(SubEventDocument $document)
    {
        // Validasi keamanan: Pastikan dokumen terhubung ke sub-acara publik yang aktif
        $document->loadMissing('subEvent');
        if (!$document->subEvent || $document->subEvent->status !== 'PUBLISHED' || $document->subEvent->is_deleted) {
            abort(404, 'File tidak ditemukan.');
        }

        $path = storage_path('app/public/' . $document->file_path);
        
        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($path, $document->label . '.' . $document->file_type);
    }
}
