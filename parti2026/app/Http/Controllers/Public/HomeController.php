<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\SubEvent;
use App\Models\TimelineItem;
use App\Models\Sponsor;

class HomeController extends Controller
{
    public function index()
    {
        // ponytail: check session active_year for admin previews, fallback to config
        $year = session('active_year', config('parti.active_year', 2026));

        $subEvents = SubEvent::forYear($year)->published()->notDeleted()->orderBy('order')->get();
        $timeline = TimelineItem::forYear($year)->orderBy('date')->orderBy('order')->get();
        $sponsors = Sponsor::forYear($year)->active()->orderBy('tier')->orderBy('order')->get();

        return view('public.home', compact('subEvents', 'timeline', 'sponsors'));
    }
}
