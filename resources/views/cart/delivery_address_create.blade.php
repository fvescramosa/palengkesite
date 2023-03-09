@extends('layouts.app')

@section('content')

    <section class="cart">
        <form class="cart-container" action="{{ route('cart.checkout') }}" method="POST">




            <div class="button-area">
                <button type="submit"><C></C>heckout</button>
            </div>
        </form>
    </section>


@endsection