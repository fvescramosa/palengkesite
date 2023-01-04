@extends('layouts.admin')

@section('content')
<div class="container">
        <div class="profile">
            <div class="profile-wrapper">
                <h3>Users</h3>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><a href="{{ route('admin.users.edit', $user->id) }}">Edit</a></td>
                            <td><a href="{{ route('admin.show.seller', $user->id) }}">View</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- <a href="{{ route('admin.stalls.create') }}" class="info-header-edit"> <i class="fa fa-plus-circle"></i> Create</a> -->
            </div>
        </div>
    </div>
@endsection
