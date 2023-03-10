@extends('layouts.admin')

@section('content')

<div class="profile">
        <div class="profile-wrapper">
            <div class="card basic-info" style="width: 18rem;">
                <div class="card-header basic-info-header">
                    Stall Information
                </div>
                <div class="basic-info-body">

                    <form action="{{ route('admin.stalls.store') }}" method="POST" class="form-" enctype="multipart/form-data">
                        @csrf
                        <div class="info-body-flex">


                            <div class="form-group long">
                                <label for="number">Stall No.</label>
                                <input type="text"  class="form-control @error('number') is-invalid @enderror"
                                                    id="number"
                                                    name ="number"
                                                    placeholder="" value="" >

                                @error('number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <div class="form-group long">
                                <label for="Sqm">Sqm</label>
                                <input type="text"  class="form-control @error('sqm') is-invalid @enderror"
                                                    id="sqm"
                                                    name="sqm"
                                                    placeholder="" value="" >


                                @error('sqm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                            <div class="form-group long">
                                <label for="Amount_Sqm">Amount/Sqm</label>
                                <input type="text"  class="form-control @error('amount_sqm') is-invalid @enderror"
                                                    id="amount_sqm"
                                                    name="amount_sqm"
                                                    placeholder="" value="" >


                                @error('amount_sqm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                            <div class="form-group long">
                                <label for="Rental_Fee">Rental Fee</label>
                                <input type="text"  class="form-control @error('rental_fee') is-invalid @enderror"
                                                    id="rental_fee"
                                                    name="rental_fee"
                                                    placeholder="" value="" >


                                @error('rental_fee')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                            <div class="form-group long">

                            <label for="Section">Section</label>
                                <select  class="form-control @error('section') is-invalid @enderror" 
                                            id="section" 
                                            name="section" 
                                            placeholder="Section">
                                            <option value=""></option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->category }}">{{ $category->category }}</option>
                                            @endforeach
                                </select>


                                @error('section')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                            <div class="form-group long">
                                <label for="Rate">Rate</label>
                                <input type="text"  class="form-control @error('rate') is-invalid @enderror"
                                                    id="rate"
                                                    name="rate"
                                                    placeholder="" value="" >

                                @error('rate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                            <div class="form-group long">
                                <label for="Coords">Coordinates</label>
                                <input type="text"  class="form-control @error('coords') is-invalid @enderror"
                                                    id="coords"
                                                    name="coords"
                                                    placeholder="" value="" >

                                @error('coords')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                            <div class="form-group long">
                                <label for="Meter Number">Meter Number</label>
                                <input type="text"  class="form-control @error('meter_num') is-invalid @enderror"
                                                    id="meter_num"
                                                    name="meter_num"
                                                    placeholder="" value="" >

                                @error('meter_num')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                            <div class="form-group long">
                            <label for="Market">Market</label>
                                <select  class="form-control @error('market') is-invalid @enderror" 
                                            id="market" 
                                            name="market" 
                                            placeholder="Market">
                                            <option value=""></option>
                                            @foreach($markets as $market)
                                                <option value="{{ $market->id }}">{{ $market->market }}</option>
                                            @endforeach
                                </select>

                                @error('market')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                            <div class="form-group long  stall-image">
                                <label for="image">Image</label>
                                <input type="file"  class="form-control @error('image') is-invalid @enderror"
                                       id="image"
                                       name="image"
                                       placeholder="" value="" >

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div id="stall_image_1" class="form-group long  stall-image hide">
                                <label for="image">Image</label>
                                <input type="file"  class="form-control @error('image_1') is-invalid @enderror"
                                       id="image_1"
                                       name="image_1"
                                       placeholder="" value="" >

                                @error('image_1')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div id="stall_image_2" class="form-group long  stall-image hide">
                                <label for="image">Image</label>
                                <input type="file"  class="form-control @error('image_2') is-invalid @enderror"
                                       id="image_2"
                                       name="image_2"
                                       placeholder="" value="" >

                                @error('image_2')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div id="stall_image_3" class="form-group long  stall-image hide">
                                <label for="image">Image</label>
                                <input type="file"  class="form-control @error('image_3') is-invalid @enderror"
                                       id="image_3"
                                       name="image_3"
                                       placeholder="" value="" >

                                @error('image_3')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div id="stall_image_4" class="form-group long  stall-image hide">
                                <label for="image">Image</label>
                                <input type="file"  class="form-control @error('image_4') is-invalid @enderror"
                                       id="image_4"
                                       name="image_4"
                                       placeholder="" value="" >

                                @error('image_4')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div id="stall_image_5" class="form-group long  stall-image hide">
                                <label for="image">Image</label>
                                <input type="file"  class="form-control @error('image_5') is-invalid @enderror"
                                       id="image_5"
                                       name="image_5"
                                       placeholder="" value="" >

                                @error('image_5')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>



                            <div class="form-group short">
                                <button type="button" id="addImage" class="btn option-btn"><span class="fa fa-plus-circle"> </span> Add Image</button>
                            </div>

                            </select>
                            @error('status')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>


                        </div>
                        <div class="row-btn">
                            <div class="btn-container" style="padding: 0 10px 15px;">
                                <button type="submit" class="btn btn-primary" style="font-size: 11px; padding: 8px;">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    var stall = {
        init: function () {
            this.addImage($('#addImage'));
        },

        addImage: function (trigger) {
            trigger.click(function () {

                var counter  = $('.stall-image').not('.hide').length;

                console.log(counter);

                $('#stall_image_' + counter).removeClass('hide');


               /* var counter = $('.stall-image').length;

                if(counter <= 5){

                    var clone = $('.stall-image:last').clone().insertAfter('.stall-image:last');
                    clone.find('input[type="file"]').attr('name', 'image_' + parseInt(parseInt(counter - 1) + 1));
                }else{

                }*/

            })
        }
    };

    $(window).on('load', function(){
        stall.init();
    })
</script>
@endsection

