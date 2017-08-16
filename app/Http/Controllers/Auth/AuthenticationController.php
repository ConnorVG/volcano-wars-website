<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Authentication\Attempt;
use App\Http\Requests\Auth\Authentication\Redact;

class AuthenticationController extends Controller
{
    /**
     * Show the authentication view.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.sign-in');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param \App\Http\Requests\Auth\Authentication\Attempt $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function attempt(Attempt $request)
    {
        $request->persist();

        $this->flash('success', 'Successfull signed in.');

        return redirect()->intended(route('get::common.home'));
    }

    /**
     * Handle deauthentication.
     *
     * @param \App\Http\Requests\Auth\Authentication\Redact $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redact(Redact $request)
    {
        $request->persist();

        $this->flash('success', 'Successfully signed out.');

        return redirect()->route('get::common.home');
    }
}
