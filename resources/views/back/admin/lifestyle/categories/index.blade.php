@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Expert Categories</div>
      <div class="ms-auto">
         <div class="btn-group">
            <a href="{{ route('admin.lifestyle.categories.add') }}" class="btn btn-primary">Add Expert Category</a>
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
                     <th>Icon</th>
                     <th>Name</th>
                     <th>Code</th>
                     <th>Badge Style</th>
                     <th>Experts Count</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                @foreach ($categories as $key => $category)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td style="font-size: 20px;">{{ $category->icon }}</td>
                        <td>{{ $category->name }}</td>
                        <td><code>{{ $category->code }}</code></td>
                        <td><span class="badge bg-{{ $category->badge_style }}">{{ $category->badge_style }}</span></td>
                        <td>{{ $category->experts_count }}</td>
                        <td>
                            <a href="{{ route('admin.lifestyle.categories.edit', $category->id) }}" class="btn btn-info btn-sm">Edit</a>
                            <a href="{{ route('admin.lifestyle.categories.delete', $category->id) }}" class="btn btn-danger btn-sm" id="delete">Delete</a>
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
