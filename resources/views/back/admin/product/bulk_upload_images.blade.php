@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Bulk Image Upload</div>
      <div class="ms-auto">
         <div class="btn-group">
            <a href="{{ route('download.all.product.images') }}" class="btn btn-success" title="Download all product images as ZIP"><i class="fa fa-download"></i> Backup Current Images</a>
            <a href="{{ route('all.products') }}" class="btn btn-secondary">Back to Products</a>
         </div>
      </div>
   </div>
   <!--end breadcrumb-->
   <hr/>

   <div class="row">
      <div class="col-lg-8">
         <div class="card border-top border-0 border-4 border-primary">
            <div class="card-body p-5">
               <div class="card-title d-flex align-items-center">
                  <div><i class="bx bx-upload me-1 font-22 text-primary"></i>
                  </div>
                  <h5 class="mb-0 text-primary">Upload Images</h5>
               </div>
               <hr>
               <form action="{{ route('store.bulk.upload.images') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                  @csrf
                  
                  <div class="col-12 mb-4">
                     <label class="form-label font-weight-bold">Option 1: Upload ZIP Archive</label>
                     <p class="text-muted font-13">Pack all your images in a <code>.zip</code> file and upload it. The system will extract it and match files automatically.</p>
                     <div class="input-group">
                        <input type="file" name="zip_file" class="form-control" accept=".zip">
                        <span class="input-group-text"><i class="bx bx-file-archive"></i></span>
                     </div>
                     @error('zip_file')
                        <span class="text-danger font-13">{{ $message }}</span>
                     @enderror
                  </div>

                  <div class="col-12 mb-4">
                     <div class="text-center bg-light p-3 rounded mb-3">
                        <span class="text-secondary font-weight-bold">OR</span>
                     </div>
                  </div>

                  <div class="col-12 mb-4">
                     <label class="form-label font-weight-bold">Option 2: Direct Multi-File Upload</label>
                     <p class="text-muted font-13">Drag & drop or select multiple image files directly from your computer.</p>
                     <div class="input-group">
                        <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                        <span class="input-group-text"><i class="bx bx-image"></i></span>
                     </div>
                     @error('images')
                        <span class="text-danger font-13">{{ $message }}</span>
                     @enderror
                     @error('images.*')
                        <span class="text-danger font-13">{{ $message }}</span>
                     @enderror
                  </div>

                  <div class="col-12 mt-4 text-end">
                     <button type="submit" class="btn btn-primary px-5"><i class="bx bx-cloud-upload"></i> Start Upload & Match</button>
                  </div>
               </form>
            </div>
         </div>
      </div>

      <div class="col-lg-4">
         <div class="card bg-gradient-cosmic text-white">
            <div class="card-body p-4">
               <h5 class="card-title text-white">Naming Conventions</h5>
               <p class="font-13">The system matches filenames automatically. Please name your files using one of these rules:</p>
               <hr>
               <div class="mb-3">
                  <span class="badge bg-white text-dark mb-1">Thumbnails</span>
                  <p class="font-12 mb-1">Set the primary product thumbnail:</p>
                  <ul class="font-12 ps-3">
                     <li><code>{product_id}_thumb.jpg</code> (e.g. <code>12_thumb.jpg</code>)</li>
                     <li><code>{product_code}_thumb.jpg</code> (e.g. <code>PRD001_thumb.jpg</code>)</li>
                     <li><code>{product_slug}_thumb.jpg</code> (e.g. <code>gari_thumb.jpg</code>)</li>
                     <li><code>{product_id}.jpg</code> or <code>{product_code}.jpg</code></li>
                  </ul>
               </div>
               <div>
                  <span class="badge bg-white text-dark mb-1">Multi-Images</span>
                  <p class="font-12 mb-1">Add additional images to the product slider:</p>
                  <ul class="font-12 ps-3">
                     <li><code>{product_id}_multi_1.jpg</code></li>
                     <li><code>{product_code}_multi_2.jpg</code></li>
                     <li><code>{product_slug}_multi_3.jpg</code></li>
                     <li><code>{product_id}_2.jpg</code> or <code>{product_code}_3.jpg</code></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
