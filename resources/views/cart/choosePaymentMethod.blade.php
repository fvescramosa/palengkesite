@extends('layouts.app')

@section('content')



    <section class="cart">
        <form class="cart-container" action="{{ route('cart.checkout.selectPaymentMethod') }}" method="post">


            @csrf

             <div class="payment-options">
                 <h2 style="text-align: center" class="col-md-12">Please Select Payment Method</h2>
                 @foreach($paymentOptions as $paymentOption)
                     <div class="payment-option-item">'
                            <label for="">
                             <input class="form-check-input" type="radio" name="payment_method" value="{{ $paymentOption->id }}">

                                 <img src="{{ ( $paymentOption->payment_option == 'PayPal' ? asset('images/paypal.png') : asset('images/cod.png')) }}" alt="">
                                <h4>{{ $paymentOption->payment_option }}</h4>
                             </label>

                     </div>

                 @endforeach
             </div>

            <div class="button-area">
                <button type="submit">Proceed</button>
            </div>
        </form>
    </section>


@endsection