<!DOCTYPE html>
<html class="no-js" lang="en">
   <head>
      <meta charset="utf-8" />
      <title>Smart Groceries & Delivery</title>
      <meta http-equiv="x-ua-compatible" content="ie=edge" />
      <meta name="description" content="" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <meta property="og:title" content="" />
      <meta property="og:type" content="" />
      <meta property="og:url" content="" />
      <meta property="og:image" content="" />
      <!-- Favicon -->
      <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/assets/imgs/theme/favicon.svg') }}" />
      <!-- Template CSS -->
      <link rel="stylesheet" href="{{ asset('front/assets/css/plugins/animate.min.css') }}" />
      <link rel="stylesheet" href="{{ asset('front/assets/css/main.css?v=5.3') }}" />
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

      {{-- <style>
         *{
             zoom: 99.6%;
         }
      </style> --}}
   </head>
   <body>
      @include('front.body.header')
      <main class="main pages">
         {{-- <div class="page-header breadcrumb-wrap">
            <div class="container">
               <div class="breadcrumb">
                  <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
               </div>
            </div>
         </div> --}}
         <div class="page-content pt-20 pb-20 login-register-mobile-padding">
            <div class="container">
               <div class="row">
                  <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                     <form id="myForm_type" method="post" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                           <div class="col-lg-6 col-md-8">
                              <div class="login_wrap widget-taber-content background-white">
                                 <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                       <h2 class="mb-5">Create an Account</h2>
                                       <p class="mb-30">
                                          Already have an account?
                                          <a href="{{ route('login') }}">Login</a>
                                       </p>
                                    </div>
                                       <div class="form-group">
                                          <input type="text" required="" id="name" name="name" placeholder="Full name" class="form-control @error('name') is-invalid @enderror" />
                                          @error('name')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                       <div class="form-group">
                                          <input type="email" required="" id="email" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" />
                                          @error('email')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                       <div class="form-group">
                                          <input required="" type="password" id="password" name="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" />
                                          @error('password')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                       <div class="form-group">
                                          <input required="" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" class="form-control @error('password_confirmation') is-invalid @enderror" />
                                          @error('password_confirmation')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>
                                       {{-- <div class="login_footer form-group mb-50">
                                          <div class="chek-form">
                                             <div class="custome-checkbox">
                                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" value="" />
                                                <label class="form-check-label" for="exampleCheckbox12"><span>I agree to terms &amp; Policy.</span></label>
                                             </div>
                                          </div>
                                          <a href="page-privacy-policy.html"><i class="fi-rs-book-alt mr-5 text-muted"></i>Lean more</a>
                                       </div> --}}

                                    </div>
                                 </div>
                              </div>

                              <div class="col-lg-6 d-lg-block">
                                 <div class="card-login mt-115">
                                    <p class="font-md text-muted text-center"><strong>Note: </strong>Your personal data will be used to support your experience throughout this website, to manage access to your account.</p>
                                    <div class="form-group mt-20 text-center">
                                       <button type="submit" class="btn btn-fill-out btn-block hover-up font-weight-bold" name="login">Register</button>
                                       {{-- <button type="submit" class="btn btn-fill-out btn-block hover-up font-weight-bold" name="login">Submit &amp; Register</button> --}}
                                    </div>
                                    {{-- <a href="#" class="social-login facebook-login">
                                       <img src="assets/imgs/theme/icons/logo-facebook.svg" alt="" />
                                       <span>Continue with Facebook</span>
                                    </a>
                                    <a href="#" class="social-login google-login">
                                       <img src="assets/imgs/theme/icons/logo-google.svg" alt="" />
                                       <span>Continue with Google</span>
                                    </a>
                                    <a href="#" class="social-login apple-login">
                                       <img src="assets/imgs/theme/icons/logo-apple.svg" alt="" />
                                       <span>Continue with Apple</span>
                                    </a> --}}
                                 </div>
                              </div>

                           </div>
                        </div>
                     </form>
               </div>
            </div>
         </div>
      </main>
      {{-- @include('front.body.footer') --}}
      <!-- Preloader Start -->
      <div id="preloader-active">
         <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
               <div class="text-center">
                  <img src="{{ asset('front/assets/imgs/theme/loading-3.gif') }}" alt="" />
               </div>
            </div>
         </div>
      </div>
      <!-- Vendor JS-->
      <script src="{{ asset('front/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
      <script src="{{ asset('front/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
      <script src="{{ asset('front/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
      <script src="{{ asset('front/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('front/assets/js/plugins/slick.js') }}"></script>
      <script src="{{ asset('front/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
      <script src="{{ asset('front/assets/js/plugins/wow.js') }}"></script>
      <script src="{{ asset('front/assets/js/plugins/perfect-scrollbar.js') }}"></script>
      <script src="{{ asset('front/assets/js/plugins/magnific-popup.js') }}"></script>
      <script src="{{ asset('front/assets/js/plugins/select2.min.js') }}"></script>
      <script src="{{ asset('front/assets/js/plugins/waypoints.js') }}"></script>
      <script src="{{ asset('front/assets/js/plugins/counterup.js') }}"></script>
      <script src="{{ asset('front/assets/js/plugins/jquery.countdown.min.js') }}"></script>
      <script src="{{ asset('front/assets/js/plugins/images-loaded.js') }}"></script>
      <script src="{{ asset('front/assets/js/plugins/isotope.js') }}"></script>
      <script src="{{ asset('front/assets/js/plugins/scrollup.js') }}"></script>
      <script src="{{ asset('front/assets/js/plugins/jquery.vticker-min.js') }}"></script>
      <script src="{{ asset('front/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
      <script src="{{ asset('front/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
      <!-- Template  JS -->
      <script src="{{ asset('front/assets/js/main.js?v=5.3') }}"></script>
      <script src="{{ asset('front/assets/js/shop.js?v=5.3') }}"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

      <script>
         @if(Session::has('message'))
         var type = "{{ Session::get('alert-type','info') }}"
         switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
         }
         @endif
      </script>
      <script src="{{ asset('front/assets/js/validate.js') }}"></script>

      <script type="text/javascript">
         $(document).ready(function (){
             $('#myForm_type').validate({
                 rules: {
                  name: {
                     required : true,
                  },
                  email: {
                     required : true,
                  },
                  password: {
                     required : true,
                  },
                  password_confirmation: {
                     required : true,
                  },

                 },
                 messages :{
                  name: {
                     required : 'Please Enter Your Name',
                  },
                  email: {
                     required : 'Please Enter Your Email',
                  },
                  password: {
                     required : 'Please Enter Your Password',
                  },
                  password_confirmation: {
                     required : 'Please Confirm Your Password',
                  },

                 },
                 errorElement : 'span',
                 errorPlacement: function (error,element) {
                     error.addClass('invalid-feedback');
                     element.closest('.form-group').append(error);
                 },
                 highlight : function(element, errorClass, validClass){
                     $(element).addClass('is-invalid');
                 },
                 unhighlight : function(element, errorClass, validClass){
                     $(element).removeClass('is-invalid');
                 },
             });
         });

      </script>
   </body>
</html>
