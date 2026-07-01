@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Bulk Upload Report</div>
      <div class="ms-auto">
         <div class="btn-group">
            <a href="{{ route('bulk.upload.images') }}" class="btn btn-primary"><i class="bx bx-upload"></i> Upload More</a>
            <a href="{{ route('all.products') }}" class="btn btn-secondary">All Products</a>
         </div>
      </div>
   </div>
   <!--end breadcrumb-->
   <hr/>

   <!-- Summary cards -->
   <div class="row row-cols-1 row-cols-md-2 g-3 mb-4">
      <div class="col">
         <div class="card radius-10 border-start border-0 border-3 border-success">
            <div class="card-body">
               <div class="d-flex align-items-center">
                  <div>
                     <p class="mb-0 text-secondary">Successfully Matched & Uploaded</p>
                     <h4 class="my-1 text-success">{{ count($results['success']) }} Images</h4>
                  </div>
                  <div class="widgets-icons-2 rounded-circle bg-light-success text-success ms-auto">
                     <i class="bx bx-check-circle"></i>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col">
         <div class="card radius-10 border-start border-0 border-3 border-danger">
            <div class="card-body">
               <div class="d-flex align-items-center">
                  <div>
                     <p class="mb-0 text-secondary">Failed / Skipped</p>
                     <h4 class="my-1 text-danger">{{ count($results['failed']) }} Files</h4>
                  </div>
                  <div class="widgets-icons-2 rounded-circle bg-light-danger text-danger ms-auto">
                     <i class="bx bx-x-circle"></i>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="row">
      <!-- Success Table -->
      <div class="col-lg-12 mb-4">
         <div class="card">
            <div class="card-body">
               <div class="d-flex align-items-center">
                  <h6 class="mb-0 text-uppercase text-success"><i class="bx bx-check-double"></i> Success Details</h6>
               </div>
               <hr/>
               @if(count($results['success']) > 0)
                  <div class="table-responsive">
                     <table class="table table-striped table-bordered">
                        <thead>
                           <tr>
                              <th>Original Filename</th>
                              <th>Target Product</th>
                              <th>Action Type</th>
                              <th>Status</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($results['success'] as $item)
                              <tr>
                                 <td><code>{{ $item['filename'] }}</code></td>
                                 <td><strong>{{ $item['product'] }}</strong></td>
                                 <td>
                                    @if($item['type'] == 'Thumbnail')
                                       <span class="badge bg-primary">Thumbnail</span>
                                    @else
                                       <span class="badge bg-info text-dark">Multi Image</span>
                                    @endif
                                 </td>
                                 <td><span class="badge bg-success"><i class="bx bx-check"></i> Applied</span></td>
                              </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               @else
                  <div class="text-center p-4">
                     <p class="text-muted">No images were successfully uploaded in this batch.</p>
                  </div>
               @endif
            </div>
         </div>
      </div>

      <!-- Failed Table -->
      <div class="col-lg-12">
         <div class="card">
            <div class="card-body">
               <div class="d-flex align-items-center">
                  <h6 class="mb-0 text-uppercase text-danger"><i class="bx bx-error-circle"></i> Skipped / Error Details</h6>
               </div>
               <hr/>
               @if(count($results['failed']) > 0)
                  <div class="table-responsive">
                     <table class="table table-striped table-bordered">
                        <thead>
                           <tr>
                              <th>Filename</th>
                              <th>Error Reason / Match Failure</th>
                              <th>Action Required</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($results['failed'] as $item)
                              <tr>
                                 <td><code>{{ $item['filename'] }}</code></td>
                                 <td class="text-danger">{{ $item['reason'] }}</td>
                                 <td><span class="badge bg-warning text-dark">Rename to include valid Product ID/Code</span></td>
                              </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               @else
                  <div class="text-center p-4">
                     <p class="text-success"><i class="bx bx-smile"></i> Perfect match! No files were skipped or failed.</p>
                  </div>
               @endif
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
