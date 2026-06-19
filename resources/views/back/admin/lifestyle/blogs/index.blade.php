@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Blog Posts</div>
      <div class="ms-auto">
         <div class="btn-group">
            <a href="{{ route('admin.lifestyle.blogs.add') }}" class="btn btn-primary">Add Blog Post</a>
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
                     <th>Image</th>
                     <th>Title</th>
                     <th>Category</th>
                     <th>Author</th>
                     <th>Date Created</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                @foreach ($blogs as $key => $blog)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            @if($blog->image)
                                <img src="{{ (str_starts_with($blog->image, 'http://') || str_starts_with($blog->image, 'https://')) ? $blog->image : asset($blog->image) }}" style="width: 60px; height: 45px; object-fit: cover; border-radius: 4px;">
                            @else
                                <span class="badge bg-secondary">No Image</span>
                            @endif
                        </td>
                        <td>{{ $blog->title }}</td>
                        <td><span class="badge bg-success">{{ $blog->category }}</span></td>
                        <td>{{ $blog->author }}</td>
                        <td>{{ $blog->created_at ? $blog->created_at->format('M d, Y') : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('admin.lifestyle.blogs.edit', $blog->id) }}" class="btn btn-info btn-sm">Edit</a>
                            <a href="{{ route('admin.lifestyle.blogs.delete', $blog->id) }}" class="btn btn-danger btn-sm" id="delete">Delete</a>
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
