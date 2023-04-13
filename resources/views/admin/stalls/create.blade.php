@extends('layouts.admin')

@section('content')

<div class="profile">
        <div class="profile-wrapper">
            <div class="card basic-info" style="width: 18rem;">
                <div class="card-header basic-info-header">
                    Stall Information
                </div>
                <div class="basic-info-body">
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

                    <form action="{{ route('admin.stalls.store') }}" method="POST" class="form-" enctype="multipart/form-data">
                        @csrf
                        <div class="info-body-flex">

                            <div class="form-group long">
                                <label for="stall_number">Stall No.</label>
                                <input type="text"  class="form-control @error('stall_number') is-invalid @enderror"
                                                    id="stall_number"
                                                    name ="stall_number"
                                                    placeholder="" value="{{ old('stall_number') }}" >

                            </div>
                            <div class="form-group long">
                                <label for="Sqm">Area in sqm</label>
                                <input type="text"  class="form-control @error('sqm') is-invalid @enderror"
                                                    id="sqm"
                                                    name="sqm"
                                                    placeholder="" value="{{ old('sqm') }}" >



                            </div>

                            <div class="form-group long">
                                <label for="Amount_Sqm">Amount Per Sqm / Rate</label>
                                <input type="text"  class="form-control @error('amount_sqm') is-invalid @enderror"
                                                    id="amount_sqm"
                                                    name="amount_sqm"
                                                    placeholder="" value="{{ old('amount_sqm') }}" >


                            </div>

                            <div class="form-group long">

                            <label for="Section">Section</label>
                                <select  class="form-control @error('section') is-invalid @enderror" 
                                            id="section" 
                                            name="section" 
                                            placeholder="Section">
                                            <option value=""></option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->category }}" {{ ( old('section') == $category->category)   ? 'selected' : '' }}>{{ $category->category }}</option>
                                            @endforeach
                                </select>



                            </div>

                            <div class="form-group long">
                                <label for="coordinates">Coordinates</label>
                                <input type="text"  class="form-control @error('coordinates') is-invalid @enderror"
                                                    id="coordinates"
                                                    name="coordinates"
                                                    placeholder="" value="{{ old('coordinates') }}" >

                            </div>

                            <div class="form-group long">
                                <label for="Meter Number">Meter Number (If no meter number, type N/A)</label>
                                <input type="text"  class="form-control @error('meter_number') is-invalid @enderror"
                                                    id="meter_number"
                                                    name="meter_number"
                                                    placeholder="" value="{{ old('meter_number') }}" >

                            </div>

                            <div class="form-group long">
                            <label for="Market">Market</label>
                                <select  class="form-control @error('market') is-invalid @enderror" 
                                            id="market" 
                                            name="market" 
                                            placeholder="Market">
                                            <option value=""></option>
                                            @foreach($markets as $market)
                                                <option value="{{ $market->id }}" {{ ( old('market') == $market->id ) ? 'selected' : '' }}>{{ $market->market }}</option>
                                            @endforeach
                                </select>
                            </div>

                            <div class="form-group long" id="rentalFeeGroup" style="display: none">
                                <label for="Rental_Fee">Rental Fee</label>
                                <input type="text" class="form-control @error('rental_fee') is-invalid @enderror"
                                    id="rental_fee"
                                    name="rental_fee"
                                    placeholder="" value="{{ old('rental_fee') }}">
                            </div>

                            <div class="form-group long" id="annualFeeGroup" style="display: none">
                                <label for="annual_fee">Annual Fee</label>
                                <input type="text" class="form-control @error('annual_fee') is-invalid @enderror"
                                    id="annual_fee"
                                    name="annual_fee"
                                    placeholder="" value="{{ old('annual_fee') }}">
                            </div>

                            <div class="form-group long  stall-image">
                                <label for="image">Image</label>
                                <input type="file"  class="form-control @error('image') is-invalid @enderror"
                                       id="image"
                                       name="image"
                                       placeholder="" value="" >

                            </div>

                            <div id="stall_image_1" class="form-group long  stall-image hide">
                                <label for="image">Image</label>
                                <input type="file"  class="form-control @error('image_1') is-invalid @enderror"
                                       id="image_1"
                                       name="image_1"
                                       placeholder="" value="" >

                            </div>

                            <div id="stall_image_2" class="form-group long  stall-image hide">
                                <label for="image">Image</label>
                                <input type="file"  class="form-control @error('image_2') is-invalid @enderror"
                                       id="image_2"
                                       name="image_2"
                                       placeholder="" value="" >

                            </div>

                            <div id="stall_image_3" class="form-group long  stall-image hide">
                                <label for="image">Image</label>
                                <input type="file"  class="form-control @error('image_3') is-invalid @enderror"
                                       id="image_3"
                                       name="image_3"
                                       placeholder="" value="" >

        

                            </div>

                            <div id="stall_image_4" class="form-group long  stall-image hide">
                                <label for="image">Image</label>
                                <input type="file"  class="form-control @error('image_4') is-invalid @enderror"
                                       id="image_4"
                                       name="image_4"
                                       placeholder="" value="" >

        

                            </div>

                            <div id="stall_image_5" class="form-group long  stall-image hide">
                                <label for="image">Image</label>
                                <input type="file"  class="form-control @error('image_5') is-invalid @enderror"
                                       id="image_5"
                                       name="image_5"
                                       placeholder="" value="">

                            </div>



                            <div class="form-group short">
                                <button type="button" id="addImage" class="btn option-btn"><span class="fa fa-plus-circle"> </span> Add Image</button>
                            </div>

                            </select>

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
    const marketSelect = document.querySelector('#market');
    const rentalFeeGroup = document.querySelector('#rentalFeeGroup');
    const rentalFeeInput = document.querySelector('#rental_fee');
    const annualFeeGroup = document.querySelector('#annualFeeGroup');
    const annualFeeInput = document.querySelector('#annual_fee');

    marketSelect.addEventListener('change', () => {
        const selectedMarketId = marketSelect.value;

        if (selectedMarketId === '3') {
        rentalFeeInput.value = 'N/A';
        // rentalFeeInput.disabled = true;

        annualFeeInput.value = '';
        annualFeeInput.disabled = false;

        rentalFeeGroup.style.display = 'none';
        annualFeeGroup.style.display = 'block';
        } else {
        rentalFeeInput.value = '';
        rentalFeeInput.disabled = false;

        annualFeeInput.value = 'N/A';
        // annualFeeInput.disabled = true;

        rentalFeeGroup.style.display = 'block';
        annualFeeGroup.style.display = 'none';
        }
    });
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

