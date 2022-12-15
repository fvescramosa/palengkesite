<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use App\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    //
    public function __construct()
    {
//        $this->middleware(['auth']);
        $this->middleware('auth:admin')->except(['showByCategory']);

    }

    public function show(){
        $products = Products::all();
        return view('admin.products.show', compact(['products']));
    }


    public function create(){

        $categories = Categories::all();
        return view('admin.products.create', compact(['categories']));

    }
    public function store(Request $request){



        $products = Products::create(
            [
                'category_id' => $request->category,
                'product_name'	=> $request->product,
                'min_price' => $request->min_price,
                'max_price'	=> $request->max_price,
                'srp'	=> $request->srp,
                'code'	=> $request->code,
                'manufacturer'	=> $request->manufacturer,
                'type' => $request->type,
            ]
        );


        if(  $products->save() ){
            $message = ['success' => true, 'message' => 'Update Succesful!'];
        }else{
            $message = ['success' => false, 'message' => 'Update failed!'];
        }

        return redirect( route('products.show'))->with($message);
    }

    public function edit($id){
        $products = Products::findOrFail($id);

        $categories = Categories::all();

        return view('admin.products.edit', compact(['categories', 'products']));
    }
    public function update($id, Request $request){
        $products = Products::where('id', $id)
            ->update([
                'category_id' => $request->category,
                'product_name'	=> $request->product,
                'min_price' => $request->min_price,
                'max_price'	=> $request->max_price,
                'srp'	=> $request->srp,
                'code'	=> $request->code,
                'manufacturer'	=> $request->manufacturer,
                'type' => $request->type,
            ]);


        if($products){
            $message = ['success' => true, 'message' => 'Update Succesful!'];
        }else{
            $message = ['success' => false, 'message' => 'Update failed!'];
        }

        $products = Products::find($id);
        $categories = Categories::all();

        return view('admin.products.edit', compact(['categories', 'products']))->with($message);
    }

    public function delete(){}

    public function showByCategory($category){

        $products = Products::whereHas('category', function($q) use ($category){
            $q->where('category',$category);
        })->get();

        dd($products);

    }
}
