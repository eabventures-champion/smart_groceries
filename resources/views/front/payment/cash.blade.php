@extends('front.master')
@section('content')
@section('title')
   Review & Pay
@endsection

<style>
@media (max-width: 767px) {
    .mobile-grandtotal-textcenter {
        text-align: center !important;
    }
}
</style>

<div class="page-header breadcrumb-wrap">
   <div class="container">
      <div class="breadcrumb">
         <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
         <span></span> Review & Payment
      </div>
   </div>
</div>

<div class="container mb-50 mt-50" style="font-family: 'Outfit', sans-serif;">
   @if(isset($deliveryInfo))
   <div class="row mb-4">
      <div class="col-lg-12">
         @if($deliveryInfo['is_queued'])
         <div class="alert border-0 py-3 px-4 d-flex align-items-center" style="border-radius: 16px; background: rgba(243, 156, 18, 0.08); border-left: 5px solid #f39c12 !important; color: #253D4E; margin: 0;">
            <div style="font-size: 28px; margin-right: 20px; color: #f39c12; display: inline-flex;"><i class="fi-rs-info"></i></div>
            <div>
               <h6 class="mb-1 fw-bold" style="color: #253D4E; font-size: 16px;">⚠️ Order Will Be Queued</h6>
               <p class="mb-0 text-muted" style="font-size: 14px; line-height: 1.5; font-family: 'Inter', sans-serif;">
                  Today is a delivery day (Mondays, Thursdays, Saturdays) but it is past the <strong>11:00 AM</strong> cutoff time.
                  Your order will be queued and scheduled for the next delivery date: <strong style="color: #253D4E;">{{ $deliveryInfo['next_delivery_date_formatted'] }}</strong> (in {{ $deliveryInfo['proximity_days'] }} days).
               </p>
            </div>
         </div>
         @else
         <div class="alert border-0 py-3 px-4 d-flex align-items-center" style="border-radius: 16px; background: rgba(59, 183, 126, 0.08); border-left: 5px solid #3bb77e !important; color: #253D4E; margin: 0;">
            <div style="font-size: 28px; margin-right: 20px; color: #3bb77e; display: inline-flex;"><i class="fi-rs-marker"></i></div>
            <div>
               <h6 class="mb-1 fw-bold" style="color: #253D4E; font-size: 16px;">Estimated Delivery Scheduled</h6>
               <p class="mb-0 text-muted" style="font-size: 14px; line-height: 1.5; font-family: 'Inter', sans-serif;">
                  Your order is estimated to be delivered on: <strong style="color: #3bb77e;">{{ $deliveryInfo['next_delivery_date_formatted'] }}</strong> (in {{ $deliveryInfo['proximity_days'] }} days).
               </p>
            </div>
         </div>
         @endif
      </div>
   </div>
   @endif

   <div class="row">
      <!-- Order Summary Card -->
      <div class="col-lg-5 mb-4">
         <div class="card border-0 p-4" style="background: #ffffff; border-radius: 20px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.03); border: 1px solid #f1f2f4; height: 100%;">
            <div class="d-flex align-items-center mb-4">
               <div style="background: rgba(59, 183, 126, 0.1); width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 15px; color: #3bb77e; font-size: 20px;">
                  <i class="fi-rs-shopping-cart"></i>
               </div>
               <h4 style="margin: 0; font-weight: 700; color: #253D4E; font-size: 20px;">Order Summary</h4>
            </div>
            
            <div style="font-family: 'Inter', sans-serif; font-size: 14px; color: #555;">
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
               <div class="d-flex justify-content-between align-items-center pt-4 pb-2">
                  <span style="font-weight: 700; color: #253D4E; font-size: 16px; font-family: 'Outfit', sans-serif;">Grand Total</span>
                  <span style="font-size: 26px; font-weight: 800; color: #3bb77e; font-family: 'Outfit', sans-serif;">Gh {{ number_format($cartTotal, 2) }}</span>
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
               <div class="d-flex justify-content-between align-items-center pt-4 pb-2">
                  <span style="font-weight: 700; color: #253D4E; font-size: 16px; font-family: 'Outfit', sans-serif;">Grand Total</span>
                  <span style="font-size: 28px; font-weight: 800; color: #3bb77e; font-family: 'Outfit', sans-serif;" class="mobile-grandtotal-textcenter">Gh {{ number_format($cartTotal, 2) }}</span>
               </div>
               @endif
            </div>

            <!-- Sleek Guarantee Badge -->
            <div class="mt-4 p-3 d-flex align-items-center" style="background: #f7f8f9; border-radius: 12px; border: 1px solid #f1f2f4;">
               <div style="font-size: 20px; color: #3bb77e; margin-right: 12px; display: inline-flex;"><i class="fi-rs-shield-check"></i></div>
               <span style="font-size: 12px; color: #7e7e7e; font-family: 'Inter', sans-serif; line-height: 1.4;">Verify your details on the right before proceeding. Delivery payments are secured.</span>
            </div>
         </div>
      </div>

      <!-- Delivery Details Card & Form -->
      <div class="col-lg-7 mb-4">
         <div class="card border-0 p-4" style="background: #ffffff; border-radius: 20px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.03); border: 1px solid #f1f2f4;">
            <div class="d-flex align-items-center mb-4">
               <div style="background: rgba(59, 183, 126, 0.1); width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 15px; color: #3bb77e; font-size: 20px;">
                  <i class="fi-rs-marker"></i>
               </div>
               <h4 style="margin: 0; font-weight: 700; color: #253D4E; font-size: 20px;">Delivery & Contact Details</h4>
            </div>

            <!-- Premium info visual grid instead of plain inputs -->
            <div class="row g-3 mb-4" style="font-family: 'Inter', sans-serif;">
               <div class="col-md-6">
                  <div class="p-3" style="background: #f8f9fa; border-radius: 12px; border: 1px solid #f1f2f4; height: 100%;">
                     <span style="font-size: 11px; text-transform: uppercase; color: #9b9b9b; font-weight: 700; display: block; margin-bottom: 6px;">Customer Name</span>
                     <div class="d-flex align-items-center">
                        <i class="fi-rs-user mr-10" style="color: #3bb77e; margin-right: 8px; display: inline-flex;"></i>
                        <span style="font-size: 14px; font-weight: 700; color: #253D4E;">{{ $data['delivery_name'] }}</span>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="p-3" style="background: #f8f9fa; border-radius: 12px; border: 1px solid #f1f2f4; height: 100%;">
                     <span style="font-size: 11px; text-transform: uppercase; color: #9b9b9b; font-weight: 700; display: block; margin-bottom: 6px;">Contact Phone</span>
                     <div class="d-flex align-items-center">
                        <i class="fi-rs-phone-call mr-10" style="color: #3bb77e; margin-right: 8px; display: inline-flex;"></i>
                        <span style="font-size: 14px; font-weight: 700; color: #253D4E;">{{ $data['delivery_phone'] }}</span>
                     </div>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="p-3" style="background: #f8f9fa; border-radius: 12px; border: 1px solid #f1f2f4;">
                     <span style="font-size: 11px; text-transform: uppercase; color: #9b9b9b; font-weight: 700; display: block; margin-bottom: 6px;">Email Address</span>
                     <div class="d-flex align-items-center">
                        <i class="fi-rs-envelope mr-10" style="color: #3bb77e; margin-right: 8px; display: inline-flex;"></i>
                        <span style="font-size: 14px; font-weight: 600; color: #253D4E;">{{ $data['delivery_email'] }}</span>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="p-3" style="background: #f8f9fa; border-radius: 12px; border: 1px solid #f1f2f4; height: 100%;">
                     <span style="font-size: 11px; text-transform: uppercase; color: #9b9b9b; font-weight: 700; display: block; margin-bottom: 6px;">Region</span>
                     <span style="font-size: 14px; font-weight: 700; color: #253D4E;">{{ $data['region'] }}</span>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="p-3" style="background: #f8f9fa; border-radius: 12px; border: 1px solid #f1f2f4; height: 100%;">
                     <span style="font-size: 11px; text-transform: uppercase; color: #9b9b9b; font-weight: 700; display: block; margin-bottom: 6px;">District</span>
                     <span style="font-size: 14px; font-weight: 700; color: #253D4E;">{{ $data['district'] }}</span>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="p-3" style="background: #f8f9fa; border-radius: 12px; border: 1px solid #f1f2f4; height: 100%;">
                     <span style="font-size: 11px; text-transform: uppercase; color: #9b9b9b; font-weight: 700; display: block; margin-bottom: 6px;">City / Hall</span>
                     <span style="font-size: 14px; font-weight: 700; color: #253D4E;">{{ $data['city'] }}</span>
                  </div>
               </div>
               @if($data['delivery_address'])
               <div class="col-md-12">
                  <div class="p-3" style="background: #f8f9fa; border-radius: 12px; border: 1px solid #f1f2f4;">
                     <span style="font-size: 11px; text-transform: uppercase; color: #9b9b9b; font-weight: 700; display: block; margin-bottom: 6px;">Specific Address / Location Details</span>
                     <div class="d-flex align-items-center">
                        <i class="fi-rs-marker mr-10" style="color: #3bb77e; margin-right: 8px; display: inline-flex;"></i>
                        <span style="font-size: 14px; font-weight: 600; color: #253D4E;">{{ $data['delivery_address'] }}</span>
                     </div>
                  </div>
               </div>
               @endif
               @if($data['notes'])
               <div class="col-md-12">
                  <div class="p-3" style="background: #fdfaf3; border-radius: 12px; border: 1px solid #f9ebd1;">
                     <span style="font-size: 11px; text-transform: uppercase; color: #bca06f; font-weight: 700; display: block; margin-bottom: 6px;">Order Note</span>
                     <div class="d-flex align-items-start">
                        <i class="fi-rs-document-signed mr-10" style="color: #f39c12; margin-right: 8px; margin-top: 3px; display: inline-flex;"></i>
                        <span style="font-size: 14px; font-weight: 500; color: #7d653f; line-height: 1.4;">{{ $data['notes'] }}</span>
                     </div>
                  </div>
               </div>
               @endif
            </div>

            <!-- Forms / Hidden Inputs -->
            <form action="{{ route('store.order') }}" method="post" >
               @csrf
               <!-- Hidden fields to keep standard order storage functional -->
               <input type="hidden" name="name" value="{{ $data['delivery_name'] }}">
               <input type="hidden" name="email" value="{{ $data['delivery_email'] }}">
               <input type="hidden" name="phone" value="{{ $data['delivery_phone'] }}">
               <input type="hidden" name="region_id" value="{{ $data['region_id'] }}">
               <input type="hidden" name="district_id" value="{{ $data['district_id'] }}">
               <input type="hidden" name="city_id" value="{{ $data['city_id'] }}">
               <input type="hidden" name="amount" value="{{ $cartTotal }}">
               <input type="hidden" name="institution_region" value="{{ $data['region'] }}">
               <input type="hidden" name="institution" value="{{ $data['district'] }}">
               <input type="hidden" name="hall" value="{{ $data['city'] }}">
               <input type="hidden" name="address" value="{{ $data['delivery_address'] }}">
               <input type="hidden" name="notes" value="{{ $data['notes'] }}">

               <div class="d-flex align-items-center justify-content-between mt-4">
                  <button type="submit" class="btn btn-primary" style="background-color: #3bb77e !important; border: none; color: #fff; padding: 16px 45px; font-family: 'Outfit', sans-serif; font-weight: 700; border-radius: 30px; font-size: 16px; display: inline-flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.3s ease; box-shadow: 0 8px 25px rgba(59, 183, 126, 0.25); cursor: pointer;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 30px rgba(59, 183, 126, 0.35)';" onmouseout="this.style.transform='none'; this.style.boxShadow='0 8px 25px rgba(59, 183, 126, 0.25)';">
                     <i class="fi-rs-credit-card" style="margin-right: 5px;"></i> Pay
                  </button>
                  <a href="javascript:history.back();" class="btn-cancel" style="color: #7e7e7e; font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 15px; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 4px; text-decoration: none;" onmouseover="this.style.color='#ef4444';" onmouseout="this.style.color='#7e7e7e';">
                     <i class="fi-rs-arrow-small-left"></i> Cancel
                  </a>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('form').on('submit', function(e) {
            var skipModal = localStorage.getItem('skip_delivery_conditions_modal');
            if (skipModal === 'true') {
                return true;
            }

            e.preventDefault();

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: '<h4 style="color: #253D4E; font-weight: 700; font-family: \'Outfit\', sans-serif;">Delivery Conditions</h4>',
                    html: `
                        <div style="text-align: left; font-family: 'Inter', sans-serif; font-size: 14px; color: #555; line-height: 1.6;">
                            <p class="mb-3">Please note our delivery schedule conditions before completing your payment:</p>
                            <ul style="list-style-type: none; padding-left: 0; margin-bottom: 15px;">
                                <li style="margin-bottom: 8px;">📅 <strong>Delivery Days:</strong> Mondays, Thursdays, and Saturdays.</li>
                                <li style="margin-bottom: 8px;">🕒 <strong>Cutoff Hour:</strong> On delivery days, orders must be placed <strong>before 11:00 AM</strong> to be delivered same-day.</li>
                                <li style="margin-bottom: 8px;">📥 <strong>Queued Orders:</strong> Orders placed after 11:00 AM on delivery days (or on non-delivery days) will be queued for the next delivery day.</li>
                            </ul>
                            <hr style="border-color: #ececec; margin: 15px 0;">
                            <div style="background-color: #f7f8f9; padding: 12px; border-radius: 6px; border-left: 4px solid #3bb77e; margin-bottom: 15px;">
                                <strong>Estimated Delivery Date:</strong><br>
                                <span style="color: #3bb77e; font-weight: 700; font-size: 15px;">{{ $deliveryInfo['next_delivery_date_formatted'] }}</span> 
                                (in {{ $deliveryInfo['proximity_days'] }} days)
                                @if($deliveryInfo['is_queued'])
                                    <br><span style="color: #d9534f; font-size: 12px; font-weight: bold;">(Queued due to cutoff time limit)</span>
                                @endif
                            </div>
                            <hr style="border-color: #ececec; margin: 15px 0;">
                            <div style="margin-top: 15px; display: flex; align-items: center; gap: 8px; justify-content: flex-start;">
                                <input type="checkbox" id="dont_show_again" style="width: 18px; height: 18px; cursor: pointer; margin: 0;">
                                <label for="dont_show_again" style="cursor: pointer; font-weight: 600; color: #253D4E; margin: 0; font-size: 13px;">Don't show this notification again</label>
                            </div>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonColor: '#3bb77e',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Proceed to Payment',
                    cancelButtonText: 'Cancel',
                    focusConfirm: false,
                    preConfirm: () => {
                        const checked = document.getElementById('dont_show_again').checked;
                        return { dontShowAgain: checked };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (result.value.dontShowAgain) {
                            localStorage.setItem('skip_delivery_conditions_modal', 'true');
                        }
                        $('form').off('submit').submit();
                    }
                });
            } else {
                if (confirm("Please note: Delivery days are Mondays, Thursdays, Saturdays. Orders after 11am are queued. Estimated delivery is: {{ $deliveryInfo['next_delivery_date_formatted'] }}. Proceed to payment?")) {
                    $('form').off('submit').submit();
                }
            }
        });
    });
 </script>
@endsection
