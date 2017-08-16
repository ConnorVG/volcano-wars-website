<?php

namespace App\Providers;

use App\Models\User;
use App\Support\Flash;
use App\Support\Validation;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('credentials', Validation\Credentials::class, trans('auth.failed'));
        Validator::extend('not_credentials', Validation\NotCredentials::class, trans('auth.exists'));
        Validator::extend('display_name', Validation\DisplayName::class);

        if (config('client.force-ssl')) {
            URL::forceScheme('https');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->alias('bugsnag.multi', \Illuminate\Contracts\Logging\Log::class);
        $this->app->alias('bugsnag.multi', \Psr\Log\LoggerInterface::class);

        $this->app->bind(EloquentUserProvider::class, function () {
            $hasher = $this->app->make(Hasher::class);

            return new EloquentUserProvider($hasher, User::class);
        });

        $this->app->singleton(Flash::class, function ($app) {
            $session = $app[Session::class];
            $flash = new Flash($session);

            $app['events']->listen(RequestHandled::class, [$flash, 'put']);

            return $flash;
        });
    }
}
