<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Palengke Site</title>


    <!-- Custom fonts for this template-->
    <link href="{{ asset('thirdparty/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
     <link rel="stylesheet" type="text/css" href="{{ asset('thirdparty/sweetalert2/package/dist/sweetalert2.css') }}" />
    <link href="{{ asset('thirdparty/css/bootstrap.css') }}" rel="stylesheet" type="text/css">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/seller/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/buyer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/orders.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('thirdparty/slick-1.8.1/slick/slick.css') }}" />
    <script type="text/javascript" src="{{ asset('thirdparty/js/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('thirdparty/slick-1.8.1/slick/slick.js') }}"></script>
     <script type="text/javascript" src="{{ asset('thirdparty/sweetalert2/package/dist/sweetalert2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('thirdparty/js/bootstrap.js') }}"></script>


    </head>
    <body id="page-top">

        <div class="buyer">
            <!-- Page Wrapper -->


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
                                                {{ Auth::user()->first_name }}  {{ Auth::user()->last_name }}
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
                    @if(isset($response))
                        <script>
                            Swal.fire({
                                title: '{{ ucfirst($response) }}!',
                                text: '{{ $message  }}',
                                icon: '{{ $response }}',
                                confirmButtonText: 'Ok'
                            })
                        </script>
                    @endif

                    @if(  session()->get('response')  )

                        <script>
                            Swal.fire({
                                title: '{{ ucfirst(session()->get('response')) }}!',
                                text: '{{ session()->get('message')  }}',
                                icon: '{{ session()->get('response') }}',
                                confirmButtonText: 'Ok'
                            })
                        </script>
                    @endif
                    <main>
                        <div class="dashboard">
                            <div class="dashboard-box">
                                <div class="profile"></div>
                                <ul>
                                    <li>
                                        <a href="#"> Orders </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <section class="content">
                            @yield('content')
                        </section>


                    </main>


                    <script>
                        const app = {
                            initCollapse: function(){
                                console.log('A script has been loaded');
                            }
                        };

                        $(window).on('load', function(){
                            app.initCollapse();
                            $('.hamburger').click(function(){
                                if($('.sidebar').hasClass('close')){
                                    $('.sidebar').removeClass('close');
                                    $('.wrapper .section').removeClass('open');
                                }else{
                                    $('.sidebar').addClass('close');
                                    $('.wrapper .section').addClass('open');
                                }
                            });
                        });


                    </script>
                    <footer></footer>
                </div>

    </body>
</html>
