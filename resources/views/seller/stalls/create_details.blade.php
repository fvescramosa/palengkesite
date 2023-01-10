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

                        <form action="{{ route('seller.stalls.store.details') }}" method="POST" class="form-" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group" style="display: flex; flex-flow:  row wrap">
                                <div class="info-item">
                                    <label for="">Stall</label>
                                    <select name="stall" id="stall" class="form-control @error('stall') is-invalid @enderror">
                                        <option value="">Stall No.</option>
                                        @foreach($stalls as $stall)
                                            <option value="{{ $stall->id }}"> Stall No. {{ $stall->number }}</option>
                                        @endforeach
                                    </select>

                                     @error('stall')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="info-item">
                                    <label for="">Rental Fee per Month</label>
                                    <input type="text" class="form-control @error('rental_fee') is-invalid @enderror" name="rental_fee" id="rental_fee" readonly>

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

                                <button type="submit"  class="btn btn-primary">Button</button>
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
            }
        };

        $(window).on('load', function(){
            products.init();
            products.initPreviewSlick();


        });

    </script>



@endsection
