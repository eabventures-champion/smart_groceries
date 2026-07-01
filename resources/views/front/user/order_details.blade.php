@extends('front.master')
{{-- @extends('dashboard')  --}}
@section('content')
@section('title')
 My Orders - Details
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<style>
/* ── Premium Order Details Styles ── */
.od-page { padding: 30px 0 50px; }

.od-section-title {
   font-size: 16px; font-weight: 700; color: #253D4E;
   margin-bottom: 15px; display: flex; align-items: center; gap: 8px;
}
.od-section-title i { color: #3BB77E; font-size: 18px; }

.od-card {
   background: #fff; border: 1px solid #ececec; border-radius: 14px;
   box-shadow: 0 2px 12px rgba(0,0,0,0.04); overflow: hidden; margin-bottom: 20px;
}
.od-card-header {
   background: linear-gradient(135deg, #f8f9fa 0%, #f0f2f5 100%);
   padding: 14px 18px; border-bottom: 1px solid #ececec;
   display: flex; align-items: center; justify-content: space-between;
}
.od-card-header h4 {
   font-size: 15px; font-weight: 700; color: #253D4E; margin: 0;
}
.od-card-header .od-invoice {
   font-size: 12px; font-weight: 700; color: #7B2828;
   background: #fdeaea; padding: 4px 10px; border-radius: 20px;
}
.od-card-body { padding: 0; }

.od-info-row {
   display: flex; align-items: center; justify-content: space-between;
   padding: 12px 18px; border-bottom: 1px solid #f3f3f3;
   font-size: 13px;
}
.od-info-row:last-child { border-bottom: none; }
.od-info-row .od-label {
   color: #7e7e7e; font-weight: 600; min-width: 120px; flex-shrink: 0;
}
.od-info-row .od-value {
   color: #253D4E; font-weight: 700; text-align: right; word-break: break-word;
}
.od-info-row .od-value.od-price { color: #7B2828; font-size: 15px; }

.od-status-badge {
   display: inline-block; padding: 4px 14px; border-radius: 20px;
   font-size: 12px; font-weight: 700; text-transform: capitalize;
}
.od-status-pending { background: #fff3cd; color: #856404; }
.od-status-confirmed { background: #d1ecf1; color: #0c5460; }
.od-status-processing { background: #cce5ff; color: #004085; }
.od-status-delivered { background: #d4edda; color: #155724; }
.od-status-issue { background: #f8d7da; color: #721c24; margin-left: 6px; }

/* ── Desktop Product Table ── */
.od-product-table { display: block; }
.od-product-table table { font-weight: 600; }
.od-product-table table thead th {
   background: #f8f9fa; color: #253D4E; font-size: 13px;
   font-weight: 700; padding: 12px 10px; border-bottom: 2px solid #ececec;
}
.od-product-table table tbody td {
   padding: 12px 10px; vertical-align: middle; font-size: 13px; color: #555;
}
.od-product-table table tbody img {
   width: 50px; height: 50px; object-fit: cover; border-radius: 8px;
   border: 1px solid #ececec;
}

/* ── Mobile Product Cards ── */
.od-mobile-items { display: none; }

.od-item-card {
   display: flex; align-items: flex-start; gap: 12px;
   background: #fff; border: 1px solid #ececec; border-radius: 12px;
   padding: 14px; margin-bottom: 12px; box-shadow: 0 1px 6px rgba(0,0,0,0.03);
}
.od-item-img {
   width: 60px; height: 60px; border-radius: 10px; object-fit: cover;
   border: 1px solid #ececec; flex-shrink: 0;
}
.od-item-info { flex: 1; min-width: 0; }
.od-item-name {
   font-size: 13px; font-weight: 700; color: #253D4E; margin-bottom: 4px;
   display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
   overflow: hidden; line-height: 1.3;
}
.od-item-meta {
   display: flex; flex-wrap: wrap; gap: 6px 14px;
   font-size: 11px; color: #999; font-weight: 600; margin-top: 4px;
}
.od-item-meta span { white-space: nowrap; }
.od-item-price-row {
   display: flex; align-items: center; justify-content: space-between;
   margin-top: 6px;
}
.od-item-unit { font-size: 12px; color: #7e7e7e; font-weight: 600; }
.od-item-total { font-size: 14px; color: #7B2828; font-weight: 700; }

/* ── Return Form ── */
.od-return-section {
   max-width: 500px; margin: 30px auto 50px; text-align: center;
}
.od-return-section textarea {
   width: 100%; border-radius: 10px; border: 1px solid #ddd;
   padding: 12px; font-size: 13px; resize: vertical; min-height: 80px;
}
.od-return-section .od-return-btn {
   display: inline-block; margin-top: 12px; padding: 10px 30px;
   background: #dc3545; color: #fff; border: none; border-radius: 8px;
   font-weight: 700; font-size: 14px; cursor: pointer; width: 100%;
}
.od-return-section .od-return-btn:hover { background: #c82333; }
.od-return-msg { color: red; font-weight: 600; font-size: 14px; margin: 30px 0 50px; }

/* ── Mobile Overrides ── */
@media (max-width: 767px) {
   .od-page { padding: 15px 0 40px; }
   .od-product-table { display: none !important; }
   .od-mobile-items { display: block !important; }
   .od-info-row { padding: 10px 14px; font-size: 12px; }
   .od-info-row .od-label { min-width: 100px; }
   .od-card-header { padding: 12px 14px; }
   .od-card-header h4 { font-size: 14px; }
   .od-return-section { margin: 20px 15px 40px; }
}
</style>

<div class="od-page">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 m-auto">
            <div class="row">
               <!-- // Start Col md 3 menu -->
               @include('front.user.dashboard_sidebar_menu')
               <!-- // End Col md 3 menu -->
               <!-- // Start Col md 9  -->
               <div class="col-md-9">
                  <div class="row">
                     <!-- ── Delivery Details Card ── -->
                     <div class="col-md-6">
                        <div class="od-card">
                           <div class="od-card-header">
                              <h4><i class="fa fa-truck" style="color:#3BB77E; margin-right:6px;"></i> Delivery Details</h4>
                           </div>
                           <div class="od-card-body">
                              <div class="od-info-row">
                                 <span class="od-label">Name</span>
                                 <span class="od-value">{{ $order->name }}</span>
                              </div>
                              <div class="od-info-row">
                                 <span class="od-label">Phone</span>
                                 <span class="od-value">{{ $order->phone }}</span>
                              </div>
                              <div class="od-info-row">
                                 <span class="od-label">Email</span>
                                 <span class="od-value">{{ $order->email }}</span>
                              </div>
                              <div class="od-info-row">
                                 <span class="od-label">Address</span>
                                 <span class="od-value">{{ $order->adress }}</span>
                              </div>
                              <div class="od-info-row">
                                 <span class="od-label">Region</span>
                                 <span class="od-value">{{ $order->region->region_name }}</span>
                              </div>
                              <div class="od-info-row">
                                 <span class="od-label">Institution</span>
                                 <span class="od-value">{{ $order->district->district_name }}</span>
                              </div>
                              <div class="od-info-row">
                                 <span class="od-label">Hall</span>
                                 <span class="od-value">{{ $order->city->city }}</span>
                              </div>
                              <div class="od-info-row">
                                 <span class="od-label">Order Date</span>
                                 <span class="od-value">{{ $order->order_date }}</span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- // End Delivery Details -->

                     <!-- ── Order Summary Card ── -->
                     <div class="col-md-6">
                        <div class="od-card">
                           <div class="od-card-header">
                              <h4><i class="fa fa-receipt" style="color:#3BB77E; margin-right:6px;"></i> Order Summary</h4>
                              <span class="od-invoice">#{{ $order->invoice_no }}</span>
                           </div>
                           <div class="od-card-body">
                              <div class="od-info-row">
                                 <span class="od-label">Customer</span>
                                 <span class="od-value">{{ $order->user->name }}</span>
                              </div>
                              <div class="od-info-row">
                                 <span class="od-label">Phone</span>
                                 <span class="od-value">{{ $order->user->phone }}</span>
                              </div>
                              <div class="od-info-row">
                                 <span class="od-label">Transaction ID</span>
                                 <span class="od-value">{{ $order->transaction_id }}</span>
                              </div>
                              <div class="od-info-row">
                                 <span class="od-label">Amount</span>
                                 <span class="od-value od-price">Gh {{ number_format($order->amount, 2) }}</span>
                              </div>
                              <div class="od-info-row">
                                 <span class="od-label">Status</span>
                                 <span class="od-value">
                                    @php
                                       $statusClass = 'od-status-pending';
                                       if($order->status == 'confirmed') $statusClass = 'od-status-confirmed';
                                       elseif($order->status == 'processing') $statusClass = 'od-status-processing';
                                       elseif($order->status == 'delivered') $statusClass = 'od-status-delivered';
                                    @endphp
                                    <span class="od-status-badge {{ $statusClass }}">{{ $order->status }}</span>
                                    @if($order->return_order == 1)
                                       <span class="od-status-badge od-status-issue">Return Requested</span>
                                    @endif
                                 </span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- // End Order Summary -->
                  </div>
                  <!-- // End Row  -->
               </div>
               <!-- // End Col md 9  -->
            </div>
         </div>
      </div>
   </div>

   <!-- ── Order Items Section ── -->
   <div class="container" style="margin-top: 10px;">
      <div class="row">
         <div class="col-md-12">
            <div class="od-section-title">
               <i class="fa fa-box-open"></i> Ordered Items ({{ count($orderItem) }})
            </div>

            <!-- Desktop Table -->
            <div class="od-product-table">
               <div class="od-card">
                  <div class="table-responsive">
                     <table class="table mb-0">
                        <thead>
                           <tr>
                              <th>Image</th>
                              <th>Name</th>
                              <th>Vendor</th>
                              <th>Code</th>
                              <th>Variant</th>
                              <th>Size</th>
                              <th>Qty</th>
                              <th>Price</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($orderItem as $item)
                           <tr>
                              <td><img src="{{ asset($item->product->product_thumbnail) }}" alt=""></td>
                              <td>{{ $item->product->product_name }}</td>
                              <td>{{ $item->vendor_id == NULL ? 'Owner' : $item->product->vendor->name }}</td>
                              <td>{{ $item->product->product_code }}</td>
                              <td>{{ $item->color ?? '—' }}</td>
                              <td>{{ $item->size ?? '—' }}</td>
                              <td>{{ $item->qty }}</td>
                              <td>
                                 Gh {{ number_format($item->price, 2) }}<br>
                                 <small style="color:#7B2828;">Total: Gh {{ number_format($item->price * $item->qty, 2) }}</small>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>

            <!-- Mobile Item Cards -->
            <div class="od-mobile-items">
               @foreach($orderItem as $item)
               <div class="od-item-card">
                  <img src="{{ asset($item->product->product_thumbnail) }}" class="od-item-img" alt="">
                  <div class="od-item-info">
                     <div class="od-item-name">{{ $item->product->product_name }}</div>
                     <div class="od-item-meta">
                        <span>Qty: {{ $item->qty }}</span>
                        @if($item->color)<span>Variant: {{ $item->color }}</span>@endif
                        @if($item->size)<span>Size: {{ $item->size }}</span>@endif
                        <span>{{ $item->vendor_id == NULL ? 'Owner' : $item->product->vendor->name }}</span>
                     </div>
                     <div class="od-item-price-row">
                        <span class="od-item-unit">Gh {{ number_format($item->price, 2) }} ea.</span>
                        <span class="od-item-total">Gh {{ number_format($item->price * $item->qty, 2) }}</span>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>
         </div>

         <!--  // Start Return Order Option  -->
         @if($order->status !== 'delivered')
         @else
            @php
            $order = App\Models\Order::where('id',$order->id)->where('return_reason', '=', NULL)->first();
            @endphp

            @if($order)
            <div class="col-md-12">
               <div class="od-return-section">
                  <form action="{{ route('return.order',$order->id) }}" method="post">
                     @csrf
                     <div class="form-group" style="text-align:left; margin-bottom: 10px;">
                        <label style="font-weight:700; color:#253D4E; font-size:14px; margin-bottom:8px; display:block;">
                           <i class="fa fa-undo" style="color:#dc3545; margin-right:5px;"></i> Order Return Reason
                           <br><small style="color:#999; font-weight:500;">(Specify items to return)</small>
                        </label>
                        <textarea name="return_reason" class="form-control" placeholder="Describe which items you'd like to return and why..."></textarea>
                     </div>
                     <button type="submit" class="od-return-btn">
                        <i class="fa fa-undo mr-5"></i> Submit Return Request
                     </button>
                  </form>
               </div>
            </div>
            @else
            <div class="col-md-12 text-center">
               <p class="od-return-msg"><i class="fa fa-info-circle mr-5"></i> You have sent a return request for this order</p>
            </div>
            @endif
         @endif
         <!--  // End Return Order Option  -->
      </div>
   </div>
</div>
@endsection
