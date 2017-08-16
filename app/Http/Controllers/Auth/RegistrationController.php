<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Registration\Attempt;

class RegistrationController extends Controller
{
    /**
     * Show the registration view.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.sign-up');
    }

    /**
     * Handle an registration attempt.
     *
     * @param \App\Http\Requests\Auth\Registration\Attempt $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function attempt(Attempt $request)
    {
        $request->persist();

        $this->flash('success', 'Successfully registered.');

        return redirect()->intended(route('get::common.home'));
    }
}
