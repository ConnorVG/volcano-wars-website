<?php

namespace App\Http\Requests\Personal\Password;

use App\Commands\Common\Model\Patch;
use App\Notifications;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    /**
     * Allow access to the request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the password attempt rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'current' => 'required',
            'new' => 'required|min:6',
        ];
    }

    /**
     * Get the password attempt attributes.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'current' => 'current password',
            'new' => 'new password',
        ];
    }

    /**
     * Persist the password.
     *
     * @return bool
     */
    public function persist(): bool
    {
        $users = $this->container->make(EloquentUserProvider::class);
        $valid = $users->validateCredentials($this->user(), [
            'password' => $this->current,
        ]);

        if (! $valid) {
            return false;
        }

        dispatch(new Patch($this->user(), [
            'password' => bcrypt($this->get('new')),
        ]));

        $this->user()->notify(new Notifications\User\PasswordChanged);

        return true;
    }
}
