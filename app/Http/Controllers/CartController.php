<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\DatabaseRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        $cart = $this->cart->all();
        return view('front.cart', [
            'cart' => $cart,
            'total' => $this->cart->total(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity'  => ['int', 'min:1', function ($attr, $value, $fail) {
                $id = request()->input('product_id');
                $product = Product::find($id);
                if ($value > $product->quantity) {
                    $fail(__('Quantity greater than quantity in stock.'));
                }
            }],
        ]);

        $item = Product::findOrFail($request->post('product_id'));
        $qty = $request->post('quantity', 1);
        $this->cart->add($item, $qty);

        if ($request->expectsJson()) {
            return $this->cart->all();
        }

        return redirect()->back()->with('success', "{$item->name} added to cart!");
    }

    public function show($id)
    {
        $cart = $this->cart->get($id);

        return view('front.cart', [
            'cart' => $cart,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => ['int', 'min:1'],
        ]);

        $newQty = $request->post('quantity');
        $this->cart->update($id, $newQty);

        return redirect()->back()->with('success', 'Cart updated successfully.');
    }

    public function remove($cart)
    {
        // Make sure $cart is an instance of the Cart model
        $cart = Cart::find($cart);
        if ($cart) {
            $cart->delete();
        }
    }
    public function clear()
    {
        $this->cart->clear();

        return redirect()->back()->with('success', 'Cart cleared successfully.');
    }
    public function destroy($id)
    {
        $cartRepository = new DatabaseRepository();
        $cartRepository->remove($id);

        return redirect()->route('cart')->with('success', 'Item has been removed from cart!');
    }
}
