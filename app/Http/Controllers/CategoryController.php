<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('front.catagories.index', compact('categories'));
    }
    public function show(Category $category)
    {
        $products = $category->products()->paginate(9);

        return view('front.catagories.show', compact('category', 'products'));
    }
}
