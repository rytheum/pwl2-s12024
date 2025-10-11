<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\TransaksiPenjualanController;

Route::get('/', function () {
    return view('welcome');
});
//rvisi
Route::resource('products', App\Http\Controllers\ProductController::class);
// ROUTE UNTUK SUPPLIER
Route::resource('suppliers', App\Http\Controllers\SupplierController::class);
Route::resource('categories', App\Http\Controllers\CategoryProductController::class);
Route::resource('transaksis', App\Http\Controllers\TransaksiPenjualanController::class);