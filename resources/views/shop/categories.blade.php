@extends('layouts.app')

@section('content')
    <section class="categories">
        <div class="container">

            <div class="categories-grid">
                @foreach($categories as $category)
                    <a href="{{ route('shop.product.category', ['category' => $category->category]) }}" class="item-category" style="background-image: url({{ asset($category->image)  }})">
                        <div class="overlay"></div>
                        <h3>{{ $category->category }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
