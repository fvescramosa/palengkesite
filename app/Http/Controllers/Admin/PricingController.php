<?php

namespace App\Http\Controllers\Admin;

use App\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PricingController extends Controller
{
    //

    public function index($id){

        $products = Products::with('seller_products')->findOrFail($id);

        return view('admin.pricing.show', compact(['products']));

    }
}
