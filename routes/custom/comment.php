<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

// Comments about an article
Route::get('/article/{id}/comments',[CommentController::class,'getAll'])
    ->where('id','[0-9]+');
Route::post('/article/{id}/comments',[CommentController::class,'store']);

// For a specific Comment
Route::put('/article/{id}',[CommentController::class,'update'])
    ->where('id','[0-9]+');
Route::delete('/article/{id}',[CommentController::class,'deleteComment'])
    ->where('id','[0-9]+');
