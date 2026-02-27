<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function cart()
    {
        if (Auth::check()) {

            $cart = Auth::user()
                ->cart
                ?->load('items.product');

            $items = $cart ? $cart->items : collect();

            $total = $items->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            return view('shops.cart', [
                'cart' => $items,
                'total' => $total,
                'isDatabase' => true
            ]);
        }

        $cart = session()->get('cart', []);

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('shops.cart', [
            'cart' => $cart,
            'total' => $total,
            'isDatabase' => false
        ]);
    }


    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

            if (Auth::check()) {

            $cart = Cart::firstOrCreate([
                'user_id' => Auth::id()
            ]);

            $item = CartItem::where([
                'cart_id' => $cart->id,
                'product_id' => $id
            ])->first();

            if ($item) {
                $item->increment('quantity');
            } else {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $id,
                    'quantity' => 1
                ]);
            }

            return redirect()->back()->with('success', 'Added to cart!');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += 1;
        } else {
            $cart[$id] = [
                "product_id" => $product->id,
                "name" => $product->name,
                "price" => $product->price,
                "image" => $product->image,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Added to cart!');
    }


    public function updateCart(Request $request, $id)
    {
        if (Auth::check()) {

            $cart = Auth::user()->cart;

            if ($cart) {
                $item = $cart->items()->where('product_id', $id)->first();

                if ($item) {
                    $item->update([
                        'quantity' => $request->quantity
                    ]);
                }
            }

            return redirect()->back();
        }

        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->back();
    }


    public function removeFromCart($id)
    {
        if (Auth::check()) {

            $cart = Auth::user()->cart;

            if ($cart) {
                $cart->items()->where('product_id', $id)->delete();
            }

            return redirect()->back();
        }

        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back();
    }
}
