<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller responsible for handling account-related actions such as registration, updating, and deletion.
 */
class AccountController extends Controller
{

    /**
     * Display the form for creating a new account.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return inertia('Account/Create');
    }
}
