<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items.product');

        return view('orders.show', compact('order'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string'
        ]);

        $orders = Order::when($request->name, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->name . '%');
            })
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function edit(Order $order){
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        if ($order->status !== 'pending') {
            return back()->with('error', 'Only pending orders can be edited.');
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'note' => 'nullable',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request, $order) {
            foreach ($order->items as $oldItem) {
                $oldItem->product->increment('stock', $oldItem->quantity);
            }

            $order->items()->delete();

            $total = 0;

            foreach ($request->items as $itemData) {

                $product = Product::findOrFail($itemData['product_id']);
                $quantity = $itemData['quantity'];

                if ($product->stock < $quantity) {
                    throw new \Exception("Not enough stock for {$product->name}");
                }

                $order->items()->create([
                    'product_id' => $product->id,
                    'price' => $product->price,
                    'quantity' => $quantity,
                ]);

                $product->decrement('stock', $quantity);

                $total += $product->price * $quantity;
            }

            $order->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'note' => $request->note,
                'total' => $total,
            ]);
        });

        return redirect()->route('orders.index')
            ->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order){
        $order->delete();
        return redirect()->route('orders.index')->with('success','Delete order successfully');
    }
}
