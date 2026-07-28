@extends('back.admin.master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Site Setting</div>
      {{-- <div class="ps-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
               <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">Site Setting</li>
            </ol>
         </nav>
      </div> --}}
      <div class="ms-auto">
      </div>
   </div>
   <!--end breadcrumb-->
   <div class="container">
      <div class="main-body">
         <div class="row">
            <div class="col-lg-8">
               <div class="card">
                  <div class="card-body">
                     <form method="post" action="{{ route('site.setting.update') }}" enctype="multipart/form-data" >
                        @csrf
                        <input type="hidden" name="id" value="{{ $setting->id }}">
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Support Phone</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <input type="text" class="form-control" name="support_phone" value="{{ $setting->support_phone }}" />
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Phone One</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <input type="text" name="phone_one" class="form-control" value="{{ $setting->phone_one }}" />
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Email</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <input type="email" name="email" class="form-control" value="{{ $setting->email }}" />
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Company Address </h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <input type="text" name="company_address" class="form-control" value="{{ $setting->company_address }}" />
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Instagram</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <input type="text" name="facebook" class="form-control" value="{{ $setting->facebook }}" />
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">WhatsApp</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <input type="text" name="twitter" class="form-control" value="{{ $setting->twitter }}" />
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Youtube</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <input type="text" name="youtube" class="form-control" value="{{ $setting->youtube }}" />
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">CopyRight</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <input type="text" name="copyright" class="form-control" value="{{ $setting->copyright }}" />
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Logo</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <input type="file" name="logo" class="form-control"  id="image"   />
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0"> </h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <img id="showImage" src="{{ asset($setting->logo)   }}" alt="Logo" style="width:100px; height: 100px;"  >
                           </div>
                        </div>
                        <hr>
                        <h5 class="mb-3 text-success">Affiliate Referral Settings</h5>
                        
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Commission Type</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <select name="referral_commission_type" class="form-select">
                                 <option value="flat" {{ ($setting->referral_commission_type ?? 'flat') == 'flat' ? 'selected' : '' }}>Flat sign-up bonus</option>
                                 <option value="percentage" {{ ($setting->referral_commission_type ?? 'flat') == 'percentage' ? 'selected' : '' }}>Percentage of first order</option>
                              </select>
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Flat Amount (GH¢)</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <input type="number" step="0.01" class="form-control" name="referral_flat_amount" value="{{ $setting->referral_flat_amount ?? '15.00' }}" />
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Percentage (%)</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <input type="number" step="0.01" class="form-control" name="referral_percentage" value="{{ $setting->referral_percentage ?? '10.00' }}" />
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Partner Referral Amount (GH¢)</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <input type="number" step="0.01" class="form-control" name="partner_referral_amount" value="{{ $setting->partner_referral_amount ?? '3.00' }}" />
                              <small class="text-muted">Amount earned by partner institutions when a referred user places their first order.</small>
                           </div>
                        </div>

                        <hr>
                        <h5 class="mb-3 text-primary">Delivery Fee Settings</h5>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Student Flat Fee (GH¢)</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <input type="number" step="0.01" class="form-control" name="student_flat_fee" value="{{ $setting->student_flat_fee ?? '15.00' }}" required />
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Student Percentage Fee (%)</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <input type="number" step="0.01" class="form-control" name="student_percent_fee" value="{{ $setting->student_percent_fee ?? '10.00' }}" required />
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Non-Student Flat Fee (GH¢)</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <input type="number" step="0.01" class="form-control" name="non_student_flat_fee" value="{{ $setting->non_student_flat_fee ?? '20.00' }}" required />
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Non-Student Percentage Fee (%)</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <input type="number" step="0.01" class="form-control" name="non_student_percent_fee" value="{{ $setting->non_student_percent_fee ?? '12.50' }}" required />
                           </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                               <h6 class="mb-0">Minimum Order Threshold (GH¢)</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                               <input type="number" step="0.01" class="form-control" name="min_order_amount" value="{{ $setting->min_order_amount ?? '50.00' }}" required />
                               <small class="text-muted">Orders below this subtotal will be ineligible for delivery checkout.</small>
                            </div>
                         </div>

                         <hr>
                         <h5 class="mb-3 text-warning">Delivery Schedule & Cutoff Settings</h5>

                         <div class="row mb-3">
                            <div class="col-sm-3">
                               <h6 class="mb-0">Active Delivery Days</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                               @php
                                  $activeDays = explode(',', $setting->delivery_days ?? '1,4,6');
                               @endphp
                               <div class="d-flex flex-wrap gap-3">
                                  <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="delivery_days[]" value="1" id="day_mon" {{ in_array('1', $activeDays) ? 'checked' : '' }}>
                                     <label class="form-check-label" for="day_mon">Monday</label>
                                  </div>
                                  <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="delivery_days[]" value="2" id="day_tue" {{ in_array('2', $activeDays) ? 'checked' : '' }}>
                                     <label class="form-check-label" for="day_tue">Tuesday</label>
                                  </div>
                                  <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="delivery_days[]" value="3" id="day_wed" {{ in_array('3', $activeDays) ? 'checked' : '' }}>
                                     <label class="form-check-label" for="day_wed">Wednesday</label>
                                  </div>
                                  <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="delivery_days[]" value="4" id="day_thu" {{ in_array('4', $activeDays) ? 'checked' : '' }}>
                                     <label class="form-check-label" for="day_thu">Thursday</label>
                                  </div>
                                  <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="delivery_days[]" value="5" id="day_fri" {{ in_array('5', $activeDays) ? 'checked' : '' }}>
                                     <label class="form-check-label" for="day_fri">Friday</label>
                                  </div>
                                  <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="delivery_days[]" value="6" id="day_sat" {{ in_array('6', $activeDays) ? 'checked' : '' }}>
                                     <label class="form-check-label" for="day_sat">Saturday</label>
                                  </div>
                                  <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="delivery_days[]" value="7" id="day_sun" {{ in_array('7', $activeDays) ? 'checked' : '' }}>
                                     <label class="form-check-label" for="day_sun">Sunday</label>
                                  </div>
                               </div>
                               <small class="text-muted d-block mt-1">Select the days when deliveries are scheduled (default: Mondays, Thursdays, Saturdays).</small>
                            </div>
                         </div>

                         <div class="row mb-3">
                            <div class="col-sm-3">
                               <h6 class="mb-0">Cutoff Time</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                               <input type="time" class="form-control" name="delivery_cutoff_time" value="{{ $setting->delivery_cutoff_time ?? '11:00' }}" required />
                               <small class="text-muted">On delivery days, orders placed after this time will be queued for the next delivery day.</small>
                            </div>
                         </div>

                        <div class="row">
                           <div class="col-sm-3"></div>
                           <div class="col-sm-9 text-secondary">
                              <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                           </div>
                        </div>
                  </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function(){
   	$('#image').change(function(e){
   		var reader = new FileReader();
   		reader.onload = function(e){
   			$('#showImage').attr('src',e.target.result);
   		}
   		reader.readAsDataURL(e.target.files['0']);
   	});
   });
</script>
@endsection
