<?php

namespace App\Http\Controllers\Seller;

use App\Buyer;
use App\Http\Controllers\Controller;
use App\Message;
use App\Order;
use App\OrderProduct;
use App\Products;
use App\Seller;
use App\SellerProduct;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'complete.seller.info']);

    }
    public function productSales(){


        $sales = OrderProduct::select(DB::raw("SUM(quantity) as count"), 'seller_product_id')
            ->with(['product', 'seller_product'])
            ->whereHas('product')
            ->whereHas('order', function ($q){
//                $q->where('status', '<>', 'pending');
            })
            ->whereHas('product', function($q){

                if(isset($_GET['category']) && $_GET['category'] != ''){
                    $q->whereHas('category', function ($query){
                        $query->where('category', $_GET['category']);
                    });
                }
            })
            ->where('seller_id', auth()->user()->seller->id)
            ->whereYear('created_at', ( isset($_GET['YEAR']) && $_GET['YEAR'] ? date('Y' ,  strtotime( $_GET['YEAR'])) : date('Y') ) )
            ->whereMonth('created_at',  ( isset($_GET['productOption']) && $_GET['productOption'] ? date('m' ,  strtotime( $_GET['productOption'])) : date('m') ))
            ->groupBy([DB::raw("MONTHNAME(created_at)"), 'seller_product_id'])
            ->pluck('count', 'seller_product_id');


        $labels = [];
        foreach ($sales->keys() as $key){
            $labels[] = SellerProduct::find($key)->custom_title ?? SellerProduct::find($key)->product->product_name;
        }

        $data = [];
        foreach ($sales->values() as $value){
            $data[] = $value;
        }


//        dd([$labels, $data ]);


        return view('seller.analytics.order-by-products', compact('labels', 'data'));
    }

    public function exportProductSales(){


        $sales = OrderProduct::select(DB::raw("SUM(quantity) as count"), 'product_id', 'seller_product_id')
            ->with(['product', 'seller_product'])
            ->whereHas('product')
            ->whereHas('order', function ($q){
//                $q->where('status', '<>', 'pending');
            })
            ->whereHas('product', function($q){

                if(isset($_GET['category']) && $_GET['category'] != ''){
                    $q->whereHas('category', function ($query){
                        $query->where('category', $_GET['category']);
                    });
                }
            })
            ->where('seller_id', auth()->user()->seller->id)
            ->whereYear('created_at', ( isset($_GET['YEAR']) && $_GET['YEAR'] ? date('Y' ,  strtotime( $_GET['YEAR'])) : date('Y') ) )
            ->whereMonth('created_at',  ( isset($_GET['productOption']) && $_GET['productOption'] ? date('m' ,  strtotime( $_GET['productOption'])) : date('m') ))
            ->groupBy([DB::raw("MONTHNAME(created_at)"), 'product_id', 'seller_product_id'])
//            ->pluck('count', 'product_id');
            ->get();


        foreach ($sales as $sale){
            dd([$sale->product->product_name, ]);
        }

//        dd([$labels, $data ]);


        return view('seller.analytics.order-by-products', compact('labels', 'data'));
    }

    public function salesByProducts($id){

        $sales = OrderProduct::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at', date('Y'))
            /*->whereHas('order', function ($q){
                $q->where('status', '=', 'pending');
            })*/
            ->where('product_id', $id)
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

        return view('seller.analytics.by-products-chart', compact('labels', 'data' , 'product'));
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


        return view('seller.analytics.seller-registration-chart', compact('labels', 'data' ));
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



        return view('seller.analytics.buyer-registration-chart', compact('labels', 'data' ));
    }

}
