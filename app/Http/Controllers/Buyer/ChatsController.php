<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use App\Http\Controllers\Controller;
use App\Message;
use App\Seller;
use App\SellerStall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {


        $titles =  Message::where('buyer_id', auth()->user()->buyer->id)
            ->whereHas('seller')
            ->with(['seller', 'seller.seller_stalls'])
            ->select(DB::raw('COUNT(*) as count'), DB::raw('seller_id'))

            ->groupBy('seller_id')->get();



//        $messages = Message::where('buyer_id', auth()->user()->buyer->id)->groupBy('seller_id')->distinct()->get();


        return view('buyer.chat', compact(['titles']));
    }


    public function seller($id)
    {

//        $seller_stall = $id;
//        $seller_stall = $id;
        //left side

//        $seller =  Seller::whereHas('seller_stalls')->where('id', $id)->firstOrFail();
        $seller_stall =  SellerStall::whereHas('seller')->findOrFail($id);

        $seller_id = $seller_stall->seller_id;


        $titles =  Message::where('buyer_id', auth()->user()->buyer->id)
            ->whereHas('seller')
            ->with(['seller', 'seller.seller_stalls'])
            ->select(DB::raw('COUNT(*) as count'), DB::raw('seller_id'))

            ->groupBy('seller_id')->get();

//        dd($titles);
//        $messages = Auth::user()->buyer->messages->groupBy('seller_id');


        //main panel
        $chats = Auth::user()->buyer->messages->where('seller_id', $id);

        return view('buyer.chat', compact([ 'chats', 'seller_id', 'titles', 'seller_stall']));
    }

    public function sendMessage(Request $request, $id)
    {

        $message = Message::create([
            'seller_id' => $id,
            'buyer_id' => auth()->user()->buyer->id,
            'message' => $request->message,
            'sender' => 'buyer',
        ]);

        if ($message->save()) {
            return ['response' => 'successs', 'message' => 'sent'];
        } else{
          return ['response' => 'error', 'message' => 'failed'];
        }
    }


    public function fetchAllMessages($id){
        $chats = Auth::user()->buyer->messages->where('seller_id', $id);

        $response = '';
        foreach ($chats as $chat){
            $response .= '<li class="left clearfix '. ($chat->sender == 'buyer' ? 'user' : '') .'">
                                       <div class="chat-body clearfix">
                                           <div class="">
                                               <strong class="primary-font">
                                                 '.($chat->sender == 'buyer' ? '<span class="fa fa-user-alt"></span> Me' : '<span class="fa fa-store"></span> '.$chat->seller->seller_stalls->name ).'
                                                
                                               </strong>
                                           </div>
                                           <p>
                                              '.$chat->message.'
                                           </p>
                                       </div>
                                    </li>';
        }

        return $response;
    }
}
