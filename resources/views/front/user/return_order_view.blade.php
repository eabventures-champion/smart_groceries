@extends('front.master')
{{-- @extends('dashboard')  --}}
@section('content')
@section('title')
 Returned Orders
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="page-content pt-50 pb-50 account-mobile-padding">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 m-auto">
            <div class="row">
               <!-- // Start Col md 3 menu -->
               @include('front.user.dashboard_sidebar_menu')
               <!-- // End Col md 3 menu -->
               <div class="col-md-9">
                  <div class="tab-content account dashboard-content">
                     <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                        <div class="card">
                           <div class="card-header text-center-dashboard">
                              <h3 class="mb-0">Your Return Orders<span><i class="fi fi-rr-truck-arrow-left pl-15"></i></span></h3>
                           </div>
                           <div class="card-body">
                              <!-- Desktop Table -->
                              <div class="table-responsive d-none d-md-block">
                                 <table id="example" class="table table-striped table-bordered" style="background:#dddddd57;font-weight: 600;" >
                                    <thead>
                                       <tr>
                                          <th>S/N</th>
                                          <th>Date</th>
                                          <th>Total</th>
                                          <th>Invoice</th>
                                          <th>Issue</th>
                                          <th>Status</th>
                                          <th>Time</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($orders as $key=> $order)
                                       <tr>
                                          <td>{{ $key+1 }}</td>
                                          <td> {{ $order->order_date }}</td>
                                          <td> Gh {{ number_format($order->amount, 2) }}</td>
                                          <td> {{ $order->invoice_no }}</td>
                                          <td> <span style="color:red;">{{ $order->return_reason }}</span></td>
                                          <td>
                                             @if($order->return_order == 3)
                                             <span class="badge rounded-pill" style="background:red;">Return request not granted</span>
                                             @elseif($order->return_order == 1)
                                             <span class="badge rounded-pill bg-warning">Pending</span>
                                             @elseif($order->return_order == 2)
                                             <span class="badge rounded-pill" style="background:blue;">Issue resolved</span>
                                             @endif
                                          </td>
                                          <td>{{ ($order->updated_at)->diffForHumans() }}</td>
                                       </tr>
                                       @endforeach
                                    </tbody>
                                 </table>
                              </div>

                              <!-- Mobile View Cards -->
                              <div class="d-block d-md-none">
                                  @if(count($orders) == 0)
                                  <div style="text-align: center; padding: 40px 20px;">
                                      <i class="fa fa-box-open" style="font-size: 40px; color: #ddd; margin-bottom: 12px;"></i>
                                      <p style="color: #999; font-weight: 600; font-size: 14px;">No return orders yet</p>
                                  </div>
                                  @endif

                                  @foreach($orders as $key=> $order)
                                  <div style="border: 1px solid #ececec; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); overflow: hidden; background: #fff; margin-bottom: 16px;">
                                      <!-- Card Header -->
                                      <div class="d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #f8f9fa 0%, #f0f2f5 100%); padding: 12px 15px; border-bottom: 1px solid #ececec;">
                                          <span style="font-weight: 700; color: #253D4E; font-size: 14px;">
                                              <i class="fa fa-undo" style="color: #dc3545; margin-right: 6px; font-size: 12px;"></i>#{{ $order->invoice_no }}
                                          </span>
                                          <span style="font-size: 11px; color: #7e7e7e; font-weight: 500;">
                                              {{ ($order->updated_at)->diffForHumans() }}
                                          </span>
                                      </div>

                                      <!-- Card Body -->
                                      <div style="padding: 15px;">
                                          <!-- Date -->
                                          <div class="d-flex justify-content-between mb-2">
                                              <span style="color: #7e7e7e; font-size: 13px; font-weight: 500;">Date:</span>
                                              <span style="color: #253D4E; font-weight: 600; font-size: 13px;">{{ $order->order_date }}</span>
                                          </div>
                                          <!-- Amount -->
                                          <div class="d-flex justify-content-between mb-2">
                                              <span style="color: #7e7e7e; font-size: 13px; font-weight: 500;">Total Amount:</span>
                                              <span style="color: #7B2828; font-weight: 700; font-size: 14px;">Gh {{ number_format($order->amount, 2) }}</span>
                                          </div>
                                          <!-- Return Status -->
                                          <div class="d-flex justify-content-between mb-2 align-items-center">
                                              <span style="color: #7e7e7e; font-size: 13px; font-weight: 500;">Return Status:</span>
                                              <div>
                                                 @if($order->return_order == 1)
                                                 <span class="badge rounded-pill bg-warning" style="font-size: 11px; padding: 4px 12px; color: #fff;">Pending</span>
                                                 @elseif($order->return_order == 2)
                                                 <span class="badge rounded-pill" style="background: #27ae60; font-size: 11px; padding: 4px 12px; color: #fff;">Resolved</span>
                                                 @elseif($order->return_order == 3)
                                                 <span class="badge rounded-pill" style="background: #dc3545; font-size: 11px; padding: 4px 12px; color: #fff;">Not Granted</span>
                                                 @endif
                                              </div>
                                          </div>

                                          <!-- Return Reason -->
                                          @if($order->return_reason)
                                          <div style="margin-top: 10px; background: #fff5f5; border: 1px solid #fde2e2; border-radius: 8px; padding: 10px 12px;">
                                              <div style="font-size: 11px; color: #7e7e7e; font-weight: 600; margin-bottom: 4px; text-transform: uppercase; letter-spacing: 0.5px;">
                                                  <i class="fa fa-exclamation-circle" style="color: #dc3545; margin-right: 4px;"></i>Return Reason
                                              </div>
                                              <div style="font-size: 12px; color: #555; font-weight: 600; line-height: 1.4;">
                                                  {{ $order->return_reason }}
                                              </div>
                                          </div>
                                          @endif
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
