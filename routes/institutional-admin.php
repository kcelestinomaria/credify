<?php

use App\Http\Controllers\InstitutionalAdmin\DashboardController;
use App\Http\Controllers\InstitutionalAdmin\StudentController;
use App\Http\Controllers\InstitutionalAdmin\CredentialController;
use App\Http\Controllers\InstitutionalAdmin\ProfileController;
use Illuminate\Support\Facades\Route;

// Institutional Admin Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Student Management
Route::resource('students', StudentController::class);
Route::patch('students/{student}/reset-password', [StudentController::class, 'resetPassword'])->name('students.reset-password');

// Credential Management
Route::resource('credentials', CredentialController::class);
Route::get('credentials/{credential}/download', [CredentialController::class, 'download'])->name('credentials.download');

// Profile Management
Route::prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'show'])->name('show');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/update', [ProfileController::class, 'update'])->name('update');
    Route::get('/change-password', [ProfileController::class, 'editPassword'])->name('change-password');
    Route::patch('/change-password', [ProfileController::class, 'updatePassword'])->name('update-password');
});
