@extends('layouts.app')

@section('content')
    <div class="shop">


        <div class="container shop-wrapper">

            <div class="filter-wrapper">
                    <h3>Filter</h3>
                    <form action="" id="filter" method="GET">
                        <div class="by-categories">
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="" for="">Product Name</label>
                                    <input type="text" class="form-control" name="product_name" id="product_name" value="{{ old('product_name') ?? $_GET['product_name'] ?? '' }}">
                                </div>
                            </div>

                                @foreach($categories as $category)
                                    <div class="form-check">
                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="form-check-input" {{ ( isset( $_GET['categories']) && in_array($category->id, $_GET['categories']) ? 'checked' : '')}}>
                                        <label class="form-check-label" for="">
                                            {{ $category->category }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>


                        <div class="by-price">
                            <div class="form-group">

                                <label for="">Min. Price</label>
                                <input type="number" class="form-control" name="min_price" id="min_price" value="{{ old('min_price') ?? $_GET['min_price'] ?? '' }}">

                                <label for="">Max Price</label>
                                <input type="number" class="form-control" name="max_price" id="max_price" value="{{ old('max_price') ?? $_GET['max_price'] ?? '' }}">
                            </div>
                        </div>
                        <div class="by-ratings">
                            @for($i=1; $i <= 5; $i++)
                                <div class="form-check">
                                    <input type="checkbox" name="ratings[]" value="{{ $i }}" class="form-check-input" {{ ( isset( $_GET['ratings']) && in_array($i, $_GET['ratings']) ? 'checked' : '')}}>
                                    <label class="form-check-label" for=""> {{ $i }} Star Rating(s)
                                       @php $n = 1; @endphp
                                        @while($n <= 5)
                                            <span class="product-rating @if($i >= $n) active @else hide @endif fa fa-star" data-rating=""> </span>
                                            @php $n++; @endphp
                                        @endwhile
                                    </label>
                                </div>
                            @endfor
                        </div>
                        <div class="row-btn">
                            <button class="btn home-btn option-btn" type="submit">Apply Filter</button>
                        </div>

                    </form>
                </div>
            <div class="products-grid">

                @foreach($products as $product)

                    <div class="product-item" >

                            <a class="product-image" href="{{ route('shop.products.find', ['id' => $product->id]) }}">
                                <img src="{{ asset($product->image) }}" alt="">
                            </a>
                            <div class="product-details">
                                <h4>{{ ($product->custom_title != '' ? $product->custom_title : $product->product->product_name) }}</h4>
                                <p>Php {{ number_format($product->price, 2) }}</p>
                                <form action="{{ route('shop.product.addToCart') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="seller_id" id="seller_id" value="{{ $product->seller_id }}">
                                    <input type="hidden" name="product_id" id="product_id" value="{{ $product->product_id }}">
                                    <input type="hidden" name="price" id="price" value="{{ $product->price }}">
                                    <input type="hidden" name="seller_product_id" id="seller_product_id" value="{{ $product->id }}">

                                    <span class="out-of-stock">{{ ($product->stock) ? '' : 'Out of Stock' }}</span>
                                    <hr>
                                    <label for="">Quantity</label>
                                    <input type="number" name="quantity" min="1" id="quantity" value="" max="{{ $product->stock }}">
                                    <button class="add-to-cart btn btn-orange" type="submit" {{ ($product->stock ? '' : 'disabled') }}>
                                        <span class="fa fa-shopping-cart"></span>
                                        Add to Cart</button>
                                </form>
                            </div>
                    </div>

                @endforeach

            </div>
        </div>

        <script>

            let doc = $(document);
            var shop = {
                onInit: function () {
                    // shop.submitFilter($('#filter input'));
                },
                submitFilter: function (trigger) {
                    trigger.change(function () {
                        $('#filter').submit();
                    });
                }
            };

            doc.ready(function () {
                shop.onInit()
            })
        </script>
@endsection
