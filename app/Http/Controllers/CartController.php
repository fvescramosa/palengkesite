<?php

namespace App\Http\Controllers;

use App\Cart;
use App\DeliveryAddress;
use App\Order;
use App\OrderProduct;
use App\PaymentOption;
use function auth;
use function compact;
use function dd;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){

        $paymentOptions = PaymentOption::all();
        return view('cart.index', compact(['paymentOptions']));
    }
    public function checkout(Request $request){


        dd($request);

        $deliver_detail = DeliveryAddress::findOrFail($request->delivery_address);


        $carts = Cart::whereIn('id', $request->cart_ids)->get()->groupBy('seller_id');

        foreach ($carts as $cart) {

            //create Transaction ID
            $transaction_id = random_int(100000, 999999);


            while ($this->checkRandomNumber($transaction_id) === false){
                $transaction_id = random_int(100000, 999999);
            }

            $transaction_id;

            //get_price

            $total = '';

            foreach ($cart as $item){


                $total = (int)$total +  (int)$item->total;

            }

            $order = Order::create([
                'buyer_id' => auth()->user()->buyer->id,
                'seller_id' => $cart->first()->seller_id,
                'transaction_id' => $transaction_id,
                'total' => $total,
            ]);



            if($order->save()){

                $order->order_delivery_detail()->create(
                    [
                        'stnumber' => $deliver_detail->stnumber,
                        'stname' => $deliver_detail->stname,
                        'barangay' => $deliver_detail->barangay,
                        'city' => $deliver_detail->city,
                        'province' => $deliver_detail->province,
                        'country' => $deliver_detail->country,
                        'buyer_id' => auth()->user()->buyer->id
                    ]
                );

                foreach ($cart as $item){
                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'buyer_id' => $item->buyer_id,
                        'seller_id' => $item->seller_id,
                        'seller_product_id' => $item->seller_product_id,
                        'quantity' => $item->quantity,
                        'total' => $item->total,
                    ]);
                }
            }

        }

        Cart::whereIn('id', $request->cart_ids)->delete();
        return view('cart.index');
    }

    public function checkRandomNumber($transaction_id)
    {
        if (Order::where('transaction_id', $transaction_id)->get()->count() > 0) {
            return false;
        } else{
            return true;
        }

    }
}
