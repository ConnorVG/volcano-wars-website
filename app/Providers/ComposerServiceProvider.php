<?php

namespace App\Providers;

use App\Composers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', Composers\App::class);
        View::composer(['_layouts.*', 'auth.*', 'common.*', 'personal.*'], Composers\Flash::class);
        View::composer(['_layouts.*', 'errors::*', 'auth.*', 'common.*', 'personal.*'], Composers\Page::class);
        View::composer(['_layouts.*', 'auth.*', 'common.*', 'personal.*'], Composers\Route::class);
        View::composer(['_layouts.*', 'auth.*', 'common.*', 'personal.*'], Composers\User::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
