<?php

namespace App\Handlers\Auth;

use App\Commands\Auth\Deauthenticate as Command;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;

class Deauthenticate
{
    /** @var \Illuminate\Contracts\Auth\Guard */
    protected $auth;

    /**
     * Constructs a new deauthenticate command handler.
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle the deauthenticate command.
     *
     * @param \App\Commands\Auth\Deauthenticate $command
     *
     * @return void
     */
    public function handle(Command $command)
    {
        if (! ($this->auth instanceof StatefulGuard)) {
            return;
        }

        $this->auth->logout();
    }
}
