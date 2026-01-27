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
         <div class="page-content pt-100 pb-20 login-register-mobile-padding">
            <div class="container">
               <div class="row">
                  <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                     <div class="row">
                        <div class="col-lg-6 pr-30 d-none d-lg-block">
                            <div class="row mt-110">
                                <img class="border-radius-15" src="{{ asset('front/assets/imgs/page/login-m.jpg') }}" alt="" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-8">
                           <div class="login_wrap widget-taber-content background-white">
                              <div class="padding_eight_all bg-white">
                                 <div class="heading_s1">
                                    <h2 class="mb-5">Login</h2>
                                    <p class="mb-30">Don't have an account? <a href="{{ route('register') }}">Create here</a></p>
                                 </div>
                                 <form id="myForm_type" method="post" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                       <input type="email" id="email" required="" name="email" placeholder="Username or Email *" class="form-control @error('email') is-invalid @enderror" />
                                       @error('email')
                                       <span class="text-danger">{{ $message }}</span>
                                       @enderror
                                    </div>
                                    <div class="form-group">
                                       <input required="" type="password" id="password" name="password" placeholder="Your password *" class="form-control @error('password') is-invalid @enderror" />
                                       @error('password')
                                       <span class="text-danger">{{ $message }}</span>
                                       @enderror
                                    </div>
                                    {{-- <div class="login_footer form-group">
                                       <div class="chek-form">
                                          <input type="text" required="" name="email" placeholder="Security code *" />
                                       </div>
                                       <span class="security-code">
                                       <b class="text-new">8</b>
                                       <b class="text-hot">6</b>
                                       <b class="text-sale">7</b>
                                       <b class="text-best">5</b>
                                       </span>
                                    </div> --}}
                                    <div class="login_footer form-group mb-15">
                                       {{-- <div class="chek-form">
                                          <div class="custome-checkbox">
                                             <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="" />
                                             <label class="form-check-label" for="exampleCheckbox1"><span>Remember me</span></label>
                                          </div>
                                       </div> --}}
                                       <a class="text-muted" href="{{ route('password.request') }}">Forgot password?</a>
                                    </div>
                                    <div class="form-group">
                                       <button type="submit" class="btn btn-heading btn-block hover-up" name="login">Log in</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
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
            email: {
               required : true,
            },
            password: {
               required : true,
            },
           },

           messages :{
            email: {
               required : 'Please Enter Your Email or Username',
            },
            password: {
               required : 'Please Enter Your Password',
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
