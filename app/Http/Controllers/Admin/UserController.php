<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeAccountMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')
            ->where('admin_id', auth()->id())
            ->latest()
            ->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

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

        $user = User::create([
            'name' => $data['name'],

            'email' => $data['email'],

            'password' => Hash::make($data['password']),

            'role' => 'user',

            'admin_id' => auth()->id(),

            'is_active' => true,
        ]);

        Mail::to($user->email)->send(
            new WelcomeAccountMail(
                $user->name,
                $user->email,
                $data['password'],
                url('/login')
            )
        );

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        abort_unless(
            $user->role === 'user' &&
            $user->admin_id === auth()->id(),
            403
        );

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        abort_unless(
            $user->role === 'user' &&
            $user->admin_id === auth()->id(),
            403
        );

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,'.$user->id,
            ],
        ]);

        $user->update([
            'name' => $data['name'],

            'email' => $data['email'],
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function toggleStatus(User $user)
    {
        abort_unless(
            $user->role === 'user' &&
            $user->admin_id === auth()->id(),
            403
        );

        $user->update([
            'is_active' => ! $user->is_active,
        ]);

        return back()
            ->with('success', 'User status updated.');
    }
}
