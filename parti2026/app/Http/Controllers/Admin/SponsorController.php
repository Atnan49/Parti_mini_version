<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SponsorController extends Controller
{
    public function index()
    {
        $year = session('active_year', config('parti.active_year', 2026));
        $sponsors = Sponsor::forYear($year)->orderBy('tier')->orderBy('order')->get();

        return view('admin.sponsors.index', compact('sponsors', 'year'));
    }

    public function create()
    {
        return view('admin.sponsors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['required', 'image', 'max:2048'], // max 2MB logo
            'website_url' => ['nullable', 'url', 'max:255'],
            'tier' => ['required', 'in:PLATINUM,GOLD,SILVER,BRONZE'],
            'order' => ['required', 'integer', 'min:0'],
        ]);

        $year = session('active_year', config('parti.active_year', 2026));
        $logoPath = $request->file('logo')->store('sponsors', 'public');

        $sponsor = Sponsor::create([
            'year' => $year,
            'name' => $validated['name'],
            'logo_path' => $logoPath,
            'website_url' => $validated['website_url'],
            'tier' => $validated['tier'],
            'order' => $validated['order'],
            'is_active' => $request->has('is_active'),
        ]);

        // Audit Log
        AuditLog::create([
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'action' => 'Menambahkan sponsor baru: ' . $sponsor->name . ' (' . $sponsor->tier . ')',
            'entity_type' => 'Sponsor',
            'entity_id' => $sponsor->id,
        ]);

        return redirect()->route('admin.sponsors.index')->with('success', 'Sponsor berhasil ditambahkan.');
    }

    public function edit(Sponsor $sponsor)
    {
        return view('admin.sponsors.edit', compact('sponsor'));
    }

    public function update(Request $request, Sponsor $sponsor)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'tier' => ['required', 'in:PLATINUM,GOLD,SILVER,BRONZE'],
            'order' => ['required', 'integer', 'min:0'],
        ]);

        $data = [
            'name' => $validated['name'],
            'website_url' => $validated['website_url'],
            'tier' => $validated['tier'],
            'order' => $validated['order'],
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('logo')) {
            // Delete old file
            if (Storage::disk('public')->exists($sponsor->logo_path)) {
                Storage::disk('public')->delete($sponsor->logo_path);
            }
            $data['logo_path'] = $request->file('logo')->store('sponsors', 'public');
        }

        $sponsor->update($data);

        // Audit Log
        AuditLog::create([
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'action' => 'Mengubah detail sponsor: ' . $sponsor->name,
            'entity_type' => 'Sponsor',
            'entity_id' => $sponsor->id,
        ]);

        return redirect()->route('admin.sponsors.index')->with('success', 'Sponsor berhasil diperbarui.');
    }

    public function destroy(Sponsor $sponsor)
    {
        // Delete logo file
        if (Storage::disk('public')->exists($sponsor->logo_path)) {
            Storage::disk('public')->delete($sponsor->logo_path);
        }

        // Audit Log before deletion
        AuditLog::create([
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'action' => 'Menghapus sponsor: ' . $sponsor->name,
            'entity_type' => 'Sponsor',
            'entity_id' => $sponsor->id,
        ]);

        $sponsor->delete();

        return redirect()->route('admin.sponsors.index')->with('success', 'Sponsor berhasil dihapus.');
    }

    public function reorder(Request $request)
    {
        return back();
    }
}

