<!DOCTYPE html>
<html class="no-js" lang="en">
   <head>
      <meta charset="utf-8" />
      <title>Smart Groceries &amp; Delivery - Login</title>
      <meta http-equiv="x-ua-compatible" content="ie=edge" />
      <meta name="description" content="Login to your Smart Groceries student account" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <meta property="og:title" content="Login - Smart Groceries" />
      <meta property="og:type" content="" />
      <meta property="og:url" content="" />
      <meta property="og:image" content="" />
      <!-- Favicon -->
      <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/assets/imgs/theme/favicon.svg') }}" />
      <!-- Template CSS -->
      <link rel="stylesheet" href="{{ asset('front/assets/css/plugins/animate.min.css') }}" />
      <link rel="stylesheet" href="{{ asset('front/assets/css/main.css?v=5.3') }}" />
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

      <style>
         /* ── Password Toggle ── */
         .password-wrapper {
            position: relative;
         }
         .password-wrapper input {
            padding-right: 45px !important;
         }
         .password-toggle-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #999;
            font-size: 16px;
            padding: 4px;
            z-index: 5;
            transition: color 0.2s ease;
            line-height: 1;
         }
         .password-toggle-btn:hover {
            color: #3BB77E;
         }
      </style>
   </head>
   <body>
      @include('front.body.header')
      <main class="main pages">
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
                                       <div class="password-wrapper">
                                          <input required="" type="password" id="password" name="password" placeholder="Your password *" class="form-control @error('password') is-invalid @enderror" />
                                          <button type="button" class="password-toggle-btn" onclick="togglePassword('password', this)" title="Show password">
                                             <svg class="eye-open" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                             <svg class="eye-closed" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                                          </button>
                                       </div>
                                       @error('password')
                                       <span class="text-danger">{{ $message }}</span>
                                       @enderror
                                    </div>
                                    <div class="login_footer form-group mb-15">
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
   // ── Password Toggle ──
   function togglePassword(inputId, btn) {
      var input = document.getElementById(inputId);
      var eyeOpen = btn.querySelector('.eye-open');
      var eyeClosed = btn.querySelector('.eye-closed');

      if (input.type === 'password') {
         input.type = 'text';
         eyeOpen.style.display = 'none';
         eyeClosed.style.display = 'inline';
      } else {
         input.type = 'password';
         eyeOpen.style.display = 'inline';
         eyeClosed.style.display = 'none';
      }
   }

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
