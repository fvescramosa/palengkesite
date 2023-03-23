<?php

namespace App\Http\Controllers\Seller;

use App\Mail\NewOrderStatus;
use App\Mail\orderCODConfirmed;
use App\Order;
use App\OrderStatus;
use App\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    //

    public function show(Request $request){

//        $orders = auth()->user()->seller->orders()->get();

        $orders = Order::where('seller_id', auth()->user()->seller->id);

        if($request->status){

            if ($request->status == 1){
                $orders = $orders->where('status', 'pending');
                $orders = $orders->orWhere('status', 'confirmed');
            }else if ($request->status == 2){
                $orders = $orders->where('status', 'Shipping');
            }
            else if ($request->status == 3 ||$request->status == 4 || $request->status == 5 || $request->status == 6 ){
                $orders = $orders->where('status', Status::find($request->status)->status);
            }

//            dd(Status::find($request->status)->status);

//            $orders = $orders->where('status', );
        }

        $statuses = Status::all();

        $orders = $orders->get();
        return view('seller.orders.index', compact(['orders', 'statuses']));

    }

    public function find($id){
        $orders = Order::find($id);


        $statuses = Status::all();
        return view('seller.orders.find', compact(['orders', 'statuses']));

    }

    public function confirmCOD($id){
        $order = Order::find($id);

        if($order->status == 'pending' && $order->payment_option_id == '2'){
            $order->update([
                'status' => 'confirmed',
            ]);

            Mail::to($order->buyer->user->email)->send(new orderCODConfirmed($order));

            $response = [
                'response' => 'success',
                'message' => 'Order Confirmed!'
            ];
        }else{
            $response = [
                'response' => 'error',
                'message' => 'Already Confirmed!'
            ];
        }
        return redirect(route('seller.orders.find', ['id' => $order->id ]))->with($response);

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
                $status->order->update(['status' => Status::find($request->status)->status]);
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

        $order = Order::find($request->order_id);

        Mail::to($order->buyer->user->email)->send(new NewOrderStatus($order));

        return redirect(route('seller.orders.find', ['id' => $request->order_id]))->with($response);
    }
}
