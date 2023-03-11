@extends('layouts.app')

@section('content')
    <section class="shop">
        <div class="container">

            @if(session('message'))
                <div class="alert alert-{{ ( session('success') ? 'success' : 'danger')}}">
                    {{ session('message') }}
                </div>
            @endif

            <div class="products-grid">

                @foreach($products as $product)

                    <div class="product-item" >

                            <a class="product-image" href="{{ route('shop.products.find', ['id' => $product->id]) }}">
                                <img src="{{ asset($product->image) }}" alt="">
                            </a>
                            <div class="product-details">
                                <h4>{{ $product->product->product_name }}</h4>
                                <p>Php {{ number_format($product->price, 2) }}</p>
                                <form action="{{ route('shop.product.addToCart') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="seller_id" id="seller_id" value="{{ $product->seller_id }}">
                                    <input type="hidden" name="product_id" id="product_id" value="{{ $product->product_id }}">
                                    <input type="hidden" name="price" id="price" value="{{ $product->price }}">
                                    <input type="hidden" name="seller_product_id" id="seller_product_id" value="{{ $product->id }}">
                                    <input type="number" name="quantity" id="quantity" value="" max="{{ $product->stock }}">
                                    <button type="submit" {{ ($product->stock ? '' : 'disabled') }}>Add to Cart</button>
                                </form>
                            </div>
                    </div>

                @endforeach

            </div>
        </div>
@endsection
