<?php

namespace App\Repositories\Cart;

interface CartRepository
{
    public function all();

    public function add($item, $qty = 1);

    public function update($itemId, $newQty);

    public function remove($cart);

    public function clear();

    public function count();

    public function total();
}
