<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::active()->paginate();
        return view('front.products.index', [
            'product' => $product,
        ]);
    }

    public function show($slug)
    {
        $product = Product::where('slug', '=', $slug)->firstOrfail();
        // dd($product);
        return view('front.products.show', [
            'product' => $product,
        ]);
    }
}
