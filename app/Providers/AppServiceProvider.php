<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            if ($user->hasRole('super_admin')) {
                // Super admin tidak memiliki izin untuk 'upload documents'
                if ($ability === 'manage rentals') {
                    return null; // Tidak memberikan izin untuk upload documents
                }

                return true; // Memberikan izin untuk kemampuan lainnya
            }
        });
    }
}
