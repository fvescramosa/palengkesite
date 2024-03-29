@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="profile">
            <div class="profile-wrapper">
                <form action="" method="GET"  class="form-group list-header" id="form-header">
                        <h3>Stalls</h3>

                        <div class="list-header-fields">

                            <div class="form-group">
                                <label for="search">Search</label>
                                <input  class="form-control" type="text" name="search" id="search" value="{{ old('search') ??  $_GET['search']  ?? '' }}" placeholder="Search">
                            </div>


                            <div class="form-group">
                                <label for="search">Sort</label>
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
                
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Stall No.</th>
                            <th>Coordinates</th>
                            <th>Section</th>
                            <th>Sqm / Area</th>
                            <th>Amount per sqm</th>
                            <th>Rental Fee</th>
                            <th>Rate</th>
                            <th>Meter Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stalls as $stall)
                            <tr>
                                <td>{{ $stall->number }}</td>
                                <td>{{ $stall->coords }}</td>
                                <td>{{ $stall->section }}</td>
                                <td>{{ $stall->sqm }}</td>
                                <td>{{ $stall->amount_sqm }}</td>
                                <td>{{ $stall->rental_fee }}</td>
                                <td>{{ $stall->rate }}</td>
                                <td>{{ $stall->meter_num }}</td>
                                <td>{{ $stall->status }}</td>
                                <td>
                                    <a href="{{ route('admin.stalls.edit', $stall->id) }}">Edit</a> |
                                    <a href="{{ route('admin.stalls.delete', $stall->id) }}"> Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                @if( isset($_GET ) )
                {{$stalls->appends($_GET)->links()}}

                @else
                    {{$stalls->links()}}
                @endif

                <a href="{{ route('admin.stalls.create') }}" class="info-header-edit"> <i class="fa fa-plus-circle"></i></a>
            </div>
        </div>
    </div>
@endsection
