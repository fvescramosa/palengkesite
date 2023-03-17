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
                    <form action="{{ route('seller.products.update') }}" method="POST" class="form-"  enctype="multipart/form-data">
                        @csrf
                        <div class="info-body-flex">

                                <div class="info-item form-group short">
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
                                <div class="info-item form-group short">
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

                                <div class="info-item form-group short">
                                    <label for="Product">Custom Name</label>
                                    <input type="text"
                                           class="form-control @error('custom_title') is-invalid @enderror"
                                           id="custom_title" name="custom_title"
                                           placeholder=""
                                           value="{{ $seller_product->custom_title }}" >

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="info-item form-group short">
                                    <label for="Product">Description</label>
                                    <textarea type="text"
                                           class="form-control @error('description') is-invalid @enderror"
                                           id="description" name="description" rows="10"
                                           placeholder=""
                                              value="" >{{ $seller_product->description }}</textarea>

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror

                                </div>
                                <div class="info-item form-group xshort">
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

                                <div class="info-item form-group xshort">
                                    <label for="Product">Stocks</label>
                                    <input type="number"
                                           class="form-control @error('stock') is-invalid @enderror"
                                           id="stock" name="stock"
                                           placeholder="Stocks"
                                           value="{{ $seller_product->stock }}" >

                                    @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="info-item form-group short">
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

                                <div class="info-item form-check-inline short">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="featured" id="featured"  value="1" {{ ($seller_product->featured) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Featured') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="form-group long  stall-image">

                                        <label class=" " for="image">Image</label>
                                        <input type="file"  class="@error('image') is-invalid @enderror"
                                               id="image"
                                               name="image"
                                               placeholder="" value="" >

                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>

                                    <div id="stall_image_1" class="form-group long  stall-image hide">
                                        <label for="image">Image</label>
                                        <input type="file"  class="form-control @error('image_1') is-invalid @enderror"
                                               id="image_1"
                                               name="image_1"
                                               placeholder="" value="" >

                                        @error('image_1')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>

                                    <div id="stall_image_2" class="form-group long  stall-image hide">
                                        <label for="image">Image</label>
                                        <input type="file"  class="form-control @error('image_2') is-invalid @enderror"
                                               id="image_2"
                                               name="image_2"
                                               placeholder="" value="" >

                                        @error('image_2')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>

                                    <div id="stall_image_3" class="form-group long  stall-image hide">
                                        <label for="image">Image</label>
                                        <input type="file"  class="form-control @error('image_3') is-invalid @enderror"
                                               id="image_3"
                                               name="image_3"
                                               placeholder="" value="" >

                                        @error('image_3')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>

                                    <div id="stall_image_4" class="form-group long  stall-image hide">
                                        <label for="image">Image</label>
                                        <input type="file"  class="form-control @error('image_4') is-invalid @enderror"
                                               id="image_4"
                                               name="image_4"
                                               placeholder="" value="" >

                                        @error('image_4')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>

                                    <div id="stall_image_5" class="form-group long  stall-image hide">
                                        <label for="image">Image</label>
                                        <input type="file"  class="form-control @error('image_5') is-invalid @enderror"
                                               id="image_5"
                                               name="image_5"
                                               placeholder="" value="" >

                                        @error('image_5')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>

                                    <div class="form-group short">
                                        <button type="button" id="addImage" class="btn option-btn"><span class="fa fa-plus-circle"> </span> Add Image</button>
                                    </div>
                                </div>


                                <input type="hidden"
                                       class="form-control @error('id') is-invalid @enderror"
                                       id="id" name="id"
                                       placeholder="id"
                                       value="{{ $seller_product->id }}" >
                        </div>
                        <div class="row-btn">
                            <div class="btn-container" style="padding: 0 10px 15px;">
                                <button type="submit" class="btn btn-primary" style="font-size: 11px; padding: 8px;">
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
                products.addImage($('#addImage'));
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

            },
            addImage: function (trigger) {
                trigger.click(function () {

                    var counter  = $('.stall-image').not('.hide').length;

                    console.log(counter);

                    $('#stall_image_' + counter).removeClass('hide');

                })
            }
        };

        $(window).on('load', function(){
            products.init();
        });

    </script>




@endsection
