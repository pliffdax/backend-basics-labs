<?php

use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('/topics'));
Route::get('/topics', [TopicController::class, 'index']);
Route::get('/topics/{topic}', [TopicController::class, 'show']);
