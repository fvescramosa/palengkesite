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
    <link href="{{ asset('thirdparty/css/bootstrap.css') }}" rel="stylesheet" type="text/css">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    {{--<link href="{{ asset('css/seller/styles.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('thirdparty/slick-1.8.1/slick/slick.css') }}" />
    <script type="text/javascript" src="{{ asset('thirdparty/js/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('thirdparty/slick-1.8.1/slick/slick.js') }}"></script>
    <script type="text/javascript" src="{{ asset('thirdparty/js/bootstrap.js') }}"></script>
    </head>
    <body id="page-top">

        <div class="admin">
            <!-- Page Wrapper -->
            <div class="wrapper">
                <div class="sidebar main">
                    <div class="sidebar-header">
                        <a href="{{ route('admin.index') }}">
                            <h3><i class="fa fa-desktop"></i> Admin Dashboard</h3>
                        </a>
                    </div>
                    <ul>
                        <li>
                            <a href="#" class="collapsed" data-toggle="collapse" data-target="#users_submenu">
                                <span class="icon"><i class="fa fa-users"></i></span>
                                <span class="item">Users</span>
                            </a>
                            <div class="collapse {{ (request()->segment(2) == 'users') ? 'show' : ''}}" id="users_submenu" aria-expanded="false">
                                <ul>
                                    <li >
                                    <a href="{{ route('admin.show.buyers.list') }}"  class="{{ ( request()->routeIs('admin.show.buyers.list') ? 'active' : '' )}}">
                                        <span class="icon"><i class="fa fa-users"></i></span>
                                        <span class="item">Buyers</span>
                                    </a>                           
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.show.sellers.list') }}" class="{{ ( request()->routeIs('admin.show.sellers.list') ? 'active' : '' )}}">
                                            <span class="icon"><i class="fa fa-users"></i></span>
                                            <span class="item">Sellers</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                        
                        <li>
                            <a href="{{ route('admin.stalls.show') }}">
                                <span class="icon"><i class="fas fa-store"></i></span>
                                <span class="item">Stalls</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.products.show') }}">
                                <span class="icon"><i class="fa fa-shopping-basket"></i></span>
                                <span class="item">Products</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.seller.stalls.show') }}">
                                <span class="icon"><i class="fa fa-user-shield"></i></span>
                                <span class="item">Seller Stalls</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.appointments.show') }}">
                                <span class="icon"><i class="fa fa-clock"></i></span>
                                <span class="item">Stall Appointment</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.categories.show') }}">
                                <span class="icon"><i class="fa fa-store-alt"></i></span>
                                <span class="item">Categories</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                <span class="icon"><i class="fas fa-power-off"></i></span>
                                <span class="item">Logout</span>
                            </a>
                            <form id="frm-logout" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="section">
                    <div class="top_navbar main">
                        <div class="hamburger">
                            <a href="#">
                                <i class="fas fa-bars"></i>
                            </a>
                        </div>
                    </div>

                    <main>
                        @yield('content')
                    </main>


                    <script>
                        const app = {
                            initCollapse: function(){
                                console.log('A script has been loaded');
                            },
                            filter: function(trigger){
                                trigger.change(function(e){

                                    $('#sortlist').submit();
                                });
                            },
                        };

                        $(window).on('load', function(){
                            app.initCollapse();
                            app.filter($('#orderby'));
                        });


                    </script>
                    <footer></footer>
                </div>
            </div>
            <!-- End of Page Wrapper -->
        </div>
    </body>
</html>

