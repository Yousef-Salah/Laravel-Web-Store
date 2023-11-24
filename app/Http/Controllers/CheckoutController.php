<?php

namespace App\Http\Controllers;

use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(CartRepository $cart)
    {
        return view('store.checkout', [
            'cart' => $cart,
        ]);
    }

    public function store(Request $request, CartRepository $cart)
    {
        event('order.created');   
    }
}
