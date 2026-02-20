<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->take(4)->get();
        $products = Product::latest()->take(8)->get();

        return view('home', compact('categories', 'products'));
    }
}
