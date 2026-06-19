@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Set Availability</div>
      <div class="ps-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
               <li class="breadcrumb-item active" aria-current="page">Manage Availability Schedule</li>
            </ol>
         </nav>
      </div>
   </div>
   <!--end breadcrumb-->
   <hr/>
   <div class="container">
      <div class="main-body">
         <div class="row">
            <div class="col-lg-8">
               <div class="card">
                  <div class="card-header bg-primary text-white py-3">
                     <h5 class="mb-0 text-white">Update Availability Schedule</h5>
                  </div>
                  <div class="card-body p-4">
                      <form method="POST" action="{{ route('expert.availability.update') }}">
                         @csrf

                         @php
                            $decoded = $expert ? json_decode($expert->getRawOriginal('availability_schedule'), true) : null;
                            $selectedDays = is_array($decoded) && isset($decoded['days']) ? $decoded['days'] : [];
                            $startTime = is_array($decoded) && isset($decoded['start_time']) ? $decoded['start_time'] : '08:00';
                            $endTime = is_array($decoded) && isset($decoded['end_time']) ? $decoded['end_time'] : '17:00';
                            $isLegacy = $expert && !empty($expert->getRawOriginal('availability_schedule')) && !is_array($decoded);
                         @endphp

                         @if($isLegacy)
                            <div class="alert alert-warning mb-4">
                               <strong>Legacy Schedule Active:</strong> "{{ $expert->availability_schedule }}".
                               Saving this form will update it to the new structured calendar format.
                            </div>
                         @endif

                         <div class="mb-4">
                            <label class="form-label font-weight-bold d-block">Available Days</label>
                            <div class="d-flex flex-wrap gap-3">
                               @foreach(['Mon' => 'Monday', 'Tue' => 'Tuesday', 'Wed' => 'Wednesday', 'Thu' => 'Thursday', 'Fri' => 'Friday', 'Sat' => 'Saturday', 'Sun' => 'Sunday'] as $key => $label)
                                  <div class="form-check form-check-inline">
                                     <input class="form-check-input" type="checkbox" name="available_days[]" value="{{ $key }}" id="day_{{ $key }}" {{ in_array($key, $selectedDays) ? 'checked' : '' }}>
                                     <label class="form-check-label" for="day_{{ $key }}">{{ $label }}</label>
                                  </div>
                               @endforeach
                            </div>
                            <div class="form-text text-muted mt-2">
                               Select the days of the week you are available for consulting sessions.
                            </div>
                         </div>

                         <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                               <label class="form-label font-weight-bold">Start Time</label>
                               <input type="time" name="start_time" class="form-control" value="{{ $startTime }}" required />
                            </div>
                            <div class="col-md-6">
                               <label class="form-label font-weight-bold">End Time</label>
                               <input type="time" name="end_time" class="form-control" value="{{ $endTime }}" required />
                            </div>
                         </div>

                        <div class="row">
                           <div class="col text-secondary">
                              <input type="submit" class="btn btn-primary px-4" value="Update Availability" />
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
@endsection
