@component('mail::message')
# New ORDER!

<br>
<p>Hi, <strong>{{ $order->buyer->user->first_name }}!</strong>! You've just placed an order.</p>

<table class="table table-bordered" style="width: 100%; text-align: left">
    <tr>
        <th>Order ID</th>
        <th>{{ $order->transaction_id }}</th>
    </tr>
    <tr>
        <td><strong>Name</strong></td>
        <td>{{ $order->buyer->user->first_name }} {{ $order->buyer->user->last_name }}</td>
    </tr>

    <tr>
        <td><strong>Shipping Address</strong></td>
        <td>{{ $order->order_delivery_detail->stnumber}}
            {{ $order->order_delivery_detail->stname }}
            {{ $order->order_delivery_detail->barangay }},

            {{ $order->order_delivery_detail->city }}, {{ $order->order_delivery_detail->province }} {{ $order->order_delivery_detail->zip }}
        </td>
    </tr>
</table>
<br>
<br>
<table class="table table-bordered text-left" style="width: 100%; text-align: left">
    <tr>
        <th colspan="3">Order Details</th>
    <tr>
    @foreach($order->order_products as $product)
        <tr>
            <td><strong>{{ ($product->seller_product->custom_title != '' ? $product->seller_product->custom_title : $product->product->product_name) }}</strong></td>
            <td> ₱ {{ $product->seller_product->price }} x {{ $product->quantity }}</td>
            <td style="text-align: right">₱ {{ $product->total }}</td>
        </tr>

    @endforeach
    <tr>
        <th colspan="2">Total</th>
        <th style="text-align: right" colspan="1">₱ {{ $order->total }}</th>
    <tr>
</table>

@component('mail::button', ['url' => route('buyer.orders.find', ['order_id' => $order->transaction_id])])
   View Order
@endcomponent

<br>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
