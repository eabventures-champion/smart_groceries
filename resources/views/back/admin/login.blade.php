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
      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
      <title>Admin login</title>
      <style>
         *, *::before, *::after { box-sizing: border-box; }

         body.sg-login-body {
            margin: 0; padding: 0;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 40%, #0f3460 100%);
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
            position: relative;
         }

         /* Floating decorative circles */
         .sg-bg-circle {
            position: absolute; border-radius: 50%;
            opacity: 0.06; pointer-events: none;
         }
         .sg-bg-circle-1 {
            width: 500px; height: 500px; top: -150px; right: -100px;
            background: #3BB77E;
         }
         .sg-bg-circle-2 {
            width: 350px; height: 350px; bottom: -100px; left: -80px;
            background: #e74c3c;
         }
         .sg-bg-circle-3 {
            width: 200px; height: 200px; top: 40%; left: 15%;
            background: #f39c12;
         }

         /* Login Container */
         .sg-login-wrapper {
            width: 100%; max-width: 440px;
            padding: 0 20px;
            position: relative; z-index: 2;
            margin-bottom: 40px;
         }

         /* Brand Header */
         .sg-brand-header {
            text-align: center; margin-bottom: 30px; margin-top: 40px;
         }
         .sg-brand-header img {
            width: 90px; height: 90px;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.3);
            border: 3px solid rgba(255,255,255,0.1);
         }
         .sg-brand-title {
            margin-top: 16px;
            font-size: 24px; font-weight: 800;
            color: #fff; letter-spacing: -0.5px;
         }
         .sg-brand-title span { color: #3BB77E; }
         .sg-brand-sub {
            font-size: 13px; color: rgba(255,255,255,0.5);
            margin-top: 4px; font-weight: 500;
         }

         /* Card */
         .sg-login-card {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 20px;
            padding: 36px 32px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
         }

         .sg-card-title {
            font-size: 20px; font-weight: 700; color: #fff;
            text-align: center; margin-bottom: 6px;
         }
         .sg-card-subtitle {
            font-size: 13px; color: rgba(255,255,255,0.45);
            text-align: center; margin-bottom: 28px; font-weight: 500;
         }

         /* Form Labels */
         .sg-form-label {
            display: block; font-size: 12px; font-weight: 600;
            color: rgba(255,255,255,0.6);
            margin-bottom: 6px; text-transform: uppercase;
            letter-spacing: 0.5px;
         }

         /* Inputs */
         .sg-input-group {
            margin-bottom: 20px; position: relative;
         }
         .sg-input {
            width: 100%; padding: 14px 16px; padding-left: 44px;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 12px; color: #fff;
            font-size: 14px; font-weight: 500;
            transition: all 0.3s ease;
            outline: none;
         }
         .sg-input::placeholder {
            color: rgba(255,255,255,0.3);
         }
         .sg-input:focus {
            border-color: #3BB77E;
            background: rgba(59,183,126,0.08);
            box-shadow: 0 0 0 3px rgba(59,183,126,0.15);
         }
         .sg-input-icon {
            position: absolute; left: 14px; top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.35); font-size: 18px;
            pointer-events: none;
         }
         .sg-input-icon-right {
            position: absolute; right: 14px; top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.35); font-size: 18px;
            cursor: pointer; background: none; border: none;
            transition: color 0.2s;
         }
         .sg-input-icon-right:hover { color: #3BB77E; }

         /* Remember / Forgot Row */
         .sg-options-row {
            display: flex; align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
         }
         .sg-remember {
            display: flex; align-items: center; gap: 8px;
            cursor: pointer;
         }
         .sg-remember input[type="checkbox"] {
            width: 16px; height: 16px; accent-color: #3BB77E;
            cursor: pointer;
         }
         .sg-remember-text {
            font-size: 13px; color: rgba(255,255,255,0.55); font-weight: 500;
         }
         .sg-forgot {
            font-size: 13px; color: #3BB77E; font-weight: 600;
            text-decoration: none; transition: color 0.2s;
         }
         .sg-forgot:hover { color: #2ecc71; }

         /* Submit Button */
         .sg-submit-btn {
            width: 100%; padding: 14px;
            background: linear-gradient(135deg, #3BB77E 0%, #27ae60 100%);
            border: none; border-radius: 12px;
            color: #fff; font-size: 15px; font-weight: 700;
            cursor: pointer; transition: all 0.3s ease;
            display: flex; align-items: center;
            justify-content: center; gap: 8px;
            letter-spacing: 0.3px;
            box-shadow: 0 4px 15px rgba(59,183,126,0.3);
         }
         .sg-submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59,183,126,0.4);
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
         }
         .sg-submit-btn:active { transform: translateY(0); }
         .sg-submit-btn i { font-size: 18px; }

         /* Footer */
         .sg-login-footer {
            text-align: center; margin-top: 24px;
         }
         .sg-home-link {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 13px; color: rgba(255,255,255,0.4);
            font-weight: 600; text-decoration: none;
            transition: color 0.2s;
         }
         .sg-home-link:hover { color: #3BB77E; }
         .sg-home-link i { font-size: 16px; }

         /* Validation error */
         .sg-error { color: #e74c3c; font-size: 12px; margin-top: 6px; }

         /* Responsive */
         @media (max-width: 480px) {
            .sg-login-card { padding: 28px 22px; }
            .sg-brand-header img { width: 70px; height: 70px; }
            .sg-brand-title { font-size: 20px; }
         }
      </style>
   </head>
   <body class="sg-login-body">
      <!-- Background Circles -->
      <div class="sg-bg-circle sg-bg-circle-1"></div>
      <div class="sg-bg-circle sg-bg-circle-2"></div>
      <div class="sg-bg-circle sg-bg-circle-3"></div>

      <div class="sg-login-wrapper">
         <!-- Brand -->
         <div class="sg-brand-header">
            <a href="/"><img src="{{ asset('front/assets/imgs/theme/smart_5.png') }}" alt="Smart Groceries" /></a>
            <div class="sg-brand-title">Smart <span>Groceries</span></div>
            <div class="sg-brand-sub">Admin Control Panel</div>
         </div>

         <!-- Card -->
         <div class="sg-login-card">
            <div class="sg-card-title">Welcome Back</div>
            <div class="sg-card-subtitle">Sign in to your admin dashboard</div>

            <form method="POST" action="{{ route('login') }}">
               @csrf

               <!-- Email -->
               <div class="sg-input-group">
                  <i class="bx bx-envelope sg-input-icon"></i>
                  <input type="email" name="email" class="sg-input" id="email" placeholder="Email Address" required>
               </div>

               <!-- Password -->
               <div class="sg-input-group" id="show_hide_password">
                  <i class="bx bx-lock-alt sg-input-icon"></i>
                  <input type="password" name="password" class="sg-input" id="password" placeholder="Password" style="padding-right: 44px;" required>
                  <a href="javascript:;" class="sg-input-icon-right"><i class="bx bx-hide"></i></a>
               </div>

               <!-- Options -->
               <div class="sg-options-row">
                  <label class="sg-remember">
                     <input type="checkbox" checked>
                     <span class="sg-remember-text">Remember me</span>
                  </label>
                  <a href="javascript:;" class="sg-forgot">Forgot password?</a>
               </div>

               <!-- Submit -->
               <button type="submit" class="sg-submit-btn">
                  <i class="bx bxs-lock-open"></i> Sign In
               </button>
            </form>
         </div>

         <!-- Footer -->
         <div class="sg-login-footer">
            <a href="/" class="sg-home-link">
               <i class="bx bx-home-alt"></i> Back to Smart Groceries
            </a>
         </div>
      </div>

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