@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="ps-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
               <li class="breadcrumb-item"><a href="{{ route('admin.lifestyle.tips') }}"><i class="bx bx-arrow-back">&nbsp;Back</i></a></li>
               <li class="breadcrumb-item active" aria-current="page">Add Health Tip</li>
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
                     <form id="myForm" method="POST" action="{{ route('admin.lifestyle.tips.store') }}">
                        @csrf
                        
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Tip Title</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="title" class="form-control" placeholder="e.g. Balanced College Diet Hacks" required />
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Type Slug (Unique lookup name)</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="type_slug" class="form-control" placeholder="e.g. nutrition or stress" required />
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Icon / Emoji</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="icon" class="form-control" placeholder="e.g. 🥗" />
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">HTML Content</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <textarea name="content" class="form-control" rows="8" placeholder="Enter HTML content..." required></textarea>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-sm-3"></div>
                           <div class="col-sm-9 text-secondary">
                              <input type="submit" class="btn btn-primary px-4" value="Add Health Tip" />
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
