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
        // $this->registerPolicies();

        Gate::define('admin', function ($user) {
            return $user->hasRole('ADMIN');
        });

        Gate::define('mess_owner', function ($user) {
            return $user->hasRole('MESS_OWNER');
        });
        Gate::define('customer', function ($user) {
            return $user->hasRole('CUSTOMER');
        });
    }
}
