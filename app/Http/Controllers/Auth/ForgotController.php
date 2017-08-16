<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Forgot\Send;

class ForgotController extends Controller
{
    /**
     * Show the forgot view.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.forgot');
    }

    /**
     * Handle an forgot email send.
     *
     * @param \App\Http\Requests\Auth\Forgot\Send $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Send $request)
    {
        $request->persist();

        $this->flash('success', 'Password reset link sent.');

        return redirect()->route('get::auth.forgot');
    }
}
