@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="ps-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
               <li class="breadcrumb-item"><a href="{{ route('admin.lifestyle.categories') }}"><i class="bx bx-arrow-back">&nbsp;Back</i></a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit Expert Category</li>
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
                     <form id="myForm" method="POST" action="{{ route('admin.lifestyle.categories.update') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $category->id }}">
                        
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Category Name</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="name" class="form-control" value="{{ $category->name }}" required />
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Category Code (For frontend filtering)</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="code" class="form-control" value="{{ $category->code }}" required />
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Badge Style</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <select name="badge_style" class="form-control" required>
                                  <option value="success" {{ $category->badge_style == 'success' ? 'selected' : '' }}>Success (Green)</option>
                                  <option value="info" {{ $category->badge_style == 'info' ? 'selected' : '' }}>Info (Blue)</option>
                                  <option value="warning" {{ $category->badge_style == 'warning' ? 'selected' : '' }}>Warning (Yellow)</option>
                                  <option value="danger" {{ $category->badge_style == 'danger' ? 'selected' : '' }}>Danger (Red)</option>
                                  <option value="primary" {{ $category->badge_style == 'primary' ? 'selected' : '' }}>Primary (Purple)</option>
                              </select>
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Icon / Emoji</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="icon" class="form-control" value="{{ $category->icon }}" />
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-3"></div>
                           <div class="col-sm-9 text-secondary">
                              <input type="submit" class="btn btn-primary px-4" value="Update Category" />
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
