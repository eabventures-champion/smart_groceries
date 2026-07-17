@extends('front.master')
@section('content')
@section('title')
 Shop Page
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}


<div class="page-header breadcrumb-wrap">
   <div class="container">
      <div class="breadcrumb">
         <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
         <span></span> Shop Page
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

                                       <div class="list-group premium-filter-widget">
               <div class="list-group-item mt-20">

                   @if (!empty($_GET['category']))
                   @php
                    $filter_category = explode(',', $_GET['category']);
                   @endphp
                   @endif

                   <h5 class="section-title style-1 mb-15">Category</h5>
                   <div class="filter-scroll-list">
                       @foreach($categories as $category)
                           @php
                           $products_mobile = App\Models\Product::where('category_id',$category->id)->get();
                           @endphp
                           <label class="premium-custom-checkbox">
                               <input class="form-check-input filter-input" type="checkbox" name="category[]" id="exampleCheckbox_mobile{{ $category->id }}" value="{{ $category->category_slug }}"
                               @if(!empty($filter_category) && in_array($category->category_slug, $filter_category))
                               checked
                               @endif
                               />
                               <span class="checkmark"></span>
                               <span class="form-check-label">{{ $category->category_name }} <span class="count-badge">({{ count($products_mobile) }})</span></span>
                           </label>
                       @endforeach
                   </div>

                   @if (!empty($_GET['brand']))
                   @php
                    $filter_brand = explode(',', $_GET['brand']);
                   @endphp
                   @endif

                   <h5 class="section-title style-1 mb-15 mt-20">Brand</h5>
                   <div class="filter-scroll-list">
                       @foreach($brands as $brand)
                           <label class="premium-custom-checkbox">
                               <input class="form-check-input filter-input" type="checkbox" name="brand[]" id="exampleBrand_mobile{{ $brand->id }}" value="{{ $brand->brand_slug }}"
                               @if(!empty($filter_brand) && in_array($brand->brand_slug, $filter_brand))
                               checked
                               @endif
                               />
                               <span class="checkmark"></span>
                               <span class="form-check-label">{{ $brand->brand_name }}</span>
                           </label>
                       @endforeach
                   </div>
                   
                   <button type="button" class="btn-reset-filter" onclick="resetFilters()"><i class="fi fi-rs-refresh"></i> Reset Filters</button>
               </div>
             </div>

         </form>
      </div>
   </ul>
 </div>

<div class="container mb-30">
   <div class="row flex-row-reverse">

                  {{-- Items found --}}
      <div class="col-lg-9" id="shop-product-container">
         @include('front.product.shop_grid_partial')
      </div>

      {{-- Filter sidebar widgets --}}
      <div class="col-lg-3 primary-sidebar sticky-sidebar d-none d-lg-block">
         @php
            $filter_category = [];
            if (!empty($_GET['category'])) {
                $filter_category = explode(',', $_GET['category']);
            }
            $filter_brand = [];
            if (!empty($_GET['brand'])) {
                $filter_brand = explode(',', $_GET['brand']);
            }
         @endphp

                   <!-- Category Filter Widget -->
          <div class="sidebar-widget price_range range mb-30 premium-filter-widget" style="margin-top: 30px !important;">
            <h5 class="section-title style-1 mb-30 collapsible-widget-title" style="cursor: pointer;">Category<i class="fi-rs-angle-down toggle-icon" style="float: right; transition: transform 0.3s ease;"></i></h5>
            <div class="collapsible-widget-content">
                <div class="filter-scroll-list">
                    @foreach($categories as $category)
                        @php
                        $products = App\Models\Product::where('category_id',$category->id)->get();
                        @endphp
                        <label class="premium-custom-checkbox">
                            <input class="form-check-input filter-input" type="checkbox" name="category[]" id="exampleCheckbox{{ $category->id }}" value="{{ $category->category_slug }}"
                            @if(!empty($filter_category) && in_array($category->category_slug, $filter_category))
                            checked
                            @endif
                            />
                            <span class="checkmark"></span>
                            <span class="form-check-label">{{ $category->category_name }} <span class="count-badge">({{ count($products) }})</span></span>
                        </label>
                    @endforeach
                </div>
            </div>
         </div>

         <!-- Brand Filter Widget (Minimised by default) -->
         <div class="sidebar-widget price_range range mb-30 premium-filter-widget widget-collapsed">
            <h5 class="section-title style-1 mb-30 collapsible-widget-title" style="cursor: pointer;">Brand<i class="fi-rs-angle-down toggle-icon" style="float: right; transition: transform 0.3s ease;"></i></h5>
            <div class="collapsible-widget-content" style="display: none;">
                <div class="filter-scroll-list">
                    @foreach($brands as $brand)
                        <label class="premium-custom-checkbox">
                            <input class="form-check-input filter-input" type="checkbox" name="brand[]" id="exampleBrand{{ $brand->id }}" value="{{ $brand->brand_slug }}"
                            @if(!empty($filter_brand) && in_array($brand->brand_slug, $filter_brand))
                            checked
                            @endif
                            />
                            <span class="checkmark"></span>
                            <span class="form-check-label">{{ $brand->brand_name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
         </div>

                  <!-- Spacing element -->
         <div class="mb-30"></div>

                           <!-- Product sidebar Widget -->
         <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10 widget-collapsed">
            <h5 class="section-title style-1 mb-30 collapsible-widget-title">New products<i class="fi-rs-angle-down toggle-icon"></i></h5>
            <div class="collapsible-widget-content" style="display: none;">
               @foreach($newProduct as $product)

               @php
               $amount = (100 - $product->discount_price)/100;
               $new_price = $amount * $product->selling_price;
               @endphp

               <div class="premium-product-item">
                  <div class="img-container">
                     <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                        <img src="{{ asset($product->product_thumbnail) }}" alt="" />
                     </a>
                  </div>
                  <div class="content pt-0">
                     <h6 class="title"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ $product->product_name }}</a></h6>
                     @if($product->discount_price == NULL)
                     <span class="price">Gh {{ number_format($product->selling_price, 2) }}</span>
                     @else
                     <div class="price-container">
                        <span class="price">Gh {{ number_format($new_price, 2) }}</span>
                        <span class="old-price">Gh {{ number_format($product->selling_price, 2) }}</span>
                     </div>
                     @endif
                  </div>
               </div>
               @endforeach
            </div>
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

            window.applyFilters = function(page = 1) {
         var $container = $('#shop-product-container');
         if ($container.find('.shop-overlay-loader').length === 0) {
            $container.css('position', 'relative');
            $container.append('<div class="shop-overlay-loader"><div class="shop-spinner"></div></div>');
         }

         var categories = [];
         $('input[name="category[]"]:checked').each(function() {
            var val = $(this).val();
            if (categories.indexOf(val) === -1) {
               categories.push(val);
            }
         });

         var brands = [];
         $('input[name="brand[]"]:checked').each(function() {
            var val = $(this).val();
            if (brands.indexOf(val) === -1) {
               brands.push(val);
            }
         });

         var params = {};
         if (categories.length > 0) {
            params.category = categories.join(',');
         }
         if (brands.length > 0) {
            params.brand = brands.join(',');
         }
         if (page > 1) {
            params.page = page;
         }

         $.ajax({
            url: "{{ route('shop.page') }}",
            type: 'GET',
            data: params,
            success: function(response) {
               $container.html(response);
               
               var queryString = $.param(params);
               var newUrl = "{{ route('shop.page') }}" + (queryString ? '?' + queryString : '');
               history.pushState(null, '', newUrl);
            },
            error: function(xhr) {
               console.error(xhr);
               $container.find('.shop-overlay-loader').remove();
            }
         });
      }
      window.applyFilters = function(page = 1) {
         var $container = $('#shop-product-container');
         if ($container.find('.shop-overlay-loader').length === 0) {
            $container.css('position', 'relative');
            $container.append('<div class="shop-overlay-loader"><div class="shop-spinner"></div></div>');
         }

         var categories = [];
         $('input[name="category[]"]:checked').each(function() {
            var val = $(this).val();
            if (categories.indexOf(val) === -1) {
               categories.push(val);
            }
         });

         var brands = [];
         $('input[name="brand[]"]:checked').each(function() {
            var val = $(this).val();
            if (brands.indexOf(val) === -1) {
               brands.push(val);
            }
         });

         var params = {};
         if (categories.length > 0) {
            params.category = categories.join(',');
         }
         if (brands.length > 0) {
            params.brand = brands.join(',');
         }
         if (page > 1) {
            params.page = page;
         }

         var ajaxParams = $.extend({ ajax: 1 }, params);

         $.ajax({
            url: "{{ route('shop.page') }}",
            type: 'GET',
            data: ajaxParams,
            success: function(response) {
               // Defensive check to verify if the response is actually the full page layout
               if (response.indexOf('<!DOCTYPE html>') !== -1 || response.indexOf('<html') !== -1 || response.indexOf('id="preloader-active"') !== -1) {
                  var $temp = $('<div>').html(response);
                  var partialHtml = $temp.find('#shop-product-container').html();
                  if (partialHtml) {
                     $container.html(partialHtml);
                  } else {
                     window.location.reload();
                  }
               } else {
                  $container.html(response);
               }
               
               var queryString = $.param(params);
               var newUrl = "{{ route('shop.page') }}" + (queryString ? '?' + queryString : '');
               history.pushState(null, '', newUrl);
            },
            error: function(xhr) {
               console.error(xhr);
               $container.find('.shop-overlay-loader').remove();
            }
         });
      }

      window.resetFilters = function() {
         $('.filter-input').prop('checked', false);
         window.applyFilters(1);
      }

      $(document).on('change', '.filter-input', function() {
         var val = $(this).val();
         var name = $(this).attr('name');
         var isChecked = $(this).prop('checked');
         
         $('input[name="' + name + '"][value="' + val + '"]').not(this).prop('checked', isChecked);
         window.applyFilters(1);
      });

            $(document).on('click', '#shop-product-container .pagination-area a', function(e) {
         e.preventDefault();
         var url = $(this).attr('href');
         if (url) {
            var page = 1;
            var match = url.match(/page=(\d+)/);
            if (match) {
               page = match[1];
            }
            window.applyFilters(page);
            $('html, body').animate({ scrollTop: $('#shop-product-container').offset().top - 100 }, 300);
         }
      });
   });
</script>
@endsection
