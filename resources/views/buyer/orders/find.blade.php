@extends('layouts.buyer')

@section('content')
    <div class="orders">
       <div class="orders-details-wrapper">
            <div class="orders-details-wrapper-left">
                <h3>Order ID: {{ $orders->transaction_id }}</h3>
                <div class="order-details-box order-status">
                    <h1>{{ $orders->status }}</h1>
                </div>
                <div class="order-updates">
                    @if($orders->order_statuses()->exists())
                        @foreach($orders->order_statuses  as $order_status)

                            <div class="status-update">
                                <div class="status-update-fl">
                                    <p>{{ $order_status->status->status }}</p>
                                    <p>{{ date('F d, Y h:i:s a', strtotime($order_status->created_at)) }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="order-details-box order-customer-info">
                    <div class="order-info-section-1">
                        <h3>Contact Information</h3>
                        <p>{{ $orders->buyer->user->email }}</p>

                        <h3>Shipping Address</h3>
                        <p>
                            {{ $orders->order_delivery_detail->stnumber }}
                            {{ $orders->order_delivery_detail->stname }}
                            {{ $orders->order_delivery_detail->barangay }},
                            {{ $orders->order_delivery_detail->city }},
                            {{ $orders->order_delivery_detail->province }}
                            {{ $orders->order_delivery_detail->zip }}

                        </p>

                        <h3></h3>
                        <p></p>

                        <h3></h3>
                        <p></p>
                    </div>
                    <div class="order-info-section-2">
                        <h3>Payment Method</h3>
                        <p>{{ $orders->payment_option->payment_option }} - ₱ {{ number_format($orders->total, 2) }}</p>

                        <h3>Billing Address</h3>
                        <p>
                            {{ $orders->order_delivery_detail->stnumber }}
                            {{ $orders->order_delivery_detail->stname }}
                            {{ $orders->order_delivery_detail->barangay }},
                            {{ $orders->order_delivery_detail->city }},
                            {{ $orders->order_delivery_detail->province }}
                            {{ $orders->order_delivery_detail->zip }}

                        </p>
                    </div>
                </div>

              {{--  @if($orders->status !== 'cancelled')--}}
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
                            lat: {{ ( $orders->order_delivery_detail->latitude  ? $orders->order_delivery_detail->latitude : '13.749684') }},
                            lng: {{ ( $orders->order_delivery_detail->longitude  ? $orders->order_delivery_detail->longitude : '120.9395233') }},
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
               {{-- @endif--}}
            </div>
            <div class="orders-details-wrapper-right">
                <table class="table table-borderless order-items">
                    @foreach($orders->order_products as $product)
                        <tr>
                            <td class="td-left"><img src="{{ asset($product->seller_product->image) }}" alt=""></td>
                            <td class="td-center"><strong>{{ $product->product->product_name }} </strong>x {{  $product->quantity }}</td>
                            <td class="td-right"><p>₱ {{ number_format($product->seller_product->price * $product->quantity, 2) }}</p></td>
                        </tr>
                    @endforeach
                </table>

                <hr>

                <table class="table table-borderless order-items">

                        <tr>
                            <td class="td-left"><p>Subtotal</p></td>
                            <td class="td-center"></td>
                            <td class="td-right"><p>₱ {{ number_format($orders->total, 2) }}</p></td>
                        </tr>

                        <tr>
                            <td class="td-left"><p>Shipping Fee</p></td>
                            <td class="td-center"></td>
                            <td class="td-right"><p>₱ {{ number_format(0, 2) }}</p></td>
                        </tr>

                </table>

                <hr>

                <table class="table table-borderless order-items">

                    <tr>
                        <td class="td-left"><p>Total</p></td>
                        <td class="td-center"></td>
                        <td class="td-right"><p>₱ {{ number_format($orders->total, 2) }}</p></td>
                    </tr>

                </table>

                <hr>


                {{--@if($orders->order_statuses->last()->status->status == 'Placed')

                    @if(!isset($_GET['cancel']))

                        <form action="" method="GET">
                            <input type="hidden" name="cancel" value="1">
                            <input type="hidden" name="order_id" value="{{ $orders->id }}">
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="home-btn option-btn">
                                        {{ __('Cancel Order') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        @else
                        <form action="{{ route('buyer.orders.cancel', ['order_id' => $orders->transaction_id]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="cancel" value="1">
                            <input type="hidden" name="order_id" value="{{ $orders->id }}">
                            <input type="hidden" name="transaction_id" value="{{ $orders->transaction_id }}">
                            <label for="" class="col-form-label">Reason</label>
                            <textarea class="form-control-lg" type="hidden" name="reason" rows="10" style="width: 100%" ></textarea>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="home-btn option-btn">
                                        {{ __('Cancel Order') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                @endif--}}
            </div>
       </div>
   </div>

@endsection
