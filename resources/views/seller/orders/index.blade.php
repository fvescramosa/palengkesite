@extends('layouts.seller')

@section('content')
    <div class="orders">
       <div class="orders-wrapper">
            <h3>My Orders</h3>

           <hr>

           <form action="" id="filterByStatus" class="form-group" method="GET">
               @csrf
               <label for="">Filter</label>
               <select name="status" id="orderStatus" class="form-control">
                   @foreach($statuses as $status)

                       <option value="{{ $status->id }}" {{ ( isset($_GET['status']) && $_GET['status'] == $status->id ? 'selected'  : '') }}>{{ $status->status }}</option>
                   @endforeach
               </select>
           </form>
              @foreach($orders as $order)


                <div class="my-order-list">
                   <div class="my-order-item">
                       <div class="my-order-details">
                           <div class="details-up">
                               <div>
                                   <p class="order-date">{{ date('F d, Y', strtotime($order->created_at)) }}</p>
                                   <p class="order-no">Order no. PS-{{ $order->transaction_id }}</p>
                               </div>
                               <div>
                                   <p class="order-total-label">Total</p>
                                   <p class="order-total">₱{{ $order->total }}</p>
                               </div>
                           </div>
                           <div class="details-thumbnail">
                               {{ $order->seller->seller_stalls->name }}
                               @foreach( $order->order_products as $product)
                                   {{ $product->product->product_name }}
                                  {{-- <img src="{!! asset($product->seller_product->image)  !!}" alt="" width="60" height="60">--}}
                                   {{ $product->seller_product->price }} x {{ $product->quantity }} =  {{ $product->seller_product->price * $product->quantity }}
                               @endforeach
                           </div>
                       </div>
                       <div class="my-orders-actions">
                           <span class="alert alert-{{ ($order->status == 'pending' ? 'warning' :  ($order->status == 'confirmed' ? 'success' : '' ) ) }}"> {{ ucfirst($order->status) }}</span>

                           @if( $order->status == 'pending' && $order->payment_option_id == '2')
                               <a href="{{ route('seller.orders.confirmCOD', ['id' => $order->id]) }}" class="pal-button btn-green" >Confirm COD Request</a>
                           @endif

                           <a class="pal-button btn-orange" href="{{ route('seller.orders.find', ['id' => $order->id]) }}">View Order</a>
                       </div>
                   </div>
               </div>



                   <div class="modal" tabindex="-1" role="dialog" id="order{{ $order->transaction_id }}">
                       <div class="modal-dialog" role="document">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <h5 class="modal-title">Modal title</h5>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                   </button>
                               </div>
                               <div class="modal-body">

                                   @if ($message = Session::get('success'))
                                       <div class="custom-alerts alert alert-success fade in">
                                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                           {!! $message !!}
                                       </div>
                                       <?php Session::forget('success');?>
                                   @endif

                                   @if ($message = Session::get('error'))
                                       <div class="custom-alerts alert alert-danger fade in">
                                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                           {!! $message !!}
                                       </div>
                                       <?php Session::forget('error');?>
                                   @endif
                                   <div class="panel-heading"><b>Paywith Paypal</b></div>
                                   <div class="panel-body">
                                       <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('paypal') !!}" >
                                           {{ csrf_field() }}

                                           <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                               <label for="amount" class="col-md-4 control-label">Enter Amount</label>

                                               <div class="col-md-6">
                                                   <input id="amount" type="text" class="form-control" name="amount" value="{{ $order->total }}" readonly>
                                                   <input id="order_id" type="hidden" class="form-control" name="order_id" value="{{ $order->id }}" readonly>

                                                   @if ($errors->has('amount'))
                                                       <span class="help-block">
                                                            <strong>{{ $errors->first('amount') }}</strong>
                                                        </span>
                                                   @endif
                                               </div>
                                           </div>

                                           <div class="form-group">
                                               <div class="col-md-6 col-md-offset-4">
                                                   <button type="submit" class="btn btn-primary">
                                                       Pay with Paypal
                                                   </button>
                                               </div>
                                           </div>
                                       </form>
                                   </div>

                               </div>
                               <div class="modal-footer">

                               </div>
                           </div>
                       </div>
                   </div>
              @endforeach



       </div>
   </div>
    <script>
        const filter = {
            onInit: function () {
                filter.initFilterStatus( $('#orderStatus') );
            },

            initFilterStatus: function(trigger){
                trigger.change(function(e){

                    $('#filterByStatus').submit();
                });
            },
        }

        $(document).ready(function () {
            filter.onInit();
        })
    </script>
@endsection
