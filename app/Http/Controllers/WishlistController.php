<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{

    public function add(Product $product)
    {
        auth()->user()->wishlist()->create([
            'product_id' => $product->id
        ]);

        return back()->with('success', 'Product added to wishlist.');
    }
    public function show()
    {
        if (!auth()->check()) {
            return back();
        }

        $wishlist = auth()->user()->wishlist;
        $page = "Wishlist";
        return view('front.wishlist', compact('wishlist', 'page'));
    }
    public function destroy($id)
    {
        $wishlistItem = Wishlist::find($id);
        $wishlistItem->delete();

        return redirect()->route('wishlist.show')
            ->with('success', 'Item removed from wishlist successfully');
    }
}
