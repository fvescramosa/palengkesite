<?php

namespace App\Http\Controllers\Buyer;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index(Request $request){


//        $orders = Auth::user()->buyer->orders;
        $orders = Order::where('buyer_id', auth()->user()->buyer->id);

        if($request->status){

            $orders->where('status', $request->status);

        }else{
            $orders = $orders->where('status', 'pending');
        }

        $orders = $orders->get();

        return view('buyer.orders.index', compact(['orders']));

    }

    public function find($order_id){


        $orders = Order::with(['order_products'])->where('transaction_id', $order_id)->firstOrFail();


        return view('buyer.orders.find', compact(['orders']));

    }

    public function cancel(Request $request){


        $data = [
            'transaction_id' => $request->transaction_id,
            'id' => $request->order_id,
            'status' => 'cancelled'
        ];

        $orders = Order::with(['order_products'])->where([
            'transaction_id' => $request->transaction_id,
            'id' => $request->order_id,

        ])->firstOrFail();

        if($orders->update($data)){
            $orders->order_statuses()->create([
                'status_id' => 6,
                'reason' => $request->reason,
            ]);

            $response = [
                'response' => 'success',
                'message' => 'Your order has been cancelled'
            ];
        }else{
            $response = [
                'response' => 'error',
                'message' => 'Sorry! Your order cannot be cancelled'
            ];
        }

        return redirect(route('buyer.orders.find', ['order_id' => $request->transaction_id]))->with($response);


    }
}
