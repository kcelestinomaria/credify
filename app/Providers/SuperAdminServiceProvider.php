<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SuperAdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register any bindings or services here
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerRoutes();
        $this->loadViewsFrom(
            resource_path('views/super-admin'), 'super-admin'
        );
    }

    /**
     * Register the Super Admin routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::middleware(['web', 'auth', 'role:super_admin'])
            ->prefix('super-admin')
            ->name('super-admin.')
            ->group(base_path('routes/super-admin.php'));
            
        // Register institutions routes
        Route::middleware(['web', 'auth', 'role:super_admin'])
            ->group(function () {
                Route::resource('institutions', \App\Http\Controllers\SuperAdmin\InstitutionController::class);
            });
            
        // Register institutional admin routes
        Route::middleware(['web'])
            ->group(base_path('routes/super-admin/institutional-admins.php'));
    }
}
