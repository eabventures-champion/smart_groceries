{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}



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
    <link rel="stylesheet" href="{{ asset('front/assets/css/main.css?v=5.3') }}" />
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
                                        <form method="post" action="{{ route('password.store') }}">
                                            @csrf
                                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                            <div class="form-group">
                                                <input type="email" required="" id="email" name="email" value="{{ $request->email }}" readonly />
                                            </div>
                                            <div class="form-group">
                                                <input type="password" required="" id="password" name="password" placeholder="New Password"  required />
                                            </div>
                                            <div class="form-group">
                                                <input type="password" required="" id="password_confirmation" name="password_confirmation" placeholder="Confirm New Password"  required />
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
                                <p>Include at least tow of the following:</p>
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
    <link rel="stylesheet" href="{{ asset('front/assets/css/main.css?v=5.3') }}" />
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
                                        <form method="post" action="{{ route('password.store') }}">
                                            @csrf
                                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                            <div class="form-group">
                                                <input type="email" required="" id="email" name="email" value="{{ $request->email }}" readonly />
                                            </div>
                                            <div class="form-group">
                                                <input type="password" required="" id="password" name="password" placeholder="New Password"  required />
                                            </div>
                                            <div class="form-group">
                                                <input type="password" required="" id="password_confirmation" name="password_confirmation" placeholder="Confirm New Password"  required />
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
                                <p>Include at least tow of the following:</p>
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
