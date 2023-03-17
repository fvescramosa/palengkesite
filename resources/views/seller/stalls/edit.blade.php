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


                    </div>

                    <form action="{{ route('seller.stalls.update', ['id' =>  $seller_stall->id]) }}" method="POST" class="form-" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group" style="display: flex; flex-flow:  row wrap">
                            <div class="info-item">
                                <label for="">Stall</label>
                                <select name="number" id="number" class="form-control @error('number') is-invalid @enderror" readonly="">
                                    <option value="{{ $seller_stall->stall->id }}" selected> Stall No. {{ $seller_stall->stall->number }}</option>
                                </select>

                                @error('number')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <div class="info-item">
                                <label for="">Stall Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $seller_stall->name }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="info-item">
                                <label for="">Rental Fee per Month</label>
                                <input type="text" class="form-control @error('rental_fee') is-invalid @enderror" name="rental_fee" id="rental_fee" readonly>

                                @error('rental_fee')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <div class="info-item short">
                                <label for="">Start Date</label>


                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" id="start_date" value="{{ $seller_stall->start_date->format('Y-m-d') }}">

                                @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="info-item short">
                                <label for="">End Date</label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" id="end_date" value="{{ $seller_stall->end_date->format('Y-m-d') }}">

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


                            <div class="info-item" id="image-container">
                                <label for="">Image</label>
                                <input type="file" name="image[]" id="stall-mage" class="form-control form-control-file" >


                            </div>
                           {{-- <div class="info-item" id="">
                                <div class="form-group short">
                                    <button type="button" id="addImage" class="btn option-btn"><span class="fa fa-plus-circle"> </span> Add Image</button>
                                </div>
                            </div>--}}



                            <button type="submit"  class="btn btn-primary">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const products = {
            init: function(  ){
                products.initStallDetails($('#stall'));
                products.initDuration( $('input[type="date"]'));

            },
            initStallDetails: function( trigger ){
                trigger.change(function () {
                    var options = '';

                    $.ajax({
                        type:'POST',
                        dataType: 'JSON',
                        url:'{{ route('seller.display.details') }}',
                        data: {
                            id: this.value,
                            _token: "{{ csrf_token() }}"
                        },
                        success:function(data) {

                            $('#rental_fee').val(data.rental_fee);

                        }
                    });
                })
            },

            initStallDetailsOnLoad: function(  ){

                    var options = '';

                    $.ajax({
                        type:'POST',
                        dataType: 'JSON',
                        url:'{{ route('seller.display.details') }}',
                        data: {
                            id: $('#number').val(),
                            _token: "{{ csrf_token() }}"
                        },
                        success:function(data) {

                            $('#rental_fee').val(data.rental_fee);

                        }
                    });

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
            initDurationOnLoad: function(  ){


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
                    slidesToShow: 3,
                    slidesToScroll: 1,
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

            addImage: function (trigger) {
                trigger.click(function () {

                    var self = $('#stall-image');
                    var clonedItem = self.clone();

                    /*clonedItem.find('button').attr('data-action', 'removeVideoURL');
                    clonedItem.find('button').find('.plus-icon').removeClass('plus-icon');
                    clonedItem.find('button').find('div').addClass('fa fa-trash');*/
                    clonedItem.appendTo('#image-container');
                    // $('button[data-action="removeVideo"]').prop('disabled', false);



                })
            },
        };

        $(document).ready(function(){
            products.initDurationOnLoad();
            products.initStallDetailsOnLoad();
            products.addImage($('#addImage'));

        });
        $(window).on('load', function(){
            products.init();
            products.initPreviewSlick();


        });

    </script>



@endsection
