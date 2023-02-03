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
    <section class="home-category">

        <h1 class="title">shop by <span>category</span></h1>

        <div class="box-container" id="box-container">

            <div>
                 <div class="box-item" style="background-image: url('images/meat.jpg')">
                    <div class="overlay"></div>
                     <h3>Meat</h3>
                </div>
            </div>

            <div>
                 <div class="box-item" style="background-image: url('images/fish.jpg')">
                    <div class="overlay"></div>
                     <h3></h3>
                </div>
            </div>

            <div>
                <div class="box-item" style="background-image: url('images/fruits-veggy.jpg')">
                    <div class="overlay"></div>
                </div>
            </div>

            <div>
                 <div class="box-item" style="background-image: url('images/poultry.jpg')">
                    <div class="overlay"></div>
                </div>
            </div>

            <div>
                <div class="box-item" style="background-image: url('images/grocery.jpg')">
                    <div class="overlay"></div>
                </div>
            </div>


        </div>

    </section>
    <section class="home-products products">

        <h1 class="title">Featured <span>Products</span></h1>

        <div class="products-grid">

            @foreach($featuredProducts as $featuredProduct)

            <div class="product-item">

                    <div class="product-image">
                        <img src="{{ $featuredProduct->product->image }}" alt="">
                    </div>
                    <div class="product-details">


                        <h4>{{ $featuredProduct->product->product_name }}</h4>
                        <p>Php {{ number_format($featuredProduct->price, 2) }}</p>
                        <form action="{{ route('shop.product.addToCart') }}" method="POST">

                            @csrf
                            <input type="hidden" name="seller_id" id="seller_id" value="{{ $featuredProduct->seller_id }}">
                            <input type="hidden" name="product_id" id="product_id" value="{{ $featuredProduct->product_id }}">
                            <input type="hidden" name="price" id="price" value="{{ $featuredProduct->price }}">
                            <input type="hidden" name="seller_product_id" id="seller_product_id" value="{{ $featuredProduct->id }}">
                            <input type="number" name="quantity" id="quantity" value="" max="{{ $featuredProduct->stock }}">
                            <button type="submit" {{ ($featuredProduct->stock ? '' : 'disabled') }}>Add to Cart</button>
                        </form>
                    </div>
                </div>

            @endforeach

        </div>

        <div class="box-container">

            @foreach($featuredProducts as $featuredProduct)

                <form action="" class="box" method="POST">
                    <div class="price">₱<span>200</span>/-</div>
                    <a href="view_page.php?pid=41" class="fas fa-eye"></a>
                    <img src="uploaded_img/ground-beef-raw-2000x1333-1-1536x1024.jpg" alt="">
                    <div class="name">Ground Beef</div>
                    <div class="seller">Seller Username : louis123</div>
                    <input type="hidden" name="pid" value="41">
                    <input type="hidden" name="seller_id" value="34">
                    <input type="hidden" name="p_name" value="Ground Beef">
                    <div class="stock" style="color: green">In Stock</div>
                    <input type="hidden" name="p_price" value="200">
                    <input type="hidden" name="p_image" value="ground-beef-raw-2000x1333-1-1536x1024.jpg">
                    <input type="number" min="1" value="1" name="p_qty" class="qty">
                    <input type="submit" value="add to wishlist" class="option-btn" name="add_to_wishlist">
                    <input type="submit" value="add to cart" class="btn " name="add_to_cart">
                </form>
            @endforeach


        </div>

    </section>
    <script>    
        const elements = {
            initSlick: function () {
                $(" .home-category .box-container").slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false ,
                    focusOnSelect: true
                });
            }
        }

        $(document).ready(function(){
           elements.initSlick();
        });

    </script>
@endsection
