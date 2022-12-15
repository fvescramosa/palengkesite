@extends('layouts.seller')


@section('content')
    <div class="profile">
       <div class="profile-wrapper">
           <h2>Do you already have a Stall?</h2>

           <a href="{{ route('seller.stalls.create.details') }}" class="btn btn-primary"> Yes </a>
           <a href="{{ route('seller.stalls.select') }}" class="btn btn-primary"> No </a>
       </div>
    </div>
@endsection

