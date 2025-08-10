<?php

use App\Http\Controllers\SuperAdmin\InstitutionalAdminController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::resource('institutional-admins', InstitutionalAdminController::class);
    Route::patch('institutional-admins/{institutional_admin}/reset-password', [InstitutionalAdminController::class, 'resetPassword'])
        ->name('institutional-admins.reset-password');
});
