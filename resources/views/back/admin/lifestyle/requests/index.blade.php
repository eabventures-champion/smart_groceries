@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Custom Item Requests</div>
   </div>
   <!--end breadcrumb-->
   <hr/>
   <div class="card">
      <div class="card-body">
         <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
               <thead>
                  <tr>
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
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#respondModal{{ $itemRequest->id }}">
                                Respond
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="respondModal{{ $itemRequest->id }}" tabindex="-1" aria-labelledby="respondModalLabel{{ $itemRequest->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.lifestyle.requests.respond') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $itemRequest->id }}">
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
                                                    <select name="status" class="form-select" required>
                                                        <option value="submitted" {{ $itemRequest->status == 'submitted' ? 'selected' : '' }}>Submitted</option>
                                                        <option value="under_review" {{ $itemRequest->status == 'under_review' ? 'selected' : '' }}>Under Review</option>
                                                        <option value="sourced" {{ $itemRequest->status == 'sourced' ? 'selected' : '' }}>Sourced (Available)</option>
                                                        <option value="unavailable" {{ $itemRequest->status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Admin Response Notes</label>
                                                    <textarea name="admin_response" class="form-control" rows="3" placeholder="e.g. Sourced at vendor, ready to order!">{{ $itemRequest->admin_response }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save Response</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
@endsection
