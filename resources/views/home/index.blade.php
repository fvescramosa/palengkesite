@extends('layouts.app')

@section('content')
    <div class="home-bg">
        <section class="home">

            <div class="content">
                <span>Buy now, Deliver later</span>
                <h3>Fresh and Quality Products</h3>
                <p>To serve your Palengke needs right in your front door</p>
                <a href="products.php" class="home-btn white-btn">Products</a>
            </div>

        </section>
    </div>
    <section class="home-category">

        <h1 class="title">shop by category</h1>

        <div class="box-container">

            <div class="box">
                <img src="images/cat-1.png" alt="">
                <h3>fruits</h3>
                <p>To serve you different kinds of fresh fruits.</p>
                <a href="category.php?category=fruits" class="home-btn white-btn">fruits</a>
            </div>

            <div class="box">
                <img src="images/cat-2.png" alt="">
                <h3>meat</h3>
                <p>All time favorite like pork liempo, chicken adobo, pork adobo, and porkchop are here.</p>
                <a href="category.php?category=meat" class="home-btn white-btn">meat</a>
            </div>

            <div class="box">
                <img src="images/cat-3.png" alt="">
                <h3>vegetables</h3>
                <p>Eggplant, Carrots, Potatoes, Kalabasa, Sili, etc.</p>
                <a href="category.php?category=vegitables" class="home-btn white-btn">vegetables</a>
            </div>

            <div class="box">
                <img src="images/cat-4.png" alt="">
                <h3>fish and seafood</h3>
                <p>Different kinds of fresh fish and seafood are here to serve your cravings.</p>
                <a href="category.php?category=fish" class="home-btn white-btn">fish & seafood</a>
            </div>

            <div class="box">
                <img src="images/cat-5.png" alt="">
                <h3>grocery items</h3>
                <p>All the grocery items like canned goods and even your favorite snacks are here.</p>
                <a href="category.php?category=grocery" class="home-btn white-btn">grocery</a>
            </div>

        </div>

    </section>
    <section class="home-products products">

        <h1 class="title">Featured Products</h1>



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

@endsection
