<?php

namespace App\Http\Requests\Auth\Registration;

use App\Commands\Auth\Authenticate;
use App\Models\User;
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
     * Get the registration attempt rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:16|display_name',
            'email' => 'required|email|not_credentials',
            'password' => 'required|min:6',
        ];
    }

    /**
     * Persist the registration.
     *
     * @return void
     */
    public function persist(): void
    {
        $user = User::create($this->only('name', 'email') + [
            'password' => bcrypt($this->password),
        ]);

        dispatch(new Authenticate($user));
    }
}
