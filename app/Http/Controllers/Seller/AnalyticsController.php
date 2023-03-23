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

        $fileName = 'salesByProducts.csv';

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




        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );


        $columns = array('Product Custom Name', 'Product Name', 'Sales');

        $callback = function() use($sales, $columns) {
            $file = fopen('php://output', 'w');

            fputcsv($file, $columns);

            foreach ($sales as $data) {
                $row['Product Custom Name']  = $data->seller_product->custom_title;
                $row['Product Name']    = $data->product->product_name;
                $row['Sales']    = $data->count;
                fputcsv($file, array($row['Product Custom Name'], $row['Product Name'], $row['Sales']));

            }
            fclose($file);
        };


        return response()->stream($callback, 200, $headers);

//        dd([$labels, $data ]);


//        return view('seller.analytics.order-by-products', compact('labels', 'data'));
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

            if(isset($_GET['sort']) && $_GET['sort'] != ''){
                $products = $products->orderBy('average_ratings', $_GET['sort']);
            }else{
                $products = $products->orderBy('average_ratings', 'DESC');
            }

        $products = $products->orderBy('average_ratings', 'DESC')
            ->pluck('average_ratings', 'id');

        $labels = [];
        foreach ($products->keys() as $key){
            $labels[] = SellerProduct::find($key)->custom_title ?? SellerProduct::find($key)->product->product_name;
        }

        $data = [];
        foreach ($products->values() as $value){
            $data[] = $value;
        }

        return view('seller.analytics.ratings-by-products', compact('labels', 'data'));
    }

}
