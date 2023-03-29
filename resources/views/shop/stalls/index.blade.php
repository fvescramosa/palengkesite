@extends('layouts.app')

@section('content')
    <div class="shop">

      
        <div class="container shop-wrapper">

            <div class="filter-wrapper">
                <h3>Filter</h3>
                <form action="" id="filter" method="GET">
                    <div class="by-categories">
                        <div class="form-group">
                            <div class="form-group">
                                <label class="" for="">Product Name</label>
                                <input type="text" class="form-control" name="product_name" id="product_name" value="{{ old('product_name') ?? $_GET['product_name'] ?? '' }}">
                            </div>
                        </div>

                        @foreach($categories as $category)
                            <div class="form-check">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="form-check-input" {{ ( isset( $_GET['categories']) && in_array($category->id, $_GET['categories']) ? 'checked' : '')}}>
                                <label class="form-check-label" for="">
                                    {{ $category->category }}
                                </label>
                            </div>
                        @endforeach
                    </div>


                    <div class="row-btn">
                        <button class="btn btn-orange" type="submit">Apply Filter</button>
                    </div>

                </form>
            </div>
            <div class="products-grid">

                @foreach($stores as $store)

                    <div class="product-item" >

                        <a class="product-image" href="{{ route('shop.store.find', ['id' => $store->id]) }}">
                            @if( $store->seller_stall_images()->exists())
                                <img src="{{ asset( $store->seller_stall_images->first()->image ) }}" alt="">
                            @else
                                <img src="{{ asset( $store->stall->image ) }}" alt="">
                            @endif
                        </a>
                        <div class="product-details">
                            <h4>{{ $store->name }}</h4>


                            <a class="view-store-btn btn btn-orange" type="submit" href="{{ route('shop.store.find', ['id' => $store->id]) }}" >
                                <span class="fa fa-store"></span>
                                View
                            </a>

                        </div>
                    </div>

                @endforeach

            </div>
        </div>

        <script>

            let doc = $(document);
            var shop = {
                onInit: function () {
                    // shop.submitFilter($('#filter input'));
                },
                submitFilter: function (trigger) {
                    trigger.change(function () {
                        $('#filter').submit();
                    });
                }
            };

            doc.ready(function () {
                shop.onInit()
            })
        </script>
@endsection
