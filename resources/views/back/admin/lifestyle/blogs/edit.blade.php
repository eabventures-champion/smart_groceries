@extends('back.admin.master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="ps-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
               <li class="breadcrumb-item"><a href="{{ route('admin.lifestyle.blogs') }}"><i class="bx bx-arrow-back">&nbsp;Back</i></a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit Blog Post</li>
            </ol>
         </nav>
      </div>
   </div>
   <!--end breadcrumb-->
   <div class="container">
      <div class="main-body">
         <div class="row">
            <div class="col-lg-10">
               <div class="card">
                  <div class="card-body">
                     <form id="myForm" method="POST" action="{{ route('admin.lifestyle.blogs.update') }}" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $blog->id }}" />
                        
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Blog Title</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="title" class="form-control" value="{{ $blog->title }}" />
                           </div>
                        </div>

                         <div class="row mb-3">
                            <div class="col-sm-3">
                               <h6 class="mb-0">Category</h6>
                            </div>
                            <div class="form-group col-sm-9 text-secondary">
                               <select name="category" class="form-select">
                                  <option value="" disabled>Select Blog Category</option>
                                  @foreach($categories as $cat)
                                     <option value="{{ $cat->name }}" {{ $cat->name == $blog->category ? 'selected' : '' }}>{{ $cat->name }}</option>
                                  @endforeach
                               </select>
                            </div>
                         </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Author</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="author" class="form-control" value="{{ $blog->author }}" />
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Blog Banner Image</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="file" name="image" class="form-control" id="image" />
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Current Image</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <img id="showImage" src="{{ $blog->image ? ((str_starts_with($blog->image, 'http://') || str_starts_with($blog->image, 'https://')) ? $blog->image : asset($blog->image)) : url('back/assets/images/category/no_image.jpg') }}" alt="preview" style="width: 150px; height: 110px; object-fit: cover; border-radius: 6px;">
                           </div>
                        </div>

                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Blog Content</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <textarea id="mytextarea" name="content" class="form-control" rows="12">{{ $blog->content }}</textarea>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-sm-3"></div>
                           <div class="col-sm-9 text-secondary">
                              <input type="submit" class="btn btn-primary px-4" value="Update Blog Post" />
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                title: {
                    required : true,
                }, 
                category: {
                    required : true,
                }, 
                author: {
                    required : true,
                },
            },
            messages :{
                title: {
                    required : 'Please enter blog title',
                },
                category: {
                    required : 'Please select category',
                },
                author: {
                    required : 'Please enter author name',
                },
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);    
            }
            if (e.target.files && e.target.files[0]) {
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    });
 </script>
@endsection
