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

<div class="container mb-80 mt-30">
   <div class="row">
      <div class="col-lg-12 mb-40 wishlist-mobile">
         <h4 class="heading-2 text-center">
            <button type="button" class="btn btn-primary position-relative" style="padding: 5px 10px; font-weight:200">
               Cart items
               <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary" id="cartItems" style="background-color: #351313 !important;font-size: .95em;">
                 {{-- {{ Cart::content()->count() }} --}}
                 
               </span>
             </button>         
         </h4>
         {{-- <h6 class="heading-2 text-center mt-10">You have in your cart</h6> --}}
         <h6 class="text-center mt-10"><a href="{{ route('cart.empty') }}" class="text-muted"><i class="fi-rs-trash mr-5"></i>Clear All Cart Items</a></h6>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12">
            <div class="table-responsive shopping-summery">
               <table class="table table-wishlist">
                  <thead>
                     <tr class="main-heading">
                        <th class="custome-checkbox start"></th>
                        {{-- <th class="custome-checkbox start pl-30"></th> --}}
                        <th scope="col">Product</th>
                        {{-- <th scope="col" colspan="2">Product</th> --}}
                        <th scope="col">Unit Price</th>
                        {{-- <th scope="col">Color</th> --}}
                        <th scope="col">Properties</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col" class="end">Remove</th>
                     </tr>
                  </thead>
                     <tbody id="cartPage"></tbody>
                  </table>
               </div>
         

            <div class="row mt-50">
               <div class="col-lg-5">
                  @if(Session::has('coupon'))
                  @else
                  <div class="p-40 mobile-coupon-padding text-center" id="couponField">
                     <h4 class="mb-10">Apply Coupon</h4>
                     <p class="mb-30"><span class="font-lg text-muted">Using A Promo Code?</p>
                     <form action="#">
                        <div class="d-flex justify-content-between">
                           <input class="font-medium mr-15 coupon" id="coupon_name" placeholder="Enter Your Coupon">
                           <a type="submit" onclick="applyCoupon()" class="btn btn-success"><i class="fi-rs-label mr-10"></i>Apply</a>
                        </div>
                     </form>
                  </div>
                  @endif   
               </div>
               <div class="col-lg-7">
                  {{-- 
                  <div class="divider-2 mb-30"></div>
                  --}}
                  <div class="border p-md-4 cart-totals ml-30">
                     <div class="table-responsive">
                        <table class="table no-border">
                           <tbody id="couponCalField">
                           </tbody>
                        </table>
                     </div>
                     <a href="{{ route('checkout') }}" class="btn mb-20 w-100">Proceed To CheckOut<i class="fi-rs-sign-out ml-15"></i></a>
                  </div>
               </div>
            </div>
         

      </div>
   </div>
</div>

@else
   <div class="row mt-40 mb-40">
      <div class="col-lg-12 wishlist-mobile text-center">
         <h4 class="heading-2 text-center">
            <button type="button" class="btn btn-primary position-relative" style="padding: 5px 10px; font-weight:200">
               Cart is empty
               <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary" style="background-color: #351313 !important;font-size: .95em;">
                 0
               </span>
             </button>         
         </h4>
         {{-- <h6 class="heading-2 mt-5" style="color:red">No item(s) in your cart</h6> --}}
      </div>
   </div>
@endif

@endsection