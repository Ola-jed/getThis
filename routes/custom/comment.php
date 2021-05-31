<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

// Comments about an article
Route::get('/article/{slug}/comments',[CommentController::class,'getAll']);
Route::post('/article/{id}/comments',[CommentController::class,'store']);

// For a specific Comment
Route::put('/comment/{id}',[CommentController::class,'update'])
    ->where('id','[0-9]+');
Route::delete('/comment/{id}',[CommentController::class,'deleteComment'])
    ->where('id','[0-9]+');