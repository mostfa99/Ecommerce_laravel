<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\CookieRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CartController extends Controller
{
    /**
     * @var \App\Repositories\Cart\CartRepository
     */
    protected $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        $cart = $this->cart->all();
        // return $this->cart->all();
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
                    $fail(__('Quantity grater than quantity stack. '));
                }
            }],
        ]);
        $cart = $this->cart->add($request->post('product_id'), $request->post('quantity', 1));

        return redirect()->back()->with('success', __('Item added to cart!'));
    }


    public function show(Request $id)
    {
        $cart = Cart::where('slug', '=', $id)->firstOrfail();
        // dd($product);
        return view('front.cart', [
            'cart' => $cart,

        ]);
    }
}
