<?php

namespace App\Http\Controllers\Seller;

use App\Order;
use App\OrderStatus;
use App\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    //

    public function show(){

        $orders = auth()->user()->seller->orders()->get();

        return view('seller.orders.index', compact(['orders']));

    }

    public function find($id){
        $orders = Order::find($id);

        $statuses = Status::all();
        return view('seller.orders.find', compact(['orders', 'statuses']));

    }

    public function updateStatus(Request $request){



        $status = OrderStatus::create([
           'order_id' => $request->order_id,
           'status_id' => $request->status,
        ]);


        if($status){
            $response = [
                'response' => 'success',
                'message' => 'Order status updated!'
            ];

            if( in_array($request->status, [1,2]) ){
                $status->order->update(['status' => 'Shipping']);

            }else if (in_array($request->status, [3, 4, 5])){
                $status->order->update(['status' => 'In Progress']);
            }
            else if (in_array($request->status, [6])){
                $status->order->update(['status' => 'Cancelled']);
            }

        }else{
            $response = [
                'response' => 'error',
                'message' => 'Opps! Something went wrong!'
            ];
        }

        return redirect(route('seller.orders.find', ['id' => $request->order_id]))->with($response);
    }
}
