@extends('layouts.seller')

@section('content')




    <div class="profile">
        <div class="profile-wrapper">
            <div class="card basic-info" style="width: 18rem;">
                <div class="card-header basic-info-header">
                    Product Information
                </div>
                <div class="basic-info-body">
                    <form action="{{ route('seller.products.store') }}" method="POST" class="form-"  enctype="multipart/form-data">
                        @csrf
                        <div class="info-body-flex">

                                <div class="form-group long">
                                    <label for="email">Product Category</label>
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

                                <div class="form-group long" id="select-product">
                                    <label for="Product">Product</label>
                                    <select  class="form-control @error('product') is-invalid @enderror" id="product" name="product" placeholder="Product"  >
                                        <option value=""></option>
                                    </select>
                                    @error('product')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="form-group long">
                                    <div class="form-inline">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="new_product" id="new_product"   >
                                            <label class="form-check-label" for="remember">
                                                <?php echo e(__('Custom Product')); ?>
                                            </label>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group long" id="custom-product-container">
                                    <label for="Product">Product</label>
                                    <input type="text"  class="form-control @error('new_product_name') is-invalid @enderror" id="custom-product" name="new_product_name" placeholder="Product" value="" >

                                    @error('new_product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="form-group long">
                                    <div class="form-inline">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="featured" id="featured"  value="1">
                                            <label class="form-check-label" for="remember">
                                                {{ __('Featured') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group short">
                                    <label for="Product">Stock or Quantity</label>
                                    <input type="number"
                                           class="form-control @error('stock') is-invalid @enderror"
                                           id="stock" name="stock"
                                           placeholder="Stock"
                                           value="" >

                                    @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>


                                <div class="form-group long" id="description-container">
                                    <label for="Product">Custom Product Name</label>
                                    <input type="text"  class="form-control @error('custom_title') is-invalid @enderror" id="custom-title" name="custom_title" placeholder="Product" value="" >

                                    @error('custom_title')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="form-group long" id="description-container">
                                    <label for="Product">Description</label>
                                    <textarea  class="form-control @error('description') is-invalid @enderror" id="description" rows="10" name="description" placeholder="Product" ></textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror

                                </div>

                                <div class="form-group long  stall-image">
                                    <label for="image">Image</label>
                                    <input type="file"  class="form-control @error('image') is-invalid @enderror"
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

                                <div class="form-group long">
                                    <label for="Product">Price</label>
                                    <input type="text"  class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Price" value="" onchange="validatePrice()">

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="alert alert-info" role="alert">
                                    Maximum Price: <input type="text"  id="max_price" name="max_price" placeholder="" value="" style="text-align: center;" readonly>
                                </div>

                                <div class="form-group long">
                                    <label for="type">Type</label>
                                     <select  class="form-control @error('type') is-invalid @enderror" id="type" name="type" placeholder="Type"  >
                                        <option value=""></option>
                                        <option value="Retail">Retail</option>
                                        <option value="Wholesale">Wholesale</option>
                                    </select>
                                    {{--<input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" placeholder="Type" readonly>--}}
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>


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
        function validatePrice() {
        var price = parseInt(document.getElementById("price").value);
        var maxPrice = parseInt(document.getElementById("max_price").value);

            if (price > maxPrice) {
                // alert("Price cannot exceed maximum price.");
                Swal.fire({
                    title: 'Error!',
                    text: 'Price cannot exceed maximum price.',
                    icon: 'error',
                    confirmButtonText: 'Ok',

                }).then((result) => {

                });
                document.getElementById("price").value = "";
            }
        }
        const products = {
            init: function(  ){
                products.initCategories($('#category'));
                products.initProductDetails($('#product'));
                products.initCustomProduct($('#new_product'));
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


                            options = '<option value="">Products</option>';
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
                            $('#max_price').val(data[0].max_price);
                        }
                    });

                })
            },
            initCustomProduct: function( trigger ){
                trigger.change(function () {
                    if ($(this).is(":checked")){
                        $('#select-product').hide();
                        $('#custom-product-container').show();


                    }else{
                        $('#select-product').show();
                        $('#custom-product-container').hide();
                    }
                });

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
            $('#select-product').show();
            $('#custom-product-container').hide();
        });

    </script>




@endsection
