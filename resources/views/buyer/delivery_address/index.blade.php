@extends('layouts.buyer')

@section('content')
    <div class="delivery-address">
       <div class="delivery-address-wrapper">
            <h3>My address</h3>

           <hr>


              @foreach($addresses as $address)

                <div class="my-delivery-address-list">
                   <div class="my-delivery-address-item">
                       <div class="my-delivery-address-details">
                           <div class="details-up">
                               <div>
                                   <p class="delivery-address-detail-date">
                                       {{ $address->stnumber  .' '. $address->barangay .', '. $address->city .', '.  $address->province .', '.  $address->country .' '.  $address->zip }}
                                   </p>
                                   <p class="delivery-address-detail-no"></p>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>



                  
              @endforeach

           <a href="{{ route('buyer.delivery.address.create') }}" class="info-header-edit"> <i class="fa fa-plus-circle"></i></a>

       </div>
   </div>

@endsection
