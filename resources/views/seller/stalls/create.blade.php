@extends('layouts.seller')

@section('content')




    <div class="profile">
        <div class="profile-wrapper">
            <div class="card basic-info" style="width: 18rem;">
                <div class="card-header basic-info-header">
                    Stall Information
                </div>
                <div class="basic-info-body">

                    @if(isset($message))
                        <strong>{{ $message  }}</strong>
                    @endif

                        <div class="basic-info-body">
                            <div class="info-body-flex">
                                <div class="info-item short">
                                    <h3>Stall No: {{ $stall->number }}</h3>
                                </div>

                                <div class="info-item short">
                                    <h3>Status: {{ $stall->status }}</h3>
                                </div>
                            </div>

                            <div class="stall">
                                <div class="stall-info">
                                    <div class="stall-gallery-container">
                                        <div id="slide-for">
                                            <div>
                                                <div class="stall-main-img">
                                                    <img src="{{ asset('public/Image') .'/'. $stall->image }}" alt="">
                                                </div>
                                            </div>
                                            @for($i=1; $i<=5; $i++)
                                                @php $imagekey = 'image_'.$i; @endphp
                                                @if($stall[$imagekey])
                                                    <div>
                                                        <div class="stall-img">
                                                            <img src="{{ asset('public/Image') .'/'. $stall[$imagekey] }}" alt="">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endfor
                                        </div>
                                        <div id="slide-nav" class="stall-gallery">
                                            <div>
                                                <div class="stall-img">
                                                    <img src="{{ asset('public/Image') .'/'. $stall->image }}" alt="">
                                                </div>
                                            </div>
                                            @for($i=1; $i<=5; $i++)

                                                @php $imagekey = 'image_'.$i; @endphp
                                                @if($stall[$imagekey])
                                                    <div>
                                                        <div class="stall-img">
                                                            <img src="{{ asset('public/Image') .'/'. $stall[$imagekey] }}" alt="">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="stall-info-container">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td><p><strong>Section:</strong></p> </td>
                                                <td> <p>{{ $stall->section }}</p></td>
                                            </tr>
                                            <tr>
                                                <td class="stall-info-title-container"><p><strong>Area: </strong></p></td>
                                                <td> <p>{{ $stall->sqm }} sqm</p></td>
                                            </tr>
                                            <tr>
                                                <td class="stall-info-title-container"><p><strong>Amount / Sqm: </strong> </p> </td>
                                                <td> <p>Php {{ $stall->amount_sqm }}</p></td>
                                            </tr>
                                            <tr>
                                                <td class="stall-info-title-container"><p><strong>Rental Fee: </strong></p> </td>
                                                <td> <p>{{ $stall->rental_fee }}</p></td>
                                            </tr>
                                            <tr>
                                                <td class="stall-info-title-container"><p><strong>Location: </strong></p> </td>
                                                <td> <p>{{ $stall->market }}</p></td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>

                            </div>


                        </div>

                        @if(isset($message))
                            {{ $message }}
                        @endif
                        <form action="{{ route('seller.stalls.store') }}" method="POST" class="form-">
                        @csrf
                            
                        <div class="info-body-flex justify-content-center">

                                <div class="form-group medium">
                                    <label for="start_date">Appointment Date </label>
                                    <input type="date"
                                           class="form-control @error('appointment_date') is-invalid @enderror"
                                           id="appointment_date"
                                           name="appointment_date"
                                           placeholder="Appointment Date"
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                           value="" >
                                    <input type="hidden" name="stall_id" value="{{ $stall->id }}">

                                    @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Apply') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
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
            initDuration: function( trigger ){
                trigger.change(function () {
                    let date_1 = new Date($('#start_date').val());
                    let date_2 = new Date($('#end_date').val());

                    let difference = date_1.getTime() - date_2.getTime();
                    console.log(difference);
                });
            },
            initPreviewSlick: function () {
                $('#slide-for').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: false,
                    fade: true,
                    asNavFor: '#slide-nav'
                });

                $('#slide-nav').slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    asNavFor: '#slide-for',
                    dots: false ,
                    centerMode: true,
                    focusOnSelect: true
                });
            },

            initDisableWeekends: function(){
                const picker = document.getElementById('appointment_date');
                    picker.addEventListener('input', function(e){
                        var day = new Date(this.value).getUTCDay();
                        if([6,0].includes(day)){
                            e.preventDefault();
                            this.value = '';
                            alert('Weekends not allowed');
                        }
                    });
            },
            

        };

        $(window).on('load', function(){
            products.init();
            
            products.initPreviewSlick();

            products.initDisableWeekends();

            products.initDuration($('input[type="date"]'));
        });

    </script>



@endsection
