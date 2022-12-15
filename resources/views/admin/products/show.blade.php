@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="profile">
            <div class="profile-wrapper">
                <h3>Products</h3>
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
                    <td><a href="{{ route('admin.products.edit', $product->id) }}">Edit</a></td>
                    <td><a href="{{ route('admin.pricing.show', $product->id) }}"><span class="fa fa-eye"> </span> View Pricing</a></td>

                </tr>
            @endforeach
            </tbody>
        </table>
            </div>
        </div>
    </div>
@endsection
