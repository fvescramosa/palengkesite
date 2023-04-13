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

                            <div class="form-group">
                                <label for="search">Status</label>
                                <select  class="form-control" type="text" name="status" id="status"  placeholder="Status">
                                    <option value="">All</option>
                                    <option value="vacant" <?=  ( isset( $_GET['status'] ) ?  ( $_GET['status'] == 'vacant' ) ? 'selected' : '' : '' ); ?>>Vacant</option>
                                    <option value="occupied" <?=  ( isset( $_GET['status'] ) ?  ( $_GET['status'] == 'occupied' ) ? 'selected' : '' : '' ); ?>>Occupied</option>
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
                            <th>Area in sqm</th>
                            <th>Amount per sqm / Rate</th>
                            <th>Rental Fee</th>
                            <th>Annual Fee</th>
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
                                <td>{{ $stall->annual_fee }}</td>
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


                <a href="{{ route('admin.stalls.export') }}?{{ $request->getQueryString() }}" class="btn btn-primary"><span class="fa fa-download"></span> Downloads</a>
            </div>
        </div>
    </div>
@endsection
