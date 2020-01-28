<?php

namespace App\Providers;

use App\Services\UserService;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $service = new UserService();

        Gate::define('isAdmin', function($user) use($service) {
            return $service->temPermissao($user, 'admin');
        });

        Gate::define('isComum', function($user) use($service) {
            return $service->temPermissao($user, 'comum');
         });
    }
}
