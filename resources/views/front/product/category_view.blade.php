@extends('front.master')
@section('content')
@section('title')
 {{ $breadcat->category_name }} Category
@endsection

<div class="page-header breadcrumb-wrap">
   <div class="container">
      <div class="breadcrumb">
         <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
         <span></span> {{ $breadcat->category_name }}
      </div>
   </div>
</div>

<div class="container btn-group dropend d-block d-lg-none">
   <button type="button" class="btn btn-sm btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fi fi-br-settings-sliders"></i>&nbsp; Filter
   </button>
   <ul class="dropdown-menu" style="padding: .5rem .5rem !important; min-width: 13rem;">
      {{-- <div class="sidebar-widget price_range range mb-30">
         <form action="{{ route('shop.filter') }}" method="post">
             @csrf
             <div class="list-group">
               <div class="list-group-item mt-20">

                   @if (!empty($_GET['category']))
                   @php
                    $filter_category = explode(',', $_GET['category']);   
                   @endphp  
                   @endif

                   <label class="fw-900">Filter by Category</label>
                   @foreach($categories as $category)
                       @php
                       $products_mobile = App\Models\Product::where('category_id',$category->id)->get();
                       @endphp
                       <div class="custome-checkbox">
                           <input class="form-check-input" type="checkbox" name="category[]" id="exampleCheckbox_mobile{{ $category->id }}" value="{{ $category->category_slug }}"
                           @if(!empty($filter_category) && in_array($category->category_slug, $filter_category)) 
                           checked 
                           @endif
                           onchange="this.form.submit()" 
                           />
                           <label class="form-check-label" for="exampleCheckbox_mobile{{ $category->id }}"><span>{{ $category->category_name }} ({{ count($products_mobile) }})</span></label>
                           <br />
                       </div>
                   @endforeach
                   <br>
                   <a style="background-color: red" href="{{ route('shop.page') }}" class="btn btn-sm btn-default">Reset products</a>
               </div>
             </div>
         </form>
      </div> --}}
      <div class="sidebar-widget widget-category-2">
         <label class="fw-900 d-none d-lg-none">Filter by Category</label>
         <ul>
            @foreach($categories as $category)
            @php
            $category_products = App\Models\Product::where('category_id', $category->id)->paginate(10);
            @endphp
            <li>
               <a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}"> <img src=" {{ asset($category->category_photo) }} " alt="" />{{ $category->category_name }}</a>
               <span class="count">{{ count($category_products) }}</span>
            </li>
            @endforeach 
         </ul>
      </div>
   </ul>
</div>

<div class="container mb-30">
   <div class="row flex-row-reverse">

      <div class="col-lg-4-5">
         <div class="shop-product-fillter">
            <div class="totall-product">
               <p>We found <strong class="text-brand">{{ count($products) }}</strong> items for you!</p>
            </div>
            {{-- <div class="sort-by-product-area">
               <div class="sort-by-cover mr-10">
                  <div class="sort-by-product-wrap">
                     <div class="sort-by">
                        <span><i class="fi-rs-apps"></i>Show:</span>
                     </div>
                     <div class="sort-by-dropdown-wrap">
                        <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                     </div>
                  </div>
                  <div class="sort-by-dropdown">
                     <ul>
                        <li><a class="active" href="#">50</a></li>
                        <li><a href="#">100</a></li>
                        <li><a href="#">150</a></li>
                        <li><a href="#">200</a></li>
                        <li><a href="#">All</a></li>
                     </ul>
                  </div>
               </div>
               <div class="sort-by-cover">
                  <div class="sort-by-product-wrap">
                     <div class="sort-by">
                        <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                     </div>
                     <div class="sort-by-dropdown-wrap">
                        <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                     </div>
                  </div>
                  <div class="sort-by-dropdown">
                     <ul>
                        <li><a class="active" href="#">Featured</a></li>
                        <li><a href="#">Price: Low to High</a></li>
                        <li><a href="#">Price: High to Low</a></li>
                        <li><a href="#">Release Date</a></li>
                        <li><a href="#">Avg. Rating</a></li>
                     </ul>
                  </div>
               </div>
            </div> --}}
            
         </div>

         <div class="row product-grid">
            @foreach($products as $product)
            {{-- <div class="col-lg-1-4 col-md-4 col-12 col-sm-6"> --}}
               <div class="col-lg-1-5 col-md-4 col-6 col-sm-6">
               <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                  <div class="product-img-action-wrap">
                     <div class="product-img product-img-zoom">
                        <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                        <img class="default-img" src="{{ asset( $product->product_thumbnail ) }}" alt="" />
                        </a>
                     </div>
                     <div class="product-action-1 shop">
                        <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"  ><i class="fi-rs-heart"></i></a>
                        <a aria-label="Compare" class="action-btn"  id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)" ><i class="fi-rs-eye"></i></a>
                     </div>
                     @php
                     $amount = $product->selling_price - $product->discount_price;
                     $discount = ($amount/$product->selling_price) * 100;
                     @endphp
                     <div class="product-badges product-badges-position product-badges-mrg">
                        @if($product->discount_price == NULL)
                        {{-- <span class="new">New</span> --}}
                        @else
                        <span class="hot"> {{ round($product->discount_price) }} %</span>
                        @endif
                     </div>
                  </div>
                  <div class="product-content-wrap">
                     <div class="product-category">
                        <a href="shop-grid-right.html">{{ $product['category']['category_name'] }}</a>
                     </div>
                     <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"> {{ $product->product_name }} </a></h2>
                     {{-- <div class="product-rate-cover">
                        <div class="product-rate d-inline-block">
                           <div class="product-rating" style="width: 90%"></div>
                        </div>
                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                     </div> --}}
                     {{-- <div>
                        @if($product->vendor_id == NULL)
                        <span class="font-small text-muted">By <a href="vendor-details-1.html">Owner</a></span>
                        @else
                        <span class="font-small text-muted">By <a href="vendor-details-1.html">{{ $product['vendor']['name'] }}</a></span>
                        @endif
                     </div> --}}
                     @php
                     $amount = (100 - $product->discount_price)/100;
                     $new_price = $amount * $product->selling_price;
                     @endphp
                     <div class="product-card-bottom">
                        @if($product->discount_price == NULL)
                        <div class="product-price">
                           <span>Gh {{ number_format($product->selling_price, 2) }}</span>
                        </div>
                        @else
                        <div class="product-price">
                           <span>Gh {{ number_format($new_price, 2) }}</span><br>
                           <span class="old-price">Gh {{ number_format($product->selling_price, 2) }}</span>
                        </div>
                        @endif
                        <div class="add-cart">
                           <a class="add" href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"><i class="fi-rs-shopping-cart mr-5"></i></a>                        
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--end product card-->
            @endforeach
         </div>
         <!--product grid-->
         <div class="pagination-area mt-20 mb-20">
            <nav aria-label="Page navigation example">
               {{-- <ul class="pagination justify-content-start">
                  <li class="page-item">
                     <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item active"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                  <li class="page-item"><a class="page-link" href="#">6</a></li>
                  <li class="page-item">
                     <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                  </li>
               </ul> --}}
               {{ $products->links('vendor.pagination.custom') }}
            </nav>
         </div>
         <!--End Deals-->
      </div>
      
      <div class="col-lg-1-5 primary-sidebar sticky-sidebar d-none d-lg-block">
         <div class="sidebar-widget widget-category-2 mb-30">
            <h5 class="section-title style-1 mb-30">Category</h5>
            <ul>
               @foreach($categories as $category)
               @php
               $products = App\Models\Product::where('category_id',$category->id)->get();
               @endphp
               <li>
                  <a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}"> <img src=" {{ asset($category->category_photo) }} " alt="" />{{ $category->category_name }}</a>
                  <span class="count">{{ count($products) }}</span>
               </li>
               @endforeach 
            </ul>
         </div>
         <!-- Fillter By Price -->

         <!-- Product sidebar Widget -->
         <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
            <h5 class="section-title style-1 mb-30">New products</h5>
            @foreach($newProduct as $product)
            <div class="single-post clearfix">
               <div class="image">
                  <img src="{{ asset( $product->product_thumbnail ) }}" alt="#" />
               </div>
               <div class="content pt-10">
                  <p><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ $product->product_name }}</a></p>
                  @if($product->discount_price == NULL)
                  <p class="price mb-0 mt-5">Gh {{ number_format($product->selling_price, 2) }}</p>
                  @else
                  <p class="price mb-0 mt-5">Gh {{ number_format($product->discount_price, 2) }}</p>
                  @endif
                  {{-- <div class="product-rate">
                     <div class="product-rating" style="width: 90%"></div>
                  </div> --}}
               </div>
            </div>
            @endforeach
         </div>
      </div>
   </div>
</div>
@endsection