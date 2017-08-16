<?php

namespace App\Support\Validation;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Validation\Validator;

class NotCredentials
{
    /** @var \Illuminate\Auth\EloquentUserProvider */
    protected $users;

    /**
     * Constructs a new credentials validator.
     *
     * @param \Illuminate\Auth\EloquentUserProvider $users
     */
    public function __construct(EloquentUserProvider $users)
    {
        $this->users = $users;
    }

    /**
     * Validate the credentials.
     *
     * @param string                                     $attribute
     * @param mixed                                      $email
     * @param array                                      $parameters
     * @param \Illuminate\Contracts\Validation\Validator $validator
     *
     * @return bool
     */
    public function validate(string $attribute, $email, array $parameters, Validator $validator): bool
    {
        $user = $this->users->retrieveByCredentials(compact('email'));
        if (empty($parameters)) {
            return $user === null;
        }

        return $user === null || $user->id === (int) $parameters[0];
    }
}
