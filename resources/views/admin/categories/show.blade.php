@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="profile">
        <div class="profile-wrapper">
                <form action="" method="GET"  class="form-group list-header" id="form-header">
                        <h3>Categories</h3>

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
                        </div>
                </form>

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
                                    <a href="{{ route('admin.categories.edit', $category->id) }}">Edit</a> |
                                    <a href="{{ route('admin.categories.delete', $category->id) }}">Delete</a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('admin.categories.create') }}" class="info-header-edit"> <i class="fa fa-plus-circle"></i></a>
            </div>
        </div>
    </div>
@endsection
