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

                    @if(($errors->any()))
                        <div class="alert alert-danger alert-dismissible" role="alert" id="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Reminder!</strong>
                            <ul>
                            @foreach($errors->all() as $error)

                            <li>{{$error}}</li>
                            @endforeach
                            </ul>
                        </div>
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
                                                <td> <p>Php {{ $stall->amount_sqm }}</p></td>
                                            </tr>

                                            @if($stall->market_id == 3)
                                                <td class="stall-info-title-container"><p><strong>Annual Fee: </strong></p> </td>
                                                <td> <p>{{ $stall->annual_fee }}</p></td>   
                                            @else
                                                <td class="stall-info-title-container"><p><strong>Rental Fee: </strong></p> </td>
                                                <td> <p>{{ $stall->rental_fee }}</p></td>
                                            @endif
                                            
                                            <tr>
                                                <td class="stall-info-title-container"><p><strong>Coordinates: </strong></p> </td>
                                                <td> <p>{{ $stall->coords }}</p></td>
                                            </tr>
                                            <tr>
                                                <td class="stall-info-title-container"><p><strong>Meter Number: </strong></p> </td>
                                                <td> <p>{{ $stall->meter_num }}</p></td>
                                            </tr>
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
                        <form action="{{ route('seller.stalls.store') }}" method="POST" class="form-" enctype="multipart/form-data">
                        @csrf
                            
                        <div class="info-body-flex justify-content-center">

                                <div class="form-group medium">
                                    <label for="start_date">Appointment Date</label>
                                    <input type="date"
                                           class="form-control @error('appointment_date') is-invalid @enderror"
                                           id="appointment_date"
                                           name="appointment_date"
                                           placeholder="Appointment Date"
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                           value="{{ old('appointment_date') }}" >
                                    <input type="hidden" name="stall_id" value="{{ $stall->id }}">

                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group medium">
                                    <h3 style="text-align: center;">Upload the following: </h3>
                                    <label for="application_letter">Application Letter Under Oath</label>
                                    <input type="file"
                                           enc
                                           class="form-control @error('application_letter') is-invalid @enderror"
                                           id="application_letter"
                                           name="application_letter"
                                           placeholder=""
                                           value="" >

                                    @error('application_letter')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- <div class="form-group medium">
                                    <label for="residency">Bonifide Resident of Mabini, Batangas</label>
                                    <input type="file"
                                           class="form-control @error('residency') is-invalid @enderror"
                                           id="residency"
                                           name="residency"
                                           placeholder=""
                                           value="" >

                                    @error('residency')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div> -->

                                <div class="form-group medium">
                                    <label for="image">2 X 2 picture</label>
                                    <input type="file"
                                           class="form-control @error('image') is-invalid @enderror"
                                           id="image"
                                           name="image"
                                           placeholder=""
                                           value="" >

                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group medium">
                                    <label for="id">2 Valid IDs</label>
                                    <input type="file"
                                           class="form-control @error('id1') is-invalid @enderror"
                                           id="id1"
                                           name="id1"
                                           placeholder=""
                                           value="" >
                                    
                                    @error('id1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group medium">
                                    <input type="file"
                                           class="form-control @error('id2') is-invalid @enderror"
                                           id="id2"
                                           name="id2"
                                           placeholder=""
                                           value="" >

                                    @error('id2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                        </div>
                        <div class="row-btn">
                            <div class="btn-container" style="padding: 0 10px 15px;">
                                <button type="submit" class="btn btn-primary" style="font-size: 11px; padding: 8px;">
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
