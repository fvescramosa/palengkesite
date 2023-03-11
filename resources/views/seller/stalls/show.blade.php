@extends('layouts.seller')

@section('content')




    <div class="profile">
        <div class="profile-wrapper">

                <div class="basic-info-body">

                    @if(session('message'))
                        <H3 class="alert alert-success">{{ session('message')  }}</H3>
                    @endif


                    <div class="basic-info-body">


                        <div class="stall">
                            <div class="stall-info">
                                <div class="stall-gallery-container">
                                    <div id="slide-for">
                                        <div>
                                            <div class="stall-main-img">
                                                <img src="{{ asset('public/Image/' . $seller_stall->stall->image) }}" alt="">
                                            </div>
                                        </div>
                                        @for($i=1; $i<=5; $i++)
                                            @php $imagekey = 'image_'.$i; @endphp
                                            @if($seller_stall->stall[$imagekey])
                                                <div>
                                                    <div class="stall-img">
                                                        <img src="{{ asset('public/Image') .'/'. $seller_stall->stall[$imagekey] }}" alt="">
                                                    </div>
                                                </div>
                                            @endif
                                        @endfor
                                    </div>
                                    <div id="slide-nav" class="">
                                        <div>
                                            <div class="stall-img">
                                                <img src="{{ asset('public/Image/' . $seller_stall->stall->image) }}" alt="">
                                            </div>
                                        </div>
                                        @for($i=1; $i<=5; $i++)
                                            @php $imagekey = 'image_'.$i; @endphp
                                            @if($seller_stall->stall[$imagekey])
                                                <div>
                                                    <div class="stall-img">
                                                        <img src="{{ asset('public/Image') .'/'. $seller_stall->stall[$imagekey] }}" alt="">
                                                    </div>
                                                </div>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <div class="stall-info-container">
                                    <div class="info-body-flex">
                                        <div class="info-item short">
                                            <h3>Stall No: {{ $seller_stall->stall->number }}</h3>
                                        </div>

                                        <div class="info-item short">
                                            <h3>Status: {{ $seller_stall->stall->status }}</h3>
                                        </div>
                                    </div>
                                    @if($seller_stall->status == 'active')
                                        <table class="table table-bordered">
                                        <tr>
                                            <td><p><strong>Section:</strong></p> </td>
                                            <td> <p>{{ $seller_stall->stall->section }}</p></td>
                                        </tr>
                                        <tr>
                                            <td class="stall-info-title-container"><p><strong>Area: </strong></p></td>
                                            <td> <p>{{ $seller_stall->stall->sqm }} sqm</p></td>
                                        </tr>
                                        <tr>
                                            <td class="stall-info-title-container"><p><strong>Amount / Sqm: </strong> </p> </td>
                                            <td> <p>₱{{ $seller_stall->stall->amount_sqm }}</p></td>
                                        </tr>
                                        <tr>
                                            <td class="stall-info-title-container"><p><strong>Rate: </strong> </p> </td>
                                            <td> <p>{{ $seller_stall->stall->rate }}</p></td>
                                        </tr>
                                        <tr>
                                            <td class="stall-info-title-container"><p><strong>Coordinates: </strong> </p> </td>
                                            <td> <p>{{ $seller_stall->stall->coords }}</p></td>
                                        </tr>
                                        <tr>
                                            <td class="stall-info-title-container"><p><strong>Meter Number: </strong> </p> </td>
                                            <td> <p>{{ $seller_stall->stall->meter_num }}</p></td>
                                        </tr>
                                        <tr>
                                            <td class="stall-info-title-container"><p><strong>Rental Fee: </strong></p> </td>
                                            <td> <p>{{ $seller_stall->stall->rental_fee }}</p></td>
                                        </tr>

                                        <tr>
                                            <td class="stall-info-title-container"><p><strong>Duration: </strong></p> </td>
                                            <td> <p>{{ $seller_stall->duration }}</p></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <a href="{{ asset( $seller_stall->contact_of_lease )}}"  target="_blank" class="btn option-btn">
                                                    <span class="fa fa-eye"></span> View Contract
                                                </a>
                                            </td>
                                        </tr>
                                    </table>

                                    @elseif($seller_stall->status == 'pending')
                                        <h3 class="alert alert-warning">Waiting for Approval</h3>

                                    @elseif($seller_stall->status == 'inactive')
                                        <h3 class="alert alert-danger">Please check your contract and contact you admin for renewal.</h3>
                                    @endif


                                    @if($seller_stall->stall_appointment)
                                        <h4>Appointment Details</h4>
                                        <table class="table table-bordered">
                                            <thead>
                                                <th>Date of Appointment</th>
                                                <th>Status</th>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>{{ $seller_stall->stall_appointment->date }}</td>
                                                    <td>{{ $seller_stall->stall_appointment->status }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @endif


                                </div>
                            </div>

                        </div>


                    </div>

                    @if(  auth()->user()->seller->seller_stalls->status  == 'Pending Approval')

                        <div class="alert alert-success">
                            {{ auth()->user()->seller->seller_stalls->status }}
                        </div>

                    @else

                    @endif
                </div>

        </div>
    </div>
    <script>
        const products = {
            init: function(  ){
                products.initCategories($('#category'));
            },
            initCategories: function( trigger ){
                trigger.change(function () {
                    var options = '';
                    console.log(this.value);
                    $.ajax({
                        type:'POST',
                        dataType: 'JSON',
                        url:'{{ route('seller.products.find.category') }}',
                        data: {
                            id: this.value,
                            _token: "{{ csrf_token() }}"
                        },
                        success:function(data) {


                            for( i = 0; i < data.length; i++){

                                options += '<option value="'+ data[i].id +'">' + data[i].product_name + '</option>';

                            }

                            $('#product').html(options);
                        }
                    });
                })
            },
            initPreviewSlick: function () {
                $('#slide-for').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                    asNavFor: '#slide-nav'
                });

                $('#slide-nav').slick({
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    asNavFor: '#slide-for',
                    dots: false ,
                    arrows: true,
                    prevArrow: '<div class="nav-arrows arrow-left"><i class="fa fa-angle-left"></div>',
                    nextArrow: '<div class="nav-arrows arrow-right"><i class="fa fa-angle-right"></div>',
                    centerMode: true,
                    focusOnSelect: true
                });
            }
        };

        $(window).on('load', function(){
            products.init();
            products.initPreviewSlick();

        });

    </script>



@endsection
