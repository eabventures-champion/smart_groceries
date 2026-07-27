<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Reset Password - Smart Groceries &amp; Delivery</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="Set a new password for your Smart Groceries account" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="Reset Password - Smart Groceries" />
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
        .reset-password-alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 1.5;
        }
        .reset-password-alert.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .reset-password-alert ul {
            margin: 5px 0 0 0;
            padding-left: 20px;
        }

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
        <div class="page-content pt-20 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-8 col-md-12 m-auto">
                        <div class="row">
                            <div class="heading_s1">
                                <img class="border-radius-15 password-reset-mobile-image" src="{{ asset('front/assets/imgs/page/reset_password.svg') }}" alt="" />
                                <h2 class="mb-15 mt-15">Set new password</h2>
                            </div>
                            <div class="col-lg-6 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">

                                        {{-- Error Messages --}}
                                        @if ($errors->any())
                                            <div class="reset-password-alert error">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <form method="post" action="{{ route('password.store') }}">
                                            @csrf
                                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                            <div class="form-group">
                                                <input type="email" required="" id="email" name="email" value="{{ $request->email }}" readonly />
                                            </div>
                                            <div class="form-group">
                                                <div class="password-wrapper">
                                                    <input type="password" required="" id="password" name="password" placeholder="New Password" />
                                                    <button type="button" class="password-toggle-btn" onclick="togglePassword('password', this)" title="Show password">
                                                        <svg class="eye-open" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                                        <svg class="eye-closed" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="password-wrapper">
                                                    <input type="password" required="" id="password_confirmation" name="password_confirmation" placeholder="Confirm New Password" />
                                                    <button type="button" class="password-toggle-btn" onclick="togglePassword('password_confirmation', this)" title="Show password">
                                                        <svg class="eye-open" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                                        <svg class="eye-closed" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-heading btn-block hover-up" name="login">Reset Password</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 pl-50 d-none d-lg-block">
                                <h6 class="mb-15">Password must:</h6>
                                <p>Be between 9 and 64 characters</p>
                                <p>Include at least two of the following:</p>
                                <ol class="list-insider">
                                    <li>An uppercase character</li>
                                    <li>A lowercase character</li>
                                    <li>A number</li>
                                    <li>A special character</li>
                                </ol>
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

      <script type="text/javascript">
         // ── Password Visibility Toggle ──
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
      </script>

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
