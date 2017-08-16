<?php

namespace App\Commands\Auth;

use App\Models\User;

class Authenticate
{
    /** @var \App\Models\User */
    public $user;

    /** @var bool */
    public $remember;

    /**
     * Constructs a new authenticate command.
     *
     * @param \App\Models\User $user
     * @param bool             $remember
     */
    public function __construct(User $user, bool $remember = false)
    {
        $this->user = $user;
        $this->remember = $remember;
    }
}
