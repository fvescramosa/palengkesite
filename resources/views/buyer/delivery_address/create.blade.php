@extends('layouts.buyer')

@section('content')


    {{$message ?? ''}}

    <div class="profile">
        <div class="profile-wrapper">
            <div class="card basic-info" style="width: 18rem;">
                <div class="card-header basic-info-header">
                    Buyer Information
                </div>
                <div class="basic-info-body">
                    @if(isset($message))
                        <strong>{{ $message  }}</strong>
                    @endif
                    <form action="{{ route('buyer.delivery.address.store', ['type' => 'main']) }}" method="POST" class="form-">
                        @csrf
                        <div class="info-body-flex">

                            {{--@if(!auth()->user()->buyer()->exists())--}}


                                <div class="info-item short">
                                    <label for="stnumber">Street Number</label>
                                    <input type="text" class="form-control @error('stnumber') is-invalid @enderror" id="stnumber" name="stnumber" placeholder="Example: 123" value="">
                                    @error('stnumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="info-item short">
                                    <label for="stname">Sreet Name</label>
                                    <input type="text" class="form-control @error('stname') is-invalid @enderror" id="stname" name="stname" placeholder="Example: Dalipit East" value="">
                                    @error('stname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="info-item short">
                                    <label for="city">City/Municipality</label>
                                    <select class="form-control @error('city') is-invalid @enderror"
                                            id="city"
                                            name="city"
                                            placeholder="Example: Alitagtag">
                                        <option value="">Please select City</option>
                                    </select>
                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="info-item short">
                                    <label for="city">Barangay</label>
                                    <select class="form-control @error('barangay') is-invalid @enderror"
                                            id="barangay"
                                            name="barangay"
                                            placeholder="Example: Alitagtag">
                                        <option value="">Please select Barangay</option>
                                    </select>
                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>

                                <div class="info-item short">
                                    <label for="province">Province</label>
                                    <input type="text" class="form-control @error('province') is-invalid @enderror" id="province" name="province" placeholder="Example: Batangas" value="Batangas" readonly>
                                    @error('province')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="info-item short">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" name="country" placeholder="Example: Philippines" value="">
                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="info-item short">
                                    <label for="zip">Zip Code</label>
                                    <input type="number" class="form-control @error('zip') is-invalid @enderror" id="zip" name="zip" placeholder="Example: 123" value="" readonly>
                                    @error('zip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                            <div class="form-group info-item hidden">
                                <input type="hidden" class="form-control " id="longitude" name="longitude" placeholder="Example: 123" value="{{ old('longitude') }}" readonly>
                                <input type="hidden" class="form-control " id="latitude" name="latitude" placeholder="Example: 123" value="{{  old('latitude') }}" readonly>
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
                                        lat: {{ old('latitude') ?? 13.749684 }},
                                        lng: {{ old('longitude') ?? 120.9395233 }}
                                    };
                                    /* ----------------------------- Initialize Map ----------------------------- */
                                    function initMap() {
                                        map = new google.maps.Map(document.getElementById("map"), {
                                            center: defaultPosition,
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
                                                support.loadBarangaysByCity($('#city').val());

                                                setTimeout(
                                                    function () {
                                                        $('#barangay').val(data.results[5].address_components[0].long_name);
                                                    }, 100
                                                )

                                                console.log(data.results);
                                                console.log(data.results[5].address_components[0].long_name);
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

                            {{--@endif--}}
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
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
                support.loadBarangays($('#city'));
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
                        var options = '<option value="">Please select City</option>';
                       var cities = data[0].CITY;


                       for(var i = 0; i < cities.length; i++){
                           options += '<option value="'+ cities[i].CITY +'">' + cities[i].CITY + '</option>';
                       }

                       $('#city').html(options);

                    },
                });
            },
            loadBarangays: function (trigger) {
                trigger.change(function (e) {
                    $.ajax({
                        type:'GET',
                        dataType:"jsonp",
                        url:'https://tools.gabc.biz/address_finder.php?PROVINCE='+$('#province').val()+'&CITY='+trigger.val()+'&callback=Barangays&_=1673020893849',
                        jsonpCallback:"Barangays",
                        crossDomain:true,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success:function(data) {

                            var options = '<option value="">Please select Barangay</option>';

                            var barangays = data[0].CITY[0].BARANGAY;
                            var zipcode = barangays[0].ZIP;
                            for(var i = 0; i < barangays.length; i++){
                                options += '<option value="'+ barangays[i].BARANGAY +'">' + barangays[i].BARANGAY + '</option>';
                            }

                            $('#barangay').html(options);
                            $('#zip').val(zipcode);
                        },
                    });
                });

            },
            loadBarangaysByCity: function (city) {

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

                        var user_barangay = '';
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

        };

        $(document).ready(function () {
            support.init();
        })
    </script>

 
@endsection
