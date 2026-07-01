@php
$products = App\Models\Product::where('status', 1)->orderBy('id','DESC')->limit(15)->get();
$categories = App\Models\Category::orderBy('category_name', 'DESC')->limit(7)->get();
@endphp

@if($categories)
<section class="product-tabs section-padding position-relative">
   <div class="container">
      <div class="section-title style-2 wow animate__animated animate__fadeIn">
         <h3 class="d-none d-lg-block">Products</h3>
         <ul class="nav nav-tabs links" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
               <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">All</button>
            </li>
            @foreach($categories as $category)
            <li class="nav-item" role="presentation">
               <a href="#category{{ $category->id }}" class="nav-link" id="nav-tab-two" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab-two" aria-selected="false">
               {{ $category->category_name }}
               </a>
            </li>
            @endforeach
         </ul>
      </div>
      <!--End nav-tabs-->

      <div class="tab-content" id="myTabContent">

         {{-- All products --}}
         <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
            <div class="row product-grid-4">
               @foreach($products as $product)
               <div class="col-lg-1-5 col-md-4 col-6 col-sm-6">
                  <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                     <div class="product-img-action-wrap">
                        <div class="product-img product-img-zoom">
                           {{-- <a href="javascript:;"> --}}
                           <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                              <img class="default-img" src="{{ asset($product->product_thumbnail) }}" alt="" loading="lazy" />
                           </a>
                        </div>

                        {{-- Large screen --}}
                        <div class="product-action-1 d-none d-lg-block">
                           <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>
                           <a aria-label="Compare" class="action-btn" id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                           <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                           {{-- <a href="{{ route('product.modal', $product->id) }}" aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a> --}}
                        </div>

                        @php
                        $amount = $product->selling_price - $product->discount_price;
                        $discount = ($amount/$product->selling_price) * 100;
                        @endphp
                        <div class="product-badges product-badges-position product-badges-mrg">
                           @if($product->discount_price == NULL)
                           {{-- <span class="new">New</span> --}}
                           @else
                           {{-- <span class="hot"> {{ round($discount) }} %</span> --}}
                           <span class="hot"> {{ round($product->discount_price) }} %</span>
                           @endif
                        </div>
                     </div>
                     <div class="product-content-wrap">
                        {{-- <div class="product-category">
                           <a href="{{ url('product/category/'.$product['category']['id'].'/'.$product['category']['category_slug']) }}">{{ $product['category']['category_name'] }}</a>
                        </div> --}}
                        <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ $product->product_name }}</a></h2>

                        {{-- mobile --}}
                        <div class="product-action-1-mobile d-block d-lg-none">
                           <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>
                           {{-- <a aria-label="Compare" class="action-btn" id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>--}}
                           <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                        </div>

                        {{-- @php
                        $reviewcount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                        $avarage = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                        @endphp
                        <div class="product-rate-cover">
                           <div class="product-rate d-inline-block">
                              @if($avarage == 0)
                              @elseif($avarage == 1 || $avarage < 2)
                              <div class="product-rating" style="width: 20%"></div>
                              @elseif($avarage == 2 || $avarage < 3)
                              <div class="product-rating" style="width: 40%"></div>
                              @elseif($avarage == 3 || $avarage < 4)
                              <div class="product-rating" style="width: 60%"></div>
                              @elseif($avarage == 4 || $avarage < 5)
                              <div class="product-rating" style="width: 80%"></div>
                              @elseif($avarage == 5 || $avarage < 5)
                              <div class="product-rating" style="width: 100%"></div>
                              @endif
                           </div>
                           <span class="font-small ml-5 text-muted"> ({{count($reviewcount)}})</span>
                        </div> --}}

                        {{-- <div>
                           @if($product->vendor_id == NULL)
                           <span class="font-small text-muted">By <a href="vendor-details-1.html">Owner</a></span>
                           @else
                           <span class="font-small text-muted">By <a href="vendor-details-1.html">{{ $product->vendor->name }}</a></span>
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
                           {{-- <button type="submit" class="button button-add-to-cart" onclick="addToCartDetails()"><i class="fi-rs-shopping-cart"></i>Add to cart</button>                            --}}
                           <div class="add-cart d-block d-lg-block">
                              <a class="add" href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>
               @endforeach
            </div>
         </div>

         {{-- Category products --}}
         @foreach($categories as $category)
         <div class="tab-pane fade" id="category{{ $category->id }}" role="tabpanel" aria-labelledby="tab-two">
            <div class="row product-grid-4">

               @php
               $catwiseProduct = App\Models\Product::where('category_id', $category->id)->where('status', 1)->orderBy('id', 'DESC')->limit(15)->get();
               @endphp

               @forelse ( $catwiseProduct as $product )
                  <div class="col-lg-1-5 col-md-4 col-6 col-sm-6">
                     <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                        <div class="product-img-action-wrap">
                           <div class="product-img product-img-zoom">
                              {{-- <a href="javascript:;"> --}}
                              <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                              <img class="default-img" src="{{ asset($product->product_thumbnail) }}" alt="" loading="lazy" />
                              </a>
                           </div>
                           <div class="product-action-1">
                              <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>
                              <a aria-label="Compare" class="action-btn" id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                              <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
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
                           {{-- <div class="product-category">
                              <a href="{{ url('product/category/'.$product['category']['id'].'/'.$product['category']['category_slug']) }}">{{ $product->category->category_name }}</a>
                           </div> --}}
                           <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ $product->product_name }}</a></h2>
                           <div class="product-action-1-mobile d-block d-lg-none">
                              <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>
                              {{-- <a aria-label="Compare" class="action-btn" id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>                            --}}
                              <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                           </div>

                           {{-- @php
                           $reviewcount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                           $avarage = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                           @endphp
                           <div class="product-rate-cover">
                              <div class="product-rate d-inline-block">
                                 @if($avarage == 0)
                                 @elseif($avarage == 1 || $avarage < 2)
                                 <div class="product-rating" style="width: 20%"></div>
                                 @elseif($avarage == 2 || $avarage < 3)
                                 <div class="product-rating" style="width: 40%"></div>
                                 @elseif($avarage == 3 || $avarage < 4)
                                 <div class="product-rating" style="width: 60%"></div>
                                 @elseif($avarage == 4 || $avarage < 5)
                                 <div class="product-rating" style="width: 80%"></div>
                                 @elseif($avarage == 5 || $avarage < 5)
                                 <div class="product-rating" style="width: 100%"></div>
                                 @endif
                              </div>
                              <span class="font-small ml-5 text-muted"> ({{count($reviewcount)}})</span>
                           </div> --}}
                           {{-- <div>
                              <span class="font-small text-muted">By <a href="vendor-details-1.html">NestFood</a></span>
                              @if($product->vendor_id == NULL)
                              <span class="font-small text-muted">By <a href="vendor-details-1.html">Owner</a></span>
                              @else
                              <span class="font-small text-muted">By <a href="vendor-details-1.html">{{ $product->vendor->name }}</a></span>
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
                  @empty
                  <div style="margin: 0 auto; text-align: center;">
                      <h5 class="text-danger">No Product Found</h5>
                  </div>
               @endforelse
               <!--end product card-->
            </div>
            <!--End product-grid-4-->
         </div>
         @endforeach

         <div class="container text-center mt-10 mb-10">
            <a href="{{ route('shop.page') }}" class="btn btn-xs">Shop for more items <i class="fi-rs-arrow-small-right"></i></a>
         </div>

         <!-- SG Features Horizontal Promo Ads Banner -->
         <div class="container mt-20 mb-30">
             <div class="sg-promo-banner-container">
                 <h4 class="sg-promo-title">✨ Smart Groceries Campus Hub</h4>
                 <div class="sg-promo-slider">
                     <div class="sg-promo-card" onclick="toggleSgDrawer('expert')">
                         <div class="sg-promo-icon">🛡️</div>
                         <div class="sg-promo-info">
                             <h5>Connect to Expert</h5>
                             <p>Consult verified health & nutrition experts on campus.</p>
                         </div>
                         <span class="sg-promo-arrow">→</span>
                     </div>
                     <div class="sg-promo-card" onclick="toggleSgDrawer('blog')">
                         <div class="sg-promo-icon">📝</div>
                         <div class="sg-promo-info">
                             <h5>Campus Blog</h5>
                             <p>Stay updated with latest news, lifestyle & survival tips.</p>
                         </div>
                         <span class="sg-promo-arrow">→</span>
                     </div>
                     <div class="sg-promo-card" onclick="toggleSgDrawer('affiliate')">
                         <div class="sg-promo-icon">🎁</div>
                         <div class="sg-promo-info">
                             <h5>Affiliate Program</h5>
                             <p>Share your link & earn Gh 15.00 cash for each sign-up.</p>
                         </div>
                         <span class="sg-promo-arrow">→</span>
                     </div>
                     <div class="sg-promo-card" onclick="toggleSgDrawer('request')">
                         <div class="sg-promo-icon">✍️</div>
                         <div class="sg-promo-info">
                             <h5>Request an Item</h5>
                             <p>Can't find a product? Tell us, we'll get it delivered.</p>
                         </div>
                         <span class="sg-promo-arrow">→</span>
                     </div>
                 </div>
             </div>
         </div>

         <style>
         .sg-promo-banner-container {
             background: linear-gradient(135deg, #3BB77E 0%, #2fa56f 100%);
             border-radius: 20px;
             padding: 24px 30px;
             box-shadow: 0 10px 30px rgba(59, 183, 126, 0.15);
             margin-top: 15px;
         }
         .sg-promo-title {
             color: #ffffff !important;
             font-size: 18px;
             font-weight: 800;
             margin-bottom: 20px;
             text-align: left;
             letter-spacing: 0.3px;
         }
         .sg-promo-slider {
             display: grid;
             grid-template-columns: repeat(4, 1fr);
             gap: 20px;
         }
         .sg-promo-card {
             background: rgba(255, 255, 255, 0.12);
             backdrop-filter: blur(10px);
             -webkit-backdrop-filter: blur(10px);
             border: 1px solid rgba(255, 255, 255, 0.15);
             border-radius: 16px;
             padding: 20px;
             display: flex;
             align-items: center;
             gap: 15px;
             cursor: pointer;
             transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
             position: relative;
             overflow: hidden;
             text-align: left;
         }
         .sg-promo-card::before {
             content: '';
             position: absolute;
             top: 0;
             left: 0;
             width: 100%;
             height: 100%;
             background: rgba(255, 255, 255, 0.08);
             opacity: 0;
             transition: opacity 0.3s ease;
         }
         .sg-promo-card:hover {
             transform: translateY(-4px);
             background: rgba(255, 255, 255, 0.2);
             border-color: rgba(255, 255, 255, 0.35);
             box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
         }
         .sg-promo-card:hover::before {
             opacity: 1;
         }
         .sg-promo-icon {
             font-size: 28px;
             flex-shrink: 0;
         }
         .sg-promo-info {
             flex: 1;
         }
         .sg-promo-info h5 {
             color: #ffffff !important;
             font-size: 14px;
             font-weight: 700;
             margin: 0 0 5px 0;
         }
         .sg-promo-info p {
             color: rgba(255, 255, 255, 0.85) !important;
             font-size: 11px;
             margin: 0;
             line-height: 1.4;
         }
         .sg-promo-arrow {
             color: rgba(255, 255, 255, 0.6);
             font-size: 16px;
             font-weight: bold;
             transition: transform 0.3s ease, color 0.3s ease;
         }
         .sg-promo-card:hover .sg-promo-arrow {
             transform: translateX(4px);
             color: #ffffff;
         }

         @media (max-width: 991px) {
             .sg-promo-slider {
                 grid-template-columns: repeat(2, 1fr);
             }
         }

         @media (max-width: 767px) {
             .sg-promo-banner-container {
                 padding: 20px 15px;
             }
             .sg-promo-title {
                 font-size: 16px;
                 margin-bottom: 15px;
                 padding-left: 5px;
             }
             .sg-promo-slider {
                 display: flex;
                 overflow-x: auto;
                 scroll-snap-type: x mandatory;
                 gap: 12px;
                 padding: 5px;
                 scrollbar-width: none; /* Hide scrollbar Firefox */
             }
             .sg-promo-slider::-webkit-scrollbar {
                 display: none; /* Hide scrollbar Chrome/Safari */
             }
             .sg-promo-card {
                 flex: 0 0 85%;
                 scroll-snap-align: center;
                 padding: 16px;
             }
         }
         </style>

      </div>
      <!--End tab-content-->
   </div>
</section>
@else

@endif
