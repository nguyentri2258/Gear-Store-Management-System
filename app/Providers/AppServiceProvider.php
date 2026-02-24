<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {

    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $categories = Category::all();
            $view->with('categories', $categories);

            $cartCount = 0;

            if (Auth::check()) {

                $cart = Auth::user()->cart;

                if ($cart) {
                    $cartCount = $cart->items()->sum('quantity');
                }

            } else {

                $cart = session('cart', []);

                foreach ($cart as $item) {
                    $cartCount += $item['quantity'];
                }
            }

            $view->with('globalCartCount', $cartCount);
        });
    }
}
