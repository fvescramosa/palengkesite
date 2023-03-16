<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Market;
use App\SellerProduct;
use App\User;
use App\Verification;
use function auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Twilio\Rest\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index(){

        $featuredProducts = SellerProduct::where('featured', 1)->limit(6)->get();
        $categories = Categories::all();

        return view('home/index', compact(['featuredProducts', 'categories']));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function checkpoint(){


        if(auth()->user()->user_type_id == '1'){
            return redirect( route('seller.profile') );
        }
    }

    public function sample($name){
        return $name;
    }

    public function profile(){
        if(auth()->user()->user_type_id == '1'){
            return redirect( route('buyer.profile',  ['id' => auth()->user()->id]) );
        }elseif(auth()->user()->user_type_id == '2'){
            return redirect( route('seller.create') );
        }
    }

    public function selectPalengke(Request $request){
        session()->forget('shop_at_market');
        session(['shop_at_market' => $request->market_option]);

        // session()->put('market', $request->marketOtion);
        $market = Market::find($request->market_option);
        $response = [
            'response' => 'success',
            'message' => 'You have selected '. ucwords( $market->market  ) .'!'
        ];
        return redirect( url()->previous() )->with($response);
    }

    public function landingAfterRegistration()
    {
        if(auth()->user()->user_type_id == '1'){
            return redirect( route('buyer.profile',  ['id' => auth()->user()->id]) );
        }elseif(auth()->user()->user_type_id == '2'){
            return redirect( route('seller.create') );
        }
    }

    public function testSMS(){
        $receiverNumber = "+639178402141";
        $message = "This is testing from FRANK!";

        try {

            $account_sid = env("TWILIO_SID");
            $auth_token = env("TWILIO_TOKEN");
            $twilio_number = env("TWILIO_FROM");

            $client = new Client(   $account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number,
                'body' => $message]);

            dd('SMS Sent Successfully.');

        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }

    public function verification($email, $code){

        $user = User::where(['email'=> $email, 'status' => 'inactive'])->firstOrFail();

        $checkCode  =  Verification::where(['user_id' => $user->id, 'code' => $code])->firstOrFail();



        $checkCode->update(['status' => 'done']);

        if($user->update(['status' => 'active'])){
            $result = ['response' => 'success', 'message' => 'Your Account has been Verified!'];
        }else{

            $result = ['response' => 'error', 'message' => 'Something went wrong!'];
        }

        Auth::loginUsingId($user->id);

        return view('verify', compact(['result', 'email']));

//        return redirect(route(''))->with($response);

    }

    public function registrationDone(){

        return view('registration-successful');
    }
}
