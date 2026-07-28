@extends('front.master')
@section('needs_stripe', true)
@section('content')
<script>
    window.checkoutCartQty = {{ (int)Cart::count() }};
    window.checkoutCartTotal = {{ (float)str_replace(',', '', Cart::total()) }};
</script>
@section('title')
   Checkout Page
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-header breadcrumb-wrap">
   <div class="container">
      <div class="breadcrumb">
         <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
         <span></span> Checkout
      </div>
   </div>
</div>

<div class="container mb-80 mt-50" style="font-family: 'Outfit', sans-serif;">
   <div class="row mb-4">
      <div class="col-lg-12">
         <h2 style="font-weight: 800; color: #253D4E; margin: 0; font-size: 32px;">Secure Checkout</h2>
         <p class="text-muted" style="font-family: 'Inter', sans-serif; font-size: 14px; margin-top: 5px;">Review your items and enter your delivery information below.</p>
      </div>
   </div>

   @php
      $deliveryInfo = \App\Models\Order::getDeliveryEstimation();
      $deliveryDaysText = \App\Models\SiteSetting::getDeliveryDaysFormatted();
      $cutoffTimeText = \App\Models\SiteSetting::getCutoffTimeFormatted();
   @endphp

   <div class="row mb-4">
      <div class="col-lg-12">
         @if($deliveryInfo['is_queued'])
         <div class="alert border-0 py-3 px-4 d-flex align-items-center" style="border-radius: 16px; background: rgba(243, 156, 18, 0.08); border-left: 5px solid #f39c12 !important; color: #253D4E; margin: 0;">
            <div style="font-size: 28px; margin-right: 20px; color: #f39c12; display: inline-flex;"><i class="fi-rs-info"></i></div>
            <div>
               <h6 class="mb-1 fw-bold" style="color: #253D4E; font-size: 16px;">⚠️ Delivery Schedule Notice (Queued Order)</h6>
               <p class="mb-0 text-muted" style="font-size: 14px; line-height: 1.5; font-family: 'Inter', sans-serif;">
                  @if($deliveryInfo['is_delivery_day'])
                     Today is a delivery day ({{ $deliveryDaysText }}) but it is past the <strong>{{ $cutoffTimeText }}</strong> cutoff time.
                  @else
                     Today is not a scheduled delivery day (Delivery days are <strong>{{ $deliveryDaysText }}</strong>).
                  @endif
                  Your order will be <strong>queued</strong> and scheduled for delivery on: <strong style="color: #253D4E;">{{ $deliveryInfo['next_delivery_date_formatted'] }}</strong> (in {{ $deliveryInfo['proximity_days'] }} days).
               </p>
            </div>
         </div>
         @else
         <div class="alert border-0 py-3 px-4 d-flex align-items-center" style="border-radius: 16px; background: rgba(59, 183, 126, 0.08); border-left: 5px solid #3bb77e !important; color: #253D4E; margin: 0;">
            <div style="font-size: 28px; margin-right: 20px; color: #3bb77e; display: inline-flex;"><i class="fi-rs-marker"></i></div>
            <div>
               <h6 class="mb-1 fw-bold" style="color: #253D4E; font-size: 16px;">🚚 Delivery Schedule Notice</h6>
               <p class="mb-0 text-muted" style="font-size: 14px; line-height: 1.5; font-family: 'Inter', sans-serif;">
                  Deliveries are scheduled on <strong>{{ $deliveryDaysText }}</strong> with an <strong>{{ $cutoffTimeText }}</strong> cutoff time.
                  Your order is estimated to be delivered on: <strong style="color: #3bb77e;">{{ $deliveryInfo['next_delivery_date_formatted'] }}</strong> (in {{ $deliveryInfo['proximity_days'] }} days).
               </p>
            </div>
         </div>
         @endif
      </div>
   </div>

   <form id="checkout-form" method="post" action="{{ route('checkout.store') }}">
      @csrf

      @php
         $subtotal_val = (float)str_replace(',', '', $cartTotal);
         $orderAmount_val = Session::has('coupon') ? (float)session()->get('coupon')['total_amount'] : $subtotal_val;
         $minOrderAmount = \App\Models\SiteSetting::getMinOrderAmount();
      @endphp

      @if($orderAmount_val < $minOrderAmount)
         <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center mb-4" role="alert" style="border-radius: 16px; background-color: #fffbeb; border: 1.5px solid #fcd34d; color: #92400e; padding: 16px 20px; box-shadow: 0 4px 15px rgba(245, 158, 11, 0.12);">
            <i class="fi-rs-info me-3" style="font-size: 26px; color: #d97706;"></i>
            <div style="flex: 1;">
               <h5 style="margin: 0 0 3px 0; font-size: 15px; font-weight: 800; color: #92400e;">Minimum Order Threshold Notice</h5>
               <span style="font-size: 13px; line-height: 1.5;">Orders below <strong>GH¢ {{ number_format($minOrderAmount, 2) }}</strong> are not eligible for delivery. Your current order amount is <strong>GH¢ {{ number_format($orderAmount_val, 2) }}</strong>. Please add items worth at least <strong>GH¢ {{ number_format($minOrderAmount - $orderAmount_val, 2) }}</strong> more to proceed.</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
      @endif

      <div class="row">
         <!-- Billing Details Card -->
         <div class="col-lg-7 mb-4">
            <div class="card p-4" style="background: #ffffff; border-radius: 20px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.03); border: 1px solid #e2e8f0 !important;">
               <div class="d-flex align-items-center mb-4">
                  <div style="background: rgba(59, 183, 126, 0.1); width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 15px; color: #3bb77e; font-size: 20px;">
                     <i class="fi-rs-user"></i>
                  </div>
                  <h4 style="margin: 0; font-weight: 700; color: #253D4E; font-size: 20px;">Billing Details</h4>
               </div>

               <div class="row g-3" style="font-family: 'Inter', sans-serif;">
                  <div class="col-md-6 mb-3">
                     <label style="font-weight: 600; color: #253D4E; font-size: 13px; margin-bottom: 8px; display: block;">Full Name</label>
                     <input type="text" required name="delivery_name" value="{{ Auth::user()->name }}" class="form-control" style="border-radius: 10px; border: 1px solid #ececec; padding: 12px 15px; font-size: 14px; color: #253D4E;">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label style="font-weight: 600; color: #253D4E; font-size: 13px; margin-bottom: 8px; display: block;">Email Address</label>
                     <input type="email" required name="delivery_email" value="{{ Auth::user()->email }}" class="form-control" style="border-radius: 10px; border: 1px solid #ececec; padding: 12px 15px; font-size: 14px; color: #253D4E;">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label style="font-weight: 600; color: #253D4E; font-size: 13px; margin-bottom: 8px; display: block;">Phone Number</label>
                     <input required type="text" name="delivery_phone" value="{{ Auth::user()->phone }}" class="form-control" placeholder="e.g. 0243036092" pattern="[0-9]{10}" maxlength="10" minlength="10" inputmode="numeric" title="Phone number must be exactly 10 digits (e.g. 0243036092)" style="border-radius: 10px; border: 1px solid #ececec; padding: 12px 15px; font-size: 14px; color: #253D4E;">
                  </div>
                  @if(empty(Auth::user()->institution))
                  <div class="col-md-6 mb-3">
                     <label style="font-weight: 600; color: #253D4E; font-size: 13px; margin-bottom: 8px; display: block;">Specific Address</label>
                     <input required type="text" name="delivery_address" value="{{ Auth::user()->address }}" class="form-control" placeholder="e.g. Adenta, Block A Room 204" style="border-radius: 10px; border: 1px solid #ececec; padding: 12px 15px; font-size: 14px; color: #253D4E;">
                  </div>
                  @else
                  <input type="hidden" name="delivery_address" value="N/A">
                  @endif
                  <div class="col-md-4 mb-3">
                     <label style="font-weight: 600; color: #253D4E; font-size: 13px; margin-bottom: 8px; display: block;">Region</label>
                     <div class="custom_select">
                        <select required name="region_id" class="form-control" style="border-radius: 10px; border: 1px solid #ececec; padding: 12px 15px; font-size: 14px; height: auto;">
                           <option value="">Select Region...</option>
                           @foreach($regions as $item)
                           <option value="{{ $item->id }}" {{ isset($userRegionId) && $userRegionId == $item->id ? 'selected' : '' }}>{{ $item->region_name }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-md-4 mb-3">
                     <label style="font-weight: 600; color: #253D4E; font-size: 13px; margin-bottom: 8px; display: block;">Institution</label>
                     <div class="custom_select">
                        <select required name="district_id" class="form-control" style="border-radius: 10px; border: 1px solid #ececec; padding: 12px 15px; font-size: 14px; height: auto;"></select>
                     </div>
                  </div>
                  @if(Auth::user()->resident_type === 'non-resident')
                  <div class="col-md-4 mb-3">
                     <label style="font-weight: 600; color: #253D4E; font-size: 13px; margin-bottom: 8px; display: block;">Name of Residence</label>
                     <input type="text" required name="city_name" value="{{ Auth::user()->hall }}" class="form-control" style="border-radius: 10px; border: 1px solid #ececec; padding: 12px 15px; font-size: 14px; color: #253D4E; height: auto;">
                     <input type="hidden" name="city_id" value="0">
                  </div>
                  @else
                  <div class="col-md-4 mb-3">
                     <label style="font-weight: 600; color: #253D4E; font-size: 13px; margin-bottom: 8px; display: block;">Hall</label>
                     <div class="custom_select">
                        <select required name="city_id" class="form-control" style="border-radius: 10px; border: 1px solid #ececec; padding: 12px 15px; font-size: 14px; height: auto;"></select>
                     </div>
                  </div>
                  @endif
                  <div class="col-md-12 mb-3">
                     <label style="font-weight: 600; color: #253D4E; font-size: 13px; margin-bottom: 8px; display: block;">Additional Notes (Optional)</label>
                     <textarea rows="4" placeholder="Specify room number or exact location instructions if necessary" name="notes" class="form-control" style="border-radius: 10px; border: 1px solid #ececec; padding: 12px 15px; font-size: 14px; color: #253D4E; min-height: 90px;"></textarea>
                  </div>
               </div>
            </div>
         </div>

         <!-- Order Details & Payment Option Card -->
         <div class="col-lg-5 mb-4">
            <div class="card p-4 mb-4" style="background: #ffffff; border-radius: 20px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.03); border: 1px solid #e2e8f0 !important;">
               <div class="d-flex align-items-center mb-4">
                  <div style="background: rgba(59, 183, 126, 0.1); width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 15px; color: #3bb77e; font-size: 20px;">
                     <i class="fi-rs-shopping-cart"></i>
                  </div>
                  <h4 style="margin: 0; font-weight: 700; color: #253D4E; font-size: 20px;">Your Order</h4>
               </div>

               <!-- Sleek cart item list layout -->
               <div style="font-family: 'Inter', sans-serif;">
                  <ul style="list-style-type: none; padding-left: 0; margin-bottom: 25px;">
                     @foreach($carts as $item)
                     <li class="d-flex align-items-center justify-content-between py-3" style="border-bottom: 1px solid #f8f9fa;">
                        <div class="d-flex align-items-center" style="gap: 15px; flex: 1; min-width: 0;">
                           <img src="{{ asset($item->options->image) }}" alt="Product" style="width: 55px; height: 55px; object-fit: cover; border-radius: 8px; border: 1px solid #f1f2f4; display: block;" />
                           <div style="min-width: 0;">
                              <h6 style="margin: 0 0 4px; font-weight: 700; color: #253D4E; font-size: 14px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                 {{ $item->name }}
                              </h6>
                              <span style="font-size: 12px; color: #7e7e7e; font-weight: 500;">
                                 Size/Type: {{ $item->options->size }} @if($item->options->color) | ({{ $item->options->color }}) @endif
                              </span>
                           </div>
                        </div>
                        <div style="text-align: right; margin-left: 15px;">
                           <span style="font-size: 13px; color: #7e7e7e; display: block; margin-bottom: 2px;">{{ number_format($item->price, 2) }} x {{ $item->qty }}</span>
                           <span style="font-size: 14px; font-weight: 700; color: #3bb77e;">Gh {{ number_format($item->price * $item->qty, 2) }}</span>
                        </div>
                     </li>
                     @endforeach
                  </ul>

                  <!-- Subtotal/Grand Total using the premium flexbox layout -->
                  <div style="border-top: 1px dashed #ececec; padding-top: 10px;">
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
                        <div class="d-flex justify-content-between align-items-center py-3" style="border-bottom: 1px dashed #f1f2f4;">
                           <span style="color: #7e7e7e; font-weight: 500;">Subtotal</span>
                           <span style="font-weight: 700; color: #253D4E;">Gh {{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-3" style="border-bottom: 1px dashed #f1f2f4;">
                           <span style="color: #7e7e7e; font-weight: 500;">Coupon Code</span>
                           <span style="font-weight: 600; color: #e74c3c;">{{ session()->get('coupon')['coupon_name'] }} ({{ session()->get('coupon')['coupon_discount'] }}%)</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-3" style="border-bottom: 1px dashed #f1f2f4;">
                           <span style="color: #7e7e7e; font-weight: 500;">Discount Amount</span>
                           <span style="font-weight: 700; color: #e74c3c;">- Gh {{ number_format(session()->get('coupon')['discount_amount'], 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-3" style="border-bottom: 1px dashed #f1f2f4;">
                           <span style="color: #7e7e7e; font-weight: 500;">Delivery Fee</span>
                           <span style="font-weight: 700; color: #253D4E;">Gh {{ number_format($deliveryFee, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-4">
                           <span style="font-weight: 700; color: #253D4E; font-size: 16px; font-family: 'Outfit', sans-serif;">Grand Total</span>
                           <span style="font-size: 26px; font-weight: 800; color: #3bb77e; font-family: 'Outfit', sans-serif;">Gh {{ number_format($grandTotal, 2) }}</span>
                        </div>
                     @else
                        <div class="d-flex justify-content-between align-items-center py-3" style="border-bottom: 1px dashed #f1f2f4;">
                           <span style="color: #7e7e7e; font-weight: 500;">Subtotal</span>
                           <span style="font-weight: 700; color: #253D4E;">Gh {{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-3" style="border-bottom: 1px dashed #f1f2f4;">
                           <span style="color: #7e7e7e; font-weight: 500;">Delivery Fee</span>
                           <span style="font-weight: 700; color: #253D4E;">Gh {{ number_format($deliveryFee, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-4">
                           <span style="font-weight: 700; color: #253D4E; font-size: 16px; font-family: 'Outfit', sans-serif;">Grand Total</span>
                           <span style="font-size: 28px; font-weight: 800; color: #3bb77e; font-family: 'Outfit', sans-serif;">Gh {{ number_format($grandTotal, 2) }}</span>
                        </div>
                     @endif
                  </div>
               </div>
            </div>

            <!-- Payment Option Card -->
            <div class="card p-4" style="background: #ffffff; border-radius: 20px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.03); border: 1px solid #e2e8f0 !important;">
               <div class="d-flex align-items-center mb-4">
                  <div style="background: rgba(59, 183, 126, 0.1); width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 15px; color: #3bb77e; font-size: 20px;">
                     <i class="fi-rs-credit-card"></i>
                  </div>
                  <h4 style="margin: 0; font-weight: 700; color: #253D4E; font-size: 20px;">Payment Method</h4>
               </div>

               <div class="payment_option" style="font-family: 'Inter', sans-serif;">
                  <div class="p-3 mb-4" style="background: #f8f9fa; border-radius: 12px; border: 1px solid #f1f2f4; display: flex; align-items: center; gap: 12px;">
                     <input class="form-check-input" required type="radio" name="payment_option" value="cash" id="exampleRadios4" checked style="width: 18px; height: 18px; cursor: pointer; margin: 0;">
                     <label class="form-check-label mb-0" for="exampleRadios4" style="cursor: pointer; font-weight: 700; color: #253D4E; font-size: 14px;">Mobile Money (Momo) / Cash on Delivery</label>
                  </div>
               </div>

               @if($orderAmount_val < $minOrderAmount)
                  <button type="button" class="btn btn-primary" onclick="Swal.fire({ icon: 'warning', title: 'Minimum Order Threshold Required', text: 'Orders below GH¢ {{ number_format($minOrderAmount, 2) }} are not eligible for delivery. Please add GH¢ {{ number_format($minOrderAmount - $orderAmount_val, 2) }} more worth of items to your cart to proceed.', confirmButtonColor: '#3bb77e' });" style="background-color: #94a3b8 !important; border: none; color: #fff; padding: 16px 45px; font-family: 'Outfit', sans-serif; font-weight: 700; border-radius: 30px; font-size: 16px; display: inline-flex; align-items: center; justify-content: center; gap: 8px; width: 100%; cursor: pointer;">
                     Proceed <i class="fi-rs-sign-out" style="margin-left: 5px;"></i>
                  </button>
               @else
                  <button type="submit" class="btn btn-primary" style="background-color: #3bb77e !important; border: none; color: #fff; padding: 16px 45px; font-family: 'Outfit', sans-serif; font-weight: 700; border-radius: 30px; font-size: 16px; display: inline-flex; align-items: center; justify-content: center; gap: 8px; width: 100%; transition: all 0.3s ease; box-shadow: 0 8px 25px rgba(59, 183, 126, 0.25); cursor: pointer;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 30px rgba(59, 183, 126, 0.35)';" onmouseout="this.style.transform='none'; this.style.boxShadow='0 8px 25px rgba(59, 183, 126, 0.25)';">
                     Proceed <i class="fi-rs-sign-out" style="margin-left: 5px;"></i>
                  </button>
               @endif
            </div>
         </div>
      </div>
   </form>
</div>

<script src="{{ asset('front/assets/js/validate.js') }}"></script>
<script type="text/javascript">
   document.addEventListener("DOMContentLoaded", function() {
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
                               var selected = '';
                               @if(Auth::check() && Auth::user()->hall)
                                   if (value.city == "{{ Auth::user()->hall }}") {
                                       selected = 'selected';
                                   }
                               @endif
                               $('select[name="city_id"]').append('<option value="'+ value.id + '" ' + selected + '>' + value.city + '</option>');
                           });
                       },
                   });
               } else {
                   alert('danger');
               }
           });
       });

       $(document).ready(function(){
             $.validator.addMethod("customEmail", function(value, element) {
                 return this.optional(element) || /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value);
             }, "Please enter a valid email address with a domain extension (e.g. .com)");

             $('#checkout-form').validate({
                 rules: {
                     delivery_name: {
                         required: true
                     },
                     delivery_email: {
                         required: true,
                         customEmail: true
                     },
                     delivery_phone: {
                         required: true,
                         digits: true,
                         minlength: 10,
                         maxlength: 10
                     },
                     delivery_address: {
                         required: true
                     },
                     region_id: {
                         required: true
                     },
                     district_id: {
                         required: true
                     },
                     city_id: {
                         required: true
                     },
                     city_name: {
                         required: true
                     }
                 },
                 messages: {
                     delivery_name: {
                         required: "Please enter your full name"
                     },
                     delivery_email: {
                         required: "Please enter your email address",
                         customEmail: "Please enter a valid email address (e.g. name@domain.com)"
                     },
                     delivery_phone: {
                         required: "Please enter your phone number",
                         digits: "Phone number must contain only numbers",
                         minlength: "Phone number must be exactly 10 digits (e.g. 0243036092)",
                         maxlength: "Phone number must be exactly 10 digits (e.g. 0243036092)"
                     },
                     delivery_address: {
                         required: "Please enter your address"
                     },
                     region_id: {
                         required: "Please select your region"
                     },
                     district_id: {
                         required: "Please select your institution"
                     },
                     city_id: {
                         required: "Please select your hall"
                     },
                     city_name: {
                         required: "Please enter your residence name"
                     }
                 },
                 errorElement: 'span',
                 errorPlacement: function (error, element) {
                     error.addClass('text-danger');
                     error.css({'display': 'block', 'font-size': '12px', 'margin-top': '5px'});
                     if (element.parent('.custom_select').length) {
                         element.parent('.custom_select').after(error);
                     } else {
                         element.after(error);
                     }
                 },
                 highlight: function(element, errorClass, validClass){
                     $(element).addClass('is-invalid');
                     $(element).css('border-color', '#d9534f');
                 },
                 unhighlight: function(element, errorClass, validClass){
                     $(element).removeClass('is-invalid');
                     $(element).css('border-color', '#ececec');
                 },
                 onfocusout: function(element) {
                     this.element(element);
                 },
                 onkeyup: function(element) {
                     this.element(element);
                 },
                 onclick: function(element) {
                     this.element(element);
                 },
                 submitHandler: function(form) {
                     var orderAmount = {{ $orderAmount }};
                     if (orderAmount < 50) {
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
                         return false;
                     }

                     @php
                        $activeDeliveryDaysJs = json_encode(\App\Models\SiteSetting::getDeliveryDays());
                        list($cHour, $cMin) = \App\Models\SiteSetting::getDeliveryCutoffTime();
                        $cutoffFormatted = \App\Models\SiteSetting::getCutoffTimeFormatted();
                        $deliveryDaysText = \App\Models\SiteSetting::getDeliveryDaysFormatted();
                     @endphp
                     var activeDeliveryDays = {{ $activeDeliveryDaysJs }};
                     var cutoffHour = {{ $cHour }};
                     var cutoffMinute = {{ $cMin }};

                     var now = new Date();
                     var day = now.getDay(); // 0 = Sun, 1 = Mon, ..., 6 = Sat
                     var carbonDay = (day === 0) ? 7 : day; // 1 = Mon, ..., 7 = Sun
                     var hour = now.getHours();
                     var minutes = now.getMinutes();

                     var isDeliveryDay = activeDeliveryDays.includes(carbonDay);
                     var isPastCutoff = isDeliveryDay && (hour > cutoffHour || (hour === cutoffHour && minutes > cutoffMinute));
                     var isNotDeliveryDay = !isDeliveryDay;

                     if (isPastCutoff || isNotDeliveryDay) {
                         var messageHtml = isPastCutoff 
                             ? 'Today is a delivery day but it is past <strong style="color: #d9534f;">{{ $cutoffFormatted }}</strong>.<br>Orders placed now will be <strong>queued</strong> for the next delivery day.'
                             : 'Today is not a delivery day (Delivery days are {{ $deliveryDaysText }}).<br>Orders placed now will be <strong>queued</strong> for the next delivery day.';

                         var messageText = isPastCutoff
                             ? 'Today is a delivery day but it is past {{ $cutoffFormatted }}. Your order will be queued for the next delivery day.'
                             : 'Today is not a delivery day (Delivery days are {{ $deliveryDaysText }}). Your order will be queued for the next delivery day.';

                         if (typeof Swal !== 'undefined') {
                             Swal.fire({
                                 title: '<span style="color: #d9534f; font-family: \'Outfit\', sans-serif; font-weight: 600;">Delivery Schedule Notice</span>',
                                 html: '<div style="font-family: \'Inter\', sans-serif; font-size: 15px; color: #555; line-height: 1.6;">' + messageHtml + '<br><br>Do you wish to proceed?</div>',
                                 icon: 'warning',
                                 showCancelButton: true,
                                 confirmButtonColor: '#3085d6',
                                 cancelButtonColor: '#d33',
                                 confirmButtonText: 'Yes, proceed',
                                 cancelButtonText: 'Cancel'
                             }).then((result) => {
                                 if (result.isConfirmed) {
                                     form.submit();
                                 }
                             });
                         } else {
                             if (confirm(messageText + " Do you want to proceed?")) {
                                 form.submit();
                             }
                         }
                         return false;
                     }

                     form.submit();
                 }
             });
       });
   });
</script>
@endsection
