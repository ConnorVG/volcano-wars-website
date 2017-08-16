<?php

namespace App\Handlers\Common\Model;

use App\Commands\Common\Model\Patch as Command;
use App\Models\Upload;

class Patch
{
    /**
     * Handle the patch model command.
     *
     * @param \App\Commands\Model\Patch $command
     *
     * @return void
     */
    public function handle(Command $command)
    {
        $command->model->update($command->updates);
    }
}
