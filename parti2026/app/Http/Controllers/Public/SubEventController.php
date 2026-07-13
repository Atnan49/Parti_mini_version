<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\SubEvent;
use App\Models\SubEventDocument;

class SubEventController extends Controller
{
    public function show(string $slug)
    {
        // ponytail: query directly to database for the active year, abort if not found
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
        // ponytail: verify document belongs to an active, published sub-event to prevent IDOR
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
