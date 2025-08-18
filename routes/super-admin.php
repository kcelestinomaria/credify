<?php

use App\Http\Controllers\SuperAdminDashboardController;
use Illuminate\Support\Facades\Route;

// Super Admin Dashboard
Route::get('/dashboard', [SuperAdminDashboardController::class, 'index'])->name('dashboard');

// Add more Super Admin routes here as needed
