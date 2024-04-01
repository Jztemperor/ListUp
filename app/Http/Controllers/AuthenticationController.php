<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    /**
     * Display the form for login
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return inertia('Authentication/Login');
    }

    /**
     * Attempts to authenticates the User, and store's the session.
     * 
     * @param \App\Http\Requests\StoreLoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * 
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StoreLoginRequest $request)
    {
        // Attempt to authenticate
        if (!Auth::attempt($request->validated(), true)) {
            // Throw error if it fails
            throw ValidationException::withMessages([
                'email' => 'Invalid credentials!'
            ]);
        }

        // Ensure that the session is generated
        $request->session()->regenerate();

        // Redirect to home
        return redirect()->route('index.index');
    }

    /**
     * Logs out the user and destorys/invalidates the session.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect()->route('index.index');
    }
}
