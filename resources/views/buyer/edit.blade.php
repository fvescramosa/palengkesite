@extends('layouts.buyer')

@section('content')

<div class="profile">
        <div class="profile-wrapper">
            <div class="card basic-info" style="width: 18rem;">
                <div class="card-header basic-info-header">
                    Basic Information
                </div>
                <div class="basic-info-body">
                     @if(isset($message))
                         <strong>{{ $message  }}</strong>
                     @endif
                    <form action="{{ route('buyer.update') }}" method="POST" class="form-control" enctype="multipart/form-data">
                        @csrf
                        <div class="info-body-flex">
                            <div class="form-group info-item short">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror " id="first_name" name="first_name" placeholder="First Name" value="{{ auth()->user()->first_name }}" >
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group info-item short">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror " id="last_name" name="last_name" placeholder="Last Name" value=" {{ auth()->user()->last_name }}" >
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group info-item short">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value=" {{ auth()->user()->email }}">
                                @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>


                            @if(auth()->user()->buyer()->exists())
                            <div class="form-group info-item short">
                                <label for="birthday">Birthday</label>
                                <input type="date" class="form-control @error('birthday') is-invalid @enderror " id="birthday" name="birthday" placeholder="Birthday" value="{{ date(auth()->user()->buyer->birthday) }}" >
                                 @error('birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror

                            </div>

                            <div class="form-group info-item xshort">
                                <label for="age">Age</label>
                                <input type="number" class="form-control @error('age') is-invalid @enderror" id="age" name="age" placeholder="Age" value="{{ auth()->user()->buyer->age }}" readonly>
                                @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group info-item xshort">
                                <label for="gender">Gender</label>
                                

                                <select   class="form-control @error('gender') is-invalid @enderror" id="gender"
                                         name="gender">
                                        <option value="Male" {{ ('Male' == auth()->user()->buyer->gender) ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ ('Female' == auth()->user()->buyer->gender) ? 'selected' : '' }}>Female</option>
                                </select>

                            </div>

                            <div class="form-group info-item short">
                                <label for="contact">Contact Number</label>
                                <input type="text" class="form-control @error('contact') is-invalid @enderror" id="contact" name="contact" placeholder="Enter your contact number" value="{{ auth()->user()->buyer->contact }}">
                                @error('contact')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group info-item xshort">
                                <label for="stnumber">Street Number</label>
                                <input type="text" class="form-control @error('stnumber') is-invalid @enderror" id="stnumber" name="stnumber" placeholder="Ex: 123" value="{{ auth()->user()->buyer->stnumber }}">
                                @error('stnumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group info-item medium">
                                <label for="stname">Street Name</label>
                                <input type="text" class="form-control @error('stname') is-invalid @enderror" id="stname" name="stname" placeholder="" value="{{ auth()->user()->buyer->stname }}">
                                @error('stname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group info-item short">
                                    <label for="city">City/Municipality</label>
                                    <select class="form-control @error('city') is-invalid @enderror"
                                            id="city"
                                            name="city"
                                            data-city="{{ auth()->user()->buyer->city }}"
                                            placeholder="Example: Alitagtag">
                                            {{--<option value="{{ auth()->user()->buyer->city }}">{{ auth()->user()->buyer->city }}</option>--}}
                                    </select>
                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group info-item short">
                                    <label for="city">Barangay</label>
                                    <select class="form-control @error('barangay') is-invalid @enderror"
                                            id="barangay"
                                            name="barangay"
                                            placeholder="">
                                            <option value="">Please Select Barangay</option>
                                    </select>
                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>

                                <div class="form-group info-item short">
                                    <label for="province">Province</label>
                                    <input type="text" class="form-control @error('province') is-invalid @enderror" id="province" name="province" placeholder="Example: Batangas" value="Batangas" readonly>
                                    @error('province')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                            <div class="form-group info-item short">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" name="country"  placeholder="Example: Philippines" value="Philippines" readonly>
                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="form-group info-item short">
                                    <label for="zip">Zip Code</label>
                                    <input type="number" class="form-control @error('zip') is-invalid @enderror" id="zip" name="zip" placeholder="Example: 123" value="" readonly>
                                    @error('zip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="form-group info-item short">
                                    <label for="profile_image">Profile Image</label>
                                    <input type="file" class="form-control @error('profile_image') is-invalid @enderror" id="profile_image" name="profile_image" placeholder="Example: 123" value="" readonly>
                                    @error('profile_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                        @endif
                        </div>
                        <div class="row-btn">
                            <div class="btn-container" style="padding: 0 10px 15px;">
                                <button type="submit" class="btn btn-primary" style="font-size: 11px; padding: 8px;">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
<script>
        function getAge(dateString) {
            var today = new Date();
            var birthDate = new Date(dateString);
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        }

        $('#birthday').on('change', function () {

            var age = getAge( $(this).val());
            $('#age').val( age );
        });
        
        const support = {
            init: function () {
                support.loadCities();
                support.loadBarangays('{{ auth()->user()->buyer->city }}');
                support.previewProfileImage($('#profile_image'));
               // support.initJsonFunction();
            },


            loadCities: function () {
                $.ajax({
                    type:'GET',
                    dataType:"jsonp",
                    url:'https://tools.gabc.biz/address_finder.php?PROVINCE='+$('#province').val()+'&callback=Cities&_=1672914361845',
                    jsonpCallback:"Cities",
                    crossDomain:true,
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success:function(data) {
                        var options = '';
                        var user_city = '{{ auth()->user()->buyer->city }}';
                        var cities = data[0].CITY;


                        for(var i = 0; i < cities.length; i++){
                            options += '<option value="'+ cities[i].CITY +'"' + ( user_city == cities[i].CITY ? 'selected' : '') +'>' + cities[i].CITY + '</option>';
                        }

                       $('#city').html(options);

                        support.loadBarangays($('#city').val());
                    },
                });
            },
            loadBarangays: function (city) {

                    $.ajax({
                        type:'GET',
                        dataType:"jsonp",
                        url:'https://tools.gabc.biz/address_finder.php?PROVINCE='+$('#province').val()+'&CITY='+city+'&callback=Barangays&_=1673020893849',
                        jsonpCallback:"Barangays",
                        crossDomain:true,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success:function(data) {

                            var options = '<option value="">Please Select Barangay</option>';

                            var user_barangay = '{{ auth()->user()->buyer->barangay }}';
                            var barangays = data[0].CITY[0].BARANGAY;
                            var zipcode = barangays[0].ZIP;
                            for(var i = 0; i < barangays.length; i++){
                                options += '<option value="'+ barangays[i].BARANGAY +'"' + ( user_barangay == barangays[i].BARANGAY ? 'selected': '' ) + ' >' + barangays[i].BARANGAY + '</option>';
                            }

                            $('#barangay').html(options);
                            $('#zip').val(zipcode);
                        },
                    });


            },
            previewProfileImage: function (trigger) {
                trigger.change(function () {
                    const file = $(this).get(0).files[0];
                    const image = $('#profileImg');
                    if (file) {
                        var reader = new FileReader();

                        reader.onload = function(){
                            image.attr("src", reader.result);
                        };

                        reader.readAsDataURL(file);

                    }
                });
            }

            // get
        

        };

        $(document).ready(function () {
            $('#city').val( $('#city').attr('data-city')) ;
            support.init();
        })


    </script>

@endsection
