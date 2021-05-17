<?php

use App\Http\Controllers\UserAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/{signin}',[UserAuthController::class,'signinView'])
    ->where('signin','signin|login');
Route::get('/{signup}',[UserAuthController::class,'signupView'])
    ->where('signup','signup|register');

Route::post('/{signin}',[UserAuthController::class,'signIn'])
    ->where('signin','signin|login');
Route::post('/{signup}',[UserAuthController::class,'signIn'])
    ->where('signup','signup|register');
