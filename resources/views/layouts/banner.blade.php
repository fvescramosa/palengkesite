<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}

    <!-- Fonts -->
    {{--<link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
    {{--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}
    <link href="{{ asset('thirdparty/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    

    <!-- Styles -->
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('thirdparty/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/shop.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('thirdparty/slick-1.8.1/slick/slick.css') }}" />
    <script type="text/javascript" src="{{ asset('thirdparty/js/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('thirdparty/slick-1.8.1/slick/slick.js') }}"></script>
    <script type="text/javascript" src="{{ asset('thirdparty/js/bootstrap.js') }}"></script>
    <!-- <script type="text/javascript" src="{{ asset('js/app.js') }}" defer ></script> -->
</head>
<body>
    <div >
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <div class="bg-area" style="">
                        <div class="logo-area">
                            <img src="{{ asset('images/logo-palengkesite.png') }}" alt="Palengkesite">
                        </div>
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav">

                    
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="#">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Stores</a>
                        </li>
                        
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.index') }}"><i class="fa fa-shopping-cart "></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="">


            @if(isset($innerPageBanner$innerPageBanner))
                <section class="banner" style="background-image: url({{ $innerPageBanner }})">

                </section>
            @endif
                @yield('content')

        </main>
        <footer class="footer">

            <section class="box-container">

                <div class="box">
                    <h3>quick links</h3>
                    <a href="home.php"> <i class="fas fa-angle-right"></i> Home</a>
                    <a href="products.php"> <i class="fas fa-angle-right"></i> Products</a>
                    <a href="about.php"> <i class="fas fa-angle-right"></i> About Us</a>
                    <a href="contact.php"> <i class="fas fa-angle-right"></i> Contact Us</a>
                </div>

                <div class="box">
                    <h3>extra links</h3>
                    <a href="cart.php"> <i class="fas fa-angle-right"></i> Cart</a>
                    <a href="wishlist.php"> <i class="fas fa-angle-right"></i> Wishlist</a>
                    <a href="orders.php"> <i class="fas fa-angle-right"></i> Orders</a>
                    <a href="register.php"> <i class="fas fa-angle-right"></i> Register</a>
                </div>

                <div class="box">
                    <h3>contact info</h3>
                    <p> <i class="fas fa-phone"></i> +123-456-7890 </p>
                    <p> <i class="fas fa-phone"></i> +111-222-3333 </p>
                    <p> <i class="fas fa-envelope"></i> teamjarl@gmail.com </p>
                    <p> <i class="fas fa-map-marker-alt"></i> University of Batangas </p>
                </div>

                <div class="box">
                    <h3>follow us</h3>
                    <a href="#"> <i class="fab fa-facebook-f"></i> Facebook </a>
                    <a href="#"> <i class="fab fa-twitter"></i> Twitter </a>
                    <a href="#"> <i class="fab fa-instagram"></i> Instagram </a>
                    <a href="#"> <i class="fab fa-linkedin"></i> LinkedIn </a>
                </div>

            </section>

            <p class="credit"> &copy; Copyright @ <?= date('Y'); ?> by <span>Team JARL</span> | All Rights Reserved! </p>

        </footer>
    </div>

    <script>
       const el = {
            initDetectScroll: function() {

                if($(window).scrollTop()  > 100 ) {
                    console.log('WORKING');
                    $('.navbar').addClass('fixed');
                    } else {
                        $('.navbar').removeClass('fixed');
                    }
            },
            initSlick: function(){
                // $('#box-container').slick({
                //     slidesToShow: 5,
                //     slidesToScroll: 1,
                //     infinite: true,
            
                //     dots: false ,
                //     focusOnSelect: true
                // });
            }
       }

       $(window).on('scroll', function(){
            el.initDetectScroll();
       });

       $(window).on('load', function(){
            el.initSlick();
        });
    </script>

</body>
</html>
