@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="profile">
            <div class="profile-wrapper">

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
                                    <a href="{{ route('admin.developers.edit', $developer->id) }}">Edit</a> |
                                    {{--<a href="{{ route('admin.developer.delete', $developer->id) }}">Delete</a>--}}
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
        
      {{--  @if( isset($_GET) )
        {{$developers->appends($_GET)->links()}}
        @else
        {{$developers->links()}}
        @endif
--}}
        <a href="{{ route('admin.developers.create') }}" class="info-header-edit"> <i class="fa fa-plus-circle"></i></a>
            </div>
        </div>
    </div>


@endsection
