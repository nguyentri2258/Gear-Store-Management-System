<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');


Route::get('/register', [UserController::class, 'showRegister'])->name('users.register');
Route::post('/register', [UserController::class, 'register']);
Route::get('/login', [UserController::class, 'showLogin'])->name('users.login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');

Route::middleware('auth')
    ->prefix('dashboard')
    ->group(function(){
        Route::get('/', [DashboardController::class, 'index'])->name('dashboards.index');

        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
    });
