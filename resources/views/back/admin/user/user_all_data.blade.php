@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">All Users <span class="badge bg-success ms-2" style="font-size: 13px;">{{ count($users) }}</span></div>
      {{-- <div class="ps-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
               <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">All Active Users</li>
            </ol>
         </nav>
      </div> --}}
      <div class="ms-auto">
         <div class="btn-group">
         </div>
      </div>
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
                     <th>Name </th>
                     <th>Email </th>
                     <th>Joined </th>
                     <th>Last seen </th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($users as $key => $item)		
                  <tr>
                     <td> {{ $key+1 }} </td>
                     <td> 
                        <a href="{{ route('admin.client.detail', $item->id) }}" style="font-weight: 600; color: #212529; text-decoration: none;" class="hover-primary">
                           {{ $item->name }} 
                        </a> 
                     </td>
                     <td> 
                        <div>{{ $item->email }}</div>
                        @if(!empty($item->phone))
                        <span class="badge bg-light text-secondary border mt-1" style="font-weight: 500; font-size: 11px;">{{ $item->phone }}</span>
                        @endif
                     <td> 
                        <div>{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('M d, Y h:i A') : 'N/A' }}</div>
                        @if($item->created_at)
                        <span class="badge badge-pill bg-success mt-1" style="font-weight: 500; font-size: 11px;">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                        @endif
                     </td>
                     <td>
                        @if($item->user_online())
                        <span class="badge badge-pill bg-success">Active Now </span>
                        @else
                        <span class="badge badge-pill bg-danger"> {{ $item->last_seen ? Carbon\Carbon::parse($item->last_seen)->diffForHumans() : 'Never' }} </span>
                        @endif
                     </td>
                     <td>
                        @if($item->status == 'active')
                           <span class="badge bg-success rounded-pill px-3 py-1" style="font-size: 11px;">
                              <i class="fa fa-check-circle me-1"></i>Active
                           </span>
                        @elseif($item->status == 'suspended')
                           <span class="badge bg-warning text-dark rounded-pill px-3 py-1" style="font-size: 11px;">
                              <i class="fa fa-pause-circle me-1"></i>Suspended
                           </span>
                        @elseif($item->status == 'disabled')
                           <span class="badge bg-danger rounded-pill px-3 py-1" style="font-size: 11px;">
                              <i class="fa fa-ban me-1"></i>Disabled
                           </span>
                        @else
                           <span class="badge bg-secondary rounded-pill px-3 py-1" style="font-size: 11px;">
                              <i class="fa fa-clock me-1"></i>Inactive
                           </span>
                        @endif
                     </td>
                     <td>
                        <div class="d-flex align-items-center gap-1">
                           <a href="{{ route('admin.client.detail', $item->id) }}" class="btn btn-sm btn-primary" style="background-color: #3bb77e; border-color: #3bb77e; color: white;">
                              <i class="fa fa-eye"></i> View Detail
                           </a>

                           @if($item->status == 'active')
                              {{-- Suspend Button --}}
                              <form action="{{ route('admin.client.suspend', $item->id) }}" method="POST" class="d-inline account-action-form" data-action="suspend" data-username="{{ $item->name }}">
                                 @csrf
                                 <button type="submit" class="btn btn-sm btn-warning" title="Suspend Account">
                                    <i class="fa fa-pause-circle"></i>
                                 </button>
                              </form>
                              {{-- Disable Button --}}
                              <form action="{{ route('admin.client.disable', $item->id) }}" method="POST" class="d-inline account-action-form" data-action="disable" data-username="{{ $item->name }}">
                                 @csrf
                                 <button type="submit" class="btn btn-sm btn-danger" title="Disable Account">
                                    <i class="fa fa-ban"></i>
                                 </button>
                              </form>
                           @elseif($item->status == 'suspended')
                              {{-- Reactivate Button --}}
                              <form action="{{ route('admin.client.reactivate', $item->id) }}" method="POST" class="d-inline account-action-form" data-action="reactivate" data-username="{{ $item->name }}">
                                 @csrf
                                 <button type="submit" class="btn btn-sm btn-success" title="Reactivate Account">
                                    <i class="fa fa-check-circle"></i>
                                 </button>
                              </form>
                              {{-- Disable Button --}}
                              <form action="{{ route('admin.client.disable', $item->id) }}" method="POST" class="d-inline account-action-form" data-action="disable" data-username="{{ $item->name }}">
                                 @csrf
                                 <button type="submit" class="btn btn-sm btn-danger" title="Disable Account">
                                    <i class="fa fa-ban"></i>
                                 </button>
                              </form>
                           @elseif($item->status == 'disabled')
                              {{-- Reactivate Button --}}
                              <form action="{{ route('admin.client.reactivate', $item->id) }}" method="POST" class="d-inline account-action-form" data-action="reactivate" data-username="{{ $item->name }}">
                                 @csrf
                                 <button type="submit" class="btn btn-sm btn-success" title="Reactivate Account">
                                    <i class="fa fa-check-circle"></i>
                                 </button>
                              </form>
                           @endif
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

{{-- SweetAlert Confirmation for Account Actions --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
   document.querySelectorAll('.account-action-form').forEach(function(form) {
      form.addEventListener('submit', function(e) {
         e.preventDefault();
         var action = this.dataset.action;
         var username = this.dataset.username;
         var formEl = this;

         var config = {
            suspend: {
               title: 'Suspend Account?',
               text: 'Are you sure you want to suspend ' + username + '\'s account? They will be logged out and unable to access the platform.',
               icon: 'warning',
               confirmText: 'Yes, Suspend',
               confirmColor: '#ffc107'
            },
            disable: {
               title: 'Disable Account?',
               text: 'Are you sure you want to disable ' + username + '\'s account? This will permanently deactivate their access.',
               icon: 'error',
               confirmText: 'Yes, Disable',
               confirmColor: '#dc3545'
            },
            reactivate: {
               title: 'Reactivate Account?',
               text: 'Are you sure you want to reactivate ' + username + '\'s account? They will regain full access.',
               icon: 'question',
               confirmText: 'Yes, Reactivate',
               confirmColor: '#198754'
            }
         };

         var c = config[action];

         Swal.fire({
            title: c.title,
            text: c.text,
            icon: c.icon,
            showCancelButton: true,
            confirmButtonColor: c.confirmColor,
            cancelButtonColor: '#6c757d',
            confirmButtonText: c.confirmText,
            cancelButtonText: 'Cancel'
         }).then(function(result) {
            if (result.isConfirmed) {
               formEl.submit();
            }
         });
      });
   });
});
</script>
@endsection