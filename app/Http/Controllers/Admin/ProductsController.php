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
        $products = Products::whereHas('category');

        if(isset($_GET['search'])){
            $products = $products->where( function($query){
                $query->orwhere('product_name', 'like', '%' . $_GET['search'] . '%');
                $query->orwhereHas('category', function($q){
                    $q->where('category', 'like', '%' . $_GET['search'] . '%');
                });
            });
        }

        $orderby = '';
        if(isset($_GET['orderby'])){
            if($_GET['orderby'] == 'A-Z'){
                $orderby = ['product_name', 'asc'];
                $products->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'Z-A'){
                $orderby = ['product_name', 'desc'];
                $products->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'recent'){
                $orderby = ['created_at', 'desc'];
                $products->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'oldest'){
                $orderby = ['created_at', 'asc'];
                $products->orderBy($orderby[0], $orderby[1]);
            }
            
        }
        else{
            $orderby = ['product_name', 'asc'];
            $products->orderBy($orderby[0], $orderby[1]);
        }

        $products = $products->paginate(10);

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
                'type' => $request->type,
                'status' => 'active',
            ]
        );


        if(  $products->save() ){
            return redirect( route('admin.products.show'))->with(['message' => 'Product has been added', 'response' => 'success']);
        }else{
            return redirect( route('admin.products.show'))->with(['message' => 'Failed to add the product', 'response' => 'error']);
        }
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
                'type' => $request->type,
            ]);


        if($products){
            $message = ['success' => true, 'message' => 'Updated Succesfully!'];
        }else{
            $message = ['success' => false, 'message' => 'Update failed!'];
        }

        $products = Products::find($id);
        $categories = Categories::all();

        return view('admin.products.edit', compact(['categories', 'products']))->with($message);
    }

    public function trash(){
        $products = Products::with('category')->onlyTrashed();

        if(isset($_GET['search'])){
            $products = $products->where( function($query){
                $query->orwhere('product_name', 'like', '%' . $_GET['search'] . '%');
                $query->orwhereHas('category', function($q){
                    $q->where('category', 'like', '%' . $_GET['search'] . '%');
                });
            });
        }

        $orderby = '';
        if(isset($_GET['orderby'])){
            if($_GET['orderby'] == 'A-Z'){
                $orderby = ['product_name', 'asc'];
                $products->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'Z-A'){
                $orderby = ['product_name', 'desc'];
                $products->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'recent'){
                $orderby = ['created_at', 'desc'];
                $products->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'oldest'){
                $orderby = ['created_at', 'asc'];
                $products->orderBy($orderby[0], $orderby[1]);
            }

        }
        else{
            $orderby = ['product_name', 'asc'];
            $products->orderBy($orderby[0], $orderby[1]);
        }

        $products = $products->paginate(10);


        return view('admin.products/trash', compact(['products']));
    }

    public function deleteProduct($id){


        $delete =  Products::where('id', $id)->delete();


        return redirect(route('admin.products.show'));

    }

    public function recoverProduct($id){

        $recover = Products::withTrashed()->where('id', $id)->restore();


        return redirect(route('admin.products.show'));

    }

    public function ProductForceDelete($id){

        $delete = Products::where('id', $id)->forceDelete();
        return redirect(route('admin.products.trash'));
    }

    public function showByCategory($category){

        $products = Products::whereHas('category', function($q) use ($category){
            $q->where('category',$category);
        })->get();


    }

    public function approve($id){

        $data = ['status' => 'active'];

        $product = Products::findOrFail($id);


        if( $product->update($data)){
            $response = ['message' => 'Product is Approved!', 'response' => 'success'];
        }else{
            $response = ['message' => '', 'response' => 'error'];
        }


        return redirect(route('admin.products.show'))->with($response);

    }
}
