@extends('layouts.seller')

@section('content')
    <div class="container">
        <div class="grid">
            <div class="grid-wrapper">
                @if(count($stalls) > 0)
                    @foreach($stalls as $stall)
                    <a href="{{ route('seller.stalls.create', [$stall->id]) }}" class="grid-item">
                        <div class="grid-item-thumbnail">
                            <img src="{{ asset('public/Image/'.$stall->image)  }}" alt="">
                        </div>
                        <div class="grid-item-details">
                            <p><strong>Stall No: </strong> {{ $stall->number }}</p>
                        </div>
                    </a>
                    @endforeach

                @else
                    <h3>No Available Stall at this time. Please check again Later</h3>
                @endif

            </div>
        </div>
    </div>
@endsection
