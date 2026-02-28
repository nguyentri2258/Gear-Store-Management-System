<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products', [ProductController::class, 'shop'])->name('products.shop');
Route::get('/products/{product}', [ProductController::class, 'detail'])->name('products.detail');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/register', [UserController::class, 'showRegister'])->name('users.register');
Route::post('/register', [UserController::class, 'register']);
Route::get('/login', [UserController::class, 'showLogin'])->name('users.login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');

Route::get('/checkout', [CheckoutController::class, 'form'])->name('checkout.form');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

Route::middleware(['auth', 'role:owner'])
    ->prefix('dashboard')
    ->group(function(){
        Route::get('/', [DashboardController::class, 'index'])->name('dashboards.index');

        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);

        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
        Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
        Route::get('/orders/search', [OrderController::class, 'search'])->name('orders.search');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    });
