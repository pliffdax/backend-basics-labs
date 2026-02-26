<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/topics', [TopicController::class, 'index']);
Route::get('/topics/{topic}', [TopicController::class, 'show']);

Route::get('/newsletters', [NewsletterController::class, 'index']);
Route::get('/newsletters/create', [NewsletterController::class, 'create']);
Route::post('/newsletters', [NewsletterController::class, 'store']);
Route::get('/newsletters/{newsletter}/edit', [NewsletterController::class, 'edit']);
Route::put('/newsletters/{newsletter}', [NewsletterController::class, 'update']);
Route::delete('/newsletters/{newsletter}', [NewsletterController::class, 'destroy']);
