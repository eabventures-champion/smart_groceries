@extends('front.master')
@section('content')
@section('title')
{{ $product->product_name }}
@endsection

<style>
   .premium-details-container {
       font-family: 'Inter', sans-serif;
   }
   .premium-details-container h2.title-detail {
       font-family: 'Outfit', sans-serif;
       font-weight: 800;
       color: #253D4E;
       font-size: 32px;
       margin-bottom: 20px;
       line-height: 1.25;
   }
   /* Main Detail Card */
   .premium-details-container .product-detail {
       background: #ffffff;
       border-radius: 24px;
       border: 1px solid #f1f2f4;
       box-shadow: 0 15px 45px rgba(0, 0, 0, 0.02);
       padding: 40px;
       margin-top: 20px;
   }
   /* Gallery Styles */
    .premium-details-container .detail-gallery {
        position: relative;
    }
    .premium-details-container .product-image-slider {
        border-radius: 16px;
        border: 1px solid #f1f2f4;
        background: #fafbfc;
        overflow: hidden;
        margin-bottom: 20px;
    }
    .premium-details-container .slider-nav-thumbnails {
        margin-top: 15px;
    }
    .premium-details-container .slider-nav-thumbnails div {
        border-radius: 10px;
        overflow: hidden;
        border: 2px solid transparent;
        cursor: pointer;
        transition: border-color 0.2s ease;
    }
    .premium-details-container .slider-nav-thumbnails div.slick-current {
        border-color: #3bb77e;
    }
   /* Stock Badge */
   .premium-details-container .stock-status {
       display: inline-block !important;
       padding: 6px 14px !important;
       font-size: 13px !important;
       font-weight: 700 !important;
       border-radius: 30px !important;
       margin-bottom: 20px !important;
       font-family: 'Outfit', sans-serif;
       height: auto !important;
   }
   .premium-details-container .stock-status.in-stock {
       background: rgba(46, 204, 113, 0.1) !important;
       color: #2ecc71 !important;
   }
   .premium-details-container .stock-status.out-stock {
       background: rgba(231, 76, 60, 0.1) !important;
       color: #e74c3c !important;
   }
   .premium-details-container .stock-status .total-qty-stock p {
       margin: 2px 0 0 0 !important;
       font-size: 12px;
       font-weight: 600;
   }
   /* Price Block */
   .premium-details-container .product-price-cover {
       background: #fdfaf3;
       border-radius: 16px;
       padding: 18px 24px;
       border: 1px solid #f9ebd1;
       display: inline-block;
       width: 100%;
       margin-bottom: 25px;
   }
   .premium-details-container .product-price {
       display: flex;
       align-items: baseline;
       gap: 12px;
   }
   .premium-details-container .product-price .current-price {
       font-size: 34px !important;
       font-weight: 800 !important;
       color: #3bb77e !important;
       font-family: 'Outfit', sans-serif;
   }
   .premium-details-container .product-price .old-price {
       font-size: 18px !important;
       color: #adadad !important;
       text-decoration: line-through;
       font-weight: 500;
   }
   .premium-details-container .product-price .save-price {
       background: #f74b81;
       color: #fff;
       padding: 4px 10px;
       border-radius: 30px;
       font-size: 12px;
       font-weight: 700;
   }
   /* Attributes layout */
   .premium-details-container .attr-detail {
       display: flex;
       align-items: center;
       gap: 15px;
       margin-bottom: 18px;
       max-width: 450px;
   }
   .premium-details-container .attr-detail strong {
       width: 80px;
       font-size: 14px;
       color: #253D4E;
       font-family: 'Outfit', sans-serif;
       font-weight: 700;
   }
   .premium-details-container .attr-detail select {
       border-radius: 8px !important;
       border: 1px solid #ececec !important;
       padding: 10px 14px !important;
       font-size: 14px !important;
       height: auto !important;
       color: #253D4E !important;
       flex: 1;
       background-color: #fff;
   }
   /* Quantity Selector */
   .premium-details-container .detail-qty {
       border-radius: 30px !important;
       border: 1px solid #ececec !important;
       padding: 10px 18px !important;
       background: #fff !important;
       display: inline-flex !important;
       align-items: center !important;
       height: 50px !important;
       max-width: 120px !important;
   }
   .premium-details-container .detail-qty a {
       color: #7e7e7e !important;
       font-size: 16px !important;
       display: inline-flex !important;
   }
   .premium-details-container .detail-qty .qty-val {
       border: none !important;
       font-weight: 700 !important;
       color: #253D4E !important;
       width: 40px !important;
       text-align: center !important;
       background: transparent !important;
       font-size: 16px !important;
       margin: 0 5px !important;
   }
   /* Extralink / Buttons Row */
   .premium-details-container .detail-extralink {
       display: flex;
       align-items: center;
       flex-wrap: wrap;
       gap: 15px;
       margin-top: 30px;
       margin-bottom: 30px;
   }
   .premium-details-container .button-add-to-cart {
       background-color: #3bb77e !important;
       border: none !important;
       color: #fff !important;
       padding: 14px 40px !important;
       font-family: 'Outfit', sans-serif !important;
       font-weight: 700 !important;
       border-radius: 30px !important;
       font-size: 16px !important;
       height: 50px !important;
       display: inline-flex !important;
       align-items: center !important;
       justify-content: center !important;
       gap: 8px !important;
       transition: all 0.3s ease !important;
       box-shadow: 0 8px 20px rgba(59, 183, 126, 0.25) !important;
       cursor: pointer !important;
   }
   .premium-details-container .button-add-to-cart:hover {
       transform: translateY(-2px) !important;
       box-shadow: 0 12px 25px rgba(59, 183, 126, 0.35) !important;
   }
   .premium-details-container .action-btn {
       border: 1px solid #ececec !important;
       border-radius: 50% !important;
       width: 50px !important;
       height: 50px !important;
       display: inline-flex !important;
       align-items: center !important;
       justify-content: center !important;
       color: #253D4E !important;
       font-size: 18px !important;
       background: #fff !important;
       transition: all 0.3s ease !important;
       cursor: pointer !important;
   }
   .premium-details-container .action-btn:hover {
       background-color: #3bb77e !important;
       color: #fff !important;
       border-color: #3bb77e !important;
       transform: translateY(-2px);
   }
   /* Description tabs styling */
   .premium-details-container .tab-style3 .nav-tabs {
       border-bottom: 2px solid #f1f2f4;
       margin-bottom: 25px;
   }
   .premium-details-container .tab-style3 .nav-tabs .nav-link {
       font-family: 'Outfit', sans-serif;
       font-weight: 700;
       color: #7e7e7e;
       border: none;
       padding: 12px 0;
       margin-right: 35px;
       position: relative;
       background: transparent;
       font-size: 16px;
   }
   .premium-details-container .tab-style3 .nav-tabs .nav-link.active {
       color: #3bb77e;
   }
   .premium-details-container .tab-style3 .nav-tabs .nav-link.active::after {
       content: '';
       position: absolute;
       bottom: -2px;
       left: 0;
       width: 100%;
       height: 2px;
       background-color: #3bb77e;
   }
   .premium-details-container .entry-main-content {
       font-family: 'Inter', sans-serif;
       font-size: 15px;
       line-height: 1.7;
       color: #687182;
   }
   
   /* Related Products Premium Grid Styling */
   .related-products-section .product-cart-wrap {
       background: #ffffff;
       border-radius: 18px;
       border: 1px solid #f1f2f4;
       box-shadow: 0 5px 15px rgba(0, 0, 0, 0.01);
       overflow: hidden;
       transition: all 0.3s ease;
       height: 100%;
       display: flex;
       flex-direction: column;
   }
   .related-products-section .product-cart-wrap:hover {
       transform: translateY(-5px);
       box-shadow: 0 12px 30px rgba(0, 0, 0, 0.05);
       border-color: #e2e8f0;
   }
   .related-products-section .product-img-action-wrap {
       background-color: #f7f9fa;
       padding: 20px;
       position: relative;
       display: flex;
       align-items: center;
       justify-content: center;
       height: 200px;
   }
   .related-products-section .product-img-action-wrap img {
       max-height: 100%;
       max-width: 100%;
       object-fit: contain;
       transition: transform 0.5s ease;
   }
   .related-products-section .product-cart-wrap:hover .product-img-action-wrap img {
       transform: scale(1.05);
   }
    
    /* Related Products Mobile Optimizations */
    @media (max-width: 768px) {
        .related-products-section .product-cart-wrap {
            border-radius: 12px !important;
        }
        .related-products-section .product-img-action-wrap {
            height: 130px !important;
            padding: 10px !important;
        }
        .related-products-section .product-content-wrap {
            padding: 10px 12px !important;
        }
        .related-products-section .product-content-wrap h2 {
            font-size: 13px !important;
            margin-bottom: 4px !important;
            line-height: 1.3 !important;
            height: 34px !important;
            overflow: hidden !important;
        }
        .related-products-section .product-content-wrap .product-price span {
            font-size: 14px !important;
        }
        .related-products-section .product-content-wrap .product-price span.old-price {
            font-size: 11px !important;
            margin-left: 4px !important;
        }
        .related-products-section .product-card-bottom .add-cart a {
            padding: 4px 8px !important;
            font-size: 11px !important;
            border-radius: 4px !important;
        }
        .related-products-section {
            margin-left: -6px !important;
            margin-right: -6px !important;
        }
        .related-products-section > div[class*="col-"] {
            padding-left: 6px !important;
            padding-right: 6px !important;
        }
    }
    
    /* Mobile Responsive Optimizations for Details Page */
    @media (max-width: 768px) {
        .premium-details-container .product-price-cover {
            padding: 12px 16px !important;
            border-radius: 12px !important;
            margin-bottom: 15px !important;
            background: rgba(59, 183, 126, 0.04) !important;
            border-color: rgba(59, 183, 126, 0.15) !important;
            display: inline-flex !important;
            align-items: center !important;
            width: auto !important;
        }
        .premium-details-container .product-price .current-price {
            font-size: 26px !important;
        }
        .premium-details-container .product-price .old-price {
            font-size: 15px !important;
            margin-left: 10px !important;
        }
        .premium-details-container .product-price .save-price {
            font-size: 11px !important;
            padding: 3px 8px !important;
            margin-left: 10px !important;
        }
        .premium-details-container .detail-info {
            padding-left: 0 !important;
            padding-right: 0 !important;
            margin-top: 25px !important;
        }
        .premium-details-container h2.title-detail {
            font-size: 24px !important;
            margin-bottom: 12px !important;
        }
        .premium-details-container .product-detail {
            padding: 15px !important;
            margin-top: 10px !important;
        }
        .premium-details-container .product-detail .row.mb-50.mt-30 {
            margin-top: 0 !important;
            margin-bottom: 20px !important;
        }
    }
</style>

<div class="page-header breadcrumb-wrap">
   <div class="container">
      <div class="breadcrumb">
         <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
         <span></span> <a href="{{ url('product/category/'.$cat_id.'/'.$product['category']['category_slug']) }}">{{ $product->category->category_name }}</a> <span></span> {{ $product->subcategory->subcategory_name }} <span></span>{{ $product->product_name }}
      </div>
   </div>
</div>
<div class="container mb-30 premium-details-container">
   <div class="row">
      <div class="col-xl-10 col-lg-12 m-auto">
         <div class="product-detail accordion-detail">
            <div class="row mb-50 mt-30">
               <div class="col-md-5 col-12">
                {{-- <div class="col-md-4 col-sm-9 col-6 col-xs-12 mb-md-0 mb-sm-5"> --}}
                  <div class="detail-gallery">
                     {{-- <span class="zoom-icon"><i class="fi-rs-search"></i></span> --}}
                     <!-- MAIN SLIDES -->
                     <div class="product-image-slider">
                        @if($multiImage->isEmpty())
                        <figure class="border-radius-10">
                           <img src="{{ asset($product->product_thumbnail) }}" alt="product image" />
                        </figure>
                        @else
                        @foreach($multiImage as $img)
                        <figure class="border-radius-10">
                           <img src="{{ asset($img->photo_name) }} " alt="product image" />
                        </figure>
                        @endforeach
                        @endif
                     </div>
                     <!-- THUMBNAILS -->
                     <div class="slider-nav-thumbnails mb-30">
                        @if($multiImage->isEmpty())
                        <div><img src="{{ asset($product->product_thumbnail) }}" alt="product image" /></div>
                        @else
                        @foreach($multiImage as $img)
                        <div><img src="{{ asset($img->photo_name) }}" alt="product image" /></div>
                        @endforeach
                        @endif
                     </div>
                     {{-- <hr> --}}
                     <div class="font-xs">
                        <ul class="mr-50 float-start">
                           <li class="mb-5">Brand: <span class="text-brand">{{ $product->brand->brand_name }}</span></li>
                           <li class="mb-5">Category:<span class="text-brand"> {{ $product->category->category_name }}</span></li>
                           <li>SubCategory: <span class="text-brand">{{ $product->subcategory->subcategory_name }}</span></li>
                        </ul>
                        <ul class="float-start">
                           <li class="mb-5">Product Code: <a href="#">{{ $product->product_code }}</a></li>
                           <li class="mb-5">Tags: <a href="#" rel="tag"> {{ $product->product_tags }}</a></li>
                           {{-- <li>Stock:<span class="in-stock text-brand ml-5">({{ $product->product_qty }}) Items In Stock</span></li> --}}
                        </ul>
                     </div>
                  </div>
                  <!-- End Gallery -->
               </div>

               <div class="col-md-7 col-12">
               {{-- <div class="col-md-8 col-sm-12 col-6 col-xs-12"> --}}
                  <div class="detail-info pr-30 pl-30">
                     @if($total_stock > 0)
                     {{-- @if($product->product_qty > 0) --}}
                     <span class="stock-status in-stock">
                        Available in stock
                        <span class="total-qty-stock">
                           <p class="in-stock text-brand">Total Qty: ({{ $total_stock }})</p>
                        </span>
                        {{-- <p class="in-stock text-brand">Qty: ({{ $product->product_qty }})</p> --}}
                     </span>
                     @else
                     <span class="stock-status out-stock">
                        Stock Out
                        <p class="in-stock text-brand"></p>
                        <p class="in-stock text-brand">Call for supplies: 0548795583 / 0555700931</p>
                     </span>
                     @endif

                     <h2 class="title-detail" id="dpname"> {{ $product->product_name }} </h2>
                     @php
                     $reviewcount = App\Models\Review::where('product_id', $product->id)->where('status', 1)->latest()->get();
                     $average = App\Models\Review::where('product_id',$product->id)->where('status', 1)->avg('rating');
                     @endphp
                     {{-- <div class="product-detail-rating">
                        <div class="product-rate-cover text-end">

                           <div class="product-rate d-inline-block">
                              @if($average == 0)
                              @elseif($average == 1 || $average < 2)
                              <div class="product-rating" style="width: 20%"></div>
                              @elseif($average == 2 || $average < 3)
                              <div class="product-rating" style="width: 40%"></div>
                              @elseif($average == 3 || $average < 4)
                              <div class="product-rating" style="width: 60%"></div>
                              @elseif($average == 4 || $average < 5)
                              <div class="product-rating" style="width: 80%"></div>
                              @elseif($average == 5 || $average < 5)
                              <div class="product-rating" style="width: 100%"></div>
                              @endif
                           </div>
                           <span class="font-small ml-5 text-muted"> ({{ count($reviewcount)}} reviews)</span>
                        </div>
                     </div> --}}
                     <div class="clearfix product-price-cover">
                        {{-- @php
                        $amount = $product->selling_price - $product->discount_price;
                        $discount = ($amount/$product->selling_price) * 100;
                        @endphp --}}
                        @php
                        $amount = (100 - $product->discount_price)/100;
                        $new_price = $amount * $product->selling_price;
                        @endphp

                        <span class="get_attribute_price">
                           @if($product->discount_price == NULL)
                           <div class="product-price primary-color float-left">
                              <span class="current-price text-brand" id="detail-current-price" data-base-price="{{ $product->selling_price }}">Gh {{ number_format($product->selling_price, 2) }}</span>
                           </div>
                           @else
                           <div class="product-price primary-color float-left">
                              <span class="current-price text-brand" id="detail-current-price" data-base-price="{{ $new_price }}">Gh {{ number_format($new_price, 2) }}</span>
                              <span>
                              <span class="save-price font-md color3 ml-20">{{ round($product->discount_price) }}% Off</span>
                              <span class="old-price font-md ml-20" id="detail-old-price" data-base-price="{{ $product->selling_price }}">Gh {{ number_format($product->selling_price, 2) }}</span>
                              </span>
                           </div>
                           @endif
                        </span>

                     </div>
                     <div class="short-desc mb-10">
                        <p class="font-lg"> {{ $product->short_descp }}</p>
                     </div>
                     {{-- @if($product->product_size == NULL)
                     <div></div>
                     @else --}}
                     {{-- <div class="attr-detail attr-size mb-10">
                        <strong class="mr-10 d-none d-lg-block" style="width:50px;">Size : </strong>
                        <select class="form-control unicase-form-control" id="dsize">
                           <option selected="" disabled="">--Choose Size--</option>
                           @foreach($product_size as $size)
                           <option value="{{ $size }}">{{ ucwords($size)  }}</option>
                           @endforeach
                        </select>
                     </div> --}}
                     <div class="attr-detail attr-size mb-10">
                        <strong class="mr-10 d-none d-lg-block" style="width:50px;">Size : </strong>
                        <select name="size" id="getPrice" product-id="{{ $product['id'] }}" class="form-control unicase-form-control dsize" @if($total_stock <= 0) disabled style="opacity: 0.5; cursor: not-allowed;" @endif>
                           <option selected="" disabled=""> --select size-- </option>
                           @foreach($product['attributes'] as $attribute)
                            <option value="{{ $attribute['size'] }}">{{ $attribute['size']  }}</option>
                           @endforeach
                        </select>
                     </div>

                     {{-- <div class="sizes u-s-m-b-11 mt-3">
                        <span>Available Size:</span>
                        <div class="size-variant select-box-wrapper">
                           <select name="size" id="getPrice" product-id="{{ $product_details['id'] }}" class="select-box product-size" required>
                              <option value="">Select size</option>
                              @foreach ($product_details['attributes'] as $attribute )
                                 <option value="{{ $attribute['size'] }}">{{ $attribute['size'] }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div> --}}
                     {{-- @endif --}}
                      @if($product->product_color == "" || strtolower(trim($product->product_color)) == 'none')
                      <div></div>
                      @else
                      <div class="attr-detail attr-size mb-20">
                         <strong class="mr-10 d-none d-lg-block" style="width:50px;">Variant: </strong>
                         <select class="form-control unicase-form-control" id="dcolor" @if($total_stock <= 0) disabled style="opacity: 0.5; cursor: not-allowed;" @endif>
                            <option selected="" disabled=""> --select variant-- </option>
                            @foreach($product_color as $color)
                            @if(strtolower(trim($color)) !== 'none')
                            <option value="{{ $color }}">{{ ucwords($color) }}</option>
                            @endif
                            @endforeach
                         </select>
                      </div>
                      @endif

                     <div class="detail-extralink mt-30 mb-30">
                        <div class="detail-qty border radius" @if($total_stock <= 0) style="opacity: 0.5; pointer-events: none;" @endif>
                           <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                           <input type="text" name="quantity" id="dqty" class="qty-val" value="{{ $total_stock > 0 ? 1 : 0 }}" min="{{ $total_stock > 0 ? 1 : 0 }}" max="{{ $total_stock }}" data-stock="{{ $total_stock }}" @if($total_stock <= 0) disabled readonly @endif>
                           <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                        </div>
                        <div class="qty-stock"></div>

                        {{-- Mobile --}}
                        <div class="product-extra-link2 d-block d-lg-none">
                           <input type="hidden" id="dproduct_id" value="{{ $product->id }}">
                           <input type="hidden" id="vproduct_id" value="{{ $product->vendor_id }}">
                           <button type="submit" class="button button-add-to-cart" onclick="addToCartDetails()" @if($total_stock <= 0) disabled style="opacity: 0.5; cursor: not-allowed;" @endif><i class="fi-rs-shopping-cart"></i> &nbsp;{{ $total_stock > 0 ? 'Add' : 'Out of Stock' }}</button>&nbsp;&nbsp;
                           <a aria-label="Add To Wishlist" class="action-btn hover-up" id="{{ $product->id }}" onclick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>
                           {{-- <a aria-label="Compare" class="action-btn hover-up" id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>                            --}}
                        </div>

                        {{-- Large screen --}}
                        <div class="product-extra-link2 d-none d-lg-block">
                           <input type="hidden" id="dproduct_id" value="{{ $product->id }}">
                           <input type="hidden" id="vproduct_id" value="{{ $product->vendor_id }}">
                           <button type="submit" class="button button-add-to-cart" onclick="addToCartDetails()" @if($total_stock <= 0) disabled style="opacity: 0.5; cursor: not-allowed;" @endif><i class="fi-rs-shopping-cart"></i>{{ $total_stock > 0 ? 'Add to cart' : 'Out of Stock' }}</button>
                           {{-- <a aria-label="Add To Wishlist" class="action-btn hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a> --}}
                           <a aria-label="Add To Wishlist" class="action-btn hover-up" id="{{ $product->id }}" onclick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>
                           <a aria-label="Compare" class="action-btn hover-up" id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                           {{-- <a aria-label="Compare" class="action-btn hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a> --}}
                        </div>
                     </div>
                     {{-- @if($product->vendor_id == NULL)
                     <h6> Sold By <a href="#"> <span class="text-danger"> Owner </span> </a></h6>
                     @else
                     <h6> Sold By <a href="#"> <span class="text-danger"> {{ $product['vendor']['name'] }} </span></a></h6>
                     @endif --}}
                     {{--
                     <hr>
                     <div class="font-xs">
                        <ul class="mr-50 float-start">
                           <li class="mb-5">Brand: <span class="text-brand">{{ $product->brand->brand_name }}</span></li>
                           <li class="mb-5">Category:<span class="text-brand"> {{ $product->category->category_name }}</span></li>
                           <li>SubCategory: <span class="text-brand">{{ $product->subcategory->subcategory_name }}</span></li>
                        </ul>
                        <ul class="float-start">
                           <li class="mb-5">Product Code: <a href="#">{{ $product->product_code }}</a></li>
                           <li class="mb-5">Tags: <a href="#" rel="tag"> {{ $product->product_tags }}</a></li>
                           <li>Stock:<span class="in-stock text-brand ml-5">({{ $product->product_qty }}) Items In Stock</span></li>
                        </ul>
                     </div>
                     --}}
                  </div>
                  <!-- Detail Info -->
               </div>
            </div>

            {{-- Reviews --}}
            <div class="product-info">
               <div class="tab-style3">
                  <ul class="nav nav-tabs text-uppercase">
                     <li class="nav-item">
                        <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                     </li>
                     {{--
                     <li class="nav-item">
                        <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">Additional info</a>
                     </li>
                     --}}
                     {{--
                     <li class="nav-item">
                        <a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab" href="#Vendor-info">Vendor</a>
                     </li>
                     --}}
                     {{-- <li class="nav-item">
                        <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews ({{ count($reviewcount) }})</a>
                     </li> --}}
                  </ul>
                  <div class="tab-content shop_info_tab entry-main-content">
                     <div class="tab-pane fade show active" id="Description">
                        <div class="">
                           <p> {!! $product->long_descp !!} </p>
                        </div>
                     </div>
                     {{-- <div class="tab-pane fade" id="Additional-info">
                        <table class="font-md">
                           <tbody>
                              <tr class="stand-up">
                                 <th>Stand Up</th>
                                 <td>
                                    <p>35″L x 24″W x 37-45″H(front to back wheel)</p>
                                 </td>
                              </tr>
                              <tr class="folded-wo-wheels">
                                 <th>Folded (w/o wheels)</th>
                                 <td>
                                    <p>32.5″L x 18.5″W x 16.5″H</p>
                                 </td>
                              </tr>
                              <tr class="folded-w-wheels">
                                 <th>Folded (w/ wheels)</th>
                                 <td>
                                    <p>32.5″L x 24″W x 18.5″H</p>
                                 </td>
                              </tr>
                              <tr class="door-pass-through">
                                 <th>Door Pass Through</th>
                                 <td>
                                    <p>24</p>
                                 </td>
                              </tr>
                              <tr class="frame">
                                 <th>Frame</th>
                                 <td>
                                    <p>Aluminum</p>
                                 </td>
                              </tr>
                              <tr class="weight-wo-wheels">
                                 <th>Weight (w/o wheels)</th>
                                 <td>
                                    <p>20 LBS</p>
                                 </td>
                              </tr>
                              <tr class="weight-capacity">
                                 <th>Weight Capacity</th>
                                 <td>
                                    <p>60 LBS</p>
                                 </td>
                              </tr>
                              <tr class="width">
                                 <th>Width</th>
                                 <td>
                                    <p>24″</p>
                                 </td>
                              </tr>
                              <tr class="handle-height-ground-to-handle">
                                 <th>Handle height (ground to handle)</th>
                                 <td>
                                    <p>37-45″</p>
                                 </td>
                              </tr>
                              <tr class="wheels">
                                 <th>Wheels</th>
                                 <td>
                                    <p>12″ air / wide track slick tread</p>
                                 </td>
                              </tr>
                              <tr class="seat-back-height">
                                 <th>Seat back height</th>
                                 <td>
                                    <p>21.5″</p>
                                 </td>
                              </tr>
                              <tr class="head-room-inside-canopy">
                                 <th>Head room (inside canopy)</th>
                                 <td>
                                    <p>25″</p>
                                 </td>
                              </tr>
                              <tr class="pa_color">
                                 <th>Color</th>
                                 <td>
                                    <p>Black, Blue, Red, White</p>
                                 </td>
                              </tr>
                              <tr class="pa_size">
                                 <th>Size</th>
                                 <td>
                                    <p>M, S</p>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div> --}}
                     {{-- <div class="tab-pane fade" id="Vendor-info">
                        <div class="vendor-logo d-flex mb-30">
                           <img src="{{ (!empty($product->vendor->photo)) ? url('back/assets/images/vendor/'.$product->vendor->photo):url('back/assets/images/vendor/no_image.jpg') }}" alt="" />
                           <div class="vendor-name ml-15">
                              @if($product->vendor_id == NULL)
                              <h6><a href="vendor-details-2.html">Owner</a></h6>
                              @else
                              <h6><a href="vendor-details-2.html">{{ $product->vendor->name }}</a></h6>
                              @endif
                              <div class="product-rate-cover text-end">
                                 <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                 </div>
                                 <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                              </div>
                           </div>
                        </div>
                        @if($product->vendor_id == NULL)
                        <ul class="contact-infor mb-50">
                           <li><img src="{{ asset('front/assets/imgs/theme/icons/icon-location.svg') }}" alt="" /><strong>Address: </strong> <span>Owner</span></li>
                           <li><img src="{{ asset('front/assets/imgs/theme/icons/icon-contact.svg') }}" alt="" /><strong>Contact Seller: </strong><span>Owner</span></li>
                        </ul>
                        @else
                        <ul class="contact-infor mb-50">
                           <li><img src="{{ asset('front/assets/imgs/theme/icons/icon-location.svg') }}" alt="" /><strong>Address: </strong> <span>{{ $product['vendor']['address'] }}</span></li>
                           <li><img src="{{ asset('front/assets/imgs/theme/icons/icon-contact.svg') }}" alt="" /><strong>Contact Seller: </strong><span>{{ $product['vendor']['phone'] }}</span></li>
                        </ul>
                        @endif
                        @if($product->vendor_id == NULL)
                        <p>Owner Information</p>
                        @else
                        <p>{{ $product['vendor']['vendor_shop_info'] }}</p>
                        @endif
                     </div> --}}
                     {{-- Reviews --}}
                     {{-- <div class="tab-pane fade" id="Reviews">
                        <div class="comments-area">
                           <div class="row">
                              <div class="col-lg-8">
                                 <h4 class="mb-30">Customer questions & answers</h4>
                                 <div class="comment-list">
                                    @php
                                    $reviews = App\Models\Review::where('product_id', $product->id)->latest()->limit(5)->get();
                                    @endphp
                                    @foreach($reviews as $item)
                                    @if($item->status == 0)
                                    @else
                                    <div class="single-comment justify-content-between d-flex mb-30">
                                       <div class="user justify-content-between d-flex">
                                          <div class="thumb text-center">
                                             <img src="{{ (!empty($item->user->photo)) ? url('front/assets/imgs/users/'.$item->user->photo):url('front/assets/imgs/users/no_image.jpg') }}" alt="" />
                                             <a href="#" class="font-heading text-brand">{{ $item->user->name }}</a>
                                          </div>
                                          <div class="desc">
                                             <div class="d-flex justify-content-between mb-10">
                                                <div class="d-flex align-items-center">
                                                   <span class="font-xs text-muted"> {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }} </span>
                                                </div>
                                                <div class="product-rate d-inline-block">
                                                   @if($item->rating == NULL)
                                                   @elseif($item->rating == 1)
                                                   <div class="product-rating" style="width: 20%"></div>
                                                   @elseif($item->rating == 2)
                                                   <div class="product-rating" style="width: 40%"></div>
                                                   @elseif($item->rating == 3)
                                                   <div class="product-rating" style="width: 60%"></div>
                                                   @elseif($item->rating == 4)
                                                   <div class="product-rating" style="width: 80%"></div>
                                                   @elseif($item->rating == 5)
                                                   <div class="product-rating" style="width: 100%"></div>
                                                   @endif
                                                </div>
                                             </div>
                                             <p class="mb-10">{{ $item->comment }} <a href="#" class="reply">Reply</a></p>
                                          </div>
                                       </div>
                                    </div>
                                    @endif
                                    @endforeach
                                 </div>
                              </div>
                              <div class="col-lg-4">
                                 <h4 class="mb-30">Customer reviews</h4>
                                 <div class="d-flex mb-30">
                                    <div class="product-rate d-inline-block mr-15">
                                       <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <h6>4.8 out of 5</h6>
                                 </div>
                                 <div class="progress">
                                    <span>5 star</span>
                                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                 </div>
                                 <div class="progress">
                                    <span>4 star</span>
                                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                 </div>
                                 <div class="progress">
                                    <span>3 star</span>
                                    <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                                 </div>
                                 <div class="progress">
                                    <span>2 star</span>
                                    <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
                                 </div>
                                 <div class="progress mb-30">
                                    <span>1 star</span>
                                    <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                 </div>
                                 <a href="#" class="font-xs text-muted">How are ratings calculated?</a>
                              </div>
                           </div>
                        </div>
                        <div class="comment-form">
                           <h4 class="mb-15">Add a review</h4>
                           @guest
                           <p> <b>For Add Product Review. You Need To Login First <a href="{{ route('login')}}">Login Here </a> </b></p>
                           @else
                           <div class="row">
                              <div class="col-lg-8 col-md-12">
                                 <form class="form-contact comment_form" action="{{ route('store.review') }}" method="post" id="commentForm">
                                    @csrf
                                    <div class="row">
                                       <input type="hidden" name="product_id" value="{{ $product->id }}">
                                       @if($product->vendor_id == NULL)
                                       <input type="hidden" name="hvendor_id" value="">
                                       @else
                                       <input type="hidden" name="hvendor_id" value="{{ $product->vendor_id }}">
                                       @endif
                                       <table class="table" style=" width: 60%;">
                                          <thead>
                                             <tr>
                                                <th class="cell-level">&nbsp;</th>
                                                <th>1 star</th>
                                                <th>2 star</th>
                                                <th>3 star</th>
                                                <th>4 star</th>
                                                <th>5 star</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr>
                                                <td class="cell-level">Quality</td>
                                                <td><input type="radio" name="quality" class="radio-sm" value="1"></td>
                                                <td><input type="radio" name="quality" class="radio-sm" value="2"></td>
                                                <td><input type="radio" name="quality" class="radio-sm" value="3"></td>
                                                <td><input type="radio" name="quality" class="radio-sm" value="4"></td>
                                                <td><input type="radio" name="quality" class="radio-sm" value="5"></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                       <div class="col-12">
                                          <div class="form-group">
                                             <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <button type="submit" class="button button-contactForm">Submit Review</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                           @endguest
                        </div>
                     </div> --}}
                  </div>
               </div>
            </div>

            {{-- Related products --}}
            <div class="row mt-60">
               <div class="col-12">
                  <h2 class="section-title style-1 mb-30">Related products</h2>
               </div>
               <div class="col-12">
                  <div class="row related-products related-products-section">
                     @foreach($relatedProduct as $product)
                     <div class="col-lg-3 col-md-4 col-6 col-sm-6 mb-30">
                        <div class="product-cart-wrap hover-up">
                           <div class="product-img-action-wrap">
                              <div class="product-img product-img-zoom">
                                 <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}" tabindex="0">
                                 <img class="default-img" src="{{ asset( $product->product_thumbnail ) }}" alt="" />
                                 </a>
                              </div>
                              <div class="product-action-1">
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
                              <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}" tabindex="0">{{ $product->product_name }}</a></h2>
                              <div class="product-action-1-mobile d-block d-lg-none">
                                 <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>
                                 {{-- <a aria-label="Compare" class="action-btn" id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>                            --}}
                                 <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                              </div>
                              {{-- @php
                              $reviewcount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                              $average = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                              @endphp
                              <div class="product-rate-cover">
                                 <div class="product-rate d-inline-block">
                                    @if($average == 0)
                                    @elseif($average == 1 || $average < 2)
                                    <div class="product-rating" style="width: 20%"></div>
                                    @elseif($average == 2 || $average < 3)
                                    <div class="product-rating" style="width: 40%"></div>
                                    @elseif($average == 3 || $average < 4)
                                    <div class="product-rating" style="width: 60%"></div>
                                    @elseif($average == 4 || $average < 5)
                                    <div class="product-rating" style="width: 80%"></div>
                                    @elseif($average == 5 || $average < 5)
                                    <div class="product-rating" style="width: 100%"></div>
                                    @endif
                                 </div>
                                 <span class="font-small ml-5 text-muted"> ({{count($reviewcount)}})</span>
                              </div> --}}
                              {{--
                              <div>
                                 @if($product->vendor_id == NULL)
                                 <span class="font-small text-muted">By <a href="vendor-details-1.html">Owner</a></span>
                                 @else
                                 <span class="font-small text-muted">By <a href="vendor-details-1.html">{{ $product['vendor']['name'] }}</a></span>
                                 @endif
                              </div>
                              --}}
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
                                    <span>Gh {{ number_format($new_price, 2) }}</span>
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
                     @endforeach
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
