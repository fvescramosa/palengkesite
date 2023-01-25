<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use function dd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\StallAppointment;
use App\SellerStall;
use App\Buyer;
use App\Seller;
use App\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function redirect;
use function view;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin')->except('logout');
    }

    public function index(){

        $sellers = Seller::with(['seller_stalls', 'seller_stalls.stall'])->whereHas('seller_stalls', function($q){
            $q->where('status', 'active');
        });
        if(session()->has('market')){
            $marketOption = session()->get('market');
            $sellers->whereHas('seller_stalls.stall', function($q) use ($marketOption){
                $q->where('market_id', $marketOption);
            });
        }

        $sellers = $sellers->get()->count();

        
        $buyers = Buyer::all()->count();
        

        
        if(session()->has('market')){
            $marketOption = session()->get('market');
            $stallappointments = StallAppointment::where('status', 'pending')->whereHas('stall', function($q) use ($marketOption){
                $q->where('market_id', $marketOption);
            })->get()->count();
        }else{
            $stallappointments = StallAppointment::where('status', 'pending')->get()->count();
        }

        if(session()->has('market')){
            $marketOption = session()->get('market');
            $stallapproval = SellerStall::where('status', 'pending')->whereHas('stall', function($q) use ($marketOption){
                $q->where('market_id', $marketOption);
            })->get()->count();
        }else{
            $stallapproval = SellerStall::where('status', 'pending')->get()->count();
        }


        return view('admin.index', compact(['sellers', 'buyers', 'stallappointments', 'stallapproval']));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function create(){
        $admin = Admin::all();
        return view();
    }

    public function store(Request $request){

    }

    public function show(){
        $staffs = new Admin();

        $orderby = '';
        if(isset($_GET['orderby'])){
            if($_GET['orderby'] == 'A-Z'){
                $orderby = ['name', 'asc'];
                $staffs = $staffs->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'Z-A'){
                $orderby = ['name', 'desc'];
                $staffs = $staffs->orderBy($orderby[0], $orderby[1]);

            
            }

            else if($_GET['orderby'] == 'recent'){
                $orderby = ['created_at', 'desc'];
                $staffs = $staffs->orderBy($orderby[0], $orderby[1]);
            }

            else if($_GET['orderby'] == 'oldest'){
                $orderby = ['created_at', 'asc'];
                $staffs = $staffs->orderBy($orderby[0], $orderby[1]);
            }
            
        }
        else{
            $orderby = ['name', 'asc'];
            $staffs = $staffs->orderBy($orderby[0], $orderby[1]);
        }

        $staffs= $staffs->where('is_super', 0)->get();


        return view('admin.users/staff', compact(['staffs']));
    }

    public function setMarket(Request $request){
        session(['market' => $request->marketOption]);

      
        return redirect( url()->previous() );
    }

    public function getStallAppointmentNotif(){
        $stallappointments = StallAppointment::where('status', 'pending')->get();

        return response()->json($stallappointments->count());
        
    }

    public function getStallApprovalNotif(){
        $approvalnotif = SellerStall::where('status', 'pending')->get();

        return response()->json($approvalnotif->count());
        
    }

    public function getNotifications(){
        $notif = Notification::where('status', 'unread')->get();

        return response()->json($notif->count());
        
    }

    public function settings(){

        return view('admin.change-password');
    }

    public function updatePassword(Request $request){
        $validate = $request->validate([
                'password' => ['required', 'string',  /*'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',*/  'confirmed'],
            ],
            [
                'password.regex' => 'Password must contain at least one number, one uppercase and one lowercase letter, and a special character.'
            ]
        );

        if($validate){
            Admin::where('id', auth()->guard('admin')->user()->id)->update([ 'password' => Hash::make($request->password)]);
        }

        return redirect(route('admin.settings'))->with(['message' =>  'Updated!']);
    }
}
