@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="profile">
            <div class="profile-wrapper">
                <h3>Sellers with <strong>{{ $products->product_name }}</strong></h3>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>

                                <th>Seller Name</th>
                                <th>Stall No.</th>
                                <th>Selling Type</th>
                                <th>Seller Pricing</th>
                                <th>SRP</th>
                                <th>Min Price</th>
                                <th>Max Price</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($products->seller_products as $product)
                            <tr>

                                <td>  {{ $product->seller->user->first_name }} {{ $product->seller->user->last_name }}</td>
                                <td> {{ $product->seller->seller_stalls->stall->number }}</td>
                                <td> {{ $product->type }}</td>
                                <td> Php {{ ($product->price) ? number_format($product->price, 2) : ''  }}</td>
                                <td> Php {{ ($products->srp) ? number_format($products->srp, 2) : '' }}</td>
                                <td> Php {{ ($products->min_price) ? number_format($products->min_price, 2) : '' }}</td>
                                <td> Php {{ ($products->max_price) ? number_format($products->max_price, 2) : '' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
