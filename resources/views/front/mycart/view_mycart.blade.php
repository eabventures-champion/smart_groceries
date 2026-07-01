@extends('front.master')
@section('content')
@section('title')
MyCart Page 
@endsection

<div class="page-header breadcrumb-wrap">
   <div class="container">
      <div class="breadcrumb">
         <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a> 
         <span></span> Cart
      </div>
   </div>
</div>

@if (Cart::content()->count() > 0)

<div class="container mb-80 mt-50" style="font-family: 'Outfit', sans-serif;">
   <div class="row mb-40">
      <div class="col-lg-12 text-center">
         <h2 style="font-weight: 800; color: #253D4E; margin: 0; font-size: 32px;">Shopping Cart</h2>
         <p class="text-muted" style="font-family: 'Inter', sans-serif; font-size: 14px; margin-top: 5px;">
            You have <strong style="color: #3bb77e;" id="cartCountHeader">{{ Cart::content()->count() }}</strong> items in your cart.
         </p>
         <div class="mt-15">
            <a href="{{ route('cart.empty') }}" class="text-muted" style="font-family: 'Inter', sans-serif; font-size: 14px; font-weight: 600; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#e74c3c';" onmouseout="this.style.color='#7e7e7e';">
               <i class="fi-rs-trash mr-5"></i>Clear All Cart Items
            </a>
         </div>
      </div>
   </div>
   
   <div class="row">
      <!-- Cart Items Table Card -->
      <div class="col-lg-12">
         <div class="card border-0 p-4 mb-4" style="background: #ffffff; border-radius: 20px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.03); border: 1px solid #f1f2f4; overflow: hidden;">
            <div class="table-responsive shopping-summery">
               <table class="table table-wishlist align-middle" style="margin-bottom: 0;">
                  <thead>
                     <tr class="main-heading">
                        <th class="custome-checkbox start"></th>
                        <th scope="col" style="font-weight: 700; color: #253D4E;">Product</th>
                        <th scope="col" style="font-weight: 700; color: #253D4E;">Unit Price</th>
                        <th scope="col" style="font-weight: 700; color: #253D4E;">Properties</th>
                        <th scope="col" style="font-weight: 700; color: #253D4E;">Quantity</th>
                        <th scope="col" style="font-weight: 700; color: #253D4E;">Subtotal</th>
                        <th scope="col" class="end" style="font-weight: 700; color: #253D4E;">Remove</th>
                     </tr>
                  </thead>
                  <tbody id="cartPage" style="font-family: 'Inter', sans-serif;"></tbody>
               </table>
            </div>
         </div>
      </div>
   </div>

   <div class="row mt-30">
      <!-- Coupon Application Card -->
      <div class="col-lg-5 mb-4">
         @if(Session::has('coupon'))
         @else
         <div class="card border-0 p-4" style="background: #ffffff; border-radius: 20px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.03); border: 1px solid #f1f2f4; height: 100%;">
            <div class="d-flex align-items-center mb-4">
               <div style="background: rgba(59, 183, 126, 0.1); width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 15px; color: #3bb77e; font-size: 20px;">
                  <i class="fi-rs-label"></i>
               </div>
               <h4 style="margin: 0; font-weight: 700; color: #253D4E; font-size: 20px;">Apply Coupon</h4>
            </div>
            
            <p class="text-muted mb-4" style="font-family: 'Inter', sans-serif; font-size: 14px; line-height: 1.5;">Have a promo code? Enter it below to redeem your discounts instantly.</p>
            
            <form action="#" style="font-family: 'Inter', sans-serif;">
               <div class="d-flex align-items-center" style="gap: 12px;">
                  <input class="form-control coupon" id="coupon_name" placeholder="Enter Coupon Code" style="border-radius: 10px; border: 1px solid #ececec; padding: 12px 15px; font-size: 14px; color: #253D4E; height: auto; flex: 1;">
                  <button type="button" onclick="applyCoupon()" class="btn" style="background-color: #3bb77e !important; border: none; color: #fff; padding: 12px 25px; font-family: 'Outfit', sans-serif; font-weight: 700; border-radius: 10px; font-size: 14px; white-space: nowrap; transition: all 0.3s ease; cursor: pointer; box-shadow: 0 4px 15px rgba(59, 183, 126, 0.15);" onmouseover="this.style.transform='translateY(-1px)';" onmouseout="this.style.transform='none';">Apply</button>
               </div>
            </form>
         </div>
         @endif   
      </div>

      <!-- Checkout / Grand Totals Card -->
      <div class="col-lg-7 mb-4">
         <div class="card border-0 p-4 cart-totals-card" style="background: #ffffff; border-radius: 20px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.03); border: 1px solid #f1f2f4;">
            <div class="d-flex align-items-center mb-3">
               <div style="background: rgba(59, 183, 126, 0.1); width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 15px; color: #3bb77e; font-size: 20px;">
                  <i class="fi-rs-shopping-cart"></i>
               </div>
               <h4 style="margin: 0; font-weight: 700; color: #253D4E; font-size: 20px;">Cart Summary</h4>
            </div>

            <div class="table-responsive">
               <table class="table no-border align-middle">
                  <tbody id="couponCalField"></tbody>
               </table>
            </div>
            
            <a href="{{ route('checkout') }}" class="btn" style="background-color: #3bb77e !important; border: none; color: #fff; padding: 16px 45px; font-family: 'Outfit', sans-serif; font-weight: 700; border-radius: 30px; font-size: 16px; display: inline-flex; align-items: center; justify-content: center; gap: 8px; width: 100%; transition: all 0.3s ease; box-shadow: 0 8px 25px rgba(59, 183, 126, 0.25); cursor: pointer; margin-top: 15px;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 30px rgba(59, 183, 126, 0.35)';" onmouseout="this.style.transform='none'; this.style.boxShadow='0 8px 25px rgba(59, 183, 126, 0.25)';">
               Proceed To Checkout <i class="fi-rs-sign-out" style="margin-left: 5px;"></i>
            </a>
         </div>
      </div>
   </div>
</div>

@else
<div class="container mb-80 mt-50" style="font-family: 'Outfit', sans-serif;">
   <div class="row justify-content-center">
      <div class="col-lg-6 text-center py-5 px-4" style="background: #ffffff; border-radius: 24px; box-shadow: 0 10px 40px rgba(0,0,0,0.03); border: 1px solid #f1f2f4; margin-top: 30px;">
         <div class="mb-4" style="animation: bounce 2s infinite ease-in-out;">
            <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24" fill="none" stroke="#bf8069" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag" style="opacity: 0.85;">
               <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
               <line x1="3" y1="6" x2="21" y2="6"></line>
               <path d="M16 10a4 4 0 0 1-8 0"></path>
            </svg>
         </div>
         <h3 class="mb-2" style="font-weight: 700; color: #253D4E; font-size: 24px;">Your Cart is Empty</h3>
         <p class="mb-4 text-muted mx-auto" style="font-family: 'Inter', sans-serif; font-size: 15px; max-width: 420px; line-height: 1.6;">
            Look like you haven't added any groceries to your cart yet. Let's go fill it up with fresh produce and provisions!
         </p>
         <a href="/" class="btn" style="background-color: #3bb77e; border: none; color: #fff; padding: 12px 35px; font-family: 'Outfit', sans-serif; font-weight: 700; border-radius: 30px; font-size: 15px; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(59, 183, 126, 0.2);">
            <i class="fi-rs-shopping-bag"></i> Continue Shopping
         </a>
      </div>
   </div>
</div>
@endif

<style>
   @keyframes bounce {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
   }
   
   /* Styling overrides for dynamically generated table items */
   .shopping-summery table.table-wishlist {
      border: none !important;
   }
   .shopping-summery table.table-wishlist thead tr {
      background: #f8f9fa !important;
      border: none !important;
   }
   .shopping-summery table.table-wishlist thead th {
      background: transparent !important;
      border: none !important;
      font-family: 'Outfit', sans-serif;
      font-weight: 700;
      color: #253D4E;
      padding: 15px 20px !important;
      text-transform: capitalize;
      font-size: 15px;
   }
   .shopping-summery table.table-wishlist tbody tr {
      border-bottom: 1px solid #f8f9fa !important;
   }
   .shopping-summery table.table-wishlist tbody tr:last-child {
      border-bottom: none !important;
   }
   .shopping-summery table.table-wishlist tbody td {
      border: none !important;
      background: transparent !important;
      padding: 15px 20px !important;
      vertical-align: middle !important;
   }
   .shopping-summery table.table-wishlist tbody td img {
      width: 70px;
      height: 70px;
      object-fit: cover;
      border-radius: 12px;
      border: 1px solid #f1f2f4;
      margin-right: 15px;
   }
   .shopping-summery table.table-wishlist tbody td h6 {
      margin: 0;
      font-weight: 700;
      font-family: 'Outfit', sans-serif;
      font-size: 15px;
   }
   
   /* Quantity selector adjustments */
   .shopping-summery .detail-qty {
      border-radius: 8px !important;
      border: 1px solid #ececec !important;
      padding: 8px 12px !important;
      background: #fff !important;
      display: inline-flex !important;
      align-items: center !important;
      max-width: 105px !important;
   }
   .shopping-summery .detail-qty .qty-val {
      border: none !important;
      font-weight: 700 !important;
      color: #253D4E !important;
      width: 35px !important;
      text-align: center !important;
      background: transparent !important;
      font-size: 14px !important;
      margin: 0 5px !important;
   }
   .shopping-summery .detail-qty a {
      color: #7e7e7e !important;
      font-size: 14px !important;
      display: inline-flex !important;
      cursor: pointer;
   }
   
   /* Cart summary totals style overrides */
   .cart-totals-card table {
      margin-bottom: 0;
   }
   .cart-totals-card table tr {
      border-bottom: 1px dashed #f1f2f4 !important;
   }
   .cart-totals-card table tr:last-child {
      border-bottom: none !important;
   }
   .cart-totals-card table td {
      background: transparent !important;
      padding: 15px 0 !important;
      border: none !important;
   }
   .cart-totals-card table td h6.text-muted {
      font-family: 'Inter', sans-serif;
      font-weight: 500;
      color: #7e7e7e !important;
      margin: 0;
      font-size: 14px;
   }
   .cart-totals-card table td h4.text-brand {
      font-family: 'Inter', sans-serif;
      font-weight: 700;
      color: #253D4E !important;
      margin: 0;
      font-size: 14px;
   }
   /* Style Grand Total cell specifically */
   .cart-totals-card table tr:last-child td h4.text-brand {
      color: #3bb77e !important;
      font-size: 26px !important;
      font-weight: 800 !important;
      font-family: 'Outfit', sans-serif !important;
   }
   .cart-totals-card table td h6.text-brand a {
      color: #e74c3c !important;
      margin-left: 10px;
      font-size: 14px;
      cursor: pointer;
   }
   
   /* ===== Premium Cart Properties Styling ===== */
   .cart-prop-label {
      font-size: 11px;
      color: #9ca3af;
      display: block;
      margin-bottom: 5px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      font-family: 'Inter', sans-serif;
   }
   .cart-prop-value {
      font-size: 13px;
      font-weight: 700;
      color: #253D4E;
      font-family: 'Outfit', sans-serif;
      background: #f0fdf4;
      padding: 6px 14px;
      border-radius: 8px;
      display: inline-block;
      border: 1px solid #d1fae5;
   }
   .cart-prop-select {
      border-radius: 10px !important;
      padding: 8px 14px !important;
      font-size: 13px !important;
      font-weight: 600 !important;
      height: auto !important;
      width: auto !important;
      min-width: 140px !important;
      display: inline-block !important;
      border: 1px solid #e5e7eb !important;
      background-color: #fafbfc !important;
      color: #253D4E !important;
      font-family: 'Inter', sans-serif !important;
      cursor: pointer;
      transition: all 0.25s ease !important;
      outline: none !important;
      box-shadow: none !important;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%239ca3af' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E") !important;
      background-repeat: no-repeat !important;
      background-position: right 12px center !important;
      padding-right: 32px !important;
   }
   .cart-prop-select:hover {
      border-color: #3bb77e !important;
      background-color: #fff !important;
   }
   .cart-prop-select:focus {
      border-color: #3bb77e !important;
      background-color: #fff !important;
      box-shadow: 0 0 0 3px rgba(59, 183, 126, 0.1) !important;
   }
   .cart-prop-select:disabled {
      opacity: 0.6;
      cursor: wait;
   }
   
   /* Price cells transitions */
   .cart-unit-price, .cart-subtotal {
      transition: color 0.4s ease, opacity 0.3s ease;
   }
   
   /* Subtle row hover */
   .shopping-summery table.table-wishlist tbody tr.cart-item-row:hover {
      background-color: #fafbfc !important;
   }
   
   /* Remove button hover */
   .shopping-summery table.table-wishlist tbody td.action a {
      color: #b0b0b0 !important;
      transition: color 0.2s ease, transform 0.2s ease;
   }
   .shopping-summery table.table-wishlist tbody td.action a:hover {
      color: #e74c3c !important;
      transform: scale(1.15);
   }
</style>

@endsection