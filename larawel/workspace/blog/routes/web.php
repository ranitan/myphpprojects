<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', [PostController::class,'index']);
Route::get('/post/{slug}', [PostController::class,'detail'])->name('post.detail');