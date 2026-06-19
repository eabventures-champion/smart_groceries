@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="ps-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
               <li class="breadcrumb-item"><a href="{{ route('admin.lifestyle.experts') }}"><i class="bx bx-arrow-back">&nbsp;Back</i></a></li>
               <li class="breadcrumb-item active" aria-current="page">Add Expert Profile</li>
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
                     <form id="myForm" method="POST" action="{{ route('admin.lifestyle.experts.store') }}">
                        @csrf
                        
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Expert Category</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <select name="expert_category_id" class="form-control" required>
                                  <option value="">Select Category</option>
                                  @foreach($categories as $category)
                                      <option value="{{ $category->id }}">{{ $category->name }} ({{ $category->code }})</option>
                                  @endforeach
                              </select>
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Expert Name</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="name" class="form-control" placeholder="e.g. Dr. Sophia Adams" required />
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Initials (Optional)</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="initials" class="form-control" placeholder="e.g. SA (Leaves empty to auto-generate)" />
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Specialty Description</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <textarea name="specialty_description" class="form-control" rows="3" placeholder="e.g. Expert on customized student meal prepping..." required></textarea>
                           </div>
                        </div>

                         <div class="row mb-3">
                            <div class="col-sm-3">
                               <h6 class="mb-0">Available Days</h6>
                            </div>
                            <div class="form-group col-sm-9 text-secondary">
                               <div class="d-flex flex-wrap gap-3">
                                  @foreach(['Mon' => 'Mon', 'Tue' => 'Tue', 'Wed' => 'Wed', 'Thu' => 'Thu', 'Fri' => 'Fri', 'Sat' => 'Sat', 'Sun' => 'Sun'] as $key => $label)
                                     <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="available_days[]" value="{{ $key }}" id="add_day_{{ $key }}">
                                        <label class="form-check-label" for="add_day_{{ $key }}">{{ $label }}</label>
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
                                        <input type="time" name="start_time" class="form-control" value="08:00" required />
                                     </div>
                                  </div>
                                  <div class="col-6">
                                     <div class="input-group">
                                        <span class="input-group-text">End</span>
                                        <input type="time" name="end_time" class="form-control" value="17:00" required />
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
                              <input type="text" name="whatsapp_number" class="form-control" placeholder="e.g. 233240000000" required />
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">WhatsApp Message Template</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <textarea name="whatsapp_message" class="form-control" rows="2" placeholder="e.g. Hi Dr. Sophia, I am chatting via Smart Groceries..."></textarea>
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Avatar BG Color (HEX code)</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="avatar_bg_color" class="form-control" value="#e6f7ef" placeholder="#e6f7ef" required />
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Avatar Text Color (HEX code)</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="avatar_text_color" class="form-control" value="#2e8b5e" placeholder="#2e8b5e" required />
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-sm-3"></div>
                           <div class="col-sm-9 text-secondary">
                              <input type="submit" class="btn btn-primary px-4" value="Add Expert Profile" />
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
