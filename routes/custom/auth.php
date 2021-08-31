<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\SigninController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

Route::get('{signin}', [SigninController::class, 'signinView'])
    ->where('signin', 'signin|login');
Route::post('{signin}', [SigninController::class, 'signIn'])
    ->where('signin', 'signin|login');

Route::get('{signup}', [SignupController::class, 'signupView'])
    ->where('signup', 'signup|register');
Route::post('{signup}', [SignupController::class, 'signUp'])
    ->where('signup', 'signup|register');

Route::post('logout', [LogoutController::class, 'logout'])
    ->middleware('session');

// Forgotten password routes
Route::get('forget-password', [ForgotPasswordController::class, 'forgetPasswordForm'])
    ->name('password.email');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm']);
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'passwordResetForm'])
    ->name('password.reset');
Route::post('reset-password', [ForgotPasswordController::class, 'submitPasswordResetForm']);
