<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('dashboard');
});

// Redirect ke dashboard setelah login
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // // Route untuk Admin
    // Route::middleware(['check.role:admin'])->group(function () {
    //     Route::get('/master-data', function () {
    //         return view('admin.master-data');
    //     })->name('master-data');

    //     Route::get('/user-management', function () {
    //         return view('admin.user-management');
    //     })->name('user-management');
    // });

    // // Route untuk Operator
    // Route::middleware(['check.role:operator,admin'])->group(function () {
    //     Route::get('/input-data', function () {
    //         return view('operator.input-data');
    //     })->name('input-data');

    //     Route::get('/report', function () {
    //         return view('operator.report');
    //     })->name('report');
    // });
});



Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});

require __DIR__ . '/auth.php';
