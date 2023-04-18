<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pageTitle ?? 'Palengkesite' }}</title>

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
    <script type="text/javascript" src="{{ asset('thirdparty/js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('thirdparty/slick-1.8.1/slick/slick.js') }}"></script>
    <script type="text/javascript" src="{{ asset('thirdparty/sweetalert2/package/dist/sweetalert2.js') }}"></script>


    <style>
        .chat {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .chat li {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dotted #B3A9A9;
        }

        .chat li .chat-body p {
            margin: 0;
            color: #777777;
        }

        .panel-body {
            overflow-y: scroll;
            height: 350px;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #555;
        }
    </style>
</head>
<body>
    <div >
        @include('layouts.navigation')
        <script>
            window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'pusherKey' => config('broadcasting.connections.pusher.key'),
            'pusherCluster' => config('broadcasting.connections.pusher.options.cluster')
        ]) !!};
        </script>
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

            @if(  \Illuminate\Support\Facades\Route::currentRouteName() != 'index')
                @if(isset($innerPageBanner))


                        @if($innerPageBanner != '')
                            <section class="banner" style="background-image: url(<?= asset($innerPageBanner) ?>)">
                                <div class="overlay"></div>
                                <h1>{{ $pageTitle ?? '' }}</h1>
                            </section>
                         @else
                                <section class="banner" style="background-image: url('{{ asset('images/defaults/inner-page-banner.jpg') }}')">
                                    <div class="overlay"></div>
                                    <h1>{{ $pageTitle ?? '' }}</h1>
                                </section>
                       @endif
                        {{-- @else


                                @if(  \Illuminate\Support\Facades\Route::currentRouteName() != 'index')

                                    <section class="banner" style="background-image: url({{ $innerPage ?? asset('images/defaults/inner-page-banner.jpg') }})">
                                        <div class="overlay"></div>
                                    </section>
                                @endif--}}
                @else
                    <section class="banner" style="background-image: url('{{ asset('images/defaults/inner-page-banner.jpg') }}')">
                        <div class="overlay"></div>
                    </section>

                @endif
            @endif


            @if(  \Illuminate\Support\Facades\Route::currentRouteName() != 'index' && \Illuminate\Support\Facades\Route::currentRouteName() != 'shop.products.find')
                <div class="longbar green-bar">
                    <div class="">
                        <form action="{{ route('select.market') }}" method="POST" id="select-market">
                            @csrf
                            <label for="">Mabini Public Market - </label>
                            <select name="market_option"  class="" id="market-option">
                                <option value="">All</option>
                                @foreach(\App\Market::all() as $market)
                                    <option value="{{ $market->id }}" {{ session()->get('shop_at_market') ==  $market->id ? 'selected' : ''}}>{{ $market->market }}</option>
                                @endforeach
                            </select>

                        </form>
                    </div>
                </div>
            @endif
            {{--<div class="longbar green-bar">
                <form action="{{ route('select.market') }}" method="POST" id="select-market">
                    @csrf
                    <select name="market_option" id="market-option">
                        @foreach(\App\Market::all() as $market)
                            <option value="{{ $market->id }}" {{ session()->get('shop_at_market') ==  $market->id ? 'selected' : ''}}>{{ $market->market }}</option>
                        @endforeach
                    </select>

                </form>
            </div>--}}


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
            },
            initDeleteFunction: function (trigger) {
                trigger.click(function (e) {

                    let self = $(this);
                    let url = self.attr('data-href');

                    //seller, buyer, staff, stall etc..
                    let action =  self.attr('data-action-delete');

                    e.preventDefault();
                    Swal.fire({
                        title: 'Are you sure you want to remove this '+ action +'?',
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                        denyButtonText: `No`,
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            $.ajax({
                                type:'GET',
                                dataType:"json",
                                url: url,
                                crossDomain:true,
                                data: {
                                    _token: "{{ csrf_token() }}"
                                },
                                success:function(data) {
                                    Swal.fire({
                                        title: data.response + '!',
                                        text: data.message,
                                        icon: data.response,
                                        confirmButtonText: 'Ok',

                                    }).then((result) => {
                                        location.reload(true);
                                    });
                                }
                            });
                        } 
                        else if (result.isDenied) {

                        }
                    })
                });

            },
       }

       $(window).on('scroll', function(){
            el.initDetectScroll();
       });

       $(window).on('load', function(){
            el.initSlick();
            el.changeMarket($('#market-option'));
            el.initDeleteFunction($('a[data-action-delete]'));
        });
    </script>
    {{--<script type="text/javascript" src="{{ asset('js/app.js') }}"  ></script>--}}
</body>
</html>
