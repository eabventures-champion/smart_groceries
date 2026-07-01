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
      <div class="breadcrumb-title pe-3">All Products <span class="badge rounded-pill bg-danger"> {{ count($products) }} </span></div>
      {{-- <div class="ps-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
               <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">All Product <span class="badge rounded-pill bg-danger"> {{ count($products) }} </span></li>
            </ol>
         </nav>
      </div> --}}
      <div class="ms-auto">
         <div class="btn-group">
             <a href="{{ route('download.all.product.images') }}" class="btn btn-success" title="Download all product images as ZIP"><i class="fa fa-download"></i> Backup Images</a>
             <a href="{{ route('add.product') }}" class="btn btn-primary">Add Product</a> 				 
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
                     <th>Image </th>
                     <th>Name </th>
                     {{-- <th>Category </th> --}}
                     <th>Price </th>
                     {{-- <th>QTY </th> --}}
                     <th>Total stock </th>
                     <th>Status </th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($products as $key => $item)		
                  <tr>
                     <td> {{ $key+1 }} </td>
                     <td> <img src="{{ asset($item->product_thumbnail) }}" style="width: 70px; height:40px;" >  </td>
                     <td>
                        {{ $item->product_name }} <br> 
                        <span class="badge rounded-pill bg-primary">{{ $item->category?->category_name ?? 'N/A' }}</span>
                     </td>
                     {{-- <td>{{ $item->category->category_name }}</td> --}}
                     <td>
                        Gh {{ number_format($item->selling_price, 2) }} <br>
                        @if($item->discount_price == NULL)
                           <span class="badge rounded-pill bg-info">No Discount</span>
                           @else
                           {{-- @php
                              $amount = $item->selling_price - $item->discount_price;
                              $discount = ($amount/$item->selling_price) * 100;
                           @endphp --}}
                           {{-- <span class="badge rounded-pill bg-danger"> {{ round($discount) }}% off</span> --}}
                           <span class="badge rounded-pill bg-danger"> {{ round($item->discount_price) }}% off</span>
                        @endif
                     </td>
                     {{-- <td>{{ $item->product_qty }}</td> --}}
                     <td>
                        @php
                           $total_stock = App\Models\ProductAttribute::where('product_id', $item->id)->sum('stock');
                        @endphp
                        {{ $total_stock }}
                        @if($total_stock <= 10)
                           <span class="badge bg-danger rounded-pill px-2 py-1 ms-1 low-stock-pulse" style="font-size: 10px; font-weight: 700;">
                              <i class="bx bx-error-circle"></i> Refill
                           </span>
                        @endif
                     </td>
                     <td> 
                        @if($item->status == 1)
                           <span class="badge rounded-pill bg-success">Active</span>
                           @else
                           <span class="badge rounded-pill bg-danger">InActive</span>
                        @endif

                        @if($item->status == 1)
                           <a href="{{ route('product.inactive',$item->id) }}" class="btn btn-sm btn-primary" title="Inactive"> <i class="fa-solid fa-thumbs-up"></i> </a>
                           @else
                           <a href="{{ route('product.active',$item->id) }}" class="btn btn-sm btn-primary" title="Active"> <i class="fa-solid fa-thumbs-down"></i> </a>
                        @endif
                     </td>
                     <td>
                         <a href="{{ route('add.product.attribute',$item->id) }}" class="btn btn-sm btn-info" title="Add product attributes"> <i class="fa fa-plus"></i> </a>
                         <a href="{{ route('edit.product',$item->id) }}" class="btn btn-sm btn-info" title="Edit Data"> <i class="fa fa-pencil"></i> </a>
                         <a href="{{ route('download.product.image',$item->id) }}" class="btn btn-sm btn-success" title="Download Image"> <i class="fa fa-download"></i> </a>
                         <a href="{{ route('delete.product',$item->id) }}" class="btn btn-sm btn-danger" id="delete" title="Delete Data" ><i class="fa fa-trash"></i></a>
                        {{-- <a href="{{ route('edit.category',$item->id) }}" class="btn btn-sm btn-warning" title="Details Page"> <i class="fa fa-eye"></i> </a> --}}

                        {{-- @if($item->status == 1)
                           <a href="{{ route('product.inactive',$item->id) }}" class="btn btn-sm btn-primary" title="Inactive"> <i class="fa-solid fa-thumbs-down"></i> </a>
                           @else
                           <a href="{{ route('product.active',$item->id) }}" class="btn btn-sm btn-primary" title="Active"> <i class="fa-solid fa-thumbs-up"></i> </a>
                        @endif --}}
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