<style type="text/css">

	body {

	}
	.card{
		background-color: #fff;
		padding: 15px;
		border: 1px solid #eee;
	}
	.input-box{
		position: relative;
	}
	.input-box i{
		position: absolute;
		right: 13px;
		top: 15px;
		color: #ced4da;
	}
	.form-control{
		height: 50px;
		background-color: #eeeeee69;
	}
	.form-control:focus{
		background-color: #eeeeee69;
		box-shadow: none;
		border-color: #eee;
	}
	.list{
		padding-top: 20px;
		padding-bottom: 10px;
		display: flex;
		align-items: center;
	}
	.border-bottom{
		border-bottom: 1px solid #eee;
	}
	.list i {
		font-size: 19px;
		color: red;
	}
	.list small{
		color: #000000;
	}
</style>

@if($products->isEmpty())
<div class="container mt-30 mb-30">
	<h4 class="mobile_product_not_found_text text-center text-danger">No Product Found</h4>
</div>
@else
<div class="container mt-5">
   <div class="row d-flex justify-content-center">
      <div class="col-md-12">
         <div class="card">
            @foreach($products as $item)
            <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}">
               <div class="list border-bottom">
                  <img src="{{ asset($item->product_thumbnail) }}" style="width:40px; height:40px">
                  <div class="d-flex flex-column ml-5" style="margin-left:10px; font-size:16px; font-weight: bold;">
                     <span>{{ $item->product_name }}</span> <small>Gh {{ $item->selling_price }}</small>
                  </div>
               </div>
            </a>
            @endforeach
         </div>
      </div>
   </div>
</div>
@endif
