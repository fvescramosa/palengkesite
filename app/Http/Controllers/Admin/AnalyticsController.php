<?php

namespace App\Http\Controllers\Admin;

use App\Buyer;
use App\Http\Controllers\Controller;
use App\Message;
use App\Order;
use App\OrderProduct;
use App\Products;
use App\Seller;
use App\SellerProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    //
    public function __construct()
    {

    }


    public function salesByProducts($id){

        $sales = OrderProduct::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at', date('Y'))
            ->whereHas('order', function ($q){
                $q->where('status', '=', 'pending');
            })->where('product_id', $id)
            ->groupBy(DB::raw("MONTHNAME(created_at)"))
            ->pluck('count', 'month_name');

        $labels = [];
        foreach ($sales->keys() as $key){
            $labels[] = $key;
        }

        $data = [];
        foreach ($sales->values() as $value){
            $data[] = $value;
        }

        $product = Products::find($id);

        return view('admin.analytics.by-products-chart', compact('labels', 'data' , 'product'));
    }

    public function sellerRegistration(){

        $sales = Seller::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at', date('Y'))
            ->whereHas('seller_stalls')
            ->groupBy(DB::raw("MONTHNAME(created_at)"))
            ->pluck('count', 'month_name');

        $labels = [];
        foreach ($sales->keys() as $key){
            $labels[] = $key;
        }

        $data = [];
        foreach ($sales->values() as $value){
            $data[] = $value;
        }


        return view('admin.analytics.seller-registration-chart', compact('labels', 'data' ));
    }
    public function buyerRegistration(){

        $sales = Buyer::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("MONTHNAME(created_at)"))
            ->pluck('count', 'month_name');

        $labels = [];
        foreach ($sales->keys() as $key){
            $labels[] = $key;
        }

        $data = [];
        foreach ($sales->values() as $value){
            $data[] = $value;
        }



        return view('admin.analytics.buyer-registration-chart', compact('labels', 'data' ));
    }

}
