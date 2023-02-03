@extends('layouts.seller')

@section('content')
    <div class="container">
        <section>
            <div id="accordion">
                @foreach($orders as $order)
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    {{ $order->transaction_id }}
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <section class="cart">

                                    <div class="main-cart">
                                        <h3>Products</h3>

                                        <div class="cart-items">
                                            @foreach($order->order_products as $orderProduct)
                                                <div class="cart-item">
                                                    <div class="product-check">
                                                        <div class="form-check">

                                                        </div>
                                                    </div>
                                                    <div class="product-image">
                                                        <a href="">
                                                            <img src="{{ $orderProduct->product->image }}" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="product-name">{{ $orderProduct->product->product_name }}</div>
                                                    <div class="product-price">Php {{ $orderProduct->seller_product->price   }} x {{ $orderProduct->quantity }}</div>
                                                    <div class="product-total">{{ $orderProduct->total }}</div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>

                                </section>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>


    </div>
@endsection
