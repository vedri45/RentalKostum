@php
    function backgroundImage(){
        if (Route::is('index.index')) {
            return asset('frontend/img/bg/welcome-bg.png');
        } elseif (Route::is('index.contact')) {
            return asset('frontend/img/bg/contact.jpg');
        }
    }
@endphp
<!-- SLIDESHOW -->
<section class="welcome_area clearfix section_padding_100_0" id="home" style="background-image: url({{asset('frontend/img/bg/contact.jpg')}}); height: 400px;">
    <div class="hero-slides owl-carousel">
        {{-- @foreach (App\Slideshow::orderBy('created_at','desc')->get() as $row)
        <!-- Single Hero Slides -->
        <div class="single-hero-slide">
            <div class="hero-slide-content text-center">
                <img class="slide-img" src="{{asset($row->images)}}" alt="">
            </div>
        </div>
        @endforeach --}}
    </div>
</section>
<!-- SLIDESHOW END -->
