<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('session')->group(function() {
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::put('/profile', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);
    Route::get('/account/{id}', [AccountController::class, 'show'])
        ->where('id', '[0-9]+');
    Route::post('/account/{id}', [AccountController::class, 'report'])
        ->where('id', '[0-9]+');
});