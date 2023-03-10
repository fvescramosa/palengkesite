<?php

namespace App\Http\Controllers\Seller;

use App\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Buyer;
use App\Cart;
use App\Categories;
use App\Products;
use App\SellerProduct;
use function asset;
use function auth;
use function compact;
use function dd;
use Illuminate\Support\Facades\Auth;
use function redirect;
use function view;

class ProductsController extends Controller
{
    //

    public function create(){

        $categories = Categories::all();
        return view('seller/products/create', compact(['categories']));
    }

    public function store(Request $request){

        if($request->new_product !== 'on'){

            $product = Products::findorFail($request->product);

            if ($product->max_price != null){
                $validate = $request->validate([
                    'price' => ['numeric', 'lt:'.$product->max_price]
                ]);
            }


        }else{

            $product = Products::create([
                'category_id' => $request->category,
                'product_name'	=> $request->new_product_name,
                'min_price' => '',
                'max_price'	=> '',
                'srp'	=> '',
                'code'	=> '',
                'manufacturer'	=> '',
                'type' => '',
                'status' => 'pending'
            ]);

            $product->save();
        }

        $create = SellerProduct::create([
            'seller_id' => auth()->user()->seller->id,
            'product_id' => $product->id,
            'price' => $request->price,
            'type' => $request->type,
            'image' => $request->image,
            'image_1' => $request->image_1,
            'image_2' => $request->image_2,
            'image_3' => $request->image_3,
            'image_4' => $request->image_4,
            'image_5' => $request->image_5,
            'featured' => $request->featured,
            'stock' => $request->stock,
        ]);

        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $data['image']= $filename;
        }


        if($request->file('image_1')){
            $file= $request->file('image_1');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $data['image_1']= $filename;
        }


        if($request->file('image_2')){
            $file= $request->file('image_2');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $data['image_2']= $filename;
        }


        if($request->file('image_3')){
            $file= $request->file('image_3');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $data['image_3']= $filename;
        }

        if($request->file('image_4')){
            $file= $request->file('image_4');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $data['image_4']= $filename;
        }

        if($request->file('image_5')){
            $file= $request->file('image_5');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $data['image_5']= $filename;
        }

        $create->save();

        if($request->price > $product->max_price){
            Notification::create([
                'title' => 'Overpriced Product',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'user_id' => auth()->user()->id,
                'status' => 'unread',
                'product_id' => $product->id,
                'type' => 'pricing',
            ]);
        }

        $categories = Categories::all();
        if($create){
            return view('seller/products/create', compact(['categories']))->with(['message' => 'Product has been added', 'response'=> 'success']);
        }else{
            return view('seller/products/create', compact(['categories']))->with(['message' => '', 'response' => 'error']);
        }

    }

    public function show()
    {
        //$seller_products = SellerProducts::with(['product', 'seller', 'product.category'])->where(['seller_id' => auth()->user()->seller->id])->get();

        $seller_products =  Auth::user()->seller->seller_products()->with(['product'])->get();



        return view('seller/products/show', compact(['seller_products']))->with(['message' => '']);

    }

    public function edit($id)
    {
        $seller_product = SellerProduct::with(['product', 'seller', 'product.category'])->where(['seller_id' => auth()->user()->seller->id])->findorFail($id);

//        $seller_products =  auth()->user()->seller->seller_products->where(['id' => $id]);

        return view('seller/products/edit', compact(['seller_product']))->with(['message' => '']);

    }

    public function update(Request $request)
    {
        $update = SellerProduct::where(['seller_id' => auth()->user()->seller->id, 'id' => $request->id])
            ->update([
                'product_id' => $request->product,
                'price' => $request->price,
                'type' => $request->type,
                'featured' => $request->featured,
                'stock' => $request->stock,
            ]);


        $seller_products =  auth()->user()->seller->seller_products;

        return view('seller/products/show', compact(['seller_products']))->with(['message' => 'Product has been updated!']);

    }

    public function findByCategory(Request $request){

        $data = Products::where('category_id', $request->id)->get();

//        return view('seller/products/list', compact(['products']));
        return response()->json($data);
    }

    public function findByID(Request $request){

        $data = Products::where('id', $request->id)->get();

//        return view('seller/products/list', compact(['products']));
        return response()->json($data);
    }


}
