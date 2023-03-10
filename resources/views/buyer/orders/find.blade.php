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
                    @foreach($orders->order_statuses  as $order_status)
                        <div class="status-update">
                            <div class="status-update-fl">
                                <p>{{ $order_status->status->status }}</p>
                                <p>{{ date('F d, Y h:i:s a', strtotime($order_status->created_at)) }}</p>
                            </div>
                        </div>
                    @endforeach
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
            </div>
            <div class="orders-details-wrapper-right">
                <table class="table table-borderless order-items">
                    @foreach($orders->order_products as $product)
                        <tr>
                            <td class="td-left"><img src="{{ $product->seller_product->image }}" alt=""></td>
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
            </div>
       </div>
   </div>

@endsection
