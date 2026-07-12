<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    public function edit()
    {
        return 'Change Password Form';
    }

    public function update(Request $request)
    {
        return 'Password Updated';
    }
}
