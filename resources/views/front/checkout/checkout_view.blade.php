@extends('front.master')
@section('needs_stripe', true)
@section('content')
@section('title')
   Checkout Page
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-header breadcrumb-wrap">
   <div class="container">
      <div class="breadcrumb">
         <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
         {{-- <span></span> Checkout --}}
      </div>
   </div>
</div>

<div class="container mb-80 mt-50">
   <div class="row">
      <div class="col-lg-8 mb-10">
         <h4 class="heading-2">Checkout</h4>
         <div class="d-flex justify-content-between">
            {{-- <h6 class="text-body">There are products in your cart</h6> --}}
         </div>
      </div>
   </div>

   <form method="post" action="{{ route('checkout.store') }}">
      @csrf
      <div class="row">
         <div class="col-lg-5">
            <div class="row">
               <h5 class="mb-30">Billing Details (kindly fill all fields)</h5>
                  <div class="row">
                    <div class="form-group col-lg-6">
                        <input type="text" required="" name="delivery_name" value="{{ Auth::user()->name }}">
                     </div>
                     <div class="form-group col-lg-6">
                        <input type="email" required="" name="delivery_email" value="{{ Auth::user()->email }}">
                     </div>
                  </div>
                  <div class="row">
                     <div class="form-group col-lg-6">
                        <input required type="text" name="delivery_phone" value="{{ Auth::user()->phone }}" placeholder="Phone">
                     </div>
                     <div class="form-group col-lg-6">
                        <input required type="text" name="delivery_address" value="{{ Auth::user()->address }}" placeholder="Address">
                     </div>
                  </div>
                  <div class="">

                     {{-- Region --}}
                     <div class="form-group col-lg-6">
                        <div class="custom_select">
                           <select required name="region_id" class="form-control">
                              <option value="">Select Region...</option>
                              @foreach($regions as $item)
                              <option value="{{ $item->id }}" {{ isset($userRegionId) && $userRegionId == $item->id ? 'selected' : '' }}>{{ $item->region_name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>

                     {{-- University --}}
                     <div class="form-group col-lg-6">
                        {{-- <span style="color: red">(NB: Select Region first)</span> --}}
                        <div class="custom_select">
                           <select required name="district_id" class="form-control"></select>
                        </div>
                     </div>

                  </div>

                  <div class="">

                     {{-- Enter Hall --}}
                     <div class="form-group col-lg-6">
                        <div class="custom_select">
                           <select required class="form-control" name="city_id"></select>
                        </div>
                     </div>

                     <div class="form-group mb-30">
                        <textarea style="min-height: 100px;" rows="5" placeholder="(Optional): Specify room number or exact location if necessary" name="notes"></textarea>
                     </div>

                  </div>
            </div>
         </div>
         <div class="col-lg-7">
            <div class="border cart-totals ml-30 mb-50 d-none d-lg-block">
               <div class="text-center mb-30">
               {{-- <div class="d-flex align-items-end justify-content-between mb-30"> --}}
                  <h4>Your Order</h4>
               </div>
               {{-- <div class="divider-2 mb-30"></div> --}}
               <div class="table-responsive order_table checkout">
               {{-- <div class="table-responsive order_table checkout" style="max-height: 350px; overflow-y: auto; scrollbar-width: thin;"> --}}
                  <table class="table no-border">
                     <tbody>
                        @foreach($carts as $item)
                        <tr>
                           <td class="image product-thumbnail"><img src="{{ asset($item->options->image) }} " alt="#" style="width:50px; height: 50px;" ></td>
                           <td>
                              <h6 class="w-160 mb-5"><a href="" class="text-heading">{{ $item->name }}</a></h6>
                              </span>
                              </span>
                              <div class="product-rate-cover">
                                 <strong>{{ $item->options->color }} </strong>/
                                 <strong>{{ $item->options->size }}</strong>
                              </div>
                           </td>
                           <td>
                              <h6 class="text-muted pl-20 pr-20">{{ number_format($item->price, 2) }} x {{ $item->qty }}</h6>
                           </td>
                           <td>
                              <h6 class="text-brand">Gh {{ number_format($item->price * $item->qty, 2) }}</h6>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
                  <table class="table no-border">
                     <tbody>
                        @php
                           $setting = \App\Models\SiteSetting::find(1);
                           $isStudent = Auth::check() && Auth::user()->status_identity === 'student';
                           $subtotal = (float)str_replace(',', '', $cartTotal);
                           
                           if (Session::has('coupon')) {
                               $orderAmount = (float)session()->get('coupon')['total_amount'];
                           } else {
                               $orderAmount = $subtotal;
                           }

                           $deliveryFee = \App\Models\SiteSetting::calculateDeliveryFee($orderAmount, $isStudent);
                           $grandTotal = $orderAmount + $deliveryFee;
                        @endphp
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
                              <h6 class="text-brand text-end">{{ session()->get('coupon')['coupon_name'] }} ( {{ session()->get('coupon')['coupon_discount'] }}% ) </h6>
                           </td>
                        </tr>
                        <tr>
                           <td class="cart_total_label">
                              <h6 class="text-muted">Coupon Discount</h6>
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
                              <h4 class="text-brand text-end">Gh {{ number_format($grandTotal, 2) }}</h4>
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
                              <h6 class="text-muted">Grand Total </h6>
                           </td>
                           <td class="cart_total_amount">
                              <h4 class="text-brand text-end">Gh {{ number_format($grandTotal, 2) }}</h4>
                           </td>
                        </tr>
                        @endif
                     </tbody>
                  </table>
               </div>
            </div>
            <div class="payment ml-30">
               <h4 class="mb-10">Payment</h4>
               <div class="payment_option">
                  {{-- <div class="custome-radio">
                     <input class="form-check-input" required="" type="radio" name="payment_option" value="stripe" id="exampleRadios3" checked="">
                     <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#bankTranfer" aria-controls="bankTranfer">Stripe</label>
                  </div> --}}
                  <div class="custome-radio">
                     <input class="form-check-input" required="" type="radio" name="payment_option" value="cash" id="exampleRadios4" checked="">
                     <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#checkPayment" aria-controls="checkPayment">Mobile Money</label>
                  </div>
                  {{-- <div class="custome-radio">
                     <input class="form-check-input" value="card" required="" type="radio" name="payment_option" id="exampleRadios5" checked="">
                     <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#paypal" aria-controls="paypal">Online Getway</label>
                  </div> --}}
               </div>
               {{-- <div class="payment-logo d-flex">
                  <img class="mr-15" src="{{ asset('front/assets/imgs/theme/icons/payment-paypal.svg') }}" alt="">
                  <img class="mr-15" src="{{ asset('front/assets/imgs/theme/icons/payment-visa.svg') }}" alt="">
                  <img class="mr-15" src="{{ asset('front/assets/imgs/theme/icons/payment-master.svg') }}" alt="">
                  <img src="{{ asset('front/assets/imgs/theme/icons/payment-zapper.svg') }}" alt="">
               </div> --}}
               <button type="submit" class="btn btn-fill-out btn-block mt-30">Proceed<i class="fi-rs-sign-out ml-15"></i></button>
            </div>
         </div>
      </div>
   </form>
</div>

<script type="text/javascript">
   $(document).ready(function(){
       $('select[name="region_id"]').on('change', function(){
           var region_id = $(this).val();
           if (region_id) {
               $.ajax({
                   url: "{{ url('/institution-get/ajax') }}/"+region_id,
                   type: "GET",
                   dataType:"json",
                   success:function(data){
                       $('select[name="city_id"]').html('');
                       var d =$('select[name="district_id"]').empty();
                       $.each(data, function(key, value){
                           $('select[name="district_id"]').append('<option value="'+ value.id + '">' + value.district_name + '</option>');
                       });
                       $('select[name="district_id"]').trigger('change');
                   },
               });
           } else {
               alert('danger');
           }
       });

       // Auto-load matching district on page load if region is pre-selected
       var region_id = $('select[name="region_id"]').val();
       if (region_id) {
           $.ajax({
               url: "{{ url('/institution-get/ajax') }}/"+region_id,
               type: "GET",
               dataType:"json",
               success:function(data){
                   $('select[name="city_id"]').html('');
                   var d =$('select[name="district_id"]').empty();
                   $.each(data, function(key, value){
                       var selected = '';
                       @if(isset($userDistrict))
                           if (value.id == {{ $userDistrict->id }}) {
                               selected = 'selected';
                           }
                       @endif
                       $('select[name="district_id"]').append('<option value="'+ value.id + '" ' + selected + '>' + value.district_name + '</option>');
                   });
                   $('select[name="district_id"]').trigger('change');
               },
           });
       }
   });
   // Show State Data
   $(document).ready(function(){
       $('select[name="district_id"]').on('change', function(){
           var institution_id = $(this).val();
           if (institution_id) {
               $.ajax({
                   url: "{{ url('/hall-get/ajax') }}/"+institution_id,
                   type: "GET",
                   dataType:"json",
                   success:function(data){
                       $('select[name="city_id"]').html('');
                       var d =$('select[name="city_id"]').empty();
                       $.each(data, function(key, value){
                           $('select[name="city_id"]').append('<option value="'+ value.id + '">' + value.city + '</option>');
                       });
                   },
               });
           } else {
               alert('danger');
           }
       });
   });

   $(document).ready(function(){
        $('form').on('submit', function(e){
            var orderAmount = {{ $orderAmount }};
            if (orderAmount < 50) {
                e.preventDefault();
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'warning',
                        title: '<span style="color: #bf8069; font-family: \'Outfit\', sans-serif; font-weight: 600;">Minimum Order Required</span>',
                        html: '<div style="font-family: \'Inter\', sans-serif; font-size: 15px; color: #555; line-height: 1.6;">Orders below <strong style="color: #bf8069;">GH¢ 50.00</strong> are not eligible for delivery.<br>Please add more items to your cart to proceed.</div>',
                        confirmButtonColor: '#bf8069',
                        confirmButtonText: 'Go Back to Shop',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/';
                        }
                    });
                } else {
                    alert('Orders below GH¢ 50.00 are not eligible for delivery.');
                }
            }
        });
    });
</script>
@endsection
