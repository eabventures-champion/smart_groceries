@extends('back.admin.master')
@section('content')
<style>
   @keyframes lowStockPulse {
      0%, 100% { opacity: 1; transform: scale(1); }
      50% { opacity: 0.7; transform: scale(1.08); }
   }
   .low-stock-pulse {
      animation: lowStockPulse 1.5s ease-in-out infinite;
   }
</style>
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">All Product Stock <span class="badge rounded-pill bg-danger"> {{ count($products) }} </span></div>
      {{-- <div class="ps-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
               <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">All Product Stock <span class="badge rounded-pill bg-danger"> {{ count($products) }} </span> </li>
            </ol>
         </nav>
      </div> --}}
      <div class="ms-auto">
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
                     <th>Image </th>
                     <th>Name </th>
                     <th>Price </th>
                     <th>QTY </th>
                     <th>Discount </th>
                     <th>Status </th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($products as $key => $item)		
                  <tr>
                     <td> {{ $key+1 }} </td>
                     <td> <img src="{{ asset($item->product_thumbnail) }}" style="width: 70px; height:40px;" >  </td>
                     <td>{{ $item->product_name }}</td>
                     <td>{{ number_format($item->selling_price, 2) }}</td>
                     <td>
                        @php
                           $total_stock = App\Models\ProductAttribute::where('product_id', $item->id)->sum('stock');
                           $total_stock = $total_stock > 0 ? $total_stock : $item->product_qty;
                        @endphp
                        {{ $total_stock }}
                        @if($total_stock <= 10)
                           <span class="badge bg-danger rounded-pill px-2 py-1 ms-1 low-stock-pulse" style="font-size: 10px; font-weight: 700;">
                              <i class="bx bx-error-circle"></i> Refill
                           </span>
                        @endif
                     </td>
                     <td>
                        @if($item->discount_price == NULL)
                        <span class="badge rounded-pill bg-info">No Discount</span>
                        @else
                        @php
                        $amount = $item->selling_price - $item->discount_price;
                        $discount = ($amount/$item->selling_price) * 100;
                        @endphp
                        <span class="badge rounded-pill bg-danger"> {{ round($discount) }}%</span>
                        @endif
                     </td>
                     <td> @if($item->status == 1)
                        <span class="badge rounded-pill bg-success">Active</span>
                        @else
                        <span class="badge rounded-pill bg-danger">InActive</span>
                        @endif
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