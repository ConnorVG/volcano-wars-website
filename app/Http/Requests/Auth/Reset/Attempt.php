<?php

namespace App\Http\Requests\Auth\Reset;

use App\Commands\Auth\Authenticate;
use App\Commands\Common\Model\Patch;
use App\Notifications;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Foundation\Http\FormRequest;

class Attempt extends FormRequest
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
            'password' => 'required|min:6',
        ];
    }

    /**
     * Persist the forgot email.
     *
     * @param string $token
     *
     * @return bool
     */
    public function persist(string $token): bool
    {
        $passwords = $this->container->make(PasswordBroker::class);
        $response = $passwords->reset([
            'email' => $this->get('email'),
            'password' => $this->get('password'),
            'password_confirmation' => $this->get('password'),
            'token' => $token,
        ], function ($user, $password) {
            dispatch(new Patch($user, [
                'password' => bcrypt($password),
            ]));

            $user->notify(new Notifications\User\Reset);

            dispatch(new Authenticate($user));
        });

        if ($response === PasswordBroker::PASSWORD_RESET) {
            return true;
        }

        return false;
    }
}
