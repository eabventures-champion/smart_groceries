@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Experts List</div>
      <div class="ms-auto">
         <div class="btn-group">
            <a href="{{ route('admin.lifestyle.experts.add') }}" class="btn btn-primary">Add Expert Profile</a>
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
                     <th>Avatar</th>
                     <th>Name</th>
                     <th>Category</th>
                     <th>Specialty Description</th>
                     <th>Availability</th>
                     <th>WhatsApp</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                @foreach ($experts as $key => $expert)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            <div style="width: 40px; height: 40px; background: {{ $expert->avatar_bg_color }}; color: {{ $expert->avatar_text_color }}; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                {{ $expert->initials }}
                            </div>
                        </td>
                        <td>{{ $expert->name }}</td>
                        <td>
                            @if($expert->category)
                                <span class="badge bg-{{ $expert->category->badge_style }}">{{ $expert->category->name }}</span>
                            @else
                                <span class="badge bg-secondary">Unassigned</span>
                            @endif
                        </td>
                        <td style="max-width: 250px; white-space: normal;">{{ $expert->specialty_description }}</td>
                        <td>{{ $expert->availability_schedule }}</td>
                        <td><code>{{ $expert->whatsapp_number }}</code></td>
                        <td>
                            @if ($expert->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.lifestyle.experts.edit', $expert->id) }}" class="btn btn-info btn-sm">Edit</a>
                            <a href="{{ route('admin.lifestyle.experts.delete', $expert->id) }}" class="btn btn-danger btn-sm" id="delete">Delete</a>
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
