@extends('layouts.buyer')

@section('content')
    <div class="profile">
       <div class="profile-wrapper">
           <div class="card basic-info" style="width: 18rem;">
               <div class="card-header basic-info-header">
                   Basic Information
               </div>
                <div class="basic-info-body">
                    <div class="info-body-flex">
                        <div class="form-group info-item short">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name"  placeholder="First Name" value="{{ auth()->user()->first_name }}" readonly>
                        </div>
                        <div class="form-group info-item short">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name"  placeholder="Last Name" value=" {{ auth()->user()->last_name }}" readonly>
                        </div>

                        <div class="form-group info-item short">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email"  placeholder="Email" value=" {{ auth()->user()->email }}" readonly>
                        </div>


                        @if(auth()->user()->buyer()->exists())
                            <div class="form-group info-item short">
                                <label for="email">Birthday</label>
                                <input type="text" class="form-control" id="birthday"  placeholder="Birthday" value="{{ date('m/d/Y', strtotime(auth()->user()->buyer->birthday)) }}" readonly>
                            </div>

                            <div class="form-group info-item xshort">
                                <label for="email">Age</label>
                                <input type="text" class="form-control" id="age"  placeholder="Age" value="{{ auth()->user()->buyer->age }}" readonly>
                            </div>

                            <div class="form-group info-item xshort">
                                <label for="email">Gender</label>
                                <input type="text" class="form-control" id="age"  placeholder="Age" value="{{ auth()->user()->buyer->gender }}" readonly>
                            </div>

                            <div class="form-group info-item xshort">
                                <label for="email">Gender</label>
                                <input type="text" class="form-control" id="age"  placeholder="Age" value="{{ auth()->user()->buyer->gender }}" readonly>

                            </div>

                            <div class="form-group info-item long">
                                <label for="email">Address</label>
                                <input type="text" class="form-control" id="age"  placeholder="Age" value="{{ auth()->user()->buyer->stnumber  .' '. auth()->user()->buyer->stname .', '. auth()->user()->buyer->city .', '.  auth()->user()->buyer->province .', '.  auth()->user()->buyer->country .' '.  auth()->user()->buyer->zip }}" readonly>

                            </div>

                            <a href="{{ route('buyer.switch.seller') }}" class="btn btn-primary">Switch as Seller</a>

                         @endif
                    </div>
                </div>
           </div>
       </div>
    </div>
@endsection
