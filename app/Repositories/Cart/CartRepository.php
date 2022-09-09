<?php

namespace App\Repositories\Cart;

interface CartRepository
{
    public function all();

    public function add($item, $quantity = 1);

    public function remove($id);

    public function empty();
    
    public function total();
}