    @extends('layouts.admin')

@section('content')
    <div class="profile">
       <div class="profile-wrapper">
           <div class="card basic-info" style="width: 18rem;">
               <div class="card-header basic-info-header">
                   Basic Information
               </div>
                <div class="basic-info-body">
                    <div class="info-body-flex">
                        <div class="info-item short">
                            <h3>Stall No: {{ $stall->number }}</h3>
                        </div>

                        <div class="info-item short">
                            <h3>Status: {{ $stall->status }}</h3>
                        </div>
                    </div>

                    <div class="stall">

                        <div class="stall-gallery">
                            <div id="slide-for">
                                <div>
                                    <div class="stall-main-img">
                                        <img src="{{ asset('public/Image') .'/'. $stall->image }}" alt="">
                                    </div>
                                </div>
                                @for($i=1; $i<=5; $i++)
                                    @php $imagekey = 'image_'.$i; @endphp
                                    @if($stall[$imagekey])
                                        <div>
                                            <div class="stall-img">
                                                <img src="{{ asset('public/Image') .'/'. $stall[$imagekey] }}" alt="">
                                            </div>
                                        </div>
                                    @endif
                                @endfor

                            </div>
                            <div id="slide-nav" class="stall-gallery">
                                <div>
                                    <div class="stall-img">
                                        <img src="{{ asset('public/Image') .'/'. $stall->image }}" alt="">
                                    </div>
                                </div>
                                @for($i=1; $i<=5; $i++)
                                    @php $imagekey = 'image_'.$i; @endphp
                                    @if($stall[$imagekey])
                                        <div>
                                            <div class="stall-img">
                                                <img src="{{ asset('public/Image') .'/'. $stall[$imagekey] }}" alt="">
                                            </div>
                                        </div>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <div class="stall-info">
                            <table class="table table-bordered">
                                <tr>
                                    <td><p><strong>Section:</strong></p> </td>
                                    <td> <p>{{ $stall->section }}</p></td>

                                    <td class="stall-info-title-container"><p><strong>Area: </strong></p></td>
                                    <td> <p>{{ $stall->sqm }} sqm</p></td>
                                </tr>
                                <tr>
                                    <td class="stall-info-title-container"><p><strong>Amount / Sqm: </strong> </p> </td>
                                    <td> <p>Php {{ $stall->amount_sqm }}</p></td>
                                    
                                    @if($stall->market_id == 3)
                                        <td class="stall-info-title-container"><p><strong>Annual Fee: </strong></p> </td>
                                        <td> <p>{{ $stall->annual_fee }}</p></td>   
                                    @else
                                        <td class="stall-info-title-container"><p><strong>Rental Fee: </strong></p> </td>
                                        <td> <p>{{ $stall->rental_fee }}</p></td>
                                    @endif

                                </tr>
                            </table>
                        </div>

                        @if( auth()->user() && auth()->user()->type == 1 )
                            <a href="{{ route('admin.seller.stalls.create', $stall->id) }}" class="btn btn-primary">Apply</a>
                        @endif
                    </div>


                </div>
           </div>
       </div>
    </div>

    <script>
        $('#slide-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            arrows: false,
            fade: true,
            asNavFor: '#slide-nav'
        });

        $('#slide-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: true,
            asNavFor: '#slide-for',
            dots: false ,
            centerMode: true,
            focusOnSelect: true
        });


    </script>
@endsection
