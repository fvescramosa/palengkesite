<?php

namespace App\Http\Controllers\Seller;

use App\SellerProduct;
use App\SellerStall;
use App\Stall;
use App\StallAppointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StallsController extends Controller
{



    /*NO Stall*/
    public function create($id){

        $stall = Stall::whereDoesntHave('seller_stall')->findOrFail($id);


        return view('seller/stalls/create', compact(['stall']));
    }

    public function store(Request $request){

        $validate = $request->validate([
            'application_letter' => "required|mimes:jpeg,jpg,png",
            'residency' => "required|mimes:jpeg,jpg,png",
            'image' => "required|mimes:jpeg,jpg,png",
            'id1' => "required|mimes:jpeg,jpg,png",
            'id2' => "required|mimes:jpeg,jpg,png",
        ]);


        $data = [
            'stall_id' => $request->stall_id ,
            'status' => 'pending',
            'seller_id' => auth()->user()->seller->id,
            'type' => 1,
        ];


//        dd(auth()->user()->seller()->seller_stalls);
//

        $create = SellerStall::create($data);


        $appointment = [
            'stall_id' => $request->stall_id ,
            'seller_id' => auth()->user()->seller->id,
            'seller_stall_id' => $create->id,
            'date' => $request->appointment_date,
            'status' => 'pending'
        ];
        if($request->file('application_letter')){
            $file= $request->file('application_letter');
            $filename= auth()->user()->seller->id.'_application_letter.'.$request->file('application_letter')->extension();

            $file->move(public_path('public/Image/'.auth()->user()->seller->id), $filename);
            $appointment['application_letter']= auth()->user()->seller->id.'/'.$filename;
        }

        if($request->file('residency')){
            $file= $request->file('residency');
            $filename= auth()->user()->seller->id.'_residency.'.$request->file('residency')->extension();
            $file->move(public_path('public/Image/'.auth()->user()->seller->id), $filename);
            $appointment['residency']= auth()->user()->seller->id.'/'.$filename;
        }

        if($request->file('image')){
            $file= $request->file('image');
            $filename= auth()->user()->seller->id.'_image.'.$request->file('image')->extension();
            $file->move(public_path('public/Image/'.auth()->user()->seller->id), $filename);
            $appointment['image']= auth()->user()->seller->id.'/'.$filename;;
        }

        if($request->file('id1')){
            $file= $request->file('id1');
            $filename= auth()->user()->seller->id.'_id1e.'.$request->file('id1')->extension();
            $file->move(public_path('public/Image/'.auth()->user()->seller->id), $filename);
            $appointment['id1']= auth()->user()->seller->id.'/'.$filename;
        }

        if($request->file('id2')){
            $file= $request->file('id2');
            $filename= auth()->user()->seller->id.'_id2.'.$request->file('id2')->extension();
            $file->move(public_path('public/Image/'.auth()->user()->seller->id), $filename);
            $appointment['id2']= auth()->user()->seller->id.'/'.$filename;
        }



        if( $create->save()){;
            $createAppointment = StallAppointment::create($appointment);
        }

//        $stall = Stalls::with(['seller_stall'])->findOrFail($request->stall_id);
        return redirect(route('seller.stalls.show'))->with(['message' => 'Stall application sent!']);

    }

    public function select()
    {

        $stalls =  Stall::where('status', '=', 'vacant')
            /*  whereDoesntHave('seller_stall', function ($query){
                  $query->where('status', '=', 'pending')->orWhere('status', '=', 'active');
      })->*/
            ->where('market_id', auth()->user()->seller->market_id)->get();



        return view('seller.stalls.select', compact(['stalls']))->with(['message' => '']);

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

    /*HAS Stall*/
    public function hasSelect()
    {

        /*$stalls =  Stall::whereDoesntHave('seller_stall', function ($query){
                            $query->where('status', '=', 'pending')->orWhere('status', '=', 'active');
                        }) */
        $stalls =  Stall::where('status', 'vacant')
            ->where('market_id', auth()->user()->seller->market_id)
            ->orderByRaw('CONVERT(number, SIGNED)', 'desc')
            ->get();


        return view('seller.stalls.select-has-stall', compact(['stalls']))->with(['message' => '']);

    }

    public function hasCreate($id){

        $stall = Stall::where('status', 'vacant')
            /*->whereDoesntHave('seller_stall', function ($query){
                    $query->where('status', '=', 'pending')->orWhere('status', '=', 'active'); })*/
            ->findOrFail($id);


        return view('seller/stalls/has-create', compact(['stall']));
    }

    public function storeDetails(Request $request){

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
    /*public function createDetails(){

        $stalls = Stall::where('status', 'vacant')->whereDoesntHave('seller_stall', function ($query){
            $query->where('status', '=', 'pending')->orWhere('status', '=', 'active');
        })->get();


        return view('seller/stalls/create_details', compact(['stalls']));
    }*/

    public function show()
    {
        //$seller_products = SellerProducts::with(['product', 'seller', 'product.category'])->where(['seller_id' => auth()->user()->seller->id])->get();


        if(Auth::user()->seller()->has('seller_stalls')->get()->count() > 0) {
            $seller_stall = auth()->user()->seller->seller_stalls;


            return view('seller/stalls/show', compact(['seller_stall']))->with(['message' => '']);
        }else{
            return redirect(route('seller.stalls.haveany'));

        }


    }

    public function edit($id)
    {
        $seller_product = SellerProduct::with(['product', 'seller', 'product.category'])->where(['seller_id' => auth()->user()->seller->id])->find($id);

//        $seller_products =  auth()->user()->seller->seller_products->where(['id' => $id]);

        return view('seller/stalls/edit', compact(['seller_product']))->with(['message' => '']);

    }

    public function update(Request $request)
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

    public function displayDetails(Request $request){

        $stall = Stall::findOrFail($request->id);


        return response()->json($stall);
    }

}
