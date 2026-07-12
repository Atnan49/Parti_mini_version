<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubEvent;
use Illuminate\Http\Request;

class SubEventController extends Controller
{
    public function index()
    {
        return 'Admin Sub Events List';
    }

    public function create()
    {
        return 'Create Sub Event Form';
    }

    public function store(Request $request)
    {
        return 'Sub Event Stored';
    }

    public function edit(SubEvent $subEvent)
    {
        return 'Edit Sub Event Form';
    }

    public function update(Request $request, SubEvent $subEvent)
    {
        return 'Sub Event Updated';
    }

    public function destroy(SubEvent $subEvent)
    {
        return 'Sub Event Deleted';
    }

    public function updateStatus(Request $request, SubEvent $subEvent)
    {
        return 'Sub Event Status Updated';
    }

    public function reorder(Request $request)
    {
        return 'Sub Events Reordered';
    }
}
