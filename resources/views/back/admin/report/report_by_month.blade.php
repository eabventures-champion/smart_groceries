@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      {{-- <div class="breadcrumb-title pe-3">All Order By Month Report</div> --}}
      <div class="ps-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
               <li class="breadcrumb-item"><a href="javascript:history.back();"><i class="bx bx-home-alt">&nbsp;Back</i></a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">All Order By Month Report</li>
            </ol>
         </nav>
      </div>
      <div class="ms-auto">
         <div class="btn-group">
         </div>
      </div>
   </div>
   <!--end breadcrumb-->
   <h5> Seach By Month - Year  : {{ $month }} - {{ $year }}</h5>
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
                     {{-- <th>Payment </th> --}}
                     <th>Stateus </th>
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
                     {{-- <td>{{ $item->payment_method }}</td> --}}
                     <td> <span class="badge rounded-pill bg-success"> {{ $item->status }}</span></td>
                     <td>
                        <a href="{{ route('admin.order.details',$item->id) }}" class="btn btn-info" title="Details"><i class="fa fa-eye"></i> </a>
                        <a href="{{ route('admin.invoice.download',$item->id) }}" class="btn btn-danger" title="Invoice Pdf"><i class="fa fa-download"></i> </a>
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