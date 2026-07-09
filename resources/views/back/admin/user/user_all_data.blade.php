@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">All User Data <span class="badge bg-success ms-2" style="font-size: 13px;">{{ count($users) }}</span></div>
      {{-- <div class="ps-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
               <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">All User Data</li>
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
                        <a href="{{ route('admin.client.detail', $item->id) }}" class="btn btn-sm btn-primary" style="background-color: #3bb77e; border-color: #3bb77e; color: white;">
                           <i class="fa fa-eye"></i> View Detail
                        </a>
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