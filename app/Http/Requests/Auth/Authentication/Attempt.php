<?php

namespace App\Http\Requests\Auth\Authentication;

use App\Commands\Auth\Authenticate;
use Illuminate\Auth\EloquentUserProvider;
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
     * Get the authentication attempt rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|credentials:password',
            'password' => 'required',
        ];
    }

    /**
     * Persist the authentication.
     *
     * @return void
     */
    public function persist(): void
    {
        $users = $this->container->make(EloquentUserProvider::class);
        $user = $users->retrieveByCredentials([
            'email' => $this->email,
            'password' => $this->password,
        ]);

        dispatch(new Authenticate($user));
    }
}
