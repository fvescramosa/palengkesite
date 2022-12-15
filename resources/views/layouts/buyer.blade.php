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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/seller/styles.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>

</head>
    <body id="page-top">

        <div class="admin">
            <!-- Page Wrapper -->
            <div class="wrapper">
                <div class="sidebar seller">
                    <div class="sidebar-header">
                        <h3><i class="fas fa-shopping-basket"></i> Palengkesite</h3>
                    </div>
                    <ul>
                        <li>
                            <a href="{{ route('seller.profile') }}">
                                <span class="icon"><i class="fas fa-desktop"></i></span>
                                <span class="item">Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="icon"><i class="fas fa-shopify"></i></span>
                                <span class="item">My Stalls</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('seller.products.show') }}">
                                <span class="icon"><i class="fa-solid fa-ice-cream"></i></span>
                                <span class="item">Products</span>
                            </a>
                        </li>
                        {{--<li>
                            <a href="#">
                                <span class="icon"><i class="fas fa-database"></i></span>
                                <span class="item">Development</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="icon"><i class="fas fa-chart-line"></i></span>
                                <span class="item">Reports</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="icon"><i class="fas fa-user-shield"></i></span>
                                <span class="item">Admin</span>
                            </a>
                        </li>--}}
                        <li>
                            <a href="{{ route('user.logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                <span class="icon"><i class="fas fa-power-off"></i></span>
                                <span class="item">Logout</span>
                            </a>
                            <form id="frm-logout" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="section">
                    <div class="top_navbar">
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
                            }
                        };

                        $(window).on('load', function(){
                            app.initCollapse();
                        });


                    </script>
                    <footer></footer>
                </div>
            </div>
            <!-- End of Page Wrapper -->
        </div>
    </body>
</html>
