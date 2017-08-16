<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    /**
     * Show a generic view.
     *
     * @return \Illuminate\Http\Response
     */
    public function __call($view, $parameters)
    {
        return view("common.{$view}")
            ->with($parameters);
    }
}
