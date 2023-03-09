<?php

namespace App\Http\Controllers\Seller;

use App\Order;
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

        return view('seller.orders.find', compact(['orders']));

    }
}
