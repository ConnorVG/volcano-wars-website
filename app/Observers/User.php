<?php

namespace App\Observers;

use App\Models;
use App\Notifications\User\Registered;

class User
{
    /**
     * Handle the user creation.
     *
     * @param \App\Models\User $user
     *
     * @return void
     */
    public function created(Models\User $user)
    {
        $user->notify(new Registered);
    }
}
