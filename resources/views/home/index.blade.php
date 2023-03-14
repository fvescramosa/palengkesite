@extends('layouts.app')

@section('content')
    <div class="home-bg"> 
        <div class="overlay"></div>
        <section class="home">
           
            <div class="content">
                <span>Buy Now, Deliver Later</span>
                <h3>Fresh and Quality Products</h3>
                <p>To serve your Palengke needs right in your front door</p>
                <a href="products.php" class="home-btn white-btn">Products</a>
            </div>

        </section>
    </div>
    <section class="home-category ">

        <h1 class="title">shop by <span>category</span></h1>

        <div class="box-container" id="box-container">
            @foreach($categories as $category)
                     <a href="{{ route('shop.product.category', ['category' => $category->category]) }}" class="box-item" style="background-image: url({{ asset($category->image)  }})">
                        <div class="overlay"></div>
                         <h3>{{ $category->category }}</h3>
                    </a>
            @endforeach
        </div>

    </section>
    <section class="home-products products container">

        <h1 class="title">Featured <span>Products</span></h1>

        <div class="products-grid">

            @foreach($featuredProducts as $featuredProduct)

            <div class="product-item">

                    <div class="product-image">
                        <img src="{{ asset($featuredProduct->image) }}" alt="">
                    </div>
                    <div class="product-details">


                        <h4 class="product-name">{{ $featuredProduct->product->product_name }}</h4>
                        <p>Php {{ number_format($featuredProduct->price, 2) }}</p>
                        <form action="{{ route('shop.product.addToCart') }}" method="POST">

                            @csrf
                            <input type="hidden" name="seller_id" id="seller_id" value="{{ $featuredProduct->seller_id }}">
                            <input type="hidden" name="product_id" id="product_id" value="{{ $featuredProduct->product_id }}">
                            <input type="hidden" name="price" id="price" value="{{ $featuredProduct->price }}">
                            <input type="hidden" name="seller_product_id" id="seller_product_id" value="{{ $featuredProduct->id }}">
                            <input type="number" name="quantity" id="quantity" value="" max="{{ $featuredProduct->stock }}">
                            <button class="btn-green" type="submit" {{ ($featuredProduct->stock ? '' : 'disabled') }}><span class="fa fa-shopping-cart "></span>Add to Cart</button>
                        </form>
                    </div>
                </div>

            @endforeach

        </div>


    </section>
    <script>    
        const elements = {
            initSlick: function () {
                $(" .home-category .box-container").slick({
                    slidesToShow:4,
                    slidesToScroll:1,
                    dots: false,
                    autoplay: true,
                    autoplaySpeed: 5000,
                    infinite: true,
                    slide: 'div',
                    cssEase: 'linear',

                });
            },
            initFeaturedProducts: function () {

                $(" .products-grid").slick({
                    slidesToShow:4,
                    slidesToScroll:1,
                    dots: false,
                    autoplay: false,
                    autoplaySpeed: 5000,
                    infinite: true,
                    slide: 'div',
                    cssEase: 'linear',

                });
            }
        }

        $(document).ready(function(){
           elements.initSlick();
           // elements.initFeaturedProducts();
        });

    </script>
@endsection
