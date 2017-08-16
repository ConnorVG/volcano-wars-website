<?php

namespace App\Http\Controllers\Common\Game;

use App\Http\Controllers\Controller;

class StatisticController extends Controller
{
    /**
     * Show the statistics view.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('common.game.statistics');
    }
}
