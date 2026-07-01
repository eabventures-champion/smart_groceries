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
                              <div class="table-responsive d-none d-md-block">
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

                              <!-- Mobile View Cards -->
                              <div class="d-block d-md-none">
                                  @foreach($orders as $key=> $order)
                                  <div class="card mb-3" style="border: 1px solid #ececec; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); overflow: hidden; background: #fff; margin-bottom: 20px !important;">
                                      <div class="card-header d-flex justify-content-between align-items-center" style="background: #f8f9fa; padding: 12px 15px; border-bottom: 1px solid #ececec;">
                                          <span style="font-weight: 700; color: #253D4E; font-size: 14px;">Order #{{ $order->invoice_no }}</span>
                                          <span style="font-size: 11px; color: #7e7e7e; font-weight: 500;">
                                              @if($order->status == 'pending')
                                                 {{ ($order->created_at)->diffForHumans() }}
                                                 @elseif($order->status == 'confirmed')
                                                 {{ Carbon\Carbon::parse($order->confirmed_date)->diffForHumans() }}
                                                 @elseif($order->status == 'processing')
                                                 {{ Carbon\Carbon::parse($order->processing_date)->diffForHumans() }}
                                                 @else
                                                 {{ Carbon\Carbon::parse($order->delivered_date)->diffForHumans() }}
                                              @endif
                                          </span>
                                      </div>
                                      <div class="card-body" style="padding: 15px;">
                                          <div class="d-flex justify-content-between mb-2">
                                              <span style="color: #7e7e7e; font-size: 13px;">Date:</span>
                                              <span style="color: #253D4E; font-weight: 600; font-size: 13px;">{{ $order->order_date }}</span>
                                          </div>
                                          <div class="d-flex justify-content-between mb-2">
                                              <span style="color: #7e7e7e; font-size: 13px;">Total Amount:</span>
                                              <span style="color: #7B2828; font-weight: 700; font-size: 14px;">Gh {{ number_format($order->amount, 2) }}</span>
                                          </div>
                                          <div class="d-flex justify-content-between mb-3 align-items-center">
                                              <span style="color: #7e7e7e; font-size: 13px;">Status:</span>
                                              <div>
                                                 @if($order->status == 'pending')
                                                 <span class="badge rounded-pill bg-warning" style="font-size: 11px; padding: 4px 10px; color: #fff;">Pending</span>
                                                 @elseif($order->status == 'confirmed')
                                                 <span class="badge rounded-pill bg-info" style="font-size: 11px; padding: 4px 10px; color: #fff;">Confirmed</span>
                                                 @elseif($order->status == 'processing')
                                                 <span class="badge rounded-pill bg-dark" style="font-size: 11px; padding: 4px 10px; color: #fff;">Processing</span>
                                                 @elseif($order->status == 'delivered')
                                                 <span class="badge rounded-pill bg-success" style="font-size: 11px; padding: 4px 10px; color: #fff;">Delivered</span>
                                                    @if($order->return_order == 1)
                                                    <span class="badge rounded-pill bg-warning" style="font-size: 11px; padding: 4px 10px; color: #fff; margin-left: 2px;">with issues</span>
                                                    @elseif($order->return_order == 2)
                                                    <span class="badge rounded-pill" style="background:blue; font-size: 11px; padding: 4px 10px; color: #fff; margin-left: 2px;">Issue resolved</span>
                                                    @elseif($order->return_order == 3)
                                                    <span class="badge rounded-pill" style="background: red; font-size: 11px; padding: 4px 10px; color: #fff; margin-left: 2px;">Return request denied</span>
                                                    @endif
                                                 @endif
                                              </div>
                                          </div>
                                          <hr style="margin: 12px 0; border-color: #f1f1f1;">
                                          <div class="d-flex justify-content-between" style="gap: 10px;">
                                              <a href="{{ url('user/order_details/'.$order->id) }}" class="btn btn-sm" style="flex: 1; padding: 8px 12px; font-size: 12px; border-radius: 8px; background-color: #27ae60; border: none; color: #fff; text-align: center; display: inline-block;">
                                                  <i class="fa fa-eye mr-5"></i> View Details
                                              </a>
                                              <a href="{{ url('user/invoice_download/'.$order->id) }}" class="btn btn-sm" style="flex: 1; padding: 8px 12px; font-size: 12px; border-radius: 8px; background-color: #e74c3c; border: none; color: #fff; text-align: center; display: inline-block;">
                                                  <i class="fa fa-download mr-5"></i> Invoice
                                              </a>
                                          </div>
                                      </div>
                                  </div>
                                  @endforeach
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
