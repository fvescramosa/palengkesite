@extends('layouts.admin')

@section('content')
<div class="container">
        <div class="profile">
            <div class="profile-wrapper">
                <div class="list-header">
                    <h3>Products</h3>
                    <!-- <form action="" method="GET" id="sortlist">
                        <select  class="form-control" id="orderby" name="orderby" placeholder="Order By" value="" >
                            <option value="A-Z"     <?=  ( isset( $_GET['orderby'] ) ?  ( $_GET['orderby'] == 'A-Z' ) ? 'selected' : '' : '' ); ?>>A-Z</option>
                            <option value="Z-A"     <?=  ( isset( $_GET['orderby'] ) ?  ( $_GET['orderby'] == 'Z-A' ) ? 'selected' : '' : '' ); ?>>Z-A</option>
                            <option value="recent"  <?=  ( isset( $_GET['orderby'] ) ?  ( $_GET['orderby'] == 'recent' ) ? 'selected' : '' : '' ); ?>>Recent</option>
                            <option value="oldest"  <?=  ( isset( $_GET['orderby'] ) ?  ( $_GET['orderby'] == 'oldest' ) ? 'selected' : '' : '' ); ?>>Oldest</option>
                        </select>
                    </form> -->
                </div>
                
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
                            <td>
                                <a href="{{ route('admin.products.recover', $product->id) }}"> Recover </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- <a href="{{ route('admin.stalls.create') }}" class="info-header-edit"> <i class="fa fa-plus-circle"></i> Create</a> -->
            </div>
        </div>
    </div>
@endsection


</script>