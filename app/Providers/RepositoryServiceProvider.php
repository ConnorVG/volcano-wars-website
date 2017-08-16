<?php

namespace App\Providers;

use App\Repositories;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * The repository map.
     *
     * @var array
     */
    protected $map = [
        // ...
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->map as $contract => $concrete) {
            $this->app->bind($contract, $concrete);
        }
    }
}
