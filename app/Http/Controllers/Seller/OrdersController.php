<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    //

    public function show(){

        $orders = auth()->user()->seller->orders()->get();

        return view('seller.orders.index', compact(['orders']));

    }
}
