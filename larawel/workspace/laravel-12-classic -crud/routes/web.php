<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

//product route functions

Route::get('/products',[ProductController::class,'index'])->name('product.index');
Route::get('/create-product',[ProductController::class,'create'])->name('product.create');
Route::post('/store-product',[ProductController::class,'store'])->name('product.store');
Route::get('/show-product/{id}',[ProductController::class,'show'])->name('product.show');
Route::get('/edit-product/{id}',[ProductController::class,'edit'])->name('product.edit');
Route::post('/update-product/{id}',[ProductController::class,'update'])->name('product.update');
Route::delete('/destroy-product/{id}',[ProductController::class,'destroy'])->name('product.destroy');

Route::get('/deleted-products',[ProductController::class,'trashedProducts'])->name('product.trashed');
Route::get('/show-trashed-product/{id}',[ProductController::class,'showTrashed'])->name('trashed.show');
Route::put('restore-product/{id}',[ProductController::class,'restoreProduct'])->name('product.restore');
Route::delete('delete-product/{id}',[ProductController::class,'destroyProduct'])->name('product.delete');

//category route functions

Route::get('/categories',[CategoryController::class,'index'])->name('category.index');
Route::get('/create-category',[CategoryController::class,'create'])->name('category.create');
Route::post('/store-category',[CategoryController::class,'store'])->name('category.store');
Route::get('/show-category/{id}',[CategoryController::class,'show'])->name('category.show');
Route::get('/edit-category/{id}',[CategoryController::class,'edit'])->name('category.edit');
Route::post('/update-category/{id}',[CategoryController::class,'update'])->name('category.update');
Route::delete('/destroy-category/{id}',[CategoryController::class,'destroy'])->name('category.destroy');

Route::get('/deleted-categories',[CategoryController::class,'trashedcategories'])->name('trashed.categories');
Route::get('/show-trashed-category/{id}',[CategoryController::class,'showTrashed'])->name('show.trashed.categories');
Route::put('restore-category/{id}',[CategoryController::class,'restoreCategory'])->name('category.restore');
Route::delete('delete-category/{id}',[CategoryController::class,'destroyCategory'])->name('category.delete');
