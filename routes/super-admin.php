<?php

use App\Http\Controllers\SuperAdminDashboardController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// Super Admin Dashboard
Route::get('/dashboard', [SuperAdminDashboardController::class, 'index'])->name('dashboard');

// PDF Reports Routes
Route::get('/reports/system-audit', [ReportController::class, 'systemAuditReport'])->name('reports.system-audit');
Route::get('/reports/users', [ReportController::class, 'usersReport'])->name('reports.users');
Route::get('/reports/credentials', [ReportController::class, 'credentialsReport'])->name('reports.credentials');

// Add more Super Admin routes here as needed
