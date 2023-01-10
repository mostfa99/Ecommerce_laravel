<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::join('categories','categories.id','=','products.category_id')
        ->select([
            'products.*',
            'categories.name as category_name',
        ])->latest()->limit(10)->get();
        return view('home',[
            'products' => $products ,
            ]);
    }
}