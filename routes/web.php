<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\SuperAdmin\AdminController as SuperAdminAdminController;
use App\Http\Controllers\SuperAdmin\AuthController as SuperAdminAuthController;
use App\Http\Controllers\SuperAdmin\UserController as SuperAdminUserController;
use App\Http\Controllers\User\AuthController as UserAuthController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Super Admin Authentication
|--------------------------------------------------------------------------
*/

Route::get('/super-admin/login', [SuperAdminAuthController::class, 'showLogin'])
    ->name('super-admin.login');

Route::post('/super-admin/login', [SuperAdminAuthController::class, 'login'])
    ->name('super-admin.login.submit');

Route::post('/super-admin/logout', [SuperAdminAuthController::class, 'logout'])
    ->name('super-admin.logout');


/*
|--------------------------------------------------------------------------
| Admin Authentication
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->name('admin.logout');


/*
|--------------------------------------------------------------------------
| User Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login', [UserAuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [UserAuthController::class, 'login'])
    ->name('user.login.submit');

Route::post('/logout', [UserAuthController::class, 'logout'])
    ->name('user.logout');


/*
|--------------------------------------------------------------------------
| Super Admin Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('role:super_admin')
    ->prefix('super-admin')
    ->name('super-admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('super-admin.dashboard');
        })->name('dashboard');

        Route::get('/admins', [SuperAdminAdminController::class, 'index'])
            ->name('admins.index');

        Route::get('/admins/create', [SuperAdminAdminController::class, 'create'])
            ->name('admins.create');

        Route::post('/admins', [SuperAdminAdminController::class, 'store'])
            ->name('admins.store');

        Route::get('/admins/{admin}/edit', [SuperAdminAdminController::class, 'edit'])
            ->name('admins.edit');

        Route::put('/admins/{admin}', [SuperAdminAdminController::class, 'update'])
            ->name('admins.update');

        Route::post('/admins/{admin}/toggle-status', [SuperAdminAdminController::class, 'toggleStatus'])
            ->name('admins.toggle-status');

          // View all users
        Route::get('/users', [SuperAdminUserController::class, 'index'])
            ->name('users.index');

    });
/*
|--------------------------------------------------------------------------
| Admin Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('role:admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/users', [AdminUserController::class, 'index'])
            ->name('users.index');

        Route::get('/users/create', [AdminUserController::class, 'create'])
            ->name('users.create');

        Route::post('/users', [AdminUserController::class, 'store'])
            ->name('users.store');

        Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])
            ->name('users.edit');

        Route::put('/users/{user}', [AdminUserController::class, 'update'])
            ->name('users.update');

        Route::post('/users/{user}/toggle-status', [AdminUserController::class, 'toggleStatus'])
            ->name('users.toggle-status');

    });

/*
/*
|--------------------------------------------------------------------------
| User Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('role:user')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::put('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');

    });