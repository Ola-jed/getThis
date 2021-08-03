<?php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::middleware('session')->group(function() {
    Route::get('/discussion/{id}/messages', [MessageController::class, 'getAll'])
        ->where('id', '[0-9]+');
    Route::post('/discussion/{id}', [MessageController::class, 'store'])
        ->where('id', '[0-9]+');
    Route::delete('/message/{id}', [MessageController::class, 'destroy'])
        ->where('id', '[0-9]+');
});