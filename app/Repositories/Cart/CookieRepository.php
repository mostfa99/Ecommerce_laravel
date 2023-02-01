<?php

namespace App\Repositories\Cart;

use Illuminate\Support\Facades\Cookie;
// use Illuminate\Support\Facades\Session;

class CookieRepository implements CartRepository
{
    protected $name = 'cart';

    public function all()
    {
        // return all item
        $items = Cookie::get($this->name);
        // dd($items);
        if($items){
            return unserialize($items);
        }
        return [];
    }

    public function add($item,$qty=1)
    {
        // add to cart
        $items = $this->all();
        $items[] = $item;
        Cookie::queue($this->name, serialize($items),60*24*30);

    }

    public function clear()
    {
        // delete cart
        Cookie::queue($this->name,'',-60);
    }
}
