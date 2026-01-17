<?php

namespace App\Providers;

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
        try {
            // Share unique category types for navbar dropdown
            // Using try-catch to avoid errors during migration/setup if table doesn't exist
            if (\Illuminate\Support\Facades\Schema::hasTable('category')) {
                $navbarTypes = \App\Models\Category::select('type')
                    ->distinct()
                    ->whereNotNull('type')
                    ->pluck('type');
                
                \Illuminate\Support\Facades\View::share('navbarTypes', $navbarTypes);
            }
        } catch (\Exception $e) {
            // Quiet fail if database issues
        }
    }
}
