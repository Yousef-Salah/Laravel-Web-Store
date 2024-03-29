<x-store-layout title="Cart">
    <div class="ps-content pt-80 pb-80">
        <div class="ps-container">
            <div class="ps-cart-listing">
                <table class="table ps-cart__table">
                    <thead>
                        <tr>
                            <th>All Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart->all() as $item)
                        <tr>
                            <td><a class="ps-product__preview" href="{{ $item->product->url }}">
                                <img class="mr-15" height="80px" src="{{ $item->product->image_url }}" alt=""> {{ $item->product->name }}</a></td>
                            <td>{{ Money::format($item->product->price) }}</td>
                            <td>
                                <div class="form-group--number">
                                    <button class="minus"><span>-</span></button>
                                    <input class="form-control" type="text" value="{{ $item->quantity }}">
                                    <button class="plus"><span>+</span></button>
                                </div>
                            </td>
                            <td>{{ $item->product->price * $item->quantity }}</td>
                            <td>
                                <form action="{{ route('cart.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="ps-remove"></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="ps-cart__actions">
                    <div class="ps-cart__promotion">
                        <div class="form-group">
                            <div class="ps-form--icon"><i class="fa fa-angle-right"></i>
                                <input class="form-control" type="text" placeholder="Promo Code">
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="ps-btn ps-btn--gray">Continue Shopping</button>
                        </div>
                    </div>
                    <div class="ps-cart__total">
                        <h3>Total Price: 
                            <span> 2599.00 $</span>
                        </h3>
                        <a class="ps-btn" href="checkout.html">Process to checkout<i class="ps-icon-next"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-store-layout>