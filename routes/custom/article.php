<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

// Articles management
Route::get('/articles',[ArticleController::class,'index']);
Route::post('/articles',[ArticleController::class,'store']);

// For a specific Article
Route::get('/article/{id}',[ArticleController::class,'show'])
    ->where('id','[0-9]+');
Route::put('/article/{id}',[ArticleController::class,'update'])
    ->where('id','[0-9]+');
Route::delete('/article/{id}',[ArticleController::class,'destroy'])
    ->where('id','[0-9]+');
