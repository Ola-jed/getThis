<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::middleware('session')->group(function (){
    Route::get('contact',[ContactController::class,'index']);
    Route::post('contact',[ContactController::class,'sendContactForm']);
});