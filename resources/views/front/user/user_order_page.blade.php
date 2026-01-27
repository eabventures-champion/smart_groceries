@extends('front.master')
{{-- @extends('dashboard')  --}}
@section('content')
@section('title')
 My Orders
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

{{-- <div class="page-header breadcrumb-wrap">
   <div class="container">
      <div class="breadcrumb">
         <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
      </div>
   </div>
</div> --}}
<div class="page-content pt-50 pb-50 account-mobile-padding">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 m-auto">
            <div class="row">
               @include('front.user.dashboard_sidebar_menu')
               <div class="col-md-9">
                  <div class="tab-content account dashboard-content">
                     <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                        <div class="card">
                           <div class="card-header text-center-dashboard">
                              <h3 class="mb-0">Your Orders<span><i class="fi fi-rs-order-history pl-15"></i></span></h3>
                           </div>
                           <div class="card-body">
                              <div class="table-responsive">
                                 <table id="example" class="table table-striped table-bordered" style="background:#dddddd57; font-weight: 600; width:100%;">
                                    {{-- <table id="example" class="table table-striped table-bordered" style="width:100%"> --}}
                                    <thead>
                                       <tr>
                                          <th>S/N</th>
                                          <th>Date</th>
                                          <th>Total</th>
                                          {{-- <th>Payment</th> --}}
                                          <th>Invoice</th>
                                          <th>Status</th>
                                          <th>Time</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($orders as $key=> $order)
                                       <tr>
                                          <td>{{ $key+1 }}</td>
                                          <td> {{ $order->order_date }}</td>
                                          <td> Gh {{ number_format($order->amount, 2) }}</td>
                                          {{-- <td> {{ $order->payment_method }}</td> --}}
                                          <td> {{ $order->invoice_no }}</td>
                                          <td>
                                             @if($order->status == 'pending')
                                             <span class="badge rounded-pill bg-warning">Pending</span>
                                             @elseif($order->status == 'confirmed')
                                             <span class="badge rounded-pill bg-info">Confirmed</span>
                                             @elseif($order->status == 'processing')
                                             <span class="badge rounded-pill bg-dark">Processing</span>
                                             @elseif($order->status == 'delivered')
                                             <span class="badge rounded-pill bg-success">Delivered</span>
                                                @if($order->return_order == 1)
                                                <span class="badge rounded-pill bg-warning">but with issues</span>
                                                   @elseif($order->return_order == 2)
                                                   <span class="badge rounded-pill " style="background:blue;">Issue resolved</span>
                                                   @elseif($order->return_order == 3)
                                                   <span class="badge rounded-pill " style="background: red;">Return request not granted</span>
                                                @endif
                                             @endif
                                          </td>
                                          <td>
                                             @if($order->status == 'pending')
                                                {{ ($order->created_at)->diffForHumans() }}
                                                @elseif($order->status == 'confirmed')
                                                {{ Carbon\Carbon::parse($order->confirmed_date)->diffForHumans() }}
                                                @elseif($order->status == 'processing')
                                                {{ Carbon\Carbon::parse($order->processing_date)->diffForHumans() }}
                                                @else
                                                {{ Carbon\Carbon::parse($order->delivered_date)->diffForHumans() }}
                                             @endif
                                          </td>
                                          <td>
                                             <a title="view" href="{{ url('user/order_details/'.$order->id) }} " class="btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                             <a title="download" href="{{ url('user/invoice_download/'.$order->id) }}" class="btn-sm btn-danger"><i class="fa fa-download"></i></a>
                                             {{-- <div class="row">
                                                <div class="col mx-0 my-2">
                                                   <a title="view" href="{{ url('user/order_details/'.$order->id) }} " class="btn-sm btn-success mr-2"><i class="fa fa-eye"></i></a>
                                                </div>
                                                <div class="col mx-0 my-2">
                                                   <a title="download" href="{{ url('user/invoice_download/'.$order->id) }}" class="btn-sm btn-danger"><i class="fa fa-download"></i></a>
                                                </div>
                                             </div> --}}
                                          </td>
                                       </tr>
                                       @endforeach
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
