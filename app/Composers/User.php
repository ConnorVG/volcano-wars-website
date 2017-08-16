<?php

namespace App\Composers;

use Illuminate\Contracts\Auth\Guard;

class User extends Composer
{
    /** @var \Illuminate\Contracts\Auth\Guard */
    protected $auth;

    /**
     * Constructs a new user view composer.
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Get the data to provide to the view.
     *
     * @return array
     */
    protected function data(): array
    {
        return [
            'user' => $this->auth->user(),
        ];
    }
}
