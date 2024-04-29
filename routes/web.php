<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home
Route::get('/', [IndexController::class, 'index'])->name('index.index');

// Account controller's route for User (Account) resource
Route::resource('account', AccountController::class)
  ->only(['create', 'store']);

// Auth controller's routes.
Route::get('login', [AuthenticationController::class, 'create'])->name('login');
Route::post('login', [AuthenticationController::class, 'store'])->name('login');
Route::delete('logout', [AuthenticationController::class, 'destroy'])->name('logout');

// Email verification view
Route::get('/email/verify', function () {
  return inertia('Verification/verify-email');
})->middleware('auth')->name('verification.notice');
 

// Fulfill verification
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/')->with([
            'message' => [
                'type' => 'success',
                'message' => "You're email has been verified!"
            ]
        ]);
})->middleware(['auth', 'signed'])->name('verification.verify');
 
// Re-send verification link
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with([
            'message' => [
                'type' => 'success',
                'message' => "Verification email sent!"
            ]
        ]);
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');