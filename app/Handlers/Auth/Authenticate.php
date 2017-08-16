<?php

namespace App\Handlers\Auth;

use App\Commands\Auth\Authenticate as Command;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;

class Authenticate
{
    /** @var \Illuminate\Contracts\Auth\Guard */
    protected $auth;

    /**
     * Constructs a new authenticate command handler.
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle the authenticate command.
     *
     * @param \App\Commands\Auth\Authenticate $command
     *
     * @return void
     */
    public function handle(Command $command)
    {
        $this->auth->setUser($command->user);

        if (! ($this->auth instanceof StatefulGuard)) {
            return;
        }

        $this->auth->login($command->user, $command->remember);
    }
}
