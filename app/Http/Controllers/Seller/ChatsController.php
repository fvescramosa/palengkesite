<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {


            $messages = Auth::user()->seller->messages->groupBy('buyer_id');


//        $messages = Message::where('buyer_id', auth()->user()->buyer->id)->groupBy('seller_id')->distinct()->get();


        return view('seller.chat', compact(['messages']));
    }


    public function seller($id)
    {

        $buyer_id = $id;
        //left side
        $messages = Auth::user()->seller->messages->groupBy('buyer_id');

        //main panel
        $chats = Auth::user()->seller->messages->where('buyer_id', $id);

        return view('seller.chat', compact(['messages', 'chats', 'buyer_id']));
    }

    public function sendMessage(Request $request, $id)
    {

        $message = Message::create([
            'buyer_id' => $id,
            'seller_id' => auth()->user()->seller->id,
            'message' => $request->message,
            'sender' => 'seller',
        ]);

        if ($message->save()) {
            return ['response' => 'successs', 'message' => 'sent'];
        } else{
          return ['response' => 'error', 'message' => 'failed'];
        }
    }


    public function fetchAllMessages($id){
        $chats = Auth::user()->seller->messages->where('buyer_id', $id);

        $response = '';
        foreach ($chats as $chat){
            $response .= '<li class="left clearfix '. ($chat->sender == 'seller' ? 'user' : '') .'">
                                       <div class="chat-body clearfix">
                                           <div class="">
                                               <strong class="primary-font">
                                                 '.($chat->sender == 'seller' ? '<span class="fa fa-store"></span></span> Me' : '<span class="fa fa-user-alt"> '.$chat->buyer->user->first_name ).'
                                                
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
