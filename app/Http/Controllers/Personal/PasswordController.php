<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use App\Http\Requests\Personal\Password\Update;

class PasswordController extends Controller
{
    /**
     * Show the password page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('personal.password');
    }

    /**
     * Attempt to update the password.
     *
     * @param \App\Http\Requests\Personal\Password\Update $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Update $request)
    {
        $success = $request->persist();
        if (! $success) {
            $this->flash('danger', trans('auth.failed'));

            return redirect()->route('get::personal.account.password');
        }

        $this->flash('success', 'Password updated.');

        return redirect()->route('get::personal.account.password');
    }
}
