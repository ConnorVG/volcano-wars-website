<?php

namespace App\Providers;

use App\Commands;
use App\Handlers;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\ServiceProvider;

class BusServiceProvider extends ServiceProvider
{
    /**
     * The bus command handlers.
     *
     * @var array
     */
    protected $handlers = [
        Commands\Auth\Authenticate::class => Handlers\Auth\Authenticate::class,
        Commands\Auth\Deauthenticate::class => Handlers\Auth\Deauthenticate::class,

        Commands\Common\Model\Patch::class => Handlers\Common\Model\Patch::class,
    ];

    /**
     * Map the command handlers.
     *
     * @return void
     */
    public function boot()
    {
        Bus::map($this->handlers);
    }
}
