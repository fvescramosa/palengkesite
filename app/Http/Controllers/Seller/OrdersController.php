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

            $status->order->where(['status' => 'In Progress']);
        }else{
            $response = [
                'response' => 'error',
                'message' => 'Opps! Something went wrong!'
            ];
        }

        return redirect(route('seller.orders.find', ['id' => $request->order_id]))->with($response);
    }
}
