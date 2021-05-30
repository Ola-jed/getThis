<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

// Articles management
Route::get('/articles',[ArticleController::class,'index']);
Route::post('/articles',[ArticleController::class,'store']);
Route::get('/articles/subject',[ArticleController::class,'searchBySubject']);
Route::get('/articles/title',[ArticleController::class,'searchByTitle']);

// For a specific Article
Route::get('/article/{id}',[ArticleController::class,'show'])
    ->where('id','[0-9]+');
Route::get('/article/{id}/update',[ArticleController::class,'edit'])
    ->where('id','[0-9]+');
Route::put('/article/{id}',[ArticleController::class,'update'])
    ->where('id','[0-9]+');
Route::delete('/article/{id}',[ArticleController::class,'destroy'])
    ->where('id','[0-9]+');