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

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('admin.show.seller', $user->id) }}">View</a> | 
                                <a href="{{ route('admin.users.edit', $user->id) }}">Edit</a> | 
                                <a href="{{ route('admin.sellers.delete', $user->id) }}"> Delete </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @if( isset($_GET['orderby'] ) )
                {{$users->appends(['orderby' => $_GET['orderby']])->links()}}
                @else
                {{$users->links()}}
                @endif
                <!-- <a href="{{ route('admin.stalls.create') }}" class="info-header-edit"> <i class="fa fa-plus-circle"></i> Create</a> -->
            </div>
        </div>
    </div>
@endsection


</script>