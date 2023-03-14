<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Message;
use App\Order;
use App\OrderProduct;
use App\Products;
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

        return view('admin.analytics.chart', compact('labels', 'data' , 'product'));
    }

}
