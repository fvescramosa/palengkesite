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
        
        })->get();


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
