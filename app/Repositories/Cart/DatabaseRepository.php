<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class DatabaseRepository implements CartRepository
{
    /**
     * @var \Illuminate\Support\Collection
     */
    protected $items;
    public function __construct()
    {
        $this->items = collect([]);
    }

    public function all()
    {
        if ($this->items->count() == 0) {
            // return all item
            $this->items = Cart::where(
                'cookie_id',
                $this->getCookieId()
            )
                ->orWhere('user_id', Auth::id())
                ->get();
        }
        return $this->items;
    }

    // add to cart
    public function add($item, $qty = 1)
    {
        // First Way
        /*  $cart = Cart::where([
            'cookie_id' => $this->getCookieId(),
            'product_id' => ($item instanceof Product) ? $item->id : $item,
        ])->first();
        if ($cart) {
            $cart->update([
                'user_id' => Auth::id(),
                'quantity' => DB::raw('quantity + ' . $qty),
            ]);
        } else {
            $cart->create([
                'cookie_id' => $this->getCookieId(),
                'product_id' => ($item instanceof Product) ? $item->id : $item,
                'user_id' => Auth::id(),
                'quantity' => DB::raw('quantity + ' . $qty),
            ]);
        }*/
        // Socund Way

        $cart =   Cart::updateOrcreate([
            'cookie_id' => $this->getCookieId(),
            'product_id' => ($item instanceof Product) ? $item->id : $item,
        ], [
            'id' => Str::uuid(),
            'user_id' => Auth::id(),
            'quantity' => DB::raw('quantity + ' . $qty),
        ]);
        // push new data to cart
        // $this->items->push($cart);

        // givv all data from database againe
        $this->items = collect([]);
        return $cart;
    }

    public function clear()
    {
        // delete cart
        Cart::where(
            'cookie_id',
            $this->getCookieId()
        )
            ->orWhere('user_id', Auth::id())
            ->delete();
    }

    protected function getCookieId()
    {
        $id = Cookie::get('cart_cookie_id');

        if (!$id) {
            $id = Str::uuid();
            Cookie::queue('cart_cookie_id', $id, 60 * 24 * 30);
        }
        return $id;
    }

    public function total()
    {
        $items = $this->all();
        return $items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
    }
    public function quantity()
    {
        $items = $this->all();
        return $items->sum('quantity');
    }
}