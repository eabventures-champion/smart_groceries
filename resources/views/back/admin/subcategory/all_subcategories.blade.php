@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">All Sub Category</div>
      {{-- <div class="ps-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
               <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">All SubCategory</li>
            </ol>
         </nav>
      </div> --}}
      <div class="ms-auto">
         <div class="btn-group">
            <a href="{{ route('add.subcategory') }}" class="btn btn-primary">Add SubCategory</a>
         </div>
      </div>
   </div>
   <hr/>
   <div class="card">
      <div class="card-body">
         <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
               <thead>
                  <tr>
                     <th>S/N</th>
                     <th>Category</th>
                     <th>Sub Category</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                @foreach ($subcategories as $key => $subcategory )
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $subcategory->category?->category_name ?? 'N/A' }}</td>
                        <td>{{ $subcategory->subcategory_name }}</td>
                        <td>
                            <a href="{{ route('edit.subcategory', $subcategory->id) }}" class="btn btn-info">Edit</a>
                            <a href="{{ route('delete.subcategory', $subcategory->id) }}" class="btn btn-danger" id="delete">Delete</a>
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