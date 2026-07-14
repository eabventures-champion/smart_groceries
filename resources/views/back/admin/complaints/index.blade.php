@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Complaints & Suggestions</div>
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
                     <th>Type</th>
                     <th>Subject</th>
                     <th>Comment</th>
                     <th>Date Submitted</th>
                     <th>Status</th>
                     <th>Admin Reply</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($complaints as $key => $item)		
                  <tr>
                     <td> {{ $key+1 }} </td>
                     <td>
                        @if($item->user)
                           <strong>{{ $item->user->name }}</strong><br/>
                           <span class="text-muted" style="font-size: 11px;">{{ $item->user->email }}</span><br/>
                           <span class="text-muted" style="font-size: 11px;">{{ $item->user->phone }}</span>
                        @else
                           <span class="text-muted">Unknown User</span>
                        @endif
                     </td>
                     <td>
                        @if($item->type == 'complaint')
                           <span class="badge bg-danger">Complaint</span>
                        @else
                           <span class="badge bg-info text-dark">Suggestion</span>
                        @endif
                     </td>
                     <td><strong>{{ $item->subject }}</strong></td>
                     <td style="max-width: 250px; white-space: normal;">{{ $item->comment }}</td>
                     <td>{{ $item->created_at->format('d M Y, h:i A') }}</td>
                     <td>
                        @if($item->status == 'pending')
                           <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($item->status == 'reviewed')
                           <span class="badge bg-secondary">Reviewed</span>
                        @elseif($item->status == 'resolved')
                           <span class="badge bg-success">Resolved</span>
                        @endif
                     </td>
                     <td style="max-width: 200px; white-space: normal;">{{ $item->admin_reply ?? 'No reply yet.' }}</td>
                     <td>
                        <!-- Respond button modal trigger -->
                        <button type="button" class="btn btn-primary btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#respondModal{{ $item->id }}">
                           Respond
                        </button>
                        
                        <a href="{{ route('admin.complaints.delete', $item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this submission?');">
                           Delete
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="respondModal{{ $item->id }}" tabindex="-1" aria-labelledby="respondModalLabel{{ $item->id }}" aria-hidden="true">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <form action="{{ route('admin.complaints.respond') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="respondModalLabel{{ $item->id }}">Respond to Feedback</h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                       <div class="mb-3">
                                          <label class="form-label">Submitted By</label>
                                          <input type="text" class="form-control" value="{{ $item->user->name ?? 'Unknown' }} ({{ $item->user->email ?? 'N/A' }})" disabled>
                                       </div>
                                       <div class="mb-3">
                                          <label class="form-label">Type & Subject</label>
                                          <input type="text" class="form-control" value="[{{ strtoupper($item->type) }}] {{ $item->subject }}" disabled>
                                       </div>
                                       <div class="mb-3">
                                          <label class="form-label">User's Message</label>
                                          <textarea class="form-control" rows="3" disabled>{{ $item->comment }}</textarea>
                                       </div>
                                       <div class="mb-3">
                                          <label class="form-label">Status</label>
                                          <select name="status" class="form-select" required>
                                             <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                             <option value="reviewed" {{ $item->status == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                                             <option value="resolved" {{ $item->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                          </select>
                                       </div>
                                       <div class="mb-3">
                                          <label class="form-label">Admin Reply Notes</label>
                                          <textarea name="admin_reply" class="form-control" rows="4" placeholder="Write your reply or notes here...">{{ $item->admin_reply }}</textarea>
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
