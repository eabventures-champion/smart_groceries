@extends('front.master')
@section('content')
@section('title')
 Shop Page
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}


<div class="page-header mt-30 mb-50">
   <div class="container">
      <div class="archive-header">
         <div class="row align-items-center">
            <div class="col-xl-3">
               <h5 class="mb-15">Shop Page</h5>
               <div class="breadcrumb">
                  <a href="/" rel="nofollow"><i class="fi-rs-home mr-5 "></i>Home</a>
               </div>
               <p class="d-block d-lg-none">
                  We found <strong class="text-brand">{{ count($products) }}</strong> items for you!
               </p>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="container btn-group dropend d-block d-lg-none">
   <button type="button" class="btn btn-sm btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fi fi-br-settings-sliders"></i>&nbsp; Filter
   </button>
   <ul class="dropdown-menu" style="padding: .5rem 1.5rem !important; min-width: 15rem;">
      <div class="sidebar-widget price_range range mb-30">
         <form action="{{ route('shop.filter') }}" method="post">
             @csrf
             <label class="fw-900 d-none d-lg-none">Filter by Price</label>
             <div class="price-filter d-none d-lg-none">
                 <div class="price-filter-inner">
                     <div id="slider-range-mobile" class="price-filter-range" data-min="0" data-max="500"></div>&nbsp;
                     <input type="hidden" id="price_range-mobile" name="price_range" value="" />
                     <input type="text" id="amount-mobile" value="Gh 0 - Gh 500" readonly /><br><br>
                     <button type="submit" class="btn btn-sm btn-default"><i class="fi fi-br-settings-sliders mr-5"></i> Filter</button>
                     <a style="background-color: red" href="{{ route('shop.page') }}" class="btn btn-sm btn-default">Reset</a>
                 </div>
             </div>

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

                   @if (!empty($_GET['brand']))
                   @php
                    $filter_brand = explode(',', $_GET['brand']);
                   @endphp
                   @endif

                   {{-- <label class="fw-900 mt-15">Filter by Brand</label>
                   @foreach($brands as $brand)
                       <div class="custome-checkbox">
                           <input class="form-check-input" type="checkbox" name="brand[]" id="exampleBrand_mobile{{ $brand->id }}" value="{{ $brand->brand_slug }}"
                           @if(!empty($filter_brand) && in_array($brand->brand_slug, $filter_brand))
                           checked
                           @endif
                           onchange="this.form.submit()"
                           />
                           <label class="form-check-label" for="exampleBrand_mobile{{ $brand->id }}"><span>{{ $brand->brand_name }}</span></label>
                           <br />
                       </div>
                   @endforeach --}}
               </div>
             </div>

         </form>
      </div>
   </ul>
 </div>

<div class="container mb-30">
   <div class="row flex-row-reverse">

      {{-- Items found --}}
      <div class="col-lg-4-5">
         <div class="shop-product-fillter">
            <div class="totall-product d-none d-lg-block">
               <p>
                  We found <strong class="text-brand">{{ count($products) }}</strong> products for you!
               </p>
            </div>

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
                     <div class="product-action-1 shop d-none d-lg-block">
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
                        <a href="{{ url('product/category/'.$product['category']['id'].'/'.$product['category']['category_slug']) }}">{{ $product['category']['category_name'] }}</a>
                     </div>
                     <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"> {{ $product->product_name }} </a></h2>
                     <div class="product-action-1-mobile d-block d-lg-none">
                        <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>
                        {{-- <a aria-label="Compare" class="action-btn" id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>                            --}}
                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                     </div>
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
                           <a class="add" href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--end product card-->
            @endforeach
         </div>

         <!--product grid-->
         <div class="pagination-area">
            <nav aria-label="Page navigation example">
               {{ $products->links('vendor.pagination.custom') }}
               {{-- {{ $products->links() }} --}}
            </nav>
         </div>
         <!--End Deals-->
      </div>

      {{-- Filter by price tab --}}
      <div class="col-lg-1-5 primary-sidebar sticky-sidebar d-none d-lg-block">
         <div class="sidebar-widget price_range range mb-30">
            <form action="{{ route('shop.filter') }}" method="post">
                @csrf
                {{-- <h5 class="section-title style-1 mb-30">Filter by price</h5> --}}
                <label class="fw-900 d-none d-lg-none">Filter by price</label>
                <div class="price-filter d-none d-lg-none">
                    <div class="price-filter-inner">
                        <div id="slider-range" class="price-filter-range" data-min="0" data-max="500"></div>
                        <input type="hidden" id="price_range" name="price_range" value="" />
	                     <input type="text" id="amount" value="Gh 0 - Gh 500" readonly />
                        <br><br>
                        <button type="submit" class="btn btn-sm btn-default"><i class="fi fi-rs-filter mr-5"></i> Filter</button> <hr>
                        <a style="background-color: red" href="{{ route('shop.page') }}" class="btn btn-sm btn-default"> Reset products found</a>
                    </div>
                </div>

                <div class="list-group">
                    <div class="list-group-item mb-10">

                        @if (!empty($_GET['category']))
                        @php
                         $filter_category = explode(',', $_GET['category']);
                        @endphp
                        @endif

                        <label class="fw-900">Filter by Category</label>
                        @foreach($categories as $category)
                            @php
                            $products = App\Models\Product::where('category_id',$category->id)->get();
                            @endphp
                            <div class="custome-checkbox">
                                <input class="form-check-input" type="checkbox" name="category[]" id="exampleCheckbox{{ $category->id }}" value="{{ $category->category_slug }}"
                                @if(!empty($filter_category) && in_array($category->category_slug, $filter_category))
                                checked
                                @endif
                                onchange="this.form.submit()"
                                />
                                <label class="form-check-label" for="exampleCheckbox{{ $category->id }}"><span>{{ $category->category_name }} ({{ count($products) }})</span></label>
                                <br />
                            </div>
                        @endforeach
                        <br>

                        <a style="background-color: red" href="{{ route('shop.page') }}" class="btn btn-sm btn-default">Reset products</a><br>

                        @if (!empty($_GET['brand']))
                        @php
                         $filter_brand = explode(',', $_GET['brand']);
                        @endphp
                        @endif

                        <label class="fw-900 mt-15">Brand</label>
                        @foreach($brands as $brand)
                            <div class="custome-checkbox">
                                <input class="form-check-input" type="checkbox" name="brand[]" id="exampleBrand{{ $brand->id }}" value="{{ $brand->brand_slug }}"
                                @if(!empty($filter_brand) && in_array($brand->brand_slug, $filter_brand))
                                checked
                                @endif
                                onchange="this.form.submit()"
                                />
                                <label class="form-check-label" for="exampleBrand{{ $brand->id }}"><span>{{ $brand->brand_name }}</span></label>
                                <br />
                            </div>
                        @endforeach
                    </div>
                </div>
            </form>
         </div>

         <!-- Product sidebar Widget -->
         <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
            <h5 class="section-title style-1 mb-30">New products</h5>
            @foreach($newProduct as $product)

            @php
            $amount = (100 - $product->discount_price)/100;
            $new_price = $amount * $product->selling_price;
            @endphp

            <div class="single-post clearfix">
               <div class="image">
                  <img src="{{ asset( $product->product_thumbnail ) }}" alt="#" />
               </div>
               <div class="content pt-10">
                  <p><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ $product->product_name }}</a></p>
                  @if($product->discount_price == NULL)
                  <p class="price mb-0 mt-5">Gh {{ number_format($product->selling_price, 2) }}</p>
                  @else
                  <p class="price mb-0 mt-5">Gh {{ number_format($new_price, 2) }}</p>
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

<script type="text/javascript">
   $(document).ready(function(){
      if($('#slider-range').length > 0){
         const max_price = parseInt($('#slider-range').data('max'));
         const min_price = parseInt($('#slider-range').data('min'));

         let price_range = min_price+"-"+max_price;
         let price = price_range.split('-');

         $("#slider-range").slider({
            range: true,
            orientation: "horizontal",
            min: min_price,
            max: max_price,
            values: price,

            slide: function (event, ui) {
               $("#amount").val('Gh '+ui.values[0]+" - "+'Gh '+ui.values[1]);
               $("#price_range").val(ui.values[0]+" - "+ui.values[1]);
            }
         });
      }
      if($('#slider-range-mobile').length > 0){
         const max_price = parseInt($('#slider-range-mobile').data('max'));
         const min_price = parseInt($('#slider-range-mobile').data('min'));

         let price_range = min_price+"-"+max_price;
         let price = price_range.split('-');

         $("#slider-range-mobile").slider({
            range: true,
            orientation: "horizontal",
            min: min_price,
            max: max_price,
            values: price,

            slide: function (event, ui) {
               $("#amount-mobile").val('Gh '+ui.values[0]+" - "+'Gh '+ui.values[1]);
               $("#price_range-mobile").val(ui.values[0]+" - "+ui.values[1]);
            }
         });
      }
   });
</script>
@endsection
