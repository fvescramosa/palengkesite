@extends('layouts.buyer')

@section('content')
    <div class="orders">
       <div class="orders-wrapper">
            <h3>My Orders</h3>

           <hr>


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
                                   <img src="{!! asset('public/Image/'.$product->seller_product->image)  !!}" alt="">
                                   {{ $product->seller_product->price }} x {{ $product->quantity }} =  {{ $product->seller_product->price * $product->quantity }}
                               @endforeach
                           </div>
                       </div>
                       <div class="my-orders-actions">
                           <div class="alert alert-success">{{ $order->status }}</div>

                           @if( $order->status == 'pending' && $order->payament_option == '1')
                             <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#order{{ $order->transaction_id }}">{{ $order->total }}</a>
                           @endif
                           <a class="btn" href="{{ route('buyer.orders.find', ['id' => $order->transaction_id]) }}">View Order</a>
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
                                                       Paywith Paypal
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

@endsection