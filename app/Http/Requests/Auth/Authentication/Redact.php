<?php

namespace App\Http\Requests\Auth\Authentication;

use App\Commands\Auth\Deauthenticate;
use Illuminate\Foundation\Http\FormRequest;

class Redact extends FormRequest
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
        return [];
    }

    /**
     * Persist the registration.
     *
     * @return void
     */
    public function persist(): void
    {
        dispatch(new Deauthenticate);
    }
}
