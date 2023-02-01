<?php

namespace App\Http\Controllers;

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
        $this->cart->add(Product::find(23),3);
        return $this->cart->all();
    }
}
