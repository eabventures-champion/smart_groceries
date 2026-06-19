@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Educational Health Tips</div>
      <div class="ms-auto">
         <div class="btn-group">
            <a href="{{ route('admin.lifestyle.tips.add') }}" class="btn btn-primary">Add Health Tip</a>
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
                     <th>Title</th>
                     <th>Slug</th>
                     <th>Content Snippet</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                @foreach ($tips as $key => $tip)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td style="font-size: 20px;">{{ $tip->icon }}</td>
                        <td>{{ $tip->title }}</td>
                        <td><code>{{ $tip->type_slug }}</code></td>
                        <td>{!! Str::limit(strip_tags($tip->content), 100) !!}</td>
                        <td>
                            <a href="{{ route('admin.lifestyle.tips.edit', $tip->id) }}" class="btn btn-info btn-sm">Edit</a>
                            <a href="{{ route('admin.lifestyle.tips.delete', $tip->id) }}" class="btn btn-danger btn-sm" id="delete">Delete</a>
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
