<div class="ps-cart"><a class="ps-cart__toggle" href="#"><span><i>{{ $cart->count() }}</i></span><i class="ps-icon-shopping-cart"></i></a>
    <div class="ps-cart__listing">
        <div class="ps-cart__content">
            @foreach($cart as $item)
                <div class="ps-cart-item"><a class="ps-cart-item__close" href="#"></a>
                    <div class="ps-cart-item__thumbnail"><a href="{{ $item->product->url }}"></a><img src="{{ $item->product->image_url }}" alt=""></div>
                    <div class="ps-cart-item__content"><a class="ps-cart-item__title" href="{{ $item->product->url }}">{{ $item->product->name }}</a>
                        <p><span>Quantity:<i>{{ $item->quantity }}</i></span><span>Total:<i>{{ Money::format($item->quantity * $item->product->price) }}</i></span></p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="ps-cart__total">
            <p>Number of items:<span>{{ $cart->count() }}</span></p>
            <p>Item Total:<span>{{ Money::format($totalPrice) }}</span></p>
        </div>
        <div class="ps-cart__footer"><a class="ps-btn" href="{{ route('cart') }}">Check out<i class="ps-icon-arrow-left"></i></a></div>
    </div>
</div>