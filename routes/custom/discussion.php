<?php
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

// Discussions
Route::get('/discussions',[DiscussionController::class,'index']);
Route::get('/discussions/subject',[DiscussionController::class,'searchBySubject']);
Route::post('/discussions',[DiscussionController::class,'store']);

// For a specific discussion
Route::get('/discussion/{id}',[DiscussionController::class,'show'])
    ->where('id','[0-9]+');
Route::put('/discussion/{id}',[DiscussionController::class,'update'])
    ->where('id','[0-9]+');
Route::delete('/discussion/{id}',[DiscussionController::class,'destroy'])
    ->where('id','[0-9]+');

// Messages
Route::post('/discussion/id',[MessageController::class,'store'])
    ->where('id','[0-9]+');
