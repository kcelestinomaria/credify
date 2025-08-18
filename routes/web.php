<?php

use App\Http\Controllers\SuperAdminDashboardController;
use App\Http\Controllers\CredentialController;
use App\Http\Controllers\CredentialDownloadController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::view('/', 'welcome');
Route::view('/about', 'about')->name('about');

// Public credential search routes
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search.index');
Route::post('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search.credential');

// Public credential verification routes
Route::get('/verify/{id}', [CredentialController::class, 'verify'])->name('credential.verify');
Route::get('/api/verify/{id}', [CredentialController::class, 'verifyApi'])->name('credential.verify.api');

// Public credential download routes
Route::get('/credential/{id}/download', [CredentialDownloadController::class, 'downloadPublic'])->name('credential.download.public');
Route::get('/credential/{id}/hash', [CredentialDownloadController::class, 'getHash'])->name('credential.hash');

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

    // Credential API routes (for authenticated users)
    Route::get('/credential/{id}/details', [CredentialController::class, 'getDetails'])->name('credential.details');
    
    // Authenticated credential download routes
    Route::get('/credential/{id}/download/user', [CredentialDownloadController::class, 'downloadForUser'])->name('credential.download.user');
    Route::get('/credential/{id}/download/admin', [CredentialDownloadController::class, 'downloadForAdmin'])->name('credential.download.admin');
    Route::get('/credential/{id}/download/institutional-admin', [CredentialDownloadController::class, 'downloadForInstitutionalAdmin'])->name('credential.download.institutional-admin');

    // Profile routes (available to all authenticated users)
    Route::view('profile', 'profile')
        ->name('profile');
});
