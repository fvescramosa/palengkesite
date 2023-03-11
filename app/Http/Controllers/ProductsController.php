<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\Cart;
use App\Categories;
use App\Products;
use App\Seller;
use App\SellerProduct;
use function asset;
use function auth;
use function compact;
use function dd;
use Illuminate\Http\Request;
use function redirect;
use function view;

class ProductsController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth')->only(['addToCart' , 'postComment']);

    }

    public function index(){

         /* $products =  Products::with(['category', 'seller_products'])
               ->whereHas('seller_products')->whereHas('category', function($q) use ($category){
                   $q->where('category', $category);
               })->get()->groupBy('seller_products.seller_id');*/


        $products = SellerProduct::with(['product']);

        if(session()->has('shop_at_market')){
            $products = $products->whereHas('seller', function ($query){
                $query->where('market_id', session('shop_at_market'));
            });
        };




        $products = $products->get();


        $innerPageBanner = '';

          return view('shop.category', compact(['products' ,'innerPageBanner']));

    }

    public function showByCategory($category){

         /* $products =  Products::with(['category', 'seller_products'])
               ->whereHas('seller_products')->whereHas('category', function($q) use ($category){
                   $q->where('category', $category);
               })->get()->groupBy('seller_products.seller_id');*/
        $categories = Categories::where('category', $category)->first();

        $products = SellerProduct::with(['product'])->whereHas('product.category', function($q) use ($category){
              $q->where('category', $category);
          })->get();


        $innerPageBanner = asset('public/image/'.$categories->image);

          return view('shop.category', compact(['products' ,'innerPageBanner']));

    }

    public function addToCart(Request $request){



        $response = [];
        //find exsiting item from your cart
        $findCart = Cart::where([
                                    'product_id' => $request->product_id,
                                    'buyer_id' => auth()->user()->buyer->id,
                                    'seller_id' => $request->seller_id,
                                ])->get()->last();

        if($findCart){

            //update the quantity
            $findCart->update([
                'quantity' => $findCart->quantity + $request->quantity,
                'total' =>  ($findCart->quantity + $request->quantity) *  $request->price,
            ]);

            $response = ['message' => 'An item from your cart was updated', 'response' => 'success'];
        }
        else{

            //Insert new product to cart
            $cart = Cart::create([
                'product_id' => $request->product_id,
                'seller_id' => $request->seller_id,
                'buyer_id' => auth()->user()->buyer->id,
                'price' => $request->price,
                'seller_product_id' =>  $request->seller_product_id,
                'quantity' =>  $request->quantity,
                'total' =>  $request->quantity *  $request->price,
            ]);

            $response = ['message' => 'Product was added to your cart', 'response' => 'success'];
        }

//        dd(auth()->user()->buyer->carts);
        return redirect(url()->previous())->with($response);

    }

    public function find($id){


        //take note ID ay SellerProductID hindi Product ID
        $sellerProduct = SellerProduct::findOrFail($id);

        $related_product = Products::with(['seller_products'])->where('id', $sellerProduct->product->id)->get();

        return view('shop.product.index', compact(['sellerProduct' ,'related_product']));

    }

    public function postComment($id, Request $request){


        $product = SellerProduct::findOrFail($id);


        $comment = $product->comments()->create([
            'product_id' => $product->product->id,
            'is_anonymous' => (isset($request->anonymous)) ? 1 : 0,
            'comment' => $request->comment,
            'ratings' => $request->ratings,
            'buyer_id' => auth()->user()->buyer->id,
        ]);

        if($comment->save()){
            $response = ['message' => 'Comment Posted!', 'response' => 'success'];
        }else{
            $response = ['message' => 'Something went wrong. Please try again later!', 'response' => 'error'];
        }

        return redirect(route('shop.products.find', ['id' => $id]))->with($response);
    }
}
