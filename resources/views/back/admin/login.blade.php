<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!--favicon-->
      <link rel="icon" href="{{ asset('back/') }}assets/images/favicon-32x32.png" type="image/png" />
      <!--plugins-->
      <link href="{{ asset('back/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
      <link href="{{ asset('back/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
      <link href="{{ asset('back/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
      <!-- loader-->
      <link href="{{ asset('back/assets/css/pace.min.css') }}" rel="stylesheet" />
      <script src="{{ asset('back/assets/js/pace.min.js') }}"></script>
      <!-- Bootstrap CSS -->
      <link href="{{ asset('back/assets/css/bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ asset('back/assets/css/app.css') }}" rel="stylesheet">
      <link href="{{ asset('back/assets/css/icons.css') }}" rel="stylesheet">
      <title>Admin login</title>
      <style>
         .back-home-link:hover {
            color: #0d6efd !important;
         }
      </style>
   </head>
   <body class="bg-login">
      <!--wrapper-->
      <div class="wrapper">
         <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
               <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                  <div class="col mx-auto">
                     <div class="mb-4 text-center">
                        <a href="/"><img src="{{ asset('front/assets/imgs/theme/smart_grocery_2.jpg') }}" width="180" alt="" /></a>
                        {{-- <img src="{{ asset('back/assets/images/logo-img.png') }}" width="180" alt="" /> --}}
                        {{-- <a href="/" class=""><img src="{{ asset('front/assets/imgs/theme/SnS_Logo.svg') }}" alt="logo" /></a> --}}
                     </div>
                     <div class="card">
                        <div class="card-body">
                           <div class="border p-4 rounded">
                              <div class="text-center position-relative mb-4">
                                 <a href="/" class="position-absolute start-0 top-50 translate-middle-y text-secondary back-home-link" title="Back to Homepage" style="font-size: 24px; transition: color 0.2s; padding-left: 5px;">
                                    <i class="bx bx-home-alt"></i>
                                 </a>
                                 <h3 class="mb-0">Admin Sign in</h3>
                              </div>
                              {{-- <div class="d-grid">
                                 <a class="btn my-4 shadow-sm btn-white" href="javascript:;"> <span class="d-flex justify-content-center align-items-center">
                                 <img class="me-2" src="{{ asset('back/assets/images/icons/search.svg') }}" width="16" alt="Image Description">
                                 <span>Sign in with Google</span>
                                 </span>
                                 </a> <a href="javascript:;" class="btn btn-facebook"><i class="bx bxl-facebook"></i>Sign in with Facebook</a>
                              </div> --}}
                              {{-- <div class="login-separater text-center mb-4">
                                 <span>OR SIGN IN WITH EMAIL</span>
                                 <hr/>
                              </div> --}}
                              <div class="form-body">
                                 <form class="row g-3" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="col-12">
                                       <label for="inputEmailAddress" class="form-label">Email Address</label>
                                       <input type="email" name="email" class="form-control" id="email" placeholder="Email Address">
                                    </div>
                                    <div class="col-12">
                                       <label for="inputChoosePassword" class="form-label">Enter Password</label>
                                       <div class="input-group" id="show_hide_password">
                                          <input type="password" name="password" class="form-control border-end-0" id="password" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                          <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                                       </div>
                                    </div>
                                    <div class="col-md-6 text-end">	<a href="authentication-forgot-password.html">Forgot Password ?</a>
                                    </div>
                                    <div class="col-12">
                                       <div class="d-grid">
                                          <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign in</button>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--end row-->
            </div>
         </div>
      </div>
      <!--end wrapper-->
      <!-- Bootstrap JS -->
      <script src="{{ asset('back/assets/js/bootstrap.bundle.min.js') }}"></script>
      <!--plugins-->
      <script src="{{ asset('back/assets/js/jquery.min.js') }}"></script>
      <script src="{{ asset('back/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
      <script src="{{ asset('back/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
      <script src="{{ asset('back/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
      <!--Password show & hide js -->
      <script>
         $(document).ready(function () {
         	$("#show_hide_password a").on('click', function (event) {
         		event.preventDefault();
         		if ($('#show_hide_password input').attr("type") == "text") {
         			$('#show_hide_password input').attr('type', 'password');
         			$('#show_hide_password i').addClass("bx-hide");
         			$('#show_hide_password i').removeClass("bx-show");
         		} else if ($('#show_hide_password input').attr("type") == "password") {
         			$('#show_hide_password input').attr('type', 'text');
         			$('#show_hide_password i').removeClass("bx-hide");
         			$('#show_hide_password i').addClass("bx-show");
         		}
         	});
         });
      </script>
      <!--app JS-->
      <script src="{{ asset('back/assets/js/app.js') }}"></script>
   </body>
</html>