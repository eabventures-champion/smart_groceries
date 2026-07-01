@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">All Queued Orders</div>
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
                     <th>Date </th>
                     <th>Invoice </th>
                     <th>Amount </th>
                     <th>Estimated Delivery</th>
                     <th>Proximity</th>
                     <th>Status </th>
                     <th>Time </th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($orders as $key => $item)		
                  <tr>
                     <td> {{ $key+1 }} </td>
                     <td>{{ $item->order_date }}</td>
                     <td>{{ $item->invoice_no }}</td>
                     <td>Gh {{ number_format($item->amount, 2) }}</td>
                     <td class="text-primary fw-bold">
                        {{ $item->estimated_delivery_date ? \Carbon\Carbon::parse($item->estimated_delivery_date)->format('l, d F Y') : 'N/A' }}
                     </td>
                     <td>
                        @if($item->delivery_proximity !== null)
                           {{ $item->delivery_proximity }} days
                        @else
                           N/A
                        @endif
                     </td>
                     <td> <span class="badge rounded-pill bg-danger"> {{ $item->status }}</span></td>
                     <td>{{ ($item->created_at)->diffForHumans() }}</td>
                     <td>
                        <a href="{{ route('admin.order.details',$item->id) }}" class="btn btn-sm btn-info" title="Details"><i class="fa fa-eye"></i> </a>
                        <a href="{{ route('admin.queued-confirm', $item->id) }}" class="btn btn-sm btn-success" title="Approve & Confirm" onclick="return confirm('Are you sure you want to approve this queued order?');"><i class="fa fa-check"></i> </a>
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
