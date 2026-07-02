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
            width: 32px !important;
            height: 32px !important;
            line-height: 32px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
         }
         .product-cart-wrap .product-action-1 a.action-btn i {
            font-size: 13px !important;
            line-height: 1 !important;
         }

         /* Mobile actions alignment (only on screens < 992px) */
         @media (max-width: 991.98px) {
            .product-action-1-mobile {
               display: flex !important;
               align-items: center !important;
               justify-content: flex-start !important;
               gap: 8px !important;
               margin-top: 5px !important;
               white-space: nowrap !important;
            }
            .product-action-1-mobile a {
               padding: 0 !important;
               display: inline-flex !important;
               align-items: center !important;
               justify-content: center !important;
               font-size: 18px !important;
            }
          }
          
          /* Hide SG floating panel when a modal is open on mobile view */
          @media (max-width: 768px) {
             body.modal-open #sg-floating-dock,
             body.modal-open #sg-restore-handle {
                display: none !important;
             }
          }

          /* Premium horizontal quantity selector layout for all screen sizes (Desktop & Mobile) */
          .detail-qty {
             max-width: 120px !important;
             height: 40px !important;
             display: inline-flex !important;
             align-items: center !important;
             justify-content: space-between !important;
             position: relative !important;
             padding: 0 !important;
             border-radius: 8px !important;
             border: 1.5px solid #ececec !important;
             overflow: hidden !important;
             background: #fff !important;
          }

          /* On mobile, make it slightly larger for better tap-ability */
          @media (max-width: 768px) {
             .detail-qty {
                max-width: 140px !important;
                height: 48px !important;
                border-radius: 12px !important;
             }
          }

          /* Centered Input field */
          .detail-qty input.qty-val {
             order: 2 !important;
             width: 36px !important;
             height: 100% !important;
             margin: 0 !important;
             text-align: center !important;
             font-size: 15px !important;
             font-weight: 700 !important;
             color: #253D4E !important;
             background: transparent !important;
             z-index: 1 !important;
             border: none !important;
             padding: 0 !important;
          }
          @media (max-width: 768px) {
             .detail-qty input.qty-val {
                width: 44px !important;
                font-size: 16px !important;
             }
          }

          /* Side buttons */
          .detail-qty > a {
             position: static !important;
             width: 36px !important;
             height: 100% !important;
             display: flex !important;
             align-items: center !important;
             justify-content: center !important;
             font-size: 16px !important;
             color: #253D4E !important;
             background: #f7f8fa !important;
             transition: all 0.2s ease !important;
             cursor: pointer !important;
             text-decoration: none !important;
          }
          @media (max-width: 768px) {
             .detail-qty > a {
                width: 44px !important;
                font-size: 18px !important;
             }
          }

          .detail-qty > a:hover {
             background: #f1f2f4 !important;
             color: #3bb77e !important;
          }

          .detail-qty > a.qty-down {
             order: 1 !important;
          }

          .detail-qty > a.qty-up {
             order: 3 !important;
          }

          /* Custom text characters for plus and minus */
          .detail-qty > a.qty-up i::before {
             content: "+" !important;
             font-family: inherit !important;
             font-weight: 700 !important;
          }
          .detail-qty > a.qty-down i::before {
             content: "-" !important;
             font-family: inherit !important;
             font-weight: 700 !important;
          }
          
          /* Mobile side-by-side layout for quantity selector and add to cart button */
          @media (max-width: 768px) {
             .detail-info {
                display: flex !important;
                flex-direction: column !important;
             }

             .detail-extralink {
                display: inline-flex !important;
                flex-direction: row !important;
                align-items: center !important;
                width: auto !important;
                margin-bottom: 15px !important;
                margin-top: 10px !important;
                float: left !important;
                vertical-align: middle !important;
             }

             .product-extra-link2 {
                display: inline-flex !important;
                align-items: center !important;
                vertical-align: middle !important;
                margin-top: 10px !important;
                margin-bottom: 15px !important;
                float: left !important;
             }

             /* Quick View Modal layout specific */
             .detail-info .detail-extralink {
                width: 140px !important;
                margin-right: 12px !important;
                margin-bottom: 0 !important;
             }
             .detail-info .product-extra-link2 {
                width: calc(100% - 152px) !important;
                margin-top: 10px !important;
             }
             .detail-info .product-extra-link2 button.btn {
                width: 100% !important;
                height: 48px !important;
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                padding: 0 15px !important;
                font-size: 15px !important;
                font-weight: 700 !important;
                border-radius: 12px !important;
                margin: 0 !important;
                white-space: nowrap !important;
             }

             /* Details page layout specific */
             .detail-extralink .product-extra-link2 {
                flex: 1 !important;
                width: auto !important;
                margin: 0 !important;
             }
             .detail-extralink .product-extra-link2 button.button-add-to-cart {
                width: 100% !important;
                height: 48px !important;
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                padding: 0 15px !important;
                font-size: 15px !important;
                font-weight: 700 !important;
                border-radius: 12px !important;
                margin: 0 !important;
                white-space: nowrap !important;
             }
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
      <script src="{{ asset('front/assets/js/main.js?v=5.5') }}" defer></script>
      <script src="{{ asset('front/assets/js/shop.js?v=6.2') }}" defer></script>
      <script src="{{ asset('front/assets/js/script.js') }}" defer></script>
      <script src="{{ asset('back/assets/plugins/datatable/js/jquery.dataTables.min.js') }}" defer></script>
      <script>
         $(document).ready(function() {
            if ($('#example').length) { $('#example').DataTable(); }
           } );
      </script>
      <script src="{{ asset('front/assets/js/code.js') }}" defer></script>
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
            $('#available').text('');
            $('#stockout').text('');
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
               $('#pprice').text(data.product.selling_price);
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
                $('#pprice').text(data.product.selling_price).attr('data-base-price', data.product.selling_price);
               }else{
                  $('#pprice').text(data.new_price.toFixed(2)).attr('data-base-price', data.new_price);
                  $('#oldprice').text(data.product.selling_price).attr('data-base-price', data.product.selling_price);
                  $('#hide_curreny').text('Gh');
            } // end else

            /// Start Stock Option
            if (data.total_stock > 0) {
                $('#available').text('');
                $('#stockout').text('');
                $('#call_us').text('');
                $('#total_stock').text(data.total_stock);
                $('#available').text('Available in stock');
                $('#quantity_stock').text('');
            }else{
                $('#available').text('');
                $('#stockout').text('');
                $('#stockout').text('Stock Out');
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
             var showColor = true;
             if (!data.color || data.color.length === 0 || (data.color.length === 1 && data.color[0].trim().toLowerCase() === 'none') || data.color == "") {
                 showColor = false;
             }
             if (!showColor) {
                 $('#colorArea').hide();
             } else {
                 $('select[name="color"]').append('<option selected="" disabled=""> --select variant-- </option>');
                 $('#colorArea').show();
                 $.each(data.color, function(key, value){
                     if (value.trim().toLowerCase() !== 'none') {
                         $('select[name="color"]').append('<option value="'+value+' ">'+value+'  </option>');
                     }
                 });
             }
             
             // Trigger state watch instantly on modal load
             if (typeof window.updateQuantityState === 'function') {
                 window.updateQuantityState($('#quickViewModal'));
             }

            }
         })
         }

         /// Start Add To Cart Prodcut
         function addToCart(){
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

      <!--  /// Start Compare Add -->
      <script type="text/javascript">
         function addToCompare(product_id){
             $.ajax({
                 type: "POST",
                 dataType: 'json',
                 url: "/add-to-compare/"+product_id,
                 success:function(data){

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
      <!--  /// End Compare Add -->

      <!--  /// Start Load Compare Data -->
      <script type="text/javascript">
         function compare(){
             $.ajax({
                 type: "GET",
                 dataType: 'json',
                 url: "/get-compare-product/",
                 success:function(response){
                    var rows = ""
                    $.each(response, function(key,value){
         rows += ` <tr class="pr_image">
                                     <td class="text-muted font-sm fw-600 font-heading mw-200">Preview</td>
         <td class="row_img"><img src="/${value.product.product_thumbnail} " style="width:300px; height:300px;"  alt="compare-img" /></td>

                                 </tr>
                                 <tr class="pr_title">
                                     <td class="text-muted font-sm fw-600 font-heading">Name</td>
                                     <td class="product_name">
                                         <h6><a href="" class="text-heading">${value.product.product_name} </a></h6>
                                     </td>

                                 </tr>
                                 <tr class="pr_price">
                                     <td class="text-muted font-sm fw-600 font-heading">Price</td>
                                     <td class="product_price">
                       ${value.product.discount_price == null
                         ? `<h4 class="price text-brand">Gh ${value.product.selling_price}</h4>`
                         :`<h4 class="price text-brand">Gh ${((100 - value.product.discount_price)/100) * value.product.selling_price}</h4><h4 class="wishlist-change">Gh ${value.product.selling_price}</h4>`
                         }
                                     </td>

                                 </tr>

                                 <tr class="description">
                                     <td class="text-muted font-sm fw-600 font-heading">Description</td>
                                     <td class="row_text font-xs">
                                         <p class="font-sm text-muted"> ${value.product.short_descp}</p>
                                     </td>

                                 </tr>
                                 <tr class="pr_stock">
                                     <td class="text-muted font-sm fw-600 font-heading">Stock status</td>
                                     <td class="row_stock">
                                 ${value.product.product_qty > 0
                                 ? `<span class="stock-status in-stock mb-0"> In Stock </span>`
                                 :`<span class="stock-status out-stock mb-0">Stock Out </span>`
                                }
                               </td>

                                 </tr>

             <tr class="pr_remove text-muted">
                 <td class="text-muted font-md fw-600"></td>
                 <td class="row_remove">
                  <a type="submit" class="text-muted"  id="${value.id}" onclick="compareRemove(this.id)"><i class="fi-rs-trash mr-5"></i><span>Remove</span> </a>
                 </td>

             </tr> `
         });
         $('#compare').html(rows);
                 }
             })
         }
         // Delay compare load until after page renders
         setTimeout(function(){ compare(); }, 1600);
         // / End Load Compare Data -->
         // Compare Remove Start
         function compareRemove(id){
                  $.ajax({
                      type: "GET",
                      dataType: 'json',
                      url: "/compare-remove/"+id,
                      success:function(data){
                      compare();
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

         // Compare Remove End
      </script>
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

      @include('front.sections.floating_panel')

   </body>
</html>
