<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubEvent;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubEventController extends Controller
{
    public function index()
    {
        $year = session('active_year', config('parti.active_year', 2026));
        $subEvents = SubEvent::forYear($year)->notDeleted()->orderBy('order')->get();

        return view('admin.sub-events.index', compact('subEvents', 'year'));
    }

    public function create()
    {
        return view('admin.sub-events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'date_start' => ['nullable', 'date'],
            'date_end' => ['nullable', 'date', 'after_or_equal:date_start'],
            'pj_names' => ['nullable', 'string'],
            'htm_tiers' => [
                'nullable',
                'string',
                // ponytail: validate label:price, label:price:HABIS, or label:HABIS
                function ($attribute, $value, $fail) {
                    $lines = array_filter(array_map('trim', explode("\n", str_replace("\r", "", $value))));
                    foreach ($lines as $line) {
                        $parts = array_map('trim', explode(':', $line));
                        if (count($parts) === 2) {
                            $isNum = is_numeric($parts[1]);
                            $isSold = in_array(strtoupper(str_replace([' ', '_', '-'], '', $parts[1])), ['HABIS', 'SOLDOUT', 'TUTUP', 'CLOSED']);
                            if (empty($parts[0]) || (!$isNum && !$isSold)) {
                                $fail('Format HTM per baris harus berupa "Kategori:Harga" (contoh: Umum:35000), "Kategori:Harga:HABIS", atau "Kategori:HABIS".');
                                return;
                            }
                        } elseif (count($parts) === 3) {
                            $isNum = is_numeric($parts[1]);
                            $isSold = in_array(strtoupper(str_replace([' ', '_', '-'], '', $parts[2])), ['HABIS', 'SOLDOUT', 'TUTUP', 'CLOSED']);
                            if (empty($parts[0]) || !$isNum || !$isSold) {
                                $fail('Format HTM per baris harus berupa "Kategori:Harga" (contoh: Umum:35000), "Kategori:Harga:HABIS", atau "Kategori:HABIS".');
                                return;
                            }
                        } else {
                            $fail('Format HTM per baris harus berupa "Kategori:Harga" (contoh: Umum:35000), "Kategori:Harga:HABIS", atau "Kategori:HABIS".');
                            return;
                        }
                    }
                }
            ],
            'order' => ['required', 'integer', 'min:0'],
            'type' => ['required', 'in:ONLINE,OFFLINE,HYBRID'],
            'location' => ['nullable', 'string', 'max:255'],
            'poster' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        $year = session('active_year', config('parti.active_year', 2026));

        // Parse PJ Names (comma separated)
        $pjNames = [];
        if (!empty($validated['pj_names'])) {
            $pjNames = array_filter(array_map('trim', explode(',', $validated['pj_names'])));
        }

        // Parse HTM Tiers (label:price or label:price:HABIS per line)
        // ponytail: parse HTM tiers supporting HABIS/SOLDOUT status
        $htmTiers = [];
        if (!empty($validated['htm_tiers'])) {
            $lines = array_filter(array_map('trim', explode("\n", str_replace("\r", "", $validated['htm_tiers']))));
            foreach ($lines as $line) {
                $parts = array_map('trim', explode(':', $line));
                if (count($parts) === 2) {
                    $isSold = in_array(strtoupper(str_replace([' ', '_', '-'], '', $parts[1])), ['HABIS', 'SOLDOUT', 'TUTUP', 'CLOSED']);
                    $htmTiers[] = [
                        'label' => $parts[0],
                        'price' => $isSold ? 0 : (int) $parts[1],
                        'is_sold_out' => $isSold,
                    ];
                } elseif (count($parts) === 3) {
                    $htmTiers[] = [
                        'label' => $parts[0],
                        'price' => (int) $parts[1],
                        'is_sold_out' => true,
                    ];
                }
            }
        }

        $posterPath = null;
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
        }

        $subEvent = SubEvent::create([
            'year' => $year,
            'name' => $validated['name'],
            'tagline' => $validated['tagline'],
            'description' => $validated['description'],
            'date_start' => $validated['date_start'],
            'date_end' => $validated['date_end'],
            'pj_names' => $pjNames,
            'htm_tiers' => $htmTiers,
            'status' => 'DRAFT',
            'order' => $validated['order'],
            'is_deleted' => false,
            'type' => $validated['type'],
            'location' => $validated['location'],
            'poster_path' => $posterPath,
        ]);

        // Audit Log
        AuditLog::create([
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'action' => 'Membuat sub acara baru: ' . $subEvent->name,
            'entity_type' => 'SubEvent',
            'entity_id' => $subEvent->id,
        ]);

        return redirect()->route('admin.sub-events.index')->with('success', 'Sub acara berhasil ditambahkan.');
    }

    public function edit(SubEvent $subEvent)
    {
        // Format arrays back to strings for form editing
        $pjNamesString = $subEvent->pj_names ? implode(', ', $subEvent->pj_names) : '';
        
        // ponytail: format HTM back to string with :HABIS flag if sold out
        $htmTiersString = '';
        if ($subEvent->htm_tiers) {
            $tierLines = [];
            foreach ($subEvent->htm_tiers as $tier) {
                $isSold = !empty($tier['is_sold_out']) || (isset($tier['price']) && is_string($tier['price']) && in_array(strtoupper(str_replace([' ', '_', '-'], '', $tier['price'])), ['HABIS', 'SOLDOUT', 'TUTUP', 'CLOSED']));
                $price = is_numeric($tier['price'] ?? null) ? (int) $tier['price'] : 0;

                if ($isSold) {
                    $tierLines[] = $price > 0 ? "{$tier['label']}:{$price}:HABIS" : "{$tier['label']}:HABIS";
                } else {
                    $tierLines[] = "{$tier['label']}:{$price}";
                }
            }
            $htmTiersString = implode("\n", $tierLines);
        }

        return view('admin.sub-events.edit', compact('subEvent', 'pjNamesString', 'htmTiersString'));
    }

    public function update(Request $request, SubEvent $subEvent)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'date_start' => ['nullable', 'date'],
            'date_end' => ['nullable', 'date', 'after_or_equal:date_start'],
            'pj_names' => ['nullable', 'string'],
            'htm_tiers' => [
                'nullable',
                'string',
                // ponytail: validate label:price, label:price:HABIS, or label:HABIS
                function ($attribute, $value, $fail) {
                    $lines = array_filter(array_map('trim', explode("\n", str_replace("\r", "", $value))));
                    foreach ($lines as $line) {
                        $parts = array_map('trim', explode(':', $line));
                        if (count($parts) === 2) {
                            $isNum = is_numeric($parts[1]);
                            $isSold = in_array(strtoupper(str_replace([' ', '_', '-'], '', $parts[1])), ['HABIS', 'SOLDOUT', 'TUTUP', 'CLOSED']);
                            if (empty($parts[0]) || (!$isNum && !$isSold)) {
                                $fail('Format HTM per baris harus berupa "Kategori:Harga" (contoh: Umum:35000), "Kategori:Harga:HABIS", atau "Kategori:HABIS".');
                                return;
                            }
                        } elseif (count($parts) === 3) {
                            $isNum = is_numeric($parts[1]);
                            $isSold = in_array(strtoupper(str_replace([' ', '_', '-'], '', $parts[2])), ['HABIS', 'SOLDOUT', 'TUTUP', 'CLOSED']);
                            if (empty($parts[0]) || !$isNum || !$isSold) {
                                $fail('Format HTM per baris harus berupa "Kategori:Harga" (contoh: Umum:35000), "Kategori:Harga:HABIS", atau "Kategori:HABIS".');
                                return;
                            }
                        } else {
                            $fail('Format HTM per baris harus berupa "Kategori:Harga" (contoh: Umum:35000), "Kategori:Harga:HABIS", atau "Kategori:HABIS".');
                            return;
                        }
                    }
                }
            ],
            'order' => ['required', 'integer', 'min:0'],
            'type' => ['required', 'in:ONLINE,OFFLINE,HYBRID'],
            'location' => ['nullable', 'string', 'max:255'],
            'poster' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        // Parse PJ Names (comma separated)
        $pjNames = [];
        if (!empty($validated['pj_names'])) {
            $pjNames = array_filter(array_map('trim', explode(',', $validated['pj_names'])));
        }

        // Parse HTM Tiers (label:price or label:price:HABIS per line)
        // ponytail: parse HTM tiers supporting HABIS/SOLDOUT status
        $htmTiers = [];
        if (!empty($validated['htm_tiers'])) {
            $lines = array_filter(array_map('trim', explode("\n", str_replace("\r", "", $validated['htm_tiers']))));
            foreach ($lines as $line) {
                $parts = array_map('trim', explode(':', $line));
                if (count($parts) === 2) {
                    $isSold = in_array(strtoupper(str_replace([' ', '_', '-'], '', $parts[1])), ['HABIS', 'SOLDOUT', 'TUTUP', 'CLOSED']);
                    $htmTiers[] = [
                        'label' => $parts[0],
                        'price' => $isSold ? 0 : (int) $parts[1],
                        'is_sold_out' => $isSold,
                    ];
                } elseif (count($parts) === 3) {
                    $htmTiers[] = [
                        'label' => $parts[0],
                        'price' => (int) $parts[1],
                        'is_sold_out' => true,
                    ];
                }
            }
        }

        $data = [
            'name' => $validated['name'],
            'tagline' => $validated['tagline'],
            'description' => $validated['description'],
            'date_start' => $validated['date_start'],
            'date_end' => $validated['date_end'],
            'pj_names' => $pjNames,
            'htm_tiers' => $htmTiers,
            'order' => $validated['order'],
            'type' => $validated['type'],
            'location' => $validated['location'],
        ];

        if ($request->hasFile('poster')) {
            // Delete old file
            if ($subEvent->poster_path && Storage::disk('public')->exists($subEvent->poster_path)) {
                Storage::disk('public')->delete($subEvent->poster_path);
            }

            // Save new file
            $data['poster_path'] = $request->file('poster')->store('posters', 'public');
        }

        $subEvent->update($data);

        // Audit Log
        AuditLog::create([
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'action' => 'Mengubah detail sub acara: ' . $subEvent->name,
            'entity_type' => 'SubEvent',
            'entity_id' => $subEvent->id,
        ]);

        return redirect()->route('admin.sub-events.index')->with('success', 'Sub acara berhasil diperbarui.');
    }

    public function destroy(SubEvent $subEvent)
    {
        // Delete poster file if exists
        if ($subEvent->poster_path && Storage::disk('public')->exists($subEvent->poster_path)) {
            Storage::disk('public')->delete($subEvent->poster_path);
            $subEvent->poster_path = null;
        }

        // Also delete all associated document files and delete the document records
        foreach ($subEvent->documents as $document) {
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }
            $document->delete();
        }

        $subEvent->is_deleted = true;
        $subEvent->save();

        // Audit Log
        AuditLog::create([
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'action' => 'Menghapus sub acara (soft-delete) beserta poster & berkasnya: ' . $subEvent->name,
            'entity_type' => 'SubEvent',
            'entity_id' => $subEvent->id,
        ]);

        return redirect()->route('admin.sub-events.index')->with('success', 'Sub acara berhasil dihapus.');
    }

    public function updateStatus(Request $request, SubEvent $subEvent)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:DRAFT,PUBLISHED,CLOSED'],
        ]);

        $oldStatus = $subEvent->status;
        $subEvent->update(['status' => $validated['status']]);

        // Audit Log
        AuditLog::create([
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'action' => 'Mengubah status sub acara "' . $subEvent->name . '" dari "' . $oldStatus . '" menjadi "' . $validated['status'] . '"',
            'entity_type' => 'SubEvent',
            'entity_id' => $subEvent->id,
        ]);

        return redirect()->route('admin.sub-events.index')->with('success', 'Status sub acara ' . $subEvent->name . ' berhasil diperbarui.');
    }


}

