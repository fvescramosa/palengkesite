@extends('layouts.seller')

@section('content')




    <div class="profile">
        <div class="profile-wrapper">
            <div class="card basic-info" style="width: 18rem;">
                <div class="card-header basic-info-header">
                    Product Information
                </div>
                <div class="basic-info-body">

                    @if(isset($message))
                        <strong>{{ $message  }}</strong>
                    @endif
                    <form action="{{ route('seller.products.update') }}" method="POST" class="form-">
                        @csrf
                        <div class="info-body-flex">

                                <div class="info-item short">
                                    <label for="email">Product Categories</label>
                                    <select  class="form-control @error('category') is-invalid @enderror" id="category" name="category" placeholder="Category">
                                        <option value="{{ $seller_product->product->category->id }}">{{ $seller_product->product->category->category }}</option>
                                    </select>
                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="info-item short">
                                    <label for="Product">Product</label>
                                    <select  class="form-control @error('product') is-invalid @enderror" id="product" name="product" placeholder="Product" value="" >
                                        <option value="{{ $seller_product->product->id }}">{{ $seller_product->product->product_name }}</option>
                                    </select>
                                    @error('product')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="info-item short">
                                    <label for="Product">Price</label>
                                    <input type="text"
                                           class="form-control @error('price') is-invalid @enderror"
                                           id="price" name="price"
                                           placeholder="Price"
                                           value="{{ $seller_product->price }}" >

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="info-item short">
                                    <label for="type">Type</label>
                                    <select  class="form-control @error('type') is-invalid @enderror" id="type" name="type" placeholder="Type"  >
                                        <option value="Retail" {{ ( $seller_product->type == 'Retail' ) ? 'selected' : '' }}>Retail</option>
                                        <option value="Wholesale" {{ ($seller_product->type == 'Wholesale' ) ? 'selected' : '' }}>Wholesale</option>
                                    </select>
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            <input type="hidden"
                                   class="form-control @error('id') is-invalid @enderror"
                                   id="id" name="id"
                                   placeholder="id"
                                   value="{{ $seller_product->id }}" >
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const products = {
            init: function(  ){
                products.initCategories($('#category'));
            },
            initCategories: function( trigger ){

                    var options = '';
                    console.log($('#category').val());
                    $.ajax({
                        type:'POST',
                        dataType: 'JSON',
                        url:'{{ route('seller.products.find.category') }}',
                        data: {
                            id: $('#category').val(),
                            _token: "{{ csrf_token() }}"
                        },
                        success:function(data) {


                            for( i = 0; i < data.length; i++){

                                options += '<option value="'+ data[i].id +'">' + data[i].product_name + '</option>';

                            }

                            $('#product').append(options);
                        }
                    });

            }
        };

        $(window).on('load', function(){
            products.init();
        });

    </script>




@endsection
