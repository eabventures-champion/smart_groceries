@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      {{-- <div class="breadcrumb-title pe-3">Admin Order Details</div> --}}
      <div class="ps-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
               <li class="breadcrumb-item"><a href="javascript:history.back()"><i class="bx bx-home-alt">&nbsp;Back</i></a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">Admin Order Details</li>
            </ol>
         </nav>
      </div>
   </div>
   <!--end breadcrumb-->
   <hr/>
   <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2">
      <div class="col">
         <div class="card">
            <div class="card-header">
               <h4>Delivery Details</h4>
            </div>
            {{-- <hr> --}}
            <div class="card-body">
               <table class="table" style="background:#F4F6FA;font-weight: 600;">
                  <tr>
                     <th>Delivery Name:</th>
                     <th>{{ $order->name }}</th>
                  </tr>
                  <tr>
                     <th>Delivery Phone:</th>
                     <th>{{ $order->phone }}</th>
                  </tr>
                  <tr>
                     <th>Delivery Email:</th>
                     <th>{{ $order->email }}</th>
                  </tr>
                  <tr>
                     <th>Delivery Address:</th>
                     <th>{{ $order->adress }}</th>
                  </tr>
                  <tr>
                     <th>Region:</th>
                     <th>{{ $order->region->region_name }}</th>
                  </tr>
                  <tr>
                     <th>Institution:</th>
                     <th>{{ $order->district->district_name }}</th>
                  </tr>
                  <tr>
                     <th>Hall :</th>
                     <th>{{ $order->city->city }}</th>
                  </tr>
                  {{-- <tr>
                     <th>Post Code  :</th>
                     <th>{{ $order->post_code }}</th>
                  </tr> --}}
                  <tr>
                     <th>Order Date   :</th>
                     <th>{{ $order->order_date }}</th>
                  </tr>
                  <tr>
                     <th>Delivery Notes:</th>
                     @if($order->notes == NULL)
                     <th>None</th>
                     @else
                     <th>{{ $order->notes }}</th>
                     @endif
                  </tr>
               </table>
            </div>
         </div>
      </div>
      <div class="col">
         <div class="card">
            <div class="card-header">
               <h4>Order Details
                  <span class="text-danger">Invoice : {{ $order->invoice_no }} </span>
               </h4>
            </div>
            {{-- <hr> --}}
            <div class="card-body">
               <table class="table" style="background:#F4F6FA;font-weight: 600;">
                  <tr>
                     <th> Name :</th>
                     <th>{{ $order->user->name }}</th>
                  </tr>
                  <tr>
                     <th>Phone :</th>
                     <th>{{ $order->user->phone }}</th>
                  </tr>
                  {{-- <tr>
                     <th>Payment Type:</th>
                     <th>{{ $order->payment_method }}</th>
                  </tr> --}}
                  <tr>
                     <th>Transx ID:</th>
                     <th>{{ $order->transaction_id }}</th>
                  </tr>
                  {{-- <tr>
                     <th>Invoice:</th>
                     <th class="text-danger">{{ $order->invoice_no }}</th>
                  </tr> --}}
                  <tr>
                     <th>Order Amonut:</th>
                     <th>Gh {{ number_format($order->amount, 2) }}</th>
                  </tr>
                  <tr>
                     <th>Order Status:</th>
                     <th>
                        @if($order->status == 'pending')
                        <span class="badge bg-warning text-dark" style="font-size: 15px;">{{ $order->status }}</span>
                        @elseif($order->status == 'confirmed')
                        <span class="badge bg-info text-dark" style="font-size: 15px;">{{ $order->status }}</span>
                        @elseif($order->status == 'processing')
                        <span class="badge bg-primary" style="font-size: 15px;">{{ $order->status }}</span>
                        @elseif($order->status == 'delivering')
                        <span class="badge bg-info text-dark" style="font-size: 15px; text-transform: capitalize;">Out for Delivery</span>
                        @else
                        <span class="badge bg-success" style="font-size: 15px;">{{ $order->status }}</span>
                        @endif
                        
                        @if($order->return_order == 1)
                        <span class="badge bg-danger">but with issues</span>
                        @endif
                     </th>
                  </tr>
                  <tr>
                     <th> </th>
                     <th>
                        @if($order->status == 'pending')
                        <a href="{{ route('pending-confirm',$order->id) }}" class="btn btn-sm btn-block btn-success" id="confirm" >Confirm Order</a>
                        @elseif($order->status == 'confirmed')
                        <a href="{{ route('confirm-processing',$order->id) }}" class="btn btn-sm btn-block btn-success" id="processing" >Processing Order</a>
                        @elseif($order->status == 'processing')
                        <a href="{{ route('processing-delivered',$order->id) }}" class="btn btn-sm btn-block btn-success" id="delivered" >Initiate Delivery</a>
                        @elseif($order->status == 'delivering')
                        <button class="btn btn-sm btn-block btn-secondary" disabled>Awaiting Customer Confirmation</button>
                        @endif
                    </th>
                  </tr>
               </table>
            </div>
         </div>
      </div>
   </div>
   <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-1">
      <div class="col">
         <div class="card">
            <div class="table-responsive">
               <table class="table" style="font-weight: 600;"  >
                  <tbody>
                     <tr>
                        <td class="col-md-1">
                           <label>Image </label>
                        </td>
                        <td class="col-md-2">
                           <label>Name </label>
                        </td>
                        <td class="col-md-2">
                           <label>Vendor Name </label>
                        </td>
                        <td class="col-md-2">
                           <label>Product Code  </label>
                        </td>
                        <td class="col-md-1">
                           <label>Variant </label>
                        </td>
                        <td class="col-md-1">
                           <label>Size </label>
                        </td>
                        <td class="col-md-1">
                           <label>Quantity </label>
                        </td>
                        <td class="col-md-3">
                           <label>Price  </label>
                        </td>
                     </tr>
                     @foreach($orderItem as $item)
                     <tr>
                        <td class="col-md-1">
                           <label><img src="{{ asset($item->product->product_thumbnail) }}" style="width:50px; height:50px;" > </label>
                        </td>
                        <td class="col-md-2">
                           <label>{{ $item->product->product_name }}</label>
                        </td>
                        @if($item->vendor_id == NULL)
                        <td class="col-md-2">
                           <label>Owner </label>
                        </td>
                        @else
                        <td class="col-md-2">
                           <label>{{ $item->product->vendor->name }} </label>
                        </td>
                        @endif
                        <td class="col-md-2">
                           <label>{{ $item->product->product_code }} </label>
                        </td>
                        @if($item->color == NULL)
                        <td class="col-md-1">
                           <label>.... </label>
                        </td>
                        @else
                        <td class="col-md-1">
                           <label>{{ $item->color }} </label>
                        </td>
                        @endif
                        @if($item->size == NULL)
                        <td class="col-md-1">
                           <label>.... </label>
                        </td>
                        @else
                        <td class="col-md-1">
                           <label>{{ $item->size }} </label>
                        </td>
                        @endif
                        <td class="col-md-1">
                           <label>{{ $item->qty }} </label>
                        </td>
                        <td class="col-md-3">
                           <label>Gh {{ number_format($item->price, 2) }} <br> Total = Gh {{ number_format($item->price * $item->qty, 2) }}   </label>
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
@endsection
