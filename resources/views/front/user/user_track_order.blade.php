@extends('front.master')
@section('title')
 Track your Order
@endsection
@section('content')
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
                        <div class="account-header-icon" style="background: rgba(37, 99, 235, 0.1); color: #2563eb;">
                           <i class="fi fi-rs-map-location-track"></i>
                        </div>
                        <div>
                           <h3 class="account-card-title">Track Your Order</h3>
                           <p class="account-card-subtitle">Enter your order invoice number to check current shipping and delivery status</p>
                        </div>
                     </div>

                     <!-- Form Body -->
                     <form method="post" action="{{ route('order.tracking') }}">
                        @csrf
                        <div class="account-form-body">
                           <div class="row">
                              <!-- Invoice Code -->
                              <div class="form-group col-md-12 mb-20">
                                 <label class="account-label">Invoice Number <span class="account-required">*</span></label>
                                 <div class="account-input-wrap">
                                    <span class="account-input-icon"><i class="fi-rs-label"></i></span>
                                    <input class="account-input" name="code" type="text" placeholder="e.g. 1782946214" required />
                                 </div>
                              </div>
                           </div>

                           <!-- Actions -->
                           <div class="account-actions">
                              <button type="submit" class="account-save-btn" style="background: #2563eb; box-shadow: 0 6px 20px rgba(37, 99, 235, 0.25);">
                                 <i class="fi-rs-map-location-track" style="margin-right: 6px;"></i> Track Order
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
      background: linear-gradient(135deg, #eff6ff 0%, #eff6ff33 100%);
   }
   .account-header-icon {
      width: 48px;
      height: 48px;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
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
      color: #94a3b8;
      margin: 0;
      font-weight: 500;
   }

   /* Form Body */
   .account-form-body {
      padding: 28px 32px 32px;
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
      border-color: #2563eb;
      background: #fff;
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
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
   }
   .account-save-btn:hover {
      transform: translateY(-2px);
   }
   .account-save-btn:active {
      transform: translateY(0);
   }

   @media (max-width: 768px) {
      .account-card-header,
      .account-form-body {
         padding: 20px;
      }
   }
</style>
@endsection
