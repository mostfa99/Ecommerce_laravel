<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CompareController extends Controller
{

    public function index(Request $request)
    {
        // $productIds = $request->query('ids');

        // if (!$productIds) {
        //     return redirect()->route('home');
        // }

        // $products = Product::whereIn('id', $productIds)->get();
        $page = 'Compare';
        return view('front.compare', compact('page'));
    } /*
    public function addToCompare(Request $request, $id)
    {
        // get the product
        $product = Product::findOrFail($id);

        // get the list of product IDs that have already been added to the comparison list
        $productIds = $request->session()->get('compare', []);

        // add the current product's ID to the comparison list
        if (!in_array($id, $productIds)) {
            $productIds[] = $id;
            $request->session()->put('compare', $productIds);
        }

        // redirect back to the product page
        return redirect()->back();
    }
    public function show($id)
    {
        // get the product
        $product = Product::findOrFail($id);

        // get the list of product IDs that have already been added to the comparison list
        $productIds = session('compare', []);

        // pass the product and product IDs to the view
        return view('products.details', compact('product', 'productIds'));
    }
    public function removeFromCompare(Request $request, $id)
    {
        // get the list of product IDs that have already been added to the comparison list
        $productIds = $request->session()->get('compare', []);

        // remove the current product's ID from the comparison list
        if (in_array($id, $productIds)) {
            $productIds = array_diff($productIds, array($id));
            $request->session()->put('compare', $productIds);
        }

        // redirect back to the product page
        return redirect()->back();
    }
    */
}
