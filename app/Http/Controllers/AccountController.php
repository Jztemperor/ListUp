<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Models\Role;
use App\Models\User;
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

    public function store(StoreAccountRequest $request)
    {
        $validated = $request->validated();

        $user = new User();

        // Assign validated fields to user object
        $user->first_name = $validated['firstName'];
        $user->last_name = $validated['lastName'];
        $user->email = $validated['email'];
        $user->phone_number = $validated['phone'];
        $user->password = bcrypt($validated['password']);

        // Get role
        $role = Role::where('name', $validated['role'])->first(['id', 'name']);

        // Check to prevent users from chosing a role that is not on the list
        if ($role && ($role->name == 'Customer' || $role->name == 'Realtor')) {
            $roleId = $role->id;
        } else {
            abort(500); // will be replaced later
        }

        // Assign role
        $user->role()->associate($roleId);

        $user->save();


        return redirect()->route('index.index');
    }
}
