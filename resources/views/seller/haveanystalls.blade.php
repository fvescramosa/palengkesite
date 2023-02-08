@extends('layouts.seller')


@section('content')
    <div class="have-stall">
       <div class="stall-wrapper">
           <h2>Already Have a Stall?</h2>

           <div class="stall-btn-container">

            <a href="{{ route('seller.stalls.has.select') }}" class="btn btn-primary" style="padding: 10px 28px;font-size: 12px;"> Yes </a>
            <a href="{{ route('seller.stalls.select') }}" class="btn btn-primary" style="padding: 10px 28px;font-size: 12px;"> No </a>

           </div>
       </div>
    </div>
@endsection

