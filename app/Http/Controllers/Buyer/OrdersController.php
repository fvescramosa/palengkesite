<?php

namespace App\Http\Controllers\Buyer;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    //
    public function index(){


        $orders = Auth::user()->buyer->orders;



        return view('buyer.orders.index', compact(['orders']));

    }

    public function find($order_id){


        $orders = Order::with(['order_products'])->where('transaction_id', $order_id)->firstOrFail();


        return view('buyer.orders.find', compact(['orders']));

    }
}
