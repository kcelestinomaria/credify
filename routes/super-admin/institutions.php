<?php

use App\Http\Controllers\SuperAdmin\InstitutionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::resource('institutions', InstitutionController::class)->except(['show']);
    
    // If you want to enable the show route, you can use this instead:
    // Route::resource('institutions', InstitutionController::class);
});
