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
//            ->whereYear('created_at', ( isset($_GET['year']) && $_GET['year'] ? date('Y' ,  strtotime( $_GET['year'])) : date('Y') ) )
            ->whereMonth('created_at',  ( isset($_GET['productOption']) && $_GET['productOption'] ? date('m' ,  strtotime( $_GET['productOption'])) : date('m') ));

        if(isset($_GET['sort']) && $_GET['sort'] != ''){
            $sales = $sales->orderBy('count', $_GET['sort']);
        }else{
            $sales = $sales->orderBy('count', 'DESC');
        }

        $sales = $sales->groupBy([DB::raw("MONTHNAME(created_at)"), 'seller_product_id'])
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


    public function productByRatings(){
        $products = SellerProduct::select('average_ratings', 'product_id', 'id', 'seller_id', 'custom_title')
            ->with(['product', 'seller'])
            ->whereHas('product')
            ->whereHas('product', function($q){
                if(isset($_GET['category']) && $_GET['category'] != ''){
                    $q->whereHas('category', function ($query){
                        $query->where('category', $_GET['category']);
                    });
                }
            })
            ->where('seller_id', auth()->user()->seller->id);
//            ->orderBy('average_ratings', 'DESC')
//            ->pluck('average_ratings', 'id');


    }

}
