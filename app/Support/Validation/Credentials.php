<?php

namespace App\Support\Validation;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Validation\Validator;

class Credentials
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
        $password = array_get($validator->getData(), $parameters[0]);

        return $this->users->retrieveByCredentials(compact('email', 'password')) !== null;
    }
}
