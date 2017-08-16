<?php

namespace App\Http\Requests\Auth\Forgot;

use App\Commands\Auth\Authenticate;
use App\Notifications;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Foundation\Http\FormRequest;

class Send extends FormRequest
{
    /**
     * Allow access to the request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the forgot send rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
        ];
    }

    /**
     * Persist the forgot email.
     *
     * @return void
     */
    public function persist(): void
    {
        $users = $this->container->make(EloquentUserProvider::class);
        $user = $users->retrieveByCredentials([
            'email' => $this->email,
        ]);

        if (! $user) {
            return;
        }

        $user->notify(new Notifications\User\Forgot);
    }
}
