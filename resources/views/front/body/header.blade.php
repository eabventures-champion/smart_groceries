   <header class="header-area header-style-1 header-height-2" style="background-color: #351313;">

       <div class="mobile-promotion">
           {{-- <span>
               Leave <strong>the</strong> grocery <strong>shopping</strong> to us.
            </span> --}}
           <span>
               <img class="mobile_name" src="{{ asset('front/assets/imgs/theme/smart_8i.png') }}" />
               <p style="font-size: .65rem !important; color:white;">Your Trusted Campus Grocery Partner!</p>
           </span>

       </div>

       {{-- Information at the top --}}
       {{-- Large screen - Header 1 --}}
       <div class="header-top header-top-ptb-1 d-none d-lg-block" style="background-color: white;">
           <div class="container">
               <div class="row align-items-center">
                   <div class="col-xl-3 col-lg-4">
                       <div class="header-info">
                           <ul>
                               <li><a style="color: #000000;" href="{{ route('mycart') }}">My Cart</a></li>
                               <li><a style="color: #000000;" href="{{ route('user.track.order') }}">Order Tracking</a>
                               </li>
                           </ul>
                       </div>
                   </div>
                   <div class="col-xl-6 col-lg-4">
                       <div class="text-center">
                           <div id="news-flash" class="d-inline-block">
                               <ul style="color: #ffffff">
                                   {{--
                           <ul style="color: #193326">
                              --}}
                                   <li style="color: #000000;">Trusted by every household</li>
                                   <li style="color: #000000;">A grocery delivery service that doesn’t hurt your wallet
                                   </li>
                                   <li style="color: #000000;">You need it, we deliver it</li>
                                   <li style="color: #000000;">Your fast and friendly grocery delivery service</li>
                                   <li style="color: #000000;">Let us be your shopping cart</li>
                               </ul>
                           </div>
                       </div>
                   </div>
                   <div class="col-xl-3 col-lg-4">
                       <div class="header-info header-info-right">
                           <ul style="color: #ffffff">
                               <li style="color: #000000;">Need help? Call Us: &nbsp;<strong class=""
                                       style="color: #000000;"> {{ $setting->support_phone }}</strong></li>
                           </ul>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       {{-- End of Large Screen - Header 1 --}}


       {{-- Large screen - Header 2 --}}
       <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
           <div class="container">
               <div class="header-wrap">
                   <div class="logo logo-width-1">
                       <a href="/"><img src="{{ asset('front/assets/imgs/theme/smart_5.png') }}" alt="logo" />
                       </a>

                       {{-- <a href="{{ url('/') }}"><img src="{{ asset($setting->logo) }}" alt="logo" /></a> --}}
                   </div>
                   <div style="width: 14%" class="mr-30 mt-20">
                       <span><a href="/"><img
                                   src="{{ asset('front/assets/imgs/theme/smart_8i.png') }}" /></span></a>
                   </div>
                   <div class="header-right">
                       <div class="search-style-2">
                           <form action="{{ route('product.search') }}" method="post">
                               @csrf
                               {{--
                           <select class="select-active">
                              <option>All Categories</option>
                              <option>Milks and Dairies</option>
                              <option>Wines & Alcohol</option>
                              <option>Clothing & Beauty</option>
                              <option>Pet Foods & Toy</option>
                              <option>Fast food</option>
                              <option>Baking material</option>
                              <option>Vegetables</option>
                              <option>Fresh Seafood</option>
                              <option>Noodles & Rice</option>
                              <option>Ice cream</option>
                           </select>
                           --}}
                               <input onfocus="search_result_show()" onblur="search_result_hide()" name="search"
                                   id="search" placeholder="Search for items..." />
                               <div id="searchProducts"></div>
                           </form>
                       </div>
                       <div class="header-action-right">
                           <div class="header-action-2">
                               {{-- Location display on extra large screen --}}
                               {{--
                           <div class="search-location">
                              <form action="#">
                                 <select class="select-active">
                                    <option>Your Location</option>
                                    <option>Alabama</option>
                                    <option>Alaska</option>
                                    <option>Arizona</option>
                                    <option>Delaware</option>
                                    <option>Florida</option>
                                    <option>Georgia</option>
                                    <option>Hawaii</option>
                                    <option>Indiana</option>
                                    <option>Maryland</option>
                                    <option>Nevada</option>
                                    <option>New Jersey</option>
                                    <option>New Mexico</option>
                                    <option>New York</option>
                                 </select>
                              </form>
                           </div>
                           --}}
                               {{-- Compare --}}
                               {{-- <div class="header-action-icon-2">
                              <a href="{{ route('compare') }}">
                              <img class="svgInject" alt="SmartGroceries&Deliveries" src="{{ asset('front/assets/imgs/theme/icons/icon-compare.svg')}}" />
                              </a>
                              <a href="{{ route('compare') }}"><span class="lable ml-0" style="color:#ffffff !important">Compare</span></a>
                           </div> --}}
                               {{-- Wishlist --}}
                               <div class="header-action-icon-2">
                                   <a href="{{ route('wishlist') }}">
                                       <img class="svgInject" alt="SmartGroceries&Deliveries"
                                           src="{{ asset('front/assets/imgs/theme/icons/icon-heart.svg') }}" />
                                       <span class="pro-count blue" style="background-color: #7B2828 !important"
                                           id="wishQty">0</span>
                                   </a>
                                   <a href="{{ route('wishlist') }}"><span class="lable"
                                           style="color:#ffffff !important">Wishlist</span></a>
                               </div>
                               {{-- Add to cart --}}
                               <div class="header-action-icon-2">
                                   <a class="mini-cart-icon" href="{{ route('mycart') }}">
                                       <img alt="SmartGroceries&Deliveries"
                                           src="{{ asset('front/assets/imgs/theme/icons/icon-cart.svg') }}" />
                                       <span class="pro-count blue" style="background-color: #7B2828 !important"
                                           id="cartQty">0</span>
                                   </a>
                                   <a href="{{ route('mycart') }}"><span class="lable"
                                           style="color:#ffffff !important">Cart</span></a>
                                   <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                       <div id="miniCart"
                                           style="max-height: 350px; overflow-y: auto; scrollbar-width: thin;"></div>
                                       <div class="shopping-cart-footer">
                                           <div class="shopping-cart-total">
                                               <h4>Total (Gh) <span id="cartSubTotal"></span></h4>
                                           </div>
                                           <div class="shopping-cart-button">
                                               <a href="{{ route('mycart') }}" class="outline">View cart</a>
                                               <a href="{{ route('checkout') }}">Checkout</a>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="header-action-icon-2">
                                   <a href="{{ route('dashboard') }}">
                                       <img class="svgInject" alt="SmartGroceries&Deliveries"
                                           src="{{ asset('front/assets/imgs/theme/icons/user-3296_white.svg') }}" />&nbsp;
                                   </a>
                                   @auth
                                       <a href="{{ route('dashboard') }}"><span class="lable ml-0"
                                               style="color:#ffffff !important">My Account</span></a>
                                       {{-- <a href="{{ route('mycart') }}"><span class="lable" style="color:#ffffff !important">Cart</span></a> --}}
                                       <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                           <ul>
                                               <li>
                                                   <a href="{{ route('user.account.page') }}"><i
                                                           class="fi fi-ss-home mr-10"></i>Dashboard</a>
                                               </li>
                                               <li>
                                                   <a href="{{ route('user.order.page') }}"><i
                                                           class="fi fi-rs-order-history mr-10"></i>My Orders</a>
                                               </li>
                                               <li>
                                                   <a href="{{ route('user.logout') }}"><i
                                                           class="fi fi-rs-sign-out mr-10"></i>Sign out</a>
                                               </li>
                                           </ul>
                                       </div>
                                   @else
                                       <a href="{{ route('login') }}"><span class="lable mr-2"
                                               style="color:#ffffff !important">Log In</span></a>
                                       <span class="lable">|</span>
                                       <a href="{{ route('register') }}"><span class="lable ml-2"
                                               style="color:#ffffff !important">Register</span></a>
                                   @endauth
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       {{-- </div> --}}
       {{-- End of Large Screen - Header 2 --}}


       {{-- Large screen - Header 3 --}}
       {{-- Stickable header --}}
       @php
            $categories = \Illuminate\Support\Facades\Cache::remember('all_categories_flat', 86400, function() {
                return App\Models\Category::orderBy('category_name', 'ASC')->get();
            });
       @endphp
       <div class="header-bottom header-bottom-bg-color sticky-bar">
           <div class="container">
               <div class="header-wrap header-space-between position-relative">


                   {{-- For mobile --}}
                   <div class="logo logo-width-1 d-block d-lg-none">
                       <a href="/"><img src="{{ asset('front/assets/imgs/theme/smart_5.png') }}"
                               alt="logo" />
                       </a>
                   </div>


                   {{-- Large screen - line 3 --}}
                   {{-- Not showing on mobile --}}
                   <div class="header-nav d-none d-lg-flex">

                       {{-- Category Button --}}
                    <div class="main-categori-wrap d-none d-lg-block">
                        <a class="categories-button-active" href="javascript:;"><span class="fi-rs-apps"></span>   Categories <i class="fi-rs-angle-down"></i></a>
                        <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                           <div class="d-flex categori-dropdown-inner">
                              <ul>
                                 @foreach ($categories as $category)
                                 @if ($loop->index < 5)
                                 <li>
                                    <a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}"><img src="{{ asset($category->category_photo) }}" alt="" />{{ $category->category_name }}</a>
                                 </li>
                                 @endif
                                 @endforeach
                              </ul>
                              <ul class="end">
                                 @foreach ($categories as $category)
                                 @if ($loop->index > 4)
                                 <li>
                                    <a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}"><img src="{{ asset($category->category_photo) }}" alt="" />{{ $category->category_name }}</a>
                                 </li>
                                 @endif
                                 @endforeach
                              </ul>
                           </div>

                           <div class="more_slide_open" style="display: none">
                              <div class="d-flex categori-dropdown-inner">
                                 <ul>
                                    <li>
                                       <a href="shop-grid-right.html"> <img src="{{ asset('front/assets/imgs/theme/icons/icon-1.svg') }}" alt="" />Milks and Dairies</a>
                                    </li>
                                    <li>
                                       <a href="shop-grid-right.html"> <img src="{{ asset('front/assets/imgs/theme/icons/icon-2.svg') }}" alt="" />Clothing & beauty</a>
                                    </li>
                                 </ul>
                                 <ul class="end">
                                    <li>
                                       <a href="shop-grid-right.html"> <img src="{{ asset('front/assets/imgs/theme/icons/icon-3.svg') }}" alt="" />Wines & Drinks</a>
                                    </li>
                                    <li>
                                       <a href="shop-grid-right.html"> <img src="{{ asset('front/assets/imgs/theme/icons/icon-4.svg') }}" alt="" />Fresh Seafood</a>
                                    </li>
                                 </ul>
                              </div>
                           </div>

                           <div class="more_categories"><span class="icon"></span> <span class="heading-sm-1">Show more...</span></div>

                        </div>
                    </div>
                       {{-- End of Category Button --}}

                       {{-- List of Categories --}}

                       <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                           <nav>
                               <ul>
                                   <li>
                                       <a class="active" href="/">Home</a>
                                   </li>

                                   {{-- <li><a href="page-about.html">About</a></li> --}}

                                   {{--
                              <li>
                                 <a href="shop-grid-right.html">Shop <i class="fi-rs-angle-down"></i></a>
                                 <ul class="sub-menu">
                                    <li><a href="shop-grid-right.html">Shop Grid – Right Sidebar</a></li>
                                    <li><a href="shop-grid-left.html">Shop Grid – Left Sidebar</a></li>
                                    <li><a href="shop-list-right.html">Shop List – Right Sidebar</a></li>
                                    <li><a href="shop-list-left.html">Shop List – Left Sidebar</a></li>
                                    <li><a href="shop-fullwidth.html">Shop - Wide</a></li>
                                    <li>
                                       <a href="#">Single Product <i class="fi-rs-angle-right"></i></a>
                                       <ul class="level-menu">
                                          <li><a href="shop-product-right.html">Product – Right Sidebar</a></li>
                                          <li><a href="shop-product-left.html">Product – Left Sidebar</a></li>
                                          <li><a href="shop-product-full.html">Product – No sidebar</a></li>
                                          <li><a href="shop-product-vendor.html">Product – Vendor Info</a></li>
                                       </ul>
                                    </li>
                                    <li><a href="shop-filter.html">Shop – Filter</a></li>
                                    <li><a href="shop-wishlist.html">Shop – Wishlist</a></li>
                                    <li><a href="shop-cart.html">Shop – Cart</a></li>
                                    <li><a href="shop-checkout.html">Shop – Checkout</a></li>
                                    <li><a href="shop-compare.html">Shop – Compare</a></li>
                                    <li>
                                       <a href="#">Shop Invoice<i class="fi-rs-angle-right"></i></a>
                                       <ul class="level-menu">
                                          <li><a href="shop-invoice-1.html">Shop Invoice 1</a></li>
                                          <li><a href="shop-invoice-2.html">Shop Invoice 2</a></li>
                                          <li><a href="shop-invoice-3.html">Shop Invoice 3</a></li>
                                          <li><a href="shop-invoice-4.html">Shop Invoice 4</a></li>
                                          <li><a href="shop-invoice-5.html">Shop Invoice 5</a></li>
                                       </ul>
                                    </li>
                                 </ul>
                              </li>
                              --}}

                                   @php
                                        $categories_nav = \Illuminate\Support\Facades\Cache::remember('categories_nav_5', 86400, function() {
                                            return App\Models\Category::with('subcategories')->orderBy('category_name', 'ASC')
                                                ->limit(5)
                                                ->get();
                                        });
                                   @endphp

                                   @foreach ($categories_nav as $category)
                                       <li>
                                           <a
                                               href="{{ url('product/category/' . $category->id . '/' . $category->category_slug) }}">{{ $category->category_name }}
                                               <i class="fi-rs-angle-down"></i></a>

                                           <ul class="sub-menu">
                                               @foreach ($category->subcategories as $subcategory)
                                                   <li><a
                                                           href="{{ url('product/subcategory/' . $subcategory->id . '/' . $subcategory->subcategory_slug) }}">{{ $subcategory->subcategory_name }}</a>
                                                   </li>
                                               @endforeach
                                           </ul>
                                       </li>
                                   @endforeach

                                   {{--
                              <li class="position-static">
                                 <a href="#">Mega menu <i class="fi-rs-angle-down"></i></a>
                                 <ul class="mega-menu">
                                    <li class="sub-mega-menu sub-mega-menu-width-22">
                                       <a class="menu-title" href="#">Fruit & Vegetables</a>
                                       <ul>
                                          <li><a href="shop-product-right.html">Meat & Poultry</a></li>
                                          <li><a href="shop-product-right.html">Fresh Vegetables</a></li>
                                          <li><a href="shop-product-right.html">Herbs & Seasonings</a></li>
                                          <li><a href="shop-product-right.html">Cuts & Sprouts</a></li>
                                          <li><a href="shop-product-right.html">Exotic Fruits & Veggies</a></li>
                                          <li><a href="shop-product-right.html">Packaged Produce</a></li>
                                       </ul>
                                    </li>
                                    <li class="sub-mega-menu sub-mega-menu-width-22">
                                       <a class="menu-title" href="#">Breakfast & Dairy</a>
                                       <ul>
                                          <li><a href="shop-product-right.html">Milk & Flavoured Milk</a></li>
                                          <li><a href="shop-product-right.html">Butter and Margarine</a></li>
                                          <li><a href="shop-product-right.html">Eggs Substitutes</a></li>
                                          <li><a href="shop-product-right.html">Marmalades</a></li>
                                          <li><a href="shop-product-right.html">Sour Cream</a></li>
                                          <li><a href="shop-product-right.html">Cheese</a></li>
                                       </ul>
                                    </li>
                                    <li class="sub-mega-menu sub-mega-menu-width-22">
                                       <a class="menu-title" href="#">Meat & Seafood</a>
                                       <ul>
                                          <li><a href="shop-product-right.html">Breakfast Sausage</a></li>
                                          <li><a href="shop-product-right.html">Dinner Sausage</a></li>
                                          <li><a href="shop-product-right.html">Chicken</a></li>
                                          <li><a href="shop-product-right.html">Sliced Deli Meat</a></li>
                                          <li><a href="shop-product-right.html">Wild Caught Fillets</a></li>
                                          <li><a href="shop-product-right.html">Crab and Shellfish</a></li>
                                       </ul>
                                    </li>
                                    <li class="sub-mega-menu sub-mega-menu-width-34">
                                       <div class="menu-banner-wrap">
                                          <a href="shop-product-right.html"><img src="{{ asset('front/assets/imgs/banner/banner-menu.png') }}" alt="SmartGroceries&Deliveries" /></a>
                                          <div class="menu-banner-content">
                                             <h4>Hot deals</h4>
                                             <h3>
                                                Don't miss<br />
                                                Trending
                                             </h3>
                                             <div class="menu-banner-price">
                                                <span class="new-price text-success">Save to 50%</span>
                                             </div>
                                             <div class="menu-banner-btn">
                                                <a href="shop-product-right.html">Shop now</a>
                                             </div>
                                          </div>
                                          <div class="menu-banner-discount">
                                             <h3>
                                                <span>25%</span>
                                                off
                                             </h3>
                                          </div>
                                       </div>
                                    </li>
                                 </ul>
                              </li>
                              --}}

                                   {{--
                              <li>
                                 <a href="blog-category-grid.html">Blog <i class="fi-rs-angle-down"></i></a>
                                 <ul class="sub-menu">
                                    <li><a href="blog-category-grid.html">Blog Category Grid</a></li>
                                    <li><a href="blog-category-list.html">Blog Category List</a></li>
                                    <li><a href="blog-category-big.html">Blog Category Big</a></li>
                                    <li><a href="blog-category-fullwidth.html">Blog Category Wide</a></li>
                                    <li>
                                       <a href="#">Single Post <i class="fi-rs-angle-right"></i></a>
                                       <ul class="level-menu level-menu-modify">
                                          <li><a href="blog-post-left.html">Left Sidebar</a></li>
                                          <li><a href="blog-post-right.html">Right Sidebar</a></li>
                                          <li><a href="blog-post-fullwidth.html">No Sidebar</a></li>
                                       </ul>
                                    </li>
                                 </ul>
                              </li>
                              --}}

                                   {{--
                              <li>
                                 <a href="#">Pages <i class="fi-rs-angle-down"></i></a>
                                 <ul class="sub-menu">
                                    <li><a href="page-about.html">About Us</a></li>
                                    <li><a href="page-contact.html">Contact</a></li>
                                    <li><a href="page-account.html">My Account</a></li>
                                    <li><a href="page-login.html">Login</a></li>
                                    <li><a href="page-register.html">Register</a></li>
                                    <li><a href="page-forgot-password.html">Forgot password</a></li>
                                    <li><a href="page-reset-password.html">Reset password</a></li>
                                    <li><a href="page-purchase-guide.html">Purchase Guide</a></li>
                                    <li><a href="page-privacy-policy.html">Privacy Policy</a></li>
                                    <li><a href="page-terms.html">Terms of Service</a></li>
                                    <li><a href="page-404.html">404 Page</a></li>
                                 </ul>
                              </li>
                              --}}

                                   {{-- <li>
                                 <a href="{{ route('shop.page') }}">Shop</a>
                              </li> --}}
                               </ul>
                           </nav>
                       </div>
                       {{-- End of list of Categories --}}

                   </div>
                   {{-- End of Not showing on mobile --}}


                   {{-- For mobile --}}
                   {{-- 3 lines --}}
                   <div class="header-action-icon-2 d-block d-lg-none">
                       <div class="burger-icon burger-icon-white">
                           <span class="burger-icon-top"></span>
                           <span class="burger-icon-mid"></span>
                           <span class="burger-icon-bottom"></span>
                       </div>
                   </div>
                   <div class="header-action-right d-block d-lg-none">
                       <div class="header-action-2">

                           {{-- Wishlist --}}
                           <div class="header-action-icon-2">
                               <a href="{{ route('wishlist') }}">
                                   <img class="svgInject" alt="SmartGroceries&Deliveries"
                                       src="{{ asset('front/assets/imgs/theme/icons/icon-heart.svg') }}" />
                                   <span class="pro-count blue" style="background-color: #7B2828 !important"
                                       id="wishQty-mobile">0</span>
                                   {{-- <span class="pro-count white" id="wishQty">0</span> --}}
                               </a>
                           </div>

                           {{-- Add to cart --}}
                           <div class="header-action-icon-2">
                               <a>
                                   <img alt="SmartGroceries&Deliveries"
                                       src="{{ asset('front/assets/imgs/theme/icons/icon-cart.svg') }}" />
                                   <span class="pro-count blue" style="background-color: #7B2828 !important"
                                       id="cartQty-mobile">0</span>
                               </a>
                               <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                   <div id="miniCart-mobile"
                                       style="max-height: 300px; overflow-y: auto; scrollbar-width: thin;">
                                   </div>
                                   <div class="shopping-cart-footer">
                                       <div class="shopping-cart-total">
                                           <h4>Total (Gh) <span id="cartSubTotal"></span></h4>
                                       </div>
                                       <div class="shopping-cart-button">
                                           <a href="{{ route('mycart') }}">View cart</a>
                                           <a href="{{ route('checkout') }}">Checkout</a>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           {{-- End of Add to cart --}}

                           {{-- Account --}}
                           <div class="header-action-icon-2 pl-20">
                               @auth
                                   <span style="color:#000; font-weight:300" class="mr-5">Account</span>
                                   <a>
                                       <img class="svgInject" alt="SmartGroceries&Deliveries"
                                           src="{{ asset('front/assets/imgs/theme/icons/user-icon-1.png') }}" />
                                   </a>
                                   <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                       <ul>
                                           <li>
                                               <a href="{{ route('dashboard') }}"><i
                                                       class="fi fi-ss-home mr-10"></i>Dashboard</a>
                                           </li>
                                           <li>
                                               <a href="{{ route('user.order.page') }}"><i
                                                       class="fi fi-rs-order-history mr-10"></i>My Orders</a>
                                           </li>
                                           <li>
                                               <a href="{{ route('user.track.order') }}"><i
                                                       class="fi fi-rs-map-location-track mr-10"></i>Track Order</a>
                                           </li>
                                           <li>
                                               <a href="{{ route('return.order.page') }}"><i
                                                       class="fi fi-rr-truck-arrow-left mr-10"></i>Return Orders</a>
                                           </li>
                                           <li>
                                               <a href="{{ route('user.logout') }}"><i
                                                       class="fi fi-rs-sign-out mr-10"></i>Sign out</a>
                                           </li>
                                       </ul>
                                   </div>
                               @else
                                   <span style="color:#000; font-weight:300" class="mr-5">Login</span>
                                   <a href="{{ route('login') }}">
                                       <img class="svgInject" alt="SmartGroceries&Deliveries"
                                           src="{{ asset('front/assets/imgs/theme/icons/user-icon-1.png') }}" />
                                   </a>
                               @endauth
                           </div>

                       </div>
                   </div>
                   {{-- End for mobile --}}

               </div>
           </div>

       </div>
       {{-- End of Large Screen - Header 3 --}}

   </header>

   {{-- For mobile search bar --}}
   <div class="container">
       <div id="" class="mobile-search search-style-3 mobile-header-border d-block d-lg-none">
           <form action="{{ route('product.search') }}" method="post">
               @csrf
               <input type="text" onfocus="search_result_show()" onblur="search_result_hide()" name="search" id="search-mobile" placeholder="Search for items..." />
               <div id="searchProducts-mobile"></div>
           </form>
       </div>
   </div>

   <style>
       #searchProducts {
           position: absolute;
           top: 100%;
           left: 0;
           width: 100%;
           background: #ffffff;
           z-index: 999;
           border-radius: 8px;
           margin-top: 5px;
       }

       #searchProducts-mobile {
           position: absolute;
           top: 100%;
           left: 0;
           width: 100%;
           background: #ffffff;
           z-index: 999;
           border-radius: 8px;
           margin-top: 5px;
       }
   </style>

   <script>
        function search_result_show() {
            $("#searchProducts").slideDown();
            $("#searchProducts-mobile").slideDown();
        }

        function search_result_hide() {
            $("#searchProducts").slideUp();
            $("#searchProducts-mobile").slideUp();
        }

       var prevScrollpos = window.pageYOffset;
       window.onscroll = function() {
           var currentScrollPos = window.pageYOffset;
           if (prevScrollpos > currentScrollPos) {
               document.getElementById("search_bar_hide_show").style.top = "0";
           } else {
               document.getElementById("search_bar_hide_show").style.top = "-50px";
           }
           prevScrollpos = currentScrollPos;
       }
   </script>

   {{-- Mobile side menu --}}
   <div class="mobile-header-active mobile-header-wrapper-style">
       <div class="mobile-header-wrapper-inner">
           <div class="mobile-header-top">
               <div class="mobile-header-logo">
                   <a href="/"><img src="{{ asset('front/assets/imgs/theme/smart_5.png') }}"
                           alt="logo" /></a>
               </div>
               <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                   <button class="close-style search-close">
                       <i class="icon-top"></i>
                       <i class="icon-bottom"></i>
                   </button>
               </div>
           </div>
           <div class="mobile-header-content-area">
               {{--
            <div class="mobile-search search-style-3 mobile-header-border">
               <form action="#">
                  <input type="text" placeholder="Search for items…" />
                  <button type="submit"><i class="fi-rs-search"></i></button>
               </form>
            </div>
            --}}
               <!-- mobile menu start -->
               {{-- List of Categories --}}
               <div class="mobile-menu-wrap mobile-header-border">
                   <nav>
                       <ul class="mobile-menu font-heading">
                           {{--
                     <li class="menu-item-has-children">
                        <a href="/">Home</a>
                     </li>
                     --}}
                           {{--
                     <li class="menu-item-has-children">
                        <a href="shop-grid-right.html">shop</a>
                        <ul class="dropdown">
                           <li><a href="shop-grid-right.html">Shop Grid – Right Sidebar</a></li>
                           <li><a href="shop-grid-left.html">Shop Grid – Left Sidebar</a></li>
                           <li><a href="shop-list-right.html">Shop List – Right Sidebar</a></li>
                           <li><a href="shop-list-left.html">Shop List – Left Sidebar</a></li>
                           <li><a href="shop-fullwidth.html">Shop - Wide</a></li>
                           <li class="menu-item-has-children">
                              <a href="#">Single Product</a>
                              <ul class="dropdown">
                                 <li><a href="shop-product-right.html">Product – Right Sidebar</a></li>
                                 <li><a href="shop-product-left.html">Product – Left Sidebar</a></li>
                                 <li><a href="shop-product-full.html">Product – No sidebar</a></li>
                                 <li><a href="shop-product-vendor.html">Product – Vendor Infor</a></li>
                              </ul>
                           </li>
                           <li><a href="shop-filter.html">Shop – Filter</a></li>
                           <li><a href="shop-wishlist.html">Shop – Wishlist</a></li>
                           <li><a href="shop-cart.html">Shop – Cart</a></li>
                           <li><a href="shop-checkout.html">Shop – Checkout</a></li>
                           <li><a href="shop-compare.html">Shop – Compare</a></li>
                           <li class="menu-item-has-children">
                              <a href="#">Shop Invoice</a>
                              <ul class="dropdown">
                                 <li><a href="shop-invoice-1.html">Shop Invoice 1</a></li>
                                 <li><a href="shop-invoice-2.html">Shop Invoice 2</a></li>
                                 <li><a href="shop-invoice-3.html">Shop Invoice 3</a></li>
                                 <li><a href="shop-invoice-4.html">Shop Invoice 4</a></li>
                                 <li><a href="shop-invoice-5.html">Shop Invoice 5</a></li>
                                 <li><a href="shop-invoice-6.html">Shop Invoice 6</a></li>
                              </ul>
                           </li>
                        </ul>
                     </li>
                     --}}
                            @php
                                $all_categories = \Illuminate\Support\Facades\Cache::remember('all_categories_with_sub', 86400, function() {
                                    return App\Models\Category::with('subcategories')->orderBy('category_name', 'ASC')->get();
                                });
                            @endphp
                           <li class="menu-item-has-children">
                               <a href="#">Categories</a>
                               <ul class="dropdown">
                                   @foreach ($all_categories as $category)
                                       <li class="menu-item-has-children">
                                           <a
                                               href="{{ url('product/category/' . $category->id . '/' . $category->category_slug) }}">{{ $category->category_name }}</a>
                                           <ul class="dropdown">
                                               @foreach ($category->subcategories as $subcategory)
                                                   <li><a
                                                           href="{{ url('product/subcategory/' . $subcategory->id . '/' . $subcategory->subcategory_slug) }}">{{ $subcategory->subcategory_name }}</a>
                                                   </li>
                                               @endforeach
                                           </ul>
                                       </li>
                                   @endforeach
                               </ul>
                           </li>
                           {{--
                     <li class="menu-item-has-children">
                        <a href="blog-category-fullwidth.html">Blog</a>
                        <ul class="dropdown">
                           <li><a href="blog-category-grid.html">Blog Category Grid</a></li>
                           <li><a href="blog-category-list.html">Blog Category List</a></li>
                           <li><a href="blog-category-big.html">Blog Category Big</a></li>
                           <li><a href="blog-category-fullwidth.html">Blog Category Wide</a></li>
                           <li class="menu-item-has-children">
                              <a href="#">Single Product Layout</a>
                              <ul class="dropdown">
                                 <li><a href="blog-post-left.html">Left Sidebar</a></li>
                                 <li><a href="blog-post-right.html">Right Sidebar</a></li>
                                 <li><a href="blog-post-fullwidth.html">No Sidebar</a></li>
                              </ul>
                           </li>
                        </ul>
                     </li>
                     --}}

                           {{-- <li class="menu-item-has-children">
                        <a href="#">Pages</a>
                        <ul class="dropdown">
                           <li><a href="page-about.html">About Us</a></li>
                           <li><a href="page-contact.html">Contact</a></li>
                           <li><a href="{{ route('dashboard') }}">My Account</a></li>
                           <li><a href="{{ route('login') }}">Login</a></li>
                           <li><a href="{{ route('register') }}">Register</a></li>
                           <li><a href="page-forgot-password.html">Forgot password</a></li>
                           <li><a href="page-reset-password.html">Reset password</a></li>
                           <li><a href="page-purchase-guide.html">Purchase Guide</a></li>
                           <li><a href="page-privacy-policy.html">Privacy Policy</a></li>
                           <li><a href="page-terms.html">Terms of Service</a></li>
                           <li><a href="page-404.html">404 Page</a></li>
                        </ul>
                     </li> --}}

                           {{--
                     <li class="menu-item-has-children">
                        <a href="#">Language</a>
                        <ul class="dropdown">
                           <li><a href="#">English</a></li>
                           <li><a href="#">French</a></li>
                           <li><a href="#">German</a></li>
                           <li><a href="#">Spanish</a></li>
                        </ul>
                     </li>
                     --}}
                       </ul>
                   </nav>
                   <!-- mobile menu end -->
               </div>
               <div class="mobile-header-info-wrap">
                   {{-- <div class="single-mobile-header-info">
                  <a href="page-contact.html"><i class="fi-rs-marker"></i>Address:  </a>
               </div> --}}
                   {{--
               <div class="single-mobile-header-info">
                  <a href="{{ route('login') }}"><i class="fi-rs-user"></i>Log In or Register </a>
               </div>
               --}}
                   <div class="single-mobile-header-info">
                       <a href="#"><i class="fi-rs-headphones"></i>Contact Us: 0548795583 / 0555700931 </a>
                   </div>
               </div>
               <div class="mobile-social-icon mb-20">
                   <h6 class="mb-15">Follow Us</h6>
                   <a href="{{ $setting->facebook }}"><img
                           src="{{ asset('front/assets/imgs/theme/icons/instagram_icon.png') }}"
                           alt="" /></a>
                   <a href="{{ $setting->twitter }}"><img
                           src="{{ asset('front/assets/imgs/theme/icons/whatsapp_icon.png') }}" alt="" /></a>
               </div>
               <div class="site-copyright">Copyright 2025 © Smart Groceries & Delivery. All rights reserved.</div>
           </div>
       </div>
   </div>
