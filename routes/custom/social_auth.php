<?php

use App\Http\Controllers\UserSocialAuthController;
use Illuminate\Support\Facades\Route;

/*
 * Social media auth
 */

// Google
Route::get('/login/google',[UserSocialAuthController::class,'googleRedirectTo'])
    ->name('auth/google');
Route::get('/login/google/callback',[UserSocialAuthController::class,'googleCallback']);

// Github
Route::get('/login/github',[UserSocialAuthController::class, 'githubRedirectTo'])
    ->name('auth/google');;
Route::get('/login/github/callback',[UserSocialAuthController::class, 'githubCallback']);
