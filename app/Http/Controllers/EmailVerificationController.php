<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function showInstructions() : Response
    {
        return inertia('Verification/verify-email');
    }

    public function fulfill(EmailVerificationRequest $request) : RedirectResponse
    {
        $request->fulfill();

        return redirect('/')->with([
            'message' => [
                'type' => 'success',
                'message' => "You're email has been verified!"
            ]
        ]);
    }

    public function reSend(Request $request) : RedirectResponse
    {
        $request->user()->sendEmailVerificationNotification();
 
        return back()->with([
                'message' => [
                    'type' => 'success',
                    'message' => "Verification email sent!"
                ]
            ]);
    }
}
