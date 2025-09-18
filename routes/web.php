<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});
//rvisi
Route::resource('products', App\Http\Controllers\ProductController::class);
