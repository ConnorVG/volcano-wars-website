<?php

namespace App\Support\Validation;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Validation\Validator;

class DisplayName
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
     * @param mixed                                      $displayName
     * @param array                                      $parameters
     * @param \Illuminate\Contracts\Validation\Validator $validator
     *
     * @return bool
     */
    public function validate(string $attribute, $displayName, array $parameters, Validator $validator): bool
    {
        $name = preg_replace('/[^\w\d\-\_\.\s]/', '', $displayName);
        if ($name !== $displayName) {
            return false;
        }

        $name = str_replace('  ', ' ', $name);
        if (strlen($name) > 16) {
            return false;
        }

        $user = $this->users->retrieveByCredentials(compact('name'));
        if (empty($parameters)) {
            return $user === null;
        }

        return $user === null || $user->id === (int) $parameters[0];
    }
}
