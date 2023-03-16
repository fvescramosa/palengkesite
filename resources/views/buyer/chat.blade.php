@extends('layouts.buyer')
@section('content')


    {{$message ?? ''}}

    <div class="chat">
       <div class="chat-wrapper">
           <div class="chat-list">


                <ul class="chat">

                    @foreach($titles as $title)
                            {{--It means buyer talking to seller--}}
                           <li class="left clearfix">
                                <a href="{{ route('buyer.chat.seller', ['id' => $title->seller->seller_stalls['id']]) }}"> {{ $title->seller->seller_stalls['name'] }}</a>
                            </li>



                         {{--   <li class="left clearfix">
                                <a href="{{ route('buyer.chat.seller', ['id' => $stall->id]) }}">{{ $stall->name }}</a>
                            </li>--}}

                    @endforeach
                </ul>
           </div>
           <div class="chat-messages">
               @isset($chats)
               <div class="panel panel-default">
                   <div class="panel-heading">
                       <h3 ></h3>
                   </div>
                   <div class="panel-body">
                            <h3><strong>{{ \App\Seller::find($seller_id)->seller_stalls->name }}</strong></h3>
                       <hr>
                           <ul class="chat" id="chatboard" data-action="{{ route('buyer.chat.fetchAllMessages', ['id' => $seller_id]) }}">
                                   @foreach($chats as $chat)
                                        <li class="left clearfix {{ ($chat->sender == 'buyer' ? 'user' : '') }}">
                                           <div class="chat-body clearfix ">
                                               <div class="">
                                                   <strong class="primary-font">
                                                     @if($chat->sender == 'buyer')
                                                           <span class="fa fa-user-alt"></span> Me
                                                     @else
                                                         <span class="fa fa-store"></span> {{ $chat->seller->seller_stalls->name }}
                                                     @endif

                                                   </strong>
                                               </div>
                                               <p>
                                                   {{ $chat->message }}
                                               </p>
                                           </div>
                                        </li>
                                   @endforeach
                           </ul>

                    </div>
               </div>
               <div class="panel-footer">
                   <form action="{{ route('buyer.chat.sendMessage', ['id' => $seller_id]) }}" method="POST" id="chatform">
                        @csrf
                       <div class="input-group">
                           <input id="btn-input" type="text"
                                  name="message"
                                  class="form-control input-sm"
                                  placeholder="Type your message here..." >

                           <input type="hidden" name="seller_id" id="{{  $seller_id }}">
                           <input type="hidden" name="buyer_id" id="{{  auth()->user()->buyer->id }}">
                           <span class="input-group-btn">
                                <button class="btn btn-primary btn-sm" type="submit" id="btn-chat">
                                    Send
                                </button>
                            </span>
                       </div>
                   </form>

                </div>
               @endisset
           </div>
       </div>
    </div>

    <script>

        let doc = $(document);
        var chat = {
            onInit: function () {
                chat.sendMessageOnSubmit($('#btn-chat'));
                // chat.submitForm($('#chat-form'));
                setInterval( function () {
                    chat.fetchAllMessage();
                }, 10000)

                $('#chatform').submit( function (e) {
                    e.preventDefault();
                    var data = $(this).serialize();

                    // alert(dataString); return false;
                    $.ajax({
                        type: "POST",
                        url: $( "#chatform" ).attr('action'),
                        data: data,
                        success: function (data) {
                            // $("#contact_form").html("<div id='message'></div>");

                            chat.fetchAllMessage();

                        }
                    });

                    let h = $(document).height();
                    $('#chatboard').animate({ scrollTop:  $("#chatboard").scrollTop() }, 1000);
                });

            },

            sendMessageOnSubmit: function(trigger){

                trigger.click(function(){

                    console.log('test');

                });
            },
            fetchAllMessage: function () {
                $.ajax({
                    type: "GET",
                    url: $( "#chatboard" ).attr('data-action'),
                    data: '',
                    success: function (data) {

                        $("#chatboard").html(data);
                    }
                });
            },

            submitMessageForm: function (trigger) {

            }
        }
        doc.ready(function () {
            chat.onInit()
        })
    </script>
@endsection
