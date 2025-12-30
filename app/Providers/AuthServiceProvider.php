<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
<<<<<<< HEAD
        Gate::define('admin', function ($user) {
            return $user->role === 'admin';
        });
    }

    
=======
         Gate::define('admin', function ($user) {
        return $user->role === 'admin';
    });
}
>>>>>>> be5e30b4674e3d786da31ab2198c4a1d96e2effa
}