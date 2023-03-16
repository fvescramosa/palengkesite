@extends('layouts.admin')

@section('content')
<div class="container">
        <div class="profile">
            <div class="profile-wrapper">

               
                <form action="" method="GET"  class="form-group list-header" id="form-header">
                    <h3>Users</h3>

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
                
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($staffs as $staff)
                            <tr>
                                <td>{{ $staff->name }}</td>
                                <td>{{ $staff->email }}</td>
                                <td>
                                    <a href="{{ route('admin.edit.staff', $staff->id) }}">Edit</a> | 
                                    <a href="{{ route('admin.staffs.delete', $staff->id) }}"> Delete </a>
                                
                                </td>
                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @if( isset($_GET) )
                {{$staffs->appends($_GET)->links()}}
                @else
                {{$staffs->links()}}
                @endif
                <a href="{{ route('admin.register') }}" class="info-header-edit"> <i class="fa fa-plus-circle"></i></a>
            </div>
        </div>
    </div>
@endsection
