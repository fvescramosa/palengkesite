@extends('layouts.buyer')
@section('content')
    <div class="profile">
       <div class="profile-wrapper">
           <div class="card basic-info" style="width: 18rem;">
               <div class="card-header basic-info-header">
                   Basic Information

                   <a href="{{ route('buyer.edit') }}" class="info-header-edit"> <i class="fa fa-edit"></i></a>
               </div>
                <div class="basic-info-body">
                    <div class="info-body-flex">
                        <div class="form-group info-item short">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name"  placeholder="First Name" value="{{ auth()->user()->first_name }}" readonly>
                        </div>
                        <div class="form-group info-item short">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name"  placeholder="Last Name" value=" {{ auth()->user()->last_name }}" readonly>
                        </div>

                        <div class="form-group info-item short">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email"  placeholder="Email" value=" {{ auth()->user()->email }}" readonly>
                        </div>


                        @if(auth()->user()->buyer()->exists())
                            <div class="form-group info-item short">
                                <label for="birthday">Birthday</label>
                                <input type="text" class="form-control" id="birthday"  placeholder="Birthday" value="{{ date('m/d/Y', strtotime(auth()->user()->buyer->birthday)) }}" readonly>
                            </div>

                            <div class="form-group info-item xshort">
                                <label for="age">Age</label>
                                <input type="text" class="form-control" id="age"  placeholder="Age" value="{{ auth()->user()->buyer->age }}" readonly>
                            </div>

                            <div class="form-group info-item xshort">
                                <label for="gender">Gender</label>
                                <input type="text" class="form-control" id="age"  placeholder="Age" value="{{ auth()->user()->buyer->gender }}" readonly>
                            </div>


                            <div class="form-group info-item short">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="age"  placeholder="Age" value="{{ auth()->user()->buyer->stnumber  .' '. auth()->user()->buyer->barangay .', '. auth()->user()->buyer->city .', '.  auth()->user()->buyer->province .', '.  auth()->user()->buyer->country .' '.  auth()->user()->buyer->zip }}" readonly>

                            </div>

                            <a href="{{ route('buyer.switch.seller') }}" class="btn btn-primary">Switch as Seller</a>

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


                                /*map.addListener("click", function(event) {

                                    addMarker(event.latLng, map)
                                });*/

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

                            }

                        </script>

                        <!--
                          The `defer` attribute causes the callback to execute after the full HTML
                          document has been parsed. For non-blocking uses, avoiding race conditions,
                          and consistent behavior across browsers, consider loading using Promises
                          with https://www.npmjs.com/package/@googlemaps/js-api-loader.
                          -->


                    </div>
                </div>
           </div>
       </div>
    </div>
@endsection
