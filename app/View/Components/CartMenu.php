<?php

namespace App\View\Components;

use Stringable;
use App\Models\Cart;
use App\Repositories\Cart\CartRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Cookie;

class CartMenu extends Component
{
    public $cart;    // any public property passed automaticly to component.
    public $totalPrice;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct() // __construct(CartRepository $cart)
    {
        $newCart = App::make(CartRepository::class);

        $this->cart = $newCart->all();

        $this->totalPrice = $newCart->total();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart-menu');
    }
}
