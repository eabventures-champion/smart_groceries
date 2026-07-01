@extends('front.master')
@section('content')
@section('title')
 Account Details
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content pt-50 pb-50 account-mobile-padding" style="font-family: 'Inter', sans-serif; background: #f8fafb;">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 m-auto">
            <div class="row">
               @include('front.user.dashboard_sidebar_menu')
               <div class="col-md-9">
                  <div class="premium-account-card">
                     <!-- Card Header -->
                     <div class="account-card-header">
                        <div class="account-header-icon">
                           <i class="fi-rs-user"></i>
                        </div>
                        <div>
                           <h3 class="account-card-title">Account Details</h3>
                           <p class="account-card-subtitle">Manage your personal information and profile settings</p>
                        </div>
                     </div>

                     <!-- Avatar Section -->
                     <div class="account-avatar-section">
                        <div class="account-avatar-group">
                           <div class="account-avatar-wrap">
                              <img id="showImage" src="{{ (!empty($userData->photo)) ? url('front/assets/imgs/users/'.$userData->photo) : url('front/assets/imgs/users/no_image.jpg') }}" alt="User">
                              <label for="image" class="account-avatar-edit" title="Change photo">
                                 <i class="fi-rs-camera"></i>
                              </label>
                           </div>
                           <div class="account-avatar-info">
                              <h5 class="account-avatar-name">{{ $userData->name }}</h5>
                              <span class="account-avatar-email">{{ $userData->email }}</span>
                              <span class="account-member-badge">
                                 <i class="fi-rs-check-circle" style="margin-right: 4px;"></i> Verified Member
                              </span>
                           </div>
                        </div>
                     </div>

                     <!-- Form -->
                     <form method="post" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="account-form-body">
                           <h6 class="account-section-label">Personal Information</h6>
                           <div class="row">
                              <div class="form-group col-md-6">
                                 <label class="account-label">Username <span class="account-required">*</span></label>
                                 <div class="account-input-wrap">
                                    <span class="account-input-icon"><i class="fi-rs-at"></i></span>
                                    <input required class="account-input" name="username" type="text" value="{{ $userData->username }}" placeholder="Enter username" />
                                 </div>
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="account-label">Full Name <span class="account-required">*</span></label>
                                 <div class="account-input-wrap">
                                    <span class="account-input-icon"><i class="fi-rs-user"></i></span>
                                    <input required class="account-input" name="name" type="text" value="{{ $userData->name }}" placeholder="Enter full name" />
                                 </div>
                              </div>
                           </div>

                           <h6 class="account-section-label" style="margin-top: 10px;">Contact Information</h6>
                           <div class="row">
                              <div class="form-group col-md-6">
                                 <label class="account-label">Email Address <span class="account-required">*</span></label>
                                 <div class="account-input-wrap">
                                    <span class="account-input-icon"><i class="fi-rs-envelope"></i></span>
                                    <input required class="account-input" name="email" type="email" value="{{ $userData->email }}" placeholder="Enter email" />
                                 </div>
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="account-label">Phone Number <span class="account-required">*</span></label>
                                 <div class="account-input-wrap">
                                    <span class="account-input-icon"><i class="fi-rs-phone-call"></i></span>
                                    <input required class="account-input" name="phone" type="text" value="{{ $userData->phone }}" placeholder="Enter phone number" />
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="form-group col-md-12">
                                 <label class="account-label">Address <span class="account-required">*</span></label>
                                 <div class="account-input-wrap">
                                    <span class="account-input-icon"><i class="fi-rs-marker"></i></span>
                                    <input required class="account-input" name="address" type="text" value="{{ $userData->address }}" placeholder="Enter your address" />
                                 </div>
                              </div>
                           </div>

                           <!-- Hidden file input -->
                           <input class="d-none" name="photo" type="file" id="image" accept="image/*" />

                           <!-- Save Button -->
                           <div class="account-actions">
                              <button type="submit" class="account-save-btn">
                                 <i class="fi-rs-check" style="margin-right: 6px;"></i> Save Changes
                              </button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<style>
   /* ===== Premium Account Card ===== */
   .premium-account-card {
      background: #ffffff;
      border-radius: 20px;
      border: 1px solid #f1f2f4;
      box-shadow: 0 10px 40px rgba(0,0,0,0.03);
      overflow: hidden;
   }

   /* Card Header */
   .account-card-header {
      display: flex;
      align-items: center;
      padding: 28px 32px;
      border-bottom: 1px solid #f1f2f4;
      background: linear-gradient(135deg, #fafffe 0%, #f8fbfa 100%);
   }
   .account-header-icon {
      width: 48px;
      height: 48px;
      border-radius: 14px;
      background: rgba(59, 183, 126, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #3bb77e;
      font-size: 20px;
      margin-right: 18px;
      flex-shrink: 0;
   }
   .account-card-title {
      font-family: 'Outfit', sans-serif;
      font-weight: 800;
      font-size: 22px;
      color: #253D4E;
      margin: 0 0 3px;
   }
   .account-card-subtitle {
      font-size: 13px;
      color: #9ca3af;
      margin: 0;
      font-weight: 400;
   }

   /* Avatar Section */
   .account-avatar-section {
      padding: 28px 32px;
      border-bottom: 1px solid #f1f2f4;
   }
   .account-avatar-group {
      display: flex;
      align-items: center;
      gap: 20px;
   }
   .account-avatar-wrap {
      position: relative;
      flex-shrink: 0;
   }
   .account-avatar-wrap img {
      width: 88px;
      height: 88px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #f1f2f4;
      transition: border-color 0.3s ease;
   }
   .account-avatar-wrap:hover img {
      border-color: #3bb77e;
   }
   .account-avatar-edit {
      position: absolute;
      bottom: 2px;
      right: 2px;
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background: #3bb77e;
      color: #fff;
      border: 2.5px solid #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      cursor: pointer;
      transition: transform 0.2s ease, background 0.2s ease;
      box-shadow: 0 2px 8px rgba(59, 183, 126, 0.3);
   }
   .account-avatar-edit:hover {
      transform: scale(1.1);
      background: #2fa56d;
   }
   .account-avatar-name {
      font-family: 'Outfit', sans-serif;
      font-weight: 700;
      font-size: 18px;
      color: #253D4E;
      margin: 0 0 2px;
   }
   .account-avatar-email {
      font-size: 13px;
      color: #9ca3af;
      display: block;
      margin-bottom: 8px;
   }
   .account-member-badge {
      display: inline-flex;
      align-items: center;
      background: #f0fdf4;
      color: #16a34a;
      font-size: 12px;
      font-weight: 600;
      padding: 4px 12px;
      border-radius: 20px;
      border: 1px solid #bbf7d0;
   }

   /* Form Body */
   .account-form-body {
      padding: 28px 32px 32px;
   }
   .account-section-label {
      font-family: 'Outfit', sans-serif;
      font-weight: 700;
      font-size: 14px;
      color: #253D4E;
      margin: 0 0 18px;
      padding-bottom: 10px;
      border-bottom: 1px solid #f1f2f4;
      text-transform: uppercase;
      letter-spacing: 0.5px;
   }
   .account-label {
      font-size: 13px;
      font-weight: 600;
      color: #475569;
      margin-bottom: 6px;
      display: block;
   }
   .account-required {
      color: #ef4444;
   }
   .account-input-wrap {
      position: relative;
      margin-bottom: 8px;
   }
   .account-input-icon {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
      font-size: 15px;
      display: flex;
      align-items: center;
      pointer-events: none;
      z-index: 1;
   }
   .account-input {
      width: 100%;
      padding: 12px 14px 12px 42px;
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      font-size: 14px;
      color: #253D4E;
      font-family: 'Inter', sans-serif;
      font-weight: 500;
      background: #fafbfc;
      transition: all 0.25s ease;
      outline: none;
   }
   .account-input:hover {
      border-color: #d1d5db;
      background: #fff;
   }
   .account-input:focus {
      border-color: #3bb77e;
      background: #fff;
      box-shadow: 0 0 0 3px rgba(59, 183, 126, 0.1);
   }
   .account-input::placeholder {
      color: #cbd5e1;
      font-weight: 400;
   }

   /* Actions */
   .account-actions {
      margin-top: 24px;
      padding-top: 20px;
      border-top: 1px solid #f1f2f4;
   }
   .account-save-btn {
      background: #3bb77e;
      color: #fff;
      border: none;
      padding: 14px 36px;
      font-family: 'Outfit', sans-serif;
      font-weight: 700;
      font-size: 15px;
      border-radius: 30px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      transition: all 0.3s ease;
      box-shadow: 0 6px 20px rgba(59, 183, 126, 0.25);
   }
   .account-save-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 28px rgba(59, 183, 126, 0.35);
   }
   .account-save-btn:active {
      transform: translateY(0);
   }

   /* Mobile adjustments */
   @media (max-width: 768px) {
      .account-card-header,
      .account-avatar-section,
      .account-form-body {
         padding: 20px;
      }
      .account-avatar-group {
         flex-direction: column;
         text-align: center;
      }
      .account-card-title {
         font-size: 18px;
      }
   }
</style>

<script type="text/javascript">
   $(document).ready(function(){
       $('#image').change(function(e){
           var reader = new FileReader();
           reader.onload = function(e){
               $('#showImage').attr('src', e.target.result);
           }
           reader.readAsDataURL(e.target.files['0']);
       });
   });
</script>
@endsection
