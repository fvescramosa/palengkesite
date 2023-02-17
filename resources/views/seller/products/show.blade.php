@extends('layouts.seller')

@section('content')
    <div class="container">
        <div class="profile">
            <div class="profile-wrapper">
                <h3>Products</h3>
                <table class="table table-bordered">
            <thead>
                <tr>

                    <th>Product Name</th>
                    <th>SRP</th>
                    <th>Price</th>
                    <th>Code</th>
                    <th>Category</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
            @foreach($seller_products as $seller_product)
                @if($seller_product->product->status == 'active')
                    <tr>
                        <td>{{ $seller_product->product->product_name }}</td>
                        <td>{{ $seller_product->product->srp }}</td>
                        <td>{{ $seller_product->price }}</td>
                        <td>{{ $seller_product->product->code }}</td>
                        <td>{{ $seller_product->product->category->category }}</td>
                        <td>{{ $seller_product->type }}</td>
                        <td><a href="{{ route('seller.products.edit', $seller_product->id) }}">Edit</a></td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('seller.products.create') }}" class="info-header-edit"> <i class="fa fa-plus-circle"></i></a>
            </div>
        </div>
    </div>
@endsection
