<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;

Route::get('/', function () {
    return view('welcome');
});
//rvisi
Route::resource('products', App\Http\Controllers\ProductController::class);
// ROUTE UNTUK SUPPLIER
Route::resource('suppliers', App\Http\Controllers\SupplierController::class);