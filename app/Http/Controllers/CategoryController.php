<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        $products = Product::latest()->paginate(15);
        return view('front.catagories.index', compact('categories', 'products'));
    }
    public function show(Category $category)
    {
        $products = $category->products()->paginate(9);
        // dd($products);

        return view('front.catagories.show', compact('category', 'products'));
    }
}
