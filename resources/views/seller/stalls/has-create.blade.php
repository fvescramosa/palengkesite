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
                                                    <img src="{{ asset($stall->image) }}" alt="">
                                                </div>
                                            </div>
                                            @for($i=1; $i<=5; $i++)
                                                @php $imagekey = 'image_'.$i; @endphp
                                                @if($stall[$imagekey])
                                                    <div>
                                                        <div class="stall-img">
                                                            <img src="{{ asset($stall[$imagekey]) }}" alt="">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endfor
                                        </div>
                                        <div id="slide-nav" class="stall-gallery">
                                            <div>
                                                <div class="stall-img">
                                                    <img src="{{ asset($stall->image) }}" alt="">
                                                </div>
                                            </div>
                                            @for($i=1; $i<=5; $i++)

                                                @php $imagekey = 'image_'.$i; @endphp
                                                @if($stall[$imagekey])
                                                    <div>
                                                        <div class="stall-img">
                                                            <img src="{{ asset($stall[$imagekey]) }}" alt="">
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
                                                <td> <p>₱{{ $stall->amount_sqm }}</p></td>
                                            </tr>
                                            <tr>
                                                <td class="stall-info-title-container"><p><strong>Coordinates: </strong> </p> </td>
                                                <td> <p>{{ $stall->coords }}</p></td>
                                            </tr>
                                            <tr>
                                                <td class="stall-info-title-container"><p><strong>Meter Number: </strong> </p> </td>
                                                <td> <p>{{ $stall->meter_num }}</p></td>
                                            </tr>
                                            @if($stall->market_id == 3)
                                                <td class="stall-info-title-container"><p><strong>Annual Fee: </strong></p> </td>
                                                <td> <p>{{ $stall->annual_fee }}</p></td>   
                                            @else
                                                <td class="stall-info-title-container"><p><strong>Rental Fee: </strong></p> </td>
                                                <td> <p>{{ $stall->rental_fee }}</p></td>
                                            @endif
                                            <tr>
                                                <td class="stall-info-title-container"><p><strong>Location: </strong></p> </td>
                                                <td> <p>{{ $stall->market->market }}</p></td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>

                            </div>


                        </div>

                        @if(isset($message))
                            {{ $message }}
                        @endif
                        <form action="{{ route('seller.stalls.store.details') }}" method="POST" class="form-" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group" style="display: flex; flex-flow:  row wrap">
                               <input type="hidden" name="stall" value="{{ $stall->id }}">

                               <div class="info-item">
                                    <label for="">Stall Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="" >

                                    @error('duration')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="info-item">
                                    <label for="">Rental Fee per Day</label>
                                    <input type="text" class="form-control @error('rental_fee') is-invalid @enderror" name="rental_fee" id="rental_fee" value="{{ $stall->rental_fee }}" readonly>

                                    @error('duration')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="info-item short">
                                    <label for="">Start Date</label>
                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" id="start_date">

                                     @error('start_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="info-item short">
                                    <label for="">End Date</label>
                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" id="end_date">

                                     @error('end_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="info-item">
                                    <label for="">Duration (Months)</label>
                                    <input type="text" class="form-control @error('duration') is-invalid @enderror" name="duration" id="duration" readonly>

                                     @error('duration')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="info-item">
                                    <label for="">Contract Lease</label>
                                    <input type="file" class="form-control @error('contract_of_lease') is-invalid @enderror" name="contract_of_lease" id="contract_of_lease">

                                     @error('contract_of_lease')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="row-btn" style="width: 100%;">
                                    <div class="btn-container" style="padding: 0 10px 15px;">
                                        <button type="submit" class="btn btn-primary" style="font-size: 11px; padding: 8px;">
                                            Button
                                        </button>
                                    </div>
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
                    let date_1 = new Date($('#end_date').val());
                    let date_2 = new Date($('#start_date').val());

                    // let difference = date_1.getTime() - date_2.getTime();
                    // let TotalDays = Math.ceil(difference / (1000 * 3600 * 24));
                    // $('#duration').val(TotalDays);

                    
                        var months;
                        var result;
                        months = (date_1.getFullYear() - date_2.getFullYear()) * 12;
                        months -= date_2.getMonth();
                        months += date_1.getMonth();

                        result = months <= 0  ? 0 : months;
                        $('#duration').val(result);

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

            products.initDuration($('input[type="date"]'));
        });

    </script>



@endsection
