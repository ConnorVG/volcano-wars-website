<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use App\Http\Requests\Personal\Account\Update;

class AccountController extends Controller
{
    /**
     * Show the account page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('personal.account');
    }

    /**
     * Attempt to update the account details.
     *
     * @param \App\Http\Requests\Personal\Account\Update $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Update $request)
    {
        $request->persist();

        $this->flash('success', 'Account details updated.');

        return redirect()->route('get::personal.account');
    }
}
