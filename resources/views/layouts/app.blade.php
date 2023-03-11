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
    <link href="{{ asset('css/buyer/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/shop.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('thirdparty/sweetalert2/package/dist/sweetalert2.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('thirdparty/slick-1.8.1/slick/slick.css') }}" />
    <script type="text/javascript" src="{{ asset('thirdparty/js/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('thirdparty/slick-1.8.1/slick/slick.js') }}"></script>
    <script type="text/javascript" src="{{ asset('thirdparty/sweetalert2/package/dist/sweetalert2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('thirdparty/js/bootstrap.js') }}"></script>
    <!-- <script type="text/javascript" src="{{ asset('js/app.js') }}" defer ></script> -->
</head>
<body>
    <div >
        @include('layouts.navigation')

        <main class="">
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
            @if(isset($innerPageBanner))
                <section class="banner" style="background-image: url({{ $innerPageBanner }})">
                    <div class="overlay"></div>
                </section>
            @endif

            <div class="longbar green-bar">
                <form action="{{ route('select.market') }}" method="POST" id="select-market">
                    @csrf
                    <select name="market_option" id="market-option">
                        @foreach(\App\Market::all() as $market)
                            <option value="{{ $market->id }}" {{ session()->get('shop_at_market') ==  $market->id ? 'selected' : ''}}>{{ $market->market }}</option>
                        @endforeach
                    </select>

                </form>
            </div>
            @yield('content')

        </main>


        @include('layouts.footer')

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
            changeMarket: function(trigger){

                trigger.change(function () {
                    $('#select-market').submit();
                });

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
            el.changeMarket($('#market-option'));
        });
    </script>

</body>
</html>
