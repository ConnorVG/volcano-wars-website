<?php

namespace App\Commands\Common\Model;

use Illuminate\Database\Eloquent\Model;

class Patch
{
    /** @var \App\Models\User */
    public $user;

    /** @var array */
    public $updates;

    /**
     * Contructs the patch model command.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array                               $updates
     */
    public function __construct(Model $model, array $updates)
    {
        $this->model = $model;
        $this->updates = $updates;
    }
}
