<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Support\Facades\Route;

Route::get('{signin}',[UserAuthController::class,'signinView'])
    ->where('signin','signin|login')
    ->name('login');
Route::get('{signup}',[UserAuthController::class,'signupView'])
    ->where('signup','signup|register');
Route::post('{signin}',[UserAuthController::class,'signIn'])
    ->where('signin','signin|login');
Route::post('{signup}',[UserAuthController::class,'signUp'])
    ->where('signup','signup|register');

// Forgotten password routes
Route::get('forget-password', [ForgotPasswordController::class, 'forgetPasswordForm'])
    ->name('password.email');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm']);
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'passwordResetForm'])
    ->name('password.reset');
Route::post('reset-password', [ForgotPasswordController::class, 'submitPasswordResetForm']);
