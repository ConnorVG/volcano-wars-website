<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // ...
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::tokensCan(config('passport.scopes'));

        $expires = config('passport.expires');

        $token = array_get($expires, 'token', 15);
        $refresh = array_get($expires, 'refresh', 30);

        Passport::tokensExpireIn(Carbon::now()->addDays($token));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays($refresh));
    }
}
