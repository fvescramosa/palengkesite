@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="profile">
            <div class="profile-wrapper">
                <form action="" method="GET"  class="form-group list-header" id="form-header">
                    <h3>Stall Appointments</h3>

                    <div class="list-header-fields">
                        
                        <div class="form-group">
                            <input  class="form-control" type="text" name="search" id="search" value="{{ old('search') ??  $_GET['search']  ?? '' }}" placeholder="Search">
                        </div>

                        
                        <div class="form-group">
                            <select  class="form-control" id="orderby" name="orderby" placeholder="Order By" value="" >
                                <option value="A-Z"     <?=  ( isset( $_GET['orderby'] ) ?  ( $_GET['orderby'] == 'A-Z' ) ? 'selected' : '' : '' ); ?>>Name (A-Z)</option>
                                <option value="Z-A"     <?=  ( isset( $_GET['orderby'] ) ?  ( $_GET['orderby'] == 'Z-A' ) ? 'selected' : '' : '' ); ?>>Name (Z-A)</option>
                                <option value="recent"  <?=  ( isset( $_GET['orderby'] ) ?  ( $_GET['orderby'] == 'recent' ) ? 'selected' : '' : '' ); ?>>Recent</option>
                                <option value="oldest"  <?=  ( isset( $_GET['orderby'] ) ?  ( $_GET['orderby'] == 'oldest' ) ? 'selected' : '' : '' ); ?>>Oldest</option>
                            </select>
                        </div>

                        @if(isset($_GET['page']))
                            <input type="hidden" name="page" value="{{ $_GET['page'] }}">
                        @endif
                    </div>
                </form>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Seller</th>
                        <th>Stall No.</th>
                        <th>Market</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->seller->user->first_name }} {{ $appointment->seller->user->last_name }}</td>
                            <td> {{ $appointment->stall->number }}</td>
                            <td> {{ $appointment->stall->market->market }}</td>
                            <td> {{ $appointment->date }}</td>
                            <td> {{ $appointment->status }}</td>
                            <td>
                                @if($appointment->status == 'pending')
                                    <form action="{{ route('admin.appointments.approve') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{  $appointment->id   }}">
                                        <button type="submit" target="_blank" class="btn btn-primary"> Approve</button>
                                    </form>
                                @else
                                    <div>{{ $appointment->status }}</div>
                                @endif

                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @if( isset($_GET) )
                {{$appointments->appends($_GET)->links()}}
                @else
                {{$appointments->links()}}
                @endif
            </div>
        </div>
    </div>
@endsection
