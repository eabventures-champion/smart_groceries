@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="ps-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
               <li class="breadcrumb-item"><a href="{{ route('admin.lifestyle.experts') }}"><i class="bx bx-arrow-back">&nbsp;Back</i></a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit Expert Profile</li>
            </ol>
         </nav>
      </div>
   </div>
   <!--end breadcrumb-->
   <div class="container">
      <div class="main-body">
         <div class="row">
            <div class="col-lg-10">
               <div class="card">
                  <div class="card-body">
                     <form id="myForm" method="POST" action="{{ route('admin.lifestyle.experts.update') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $expert->id }}">

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Expert Category</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <select name="expert_category_id" class="form-control" required>
                                  @foreach($categories as $category)
                                      <option value="{{ $category->id }}" {{ $expert->expert_category_id == $category->id ? 'selected' : '' }}>
                                          {{ $category->name }} ({{ $category->code }})
                                      </option>
                                  @endforeach
                              </select>
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Expert Name</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="name" class="form-control" value="{{ $expert->name }}" required />
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Initials (Optional)</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="initials" class="form-control" value="{{ $expert->initials }}" />
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Specialty Description</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <textarea name="specialty_description" class="form-control" rows="3" required>{{ $expert->specialty_description }}</textarea>
                           </div>
                        </div>

                         @php
                            $decoded = json_decode($expert->getRawOriginal('availability_schedule'), true);
                            $selectedDays = is_array($decoded) && isset($decoded['days']) ? $decoded['days'] : [];
                            $startTime = is_array($decoded) && isset($decoded['start_time']) ? $decoded['start_time'] : '08:00';
                            $endTime = is_array($decoded) && isset($decoded['end_time']) ? $decoded['end_time'] : '17:00';
                            $isLegacy = !empty($expert->getRawOriginal('availability_schedule')) && !is_array($decoded);
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
                                        <input class="form-check-input" type="checkbox" name="available_days[]" value="{{ $key }}" id="edit_day_{{ $key }}" {{ in_array($key, $selectedDays) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="edit_day_{{ $key }}">{{ $label }}</label>
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
                              <h6 class="mb-0">WhatsApp Number</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="whatsapp_number" class="form-control" value="{{ $expert->whatsapp_number }}" required />
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">WhatsApp Message Template</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <textarea name="whatsapp_message" class="form-control" rows="2">{{ $expert->whatsapp_message }}</textarea>
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Avatar BG Color (HEX code)</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="avatar_bg_color" class="form-control" value="{{ $expert->avatar_bg_color }}" required />
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Avatar Text Color (HEX code)</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="avatar_text_color" class="form-control" value="{{ $expert->avatar_text_color }}" required />
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Status</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <select name="is_active" class="form-control" required>
                                  <option value="1" {{ $expert->is_active == 1 ? 'selected' : '' }}>Active</option>
                                  <option value="0" {{ $expert->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                              </select>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-sm-3"></div>
                           <div class="col-sm-9 text-secondary">
                              <input type="submit" class="btn btn-primary px-4" value="Update Expert Profile" />
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
