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

        <br><br>
        <div class="d-flex align-items-center justify-content-between mb-2">
            <h6 class="card-title mb-0">Added Product Attributes</h6>
            <small class="text-muted"><i class="fa fa-info-circle me-1"></i> Drag rows using the <i class="fa-solid fa-grip-vertical text-dark"></i> handle to reorder.</small>
        </div>
        <form method="post" action="{{ url('admin/edit-attribute/'.$product['id']) }}">
            @csrf
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle" id="attributes-table" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width: 40px;" class="text-center"><i class="fa-solid fa-grip-vertical" title="Drag to reorder"></i></th>
                            <th>Size</th>
                            <th>SKU</th>
                            <th>Price (GH¢)</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product['attributes'] as $attribute)
                        <tr class="attribute-row" data-id="{{ $attribute['id'] }}" draggable="true" style="cursor: move;">
                            <input style="display: none;" type="text" name="attribute_id[]" value="{{ $attribute['id'] }}">
                            <td class="text-center bg-light">
                                <span class="drag-handle" style="cursor: grab; font-size: 18px; color: #6c757d;" title="Click & Drag to reorder">
                                    <i class="fa-solid fa-grip-vertical"></i>
                                </span>
                            </td>
                            <td>
                                <input type="text" name="size[]" value="{{ $attribute['size'] }}" required class="form-control form-control-sm" style="width: 130px;">
                            </td>
                            <td>
                                <input type="text" name="sku[]" value="{{ $attribute['sku'] }}" required class="form-control form-control-sm" style="width: 130px;">
                            </td>
                            <td>
                                <input type="number" step="0.01" name="price[]" value="{{ $attribute['price'] }}" required class="form-control form-control-sm" style="width: 90px;">
                            </td>
                            <td>
                                <input type="number" name="stock[]" value="{{ $attribute['stock'] }}" required class="form-control form-control-sm" style="width: 90px;">
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning text-dark me-1" data-bs-toggle="modal" data-bs-target="#editAttributeModal{{ $attribute['id'] }}" title="Edit Attribute">
                                    <i class="fa fa-pencil"></i> Edit
                                </button>
                                @if($attribute->status == 1)
                                    <a href="{{ route('product.attribute.inactive', $attribute['id']) }}" class="btn btn-sm btn-primary" title="Inactive"> <i class="fa-solid fa-thumbs-up"></i> </a>
                                @else
                                    <a href="{{ route('product.attribute.active', $attribute['id']) }}" class="btn btn-sm btn-secondary" title="Active"> <i class="fa-solid fa-thumbs-down"></i> </a>
                                @endif
                                <a href="{{ route('delete.product.attribute', $attribute['id']) }}" class="btn btn-sm btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-sm btn-primary mt-2">Update Attributes</button>
        </form>

        <!-- Edit Attribute Modals (Outside Main Bulk Form) -->
        @foreach($product['attributes'] as $attribute)
        <div class="modal fade" id="editAttributeModal{{ $attribute['id'] }}" tabindex="-1" aria-labelledby="editAttributeModalLabel{{ $attribute['id'] }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
                    <div class="modal-header bg-warning text-dark" style="border-radius: 12px 12px 0 0;">
                        <h5 class="modal-title fw-bold" id="editAttributeModalLabel{{ $attribute['id'] }}">
                            <i class="fa fa-pencil me-2"></i>Edit Product Attribute ({{ $attribute['size'] }})
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('update.single.attribute', $attribute['id']) }}">
                        @csrf
                        <div class="modal-body p-4 text-start">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Size</label>
                                <input type="text" name="size" class="form-control" value="{{ $attribute['size'] }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">SKU</label>
                                <input type="text" name="sku" class="form-control" value="{{ $attribute['sku'] }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Price (GH¢)</label>
                                <input type="number" step="0.01" name="price" class="form-control" value="{{ $attribute['price'] }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Stock Quantity</label>
                                <input type="number" name="stock" class="form-control" value="{{ $attribute['stock'] }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Status</label>
                                <select name="status" class="form-select">
                                    <option value="1" {{ $attribute['status'] == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $attribute['status'] == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-warning px-4 fw-bold text-dark">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach

        <style>
            .attribute-row.dragging {
                opacity: 0.5;
                background-color: #fff3cd !important;
                border: 2px dashed #ffc107 !important;
            }
            .attribute-row {
                transition: background-color 0.15s ease;
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const tbody = document.querySelector('#attributes-table tbody');
                if (!tbody) return;

                let dragRow = null;

                tbody.querySelectorAll('.attribute-row').forEach(row => {
                    row.addEventListener('dragstart', function (e) {
                        dragRow = this;
                        this.classList.add('dragging');
                        e.dataTransfer.effectAllowed = 'move';
                    });

                    row.addEventListener('dragover', function (e) {
                        e.preventDefault();
                        e.dataTransfer.dropEffect = 'move';
                        if (this !== dragRow) {
                            const bounding = this.getBoundingClientRect();
                            const offset = bounding.y + (bounding.height / 2);
                            if (e.clientY > offset) {
                                this.after(dragRow);
                            } else {
                                this.before(dragRow);
                            }
                        }
                    });

                    row.addEventListener('dragend', function () {
                        this.classList.remove('dragging');
                        dragRow = null;
                        saveNewAttributeOrder();
                    });
                });

                function saveNewAttributeOrder() {
                    const attributeIds = Array.from(tbody.querySelectorAll('.attribute-row')).map(row => row.getAttribute('data-id'));
                    
                    fetch('{{ route("update.attributes.order") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ attribute_ids: attributeIds })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            if (typeof toastr !== 'undefined') {
                                toastr.success(data.message);
                            }
                        }
                    })
                    .catch(err => console.error(err));
                }
            });
        </script>



      </div>
   </div>
</div>
@endsection
