<?php

namespace App\Listeners;

use App\Models\Cart;
use App\Repositories\Cart\CartRepository;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class UpdateCartUserId
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param Illuminate\Auth\Events\Login $event
     * @return void
     */
    public function handle(Login $event)
    {
        // $id = Auth::id();
        $id = $event->user->id;
        $cart = App::make(CartRepository::class);

        // this method not exists in Repository interface
        // so we may have an implementation does not have this method
        if(method_exists($cart, 'setUserId')) {
            $cart->setUserId($id);
        }
    }
}
