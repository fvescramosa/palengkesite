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
    <link rel="stylesheet" type="text/css" href="{{ asset('thirdparty/sweetalert2/package/dist/sweetalert2.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('thirdparty/slick-1.8.1/slick/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('thirdparty/sweetalert2/package/dist/sweetalert2.css') }}" />
    <script type="text/javascript" src="{{ asset('thirdparty/js/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('thirdparty/slick-1.8.1/slick/slick.js') }}"></script>
    <script type="text/javascript" src="{{ asset('thirdparty/js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('thirdparty/sweetalert2/package/dist/sweetalert2.js') }}"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
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
            <div class="sidebar-content">
                <ul>
                    <li>
                        <a href="#" class="collapsed" data-toggle="collapse" data-target="#users_submenu">
                            <span class="icon"><i class="fa fa-users"></i></span>
                            <span class="item">Users</span>
                        </a>
                        <div class="collapse {{ (request()->segment(2) == 'users') ? 'show' : ''}}" id="users_submenu" aria-expanded="false">
                        <ul>
                                <li class="collapsed" data-toggle="collapse" data-target="#buyers_submenu">
                                    <a href="#"  class="">
                                        <span class="icon"><i class="fa fa-users"></i></span>
                                        <span class="item">Buyers</span>
                                    </a>
                                    <div class="collapse {{ (request()->segment(3) == 'buyers') ? 'show' : ''}}" id="buyers_submenu" aria-expanded="false">
                                        <ul>
                                                <li>
                                                    <a href="{{ route('admin.show.buyers.list') }}" class="{{ ( request()->routeIs('admin.show.buyers.list') ? 'active' : '' )}}">
                                                        <span class="icon"><i class="fa fa-users"></i></span>
                                                        <span class="item">List</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('admin.show.buyers.trash') }}" class="{{ ( request()->routeIs('admin.show.buyers.trash') ? 'active' : '' )}}">
                                                        <span class="icon"><i class="fa fa-archive"></i></span>
                                                        <span class="item">Archive</span>
                                                    </a>
                                                </li>
                                        </ul>
                                    </div>
                                </li>

                                <!-- Seller -->
                                <li class="collapsed" data-toggle="collapse" data-target="#sellers_submenu">
                                    <a href="#"  class="">
                                        <span class="icon"><i class="fa fa-users"></i></span>
                                        <span class="item">Sellers</span>
                                    </a>
                                    <div class="collapse {{ (request()->segment(3) == 'sellers') ? 'show' : ''}}" id="sellers_submenu" aria-expanded="false">
                                        <ul>
                                            <li>
                                                <a href="{{ route('admin.show.sellers.list') }}" class="{{ ( request()->routeIs('admin.show.sellers.list') ? 'active' : '' )}}">
                                                    <span class="icon"><i class="fa fa-users"></i></span>
                                                    <span class="item">List</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.show.sellers.trash') }}" class="{{ ( request()->routeIs('admin.show.sellers.trash') ? 'active' : '' )}}">
                                                    <span class="icon"><i class="fa fa-archive"></i></span>
                                                    <span class="item">Archive</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <!-- Staff -->
                                @if(auth()->guard('admin')->user()->is_super)
                                <li class="collapsed" data-toggle="collapse" data-target="#staff_submenu">
                                    <a href="#"  class="">
                                        <span class="icon"><i class="fa fa-users"></i></span>
                                        <span class="item">Staff</span>
                                    </a>
                                    <div class="collapse {{ (request()->segment(3) == 'staff') ? 'show' : ''}}" id="staff_submenu" aria-expanded="false">
                                        <ul>
                                            <li>
                                                <a href="{{ route('admin.show.staff') }}" class="{{ ( request()->routeIs('admin.show.staff') ? 'active' : '' )}}">
                                                    <span class="icon"><i class="fa fa-users"></i></span>
                                                    <span class="item">List</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.show.staffs.trash') }}" class="{{ ( request()->routeIs('admin.show.staffs.trash') ? 'active' : '' )}}">
                                                    <span class="icon"><i class="fa fa-archive"></i></span>
                                                    <span class="item">Archive</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                @endif
                        </ul>
                        </div>
                    </li>
                    <!-- <li>
                        <a href="{{ route('admin.notifications.show') }}" class="{{ ( request()->routeIs('admin.notifications.show') ? 'active' : '' )}}">
                            <span class="icon"><i class="fas fa-bell"></i></span>
                            <span class="item">Notifications</span>
                            <span class="badge badge-danger" id="notif">0</span>
                        </a>
                    </li> -->
                    <li class="collapsed" data-toggle="collapse" data-target="#stalls_submenu">
                        <a href="#"  class="">
                            <span class="icon"><i class="fa fa-store"></i></span>
                            <span class="item">Stalls</span>
                        </a>
                        <div class="collapse {{ (request()->segment(2) == 'stalls') ? 'show' : ''}}" id="stalls_submenu" aria-expanded="false">
                            <ul>
                                <li>
                                    <a href="{{ route('admin.stalls.show') }}" class="{{ ( request()->routeIs('admin.stalls.show') ? 'active' : '' )}}">
                                        <span class="icon"><i class="fa fa-store"></i></span>
                                        <span class="item">List</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.stalls.trash') }}" class="{{ ( request()->routeIs('admin.stalls.trash') ? 'active' : '' )}}">
                                        <span class="icon"><i class="fa fa-archive"></i></span>
                                        <span class="item">Archive</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="{{ route('admin.seller.stalls.show') }}" class="{{ ( request()->routeIs('admin.seller.stalls.show') ? 'active' : '' )}}">
                            <span class="icon"><i class="fa fa-user-shield"></i></span>
                            <span class="item">Stall Approval</span>

                            <span class="notif badge badge-danger" id="stall-approval-notif">{{ App\SellerStall::where('status', 'pending')->get()->count()  }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.contact-us') }}" class="{{ ( request()->routeIs('admin.contact-us') ? 'active' : '' )}}">
                            <span class="icon"><i class="fa fa-envelope-open"></i></span>
                            <span class="item">Inquiries</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.appointments.show') }}" class="{{ ( request()->routeIs('admin.appointments.show') ? 'active' : '' )}}">
                            <span class="icon"><i class="fa fa-calendar"></i></span>
                            <span class="item">Stall Appointment</span>

                            <span class="notif badge badge-danger" id="stall-app-notif">{{ App\StallAppointment::where('status', 'pending')->get()->count() }}</span>
                        </a>
                    </li>
                    <li class="collapsed" data-toggle="collapse" data-target="#products_submenu">
                        <a href="#"  class="">
                            <span class="icon"><i class="fa fa-cart-plus"></i></span>
                            <span class="item">Products</span>

                            <span class="notif badge badge-danger" id="product-approval-notif">{{ App\Products::where('status', 'pending')->get()->count() }}</span>
                        </a>
                        <div class="collapse {{ (request()->segment(2) == 'products') ? 'show' : ''}}" id="products_submenu" aria-expanded="false">
                            <ul>
                                <li>
                                    <a href="{{ route('admin.products.show') }}" class="{{ ( request()->routeIs('admin.products.show') ? 'active' : '' )}}">
                                        <span class="icon"><i class="fa fa-cart-plus"></i></span>
                                        <span class="item">List</span>

                                        <span class="notif badge badge-danger" id="product-approval-notif">{{ App\Products::where('status', 'pending')->get()->count() }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.products.trash') }}" class="{{ ( request()->routeIs('admin.products.trash') ? 'active' : '' )}}">
                                        <span class="icon"><i class="fa fa-archive"></i></span>
                                        <span class="item">Archive</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="collapsed" data-toggle="collapse" data-target="#categories_submenu">
                        <a href="#"  class="">
                            <span class="icon"><i class="fa fa-store-alt"></i></span>
                            <span class="item">Categories</span>
                        </a>
                        <div class="collapse {{ (request()->segment(2) == 'categories') ? 'show' : ''}}" id="categories_submenu" aria-expanded="false">
                            <ul>
                                <li>
                                    <a href="{{ route('admin.categories.show') }}" class="{{ ( request()->routeIs('admin.categories.show') ? 'active' : '' )}}">
                                        <span class="icon"><i class="fa fa-store-alt"></i></span>
                                        <span class="item">List</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.categories.trash') }}" class="{{ ( request()->routeIs('admin.categories.trash') ? 'active' : '' )}}">
                                        <span class="icon"><i class="fa fa-archive"></i></span>
                                        <span class="item">Archive</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @if(auth()->guard('admin')->user()->is_super)
                    <li>
                        <a href="{{ route('admin.markets.show') }}" class="{{ ( request()->routeIs('admin.markets.show') ? 'active' : '' )}}">
                            <span class="icon"><i class="fas fa-shopping-basket"></i></span>
                            <span class="item">Market</span>
                        </a>
                    </li>
                    @endif
                    <li>
                        <a href="{{ route('admin.settings') }}" class="{{ ( request()->routeIs('admin.settings') ? 'active' : '' )}}">
                            <span class="icon"><i class="fa fa-cog"></i></span>
                            <span class="item">Settings</span>
                        </a>
                    </li>
                    <!-- <li class="collapsed" data-toggle="collapse" data-target="#about_submenu">
                        <a href="#"  class="">
                            <span class="icon"><i class="fa fa-user-shield"></i></span>
                            <span class="item">About Us</span>
                        </a>
                        <div class="collapse {{ (request()->segment(2) == 'about-us') ? 'show' : ''}}" id="about_submenu" aria-expanded="false">
                            <ul>
                                <li>
                                    <a href="{{ route('admin.about-us.index') }}" class="{{ ( request()->routeIs('admin.about-us.index') ? 'active' : '' )}}">
                                        <span class="icon"><i class="fa fa-user-shield"></i></span>
                                        <span class="item">About Us Page</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.developers') }}" class="{{ ( request()->routeIs('admin.developers') ? 'active' : '' )}}">
                                        <span class="icon"><i class="fa fa-user-shield"></i></span>
                                        <span class="item">Developers</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.developers-trash') }}" class="{{ ( request()->routeIs('admin.developers-trash') ? 'active' : '' )}}">
                                        <span class="icon"><i class="fa fa-archive"></i></span>
                                        <span class="item">Archive</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li> -->
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
        </div>
        <div class="section">
            <div class="top_navbar main">
                <div class="hamburger">
                    <a href="#">
                        <i class="fas fa-bars"></i>
                    </a>
                </div>

                @php $parameter = '' @endphp

                <form action="{{ route('admin.set.market') }}" method="GET" id="palengke-filter">

                    <input type="hidden" name="current_url" value="{{ url()->current() }}">
                    <input type="hidden" name="page" value="{{ $_GET['page'] ?? '' }}">
                    <input type="hidden" name="orderby" value="{{ $_GET['orderby'] ?? '' }}">
                    <input type="hidden" name="search" value="{{ $_GET['search'] ?? '' }}">
                    <select  class="form-control" id="marketOption" name="marketOption" placeholder="Order By"  >
                        <option value="">All</option>
                        @foreach(\App\Market::all() as $market)
                            <option value="{{ $market->id }}" {{ session()->get('market') ==  $market->id ? 'selected' : ''}}>{{ $market->market }}</option>
                        @endforeach

                    </select>
                </form>
            </div>

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
                @yield('content')
            </main>


            <script>
                const app = {
                    initCollapse: function(){
                        console.log('A script has been loaded');
                    },
                    filter: function(trigger){
                        trigger.change(function(e){

                            $('#form-header').submit();
                        });
                    },

                    initSearch: function(trigger){
                        trigger.change(function(e){

                            $('#form-header').submit();
                        });
                    },
                    initPalengkeFilter: function(trigger){
                        trigger.change(function(e){

                            $('#palengke-filter').submit();
                        });
                    },

                    initNotifStallApproval: function(){

                        setInterval(function(){
                            $.ajax({
                                type:'GET',
                                dataType:"json",
                                url:"{{route('get.stall.approval.notif')}}",
                                crossDomain:true,
                                data: {
                                    _token: "{{ csrf_token() }}"
                                },
                                success:function(data) {
                                    $('#stall-approval-notif').text(data); 
                                }
                            }); 
                        }, 5000);
                    },

                    initNotifStallAppointment: function(){

                        setInterval(function(){
                            $.ajax({
                                type:'GET',
                                dataType:"json",
                                url:"{{route('get.stall.appointment.notif')}}",
                                crossDomain:true,
                                data: {
                                    _token: "{{ csrf_token() }}"
                                },
                                success:function(data) {
                                  $('#stall-app-notif').text(data); 
                                }
                            }); 
                        }, 5000);
                    },

                    initNotifProduct: function(){

                        setInterval(function(){
                            $.ajax({
                                type:'GET',
                                dataType:"json",
                                url:"{{route('get.product.approval.notif')}}",
                                crossDomain:true,
                                data: {
                                    _token: "{{ csrf_token() }}"
                                },
                                success:function(data) {
                                $('#product-approval-notif').text(data); 
                                }
                            }); 
                        }, 5000);
                    },

                    initNotifications: function(){

                        setInterval(function(){
                            $.ajax({
                                type:'GET',
                                dataType:"json",
                                url:"{{route('get.notif')}}",
                                crossDomain:true,
                                data: {
                                    _token: "{{ csrf_token() }}"
                                },
                                success:function(data) {
                                    $('#notif').text(data); 
                                }
                            }); 
                        }, 5000);
                    }
                    
                };

                $(window).on('load', function(){
                    app.initCollapse();
                    app.filter($('#orderby, #status, #stall, #contract'));
                    app.initSearch($('#search'));
                    app.initPalengkeFilter($('#marketOption'));
                    app.initNotifStallAppointment();
                    app.initNotifStallApproval();
                    app.initNotifProduct();
                    // app.initNotifications();
                    $('.hamburger').click(function(){
                        if($('.sidebar').hasClass('close')){
                            $('.sidebar').removeClass('close');
                            $('.admin .wrapper .section').removeClass('open');
                        }else{
                            $('.sidebar').addClass('close');
                            $('.admin .wrapper .section').addClass('open');
                        }
                    });
                });


            </script>
            <footer></footer>
        </div>
    </div>
    <!-- End of Page Wrapper -->
</div>
</body>
</html>
