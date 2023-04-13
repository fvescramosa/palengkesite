@extends('layouts.admin')

@section('content')

<div class="profile">
        <div class="profile-wrapper">
            <div class="card basic-info" style="width: 18rem;">
                <div class="card-header basic-info-header">
                    Stall Information
                </div>
                <div class="basic-info-body">

                    @if(isset($message))
                        <div class="alert alert-{{ ($success) ? 'success' : 'danger' }}"><strong>{{ $message  }}</strong></div>
                    @endif
                    <form action="{{ route('admin.stalls.update', [$stalls->id]) }}" method="POST" class="form-" enctype="multipart/form-data">
                        @csrf
                        <div class="info-body-flex">

                            <div class="form-group long">
                                <label for="Number">Stall No.</label>
                                <input type="text"  class="form-control @error('number') is-invalid @enderror"
                                       id="number"
                                       name ="number"
                                       placeholder="" value="{{ $stalls->number }}" >

                                </select>
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
                                       placeholder="" value="{{ $stalls->sqm }}" >

                                </select>
                                @error('sqm')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group long">
                                <label for="Amount_Sqm">Amount/Sqm or Rate</label>
                                <input type="text"  class="form-control @error('amount_sqm') is-invalid @enderror"
                                       id="amount_sqm"
                                       name="amount_sqm"
                                       placeholder="" value="{{ $stalls->amount_sqm }}" >

                                </select>
                                @error('amount_sqm')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group long">
                                <label for="Section">Section</label>
                                <select   class="form-control @error('section') is-invalid @enderror" id="market"
                                         name="section">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->category }}" {{ ($stalls->section == $category->category) ? 'selected' : '' }}>
                                            {{ $category->category }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('section')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            
                            <div class="form-group long">
                                <label for="Coordinates">Coordinates</label>
                                <input type="text"  class="form-control @error('coords') is-invalid @enderror"
                                       id="coords"
                                       name="coords"
                                       placeholder="" value="{{ $stalls->coords }}" >
                                
                                </select>
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
                                       placeholder="" value="{{ $stalls->meter_num }}" >
                            
                                </select>
                                @error('meter_num')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            </div>
                            
                            <div class="form-group long">
                                <label for="Market">Market</label>
                                <select   class="form-control @error('market') is-invalid @enderror" id="market"
                                         name="market">
                                    @foreach($markets as $market)
                                        <option value="{{ $market->id }}" {{ ($stalls->market->id == $market->id) ? 'selected' : '' }}>
                                            {{ $market->market }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('market')
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
                                       placeholder="" value="{{ $stalls->rental_fee }}" >

                                </select>
                                @error('rental_fee')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group long">
                                <label for="annual_fee">Annual Fee</label>
                                <input type="text"  class="form-control @error('annual_fee') is-invalid @enderror"
                                       id="annual_fee"
                                       name="annual_fee"
                                       placeholder="" value="{{ $stalls->annual_fee }}" >

                                </select>
                                @error('annual_fee')
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
                                       placeholder="" value="{{ $stalls->image }}" >

                                    <img src="{{ asset($stalls->image)  }}" alt="" id="imagePreview" style="margin-top: 25px; width: 320px; height: 320px; object-fit: cover">
                                    @error('photo')
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
                                       placeholder="" value="{{ $stalls->image_1 }}" >

                                <img src="{{ asset($stalls->image_1)  }}" alt="" id="imagePreview" style="margin-top: 25px; width: 320px; height: 320px; object-fit: cover">
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
                                       placeholder="" value="{{ $stalls->image_2 }}" >
                                
                                <img src="{{ asset($stalls->image_2)  }}" alt="" id="imagePreview" style="margin-top: 25px; width: 320px; height: 320px; object-fit: cover">
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
                                       placeholder="" value="{{ $stalls->image_3 }}" >

                                <img src="{{ asset($stalls->image_3)  }}" alt="" id="imagePreview" style="margin-top: 25px; width: 320px; height: 320px; object-fit: cover">
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
                                       placeholder="" value="{{ $stalls->image_4 }}" >

                                <img src="{{ asset($stalls->image_4)  }}" alt="" id="imagePreview" style="margin-top: 25px; width: 320px; height: 320px; object-fit: cover">
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
                                       placeholder="" value="{{ $stalls->image_5 }}" >

                                <img src="{{ asset($stalls->image_5)  }}" alt="" id="imagePreview" style="margin-top: 25px; width: 320px; height: 320px; object-fit: cover">
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

                            <div class="form-group long">
                                <label for="status">Status</label>
                                <input type="text"  class="form-control @error('status') is-invalid @enderror"
                                       id="status"
                                       name="status"
                                       placeholder="" value="{{ $stalls->status }}" >

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

         // Get the file input element
        const imageInput = document.querySelector('#image');

        // Listen for changes in the file input element
        imageInput.addEventListener('change', (event) => {
            // Get the selected file
            const file = event.target.files[0];

            // Create a new FileReader object
            const reader = new FileReader();

            // Listen for the FileReader to load the file
            reader.addEventListener('load', (event) => {
                // Update the image preview source with the loaded file data
                const imagePreview = document.querySelector('#imagePreview');
                imagePreview.src = event.target.result;
            });

            // Read the selected file as a data URL
            reader.readAsDataURL(file);
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
