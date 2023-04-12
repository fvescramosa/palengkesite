@extends('layouts.app')

@section('content')
    <section class="contact-us">
        <div class="container">
            <div class = "contact-title">
                <p>If you have any inquiries</p>
                <h1>Contact Us</h1>
            </div>
            <form action="{{ route('contact-us.submit') }}" class="form-group contact-form" method="POST">

                @csrf
                <div class="row">
                    <div class="col-md-12 contact-label">
                        <label for="" class="col-form-label">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="">
                    </div>

                    <div class="col-md-12 contact-label">
                        <label for="" class="col-form-label">Email</label>
                        <input type="text" name="email" value="{{ old('email') }}" class="form-control" id="">
                    </div>

                    <div class="col-md-12 contact-label">
                        <label for="" class="col-form-label">Subject</label>
                        <input type="text" name="subject" value="{{ old('subject') }}" class="form-control" id="">
                    </div>

                    <div class="col-md-12 contact-label">
                        <label for="" class="col-form-label">Message</label>
                        <textarea name="message" class="form-control" id="" rows="10" cols="10">{{ old('message') }}</textarea>
                    </div>

                    <button class="home-btn option-btn contact-btn">Submit</button>
                </div>

        </form>

        </div>
    </section>


    <script>    
        const elements = {
            initSlick: function () {
                $(".home-category .box-container").slick({
                    slidesToShow:4,
                    slidesToScroll:1,
                    dots: false,
                    autoplay: true,
                    autoplaySpeed: 5000,
                    infinite: true,
                    slide: 'div',
                    cssEase: 'linear',
                    nextArrow: false,
                    prevArrow: false,
                    responsive: [
                        {
                            breakpoint: 991,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll:1,
                                infinite: false,
                                dots: false
                            }
                        },

                    ]
                });
            },
            initFeaturedProducts: function () {

                $(" .products-grid").slick({
                    slidesToShow:4,
                    slidesToScroll:1,
                    dots: false,
                    autoplay: false,
                    autoplaySpeed: 5000,
                    infinite: true,
                    slide: 'div',
                    cssEase: 'linear',

                });
            }
        }

        $(document).ready(function(){
           elements.initSlick();
           // elements.initFeaturedProducts();
        });

    </script>
@endsection
