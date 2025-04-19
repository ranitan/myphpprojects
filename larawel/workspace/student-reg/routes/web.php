<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\studentcontroller;

Route::get('/', [studentcontroller::class,'viewform'])->name('home');
Route::post('/add-student', [studentcontroller::class,'addstudent']);
