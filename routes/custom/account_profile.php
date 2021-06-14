<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/profile',[ProfileController::class,'index']);
Route::put('/profile',[ProfileController::class,'update']);
Route::delete('/profile',[ProfileController::class,'destroy']);
