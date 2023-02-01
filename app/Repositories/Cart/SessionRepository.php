<?php

namespace App\Repositories\Cart;

use Illuminate\Support\Facades\Session;

class SessionRepository implements CartRepository
{
    protected $key = 'cart';
    public function all()
    {
        // return all item
    return Session::get($this->key);
    }

    public function add($item,$qty =1)
    {
        // add to cart
        Session::push($this->key,$item);
    }

    public function clear()
    {
        // delete cart
        Session::forget($this->key);
    }
}