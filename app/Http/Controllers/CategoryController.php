<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create(){
        return view('categories.create');
    }

    public function show(Category $category)
    {
        $products = $category->products()->latest()->get();

        return view('shops.showcase', compact('products', 'category'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'name'=>'required',
            'note'=>'nullable'
        ]);

        $category = Category::create($data);

        return redirect()->route('categories.index')->with('success','Create category successfully');
    }

    public function edit(Category $category){
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category){
        $data = $request->validate([
            'name'=>'required',
            'note'=>'nullable'
        ]);

        $category->update($data);

        return redirect()->route('categories.index')->with('succcess','Update category successfully');
    }

    public function destroy(Category $category){
        $category->delete();
        return redirect()->route('categories.index')->with('success','Delete category successfully');
    }
}
