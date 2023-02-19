@extends('layouts.app')

@section('content')



    <section class="cart">
        <form class="cart-container" action="{{ route('cart.checkout') }}" method="POST">

            @csrf
            <div class="delivery-addresses">
                <h3>Address</h3>
                @foreach( auth()->user()->delivery_addresses as $address)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="delivery_address" value="{{ $address->id }}">
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
                                    <input class="form-check-input" type="checkbox" name="cart_ids[]" value="{{ $cart->id }}" checked>
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


                </div>
            </div>
            <div class="payment-options">
                @foreach($paymentOptions as $paymentOption)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" value="{{ $paymentOption->id }}">
                        <label class="form-check-label">
                            {{ $paymentOption->payment_option }}
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="button-area">
                <button type="submit">Checkout</button>
            </div>
        </form>
    </section>

 <div class="container">

     {<div class="row">
         <div class="col-md-8 col-md-offset-2">
             <h3 class="text-center" style="margin-top: 90px;">How to integrate paypal payment in Laravel - Techsolutionstuff</h3>
             <div class="panel panel-default" style="margin-top: 60px;">

                 @if ($message = Session::get('success'))
                     <div class="custom-alerts alert alert-success fade in">
                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                         {!! $message !!}
                     </div>
                     <?php Session::forget('success');?>
                 @endif

                 @if ($message = Session::get('error'))
                     <div class="custom-alerts alert alert-danger fade in">
                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                         {!! $message !!}
                     </div>
                     <?php Session::forget('error');?>
                 @endif
                 <div class="panel-heading"><b>Paywith Paypal</b></div>
                 <div class="panel-body">
                     <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('paypal') !!}" >
                         {{ csrf_field() }}

                         <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                             <label for="amount" class="col-md-4 control-label">Enter Amount</label>

                             <div class="col-md-6">
                                 <input id="amount" type="text" class="form-control" name="amount" value="{{ old('amount') }}" autofocus>

                                 @if ($errors->has('amount'))
                                     <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                 @endif
                             </div>
                         </div>

                         <div class="form-group">
                             <div class="col-md-6 col-md-offset-4">
                                 <button type="submit" class="btn btn-primary">
                                     Paywith Paypal
                                 </button>
                             </div>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </div>
@endsection