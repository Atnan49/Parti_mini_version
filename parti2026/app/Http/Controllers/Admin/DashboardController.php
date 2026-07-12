<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubEvent;
use App\Models\TimelineItem;
use App\Models\Sponsor;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $year = session('active_year', config('parti.active_year', 2026));

        $stats = [
            'sub_events_count' => SubEvent::forYear($year)->notDeleted()->count(),
            'timeline_count' => TimelineItem::forYear($year)->count(),
            'sponsors_count' => Sponsor::forYear($year)->count(),
        ];

        $recentLogs = \Illuminate\Support\Facades\Auth::user()->role === 'SUPERADMIN' 
            ? AuditLog::with('user')->orderBy('created_at', 'desc')->take(5)->get()
            : collect();

        return view('admin.dashboard', compact('stats', 'recentLogs', 'year'));
    }

    public function changeYear(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|min:2020|max:2050',
        ]);

        session(['active_year' => $request->year]);

        return back()->with('success', 'Tahun aktif berhasil diubah menjadi PARTI ' . $request->year);
    }
}

