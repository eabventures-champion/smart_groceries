@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="ps-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
               <li class="breadcrumb-item"><a href="{{ route('admin.lifestyle.categories') }}"><i class="bx bx-arrow-back">&nbsp;Back</i></a></li>
               <li class="breadcrumb-item active" aria-current="page">Add Expert Category</li>
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
                     <form id="myForm" method="POST" action="{{ route('admin.lifestyle.categories.store') }}">
                        @csrf
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Category Name</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="name" class="form-control" placeholder="e.g. Dietician" required />
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Category Code (For frontend filtering)</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="code" class="form-control" placeholder="e.g. MD or Dentist" required />
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Badge Style</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <select name="badge_style" class="form-control" required>
                                  <option value="success">Success (Green)</option>
                                  <option value="info">Info (Blue)</option>
                                  <option value="warning">Warning (Yellow)</option>
                                  <option value="danger">Danger (Red)</option>
                                  <option value="primary">Primary (Purple)</option>
                              </select>
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Icon / Emoji</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="icon" class="form-control" placeholder="e.g. 🥦" />
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-3"></div>
                           <div class="col-sm-9 text-secondary">
                              <input type="submit" class="btn btn-primary px-4" value="Add Category" />
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
