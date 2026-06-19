@php
$setting = App\Models\SiteSetting::find(1) ?? new App\Models\SiteSetting();
@endphp

<footer class="main">
    <section class="newsletter mb-15 wow animate__animated animate__fadeIn section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="position-relative newsletter-inner">
                        <div class="newsletter-content">
                            {{-- <h2 class="mb-20">
                                Stay home & get your daily <br />
                                needs from our shop
                            </h2>
                            <p class="mb-45">Start Your Daily Shopping with <span class="text-brand">Smart Groceries & Delivery</span></p>
                            <form class="form-subcriber d-flex">
                                <input type="email" placeholder="Your emaill address" />
                                <button class="btn" type="submit">Subscribe</button>
                            </form> --}}
                            {{-- <img src="{{ asset('front/assets/imgs/banner/edited_footer.jpg') }}" alt="newsletter" /> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <section class="featured section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 mb-md-4 mb-xl-0">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay="0">
                        <div class="banner-icon">
                            <img src="{{ asset('front/assets/imgs/theme/icons/icon-1.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Best prices & offers</h3>
                            <p>Orders $50 or more</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                        <div class="banner-icon">
                            <img src="{{ asset('front/assets/imgs/theme/icons/icon-2.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Free delivery</h3>
                            <p>24/7 amazing services</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                        <div class="banner-icon">
                            <img src="{{ asset('front/assets/imgs/theme/icons/icon-3.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Great daily deal</h3>
                            <p>When you sign up</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                        <div class="banner-icon">
                            <img src="{{ asset('front/assets/imgs/theme/icons/icon-4.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Wide assortment</h3>
                            <p>Mega Discounts</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                        <div class="banner-icon">
                            <img src="{{ asset('front/assets/imgs/theme/icons/icon-5.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Easy returns</h3>
                            <p>Within 30 days</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-xl-none">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".5s">
                        <div class="banner-icon">
                            <img src="{{ asset('front/assets/imgs/theme/icons/icon-6.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Safe delivery</h3>
                            <p>Within 30 days</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <section class="section-padding footer-mid">
        <div class="container pt-15 pb-20">
            <div class="row">
                <div class="col">
                    <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                        <div class="logo logo-width-2 mb-30 d-none d-lg-block">
                            {{-- <a href="/" class="mb-15"><img src="{{ asset('front/assets/imgs/theme/logo.svg') }}" alt="logo" /></a> --}}
                            {{-- <a href="/" class=""><img src="{{ asset('front/assets/imgs/theme/smart_5.png') }}" alt="logo" /></a> --}}
                            {{-- <a href="/" class="mb-15"><img src="{{ asset($setting->logo ) }}" alt="logo" /></a> --}}
                            {{-- <p class="font-lg text-heading">Your fast and friendly grocery delivery service. Our goal is to provide what you need. </p><br> --}}
                        </div>
                        <ul class="contact-infor">
                            <li><img src="{{ asset('front/assets/imgs/theme/icons/icon-location.svg') }}" alt="" /><strong>Address: </strong> <span> {{ $setting->company_address }} </span></li>
                            <li><img src="{{ asset('front/assets/imgs/theme/icons/icon-contact.svg') }}" alt="" /><strong>Call for supplies:<br></strong><span>{{ $setting->phone_one }}</span></li>
                            <li><img src="{{ asset('front/assets/imgs/theme/icons/icon-email-2.svg') }}" alt="" /><strong>Email:</strong><span>{{ $setting->email }}</span></li>
                            <li><img src="{{ asset('front/assets/imgs/theme/icons/icon-clock.svg') }}" alt="" />&nbsp;&nbsp;<strong>Hours:</strong><span>9:00 - 18:00, Mon - Sat</span></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                    <h4 class=" widget-title">Company</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <li><a href="{{ route('about_us') }}">About Us</a></li>
                        {{-- <li><a href="#">Delivery Information</a></li> --}}
                        <li><a href="{{ route('privacy_policy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('terms_conditions') }}">Terms &amp; Conditions</a></li>
                        {{-- <li><a href="#">Contact Us</a></li> --}}

                        {{-- <li><a href="#">Support Center</a></li> --}}
                        {{-- <li><a href="#">Careers</a></li> --}}
                    </ul>
                </div>
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                    <h4 class="widget-title">Account</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <li><a href="{{ route('login') }}">Sign In</a></li>
                        <li><a href="{{ route('mycart') }}">View Cart</a></li>
                        {{-- <li><a href="{{ route('wishlist') }}">My Wishlist</a></li> --}}
                        <li><a href="{{ route('user.track.order') }}">Track My Order</a></li>
                        {{-- <li><a href="{{ route('compare') }}">Compare products</a></li> --}}
                        {{-- <li><a href="#">Help Ticket</a></li> --}}
                        {{-- <li><a href="#">Shipping Details</a></li> --}}
                    </ul>
                </div>
                {{-- <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                    <h4 class="widget-title">Corporate</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <li><a href="#">Become a Vendor</a></li>
                        <li><a href="#">Affiliate Program</a></li>
                        <li><a href="#">Farm Business</a></li>
                        <li><a href="#">Farm Careers</a></li>
                        <li><a href="#">Our Suppliers</a></li>
                        <li><a href="#">Accessibility</a></li>
                        <li><a href="#">Promotions</a></li>
                    </ul>
                </div> --}}
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp d-none d-lg-block" data-wow-delay=".4s">
                    @php
                        $hot_deals = App\Models\Product::where(['hot_deals' => 1, 'status' => 1])->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(5)->get();
                        @endphp
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <h4 class="widget-title">Popular</h4>
                        @foreach($hot_deals as $item)
                            <li>
                                <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"> {{ $item->product_name }} </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
    </section>
    <div class="container pb-30 wow animate__animated animate__fadeInUp" data-wow-delay="0">
        <div class="row align-items-center">
            <div class="col-12 mb-30">
                <div class="footer-bottom"></div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6">
                <p class="font-sm mb-0">&copy; 2025, <strong class="text-brand">Smart Groceries & Delivery</strong> -  {{ $setting->copyright }} | <a href="{{ route('admin.login') }}" class="text-brand" style="font-weight: 600;">Admin Login</a></p>
                
                {{-- <p class="font-sm mb-0">&copy; 2022, <strong class="text-brand">Nest</strong> - HTML Ecommerce Template <br />All rights reserved</p> --}}
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 text-center d-none d-xl-block">

                <div class="hotline d-lg-inline-flex">
                    <span><img src="{{ asset('front/assets/imgs/theme/icons/phone-call.svg') }}" alt="hotline" /></span>
                    {{-- <p>1900 - 8888<span>24/7 Support Center</span></p> --}}
                    <p>{{ $setting->support_phone }}<span>24/7 Support Center</span></p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 text-end d-md-block mobile_footer_icons">
                <div class="mobile-social-icon">
                    <h6>Follow Us</h6>
                    {{-- <a href="#"><img src="{{ asset('front/assets/imgs/theme/icons/icon-facebook-white.svg') }}" alt="" /></a> --}}
                    {{-- <a href="#"><img src="{{ asset('front/assets/imgs/theme/icons/icon-twitter-white.svg') }}" alt="" /></a> --}}
                    {{-- <a href="#"><img src="{{ asset('front/assets/imgs/theme/icons/icon-instagram-white.svg') }}" alt="" /></a> --}}
                    {{-- <a href="#"><img src="{{ asset('front/assets/imgs/theme/icons/icon-pinterest-white.svg') }}" alt="" /></a> --}}
                    {{-- <a href="#"><img src="{{ asset('front/assets/imgs/theme/icons/icon-youtube-white.svg') }}" alt="" /></a> --}}

                    {{-- <a href="{{ $setting->facebook }}"><img src="{{ asset('front/assets/imgs/theme/icons/icon-facebook-white.svg') }}" alt="" /></a> --}}
                    {{-- <a href="{{ $setting->twitter }}"><img src="{{ asset('front/assets/imgs/theme/icons/icon-twitter-white.svg') }}" alt="" /></a> --}}
                    <a href="{{ $setting->facebook }}"><img src="{{ asset('front/assets/imgs/theme/icons/instagram_icon.png') }}" alt="" /></a>
                    <a href="{{ $setting->twitter }}"><img src="{{ asset('front/assets/imgs/theme/icons/whatsapp_icon.png') }}" alt="" /></a>
                    {{-- <a href="{{ $setting->youtube }}"><img src="{{ asset('front/assets/imgs/theme/icons/icon-youtube-white.svg') }}" alt="" /></a> --}}
                </div>
                <!-- <p class="font-sm">Your Trusted Campus Grocery Partner! | <a href="{{ route('admin.login') }}" class="text-brand" style="font-weight: 600;">Admin Login</a></p> -->
            </div>
        </div>
    </div>
</footer>

{{-- https://www.freepik.com/search?format=search&iconType=standard&last_filter=query&last_value=instagram+svg&query=instagram+svg&type=icon --}}
