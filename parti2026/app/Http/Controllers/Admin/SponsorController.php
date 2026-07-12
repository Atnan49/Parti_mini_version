<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    public function index()
    {
        return 'Sponsors List';
    }

    public function create()
    {
        return 'Create Sponsor Form';
    }

    public function store(Request $request)
    {
        return 'Sponsor Stored';
    }

    public function edit(Sponsor $sponsor)
    {
        return 'Edit Sponsor Form';
    }

    public function update(Request $request, Sponsor $sponsor)
    {
        return 'Sponsor Updated';
    }

    public function destroy(Sponsor $sponsor)
    {
        return 'Sponsor Deleted';
    }

    public function reorder(Request $request)
    {
        return 'Sponsors Reordered';
    }
}
