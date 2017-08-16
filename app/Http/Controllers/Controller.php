<?php

namespace App\Http\Controllers;

use App\Support\Flash;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Flash a message.
     *
     * @param string $type
     * @param string $message
     *
     * @return void
     */
    protected function flash(string $type, string $message)
    {
        app(Flash::class)->add($type, $message);
    }
}
