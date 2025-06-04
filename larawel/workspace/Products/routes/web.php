<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products',[ProductController::class,'index'] )->name('product.index');
Route::get('/create-product',[ProductController::class,'create'] )->name('product.create');
Route::post('/products',[ProductController::class,'store'] )->name('product.store');