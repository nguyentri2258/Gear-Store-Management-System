<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);

Route::get('/register', [UserController::class, 'showRegister'])->name('users.register');
Route::post('/register', [UserController::class, 'register']);
Route::get('/login', [UserController::class, 'showLogin'])->name('users.login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
