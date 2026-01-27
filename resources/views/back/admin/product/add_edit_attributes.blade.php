@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="ps-3">
        <nav aria-label="breadcrumb">
           <ol class="breadcrumb mb-0 p-0">
              <li class="breadcrumb-item"><a href="{{ route('all.products') }}"><i class="bx bx-home-alt">&nbsp;Back</i></a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">Product Attributes</li>
           </ol>
        </nav>
     </div>
   </div>
   <!--end breadcrumb-->
   <hr/>
   <div class="card">
      <div class="card-body">
        <h6 class="card-title">Product details</h6>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" style="width:100%">
               <thead>
                  <tr>
                    <th>Product name</th>
                    <th>Product code</th>
                    <th>Product variant</th>
                    <th>Price</th>
                    <th>Image</th>
                  </tr>
               </thead>
               <tbody>
                <tr>
                    <td>{{ $product['product_name'] }}</td>
                    <td>{{ $product['product_code'] }}</td>
                    <td>{{ $product['product_color'] }}</td>
                    <td>{{ $product['selling_price'] }}</td>
                    <td><img src="{{ asset($product->product_thumbnail) }}" style="width: 70px; height:40px;" ></td>
                </tr>
               </tbody>
            </table>
        </div><br>

        <h6>Add Product attributes</h6>
        <form class="" action="{{ url('admin/add-edit-attributes/'.$product['id']) }}" method="post">
            @csrf
            <div class="form-group">
                <div class="field_wrapper">
                    <div>
                        <input type="text" name="size[]" placeholder="size" style="width: 120px;" required />
                        <input type="text" name="sku[]" placeholder="sku" style="width: 120px;" required />
                        <input type="text" name="price[]" placeholder="price" style="width: 120px;" required />
                        <input type="text" name="stock[]" placeholder="stock" style="width: 120px;" required />
                        <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                    </div>
                </div>
            </div><br>
            <button type="submit" class="btn btn-sm btn-primary mr-2">Submit</button>
            <button class="btn btn-sm btn-danger">Cancel</button>
        </form>

        <br><br><h6 class="card-title">Added Product Attributes</h6>
        <form method="post" action="{{ url('admin/edit-attribute/'.$product['id']) }}">
            @csrf
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            {{-- <th>ID</th> --}}
                            <th>Size</th>
                            <th>SKU</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach($product['attributes'] as $attribute)
                            <tr>
                                <input style="display: none;" type="text" name="attribute_id[]" value="{{ $attribute['id'] }}">
                                {{-- <td>{{ $attribute['id'] }}</td> --}}
                                <td>{{ $attribute['size'] }}</td>
                                <td>{{ $attribute['sku'] }}</td>
                                <td>
                                    <input type="number" name="price[]" value="{{ $attribute['price'] }}" required style="width: 80px;">
                                </td>
                                <td>
                                    <input type="number" name="stock[]" value="{{ $attribute['stock'] }}" required style="width: 80px;">
                                </td>
                                <td>
                                    @if($attribute->status == 1)
                                        <a href="{{ route('product.attribute.inactive', $attribute['id']) }}" class="btn btn-sm btn-primary" title="Inactive"> <i class="fa-solid fa-thumbs-up"></i> </a>
                                        @else
                                        <a href="{{ route('product.attribute.active', $attribute['id']) }}" class="btn btn-sm btn-primary" title="Active"> <i class="fa-solid fa-thumbs-down"></i> </a>
                                    @endif
                                    <a href="{{ route('delete.product.attribute', $attribute['id']) }}" class="btn btn-sm btn-danger" id="delete" title="Delete Data" ><i class="fa fa-trash"></i></a>
                                    {{-- @if($attribute['status'] == 1)
                                        <a class="update_attribute_status" id="attribute-{{ $attribute['id'] }}" attribute_id="{{ $attribute['id'] }}" href="javascript:void(0)"><i style="font-size: 25px;" class="fa-solid fa-thumbs-up" status="Active"></i></a>
                                        @else
                                        <a class="update_attribute_status" id="attribute-{{ $attribute['id'] }}" attribute_id="{{ $attribute['id'] }}" href="javascript:void(0)"><i style="font-size: 25px;" class="fa-solid fa-thumbs-down" status="InActive"></i></a>
                                    @endif
                                    &nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="confirm_delete btn btn-sm btn-danger" module="attribute" module_id="{{ $attribute['id'] }}"><i style="font-size: 15px;" class="fa fa-trash"></i></a> --}}
                                </td>
                            </tr>
                        @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-sm btn-primary">Update Attribute</button>
        </form>



      </div>
   </div>
</div>
@endsection
