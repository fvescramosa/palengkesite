@extends('layouts.app')

@section('content')
<section class="about-us">
    <div class="container">
        <div class="about-us-flex">
            <div class="about-us-left reveal">
                <img src="{{ \Illuminate\Support\Facades\URL::to('/images/logo-palengkesite.png') }}" alt="">
            </div>
            <div class="about-us-right reveal">
                <h3>WHY CHOOSE US?</h3>
                <p>
                    PalengkeSite is an e-commerce website for Batangueñoes.
                    Categories including meat, fish, fruits, vegetables, and grocery items are available here.
                    It aims to ease up buying essential goods in a convenient and effective system.
                </p>
                <p>
                    PalengkeSite can produce a big impact to the community because it can give customers easy access to buy
                    their groceries and their needs in the market online and can help sellers to recover from financial loss
                </p>

                <a href="{{ route('contact-us') }}" class="pal-button btn-orange">Contact Us</a>
            </div>
        </div>

        <div class="about-developers">


        </div>
    </div>
</section>
<section class="about-developers">
    <div class="container reveal">
        <h3>Developers</h3>
        <div class="developers-grid">

            @foreach($developers as $developer)
            <div class="developer">
                <div class="img-section">
                    <img src="{{ asset($developer->photo) ?? \Illuminate\Support\Facades\URL::to('/images/logo-palengkesite.png') }}" alt="">
                    <ul>
                        <li><a target="_blank" href="{{ $developer->facebook ?? '#'}}"><span class="fab fa-facebook-f"></span></a></li>
                        <li><a target="_blank" href="{{ $developer->twitter ?? '#'}}"><span class="fab fa-twitter"></span></a></li>
                        <li><a target="_blank" href="{{ $developer->instagram ?? '#'}}"><span class="fab fa-instagram"></span></a></li>
                        <li><a target="_blank" href="{{ $developer->linkedin ?? '#'}}"><span class="fab fa-linkedin"></span></a></li>

                    </ul>
                </div>
                <div class="name-section">
                    <p>{{ $developer->name }}</p>
                </div>
            </div>
            @endforeach

    </div>

</section>

<script>
    function reveal() {
        var reveals = document.querySelectorAll(".reveal");

        for (var i = 0; i < reveals.length; i++) {
            var windowHeight = window.innerHeight;
            var elementTop = reveals[i].getBoundingClientRect().top;
            var elementVisible = 120;

            if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add("active");
            } else {
                    reveals[i].classList.remove("active");
            }
        }
    }

        window.addEventListener("scroll", reveal);
</script>
@endsection
