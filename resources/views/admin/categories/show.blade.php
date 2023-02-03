@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="profile">
            <div class="profile-wrapper">
                <h3>Categories</h3>
                <table class="table table-bordered">
            <thead>
                <tr>

                    <th>Category</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->category }}</td>
                    <td><a href="{{ route('admin.categories.edit', $category->id) }}">Edit</a></td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('admin.categories.create') }}" class="info-header-edit"> <i class="fa fa-plus-circle"></i></a>
            </div>
        </div>
    </div>
@endsection
