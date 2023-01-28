@extends('layouts.admin')

@section('content')
<div class="container">
        <div class="profile">
            <div class="profile-wrapper">
                <div class="list-header">
                    <h3>Users</h3>
                    <form action="" method="GET" id="sortlist">
                        <select  class="form-control" id="orderby" name="orderby" placeholder="Order By" value="" >
                            <option value="A-Z"     <?=  ( isset( $_GET['orderby'] ) ?  ( $_GET['orderby'] == 'A-Z' ) ? 'selected' : '' : '' ); ?>>Name (A-Z)</option>
                            <option value="Z-A"     <?=  ( isset( $_GET['orderby'] ) ?  ( $_GET['orderby'] == 'Z-A' ) ? 'selected' : '' : '' ); ?>>Name (Z-A)</option>
                            <option value="recent"  <?=  ( isset( $_GET['orderby'] ) ?  ( $_GET['orderby'] == 'recent' ) ? 'selected' : '' : '' ); ?>>Recent</option>
                            <option value="oldest"  <?=  ( isset( $_GET['orderby'] ) ?  ( $_GET['orderby'] == 'oldest' ) ? 'selected' : '' : '' ); ?>>Oldest</option>
                        </select>
                    </form>
                </div>
                
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
                                <a href="{{ route('admin.staffs.recover', $staff->id) }}"> Retrieve </a> | 
                                <a href="{{ route('admin.staffs.permanentdelete', $staff->id) }}" title="Permanent Delete">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @if( isset($_GET['orderby'] ) )
                {{$staffs->appends(['orderby' => $_GET['orderby']])->links()}}
                @else
                {{$staffs->links()}}
                @endif
                <!-- <a href="{{ route('admin.stalls.create') }}" class="info-header-edit"> <i class="fa fa-plus-circle"></i> Create</a> -->
            </div>
        </div>
    </div>
@endsection


</script>