@php
    $slider = App\Models\Slider::orderBy('slider_title', 'ASC')->get();
@endphp

@if ($slider)
    <section class="home-slider position-relative mb-30 d-none d-lg-block">
        <div class="container">
            <div class="home-slide-cover mt-1">
                <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                {{-- <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1"> --}}
                    @foreach ($slider as $item)
                        <div class="single-hero-slider single-animation-wrap"
                            style="background-image: url({{ asset($item->slider_image) }})">
                            <div class="slider-content">
                                <h4 class="display-2 mb-20 d-none d-lg-none">
                                    {{ $item->slider_title }}
                                </h4>
                                <p class="mb-65 d-none d-lg-none">{{ $item->short_title }}</p>
                                {{-- <form class="form-subscriber d-flex">
                      <input type="email" placeholder="Your email address" />
                      <button class="btn" type="submit">Subscribe</button>
                   </form> --}}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="slider-arrow hero-slider-1-arrow"></div>
            </div>
        </div>
    </section>
@else
@endif
<!--End hero slider-->
