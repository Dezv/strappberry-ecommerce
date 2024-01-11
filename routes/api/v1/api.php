<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function() {
    Route::post('/tokens/create', 'createToken');
});
Route::controller(UserController::class)->group(function() {
    Route::get('/users', 'index');
    Route::get('/users/{id}', 'show');
    Route::get('/users/search/{name}', 'search');
});
Route::controller(ProductController::class)->group(function() {
    Route::get('/products', 'index');
    Route::get('/products/{id}', 'show');
    Route::get('/products/search/{name}', 'search');
});
Route::controller(CartController::class)->group(function() {
    Route::get('/carts/{id}', 'show');
});
Route::controller(OrderController::class)->group(function() {
    Route::get('/orders', 'index');
    Route::get('/orders/{id}', 'show');
});
Route::middleware('auth:sanctum')->group( function () {
    Route::post('/logout', [LoginRegisterController::class, 'logout']);

    Route::controller(UserController::class)->group(function() {
        Route::post('/users', 'store');
        Route::post('/users/{id}', 'update');
        Route::delete('/users/{id}', 'destroy');
    });

    Route::controller(ProductController::class)->group(function() {
        Route::post('/products', 'store');
        Route::post('/products/{id}', 'update');
        Route::delete('/products/{id}', 'destroy');
    });

    Route::controller(CartController::class)->group(function() {
        Route::post('/carts', 'store');
    });

    Route::controller(OrderController::class)->group(function() {
        Route::post('/orders', 'store');
    });


    
});