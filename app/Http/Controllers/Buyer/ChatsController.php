<?php

namespace App\Http\Controllers\Buyer;

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


            $messages = Auth::user()->buyer->messages->groupBy('seller_id');


//        $messages = Message::where('buyer_id', auth()->user()->buyer->id)->groupBy('seller_id')->distinct()->get();


        return view('buyer.chat', compact(['messages']));
    }


    public function seller($id)
    {

        $seller_id = $id;
        //left side
        $messages = Auth::user()->buyer->messages->groupBy('seller_id');

        //main panel
        $chats = Auth::user()->buyer->messages->where('seller_id', $id);

        return view('buyer.chat', compact(['messages', 'chats', 'seller_id']));
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
