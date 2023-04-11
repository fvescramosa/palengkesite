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

                            <div class="form-group info-item short input-group mb-3 prepend">
                                <label for="email">Mobile</label>
                                    <div class="input-group-prepend info-item-prepend">
                                        <span class="input-group-text" id="basic-addon1">+63</span>
                                    </div>
                                    <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" placeholder="9123456789" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" value="{{ auth()->user()->mobile }}">
                                    @error('mobile')
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

                            <!-- <div class="form-group info-item short">
                                <label for="contact">Contact Number</label>
                                <input type="text" class="form-control @error('contact') is-invalid @enderror" id="contact" name="contact" placeholder="Enter your contact number" value="{{ auth()->user()->buyer->contact }}">
                                @error('contact')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div> -->

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
                                    <input type="number" class="form-control @error('zip') is-invalid @enderror" id="zip" name="zip" placeholder="Example: 123" value="{{ auth()->user()->buyer->zip }}" readonly>
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
                                <div class="form-group info-item hidden">
                                    <input type="hidden" class="form-control " id="longitude" name="longitude" placeholder="Example: 123" value="{{ auth()->user()->buyer->longitude }}" readonly>
                                    <input type="hidden" class="form-control " id="latitude" name="latitude" placeholder="Example: 123" value="{{ auth()->user()->buyer->latitude }}" readonly>
                                </div>
                        @endif
                        </div>
                        <div class="info-item long">
                            <div id="map" style="width: 100%; height: 480px"></div>

                            {{--<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async></script>--}}
                            <script
                                    src="https://maps.googleapis.com/maps/api/js?key={{ config('apikeys.keys') }}&callback=initMap&v=weekly"
                                    defer
                            ></script>
                            <script>
                                let map, activeInfoWindow, markers = [];
                                let marker;
                                let defaultPosition = {
                                        lat: {{ ( auth()->user()->buyer->latitude  ? auth()->user()->buyer->latitude : '13.749684') }},
                                        lng: {{ ( auth()->user()->buyer->latitude  ? auth()->user()->buyer->longitude : '120.9395233') }},
                                    };
                                    /* ----------------------------- Initialize Map ----------------------------- */
                                function initMap() {
                                    map = new google.maps.Map(document.getElementById("map"), {
                                        center: {
                                            lat: {{ ( auth()->user()->buyer->latitude  ? auth()->user()->buyer->latitude : '13.749684') }},
                                            lng: {{ ( auth()->user()->buyer->latitude  ? auth()->user()->buyer->longitude : '120.9395233') }},
                                        },
                                        zoom: 15
                                    });

                                    marker =  new google.maps.Marker({
                                        position: defaultPosition,
                                        label:'{{ auth()->user()->first_name }}',
                                        map: map,
                                    });


                                    map.addListener("click", function(event) {

                                        addMarker(event.latLng, map)
                                    });

                                }


                                /* --------------------------- Initialize Markers --------------------------- */
                                function addMarker(location, map) {
                                    // Add the marker at the clicked location, and add the next-available label
                                    // from the array of alphabetical characters.




                                    if ( marker ) {
                                        marker.setPosition(location);
                                    } else {
                                        marker =  new google.maps.Marker({
                                            position: location,
                                            label: 'A',
                                            map: map,
                                        });
                                    }

                                    markerClicked(marker)
                                }
                                /* ------------------------- Handle Map Click Event ------------------------- */
                                function mapClicked(event) {
                                    console.log(map);
                                    console.log(event.latLng.lat(), event.latLng.lng());
                                }

                                /* ------------------------ Handle Marker Click Event ----------------------- */
                                function markerClicked(marker, index) {
                                    console.log(map);
                                    console.log(marker);
                                    console.log(marker.position.lat());
                                    console.log(marker.position.lng());


                                    $('#longitude').val(marker.position.lng());
                                    $('#latitude').val(marker.position.lat());
                                    $.ajax({
                                        type:'GET',
                                        dataType:"json",
                                        url:'https://maps.googleapis.com/maps/api/geocode/json?latlng='+marker.position.lat()+','+marker.position.lng()+'&sensor=true&key={{ config('apikeys.keys') }}',
                                        crossDomain:true,
                                        data: {
                                            _token: "{{ csrf_token() }}"
                                        },
                                        success:function(data) {


                                           $('#city').val(data.results[1].address_components[2].long_name);
                                            support.loadBarangays($('#city').val());

                                            $('#barangay').val(data.results[6].address_components[0].long_name);
                                            console.log(data.results);
                                        },
                                    });
                                }

                                /* ----------------------- Handle Marker DragEnd Event ---------------------- */
                                function markerDragEnd(event, index) {
                                    console.log(map);
                                    console.log(event.latLng.lat());
                                    console.log(event.latLng.lng());
                                }
                            </script>

                            <!--
                              The `defer` attribute causes the callback to execute after the full HTML
                              document has been parsed. For non-blocking uses, avoiding race conditions,
                              and consistent behavior across browsers, consider loading using Promises
                              with https://www.npmjs.com/package/@googlemaps/js-api-loader.
                              -->


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
                support.loadMaps();
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
            },

            loadMaps: function () {



            }

            // get
        

        };

        $(document).ready(function () {
            $('#city').val( $('#city').attr('data-city')) ;
            support.init();


            $('#city').change(function () {
                support.loadBarangays($('#city').val())
            })
        })



    </script>

@endsection
