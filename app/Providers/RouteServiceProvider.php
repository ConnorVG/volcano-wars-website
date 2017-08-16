<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Laravel\Passport\RouteRegistrar as PassportRouteRegistrar;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapOAuthRoutes();

        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    /**
     * Define the "oauth" routes for the application.
     *
     * @return void
     */
    protected function mapOAuthRoutes()
    {
        Route::prefix('oauth')
            ->namespace('\Laravel\Passport\Http\Controllers')
            ->group(function ($router) {
                $registrar = new PassportRouteRegistrar($router);

                $registrar->forAuthorization();
            });

        Route::prefix('api/oauth')
            ->namespace('\Laravel\Passport\Http\Controllers')
            ->group(function ($router) {
                $registrar = new PassportRouteRegistrar($router);

                $registrar->forAccessTokens();
                $registrar->forTransientTokens();
            });
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
