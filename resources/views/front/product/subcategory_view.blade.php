@extends('front.master')
@section('content')
@section('title')
    {{ $breadsubcat->category->category_name }} >  {{ $breadsubcat->subcategory_name }} Subcategory
@endsection

<div class="page-header breadcrumb-wrap">
   <div class="container">
      <div class="breadcrumb">
         <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
         <span></span> {{ $breadsubcat->category->category_name }} <span></span> {{ $breadsubcat->subcategory_name }}
      </div>
   </div>
</div>

<div class="container btn-group d-block d-lg-none">
   <button type="button" class="btn btn-sm btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fi fi-br-settings-sliders"></i>&nbsp; Filter
   </button>
   <ul class="dropdown-menu" style="padding: 1rem 1rem !important; min-width: 12rem;">
      <div class="sidebar-widget widget-category-2">
         {{-- <ul> --}}
            {{-- @foreach($categories as $category)
            @php
            $category_products = App\Models\Product::where('category_id', $category->id)->paginate(10);
            @endphp
            <li>
               <a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}"> <img src=" {{ asset($category->category_photo) }} " alt="" />{{ $category->category_name }}</a>
               <span class="count">{{ count($category_products) }}</span>
            </li>
            @endforeach  --}}
            <div class="">
               <nav>
                  <ul class="">
                     @php
                        $all_categories = App\Models\Category::orderBy('category_name','ASC')->get();
                     @endphp
                     <li class="menu-item-has-children">
                        <ul class="dropdown">
                           @foreach($all_categories as $category)
                           <li class="menu-item-has-children">
                              <a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}">{{ $category->category_name }}</a>
                              @php 
                              $subcategories = App\Models\SubCategory::where('category_id', $category->id)->orderBy('subcategory_name','ASC')->get();
                              @endphp
                              <ul class="dropdown">
                                 @foreach($subcategories as $subcategory)
                                 <li><a href="{{ url('product/subcategory/'.$subcategory->id.'/'.$subcategory->subcategory_slug) }}">{{ $subcategory->subcategory_name }}</a></li>
                                 @endforeach
                              </ul>
                           </li>
                           @endforeach
                        </ul>
                     </li>
                  </ul>
               </nav>
               <!-- mobile menu end -->
            </div>
         {{-- </ul> --}}
      </div>
   </ul>
</div>

<div class="container mb-30 mt-50">
   <div class="row flex-row-reverse">
      <div class="col-lg-4-5">
         <div class="shop-product-fillter">
            <div class="totall-product">
               <p>We found <strong class="text-brand">{{ count($products) }}</strong> items for you!</p>
            </div>
         </div>

         <div class="row product-grid">
            @forelse($products as $product)
               <div class="col-lg-2 col-md-4 col-6 col-sm-6">
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
                        <a href="shop-grid-right.html">{{ $product['subcategory']['subcategory_name'] }}</a>
                     </div>
                     <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"> {{ $product->product_name }} </a></h2>
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
                           <a class="add" href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"><i class="fi-rs-shopping-cart mr-5"></i></a>                        </div>
                     </div>
                  </div>
               </div>
            </div>
            @empty
               <div class="col-12 text-center py-5 px-3 mb-5" style="background: #ffffff; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid #f1f2f4; margin-top: 30px;">
                  <div class="mb-4" style="animation: bounce 2s infinite ease-in-out;">
                     <!-- Beautiful premium empty shopping bag SVG -->
                     <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24" fill="none" stroke="#bf8069" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag" style="opacity: 0.85;">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                     </svg>
                  </div>
                  <h3 class="mb-2" style="font-family: 'Outfit', sans-serif; font-weight: 700; color: #253D4E; font-size: 24px;">No Products Found</h3>
                  <p class="mb-4 text-muted mx-auto" style="font-family: 'Inter', sans-serif; font-size: 15px; max-width: 420px; line-height: 1.6;">
                     We couldn't find any products in this subcategory right now. Please check back later or explore other grocery categories.
                  </p>
                  <a href="/" class="btn" style="background-color: #3bb77e; border: none; color: #fff; padding: 12px 30px; font-family: 'Outfit', sans-serif; font-weight: 700; border-radius: 30px; font-size: 15px; display: inline-flex; align-items: center; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(59, 183, 126, 0.2);">
                     <i class="fi-rs-shopping-bag mr-10" style="margin-right: 8px;"></i> Back to Home
                  </a>
               </div>
               <style>
                  @keyframes bounce {
                     0%, 100% { transform: translateY(0); }
                     50% { transform: translateY(-10px); }
                  }
               </style>
            @endforelse
         </div>
         <!--product grid-->
         <!--End Deals-->
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
                  <a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}"> <img src=" {{ asset($category->category_photo) }} " alt="" />{{ $category->category_name }}</a><span class="count">{{ count($products) }}</span>
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