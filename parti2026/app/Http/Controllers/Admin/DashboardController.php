<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Setting;
use App\Models\Sponsor;
use App\Models\SubEvent;
use App\Models\TimelineItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $recentLogs = Auth::user()->role === 'SUPERADMIN' 
            ? AuditLog::with('user')->orderBy('created_at', 'desc')->take(5)->get()
            : collect();

        return view('admin.dashboard', compact('stats', 'recentLogs', 'year'));
    }

    public function changeYear(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|min:2020|max:2050',
        ]);

        // ponytail: Save globally to Database so all devices see the update immediately
        Setting::set('active_year', $request->year);
        config(['parti.active_year' => (int) $request->year]);
        session(['active_year' => $request->year]);

        return back()->with('success', 'Tahun aktif berhasil diubah secara global menjadi PARTI ' . $request->year);
    }
}
