<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Forgot Password - Smart Groceries &amp; Delivery</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="Reset your Smart Groceries account password" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="Forgot Password - Smart Groceries" />
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
        .forgot-password-alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 1.5;
        }
        .forgot-password-alert.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .forgot-password-alert.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .forgot-password-alert ul {
            margin: 5px 0 0 0;
            padding-left: 20px;
        }
        .back-to-login {
            display: inline-block;
            margin-top: 15px;
            color: #3BB77E;
            font-weight: 600;
            transition: color 0.2s ease;
        }
        .back-to-login:hover {
            color: #29a367;
        }
        .back-to-login i {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    @include('front.body.header')
    <main class="main pages">
        <div class="page-content pt-20 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-8 col-md-12 m-auto">
                        <div class="row">
                            <div class="heading_s1">
                                <img class="border-radius-15 password-reset-mobile-image" src="{{ asset('front/assets/imgs/page/reset_password.svg') }}" alt="" />
                                <h2 class="mb-15 mt-15">Forgot Password</h2>
                                <p class="mb-30">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that
                                    will allow you to choose a new one.
                                </p>
                            </div>
                            <div class="col-lg-6 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">

                                        {{-- Success Message --}}
                                        @if (session('status'))
                                            <div class="forgot-password-alert success">
                                                {{ session('status') }}
                                            </div>
                                        @endif

                                        {{-- Error Messages --}}
                                        @if ($errors->any())
                                            <div class="forgot-password-alert error">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <form method="post" action="{{ route('password.email') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="email" required="" id="email" name="email" value="{{ old('email') }}" placeholder="Email *" />
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-heading btn-block hover-up" name="login">Email Password Reset Link</button>
                                            </div>
                                        </form>

                                        <a href="{{ route('login') }}" class="back-to-login">
                                            <i class="fi-rs-arrow-small-left"></i> Back to Login
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('front.body.footer')

    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="{{ asset('front/assets/imgs/theme/loading.gif') }}" alt="" />
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
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
      @php
          try {
              $ip = request()->ip();
              $sessionId = session()->getId();
              $url = request()->fullUrl();
              
              $recentVisitExists = \Illuminate\Support\Facades\DB::table('chat_visitor_logs')
                  ->where('session_id', $sessionId)
                  ->where('url', $url)
                  ->where('created_at', '>=', now()->subMinutes(5))
                  ->exists();
                  
              if (!$recentVisitExists) {
                  \Illuminate\Support\Facades\DB::table('chat_visitor_logs')->insert([
                      'ip_address' => $ip,
                      'session_id' => $sessionId,
                      'url' => $url,
                      'chat_started' => false,
                      'chat_answered' => false,
                      'created_at' => now(),
                      'updated_at' => now(),
                  ]);
              }
          } catch (\Exception $e) {}
      @endphp

        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        Tawk_API.customStyle = {
            visibility : {
                desktop : {
                    position : 'br',
                    xOffset : 15,
                    yOffset : 15
                },
                mobile : {
                    position : 'br',
                    xOffset : 15,
                    yOffset : 160
                }
            }
        };
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/6a4fa09ba6558f1d451fdc7b/1jt3gmors';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        <!--End of Tawk.to Script-->
</body>
</html>
