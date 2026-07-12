<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\SubEvent;
use App\Models\SubEventDocument;

class SubEventController extends Controller
{
    public function show(string $slug)
    {
        // ponytail: query directly to database, abort if not found
        $subEvent = SubEvent::where('slug', $slug)
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
        // ponytail: native response download for local file paths
        $path = storage_path('app/public/' . $document->file_path);
        
        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($path, $document->label . '.' . $document->file_type);
    }
}
