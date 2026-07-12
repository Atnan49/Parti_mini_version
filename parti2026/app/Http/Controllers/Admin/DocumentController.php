<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubEvent;
use App\Models\SubEventDocument;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(SubEvent $subEvent)
    {
        return 'Documents List for Sub Event';
    }

    public function store(Request $request, SubEvent $subEvent)
    {
        return 'Document Stored';
    }

    public function update(Request $request, SubEventDocument $document)
    {
        return 'Document Updated';
    }

    public function destroy(SubEventDocument $document)
    {
        return 'Document Deleted';
    }

    public function reorder(Request $request, SubEvent $subEvent)
    {
        return 'Documents Reordered';
    }
}
