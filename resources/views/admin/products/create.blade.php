@extends('layouts.admin')

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
                    <form action="{{ route('admin.products.store') }}" method="POST" class="form-">
                        @csrf
                        <div class="info-body-flex">


                                <div class="info-item short">
                                    <label for="email">Product Categories</label>
                                    <select  class="form-control @error('category') is-invalid @enderror" 
                                            id="category" 
                                            name="category" 
                                            placeholder="Category">
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
                                <div class="info-item long">
                                    <label for="Product">Product</label>
                                    <input type="text"  class="form-control @error('product') is-invalid @enderror" 
                                                        id="product" 
                                                        name="product" 
                                                        placeholder="i.e. Apple" value="" >

                                    </select>
                                    @error('product')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="info-item long">
                                    <label for="min_price">Minimum Price</label>
                                    <input type="text"  class="form-control @error('min_price') is-invalid @enderror" 
                                                        id="min_price" 
                                                        name="min_price" 
                                                        placeholder="i.e. 12" value="" >

                                    </select>
                                    @error('product')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="info-item long">
                                    <label for="max_price">Maximum Price</label>
                                    <input type="text"  class="form-control @error('max_price') is-invalid @enderror" 
                                                        id="max_price" 
                                                        name="max_price" 
                                                        placeholder="i.e. 15" value="" >

                                    </select>
                                    @error('product')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="info-item long">
                                    <label for="srp">SRP</label>
                                    <input type="text"  class="form-control @error('srp') is-invalid @enderror" 
                                                        id="srp" 
                                                        name="srp" 
                                                        placeholder="i.e. 12" value="" >

                                    </select>
                                    @error('product')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="info-item long">
                                    <label for="code">Code</label>
                                    <input type="text"  class="form-control @error('code') is-invalid @enderror" 
                                                        id="code" 
                                                        name="code" 
                                                        placeholder="" value="" >

                                    </select>
                                    @error('product')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="info-item long">
                                    <label for="manufacturer">Manufacturer</label>
                                    <input type="text"  class="form-control @error('manufacturer') is-invalid @enderror" 
                                                        id="manufacturer" 
                                                        name="manufacturer" 
                                                        placeholder="" value="" >

                                    </select>
                                    @error('product')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="info-item long">
                                    <label for="type">Type</label>
                                    <select  class="form-control" id="type" name="type" placeholder=""  >
                                        <option value="Wholesale">Wholesale</option>
                                        <option value="Retail">Retail</option>
                                    </select>

                                    @error('product')
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


@endsection
