@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Halls </div>
      {{-- <div class="ps-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
               <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">All City</li>
            </ol>
         </nav>
      </div> --}}
      <div class="ms-auto">
         <div class="btn-group">
            <a href="{{ route('add.hall') }}" class="btn btn-primary">Add Hall</a> 				 
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
                     <th>Region </th>
                     <th>Institution</th>
                     <th>Hall</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($city as $key => $item)		
                  <tr>
                     <td> {{ $key+1 }} </td>
                     <td> {{ $item['region']['region_name'] }}</td>
                     <td> {{ $item['district']['district_name'] }}</td>
                     <td> {{ $item->city }}</td>
                     <td>
                        <a href="{{ route('edit.hall',$item->id) }}" class="btn btn-info">Edit</a>
                        <a href="{{ route('delete.hall',$item->id) }}" class="btn btn-danger" id="delete" >Delete</a>
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