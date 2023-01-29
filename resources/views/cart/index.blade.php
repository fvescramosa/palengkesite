@extends('layouts.app')

@section('content')

 {{ auth()->user()->buyer->carts }}

    <section class="cart">
        <form class="cart-container" action="{{ route('cart.checkout') }}" method="POST">

            @csrf
            <div class="delivery-addresses">
                <h3>Address</h3>
                @foreach( auth()->user()->delivery_addresses as $address)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="delivery_address[]" value="{{ $address->id }}">
                    <label class="form-check-label">
                        {{ $address->stnumber }} {{ $address->stname }} {{ $address->barangay }}, {{ $address->city }} {{ $address->province }}
                    </label>
                </div>
                @endforeach
            </div>
            <div class="main-cart">
                <h3>Cart</h3>

                <div class="cart-items">
                    @foreach(auth()->user()->buyer->carts as $cart)
                        <div class="cart-item">
                            <div class="product-check">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="cart_ids[]" value="{{ $cart->id }}">
                                </div>
                            </div>
                            <div class="product-image">
                                <a href="">
                                    <img src="{{ $cart->seller_product->image  }}" alt="">
                                </a>
                            </div>
                            <div class="product-name">{{ $cart->seller_product->product->product_name  }}</div>
                            <div class="product-price">Php {{ $cart->seller_product->price  }} x {{ $cart->quantity }}</div>
                            <div class="product-total">{{ $cart->total }}</div>
                        </div>
                    @endforeach

                    <button type="submit">Checkout</button>
                </div>
            </div>
        </form>
    </section>


@endsection