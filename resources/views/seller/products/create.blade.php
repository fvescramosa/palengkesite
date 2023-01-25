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
                    <form action="{{ route('seller.products.store') }}" method="POST" class="form-">
                        @csrf
                        <div class="info-body-flex">

                                <div class="info-item short">
                                    <label for="email">Product Categories</label>
                                    <select  class="form-control @error('category') is-invalid @enderror" id="category" name="category" placeholder="Category" value="" >
                                            <option value="">{{ 'Category' }}</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                                            @endforeach
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

                                    </select>
                                    @error('product')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="info-item short">
                                    <label for="Product">Price</label>
                                    <input type="text"  class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Price" value="" >

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="info-item short">
                                    <label for="type">Type</label>
                                    <!-- <select  class="form-control @error('type') is-invalid @enderror" id="type" name="type" placeholder="Type"  >
                                        <option value=""></option>
                                        <option value="Retail">Retail</option>
                                        <option value="Retail">Wholesale</option>
                                    </select> -->
                                    <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" placeholder="Type" readonly>
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>


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
                products.initProductDetails($('#product'));
                products.addImage($('#addImage'));
            },
            initCategories: function( trigger ){
                trigger.change(function () {
                    var options = '';
                    console.log(this.value);
                    $.ajax({
                        type:'POST',
                        dataType: 'JSON',
                        url:'{{ route('seller.products.find.category') }}',
                        data: {
                            id: this.value,
                            _token: "{{ csrf_token() }}"
                        },
                        success:function(data) {


                            for( i = 0; i < data.length; i++){

                                options += '<option value="'+ data[i].id +'">' + data[i].product_name + '</option>';

                            }

                            $('#product').html(options);
                        }
                    });
                })
            },
            initProductDetails: function( trigger ){
                trigger.change(function () {
                    $.ajax({
                        type:'POST',
                        dataType: 'JSON',
                        url:'{{ route('seller.products.details') }}',
                        data: {
                            id: this.value,
                            _token: "{{ csrf_token() }}"
                        },
                        success:function(data) {
                            console.log(data[0].type);
                            $('#type').val(data[0].type);
                        }
                    });

                })
            },
            addImage: function (trigger) {
                trigger.click(function () {

                    var counter  = $('.stall-image').not('.hide').length;

                    console.log(counter);

                    $('#stall_image_' + counter).removeClass('hide');


                    /* var counter = $('.stall-image').length;

                     if(counter <= 5){

                         var clone = $('.stall-image:last').clone().insertAfter('.stall-image:last');
                         clone.find('input[type="file"]').attr('name', 'image_' + parseInt(parseInt(counter - 1) + 1));
                     }else{

                     }*/

                })
            }
        };

        $(window).on('load', function(){
            products.init();
        });

    </script>




@endsection
