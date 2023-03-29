@extends('layouts.admin')

@section('content')
<div class="container">
        <div class="profile">
            <div class="profile-wrapper">
                <h3>Users</h3>
                
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($developers as $developer)
                            <tr>
                                <td><img src="{{ asset($developer->photo) }}" alt=""></td>
                                <td>{{ $developer->name }}</td>
                                <td>
                                    <a href="{{ route('admin.developers.recover', $developer->id) }}"> Retrieve </a> |
                                    <a href="{{ route('admin.developers.permanentdelete', $developer->id) }}">Delete</a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- <a href="{{ route('admin.stalls.create') }}" class="info-header-edit"> <i class="fa fa-plus-circle"></i> Create</a> -->
            </div>
        </div>
    </div>
@endsection


</script>