@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Expert Dashboard</div>
      <div class="ps-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
               <li class="breadcrumb-item active" aria-current="page">Overview & Profile Setup</li>
            </ol>
         </nav>
      </div>
   </div>
   <!--end breadcrumb-->

   <!-- Cards Row -->
   <div class="row row-cols-1 row-cols-md-3 g-3 mb-4">
      <div class="col">
         <div class="card radius-10 bg-gradient-deepblue">
            <div class="card-body">
               <div class="d-flex align-items-center">
                  <h5 class="mb-0 text-white">{{ $totalBookings }}</h5>
                  <div class="ms-auto text-white fs-3">
                     <i class='bx bx-calendar'></i>
                  </div>
               </div>
               <div class="progress my-2 bg-light-transparent" style="height:3px;">
                  <div class="progress-bar bg-white" role="progressbar" style="width: 100%"></div>
               </div>
               <div class="text-white">
                  <p class="mb-0">Total Bookings</p>
               </div>
            </div>
         </div>
      </div>
      <div class="col">
         <div class="card radius-10 bg-gradient-orange">
            <div class="card-body">
               <div class="d-flex align-items-center">
                  <h5 class="mb-0 text-white">{{ $pendingBookings }}</h5>
                  <div class="ms-auto text-white fs-3">
                     <i class='bx bx-time'></i>
                  </div>
               </div>
               <div class="progress my-2 bg-light-transparent" style="height:3px;">
                  <div class="progress-bar bg-white" role="progressbar" style="width: 100%"></div>
               </div>
               <div class="text-white">
                  <p class="mb-0">Pending Bookings</p>
               </div>
            </div>
         </div>
      </div>
      <div class="col">
         <div class="card radius-10 bg-gradient-ohhappiness">
            <div class="card-body">
               <div class="d-flex align-items-center">
                  <h5 class="mb-0 text-white">{{ $confirmedBookings }}</h5>
                  <div class="ms-auto text-white fs-3">
                     <i class='bx bx-check-circle'></i>
                  </div>
               </div>
               <div class="progress my-2 bg-light-transparent" style="height:3px;">
                  <div class="progress-bar bg-white" role="progressbar" style="width: 100%"></div>
               </div>
               <div class="text-white">
                  <p class="mb-0">Confirmed Bookings</p>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="container">
      <div class="main-body">
         <div class="row">
            <div class="col-lg-12">
               @if(!$expert)
                  <div class="alert alert-warning border-0 bg-warning alert-dismissible fade show py-2">
                     <div class="d-flex align-items-center">
                        <div class="font-35 text-dark"><i class='bx bx-info-circle'></i></div>
                        <div class="ms-3">
                           <h6 class="mb-0 text-dark">Setup Required</h6>
                           <div class="text-dark">Please fill in your expert details below to publish your profile and enable bookings.</div>
                        </div>
                     </div>
                  </div>
               @endif

               <div class="card">
                  <div class="card-header bg-primary text-white py-3">
                     <h5 class="mb-0 text-white">Setup Expert Profile & Information</h5>
                  </div>
                  <div class="card-body p-4">
                     <form id="myForm" method="POST" action="{{ route('expert.profile.update') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0 align-middle">Full Name</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <input type="text" class="form-control" value="{{ Auth::user()->name }}" disabled />
                              <span class="text-muted" style="font-size: 11px;">Name is linked to your user account and cannot be modified here.</span>
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Expert Category</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <select name="expert_category_id" class="form-select" required>
                                  <option value="" disabled selected>Select a category</option>
                                  @foreach($categories as $category)
                                      <option value="{{ $category->id }}" {{ ($expert && $expert->expert_category_id == $category->id) ? 'selected' : '' }}>
                                          {{ $category->name }} ({{ $category->code }})
                                      </option>
                                  @endforeach
                              </select>
                              <span class="text-muted" style="font-size: 11px;">Choose the specialty category under which clients will find you.</span>
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Specialty Description</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <textarea name="specialty_description" class="form-control" rows="4" placeholder="Briefly describe your expertise, experience, and the areas you consult on..." required>{{ $expert ? $expert->specialty_description : '' }}</textarea>
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">WhatsApp Number</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="whatsapp_number" class="form-control" placeholder="e.g. 233240000000" value="{{ $expert ? $expert->whatsapp_number : '' }}" required />
                              <span class="text-muted" style="font-size: 11px;">Provide the phone number with country code (no +) where users can message you directly.</span>
                           </div>
                        </div>

                         <div class="row mb-3">
                            <div class="col-sm-3">
                               <h6 class="mb-0">WhatsApp Message Template</h6>
                            </div>
                            <div class="form-group col-sm-9 text-secondary">
                               <textarea name="whatsapp_message" class="form-control" rows="2" placeholder="Pre-populated message when a client clicks your WhatsApp chat link...">{{ $expert ? $expert->whatsapp_message : '' }}</textarea>
                            </div>
                         </div>

                         <div class="row mb-3">
                            <div class="col-sm-3">
                               <h6 class="mb-0">Profile Image</h6>
                            </div>
                            <div class="form-group col-sm-9 text-secondary">
                               <input type="file" name="photo" class="form-control" id="image" />
                               <div class="mt-2">
                                   <img id="showImage" src="{{ (!empty(Auth::user()->photo)) ? url('back/assets/images/admin/'.Auth::user()->photo) : url('back/assets/images/admin/no_image.jpg') }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; border: 2px solid #3bb77e; padding: 2px;">
                               </div>
                            </div>
                         </div>

                         <div class="row mb-3">
                            <div class="col-sm-3">
                               <h6 class="mb-0">Reset Password (Optional)</h6>
                            </div>
                            <div class="form-group col-sm-9 text-secondary">
                               <input type="password" name="new_password" class="form-control" placeholder="Leave blank to keep current password" />
                            </div>
                         </div>

                         <div class="row mb-3">
                            <div class="col-sm-3">
                               <h6 class="mb-0">Confirm Password</h6>
                            </div>
                            <div class="form-group col-sm-9 text-secondary">
                               <input type="password" name="new_password_confirmation" class="form-control" placeholder="Confirm your new password" />
                            </div>
                         </div>

                        @php
                            $decoded = $expert ? json_decode($expert->getRawOriginal('availability_schedule'), true) : null;
                            $selectedDays = is_array($decoded) && isset($decoded['days']) ? $decoded['days'] : [];
                            $startTime = is_array($decoded) && isset($decoded['start_time']) ? $decoded['start_time'] : '08:00';
                            $endTime = is_array($decoded) && isset($decoded['end_time']) ? $decoded['end_time'] : '17:00';
                            $isLegacy = $expert && !empty($expert->getRawOriginal('availability_schedule')) && !is_array($decoded);
                         @endphp

                         @if($isLegacy)
                            <div class="row mb-3">
                               <div class="col-sm-3"></div>
                               <div class="col-sm-9">
                                  <div class="alert alert-warning mb-0 py-2">
                                     <strong>Legacy Schedule Active:</strong> "{{ $expert->availability_schedule }}".
                                     Saving this form will update it to the new structured calendar format.
                                  </div>
                               </div>
                            </div>
                         @endif

                         <div class="row mb-3">
                            <div class="col-sm-3">
                               <h6 class="mb-0">Available Days</h6>
                            </div>
                            <div class="form-group col-sm-9 text-secondary">
                               <div class="d-flex flex-wrap gap-3">
                                  @foreach(['Mon' => 'Mon', 'Tue' => 'Tue', 'Wed' => 'Wed', 'Thu' => 'Thu', 'Fri' => 'Fri', 'Sat' => 'Sat', 'Sun' => 'Sun'] as $key => $label)
                                     <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="available_days[]" value="{{ $key }}" id="profile_day_{{ $key }}" {{ in_array($key, $selectedDays) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="profile_day_{{ $key }}">{{ $label }}</label>
                                     </div>
                                  @endforeach
                               </div>
                            </div>
                         </div>

                         <div class="row mb-3">
                            <div class="col-sm-3">
                               <h6 class="mb-0">Consulting Hours</h6>
                            </div>
                            <div class="form-group col-sm-9 text-secondary">
                               <div class="row">
                                  <div class="col-6">
                                     <div class="input-group">
                                        <span class="input-group-text">Start</span>
                                        <input type="time" name="start_time" class="form-control" value="{{ $startTime }}" required />
                                     </div>
                                  </div>
                                  <div class="col-6">
                                     <div class="input-group">
                                        <span class="input-group-text">End</span>
                                        <input type="time" name="end_time" class="form-control" value="{{ $endTime }}" required />
                                     </div>
                                  </div>
                                </div>
                            </div>
                         </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Avatar Background Color</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="avatar_bg_color" class="form-control w-25" placeholder="e.g. #e6f7ef" value="{{ $expert ? $expert->avatar_bg_color : '#e6f7ef' }}" required />
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Avatar Text Color</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="avatar_text_color" class="form-control w-25" placeholder="e.g. #2e8b5e" value="{{ $expert ? $expert->avatar_text_color : '#2e8b5e' }}" required />
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-sm-3"></div>
                           <div class="col-sm-9 text-secondary">
                              <input type="submit" class="btn btn-primary px-4" value="Save Profile Settings" />
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
