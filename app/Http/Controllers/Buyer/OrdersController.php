<?php

namespace App\Http\Controllers\Buyer;

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
}
