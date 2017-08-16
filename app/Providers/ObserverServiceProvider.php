<?php

namespace App\Providers;

use App\Models;
use App\Observers;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Map the observers.
     *
     * @return void
     */
    public function boot()
    {
        Models\User::observe(Observers\User::class);
    }
}
