<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{

    /**
     * Show the form for editing the profile.
     *
     * @return View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Show the form for editing the profile.
     *
     * @return View
     */
    public function store()
    {

    }

    /**
     * Update the profile
     *
     * @param \App\Http\Requests\ProfileRequest $request
     * @return RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Update the profile
     *
     * @param \App\Http\Requests\ProfileRequest $request
     * @return RedirectResponse
     */
    public function destroy(ProfileRequest $request)
    {

    }

}
