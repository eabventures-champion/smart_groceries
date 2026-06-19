@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Blog Categories</div>
      <div class="ms-auto">
         <div class="btn-group">
            <a href="{{ route('admin.lifestyle.blog_categories.add') }}" class="btn btn-primary">Add Blog Category</a>
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
                     <th>Name</th>
                     <th>Slug</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                @foreach ($categories as $key => $category)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $category->name }}</td>
                        <td><code>{{ $category->slug }}</code></td>
                        <td>
                            <a href="{{ route('admin.lifestyle.blog_categories.edit', $category->id) }}" class="btn btn-info btn-sm">Edit</a>
                            <a href="{{ route('admin.lifestyle.blog_categories.delete', $category->id) }}" class="btn btn-danger btn-sm" id="delete">Delete</a>
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
