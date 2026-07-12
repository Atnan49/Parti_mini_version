<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubEvent;
use Illuminate\Http\Request;

class RegistrationLinkController extends Controller
{
    public function index()
    {
        return 'Registration Links List';
    }

    public function update(Request $request, SubEvent $subEvent)
    {
        return 'Registration Link Updated';
    }
}
