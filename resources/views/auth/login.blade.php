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

          /* ── Account Status Modal ── */
          .account-status-overlay {
             position: fixed;
             top: 0;
             left: 0;
             width: 100%;
             height: 100%;
             background: rgba(0, 0, 0, 0.6);
             backdrop-filter: blur(8px);
             -webkit-backdrop-filter: blur(8px);
             z-index: 99999;
             display: flex;
             align-items: center;
             justify-content: center;
             opacity: 0;
             animation: fadeInOverlay 0.4s ease forwards;
          }

          @keyframes fadeInOverlay {
             to { opacity: 1; }
          }

          .account-status-modal {
             background: #ffffff;
             border-radius: 20px;
             width: 90%;
             max-width: 460px;
             box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.1);
             overflow: hidden;
             transform: scale(0.8) translateY(30px);
             opacity: 0;
             animation: popInModal 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) 0.15s forwards;
          }

          @keyframes popInModal {
             to {
                transform: scale(1) translateY(0);
                opacity: 1;
             }
          }

          .account-status-modal .modal-accent {
             height: 6px;
             width: 100%;
          }

          .account-status-modal .modal-accent.suspended {
             background: linear-gradient(90deg, #f59e0b, #f97316, #ef4444);
          }

          .account-status-modal .modal-accent.disabled {
             background: linear-gradient(90deg, #ef4444, #dc2626, #991b1b);
          }

          .account-status-modal .modal-body-content {
             padding: 40px 36px 32px;
             text-align: center;
          }

          .account-status-modal .status-icon-wrap {
             width: 80px;
             height: 80px;
             border-radius: 50%;
             display: flex;
             align-items: center;
             justify-content: center;
             margin: 0 auto 24px;
             position: relative;
          }

          .account-status-modal .status-icon-wrap.suspended {
             background: linear-gradient(135deg, #fef3c7, #fde68a);
             box-shadow: 0 8px 24px rgba(245, 158, 11, 0.25);
          }

          .account-status-modal .status-icon-wrap.disabled {
             background: linear-gradient(135deg, #fee2e2, #fecaca);
             box-shadow: 0 8px 24px rgba(239, 68, 68, 0.25);
          }

          .account-status-modal .status-icon-wrap svg {
             width: 36px;
             height: 36px;
          }

          .account-status-modal .status-icon-wrap.suspended svg {
             color: #d97706;
          }

          .account-status-modal .status-icon-wrap.disabled svg {
             color: #dc2626;
          }

          .status-icon-wrap .pulse-ring {
             position: absolute;
             width: 100%;
             height: 100%;
             border-radius: 50%;
             animation: pulseRing 2s ease-out infinite;
          }

          .status-icon-wrap.suspended .pulse-ring {
             border: 2px solid rgba(245, 158, 11, 0.4);
          }

          .status-icon-wrap.disabled .pulse-ring {
             border: 2px solid rgba(239, 68, 68, 0.4);
          }

          @keyframes pulseRing {
             0% { transform: scale(1); opacity: 1; }
             100% { transform: scale(1.5); opacity: 0; }
          }

          .account-status-modal h3 {
             font-size: 22px;
             font-weight: 700;
             color: #1f2937;
             margin-bottom: 12px;
             letter-spacing: -0.3px;
          }

          .account-status-modal .status-message {
             font-size: 15px;
             color: #6b7280;
             line-height: 1.6;
             margin-bottom: 28px;
          }

          .account-status-modal .info-card {
             border-radius: 12px;
             padding: 16px 20px;
             margin-bottom: 28px;
             display: flex;
             align-items: flex-start;
             gap: 12px;
             text-align: left;
          }

          .account-status-modal .info-card.suspended {
             background: #fffbeb;
             border: 1px solid #fde68a;
          }

          .account-status-modal .info-card.disabled {
             background: #fef2f2;
             border: 1px solid #fecaca;
          }

          .account-status-modal .info-card svg {
             width: 20px;
             height: 20px;
             flex-shrink: 0;
             margin-top: 2px;
          }

          .account-status-modal .info-card.suspended svg {
             color: #d97706;
          }

          .account-status-modal .info-card.disabled svg {
             color: #dc2626;
          }

          .account-status-modal .info-card p {
             font-size: 13px;
             color: #4b5563;
             margin: 0;
             line-height: 1.5;
          }

          .account-status-modal .modal-btn {
             display: inline-flex;
             align-items: center;
             justify-content: center;
             gap: 8px;
             width: 100%;
             padding: 14px 24px;
             border: none;
             border-radius: 12px;
             font-size: 15px;
             font-weight: 600;
             cursor: pointer;
             transition: all 0.3s ease;
             text-decoration: none;
             color: #fff;
          }

          .account-status-modal .modal-btn.suspended {
             background: linear-gradient(135deg, #f59e0b, #d97706);
             box-shadow: 0 4px 14px rgba(245, 158, 11, 0.4);
          }

          .account-status-modal .modal-btn.suspended:hover {
             transform: translateY(-2px);
             box-shadow: 0 6px 20px rgba(245, 158, 11, 0.5);
          }

          .account-status-modal .modal-btn.disabled {
             background: linear-gradient(135deg, #ef4444, #dc2626);
             box-shadow: 0 4px 14px rgba(239, 68, 68, 0.4);
          }

          .account-status-modal .modal-btn.disabled:hover {
             transform: translateY(-2px);
             box-shadow: 0 6px 20px rgba(239, 68, 68, 0.5);
          }

          .account-status-modal .contact-link {
             display: block;
             margin-top: 16px;
             font-size: 13px;
             color: #9ca3af;
             text-decoration: none;
             transition: color 0.2s;
          }

          .account-status-modal .contact-link:hover {
             color: #6b7280;
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

      {{-- ── Premium Account Status Modal ── --}}
      @if(Session::has('account_status'))
      @php $accountStatus = Session::get('account_status'); @endphp
      <div class="account-status-overlay" id="accountStatusOverlay">
         <div class="account-status-modal">
            <div class="modal-accent {{ $accountStatus }}"></div>
            <div class="modal-body-content">
               {{-- Icon --}}
               <div class="status-icon-wrap {{ $accountStatus }}">
                  <div class="pulse-ring"></div>
                  @if($accountStatus === 'suspended')
                     <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="10" y1="15" x2="10" y2="9"></line>
                        <line x1="14" y1="15" x2="14" y2="9"></line>
                     </svg>
                  @else
                     <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line>
                     </svg>
                  @endif
               </div>

               {{-- Title --}}
               <h3>
                  @if($accountStatus === 'suspended')
                     Account Suspended
                  @else
                     Account Disabled
                  @endif
               </h3>

               {{-- Message --}}
               <p class="status-message">
                  @if($accountStatus === 'suspended')
                     Your account has been temporarily suspended by an administrator. Access to all services is currently restricted.
                  @else
                     Your account has been permanently disabled by an administrator. You no longer have access to this platform.
                  @endif
               </p>

               {{-- Info Card --}}
               <div class="info-card {{ $accountStatus }}">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                     <circle cx="12" cy="12" r="10"></circle>
                     <line x1="12" y1="8" x2="12" y2="12"></line>
                     <line x1="12" y1="16" x2="12.01" y2="16"></line>
                  </svg>
                  <p>
                     @if($accountStatus === 'suspended')
                        This may be due to a policy violation or security concern. Please reach out to our support team to resolve this and restore your account access.
                     @else
                        This action is permanent unless reversed by an administrator. If you believe this was done in error, please contact our support team immediately.
                     @endif
                  </p>
               </div>

               {{-- Action Button --}}
               <a href="mailto:support@smartgroceries.com" class="modal-btn {{ $accountStatus }}">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                     <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                     <polyline points="22,6 12,13 2,6"></polyline>
                  </svg>
                  Contact Support
               </a>

               <a href="{{ url('/') }}" class="contact-link">← Return to Homepage</a>
            </div>
         </div>
      </div>
      @endif

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
