<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Mail\NewUserWelcomeMail;
use App\Products;
use App\Buyer;
use App\Seller;
use App\SellerProduct;
use App\SellerStall;
use App\Stall;
use App\StallAppointment;
use App\Notification;
use function compact;
use function dd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use function response;
use function session;
use function view;

class SellerController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('complete.seller.info')->except(['create', 'store', 'haveAnyStalls']);
        $this->middleware('sellerHasStall')->only(['haveAnyStalls']);
    }

    //
    public function show(){
        $sellers = Seller::all();
        return view('seller/show', compact(['sellers']));
    }

    public function create(){

        $stalls = Stall::where('status', 'active')->get();


        if(auth()->user()->seller()->exists()){
            return redirect(route( 'seller.edit' , auth()->user()->id));
        }else{
            return view('seller/create', compact(['stalls']));
        }
    }

    public function store(Request $request){

        
        $validate = $request->validate([
            'birthday' => ['required', ''],
            'age' => ['required', 'numeric', 'min:18'],
            'gender' => ['required'],
            'market_id' => ['required'],
            'seller_type' => ['required'],
            'user_id' => '',
        ]);

        if($validate){
            $seller = Seller::create(
                [
                    'birthday' => $request->birthday,
                    'age' => $request->age,
                    'gender' => $request->gender,
                    'market_id' => $request->market_id,
                    'seller_type' => $request->seller_type,
                    'user_id' => auth()->user()->id,
                ]
            );

            if(auth()->user()->buyer()->exists() == false){
                $buyer = Buyer::create(
                    [
                        'birthday' => $request->birthday,
                        'age' => $request->age,
                        'gender' => $request->gender,
                        'market_id' => $request->market_id,
                        'seller_type' => $request->seller_type,
                        'user_id' => auth()->user()->id,
                    ]
                );

                $buyer->save();
            }

            if($seller->save()){
                $data = array('name'=>"Frank Test");

                Mail::to(auth()->user()->email)->send(new NewUserWelcomeMail());

                echo "Basic Email Sent. Check your inbox.";
            }

        }


        return redirect(route('seller.stalls.haveany'))->with(['message' => 'Seller info added']);
    }

    public function haveAnyStalls(){

        return view('seller/haveanystalls');
    }

    public function edit(){

        $seller = Seller::findOrFail(auth()->user()->seller->id);

        return view('seller/edit', compact(['seller']));
    }

    public function update(Request $request){



        Auth::user()->update(
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]
        );


        Seller::where(['id' => auth()->user()->seller->id]) -> update([
            'birthday' => $request->birthday,
            'age' => $request->age,
            'gender' => $request->gender,
        ]);

        $seller = Seller::findOrFail( auth()->user()->seller->id );

        return redirect(route('seller.profile'))->with(['message' => 'Seller info Updated']);
    }

    public function profile(){

        if(auth()->user()->seller()->exists()){
            $seller = auth()->user()->seller;
            return view('seller/profile', compact(['seller']));
        }else{
            return redirect(route('seller.create'));
        }

    }

    public function productsCreate(){

        $categories = Categories::all();
        return view('seller/products/create', compact(['categories']));
    }

    public function findProductsByCategory(Request $request){

        $data = Products::where('category_id', $request->id)->get();

//        return view('seller/products/list', compact(['products']));
        return response()->json($data);
    }

    public function findProductsByID(Request $request){

        $data = Products::where('id', $request->id)->get();

//        return view('seller/products/list', compact(['products']));
        return response()->json($data);
    }

    public function productStore(Request $request){
        $product = Products::findorFail($request->product);

        $validate = $request->validate([
            'price' => ['numeric', 'lt:' .$product->max_price]
        ]);
        
        $create = SellerProduct::create([
            'seller_id' => auth()->user()->seller->id,
            'product_id' => $request->product,
            'price' => $request->price,
            'type' => $request->type,
            'featured' => $request->featured,
            'stock' => $request->stock,
        ]);

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
            return view('seller/products/create', compact(['categories']))->with(['message' => 'Product has been added']);
        }else{
            return view('seller/products/create', compact(['categories']))->with(['message' => '']);
        }

    }

    public function productShow()
    {
        //$seller_products = SellerProducts::with(['product', 'seller', 'product.category'])->where(['seller_id' => auth()->user()->seller->id])->get();

        $seller_products =  auth()->user()->seller->seller_products;

        return view('seller/products/show', compact(['seller_products']))->with(['message' => '']);

    }

    public function productEdit($id)
    {
        $seller_product = SellerProduct::with(['product', 'seller', 'product.category'])->where(['seller_id' => auth()->user()->seller->id])->findorFail($id);

//        $seller_products =  auth()->user()->seller->seller_products->where(['id' => $id]);

        return view('seller/products/edit', compact(['seller_product']))->with(['message' => '']);

    }

    public function productUpdate(Request $request)
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

    public function stallStoreDetails(Request $request){


        $data = [
            'stall_id' => $request->stall ,
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'duration' => $request->duration,
            'occupancy_fee' => $request->occupancy_fee,
            'seller_id' => auth()->user()->seller->id,
            'status' => 'pending',
            'type' => 0,
        ];

        
        $validate = $request->validate([
            "stall" => "required",
            "contract_of_lease" => "required|mimes:pdf|max:10000"
        ]);

        if($validate) {

            if ($request->file('contract_of_lease')) {
                $file = $request->file('contract_of_lease');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('public/contracts'), $filename);
                $data['contact_of_lease'] = $filename;

                $create = SellerStall::create($data);
                $create->save();

            }
        }



//        $stall = Stalls::with(['seller_stall'])->findOrFail($request->stall_id);
        return redirect(route('seller.stalls.show'))->with(['message' => 'Stall application sent!']);

    }

    /*NO Stall*/
    public function stallCreate($id){

        $stall = Stall::whereDoesntHave('seller_stall')->findOrFail($id);

        
        return view('seller/stalls/create', compact(['stall']));
    }

    public function stallStore(Request $request){


        $data = [
            'stall_id' => $request->stall_id ,
            'status' => 'pending',
            'seller_id' => auth()->user()->seller->id,
            'type' => 1,
        ];


//        dd(auth()->user()->seller()->seller_stalls);
//

        $create = SellerStall::create($data);


        if( $create->save()){
            $appointment = [
                'stall_id' => $request->stall_id ,
                'seller_id' => auth()->user()->seller->id,
                'seller_stall_id' => $create->id,
                'date' => $request->appointment_date,
                'status' => 'pending',
                
            ];

            $createAppointment = StallAppointment::create($appointment);
        }

//        $stall = Stalls::with(['seller_stall'])->findOrFail($request->stall_id);
        return redirect(route('seller.stalls.show'))->with(['message' => 'Stall application sent!']);

    }

    /*HAS Stall*/
    
    public function stallHasSelect()
    {

        $stalls =  Stall::whereDoesntHave('seller_stall', function ($query){
                            $query->where('status', '=', 'pending')->orWhere('status', '=', 'active');
                        })
        ->where('market_id', auth()->user()->seller->market_id)
        ->orderByRaw('CONVERT(number, SIGNED)', 'desc')
        ->get();


        return view('seller.stalls.select-has-stall', compact(['stalls']))->with(['message' => '']);

    }

    public function stallHasCreate($id){

        $stall = Stall::where('status', 'vacant')->whereDoesntHave('seller_stall', function ($query){
            $query->where('status', '=', 'pending')->orWhere('status', '=', 'active');
        })->findOrFail($id);

        
        return view('seller/stalls/has-create', compact(['stall']));
    }


    public function stallCreateDetails(){

        $stalls = Stall::where('status', 'vacant')->whereDoesntHave('seller_stall', function ($query){
            $query->where('status', '=', 'pending')->orWhere('status', '=', 'active');
        })->get();


        return view('seller/stalls/create_details', compact(['stalls']));
    }

    

    public function stallShow()
    {
        //$seller_products = SellerProducts::with(['product', 'seller', 'product.category'])->where(['seller_id' => auth()->user()->seller->id])->get();


        if(Auth::user()->seller()->has('seller_stalls')->get()->count() > 0) {
            $seller_stall = auth()->user()->seller->seller_stalls;

           
            return view('seller/stalls/show', compact(['seller_stall']))->with(['message' => '']);
        }else{
            return redirect(route('seller.stalls.haveany'));

        }


    }

    public function stallSelect()
    {

        $stalls =  Stall::whereDoesntHave('seller_stall', function ($query){
            $query->where('status', '=', 'pending')->orWhere('status', '=', 'active');
        })->where('market_id', auth()->user()->seller->market_id)->get();



        return view('seller.stalls.select', compact(['stalls']))->with(['message' => '']);

    }

    public function stallEdit($id)
    {
        $seller_product = SellerProduct::with(['product', 'seller', 'product.category'])->where(['seller_id' => auth()->user()->seller->id])->find($id);

//        $seller_products =  auth()->user()->seller->seller_products->where(['id' => $id]);

        return view('seller/stalls/edit', compact(['seller_product']))->with(['message' => '']);

    }

    public function stallUpdate(Request $request)
    {
        $update = SellerProduct::where(['seller_id' => auth()->user()->seller->id, 'id' => $request->id])
            ->update([
                'product_id' => $request->product,
                'price' => $request->price,
                'type' => $request->type,
            ]);


        $seller_products =  auth()->user()->seller->seller_products;

        return view('seller/stalls/show', compact(['seller_products']))->with(['message' => 'Product has been updated!']);

    }

    public function submitContract(Request $request){


        $validate = $request->validate([
            "contract_of_lease" => "required|mimes:pdf|max:10000"
        ]);

        if($validate){
            $id = $request->seller_stall_id;

            if($request->file('contract_of_lease')){
                $file= $request->file('contract_of_lease');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('public/Image'), $filename);
                $data['contact_of_lease']= $filename;
                $data['status']= 'Pending Approval';


                dd( SellerStall::where('id', $id)->update($data) );



            }


        }


    }

    public function myStalls(){

    }


    public function showOrders(){

        $orders = auth()->user()->seller->orders()->get();

        return view('seller.orders.index', compact(['orders']));

    }
    public function display_details(Request $request){

        $stall = Stall::findOrFail($request->id);


        return response()->json($stall);
    }



    public function switch_as_buyer(){

        if(Auth::user()->user_type_id == 2){

            if(!Auth::user()->buyer()->exists()){
                $seller_info = Auth::user()->seller;

                $data = [
                    'birthday' => $seller_info->birthday,
                    'age' => $seller_info->age,
                    'gender' => $seller_info->gender,
                ];


                Auth::user()->buyer()->create($data);

            }

        }

            session()->put('user_type', 'buyer');

        return redirect(route('buyer.profile', ['id' => Auth::user()->id]));
    }
}
