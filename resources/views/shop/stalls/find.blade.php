@extends('layouts.app')

@section('content')
    <section class="product container">

        <div class="product-wrapper ">
            <div class="product-top-area">
                <div class="product-img-area">

                    <div id="slide-for">
                        <div>
                            <div class="product-main-image">
                                <img src="{{ asset( $sellerStall->image )  }}" alt="">
                            </div>
                        </div>
                        @for($i=1; $i<=5; $i++)
                            @php $imagekey = 'image_'.$i; @endphp
                            @if($sellerStall[$imagekey])
                                <div>
                                    <div class="product-main-image">
                                        <img src="{{ asset($sellerStall[$imagekey]) }}" alt="">
                                    </div>
                                </div>
                            @endif
                        @endfor

                    </div>
                    <div id="slide-nav" class="product-gallery">
                        <div>
                            <div class="product-img">
                                <img src="{{ asset($sellerStall->image) }}" alt="">
                            </div>
                        </div>
                        @for($i=1; $i<=5; $i++)
                            @php $imagekey = 'image_'.$i; @endphp
                            @if($sellerStall[$imagekey])
                                <div>
                                    <div class="product-img">
                                        <img src="{{ asset( $sellerStall[$imagekey] ) }}" alt="">
                                    </div>
                                </div>
                            @endif
                        @endfor
                    </div>

                </div>
                <div class="product-details-area">
                    <div class="details-top">
                        <h4 class="product-name">{{  $sellerStall->name }}</h4>
                        <p class="seller-name"><i class="fa fa-store"></i> By:  <span class="seller-name">{{  $sellerStall->seller->user->first_name }}</span></p>
                    </div>

                    <hr>

                    <div class="details-middle">

                    </div>

                </div>
            </div>

        </div>


    </section>
    <div class="product-bottom-area">

        <h1 class="title">Store <span>Products</span></h1>
        <div class="container shop-wrapper" style="display: flex; flex-flow: row wrap; padding: 25px">

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
                        <button class="btn btn-orange" type="submit">Apply Filter</button>
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
                            <h4>{{ $product->product->product_name }}</h4>
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
                                <input type="number" name="quantity" id="quantity" value="" max="{{ $product->stock }}">
                                <button class="btn btn-orange" type="submit" {{ ($product->stock ? '' : 'disabled') }}>
                                    <span class="fa fa-shopping-cart"></span>
                                    Add to Cart</button>
                            </form>
                        </div>
                    </div>

                @endforeach

            </div>
        </div>
    </div>
    <script>

        var doc = $(document);
        var productDetail = {
            onInit: function(){
                productDetail.setRatings($('span.rating'));
                // productDetail.hoverRatings($('span.rating'));
                // productDetail.postRating($(''))
            },

            setRatings: function (trigger) {
                trigger.click(function () {

                    var self = $(this);

                    var rating = self.data('rating');

                    $('input[name="ratings"]').val(rating);
                    $('span.rating').removeClass('active');


                    for (rating; rating > 0; rating--){
                        $('span[data-rating="'+ rating +'"]').addClass('active');
                    }


                });
            },

            hoverRatings: function(trigger){
                trigger.mouseover(function () {

                    var self = $(this);

                    var rating = self.data('rating');

                    $('input[name="ratings"]').val(rating);
                    $('span.rating').removeClass('active');


                    for (rating; rating > 0; rating--){
                        $('span[data-rating="'+ rating +'"]').addClass('active');
                    }


                });
            },
            postRating: function () {

                $('form#post-comment').submit();

            }
        }

        doc.ready(function () {

            productDetail.onInit();

            $('#slide-for').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                arrows: false,
                fade: true,
                asNavFor: '#slide-nav'
            });

            $('#slide-nav').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
                asNavFor: '#slide-for',
                dots: false ,
                centerMode: true,
                focusOnSelect: true
            });
        })



    </script>
@endsection
