<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')
            ->with('admin')
            ->latest()
            ->get();

        return view('super-admin.users.index', compact('users'));
    }
}