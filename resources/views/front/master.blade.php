<!DOCTYPE html>
<html class="no-js" lang="en">
   <head>
      <meta charset="utf-8" />
      <title>@yield('title')</title>
      <meta http-equiv="x-ua-compatible" content="ie=edge" />
      <meta name="title" content="{{ optional($seo)->meta_title }}" />
      <meta name="author" content="{{ optional($seo)->meta_author }}" />
      <meta name="keywords" content="{{ optional($seo)->meta_keyword }}" />
      <meta name="description" content="{{ optional($seo)->meta_description }}" />

      <meta name="csrf-token" content="{{ csrf_token() }}">

      {{-- <meta name="viewport" content="width=device-width, initial-scale=1" /> --}}
      <meta name="viewport" content="width=device-width, height=device-height,  initial-scale=1.0, user-scalable=no;user-scalable=0;"/>
      <meta property="og:title" content="" />
      <meta property="og:type" content="" />
      <meta property="og:url" content="" />
      <meta property="og:image" content="" />

      <!-- DNS Prefetch & Preconnect for faster CDN loading -->
      <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin />
      <link rel="preconnect" href="https://cdn-uicons.flaticon.com" crossorigin />
      <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin />
      <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com" />
      <link rel="dns-prefetch" href="https://cdn-uicons.flaticon.com" />
      <link rel="dns-prefetch" href="https://cdn.jsdelivr.net" />

      <!-- Favicon -->
      <link rel="icon" type="image/png" href="{{ asset('front/assets/imgs/theme/_favicon/favicon-96x96.png') }}" sizes="96x96" />
      <link rel="icon" type="image/svg+xml" href="{{ asset('front/assets/imgs/theme/_favicon/favicon.svg') }}" />
      <link rel="shortcut icon" href="{{ asset('front/assets/imgs/theme/_favicon/favicon.ico') }}" />
      <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('front/assets/imgs/theme/_favicon/apple-touch-icon.png') }}" />
      <meta name="apple-mobile-web-app-title" content="smartgroceries.org" />
      <link rel="manifest" href="{{ asset('front/assets/imgs/theme/_favicon/site.webmanifest') }}" />

      <!-- Critical CSS (render-blocking - keep minimal) -->
      <link rel="stylesheet" href="{{ asset('front/assets/css/main.css?v=5.3') }}" />

      <!-- Non-critical CSS (load async via media trick) -->
      <link rel="stylesheet" href="{{ asset('front/assets/css/plugins/animate.min.css') }}" media="print" onload="this.media='all'" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" media="print" onload="this.media='all'" />
      <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-solid-straight/css/uicons-solid-straight.css' media="print" onload="this.media='all'" />
      <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-straight/css/uicons-regular-straight.css' media="print" onload="this.media='all'" />
      <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css' media="print" onload="this.media='all'" />
      <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-bold-rounded/css/uicons-bold-rounded.css' media="print" onload="this.media='all'" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" media="print" onload="this.media='all'" />
      <link href="{{ asset('back/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" media="print" onload="this.media='all'" />

      <!-- Stripe JS: only loaded on checkout pages -->
      @hasSection('needs_stripe')
      <script src="https://js.stripe.com/v3/"></script>
      @endif

      <!-- Custom CSS Overrides for product grid action buttons (Desktop & Mobile) -->
      <style>
         /* Completely hide all Compare buttons across all views (Desktop & Mobile) */
         .product-cart-wrap .product-action-1 a.action-btn[aria-label="Compare"],
         .product-cart-wrap .product-action-1 a.action-btn[onclick*="Compare"],
         .product-cart-wrap .product-action-1 a.action-btn[onclick*="addToCompare"],
         .product-cart-wrap .product-action-1-mobile a.action-btn[aria-label="Compare"],
         a.action-btn[aria-label="Compare"] {
            display: none !important;
         }

         /* Make product image wrapper overflow visible globally so tooltips aren't clipped */
         .product-cart-wrap .product-img-action-wrap {
            overflow: visible !important;
         }

         /* Desktop hover actions */
         .product-cart-wrap .product-action-1 {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            white-space: nowrap !important;
            background-color: #fff !important;
            border-radius: 5px !important;
            border: 1px solid #BCE3C9 !important;
         }
         .product-cart-wrap .product-action-1 a.action-btn {
         }
         .premium-product-item .content h6.title a {
            color: #253D4E !important;
            text-decoration: none !important;
            transition: color 0.2s ease !important;
         }
         .premium-product-item .content h6.title a:hover {
            color: #3bb77e !important;
         }
         .premium-product-item .content .price {
            font-size: 15px !important;
            font-weight: 700 !important;
            color: #3bb77e !important;
         }
         .premium-product-item .content .price-container {
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
            flex-wrap: wrap !important;
         }
         .premium-product-item .content .old-price {
            font-size: 12px !important;
            text-decoration: line-through !important;
            color: #adadad !important;
            font-weight: 600 !important;
         }

         /* Premium Product Category Navigation Tabs */
         .nav-tabs.links {
            border-bottom: none !important;
            display: flex !important;
            gap: 8px !important;
            flex-wrap: wrap !important;
            justify-content: center !important;
            max-width: 820px !important;
            margin: 0 auto !important;
         }
         .nav-tabs.links .nav-item {
            margin-bottom: 5px !important;
         }
         .nav-tabs.links .nav-link {
            padding: 8px 18px !important;
            background-color: #f4f6f8 !important;
            border-radius: 30px !important;
            border: 1px solid #eef0f2 !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            color: #4f5d66 !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            margin-left: 0 !important;
         }
         .nav-tabs.links .nav-link:first-child {
            padding: 8px 18px !important;
            margin-left: 0 !important;
         }
         .nav-tabs.links .nav-link:hover {
            background-color: #eef0f2 !important;
            color: #3bb77e !important;
            transform: translateY(-2px) !important;
            border-color: #d1d5db !important;
         }
         .nav-tabs.links .nav-link.active {
            background-color: #3bb77e !important;
            color: #ffffff !important;
            border-color: #3bb77e !important;
            box-shadow: 0 8px 20px rgba(59, 183, 126, 0.2) !important;
         }

         @media (max-width: 768px) {
            .section-title.style-2 {
               gap: 10px !important;
               margin-bottom: 20px !important;
            }
            .nav-tabs.links {
               display: flex !important;
               flex-wrap: nowrap !important;
               overflow-x: auto !important;
               -webkit-overflow-scrolling: touch !important;
               width: 100% !important;
               padding-bottom: 8px !important;
               padding-left: 15px !important;
               padding-right: 15px !important;
               border-bottom: none !important;
               scroll-behavior: smooth !important;
               justify-content: flex-start !important;
            }
            .nav-tabs.links::-webkit-scrollbar {
               display: none !important;
            }
            .nav-tabs.links .nav-item {
               flex: 0 0 auto !important;
               margin-bottom: 0 !important;
            }
         }

         /* Centered Products Category Section Header */
         .section-title.style-2 {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
            text-align: center !important;
            margin-bottom: 30px !important;
            gap: 15px !important;
            border-bottom: none !important;
         }
         .section-title.style-2::after {
            display: none !important;
         }
         .products-category-title {
            font-size: 20px !important;
            font-weight: 700 !important;
            color: #253D4E !important;
            text-transform: capitalize !important;
            margin: 0 !important;
            cursor: pointer !important;
            user-select: none !important;
            transition: all 0.3s ease !important;
            position: relative !important;
            padding-bottom: 8px !important;
         }
         .products-category-title::after {
            content: "" !important;
            width: 40px !important;
            height: 2px !important;
            position: absolute !important;
            bottom: 0 !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
            background-color: #BCE3C9 !important;
            transition: all 0.3s ease !important;
         }
         .products-category-title:hover {
            color: #3bb77e !important;
         }
         .products-category-title:hover::after {
            width: 70px !important;
            background-color: #3bb77e !important;
         }

         /* Premium Custom Checkboxes and Filter Widget */
         .premium-filter-widget .premium-custom-checkbox {
            position: relative !important;
            padding-left: 28px !important;
            margin-bottom: 12px !important;
            cursor: pointer !important;
            user-select: none !important;
            display: block !important;
         }
         .premium-filter-widget .premium-custom-checkbox input {
            position: absolute !important;
            opacity: 0 !important;
            cursor: pointer !important;
            height: 0 !important;
            width: 0 !important;
         }
         .premium-filter-widget .checkmark {
            position: absolute !important;
            top: 2px !important;
            left: 0 !important;
            height: 18px !important;
            width: 18px !important;
            background-color: #fff !important;
            border: 2px solid #e2e8f0 !important;
            border-radius: 4px !important;
            transition: all 0.25s ease !important;
         }
         .premium-filter-widget .premium-custom-checkbox:hover input ~ .checkmark {
            border-color: #BCE3C9 !important;
         }
         .premium-filter-widget .premium-custom-checkbox input:checked ~ .checkmark {
            background-color: #3bb77e !important;
            border-color: #3bb77e !important;
         }
         .premium-filter-widget .checkmark:after {
            content: "" !important;
            position: absolute !important;
            display: none !important;
         }
         .premium-filter-widget .premium-custom-checkbox input:checked ~ .checkmark:after {
            display: block !important;
         }
         .premium-filter-widget .premium-custom-checkbox .checkmark:after {
            left: 5px !important;
            top: 1px !important;
            width: 5px !important;
            height: 9px !important;
            border: solid white !important;
            border-width: 0 2px 2px 0 !important;
            transform: rotate(45deg) !important;
         }
         .premium-filter-widget .form-check-label {
            color: #253D4E !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            transition: color 0.2s ease !important;
         }
         .premium-filter-widget .premium-custom-checkbox:hover .form-check-label,
         .premium-filter-widget .premium-custom-checkbox input:checked ~ .form-check-label {
            color: #3bb77e !important;
         }
         .premium-filter-widget .count-badge {
            float: right !important;
            background-color: #f0f4f2 !important;
            color: #7e8e97 !important;
            font-size: 11px !important;
            font-weight: 600 !important;
            padding: 2px 6px !important;
            border-radius: 10px !important;
            transition: all 0.2s ease !important;
         }
         .premium-filter-widget .premium-custom-checkbox:hover .count-badge,
         .premium-filter-widget .premium-custom-checkbox input:checked ~ .form-check-label .count-badge {
            background-color: #3bb77e !important;
            color: #fff !important;
         }
         .filter-scroll-list {
            max-height: 240px !important;
            overflow-y: auto !important;
            padding-right: 8px !important;
            margin-bottom: 15px !important;
         }
         .filter-scroll-list::-webkit-scrollbar {
            width: 5px !important;
         }
         .filter-scroll-list::-webkit-scrollbar-track {
            background: #f1f5f9 !important;
            border-radius: 10px !important;
         }
         .filter-scroll-list::-webkit-scrollbar-thumb {
            background: #cbd5e1 !important;
            border-radius: 10px !important;
         }
         .filter-scroll-list::-webkit-scrollbar-thumb:hover {
            background: #94a3b8 !important;
         }
         .btn-reset-filter {
            background: transparent !important;
            border: 1px solid #ff5a5a !important;
            color: #ff5a5a !important;
            padding: 6px 14px !important;
            border-radius: 30px !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 6px !important;
            cursor: pointer !important;
            margin: 10px 0 !important;
            width: auto !important;
            justify-content: center !important;
         }
         .btn-reset-filter:hover {
            background-color: #ff5a5a !important;
            color: #fff !important;
            box-shadow: 0 4px 12px rgba(255, 90, 90, 0.15) !important;
         }
         .btn-reset-filter-header {
            background: #f0fdf4 !important;
            border: 1px solid #3bb77e !important;
            color: #3bb77e !important;
            padding: 8px 18px !important;
            border-radius: 30px !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 6px !important;
            cursor: pointer !important;
            margin: 0 !important;
         }
         .btn-reset-filter-header:hover {
            background-color: #3bb77e !important;
            color: #fff !important;
            box-shadow: 0 4px 12px rgba(59, 183, 126, 0.15) !important;
         }
         .shop-overlay-loader {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            background: rgba(255,255,255,0.7) !important;
            z-index: 10 !important;
            display: flex !important;
            align-items: flex-start !important;
            justify-content: center !important;
            padding-top: 150px !important;
         }
         .shop-spinner {
            width: 40px !important;
            height: 40px !important;
            border: 4px solid #f3f3f3 !important;
            border-top: 4px solid #3bb77e !important;
            border-radius: 50% !important;
            animation: spin 0.8s linear infinite !important;
         }
         @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
         }

         /* Custom Layout Width, Padding & Title Size Enhancements */
         @media (min-width: 1200px) {
            .container {
               max-width: 1380px !important;
            }
         }
         @media (min-width: 1400px) {
            .container {
               max-width: 1540px !important;
            }
         }
         
         /* Reduce padding in sidebar widgets so checkboxes fit on one line */
         .primary-sidebar .premium-filter-widget,
         .primary-sidebar .product-sidebar {
            padding: 24px 18px !important;
         }

         /* Reduce title size of Category, Brand and New products widgets */
         .collapsible-widget-title {
            font-size: 17px !important;
            font-weight: 700 !important;
            margin-bottom: 20px !important;
            cursor: pointer !important;
            display: block !important;
         }

         /* Chevron toggle icons rotation */
         .collapsible-widget-title .toggle-icon {
            float: right !important;
            transition: transform 0.3s ease !important;
         }
         .widget-collapsed .toggle-icon {
            transform: rotate(0deg) !important;
         }
         .sidebar-widget:not(.widget-collapsed) .toggle-icon {
            transform: rotate(180deg) !important;
         }
         
         /* Slightly reduce label text size */
         .premium-filter-widget .premium-custom-checkbox .form-check-label {
            font-size: 13.5px !important;
            font-weight: 550 !important;
         }

         /* Reduce product title size and keep it on a single line */
         .product-cart-wrap .product-content-wrap h2 {
            font-size: 13.5px !important;
            font-weight: 700 !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            margin-bottom: 4px !important;
         }

         /* Reduce Add button size and padding to prevent wrapping issues */
         .product-cart-wrap .product-card-bottom .add-cart .add {
            padding: 4px 10px !important;
            font-size: 12px !important;
            font-weight: 600 !important;
            border-radius: 4px !important;
         }
         
         /* Ensure prices do not wrap and have clear spacing */
         .product-cart-wrap .product-card-bottom .product-price span {
            font-size: 14.5px !important;
            font-weight: 700 !important;
            white-space: nowrap !important;
         }
         .product-cart-wrap .product-card-bottom .product-price span.old-price {
            font-size: 11.5px !important;
            margin-left: 4px !important;
         }
       </style>
   </head>
   <body>
      {{-- @include('front.body.loader') --}}
      @include('front.body.quick_view')
      @include('front.body.header')
      <main class="main">
         @yield('content')
      </main>
      @include('front.body.footer')
      @include('front.body.pre_loader')
      <!-- Core JS (must load first - not deferred) -->
      <script src="{{ asset('front/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
      <script src="{{ asset('front/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>

      <!-- Deferred Vendor JS (non-blocking) -->
      <script src="{{ asset('front/assets/js/vendor/modernizr-3.6.0.min.js') }}" defer></script>
      {{-- <script src="{{ asset('front/assets/js/jquery.min.js') }}"></script> --}}
      <script src="{{ asset('front/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}" defer></script>
      <script src="{{ asset('front/assets/js/plugins/slick.js') }}" defer></script>
      <script src="{{ asset('front/assets/js/plugins/jquery.syotimer.min.js') }}" defer></script>
      <script src="{{ asset('front/assets/js/plugins/waypoints.js') }}" defer></script>
      <script src="{{ asset('front/assets/js/plugins/wow.js') }}" defer></script>
      <script src="{{ asset('front/assets/js/plugins/perfect-scrollbar.js') }}" defer></script>
      <script src="{{ asset('front/assets/js/plugins/magnific-popup.js') }}" defer></script>
      <script src="{{ asset('front/assets/js/plugins/select2.min.js') }}" defer></script>
      <script src="{{ asset('front/assets/js/plugins/counterup.js') }}" defer></script>
      <script src="{{ asset('front/assets/js/plugins/jquery.countdown.min.js') }}" defer></script>
      <script src="{{ asset('front/assets/js/plugins/images-loaded.js') }}" defer></script>
      <script src="{{ asset('front/assets/js/plugins/isotope.js') }}" defer></script>
      <script src="{{ asset('front/assets/js/plugins/scrollup.js') }}" defer></script>
      <script src="{{ asset('front/assets/js/plugins/jquery.vticker-min.js') }}" defer></script>
      <script src="{{ asset('front/assets/js/plugins/jquery.theia.sticky.js') }}" defer></script>
      <script src="{{ asset('front/assets/js/plugins/jquery.elevatezoom.js') }}" defer></script>
      <!-- Template JS -->
      <script src="{{ asset('front/assets/js/main.js?v=5.6') }}" defer></script>
      <script src="{{ asset('front/assets/js/shop.js?v=6.3') }}" defer></script>
      <script src="{{ asset('front/assets/js/script.js?v=2.0') }}" defer></script>
      <script src="{{ asset('back/assets/plugins/datatable/js/jquery.dataTables.min.js') }}" defer></script>
      <script>
         $(document).ready(function() {
            if ($('#example').length) { $('#example').DataTable(); }
           } );
      </script>
      <script src="{{ asset('front/assets/js/code.js?v=2.0') }}" defer></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" defer></script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>
      <script>
         @if(Session::has('message'))
         var type = "{{ Session::get('alert-type','info') }}"
         switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;
            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;
            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;
            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
         }
         @endif
      </script>

      <script type="text/javascript">
         $.ajaxSetup({
             headers:{
                 'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
             }
         })
         /// Start product view with Modal
         function productView(id){
            // Reset modal fields instantly to prevent stale data flash
            $('#pname').text('Loading...');
            $('#pprice').text('');
            $('#oldprice').text('');
            $('#hide_curreny').text('');
            $('#pbrand').text('');
            $('#pcategory').text('');
            $('#pcode').text('');
            $('#pimage').attr('src', '/upload/no_image.jpg');
            $('#available').text('').hide();
            $('#stockout').text('').hide();
            $('#call_us').text('');
            $('#quantity_stock').text('');
            $('#total_stock').text('');
            $('#modal-qty-stock').html('');
            $('select[name="size"]').empty();
            $('#sizeArea').hide();
            $('select[name="color"]').empty();
            $('#colorArea').hide();

            $.ajax({
               type: 'GET',
               url: '/product/view/modal/'+id,
            dataType: 'json',
            success:function(data){
               $('#pname').text(data.product.product_name);
               var formattedSellingPrice = parseFloat(data.product.selling_price || 0).toFixed(2);
               $('#pprice').text(formattedSellingPrice);
               $('#pcode').text(data.product.product_code);
               $('#pcategory').text(data.product.category.category_name);
               $('#pbrand').text(data.product.brand.brand_name);
               $('#pimage').attr('src','/'+data.product.product_thumbnail);

               $('#pvendor_id').text(data.product.vendor_id);
               $('#product_id').val(id);
               $('#qty').val(1);
               $('#total_stock').text(data.total_stock);

               $('#modal-qty-stock').html(" ");

            // Product Price
            if (data.product.discount_price == null) {
                $('#oldprice').text('').attr('data-base-price', '');
                $('#hide_curreny').text('');
                $('#pprice').text(formattedSellingPrice).attr('data-base-price', data.product.selling_price);
               }else{
                  $('#pprice').text(data.new_price.toFixed(2)).attr('data-base-price', data.new_price);
                  $('#oldprice').text(formattedSellingPrice).attr('data-base-price', data.product.selling_price);
                  $('#hide_curreny').text('Gh');
            } // end else

            /// Start Stock Option
             if (data.total_stock > 0) {
                 $('#available').text('').hide();
                 $('#stockout').text('').hide();
                 $('#call_us').text('');
                 $('#total_stock').text(data.total_stock);
                 $('#available').text('Available in stock').show();
                 $('#quantity_stock').text('');
             }else{
                 $('#available').text('').hide();
                 $('#stockout').text('').hide();
                 $('#stockout').text('Stock Out').show();
                 $('#call_us').text('Call for supplies: 0548795583 / 0555700931');
                 $('#total_stock').text('');
                 $('#quantity_stock').text('0');
             }
            ///End Start Stock Option

            ///Size
             $('select[name="size"]').empty();
             if (data.product_attribute && data.product_attribute.length > 0) {
                 $('select[name="size"]').append('<option selected="" disabled=""> --select size-- </option>');
                 $.each(data.product_attribute, function(key,value){
                    $('select[name="size"]').append('<option value="'+value.size+' ">'+value.size+'  </option>');
                 });
                 $('#sizeArea').show();
                 $('select[name="size"]').show();
             } else {
                 $('#sizeArea').hide();
             }
             // end size

             ///Color
              $('select[name="color"]').empty();
              var validColors = [];
              if (data.color && Array.isArray(data.color)) {
                  validColors = data.color.filter(function(c) {
                      if (!c) return false;
                      var str = c.trim().toLowerCase();
                      return str !== '' && str !== 'none' && str !== 'color or type';
                  });
              }
              if (validColors.length === 0) {
                  $('#colorArea').hide();
              } else {
                  $('select[name="color"]').append('<option selected="" disabled=""> --select variant-- </option>');
                  $('#colorArea').show();
                  $.each(validColors, function(key, value){
                      $('select[name="color"]').append('<option value="'+value.trim()+'">'+value.trim()+'</option>');
                  });
              }
             
             // Adjust columns layout depending on selector visibility
             if ($('#sizeArea').is(':visible') || $('#colorArea').is(':visible')) {
                 $('.quickview-attributes-col').show();
                 $('.quickview-price-col').css({ 'flex': '1 1 50%', 'max-width': '50%' });
             } else {
                 $('.quickview-attributes-col').hide();
                 $('.quickview-price-col').css({ 'flex': '0 0 100%', 'max-width': '100%' });
             }
             
             // Trigger state watch instantly on modal load
             if (typeof window.updateQuantityState === 'function') {
                 window.updateQuantityState($('#quickViewModal'));
             }

            }
         })
         }

          /// Start Add To Cart Product
          function addToCart(){
             // Validate size selection if sizeArea is visible
             if ($('#sizeArea').is(':visible')) {
                var sizeVal = $('select[name="size"]').val();
                if (!sizeVal || sizeVal === '' || sizeVal.indexOf('--select') !== -1 || sizeVal.indexOf('--Choose') !== -1) {
                   toastr.error('Please select a size first');
                   return;
                }
             }
             // Validate color/variant selection if colorArea is visible
             if ($('#colorArea').is(':visible')) {
                var colorVal = $('select[name="color"]').val();
                if (!colorVal || colorVal === '' || colorVal.indexOf('--select') !== -1) {
                   toastr.error('Please select a variant first');
                   return;
                }
             }

             var product_name = $('#pname').text();
             var id = $('#product_id').val();
             var vendor = $('#pvendor_id').text();
             var color = $('#color option:selected').text();
             var size = $('.size option:selected').text();
             var quantity = $('#qty').val();

            // $('#getPrice_modal').val('');
            // $('#color').val('');
            // $('#qty').val(1);

               $.ajax({
                  type: "POST",
                  dataType : 'json',
                  data:{
                        color:color,
                        size:size,
                        quantity:quantity,
                        product_name:product_name,
                        vendor:vendor
                  },
                     url: "/cart/data/store/"+id,
                     success:function(data){
                        miniCart(data);
                        $('#closeModal').click();

                        // Start Message
                        const Toast = Swal.mixin({
                              toast: true,
                              position: 'top-end',
                              icon: 'success',
                              showConfirmButton: false,
                              timer: 3000
                        })
                        if ($.isEmptyObject(data.error)){
                           Toast.fire({
                           type: 'success',
                           icon: 'success',
                           title: data.success,
                           })
                        }else{

                           Toast.fire({
                                 type: 'error',
                                 icon: 'error',
                                 title: data.error,
                           })
                        }
                     }
               })
         }
      </script>

      <script type="text/javascript">
         function renderMiniCart(response){
            $('span[id="cartSubTotal"]').text(response.cartTotal);
            $('#cartQty').text(response.cartQty);
            $('#cartQty-mobile').text(response.cartQty);
            $('#cartItems').text(response.cartItems);

            // console.log(response)
            var miniCart = "<ul>"
            $.each(response.carts, function(key,value){
                var detailText = value.options.size;
                if (value.options.color) {
                    detailText += ` (${value.options.color})`;
                }
                miniCart += `
                  <li style="display: flex; align-items: center; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #f1f2f4; margin: 0; gap: 12px;">
                     <div class="shopping-cart-img" style="flex: 0 0 60px; max-width: 60px; margin-right: 0;">
                        <a href="/product/details/${value.id}/product"><img alt="Product" src="/${value.options.image}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid #f1f2f4; display: block;" /></a>
                     </div>
                     <div class="shopping-cart-title" style="flex: 1; min-width: 0; margin: 0;">
                        <h4 style="margin: 0 0 4px; line-height: 1.3; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-size: 14px;">
                           <a href="/product/details/${value.id}/product" style="color: #253D4E; font-weight: 700; font-family: 'Outfit', sans-serif;">
                              ${value.name}
                           </a>
                        </h4>
                        <span style="font-size: 12px; color: #7e7e7e; display: block; margin-bottom: 4px; font-weight: 500; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                           ${detailText}
                        </span>
                        <h3 style="font-size: 13px; font-weight: 700; color: #3bb77e; margin: 0; font-family: 'Inter', sans-serif;">
                           <span style="color: #253D4E; font-weight: 500;">${value.qty} × </span>
                           Gh ${parseFloat(value.price).toFixed(2)}
                           <span style="color: #7e7e7e; font-weight: 500; margin-left: 5px;">= Gh ${(value.qty * value.price).toFixed(2)}</span>
                        </h3>
                     </div>
                     <div class="shopping-cart-delete" style="flex: 0 0 auto; margin: 0;">
                        <a type="button" id="${value.rowId}" onclick="miniCartRemove(this.id)" style="color: #7e7e7e; background: #f7f8f9; width: 26px; height: 26px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; transition: all 0.2s ease; cursor: pointer;" onmouseover="this.style.background='#ffecea'; this.style.color='#ef4444';" onmouseout="this.style.background='#f7f8f9'; this.style.color='#7e7e7e';">
                            <i class="fi-rs-cross-small" style="font-size: 16px; font-weight: bold;"></i>
                        </a>
                     </div>
                  </li>
                `;
            });
            miniCart += "</ul>";
            $('#miniCart').html(miniCart);
            $('#miniCart-mobile').html(miniCart);
         }

         function miniCart(data = null){
            if (data && data.carts !== undefined) {
               renderMiniCart(data);
            } else {
               $.ajax({
                  type: 'GET',
                  url: '/product/mini/cart',
                  dataType: 'json',
                  cache: false,
                  success:function(response){
                     renderMiniCart(response);
                  }
               });
            }
         }
         // Sync checkout page on focus if cart updated in another tab/window
         $(window).on('focus', function() {
            if (window.location.pathname === '/checkout') {
               $.ajax({
                  type: 'GET',
                  url: '/product/mini/cart',
                  dataType: 'json',
                  success: function(response) {
                     if (response && response.cartQty !== undefined) {
                        const currentQty = parseInt(response.cartQty);
                        const currentTotal = parseFloat(response.cartTotal.replace(/,/g, ''));
                        if (window.checkoutCartQty !== undefined && (window.checkoutCartQty !== currentQty || window.checkoutCartTotal !== currentTotal)) {
                           window.location.reload();
                        }
                     }
                  }
               });
            }
         });

         // Delay miniCart load until after page renders
         setTimeout(function(){ miniCart(); }, 800);

         /// Mini Cart Remove Start
         function miniCartRemove(rowId){
            $.ajax({
               type: 'GET',
               url: '/minicart/product/remove/'+rowId,
               dataType:'json',
               success:function(data){
                  miniCart(data);
                  if (window.location.pathname === '/checkout') {
                      window.location.reload();
                      return;
                  }
                  // Start Message
                  const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                  })
                  if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                        type: 'success',
                        title: data.success,
                        })
                  }else{

               Toast.fire({
                        type: 'error',
                        title: data.error,
                        })
                     }
                  // End Message
               }
            })
         }
         /// Mini Cart Remove End

          /// Start Details Page Add To Cart Product
          function addToCartDetails(){
             // Validate size selection if sizeArea is visible
             var $dsizeSelect = $('.dsize');
             if ($dsizeSelect.length) {
                var $dsizeWrapper = $dsizeSelect.closest('#sizeArea, .attr-size');
                if ($dsizeWrapper.length && $dsizeWrapper.is(':visible')) {
                   var dsizeVal = $dsizeSelect.val();
                   if (!dsizeVal || dsizeVal === '' || dsizeVal.indexOf('--select') !== -1 || dsizeVal.indexOf('--Choose') !== -1) {
                      toastr.error('Please select a size first');
                      return;
                   }
                }
             }
             
             // Validate color/variant selection if colorArea is visible
             var $dcolorSelect = $('#dcolor');
             if ($dcolorSelect.length) {
                var $dcolorWrapper = $dcolorSelect.closest('#colorArea, .attr-size');
                if ($dcolorWrapper.length && $dcolorWrapper.is(':visible')) {
                   var dcolorVal = $dcolorSelect.val();
                   if (!dcolorVal || dcolorVal === '' || dcolorVal.indexOf('--select') !== -1) {
                      toastr.error('Please select a variant first');
                      return;
                   }
                }
             }

             var product_name = $('#dpname').text();
             var id = $('#dproduct_id').val();
             var vendor = $('#vproduct_id').val();
             var color = $('#dcolor option:selected').text();
             var size = $('.dsize option:selected').text();
             var quantity = parseInt($('#dqty').val(), 10);
             var maxStock = parseInt($('#dqty').attr('max'), 10);

         // Client-side stock validation
         if (maxStock && quantity > maxStock) {
            toastr.error('Requested quantity (' + quantity + ') exceeds available stock (' + maxStock + '). Please reduce your quantity.');
            $('#dqty').val(maxStock);
            return;
         }

         // $('#getPrice').val('');
         // $('#dcolor').val('');
         // $('#dqty').val(1);

         $.ajax({
         type: "POST",
         dataType : 'json',
         data:{
            color:color,
            size:size,
            quantity:quantity,
            product_name:product_name,
            vendor:vendor
         },
         url: "/details-cart/data/store/"+id,
         success:function(data){
            miniCart(data);
            if (window.location.pathname === '/checkout') {
                window.location.reload();
                return;
            }
            $('.qty-stock').html(" ");

            // console.log(data)
            // Start Message
            const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000
            })
            if ($.isEmptyObject(data.error)) {

                  Toast.fire({
                  type: 'success',
                  icon: 'success',
                  title: data.success,
                  })
            }else{

         Toast.fire({
                  type: 'error',
                  icon: 'error',
                  title: data.error,
                  })
               }
            // End Message
         }
         })
         }
      </script>

      <script type="text/javascript">
         function addToWishList(product_id){
            $.ajax({
               type: "POST",
               dataType: 'json',
               url: "/add-to-wishlist/"+product_id,
               success:function(data){
                  wishlist(data);
                     // Start Message
            const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000
            })
            if ($.isEmptyObject(data.error)) {

                     Toast.fire({
                     type: 'success',
                     icon: 'success',
                     title: data.success,
                     })
            }else{

            Toast.fire({
                     type: 'error',
                     icon: 'error',
                     title: data.error,
                     })
               }
               // End Message
               }
            })
         }
      </script>

      <script type="text/javascript">          
          function renderWishlist(response){
             $('#wishQty').text(response.wishQty);
             $('#wishQty-mobile').text(response.wishQty);
             
             // Reset Select All checkbox and hide Bulk Delete button
             $('#selectAllWishlist').prop('checked', false);
             $('#bulkDeleteWishlistBtn').addClass('d-none');
             
             if (!response.wishlist || response.wishlist.length === 0) {
                $('#wishlist-table-container').addClass('d-none');
                $('#wishlist-mobile-container').addClass('d-none');
                $('#selectAllWishlist').addClass('d-none');
                $('#wishlist-empty-state').removeClass('d-none');
             } else {
                $('#wishlist-table-container').removeClass('d-none');
                $('#wishlist-mobile-container').removeClass('d-none');
                $('#selectAllWishlist').removeClass('d-none');
                $('#wishlist-empty-state').addClass('d-none');
             }

             var rows = ""
             var mobileCards = ""
             $.each(response.wishlist, function(key,value){
                rows += `<tr class="pt-30">
                             <td style="width: 50px; text-align: center; vertical-align: middle;">
                                <input class="form-check-input wishlist-checkbox" type="checkbox" value="${value.id}" onchange="checkWishlistSelection()" style="display: block !important; margin: 0 auto;">
                             </td>
                             <td class="image product-thumbnail pt-40">
                               <a class="product-name mb-10" href="/product/details/${value.product.id}/${value.product.product_slug}">
                                <img src="/${value.product.product_thumbnail}" alt="#" />
                                <h6>${value.product.product_name}</h6>
                               </a>
                             </td>

                             <td class="price" data-title="Price">
                               ${value.product.discount_price == null
                               ? `<h4 class="text-brand">Gh ${value.product.selling_price}</h4>`
                               :`<h4 class="text-brand">Gh ${((100 - value.product.discount_price)/100) * value.product.selling_price}</h4><h4 class="wishlist-change">Gh ${value.product.selling_price}</h4>`
                               }
                             </td>

                             <td class="action text-center" data-title="Remove">
                                 <a type="submit" class="text-body" id="${value.id}" onclick="wishlistRemove(this.id)"><i class="fi-rs-trash"></i></a>
                             </td>
                         </tr>`;

                // Mobile Card layout (Horizontal, compact, premium look)
                mobileCards += `
                <div class="wishlist-mobile-card" style="display: flex; align-items: center; background: #fff; border: 1px solid #ececec; border-radius: 12px; padding: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.03); gap: 12px; margin-bottom: 15px !important;">
                    <!-- Checkbox -->
                    <div style="display: flex; align-items: center; justify-content: center; width: 30px; flex-shrink: 0;">
                        <input class="form-check-input wishlist-checkbox" type="checkbox" value="${value.id}" onchange="checkWishlistSelection()" style="display: block !important; margin: 0;">
                    </div>
                    
                    <!-- Image -->
                    <div style="width: 70px; height: 70px; flex-shrink: 0; border-radius: 8px; overflow: hidden; background: #f8f9fa; border: 1px solid #f1f1f1;">
                        <a href="/product/details/${value.product.id}/${value.product.product_slug}">
                            <img src="/${value.product.product_thumbnail}" alt="#" style="width: 100%; height: 100%; object-fit: cover;">
                        </a>
                    </div>
                    
                    <!-- Info (Name & Price) -->
                    <div style="flex-grow: 1; display: flex; flex-direction: column; gap: 4px; min-width: 0;">
                        <a href="/product/details/${value.product.id}/${value.product.product_slug}" style="font-weight: 600; color: #253D4E; font-size: 13px; text-decoration: none; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.3;">
                            ${value.product.product_name}
                        </a>
                        <span style="font-weight: 700; color: #7B2828; font-size: 14px;">
                            ${value.product.discount_price == null
                            ? `Gh ${value.product.selling_price}`
                            : `Gh ${(((100 - value.product.discount_price)/100) * value.product.selling_price).toFixed(2)}`
                            }
                        </span>
                    </div>
                    
                    <!-- Delete Button -->
                    <div style="flex-shrink: 0; padding-left: 5px;">
                        <a type="submit" class="text-body" id="${value.id}" onclick="wishlistRemove(this.id)" style="font-size: 16px; color: #e74c3c !important; cursor: pointer; display: inline-block; padding: 5px;">
                            <i class="fi-rs-trash"></i>
                        </a>
                    </div>
                </div>
                `;
             });
             $('#wishlist').html(rows);
             $('#wishlist-mobile-container').html(mobileCards);
          }

         function wishlist(data = null){
            if (data && data.wishlist !== undefined) {
               renderWishlist(data);
            } else {
               $.ajax({
                  type: "GET",
                  dataType: 'json',
                  url: "/get-wishlist-product/",
                  cache: false,
                  success:function(response){
                     renderWishlist(response);
                  }
               })
            }
         }
         // Delay wishlist load until after page renders
         setTimeout(function(){ wishlist(); }, 100);

         // Wishlist Selection Helper Functions
         function toggleSelectAllWishlist(masterCheckbox) {
            $('.wishlist-checkbox').prop('checked', $(masterCheckbox).is(':checked'));
            checkWishlistSelection();
         }

         function checkWishlistSelection() {
            var totalCheckboxes = $('.wishlist-checkbox').length;
            var checkedCheckboxes = $('.wishlist-checkbox:checked').length;

            // Update Master Select All checkbox state
            if (totalCheckboxes > 0 && checkedCheckboxes === totalCheckboxes) {
               $('#selectAllWishlist').prop('checked', true);
            } else {
               $('#selectAllWishlist').prop('checked', false);
            }

            // Show or hide Bulk Delete button
            if (checkedCheckboxes > 0) {
               $('#bulkDeleteWishlistBtn').removeClass('d-none');
            } else {
               $('#bulkDeleteWishlistBtn').addClass('d-none');
            }
         }

         function bulkDeleteWishlist() {
            var selectedIds = [];
            $('.wishlist-checkbox:checked').each(function() {
               selectedIds.push($(this).val());
            });

            if (selectedIds.length === 0) return;

            Swal.fire({
               title: 'Are you sure?',
               text: "You won't be able to revert this!",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Yes, delete selected!'
            }).then((result) => {
               if (result.isConfirmed) {
                  $.ajax({
                     type: "POST",
                     dataType: 'json',
                     url: "/wishlist-bulk-delete",
                     data: { ids: selectedIds },
                     success: function(data) {
                        wishlist(data);
                        // Start Message
                        const Toast = Swal.mixin({
                              toast: true,
                              position: 'top-end',
                              showConfirmButton: false,
                              timer: 3000
                        })
                        if ($.isEmptyObject(data.error)) {
                              Toast.fire({
                                 type: 'success',
                                 icon: 'success',
                                 title: data.success,
                              })
                        } else {
                              Toast.fire({
                                 type: 'error',
                                 icon: 'error',
                                 title: data.error,
                              })
                        }
                        // End Message
                     }
                  });
               }
            })
         }

         // Wishlist Remove Start
         function wishlistRemove(id){
               $.ajax({
                  type: "GET",
                  dataType: 'json',
                  url: "/wishlist-remove/"+id,
                  cache: false,
                  success:function(data){
                     wishlist(data);
                     // Start Message
                     const Toast = Swal.mixin({
                           toast: true,
                           position: 'top-end',
                           showConfirmButton: false,
                           timer: 3000
                     })
                     if ($.isEmptyObject(data.error)) {

                           Toast.fire({
                           type: 'success',
                           icon: 'success',
                           title: data.success,
                           })
                     }else{

                  Toast.fire({
                           type: 'error',
                           icon: 'error',
                           title: data.error,
                           })
                        }
                     // End Message
                  }
               })
         }
         // Wishlist Remove End
      </script>

      <!--  /// Start Compare Add (DISABLED)
      <script type="text/javascript">
         function addToCompare(product_id){
             // Disabled
         }
      </script>
      -->

      <!--  // Start Load MY Cart // -->

      <script type="text/javascript">

         function cart(){
          $.ajax({
             type: 'GET',
             url: '/get-cart-product/',
             dataType: 'json',
             success:function(response){

             var rows = ""
             $.each(response.carts, function(key,value){
                var pData = response.productData ? response.productData[value.rowId] : null;
                var sizeSelect = '';
                var colorSelect = '';
               
                if (pData) {
                    // Build size select if attributes are available
                    if (pData.attributes && pData.attributes.length > 0) {
                        sizeSelect = `<div class="mb-2"><span class="cart-prop-label">Size</span>
                            <select class="cart-prop-select cart-size-select" data-rowid="${value.rowId}">`;
                        $.each(pData.attributes, function(k, attr){
                            var selected = (value.options.size && value.options.size.trim() === attr.size.trim()) ? 'selected' : '';
                            sizeSelect += `<option value="${attr.size}" data-price="${attr.price}" ${selected}>${attr.size}</option>`;
                        });
                        sizeSelect += `</select></div>`;
                    } else if (value.options.size) {
                        sizeSelect = `<div class="mb-2"><span class="cart-prop-label">Size</span><span class="cart-prop-value">${value.options.size}</span></div>`;
                    }
                   
                    // Build variant/color select if colors are available
                    if (pData.colors && pData.colors.length > 0) {
                        colorSelect = `<div><span class="cart-prop-label">Variant</span>
                            <select class="cart-prop-select cart-color-select" data-rowid="${value.rowId}">`;
                        if (!value.options.color) {
                            colorSelect += `<option value="" selected disabled>--select variant--</option>`;
                        }
                        $.each(pData.colors, function(k, col){
                            var selected = (value.options.color && value.options.color.trim() === col.trim()) ? 'selected' : '';
                            colorSelect += `<option value="${col}" ${selected}>${col}</option>`;
                        });
                        colorSelect += `</select></div>`;
                    } else if (value.options.color) {
                        colorSelect = `<div><span class="cart-prop-label">Variant</span><span class="cart-prop-value">${value.options.color}</span></div>`;
                    }
                } else {
                    if (value.options.size) {
                        sizeSelect = `<div class="mb-2"><span class="cart-prop-label">Size</span><span class="cart-prop-value">${value.options.size}</span></div>`;
                    }
                    if (value.options.color) {
                        colorSelect = `<div><span class="cart-prop-label">Variant</span><span class="cart-prop-value">${value.options.color}</span></div>`;
                    }
                }

                rows += `<tr class="cart-item-row" data-rowid="${value.rowId}">
                 <td class="custome-checkbox start"></td>
                 <td class="image product-thumbnail pt-40" style="padding-top:15px !important; padding-bottom:15px !important;"><img src="/${value.options.image} " alt="#">
                 <h6><a class="product-name text-heading" href="">${value.name} </a></h6>
                 </td>

                 <td class="price" data-title="Price">
                     <h6 class="cart-unit-price" style="font-weight: 700; transition: all 0.3s ease;">Gh ${value.price} </h6>
                 </td>
                 <td class="price cart-properties-cell" data-title="Properties">
                     ${sizeSelect}
                     ${colorSelect}
                 </td>

                 <td class="price" data-title="Quantity">
                     <div class="detail-extralink">
                         <div class="detail-qty border radius">
                          <a type="submit" class="qty-down" id="${value.rowId}" onclick="cartDecrement(this.id)"><i class="fi-rs-angle-small-down"></i></a>
                          <input type="text" name="quantity" class="qty-val" value="${value.qty}" min="1" readonly>
                          <a type="submit" class="qty-up" id="${value.rowId}" onclick="cartIncrement(this.id)"><i class="fi-rs-angle-small-up"></i></a>
                         </div>
                     </div>
                 </td>

                 <td class="price" data-title="Sub total">
                     <h5 class="text-brand cart-subtotal" style="font-weight: 800; transition: all 0.3s ease;">Gh ${value.subtotal} </h5>
                 </td>

                 <td class="action text-center" data-title="Remove">
                  <a type="submit" class="text-body" style="cursor:pointer;" id="${value.rowId}" onclick="cartRemove(this.id)"><i class="fi-rs-trash"></i></a></td>       </tr>`
               });
                 $('#cartPage').html(rows);
             }
          })
          }
          // Delay cart load until after page renders
          setTimeout(function(){ cart(); }, 1000);

         // Handle properties changes — instant update without full re-render
         $(document).on('change', '.cart-size-select, .cart-color-select', function(){
             var $changedSelect = $(this);
             var rowId = $changedSelect.data('rowid');
             var $row = $changedSelect.closest('tr.cart-item-row');
             var size = $row.find('.cart-size-select').val() || '';
             var color = $row.find('.cart-color-select').val() || '';
             
             // Show loading state on price cells
             var $priceCell = $row.find('.cart-unit-price');
             var $subtotalCell = $row.find('.cart-subtotal');
             $priceCell.css({'opacity': '0.4'});
             $subtotalCell.css({'opacity': '0.4'});
             
             // Disable selects during update
             $row.find('.cart-prop-select').prop('disabled', true).css('opacity', '0.6');
             
             $.ajax({
                 type: 'POST',
                 url: '/cart-update-properties',
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 data: {
                     rowId: rowId,
                     size: size,
                     color: color
                 },
                 dataType: 'json',
                 success: function(data) {
                     if (data.success) {
                         // Instant client-side update of price and subtotal
                         $priceCell.text('Gh ' + data.price);
                         $subtotalCell.text('Gh ' + data.subtotal);
                         
                         // Animate the price flash
                         $priceCell.css({'opacity': '1', 'color': '#3bb77e'});
                         $subtotalCell.css({'opacity': '1', 'color': '#3bb77e'});
                         setTimeout(function(){
                             $priceCell.css({'color': ''});
                             $subtotalCell.css({'color': ''});
                         }, 800);
                         
                         // Update data-rowid on ALL elements in this row to the new rowId
                         var newRowId = data.newRowId;
                         $row.attr('data-rowid', newRowId);
                         $row.find('.cart-size-select').attr('data-rowid', newRowId).data('rowid', newRowId);
                         $row.find('.cart-color-select').attr('data-rowid', newRowId).data('rowid', newRowId);
                         $row.find('.qty-down').attr('id', newRowId);
                         $row.find('.qty-up').attr('id', newRowId);
                         $row.find('.action a').attr('id', newRowId);
                         
                         // Re-enable selects
                         $row.find('.cart-prop-select').prop('disabled', false).css('opacity', '1');
                         
                         // Update coupon and minicart silently
                         if (typeof couponCalculation === 'function') {
                             couponCalculation();
                         }
                         if (typeof miniCart === 'function') {
                             miniCart();
                         }
                         
                         toastr.success(data.success);
                     } else {
                         // Re-enable selects on error
                         $row.find('.cart-prop-select').prop('disabled', false).css('opacity', '1');
                         $priceCell.css({'opacity': '1'});
                         $subtotalCell.css({'opacity': '1'});
                         toastr.error(data.error);
                     }
                 },
                 error: function() {
                     // Re-enable selects on AJAX error
                     $row.find('.cart-prop-select').prop('disabled', false).css('opacity', '1');
                     $priceCell.css({'opacity': '1'});
                     $subtotalCell.css({'opacity': '1'});
                     toastr.error('Failed to update properties. Please try again.');
                 }
             });
         });

         // Cart Remove Start
         function cartRemove(id){
                 $.ajax({
                     type: "GET",
                     dataType: 'json',
                     url: "/cart-remove/"+id,
                     success:function(data){
                         cart();
                         miniCart(data);
                        //  couponCalculation();
                          // Start Message
                 const Toast = Swal.mixin({
                       toast: true,
                       position: 'top-end',

                       showConfirmButton: false,
                       timer: 3000
                 })
                 if ($.isEmptyObject(data.error)) {

                         Toast.fire({
                         type: 'success',
                         icon: 'success',
                         title: data.success,
                         })
                 }else{

                Toast.fire({
                         type: 'error',
                         icon: 'error',
                         title: data.error,
                         })
                     }
                   // End Message
                     }
                 })
             }
         // Cart Remove End

         // Cart INCREMENT
         function cartIncrement(rowId){
            $.ajax({
                type: 'GET',
                url: "/cart-increment/"+rowId,
                dataType: 'json',
                success:function(data){
                    couponCalculation();
                    cart();
                    miniCart(data);

                    // Start Message
                    const Toast = Swal.mixin({
                              toast: true,
                              position: 'top-end',
                              icon: 'success',
                              showConfirmButton: false,
                              timer: 3000
                     })
                     if ($.isEmptyObject(data.error)){
                        Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                        })
                     }else{

                        Toast.fire({
                              type: 'error',
                              icon: 'error',
                              title: data.error,
                        })
                     }
                  }
            });
         }
         // Cart INCREMENT End
         // Cart Decrement Start
         function cartDecrement(rowId){
            $.ajax({
               type: 'GET',
               url: "/cart-decrement/"+rowId,
               dataType: 'json',
               success:function(data){
                  couponCalculation();
                  cart();
                  miniCart(data);

                  // Start Message
                  const Toast = Swal.mixin({
                              toast: true,
                              position: 'top-end',
                              icon: 'success',
                              showConfirmButton: false,
                              timer: 3000
                  })
                  if ($.isEmptyObject(data.error)){
                     Toast.fire({
                     type: 'success',
                     icon: 'success',
                     title: data.success,
                     })
                  }else{

                     Toast.fire({
                           type: 'error',
                           icon: 'error',
                           title: data.error,
                     })
                  }
               }
            });
         }
         // Cart Decrement End

      </script>

      <script type="text/javascript">
         function applyCoupon(){
         var coupon_name = $('#coupon_name').val();
                  $.ajax({
                     type: "POST",
                     dataType: 'json',
                     data: {coupon_name:coupon_name},
                     url: "/coupon-apply",
                     success:function(data){
                        couponCalculation();
                        if (data.validity == true) {
                           $('#couponField').hide();
                        }

                           // Start Message
                  const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                  })
                  if ($.isEmptyObject(data.error)) {

                           Toast.fire({
                           type: 'success',
                           icon: 'success',
                           title: data.success,
                           })
                  }else{

                  Toast.fire({
                           type: 'error',
                           icon: 'error',
                           title: data.error,
                           })
                     }
                     // End Message
                     }
                  })
               }

               // Start CouponCalculation Method
         function couponCalculation(){
            $.ajax({
               type: 'GET',
               url: "/coupon-calculation",
               dataType: 'json',
               success:function(data){
                     if (data.total) {
                     $('#couponCalField').html(
                        ` <tr>
                        <td class="cart_total_label">
                           <h6 class="text-muted">Subtotal</h6>
                        </td>
                        <td class="cart_total_amount">
                           <h4 class="text-brand text-center">Gh ${data.total}</h4>
                        </td>
                     </tr>

                     <tr>
                        <td class="cart_total_label">
                           <h6 class="text-muted">Grand Total</h6>
                        </td>
                        <td class="cart_total_amount">
                           <h4 class="text-brand text-center">Gh ${data.total}</h4>
                        </td>
                     </tr>
                     ` )
               }else{
                     $('#couponCalField').html(
                        `<tr>
                        <td class="cart_total_label">
                           <h6 class="text-muted">Subtotal</h6>
                        </td>
                        <td class="cart_total_amount">
                           <h4 class="text-brand text-end">Gh ${data.subtotal}</h4>
                        </td>
                     </tr>

                     <tr>
                        <td class="cart_total_label">
                           <h6 class="text-muted">Coupon </h6>
                        </td>
                        <td class="cart_total_amount">
                           <h6 class="text-brand text-end">${data.coupon_name} <a type="submit" onclick="couponRemove()"><i class="fi-rs-trash"></i> </a> </h6>
                        </td>
                     </tr>
                     <tr>
                        <td class="cart_total_label">
                           <h6 class="text-muted">Discount Amount  </h6>
                        </td>
                        <td class="cart_total_amount">
         <h4 class="text-brand text-end">Gh ${data.discount_amount}</h4>
                        </td>
                     </tr>
                     <tr>
                        <td class="cart_total_label">
                           <h6 class="text-muted">Grand Total </h6>
                        </td>
                        <td class="cart_total_amount">
               <h4 class="text-brand text-end">Gh ${data.total_amount}</h4>
                        </td>
                     </tr> `
                        )
               }


               }
            })
         }
         couponCalculation();

         // Start CouponCalculation Method
      </script>

      <script type="text/javascript">
         // Coupon Remove Start
         function couponRemove(){
               $.ajax({
                     type: "GET",
                     dataType: 'json',
                     url: "/coupon-remove",
                     success:function(data){
                        couponCalculation();
                        $('#couponField').show();
                        // Start Message
               const Toast = Swal.mixin({
                     toast: true,
                     position: 'top-end',

                     showConfirmButton: false,
                     timer: 3000
               })
               if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                        })
               }else{

               Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                        })
                     }
                  // End Message
                     }
               })
            }
         // Coupon Remove End
      </script>

      @if(Auth::check() && Auth::user()->role === 'user')
         @php
            $user = Auth::user();
            $showVerificationModal = false;
            if ($user->status_identity === 'student') {
                if (empty($user->institution) || empty($user->hall) || empty($user->phone)) {
                    $showVerificationModal = true;
                }
            } else {
                if (empty($user->phone)) {
                    $showVerificationModal = true;
                }
            }
         @endphp

         @if($showVerificationModal)
            @php
               $modalInstitutions = \App\Models\DeliveryDistrict::where('district_name', '!=', '.select institution')->orderBy('district_name', 'ASC')->get();
            @endphp
            <!-- Verification Modal -->
            <div class="modal fade" id="profileVerificationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="profileVerificationModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content" style="border-radius: 18px; border: none; box-shadow: 0 15px 50px rgba(0,0,0,0.15);">
                     <div class="modal-header bg-light" style="border-bottom: 1px solid #f1f2f4; border-radius: 18px 18px 0 0; padding: 20px 24px;">
                        <h5 class="modal-title" id="profileVerificationModalLabel" style="font-family: 'Outfit', sans-serif; font-weight: 700; color: #253D4E; display: flex; align-items: center; gap: 10px;">
                           <span>🔒</span> Complete Your Profile Details
                        </h5>
                     </div>
                     <form method="POST" action="{{ route('user.profile.update') }}">
                        @csrf
                        <input type="hidden" name="is_modal" value="1">
                        <!-- Retain current fields so they don't get cleared -->
                        <input type="hidden" name="username" value="{{ $user->username }}">
                        <input type="hidden" name="name" value="{{ $user->name }}">
                        <input type="hidden" name="email" value="{{ $user->email }}">
                        <input type="hidden" name="address" value="{{ $user->address ?? 'N/A' }}">

                        <div class="modal-body" style="padding: 24px;">
                           <p class="text-muted mb-20" style="font-size: 13px; line-height: 1.5;">
                              Please verify or complete your details to proceed. This ensures your orders are processed correctly and deliveries reach you safely.
                           </p>
                           @if($user->status_identity === 'student')
                               <div class="form-group mb-15">
                                  <label class="form-label-sm" style="font-size: 12px; font-weight: 600; color: #475569; display: block; margin-bottom: 6px;">Institution *</label>
                                  <select name="institution" id="modal_institution" class="form-control" style="height: 48px; border-radius: 10px; font-size: 14px;" required>
                                     <option value="" disabled {{ empty($user->institution) ? 'selected' : '' }}>-- Select Institution --</option>
                                     @foreach($modalInstitutions as $inst)
                                        <option value="{{ $inst->district_name }}" data-id="{{ $inst->id }}" {{ $user->institution == $inst->district_name ? 'selected' : '' }}>{{ $inst->district_name }}</option>
                                     @endforeach
                                  </select>
                               </div>

                               @if($user->resident_type === 'non-resident')
                                  <div class="form-group mb-15" id="modal-residence-text-wrapper">
                                     <label class="form-label-sm" style="font-size: 12px; font-weight: 600; color: #475569; display: block; margin-bottom: 6px;">Name of Residence *</label>
                                     <input required class="form-control" name="residence_name" id="modal_residence_name" type="text" value="{{ $user->hall }}" placeholder="Enter name of residence" style="height: 48px; border-radius: 10px; font-size: 14px;" />
                                  </div>
                               @else
                                  <div class="form-group mb-15" id="modal-hall-select-wrapper">
                                     <label class="form-label-sm" style="font-size: 12px; font-weight: 600; color: #475569; display: block; margin-bottom: 6px;">Residence Hall *</label>
                                     <select name="hall" id="modal_hall" class="form-control" style="height: 48px; border-radius: 10px; font-size: 14px;" required>
                                        <option value="" disabled selected>-- Select Hall --</option>
                                     </select>
                                  </div>
                               @endif
                            @endif

                            <div class="form-group mb-0">
                               <label class="form-label-sm" style="font-size: 12px; font-weight: 600; color: #475569; display: block; margin-bottom: 6px;">Phone Number *</label>
                               <input type="text" name="phone" id="modal_phone" value="{{ $user->phone }}" class="form-control" style="height: 48px; border-radius: 10px; font-size: 14px;" placeholder="e.g. 0243036092" required>
                               <div id="modal_phone_feedback" style="display: none; color: #d9534f; font-size: 12px; margin-top: 5px; font-weight: 500;">
                                  This phone number is already registered by another user.
                               </div>
                            </div>
                         </div>
                         <div class="modal-footer" style="border-top: 1px solid #f1f2f4; padding: 16px 24px; display: flex; justify-content: flex-end;">
                            <button type="submit" class="btn btn-default hover-up font-xs" style="background-color: #3BB77E; border-color: #3BB77E; color: white; padding: 12px 30px; border-radius: 10px; font-weight: 700; width: 100%;">
                               Save and Continue
                            </button>
                         </div>
                      </form>
                  </div>
               </div>
            </div>

            <script type="text/javascript">
                document.addEventListener("DOMContentLoaded", function() {
                   var myModal = new bootstrap.Modal(document.getElementById('profileVerificationModal'), {
                      backdrop: 'static',
                      keyboard: false
                   });
                   myModal.show();

                   var instSelect = document.getElementById('modal_institution');
                   var hallSelect = document.getElementById('modal_hall');

                   function loadHallsForSelectedInstitution() {
                      if (!hallSelect) return;
                      var selectedOption = instSelect.options[instSelect.selectedIndex];
                      var districtId = selectedOption ? selectedOption.getAttribute('data-id') : null;
                      
                      if (districtId) {
                         fetch("{{ url('/hall-get/ajax') }}/" + districtId)
                            .then(response => response.json())
                            .then(data => {
                               if (data.length > 0) {
                                  hallSelect.innerHTML = '<option value="" disabled selected>-- Select Hall --</option>';
                                  data.forEach(function(item) {
                                     var opt = document.createElement('option');
                                     opt.value = item.city;
                                     opt.textContent = item.city;
                                     hallSelect.appendChild(opt);
                                  });
                               } else {
                                  hallSelect.innerHTML = '<option value="" disabled selected>No halls available for this institution</option>';
                               }
                            })
                            .catch(error => {
                               hallSelect.innerHTML = '<option value="" disabled selected>No halls available for this institution</option>';
                            });
                      } else {
                         hallSelect.innerHTML = '<option value="" disabled selected>-- Select Hall --</option>';
                      }
                   }

                   if (instSelect) {
                      instSelect.addEventListener('change', loadHallsForSelectedInstitution);
                      if (instSelect.value) {
                         loadHallsForSelectedInstitution();
                      }
                   }

                  var phoneInput = document.getElementById('modal_phone');
                  var feedback = document.getElementById('modal_phone_feedback');
                  var submitBtn = document.querySelector('#profileVerificationModal button[type="submit"]');

                  function checkPhoneUnique() {
                     var phoneVal = phoneInput.value.trim();
                     if (phoneVal.length > 0) {
                        fetch("{{ url('/check-phone-unique') }}?phone=" + encodeURIComponent(phoneVal))
                           .then(response => response.json())
                           .then(data => {
                              if (data.unique) {
                                 phoneInput.style.borderColor = '';
                                 feedback.style.display = 'none';
                                 submitBtn.disabled = false;
                              } else {
                                 phoneInput.style.borderColor = '#d9534f';
                                 feedback.style.display = 'block';
                                 submitBtn.disabled = true;
                              }
                           });
                     } else {
                        phoneInput.style.borderColor = '';
                        feedback.style.display = 'none';
                        submitBtn.disabled = false;
                     }
                  }

                  if (phoneInput) {
                     phoneInput.addEventListener('input', checkPhoneUnique);
                     phoneInput.addEventListener('change', checkPhoneUnique);
                  }
               });
            </script>
         @endif
      @endif

      @if(session('welcome_notice'))
         <!-- Welcome Notice Modal -->
         <div class="modal fade" id="welcomeNoticeModal" tabindex="-1" aria-labelledby="welcomeNoticeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content" style="border-radius: 24px; border: none; overflow: hidden; background: linear-gradient(135deg, #ffffff 0%, #f4fbf7 100%); box-shadow: 0 20px 60px rgba(59, 183, 126, 0.15);">
                  <div style="padding: 40px 30px; text-align: center;">
                     <div style="font-size: 60px; margin-bottom: 20px;">🎉</div>
                     <h3 id="welcomeNoticeModalLabel" style="font-family: 'Outfit', sans-serif; font-weight: 800; color: #253D4E; margin-bottom: 12px;">Welcome to your Dashboard!</h3>
                     <p style="font-size: 15px; color: #7E7E7E; line-height: 1.6; margin-bottom: 30px;">
                        Your profile details have been successfully verified. You are now ready to place orders and enjoy swift, campus-wide deliveries!
                     </p>
                     <button type="button" class="btn btn-default hover-up" data-bs-dismiss="modal" style="background-color: #3BB77E; border-color: #3BB77E; color: white; padding: 12px 40px; border-radius: 12px; font-weight: 700; width: 100%; font-size: 14px;">
                        Explore Products
                     </button>
                  </div>
               </div>
            </div>
         </div>

         <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
               var welcomeModal = new bootstrap.Modal(document.getElementById('welcomeNoticeModal'));
               welcomeModal.show();
            });
         </script>
      @endif

      @if(!request()->is('user/complaints*'))
        @php
          try {
              $ip = request()->ip();
              $sessionId = session()->getId();
              $url = request()->fullUrl();
              
              $recentVisitExists = \Illuminate\Support\Facades\DB::table('chat_visitor_logs')
                  ->where('session_id', $sessionId)
                  ->where('url', $url)
                  ->where('created_at', '>=', now()->subMinutes(5))
                  ->exists();
                  
              if (!$recentVisitExists) {
                  \Illuminate\Support\Facades\DB::table('chat_visitor_logs')->insert([
                      'ip_address' => $ip,
                      'session_id' => $sessionId,
                      'url' => $url,
                      'chat_started' => false,
                      'chat_answered' => false,
                      'created_at' => now(),
                      'updated_at' => now(),
                  ]);
              }
          } catch (\Exception $e) {}
        @endphp

        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        Tawk_API.customStyle = {
            visibility : {
                desktop : {
                    position : 'bl',
                    xOffset : 15,
                    yOffset : 75
                },
                mobile : {
                    position : 'bl',
                    xOffset : 15,
                    yOffset : 75
                }
            }
        };
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/6a4fa09ba6558f1d451fdc7b/1jt3gmors';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        <!--End of Tawk.to Script-->

        <script type="text/javascript">
           $(document).ready(function() {
              // Hide Tawk.to widget via JS API when any modal opens
              $(document).on('show.bs.modal', '.modal', function () {
                 if (window.Tawk_API && typeof window.Tawk_API.hideWidget === 'function') {
                    try { window.Tawk_API.hideWidget(); } catch(e) {}
                 }
              });
              // Show Tawk.to widget via JS API when any modal closes
              $(document).on('hidden.bs.modal', '.modal', function () {
                 if (window.Tawk_API && typeof window.Tawk_API.showWidget === 'function') {
                    try { window.Tawk_API.showWidget(); } catch(e) {}
                 }
              });

              // Toggle sidebar widgets collapse/expand globally (Category, Brand, New products)
              $(document).on('click', '.collapsible-widget-title', function() {
                 var $title = $(this);
                 var $widget = $title.closest('.sidebar-widget');
                 var $content = $widget.find('.collapsible-widget-content');
                 
                 if ($content.is(':visible')) {
                    $title.removeClass('active');
                    $widget.addClass('widget-collapsed');
                    $content.slideUp(300);
                 } else {
                    $title.addClass('active');
                    $widget.removeClass('widget-collapsed');
                    $content.slideDown(300);
                 }
              });
           });
        </script>

        @include('front.sections.floating_panel')
      @endif

   </body>
</html>
