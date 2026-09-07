<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeAccountMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')
            ->latest()
            ->get();

        return view('super-admin.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('super-admin.admins.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
            ],
        ]);

        $admin = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'admin',
            'admin_id' => null,
            'is_active' => true,
        ]);

        Mail::to($admin->email)->send(
            new WelcomeAccountMail(
                $admin->name,
                $admin->email,
                $data['password'],
                url('/admin/login')
            )
        );

        return redirect()
            ->route('super-admin.admins.index')
            ->with('success', 'Admin created successfully.');
    }

    public function edit(User $admin)
    {
        abort_unless($admin->role === 'admin', 404);

        return view('super-admin.admins.edit', compact('admin'));
    }

    public function update(Request $request, User $admin)
    {
        abort_unless($admin->role === 'admin', 404);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,'.$admin->id,
            ],
        ]);

        $admin->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        return redirect()
            ->route('super-admin.admins.index')
            ->with('success', 'Admin updated successfully.');
    }

    public function toggleStatus(User $admin)
    {
        abort_unless($admin->role === 'admin', 404);

        $admin->update([
            'is_active' => ! $admin->is_active,
        ]);

        return back()->with('success', 'Admin status updated.');
    }
}
