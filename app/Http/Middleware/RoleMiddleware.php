<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        string $role
    ): Response {
        if (!auth()->check()) {
            return match ($role) {
                'super_admin' => redirect()->route('super-admin.login'),
                'admin' => redirect()->route('admin.login'),
                'user' => redirect()->route('login'),
                default => abort(403),
            };
        }

        $user = auth()->user();

        if ($user->role !== $role) {
            abort(403, 'You are not authorized to access this area.');
        }

        if (!$user->is_active) {
            auth()->logout();

            return match ($role) {
                'super_admin' => redirect()
                    ->route('super-admin.login')
                    ->withErrors([
                        'email' => 'Your account is inactive.',
                    ]),

                'admin' => redirect()
                    ->route('admin.login')
                    ->withErrors([
                        'email' => 'Your account is inactive.',
                    ]),

                default => redirect()
                    ->route('login')
                    ->withErrors([
                        'email' => 'Your account is inactive.',
                    ]),
            };
        }

        return $next($request);
    }
}