@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="profile">
            <div class="profile-wrapper">
                <form action="" method="GET"  class="form-group list-header" id="form-header">
                    <h3>Products</h3>

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

                @if (session('message'))
                    <div class="alert alert-{{ (session('success') ? 'success' : 'danger') }}">
                        <strong>{{ session('message')  }}</strong>
                    </div>
                @endif

                <table class="table table-bordered">
                <thead>
                <tr>

                    <th>Product Name</th>
                    <th>Min Price</th>
                    <th>Max Price</th>
                    <th>SRP</th>
                    <th>Category</th>
                    <th>Code</th>
                    <th>Manufacturer</th>
                    <th>Type</th>
                    <th>Pricing</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->min_price }}</td>
                    <td>{{ $product->max_price }}</td>
                    <td>{{ $product->srp }}</td>
                    <td>{{ $product->category->category }}</td>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->manufacturer }}</td>
                    <td>{{ $product->type }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}">Edit</a>
                        <a href="{{ route('admin.products.delete', $product->id) }}">Delete</a>
                    </td>
                    <td>
                        @if($product->status == 'active')
                            {{ $product->status }}
                        @else
                            <a href="{{ route('admin.products.approve', ['id' => $product->id]) }}"  class="btn btn-primary"> Approve</a>
                        @endif
                    </td>
                    <td><a href="{{ route('admin.pricing.show', $product->id) }}"><span class="fa fa-eye"> </span> View Pricing</a></td>

                </tr>
            @endforeach
            </tbody>
        </table>
        
        @if( isset($_GET) )
        {{$products->appends($_GET)->links()}}
        @else
        {{$products->links()}}
        @endif

        <a href="{{ route('admin.products.create') }}" class="info-header-edit"> <i class="fa fa-plus-circle"></i></a>
            </div>
        </div>
    </div>
@endsection
