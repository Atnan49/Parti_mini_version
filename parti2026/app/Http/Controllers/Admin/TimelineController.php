<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TimelineItem;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function index()
    {
        return 'Timeline Items List';
    }

    public function create()
    {
        return 'Create Timeline Item Form';
    }

    public function store(Request $request)
    {
        return 'Timeline Item Stored';
    }

    public function edit(TimelineItem $timeline)
    {
        return 'Edit Timeline Item Form';
    }

    public function update(Request $request, TimelineItem $timeline)
    {
        return 'Timeline Item Updated';
    }

    public function destroy(TimelineItem $timeline)
    {
        return 'Timeline Item Deleted';
    }

    public function reorder(Request $request)
    {
        return 'Timeline Items Reordered';
    }
}
