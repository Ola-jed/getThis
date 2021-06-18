<?php

use App\Http\Controllers\PasteController;
use Illuminate\Support\Facades\Route;

Route::get('/paste',[PasteController::class,'index']);
Route::post('/paste',[PasteController::class,'store']);
Route::get('/paste/{slug}',[PasteController::class,'show']);
Route::put('/paste/{slug}',[PasteController::class,'update']);
Route::delete('/paste/{slug}',[PasteController::class,'destroy']);