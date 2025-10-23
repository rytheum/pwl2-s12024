<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\TransaksiPenjualanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

//redirect ke login
Route::get('/', function () {
    return redirect()->route('login');
});

//route authentication
Route::get('login', [AuthController::class,'loginForm'])->name('login');
Route::post('login', [AuthController::class,'login'])->name('login.process');

route::get('/register', [AuthController::class, 'registerForm'])->name('register');
route::post('/register', [AuthController::class, 'register'])->name('register.process');

route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//route yang dilindungi login (Auth middleware)
Route::middleware(['auth'])->group(function () {    

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('products', App\Http\Controllers\ProductController::class);
// ROUTE UNTUK SUPPLIER
Route::resource('suppliers', App\Http\Controllers\SupplierController::class);
Route::resource('categories', App\Http\Controllers\CategoryProductController::class);
Route::resource('transaksis', App\Http\Controllers\TransaksiPenjualanController::class);
});