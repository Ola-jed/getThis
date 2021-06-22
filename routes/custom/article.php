<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::middleware('session')->group(function (){
    // Articles management
    Route::get('/articles',[ArticleController::class,'index']);
    Route::post('/articles',[ArticleController::class,'store']);
    Route::get('/articles/subject',[ArticleController::class,'searchBySubject']);
    Route::get('/articles/title',[ArticleController::class,'searchByTitle']);
    // For a specific Article
    Route::get('/article/{slug}',[ArticleController::class,'show']);
    Route::get('/article/{slug}/update',[ArticleController::class,'edit']);
    Route::put('/article/{slug}',[ArticleController::class,'update']);
    Route::delete('/article/{slug}',[ArticleController::class,'destroy']);
});