<?php

namespace App\Http\Controllers\Admin;

use App\StallAppointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StallAppointmentController extends Controller
{
    //
    public function index(){
        $appointments = StallAppointment::with(['stall' ])
        ->whereHas('seller')
        ->whereHas('seller.user')
        ->whereHas('stall',function($q){

            if(session()->has('market')){
                if(session()->get('market') != ''){
                    $q->where('market_id', session()->get('market'));
                }
            }
        
        });

        if(isset($_GET['search'])){
            $appointments = $appointments->where(function ($query){
                $query->orWhere('status', 'like', '%' . $_GET['search'] . '%');
                $query->orWhereHas('seller', function($q){
                    $q->WhereHas('user', function($qr){
                        $qr->Where('first_name', 'like', '%' . $_GET['search'] . '%');
                        $qr->orWhere('last_name', 'like', '%' . $_GET['search'] . '%');
                    });
                });
                $query->orWhereHas('stall', function($q){
                    $q->Where('number', 'like', '%' . $_GET['search'] . '%');
                    $q->orWhereHas('market', function($qr){
                        $qr->where('market', 'like', '%' . $_GET['search'] . '%');
                    });
                });

            });
        }

        $appointments = $appointments->select('stall_appointments.*')->join('sellers', 'stall_appointments.seller_id', '=', 'sellers.id')
        ->join('users', 'users.id', '=', 'sellers.user_id');
        
        $orderby = '';
        if(isset($_GET['orderby'])){
            if($_GET['orderby'] == 'A-Z'){
                $orderby = ['users.first_name', 'asc'];

            }

            else if($_GET['orderby'] == 'Z-A'){
                $orderby = ['users.first_name', 'desc'];

            }
            else if($_GET['orderby'] == 'recent'){
                $orderby = ['created_at', 'desc'];
                
            }

            else if($_GET['orderby'] == 'oldest'){
                $orderby = ['created_at', 'asc'];
                
            }
            
        }else{
            $orderby = ['users.first_name', 'asc'];

        }

        $appointments->orderBy($orderby[0], $orderby[1]);
       

        $appointments = $appointments->paginate(10);


        return view('admin/appointments/index', compact(['appointments']));

    }

    public function approve(Request $request){
        $appointment = StallAppointment::where(['status' => 'Pending'])->findOrFail($request->id);
        $data = [];
        if($appointment){
            $data['status'] = 'approved';

            if($appointment->update($data)){
                return redirect(route('admin.appointments.show'))->with(['message'. '']);
            }

        }else{
            return false;
        }
    }

    public function cancel(){

    }
}
