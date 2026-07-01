@extends('front.master')
@section('content')
@section('title')
   Payment...
@endsection

<style>
@media (max-width: 767px) {
    /* Center the figures/amounts in the table */
    .order_table.checkout table tbody tr td.cart_total_amount h4, 
    .order_table.checkout table tbody tr td.cart_total_amount h6,
    .order_table.checkout table tbody tr td.cart_total_amount .text-brand {
        text-align: center !important;
    }
    .order_table.checkout table tbody tr td.cart_total_label h6 {
        text-align: center !important;
    }
    
    /* Center the input fields under Delivery Details */
    .checkout input[type="text"] {
        text-align: center !important;
    }
    /* Center the Pay and Cancel buttons */
    .checkout form div {
        text-align: center !important;
    }
}
</style>
<div class="page-header breadcrumb-wrap">
   <div class="container">
      <div class="breadcrumb">
         <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
         <span></span> Payment
      </div>
   </div>
</div>
<div class="container mb-10 mt-50">
   {{-- <div class="row">
      <div class="col-lg-8 mb-40">
         <h4 class="heading-2 mb-10"> Cash On Delivery Payment</h4>
         <div class="d-flex justify-content-between">
         </div>
      </div>
   </div> --}}
   <div class="row">
      <div class="col-lg-6">
         <div class="border p-40 cart-totals ml-30 mb-50">
            {{-- <div class="d-flex align-items-end justify-content-between mb-30">
               <h4>Your Order Details</h4>
            </div>
            <div class="divider-2 mb-30"></div> --}}
            <div class="table-responsive order_table checkout">
               <table class="table no-border">
                  <tbody>
                      @if(Session::has('coupon'))
                      <tr>
                         <td class="cart_total_label">
                            <h6 class="text-muted">Subtotal</h6>
                         </td>
                         <td class="cart_total_amount">
                            <h4 class="text-brand text-end">Gh {{ number_format($subtotal, 2) }}</h4>
                         </td>
                      </tr>
                      <tr>
                         <td class="cart_total_label">
                            <h6 class="text-muted">Coupon Name</h6>
                         </td>
                         <td class="cart_total_amount">
                            <h6 class="text-brand text-end">{{ session()->get('coupon')['coupon_name'] }} ( {{ session()->get('coupon')['coupon_discount'] }}% )</h6>
                         </td>
                      </tr>
                      <tr>
                         <td class="cart_total_label">
                            <h6 class="text-muted">Coupon Discount Amount</h6>
                         </td>
                         <td class="cart_total_amount">
                            <h4 class="text-brand text-end">Gh {{ number_format(session()->get('coupon')['discount_amount'], 2) }}</h4>
                         </td>
                      </tr>
                      <tr>
                         <td class="cart_total_label">
                            <h6 class="text-muted">Delivery Fee</h6>
                         </td>
                         <td class="cart_total_amount">
                            <h4 class="text-brand text-end">Gh {{ number_format($deliveryFee, 2) }}</h4>
                         </td>
                      </tr>
                      <tr>
                         <td class="cart_total_label">
                            <h6 class="text-muted">Grand Total</h6>
                         </td>
                         <td class="cart_total_amount">
                            <h4 class="text-brand text-end">Gh {{ number_format($cartTotal, 2) }}</h4>
                         </td>
                      </tr>
                      @else
                      <tr>
                         <td class="cart_total_label">
                            <h6 class="text-muted">Subtotal</h6>
                         </td>
                         <td class="cart_total_amount">
                            <h4 class="text-brand text-end">Gh {{ number_format($subtotal, 2) }}</h4>
                         </td>
                      </tr>
                      <tr>
                         <td class="cart_total_label">
                            <h6 class="text-muted">Delivery Fee</h6>
                         </td>
                         <td class="cart_total_amount">
                            <h4 class="text-brand text-end">Gh {{ number_format($deliveryFee, 2) }}</h4>
                         </td>
                      </tr>
                      <tr>
                         <td class="cart_total_label">
                            <h6 class="text-muted">Grand Total</h6>
                         </td>
                         <td class="cart_total_amount">
                            <h4 class="text-brand text-end mobile-grandtotal-textcenter">Gh {{ number_format($cartTotal, 2) }}</h4>
                         </td>
                      </tr>
                      @endif
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <!-- // end lg md 6 -->
      <div class="col-lg-6">
         <div class="border p-40 cart-totals ml-30 mb-50">
            <div class="text-center mb-30">
            {{-- <div class="d-flex align-items-end justify-content-between mb-30"> --}}
               <h4>Delivery Details </h4>
            </div>
            {{-- <div class="divider-2 mb-30"></div> --}}
            <div class="table-responsive order_table checkout">
               <form action="{{ route('store.order') }}" method="post" >
                  @csrf
                  <div class="form-row">
                     <label for="card-element">
                     <input class="mb-1" type="text" name="name" value="{{ $data['delivery_name'] }}" readonly>
                     <input class="mb-1" type="text" name="email" value="{{ $data['delivery_email'] }}" readonly>
                     <input class="mb-1" type="text" name="phone" value="{{ $data['delivery_phone'] }}" readonly>
                     {{-- <input type="hidden" name="post_code" value="{{ $data['post_code'] }}"> --}}
                     <input type="hidden" name="region_id" value="{{ $data['region_id'] }}">
                     <input type="hidden" name="district_id" value="{{ $data['district_id'] }}">
                     <input type="hidden" name="city_id" value="{{ $data['city_id'] }}">
                     <input type="hidden" name="amount" value="{{ $cartTotal }}">

                     <input type="text" name="institution_region" value="{{ $data['region'] }}" readonly>
                     <input type="text" name="institution" value="{{ $data['district'] }}" readonly>
                     <input type="text" name="hall" value="{{ $data['city'] }}" readonly>

                     <input type="hidden" name="address" value="{{ $data['delivery_address'] }}">
                     <input type="hidden" name="notes" value="{{ $data['notes'] }}">
                     </label>
                     <!-- Used to display form errors. -->
                  </div>
                  <br>
                  <div>
                      <button class="btn btn-primary mr-10">Pay</button>
                      {{-- <button class="btn btn-primary mr-10 margin-button-mobile">Pay</button> --}}
                      <a href="javascript:history.back();" class="btn btn-primary" role="button">Cancel</a>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
