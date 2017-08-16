<?php

namespace App\Listeners\Passport;

use App\Models\User;
use Laravel\Passport\Events\AccessTokenCreated;

class RevokeOldTokens
{
    /**
     * Handle the event.
     *
     * @param  AccessTokenCreated  $event
     * @return void
     */
    public function handle(AccessTokenCreated $event)
    {
        $user = User::find($event->userId);

        $tokens = $user->tokens()
            ->where('id', '!=', $event->tokenId)
            ->whereHas('client', function ($query) use ($event) {
                $query->where('id', $event->clientId)
                    ->where('revoked', false);
            })->get();

        $tokens->each->revoke();
    }
}
