<!DOCTYPE html>
<html class="no-js" lang="en">
   <head>
      <meta charset="utf-8" />
      <title>Smart Groceries &amp; Delivery - Register</title>
      <meta http-equiv="x-ua-compatible" content="ie=edge" />
      <meta name="description" content="Create your Smart Groceries student account" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <meta property="og:title" content="Register - Smart Groceries" />
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

         /* ── Year Select Styling ── */
         .year-select-group {
            display: flex;
            gap: 12px;
         }
         .year-select-group .form-group {
            flex: 1;
         }
         .year-select-group select.form-control,
         select.institution-select,
         select.status-identity-select {
            height: 48px;
            border-radius: 10px;
            border: 1px solid #ced4da;
            color: #555;
            font-size: 14px;
            padding: 0 12px;
            appearance: none;
            background: white url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23999' d='M6 8L1 3h10z'/%3E%3C/svg%3E") no-repeat right 14px center;
            cursor: pointer;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            width: 100%;
         }
         .year-select-group select.form-control:focus,
         select.institution-select:focus,
         select.status-identity-select:focus {
            border-color: #3BB77E;
            box-shadow: 0 0 0 3px rgba(59, 183, 126, 0.12);
            outline: none;
         }

         /* ── Form Label ── */
         .form-label-sm {
            font-size: 12px;
            font-weight: 600;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
            display: block;
         }

         /* ── Student Info Note ── */
         .student-info-note {
            background: linear-gradient(135deg, #e8f5e9, #f1f8e9);
            border-left: 4px solid #3BB77E;
            padding: 12px 16px;
            border-radius: 0 8px 8px 0;
            margin-bottom: 20px;
            font-size: 13px;
            color: #555;
         }
         .student-info-note strong {
            color: #2e7d32;
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
                     <form id="myForm_type" method="post" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="ref" value="{{ old('ref', request()->query('ref')) }}">
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

                                       <!-- Full Name -->
                                       <div class="form-group">
                                          <input type="text" required="" id="name" name="name" placeholder="Full name" class="form-control @error('name') is-invalid @enderror" />
                                          @error('name')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>

                                       <!-- Email -->
                                       <div class="form-group">
                                          <input type="email" required="" id="email" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" />
                                          @error('email')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>

                                       <!-- Status Identity -->
                                       <div class="form-group">
                                          <select name="status_identity" id="status_identity" class="form-control status-identity-select @error('status_identity') is-invalid @enderror" required>
                                             <option value="" disabled {{ old('status_identity') === null ? 'selected' : '' }}>-- Status Identity --</option>
                                             <option value="student" {{ old('status_identity') == 'student' ? 'selected' : '' }}>student</option>
                                             <option value="non-student" {{ old('status_identity') == 'non-student' ? 'selected' : '' }}>non-student</option>
                                          </select>
                                          @error('status_identity')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>

                                       <!-- Student Options Container -->
                                       <div id="student-options-container">
                                          <!-- Institution -->
                                          <div class="form-group">
                                             <select name="institution" id="institution" class="form-control institution-select @error('institution') is-invalid @enderror" required>
                                                <option value="" disabled {{ old('institution') === null ? 'selected' : '' }}>-- Select Institution --</option>
                                                @foreach($institutions as $inst)
                                                   <option value="{{ $inst->district_name }}" {{ old('institution') == $inst->district_name ? 'selected' : '' }}>{{ $inst->district_name }}</option>
                                                @endforeach
                                             </select>
                                             @error('institution')
                                             <span class="text-danger">{{ $message }}</span>
                                             @enderror
                                          </div>

                                          <!-- Student Fields Group -->
                                          <div id="student-fields-group">
                                             <!-- Year of Admission & Completion -->
                                             <div class="student-info-note">
                                                <strong>📚 Campus Student:</strong> Select your academic admission and expected completion years.
                                             </div>
                                             <div class="year-select-group">
                                                <div class="form-group">
                                                   <label class="form-label-sm">Year of Admission</label>
                                                   <select name="year_of_admission" id="year_of_admission" class="form-control @error('year_of_admission') is-invalid @enderror" required>
                                                      <option value="">-- Select --</option>
                                                      @for($y = date('Y'); $y >= date('Y') - 10; $y--)
                                                         <option value="{{ $y }}" {{ old('year_of_admission') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                                      @endfor
                                                   </select>
                                                   @error('year_of_admission')
                                                   <span class="text-danger">{{ $message }}</span>
                                                   @enderror
                                                </div>
                                                <div class="form-group">
                                                   <label class="form-label-sm">Year of Completion</label>
                                                   <select name="year_of_completion" id="year_of_completion" class="form-control @error('year_of_completion') is-invalid @enderror" required>
                                                      <option value="">-- Select --</option>
                                                      @for($y = date('Y') - 5; $y <= date('Y') + 10; $y++)
                                                         <option value="{{ $y }}" {{ old('year_of_completion') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                                      @endfor
                                                   </select>
                                                   @error('year_of_completion')
                                                   <span class="text-danger">{{ $message }}</span>
                                                   @enderror
                                                </div>
                                             </div>
                                          </div>
                                       </div>

                                       <!-- Password -->
                                       <div class="form-group">
                                          <div class="password-wrapper">
                                             <input required="" type="password" id="password" name="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" />
                                             <button type="button" class="password-toggle-btn" onclick="togglePassword('password', this)" title="Show password">
                                                <svg class="eye-open" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                                <svg class="eye-closed" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                                             </button>
                                          </div>
                                          @error('password')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>

                                       <!-- Confirm Password -->
                                       <div class="form-group">
                                          <div class="password-wrapper">
                                             <input required="" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" class="form-control @error('password_confirmation') is-invalid @enderror" />
                                             <button type="button" class="password-toggle-btn" onclick="togglePassword('password_confirmation', this)" title="Show password">
                                                <svg class="eye-open" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                                <svg class="eye-closed" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                                             </button>
                                          </div>
                                          @error('password_confirmation')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                       </div>

                                       <!-- Register Card -->
                                       <div class="card-login" style="margin-left: 0;">
                                          <p class="font-md text-muted text-center"><strong>Note: </strong>Your personal data will be used to support your experience throughout this website, to manage access to your account.</p>
                                          <div class="form-group text-center">
                                             <button type="submit" class="btn btn-fill-out btn-block hover-up font-weight-bold" name="login">Register</button>
                                          </div>
                                       </div>

                                 </div>
                              </div>
                           </div>

                           <div class="col-lg-6 d-lg-block">
                              <!-- Student Image Card -->
                              <div style="margin-top: 60px; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #f0f0f0;">
                                 <img src="{{ asset('front/assets/imgs/page/campus_students.png') }}" alt="Campus Students" style="width: 100%; height: auto; display: block;" />
                                 <div style="padding: 16px 20px; text-align: center;">
                                    <p style="margin: 0; font-size: 14px; color: #555; line-height: 1.5;">
                                       <strong style="color: #3BB77E;">🎓 Join your campus community!</strong><br>
                                       <span style="font-size: 13px; color: #888;">Smart Groceries — built for students, by students.</span>
                                    </p>
                                 </div>
                              </div>
                           </div>

                        </div>
                     </form>
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
             $('#status_identity').on('change', function(e, isInitial) {
                var status = $(this).val();
                if (status === 'student') {
                   if (isInitial) {
                      $('#student-options-container').show();
                   } else {
                      $('#student-options-container').slideDown();
                   }
                   $('#institution, #year_of_admission, #year_of_completion').prop('disabled', false);
                } else {
                   if (isInitial) {
                      $('#student-options-container').hide();
                   } else {
                      $('#student-options-container').slideUp();
                   }
                   $('#institution, #year_of_admission, #year_of_completion').prop('disabled', true).val('');
                }
             });
             $('#status_identity').trigger('change', [true]);

             $('#myForm_type').validate({
                 rules: {
                  name: {
                     required : true,
                  },
                  email: {
                     required : true,
                  },
                  institution: {
                     required : true,
                  },
                  status_identity: {
                     required : true,
                  },
                  year_of_admission: {
                     required : true,
                  },
                  year_of_completion: {
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
                  institution: {
                     required : 'Please Select Your Institution',
                  },
                  status_identity: {
                     required : 'Please Select Your Status Identity',
                  },
                  year_of_admission: {
                     required : 'Please Select Admission Year',
                  },
                  year_of_completion: {
                     required : 'Please Select Completion Year',
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
