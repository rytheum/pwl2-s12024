<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::apiResource('users',UserController::class);

Route::prefix('products')->group(function () {
    Route::get('liat',[\App\Http\Controllers\ProductController::class,'meh']);
    Route::get('liat/{id}',[\App\Http\Controllers\ProductController::class,'meh_id']);
    Route::put('liat/{id}', [\App\Http\Controllers\ProductController::class, 'meh_update']);
    Route::delete('liat/{id}', [\App\Http\Controllers\ProductController::class, 'meh_delete']);
});

Route::get('test',function(){
    return response()->json(['message' => 'API is Working'
    ]);
})->middleware('auth:sanctum');

