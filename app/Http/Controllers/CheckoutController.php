<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function form()
    {
        return view('shops.checkout');
    }

    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $cart = Auth::check()
            ? Auth::user()->cart?->items
            : session('cart', []);

        if (!$cart || count($cart) == 0) {
            return back()->with('error', 'Cart is empty');
        }

        DB::transaction(function () use ($request, $cart) {

            $total = 0;

            foreach ($cart as $item) {
                $price = Auth::check()
                    ? $item->product->price
                    : $item['price'];

                $quantity = Auth::check()
                    ? $item->quantity
                    : $item['quantity'];

                $total += $price * $quantity;
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'note' => $request->note,
                'total' => $total,
                'status' => 'pending'
            ]);

            foreach ($cart as $item) {

                if (Auth::check()) {
                    $product = $item->product;
                } else {
                    $product = Product::find($item['product_id'] ?? null);
                }

                if (!$product) {
                    throw new \Exception('Product not found');
                }

                $price = Auth::check()
                    ? $product->price
                    : $item['price'];

                $quantity = Auth::check()
                    ? $item->quantity
                    : $item['quantity'];

                if ($product->stock < $quantity) {
                    throw new \Exception('Not enough stock');
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'price' => $price,
                    'quantity' => $quantity,
                ]);

                $product->decrement('stock', $quantity);
            }

            if (Auth::check()) {
                $cart = Auth::user()->cart;

                if ($cart) {
                    $cart->items()->delete();
                }
            } else {
                session()->forget('cart');
            }

        });

        return redirect()->route('home')
            ->with('success', 'Order placed successfully!');
    }
}
