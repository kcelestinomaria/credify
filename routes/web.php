<?php

use App\Http\Controllers\SuperAdminDashboardController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::view('/', 'welcome');

// Authentication routes
require __DIR__.'/auth.php';

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard route with role-based redirection
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'super_admin') {
            return redirect()->route('super-admin.dashboard');
        } elseif (auth()->user()->role === 'institutional_admin') {
            return redirect()->route('institutional-admin.dashboard');
        }
        
        // Default dashboard for other roles (students)
        return view('dashboard');
    })->name('dashboard');

    // Super Admin routes
    Route::prefix('super-admin')->name('super-admin.')->middleware('role:super_admin')->group(function () {
        Route::get('/dashboard', [SuperAdminDashboardController::class, 'index'])->name('dashboard');
        // Add more Super Admin routes here
    });

    // Institutional Admin routes
    Route::prefix('institutional-admin')->name('institutional-admin.')->middleware('role:institutional_admin')->group(function () {
        require __DIR__.'/institutional-admin.php';
    });

    // Profile routes (available to all authenticated users)
    Route::view('profile', 'profile')
        ->name('profile');
});
