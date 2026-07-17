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

@php
$filter_category = !empty($_GET['category']) ? explode(',', $_GET['category']) : [$breadsubcat->category->category_slug];
$filter_brand = !empty($_GET['brand']) ? explode(',', $_GET['brand']) : [];
@endphp

<div class="container btn-group dropend d-block d-lg-none">
   <button type="button" class="btn btn-sm btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fi fi-br-settings-sliders"></i>&nbsp; Filter
   </button>
   <ul class="dropdown-menu" style="padding: .5rem 1.5rem !important; min-width: 15rem;">
      <div class="list-group premium-filter-widget">
         <div class="list-group-item mt-20">
            <h5 class="section-title style-1 mb-15">Category</h5>
            <div class="filter-scroll-list">
               @php
               $parent_cat = $breadsubcat->category;
               $parent_products_mobile = App\Models\Product::where('category_id', $parent_cat->id)->get();
               @endphp
               <label class="premium-custom-checkbox parent-category-checkbox">
                   <input class="form-check-input filter-input" type="checkbox" name="category[]" id="exampleCheckbox_mobile{{ $parent_cat->id }}" value="{{ $parent_cat->category_slug }}"
                   @if(!empty($filter_category) && in_array($parent_cat->category_slug, $filter_category))
                   checked
                   @endif
                   />
                   <span class="checkmark"></span>
                   <span class="form-check-label" style="font-weight: 700;">{{ $parent_cat->category_name }} <span class="count-badge">({{ count($parent_products_mobile) }})</span></span>
               </label>
               
               <!-- Subcategories List -->
               <div class="subcategory-filter-list" style="margin-left: 22px; margin-top: 10px; border-left: 2px solid #e2e8f0; padding-left: 12px; display: flex; flex-direction: column; gap: 8px;">
                  @php
                  $subcategories = App\Models\SubCategory::where('category_id', $parent_cat->id)->orderBy('subcategory_name', 'ASC')->get();
                  @endphp
                  @foreach($subcategories as $subcat)
                     @php
                     $subcat_products = App\Models\Product::where('subcategory_id', $subcat->id)->where('status', 1)->get();
                     @endphp
                     @if(count($subcat_products) > 0)
                        <label class="premium-custom-checkbox" style="margin-bottom: 0;">
                            <input class="form-check-input filter-input subcategory-filter-input" type="checkbox" name="subcategory[]" id="exampleSubCheckbox_mobile{{ $subcat->id }}" value="{{ $subcat->subcategory_slug }}"
                            @if($subcat->id == $breadsubcat->id || (!empty($filter_subcategory) && in_array($subcat->subcategory_slug, $filter_subcategory)))
                            checked
                            @endif
                            />
                            <span class="checkmark"></span>
                            <span class="form-check-label" style="font-size: 13px;">{{ $subcat->subcategory_name }} <span class="count-badge">({{ count($subcat_products) }})</span></span>
                        </label>
                     @endif
                  @endforeach
               </div>
            </div>

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
   </ul>
</div>

<div class="container mb-30">
   <div class="row flex-row-reverse">
      <div class="col-lg-9" id="shop-product-container">
         @include('front.product.shop_grid_partial')
      </div>

      <div class="col-lg-3 primary-sidebar sticky-sidebar d-none d-lg-block">
         <!-- Category Filter Widget -->
         <div class="sidebar-widget price_range range mb-30 premium-filter-widget" style="margin-top: 30px !important;">
            <h5 class="section-title style-1 mb-30 collapsible-widget-title" style="cursor: pointer;">Category<i class="fi-rs-angle-down toggle-icon" style="float: right; transition: transform 0.3s ease;"></i></h5>
            <div class="collapsible-widget-content">
               <div class="filter-scroll-list">
                  @php
                  $parent_cat = $breadsubcat->category;
                  $parent_products = App\Models\Product::where('category_id', $parent_cat->id)->get();
                  @endphp
                  <label class="premium-custom-checkbox parent-category-checkbox">
                      <input class="form-check-input filter-input" type="checkbox" name="category[]" id="exampleCheckbox{{ $parent_cat->id }}" value="{{ $parent_cat->category_slug }}"
                      @if(!empty($filter_category) && in_array($parent_cat->category_slug, $filter_category))
                      checked
                      @endif
                      />
                      <span class="checkmark"></span>
                      <span class="form-check-label" style="font-weight: 700;">{{ $parent_cat->category_name }} <span class="count-badge">({{ count($parent_products) }})</span></span>
                  </label>
                  
                  <!-- Subcategories List -->
                  <div class="subcategory-filter-list" style="margin-left: 22px; margin-top: 10px; border-left: 2px solid #e2e8f0; padding-left: 12px; display: flex; flex-direction: column; gap: 8px;">
                     @php
                     $subcategories = App\Models\SubCategory::where('category_id', $parent_cat->id)->orderBy('subcategory_name', 'ASC')->get();
                     @endphp
                     @foreach($subcategories as $subcat)
                        @php
                        $subcat_products = App\Models\Product::where('subcategory_id', $subcat->id)->where('status', 1)->get();
                        @endphp
                        @if(count($subcat_products) > 0)
                           <label class="premium-custom-checkbox" style="margin-bottom: 0;">
                               <input class="form-check-input filter-input subcategory-filter-input" type="checkbox" name="subcategory[]" id="exampleSubCheckbox{{ $subcat->id }}" value="{{ $subcat->subcategory_slug }}"
                               @if($subcat->id == $breadsubcat->id || (!empty($filter_subcategory) && in_array($subcat->subcategory_slug, $filter_subcategory)))
                               checked
                               @endif
                               />
                               <span class="checkmark"></span>
                               <span class="form-check-label" style="font-size: 13px;">{{ $subcat->subcategory_name }} <span class="count-badge">({{ count($subcat_products) }})</span></span>
                           </label>
                        @endif
                     @endforeach
                  </div>
               </div>
            </div>
         </div>

         <!-- Brand Filter Widget -->
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

         <!-- Product sidebar Widget -->
         <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10 widget-collapsed">
            <h5 class="section-title style-1 mb-30 collapsible-widget-title" style="cursor: pointer;">New products<i class="fi-rs-angle-down toggle-icon" style="float: right; transition: transform 0.3s ease;"></i></h5>
            <div class="collapsible-widget-content" style="display: none;">
               @foreach($newProduct as $product)
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
                        <span class="price">Gh {{ number_format($product->discount_price, 2) }}</span>
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
   document.addEventListener("DOMContentLoaded", function() {
      $(document).ready(function(){
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

         var subcategories = [];
         $('input[name="subcategory[]"]:checked').each(function() {
            var val = $(this).val();
            if (subcategories.indexOf(val) === -1) {
               subcategories.push(val);
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
         if (subcategories.length > 0) {
            params.subcategory = subcategories.join(',');
         }
         if (brands.length > 0) {
            params.brand = brands.join(',');
         }
         if (page > 1) {
            params.page = page;
         }

         var ajaxParams = $.extend({ ajax: 1 }, params);

         $.ajax({
            url: window.location.pathname,
            type: 'GET',
            data: ajaxParams,
            success: function(response) {
               if (response.indexOf('<!DOCTYPE html>') !== -1 || response.indexOf('id="preloader-active"') !== -1) {
                  var $temp = $('<div>').html(response);
                  var partialHtml = $temp.find('#shop-product-container').html();
                  if (partialHtml) { $container.html(partialHtml); }
                  else { window.location.reload(); }
               } else {
                  $container.html(response);
               }
               
               var queryString = $.param(params);
               var newUrl = window.location.pathname + (queryString ? '?' + queryString : '');
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
});
</script>
@endsection