@php
$skip_category_1 = App\Models\Category::skip(1)->first();
$skip_product_1 = App\Models\Product::where('status',1)->where('category_id',$skip_category_1->id)->orderBy('id','DESC')->limit(5)->get();
@endphp
@if(!$skip_product_1->isEmpty())
<section class="product-tabs section-padding position-relative">
   <div class="container">
      <div class="section-title style-2 wow animate__animated animate__fadeIn">
         <h3>{{ $skip_category_1->category_name }}</h3>
      </div>
      <!--End nav-tabs-->
      <div class="tab-content" id="myTabContent">
         <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
            <div class="row product-grid-4">
               @foreach($skip_product_1 as $product)
               <div class="col-lg-1-5 col-md-4 col-6 col-sm-6">
                  <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                     <div class="product-img-action-wrap">
                        <div class="product-img product-img-zoom">
                           <a href="">
                           <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                           <img class="default-img" src="{{ asset( $product->product_thumbnail ) }}" alt="" />
                           </a>
                           {{-- <img class="hover-img" src="{{ asset('frontend/assets/imgs/shop/product-1-2.jpg') }}" alt="" /> --}}
                           </a>
                        </div>
                        <div class="product-action-1">
                           <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"  ><i class="fi-rs-heart"></i></a> 
                           <a aria-label="Compare" class="action-btn"  id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                           <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)" ><i class="fi-rs-eye"></i></a>                        
                        </div>
                        <div class="product-badges product-badges-position product-badges-mrg">
                           @if($product->discount_price == NULL)
                           {{-- <span class="new">New</span> --}}
                           @else
                           <span class="hot"> {{ round((float)$product->discount_price) }} %</span>
                           @endif
                        </div>
                     </div>
                     <div class="product-content-wrap">
                        <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"> {{ $product->product_name }} </a></h2>
                        @php
                        $amount = (100 - (float)($product->discount_price ?? 0))/100;
                        $new_price = $amount * (float)$product->selling_price;
                        @endphp
                        <div class="product-card-bottom">
                           @if($product->discount_price == NULL)
                           <div class="product-price">
                              <span>Gh {{ number_format((float)$product->selling_price, 2) }}</span>
                           </div>
                           @else
                           <div class="product-price">
                              <span>Gh {{ number_format((float)$new_price, 2) }}</span><br>
                              <span class="old-price">Gh {{ number_format((float)$product->selling_price, 2) }}</span>
                           </div>
                           @endif
                           <div class="add-cart">
                              <a class="add" href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--end product card-->
               @endforeach
            </div>
            <!--End product-grid-4-->
         </div>
      </div>
      <!--End tab-content-->
   </div>
</section>
@else       
@endif