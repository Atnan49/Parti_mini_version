<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubEvent;
use App\Models\AuditLog;
use App\Http\Requests\GformLinkRequest;

class RegistrationLinkController extends Controller
{
    public function index()
    {
        $year = session('active_year', config('parti.active_year', 2026));
        $subEvents = SubEvent::forYear($year)->notDeleted()->orderBy('order')->get();

        return view('admin.registration-links.index', compact('subEvents', 'year'));
    }

    public function update(GformLinkRequest $request, SubEvent $subEvent)
    {
        $oldLink = $subEvent->gform_link;
        
        $subEvent->update([
            'gform_link' => $request->gform_link,
            'gform_updated_by' => \Illuminate\Support\Facades\Auth::id(),
            'gform_updated_at' => now(),
        ]);

        // Audit Log
        AuditLog::create([
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'action' => 'Memperbarui tautan Google Form sub acara "' . $subEvent->name . '" dari "' . ($oldLink ?? 'Segera Dibuka') . '" menjadi "' . ($request->gform_link ?? 'Segera Dibuka') . '"',
            'entity_type' => 'SubEvent',
            'entity_id' => $subEvent->id,
        ]);

        return redirect()->back()->with('success', 'Tautan pendaftaran untuk ' . $subEvent->name . ' berhasil diperbarui.');
    }
}

