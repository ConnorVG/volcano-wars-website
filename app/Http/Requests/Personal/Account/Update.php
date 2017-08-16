<?php

namespace App\Http\Requests\Personal\Account;

use App\Commands\Common\Model\Patch;
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
     * Get the authentication attempt rules.
     *
     * @return array
     */
    public function rules(): array
    {
        $id = auth()->id();

        return [
            'name' => "required|max:16|display_name:{$id}",
            'email' => "required|email|not_credentials:{$id}",
        ];
    }

    /**
     * Persist the authentication.
     *
     * @return void
     */
    public function persist(): void
    {
        dispatch(new Patch($this->user(), [
            'name' => $this->get('name'),
            'email' => $this->get('email'),
        ]));
    }
}
