@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Custom Item Requests</div>
      <div class="ms-auto">
         <button type="button" id="btnBulkDelete" class="btn btn-danger btn-sm" style="display: none;">
            <i class="bx bx-trash"></i> Delete Selected (<span id="selectedCount">0</span>)
         </button>
      </div>
   </div>
   <!--end breadcrumb-->
   <hr/>
   <div class="card">
      <div class="card-body">
         <form id="bulkDeleteForm" action="{{ route('admin.lifestyle.requests.bulk_delete') }}" method="POST">
            @csrf
            <div class="table-responsive">
               <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                     <tr>
                        <th style="width: 40px; text-align: center;">
                           <input class="form-check-input" type="checkbox" id="selectAll">
                        </th>
                        <th>S/N</th>
                        <th>User Info</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Special Note</th>
                        <th>Status</th>
                        <th>Admin Response</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                   @foreach ($requests as $key => $itemRequest)
                       <tr>
                           <td style="text-align: center;">
                              <input class="form-check-input select-item" type="checkbox" name="ids[]" value="{{ $itemRequest->id }}">
                           </td>
                           <td>{{ $key+1 }}</td>
                           <td>
                               @if ($itemRequest->user)
                                   <strong>{{ $itemRequest->user->name }}</strong><br/>
                                   <span class="text-muted" style="font-size: 11px;">{{ $itemRequest->user->email }}</span>
                               @else
                                   <span class="text-muted">Guest / Unknown</span>
                               @endif
                           </td>
                           <td><strong>{{ $itemRequest->product_name }}</strong></td>
                           <td>{{ $itemRequest->quantity }}</td>
                           <td style="max-width: 200px; white-space: normal;">{{ $itemRequest->special_note ?? 'N/A' }}</td>
                           <td>
                               @if ($itemRequest->status == 'submitted')
                                   <span class="badge bg-secondary">Submitted</span>
                               @elseif ($itemRequest->status == 'under_review')
                                   <span class="badge bg-warning text-dark">Under Review</span>
                               @elseif ($itemRequest->status == 'sourced')
                                   <span class="badge bg-success">Sourced</span>
                               @elseif ($itemRequest->status == 'unavailable')
                                   <span class="badge bg-danger">Unavailable</span>
                               @endif
                           </td>
                           <td style="max-width: 200px; white-space: normal;">{{ $itemRequest->admin_response ?? 'No response yet.' }}</td>
                           <td>
                               <!-- Response form modal trigger -->
                               <button type="button" class="btn btn-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target="#respondModal{{ $itemRequest->id }}" title="Respond">
                                   Respond
                               </button>

                               <!-- Delete Single Item -->
                               <a href="{{ route('admin.lifestyle.requests.delete', $itemRequest->id) }}" class="btn btn-danger btn-sm" id="delete" title="Delete">
                                   <i class="bx bx-trash"></i>
                               </a>

                               <!-- Modal -->
                               <div class="modal fade" id="respondModal{{ $itemRequest->id }}" tabindex="-1" aria-labelledby="respondModalLabel{{ $itemRequest->id }}" aria-hidden="true">
                                   <div class="modal-dialog">
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               <h5 class="modal-title" id="respondModalLabel{{ $itemRequest->id }}">Respond to Request</h5>
                                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                           </div>
                                           <div class="modal-body">
                                               <div class="mb-3">
                                                   <label class="form-label">Product Name</label>
                                                   <input type="text" class="form-control" value="{{ $itemRequest->product_name }}" disabled>
                                               </div>
                                               <div class="mb-3">
                                                   <label class="form-label">Request Status</label>
                                                   <select name="status" class="form-select" form="respondForm{{ $itemRequest->id }}" required>
                                                       <option value="submitted" {{ $itemRequest->status == 'submitted' ? 'selected' : '' }}>Submitted</option>
                                                       <option value="under_review" {{ $itemRequest->status == 'under_review' ? 'selected' : '' }}>Under Review</option>
                                                       <option value="sourced" {{ $itemRequest->status == 'sourced' ? 'selected' : '' }}>Sourced (Available)</option>
                                                       <option value="unavailable" {{ $itemRequest->status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                                                   </select>
                                               </div>
                                               <div class="mb-3">
                                                   <label class="form-label">Admin Response Notes</label>
                                                   <textarea name="admin_response" class="form-control" form="respondForm{{ $itemRequest->id }}" rows="3" placeholder="e.g. Sourced at vendor, ready to order!">{{ $itemRequest->admin_response }}</textarea>
                                               </div>
                                           </div>
                                           <div class="modal-footer">
                                               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                               <button type="submit" form="respondForm{{ $itemRequest->id }}" class="btn btn-primary">Save Response</button>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </td>
                       </tr>
                   @endforeach
                  </tbody>
               </table>
            </div>
         </form>

         {{-- Separate Response Forms outside the main bulk form to avoid nested form issues --}}
         @foreach ($requests as $itemRequest)
            <form id="respondForm{{ $itemRequest->id }}" action="{{ route('admin.lifestyle.requests.respond') }}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="id" value="{{ $itemRequest->id }}">
            </form>
         @endforeach
      </div>
   </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
   function updateBulkDeleteState() {
      var checkedCount = document.querySelectorAll('.select-item:checked').length;
      var btn = document.getElementById('btnBulkDelete');
      var countSpan = document.getElementById('selectedCount');

      if (countSpan) {
         countSpan.textContent = checkedCount;
      }

      if (btn) {
         if (checkedCount > 0) {
            btn.style.display = 'inline-block';
         } else {
            btn.style.display = 'none';
         }
      }
   }

   var selectAll = document.getElementById('selectAll');
   if (selectAll) {
      selectAll.addEventListener('change', function () {
         var items = document.querySelectorAll('.select-item');
         items.forEach(function (item) {
            item.checked = selectAll.checked;
         });
         updateBulkDeleteState();
      });
   }

   document.addEventListener('change', function (e) {
      if (e.target && e.target.classList.contains('select-item')) {
         var total = document.querySelectorAll('.select-item').length;
         var checked = document.querySelectorAll('.select-item:checked').length;
         if (selectAll) {
            selectAll.checked = (total > 0 && total === checked);
         }
         updateBulkDeleteState();
      }
   });

   var btnBulkDelete = document.getElementById('btnBulkDelete');
   if (btnBulkDelete) {
      btnBulkDelete.addEventListener('click', function (e) {
         e.preventDefault();
         var checkedCount = document.querySelectorAll('.select-item:checked').length;
         if (checkedCount === 0) {
            if (typeof Swal !== 'undefined') {
               Swal.fire('No Selection', 'Please select at least one request to delete.', 'info');
            } else {
               alert('Please select at least one request to delete.');
            }
            return;
         }

         if (typeof Swal !== 'undefined') {
            Swal.fire({
               title: 'Are you sure?',
               text: 'Delete ' + checkedCount + ' selected request(s)? This action cannot be undone.',
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#d33',
               cancelButtonColor: '#6c757d',
               confirmButtonText: 'Yes, delete selected!'
            }).then((result) => {
               if (result.isConfirmed) {
                  document.getElementById('bulkDeleteForm').submit();
               }
            });
         } else {
            if (confirm('Are you sure you want to delete ' + checkedCount + ' selected request(s)?')) {
               document.getElementById('bulkDeleteForm').submit();
            }
         }
      });
   }
});
</script>
@endsection
