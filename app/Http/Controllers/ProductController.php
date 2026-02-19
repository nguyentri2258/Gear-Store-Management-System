<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function search(Request $request) {
        $request->validate([
            'name'=>'nullable'
        ]);

        $products = Product::where('name','like','%'.$request->name.'%')
                            ->get();

        return view('shops.showcase', compact('products'));
    }

    public function create() {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name'=>'required|string',
            'quantity'=>'required|integer',
            'price' => 'required|integer|min:0',
            'category_id'=>'required|exists:categories,id',
            'description'=>'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads'), $filename);

            $data['image'] = $filename;
        }

        $product = Product::create($data);

        return redirect()->route('products.index')->with('success','Create product successfully');
    }

    public function edit(Product $product) {
        $categories = Category::all();
        return view('products.edit', compact('product','categories'));
    }

    public function update(Request $request, Product $product) {
        $data = $request->validate([
            'name'=>'required|string',
            'quantity'=>'required|integer',
            'price' => 'required|integer|min:0',
            'category_id'=>'required|exists:categories,id',
            'description'=>'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        if ($request->hasFile('image')) {

            if ($product->image && file_exists(public_path('uploads/'.$product->image))) {
                unlink(public_path('uploads/'.$product->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);

            $data['image'] = $filename;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success','Update product successfully');
    }

    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('products.index')->with('success','Delete product successfully');
    }

    public function shop()
    {
        $products = Product::latest()->get();
        return view('shops.showcase', compact('products'));
    }

    public function show(Product $product)
    {
        return view('shops.detail', compact('product'));
    }
}
