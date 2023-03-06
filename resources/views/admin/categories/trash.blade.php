@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="profile">
            <div class="profile-wrapper">
                <h3>Categories</h3>

                @if (session('message'))
                    <div class="alert alert-{{ (session('success') ? 'success' : 'danger') }}">
                        <strong>{{ session('message')  }}</strong>
                    </div>
                @endif
                
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>

                                <th>Category</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->category }}</td>
                                <td><img src="{{ asset('public/Image/'.$category->image)  }}" alt=""></td>
                                <td>
                                  <a href="{{ route('admin.categories.recover', $category->id) }}"> Retrieve </a> | 
                                  <a href="{{ route('admin.categories.permanentdelete', $category->id) }}" title="Permanent Delete">Delete</a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
