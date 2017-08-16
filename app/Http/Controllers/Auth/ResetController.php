<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Reset\Attempt;

class ResetController extends Controller
{
    /**
     * Show the reset view.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\Response
     */
    public function show(string $token)
    {
        return view('auth.reset')
            ->with('token', $token);
    }

    /**
     * Handle a reset attempt.
     *
     * @param string                                $token
     * @param \App\Http\Requests\Auth\Reset\Attempt $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function attempt(string $token, Attempt $request)
    {
        $success = $request->persist($token);
        if (! $success) {
            $this->flash('danger', 'No matching email / token pair found.');

            return redirect()->route('get::auth.reset', compact('token'));
        }

        $this->flash('success', 'Successfully reset password.');

        return redirect()->route('get::common.home');
    }
}
