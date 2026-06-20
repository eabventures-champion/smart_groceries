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
      <script src="{{ asset('front/assets/js/shop.js?v=5.3') }}" defer></script>
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
         // alert(id)
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
               //  $('#pprice').text('');
                $('#oldprice').text('');
                $('#hide_curreny').text('');
                $('#pprice').text(data.product.selling_price);
               }else{
                  $('#pprice').text(data.new_price.toFixed(2));
                  $('#oldprice').text(data.product.selling_price);
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
             $('select[name="size"]').append('<option selected="" disabled=""> --select size-- </option>')
             $.each(data.product_attribute,function(key,value){
                $('select[name="size"]').append('<option value="'+value.size+' ">'+value.size+'  </option')
             })
             // end size

            ///Color
             $('select[name="color"]').empty();
             if (data.color == "") {
               $('#colorArea').hide();
               }else{
                  $('select[name="color"]').append('<option selected="" disabled=""> --select variant-- </option>')
                  $('#colorArea').show();
             }
             $.each(data.color,function(key,value){
                $('select[name="color"]').append('<option value="'+value+' ">'+value+'  </option')
             })

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
                        miniCart();
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
         function miniCart(){
            $.ajax({
               type: 'GET',
               url: '/product/mini/cart',
               dataType: 'json',
               success:function(response){
                  $('span[id="cartSubTotal"]').text(response.cartTotal);
                  $('#cartQty').text(response.cartQty);
                  $('#cartQty-mobile').text(response.cartQty);
                  $('#cartItems').text(response.cartItems);

                  // console.log(response)
         var miniCart = ""
         $.each(response.carts, function(key,value){
         miniCart += ` <ul>
            <li>
               <div class="shopping-cart-img">
                  <a href=""><img alt="Nest" src="/${value.options.image} " style="width:50px;height:50px;" /></a>
               </div>
               <div class="shopping-cart-title" style="margin: -55px 74px 14px; width: 146px;">
                  <h4>
                     <a href="">
                        ${value.name} - ${value.options.size}

                        ${value.options.color == null
                           ? `<span></span>`
                           : `<br><span>(${value.options.color})</span>`
                         }
                     </a>
                  </h4>
                  <h4><span>${value.qty} × </span>${value.price}<span> = Gh ${value.qty * value.price}</span></h4>
               </div>
               <div class="shopping-cart-delete" style="margin: -55px 10px 0px;">
                  <a type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"  ><i class="fi-rs-cross-small"></i></a>
               </div>
            </li>
         </ul>
         <hr><br>
               `
         });
            $('#miniCart').html(miniCart);
            $('#miniCart-mobile').html(miniCart);
               }
            })
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
         miniCart();
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
         var quantity = $('#dqty').val();

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
            miniCart();
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
                  wishlist();
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
         function wishlist(){
            $.ajax({
               type: "GET",
               dataType: 'json',
               url: "/get-wishlist-product/",
               success:function(response){
                  $('#wishQty').text(response.wishQty);
                  $('#wishQty-mobile').text(response.wishQty);
                  var rows = ""
                     $.each(response.wishlist, function(key,value){

               rows += `<tr class="pt-30">
                            <td class="custome-checkbox start"></td>
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
                        </tr>`
               });
               $('#wishlist').html(rows);

               }
               })
            }
            // Delay wishlist load until after page renders
            setTimeout(function(){ wishlist(); }, 1200);

            // / End Load Wishlist Data -->

         // Wishlist Remove Start
         function wishlistRemove(id){
               $.ajax({
                  type: "GET",
                  dataType: 'json',
                  url: "/wishlist-remove/"+id,
                  success:function(data){
                  wishlist();
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
               //  console.log(response)

            var rows = ""
            $.each(response.carts, function(key,value){

               rows += `<tr class="pt-30">
                <td class="custome-checkbox start"></td>
                <td class="image product-thumbnail pt-40"><img src="/${value.options.image} " alt="#">
                <h6><a class="product-name text-heading" href="">${value.name} </a></h6>
                </td>

                <td class="price" data-title="Price">
                    <h6 class="text-body">Gh ${value.price} </h6>
                </td>
                <td class="price" data-title="Properties">
                  ${value.options.color == null
                    ? `<span></span>`
                    : `<br><span>(${value.options.color})</span>`
                  }

                  ${value.options.size == null
                    ? `<span>size not selected</span>`
                    : `<h6 class="text-body">${value.options.size} </h6>`
                  }
                </td>

                <td class="price" data-title="Quantity">
                    <div class="detail-extralink">
                        <div class="detail-qty border radius">
                         <a type="submit" class="qty-down" id="${value.rowId}" onclick="cartDecrement(this.id)"><i class="fi-rs-angle-small-down"></i></a>
                         <input type="text" name="quantity" class="qty-val" value="${value.qty}" min="1">
                         <a type="submit" class="qty-up" id="${value.rowId}" onclick="cartIncrement(this.id)"><i class="fi-rs-angle-small-up"></i></a>
                        </div>
                    </div>
                </td>

                <td class="price" data-title="Sub total">
                    <h5 class="text-brand">Gh ${value.subtotal} </h5>
                </td>

                <td class="action text-center" data-title="Remove">
                 <a type="submit" class="text-body" id="${value.rowId}" onclick="cartRemove(this.id)"><i class="fi-rs-trash"></i></a></td>       </tr>`
              });
                $('#cartPage').html(rows);
            }
         })
         }
         // Delay cart load until after page renders
         setTimeout(function(){ cart(); }, 1000);

         // Cart Remove Start
         function cartRemove(id){
                 $.ajax({
                     type: "GET",
                     dataType: 'json',
                     url: "/cart-remove/"+id,
                     success:function(data){
                         cart();
                         miniCart();
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
                    miniCart();

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
                  miniCart();

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
