<?php

use App\Http\Controllers\OrderDetailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

//Categories
Route::get('/categories/{id?}', [ProductCategoryController::class, 'index']);
Route::post('/categories', [ProductCategoryController::class, 'store']);
Route::put('/categories/{id}', [ProductCategoryController::class, 'update']);
Route::delete('/categories/{id}', [ProductCategoryController::class, 'destroy']);
Route::get('/categories/search', [ProductCategoryController::class, 'search']);


//Products
Route::get('/products/{id?}', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

//users
Route::get('/users/{id?}', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

//Orders
Route::get('/order-details/{id?}', [OrderDetailController::class, 'index']);
Route::post('/order-details', [OrderDetailController::class, 'store']);
Route::put('/order-details/{id}', [OrderDetailController::class, 'update']);
Route::delete('/order-details/{id}', [OrderDetailController::class, 'destroy']);
