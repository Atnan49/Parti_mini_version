<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return 'Users List';
    }

    public function create()
    {
        return 'Create User Form';
    }

    public function store(Request $request)
    {
        return 'User Stored';
    }

    public function deactivate(User $user)
    {
        return 'User Deactivated';
    }

    public function activate(User $user)
    {
        return 'User Activated';
    }

    public function resetPassword(Request $request, User $user)
    {
        return 'User Password Reset';
    }
}
