<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use InvalidArgumentException;

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

    /**
     * Create a new user account.
     *
     * This method creates a new user account with validated data from the request.
     * It assigns a role to the user based on the provided role name, and redirects
     * to the index page upon successful creation.
     *
     * @param  \App\Http\Requests\StoreAccountRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreAccountRequest $request): RedirectResponse
    {
        // Validate request, create user object
        $validated = $request->validated();
        $user = User::make($validated);

        // Get allowed roles from config
        $allowedRoles = config('roles.allowed_roles_at_registration');

        // Get role
        try {
            $role = Role::getRoleByName($validated['role'], $allowedRoles);
        } catch (InvalidArgumentException | ModelNotFoundException $e) {
            return redirect()->back()->with([
                'message' => [
                    'type' => 'error',
                    'message' => 'You are not allowed to chose this role!'
                ]
            ]);
        }

        // Assign role
        $user->role()->associate($role);

        // Save user
        $user->save();
        return redirect()->route('index.index');
    }
}
