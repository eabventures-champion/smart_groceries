<div class="sidebar-wrapper" data-simplebar="true">
   <div class="sidebar-header">
      <div>
         <img src="{{ asset('front/assets/imgs/theme/smart_5.png') }}" style="padding: 20px 10px" width="100" alt="logo icon">
      </div>
      {{-- <div>
         <h4 class="logo-text">Shop & Send</h4>
      </div> --}}
      <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
      </div>
   </div>
   <ul class="metismenu" id="menu">
      @if(Auth::user()->role === 'expert')
      <li>
         <a href="{{ route('expert.dashboard') }}">
            <div class="parent-icon"><i class='bx bx-cookie'></i>
            </div>
            <div class="menu-title">Dashboard</div>
         </a>
      </li>
      <li class="menu-label font-weight-bold text-uppercase text-primary" style="font-size: 11px; letter-spacing: 0.5px;">Expert Workspace</li>
      <li>
         <a href="{{ route('expert.dashboard') }}">
            <div class="parent-icon"><i class='bx bx-user'></i>
            </div>
            <div class="menu-title">My Profile</div>
         </a>
      </li>
      <li>
         <a href="{{ route('expert.availability') }}">
            <div class="parent-icon"><i class='bx bx-time'></i>
            </div>
            <div class="menu-title">Set Availability</div>
         </a>
      </li>
      <li>
         <a href="{{ route('expert.bookings') }}">
            <div class="parent-icon"><i class='bx bx-calendar'></i>
            </div>
            <div class="menu-title">See Bookings</div>
         </a>
      </li>
      @else
      <li>
         <a href="{{ route('admin.dashboard') }}">
            <div class="parent-icon"><i class='bx bx-cookie'></i>
            </div>
            <div class="menu-title">Dashboard</div>
         </a>
      </li>
      {{-- @if(Auth::user()->can('roles_permission.menu')) --}}
      <li class="menu-label">Roles & Permissions</li>
      <li>
         <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class='lni lni-users'></i>
            </div>
            <div class="menu-title">Role & Permission</div>
         </a>
         <ul>
            <li> <a href="{{ route('all.permission') }}"><i class="bx bx-right-arrow-alt"></i>All Permission</a>
            </li>
            <li> <a href="{{ route('all.roles') }}"><i class="bx bx-right-arrow-alt"></i>All Roles</a>
            </li>
            <li> <a href="{{ route('add.roles.permission') }}"><i class="bx bx-right-arrow-alt"></i>Roles in Permission</a>
            </li>
            <li> <a href="{{ route('all.roles.permission') }}"><i class="bx bx-right-arrow-alt"></i>All Roles in Permission</a>
            </li>
         </ul>
      </li>
      <li>
         <a class="has-arrow" href="javascript:;">
            <div class="parent-icon"><i class="lni lni-user"></i>
            </div>
            <div class="menu-title">Admin Manage </div>
         </a>
         <ul>
            <li> <a href="{{ route('all.admin') }}"><i class="bx bx-right-arrow-alt"></i>All Admins</a>
            </li>
            <li> <a href="{{ route('add.admin') }}"><i class="bx bx-right-arrow-alt"></i>Add Admin</a>
            </li>
         </ul>
      </li>
      {{-- @endif --}}
      {{-- @if(Auth::user()->can('user_manage.menu')) --}}
      <li>
         <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="lni lni-slideshare"></i>
            </div>
            <div class="menu-title">User Manage</div>
         </a>
         <ul>
            <li> <a href="{{ route('all.users') }}"><i class="bx bx-right-arrow-alt"></i>All Users</a>
            </li>
            <li> <a href="{{ route('all.affiliates') }}"><i class="bx bx-right-arrow-alt"></i>All Affiliates</a>
            </li>
         </ul>
      </li>
      {{-- @endif --}}
      @php
         $pendingCount = \App\Models\Order::where('status', 'pending')->count();
         $queuedCount = \App\Models\Order::where('status', 'queued')->count();
         $confirmedCount = \App\Models\Order::where('status', 'confirmed')->count();
         $processingCount = \App\Models\Order::where('status', 'processing')->count();
         $deliveringCount = \App\Models\Order::where('status', 'delivering')->count();
         $deliveredCount = \App\Models\Order::where('status', 'delivered')->count();

         $returnRequestCount = \App\Models\Order::where('return_order', 1)->count();
         $returnApprovedCount = \App\Models\Order::where('return_order', 2)->count();
         $returnUnapprovedCount = \App\Models\Order::where('return_order', 3)->count();
      @endphp
      {{-- @if(Auth::user()->can('order.menu')) --}}
      <li class="menu-label">Orders Management</li>
      <li>
         <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class='bx bx-cart'></i>
            </div>
            <div class="menu-title">Order Manage </div>
         </a>
         <ul>
            <li> 
               <a href="{{ route('pending.order') }}" class="d-flex justify-content-between align-items-center" style="width: 100%;">
                  <span><i class="bx bx-right-arrow-alt"></i>Pending Order</span>
                  <span class="badge bg-warning text-dark" style="font-size: 9px; padding: 2px 6px; border-radius: 10px; margin-right: 15px;">{{ $pendingCount }}</span>
               </a>
            </li>
            <li> 
               <a href="{{ route('admin.queued.order') }}" class="d-flex justify-content-between align-items-center" style="width: 100%;">
                  <span><i class="bx bx-right-arrow-alt"></i>Queued Order</span>
                  <span class="badge bg-danger text-white" style="font-size: 9px; padding: 2px 6px; border-radius: 10px; margin-right: 15px;">{{ $queuedCount }}</span>
               </a>
            </li>
            <li> 
               <a href="{{ route('admin.confirmed.order') }}" class="d-flex justify-content-between align-items-center" style="width: 100%;">
                  <span><i class="bx bx-right-arrow-alt"></i>Confirmed Order</span>
                  <span class="badge bg-info text-dark" style="font-size: 9px; padding: 2px 6px; border-radius: 10px; margin-right: 15px;">{{ $confirmedCount }}</span>
               </a>
            </li>
            <li> 
               <a href="{{ route('admin.processing.order') }}" class="d-flex justify-content-between align-items-center" style="width: 100%;">
                  <span><i class="bx bx-right-arrow-alt"></i>Processing Order</span>
                  <span class="badge bg-primary text-white" style="font-size: 9px; padding: 2px 6px; border-radius: 10px; margin-right: 15px;">{{ $processingCount }}</span>
               </a>
            </li>
            <li> 
               <a href="{{ route('admin.delivering.order') }}" class="d-flex justify-content-between align-items-center" style="width: 100%;">
                  <span><i class="bx bx-right-arrow-alt"></i>Delivering Order</span>
                  <span class="badge bg-warning text-dark" style="font-size: 9px; padding: 2px 6px; border-radius: 10px; margin-right: 15px;">{{ $deliveringCount }}</span>
               </a>
            </li>
            <li> 
               <a href="{{ route('admin.delivered.order') }}" class="d-flex justify-content-between align-items-center" style="width: 100%;">
                  <span><i class="bx bx-right-arrow-alt"></i>Delivered Order</span>
                  <span class="badge bg-success text-white" style="font-size: 9px; padding: 2px 6px; border-radius: 10px; margin-right: 15px;">{{ $deliveredCount }}</span>
               </a>
            </li>
         </ul>
      </li>
      {{-- @endif --}}
      {{-- @if(Auth::user()->can('report_manage.menu')) --}}
      <li>
         <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">Order Report Manage</div>
         </a>
         <ul>
            <li> <a href="{{ route('report.view') }}"><i class="bx bx-right-arrow-alt"></i>Report View</a>
            </li>
            <li> <a href="{{ route('order.by.user') }}"><i class="bx bx-right-arrow-alt"></i>Order By User</a>
            </li>
         </ul>
      </li>
      {{-- @endif --}}
      {{-- @if(Auth::user()->can('return_order.menu')) --}}
      <li>
         <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class='lni lni-paperclip'></i>
            </div>
            <div class="menu-title">Return Order </div>
         </a>
         <ul>
            <li> 
               <a href="{{ route('return.request') }}" class="d-flex justify-content-between align-items-center" style="width: 100%;">
                  <span><i class="bx bx-right-arrow-alt"></i>Return Request</span>
                  <span class="badge bg-warning text-dark" style="font-size: 9px; padding: 2px 6px; border-radius: 10px; margin-right: 15px;">{{ $returnRequestCount }}</span>
               </a>
            </li>
            <li> 
               <a href="{{ route('complete.return.request') }}" class="d-flex justify-content-between align-items-center" style="width: 100%;">
                  <span><i class="bx bx-right-arrow-alt"></i>Approved Request</span>
                  <span class="badge bg-success text-white" style="font-size: 9px; padding: 2px 6px; border-radius: 10px; margin-right: 15px;">{{ $returnApprovedCount }}</span>
               </a>
            </li>
            <li> 
               <a href="{{ route('uncomplete.return.request') }}" class="d-flex justify-content-between align-items-center" style="width: 100%;">
                  <span><i class="bx bx-right-arrow-alt"></i>Unapproved Request</span>
                  <span class="badge bg-danger text-white" style="font-size: 9px; padding: 2px 6px; border-radius: 10px; margin-right: 15px;">{{ $returnUnapprovedCount }}</span>
               </a>
            </li>
         </ul>
      </li>
      {{-- @endif --}}
      {{-- @if(Auth::user()->can('category.menu')) --}}
      <li class="menu-label">Products Management</li>
      <li>
         <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class='bx bx-home-circle'></i>
            </div>
            <div class="menu-title">Category</div>
         </a>
         <ul>
            <li> <a href="{{ route('all.categories') }}"><i class="bx bx-right-arrow-alt"></i>All Category</a>
            </li>
            <li> <a href="{{ route('add.category') }}"><i class="bx bx-right-arrow-alt"></i>Add Category</a>
            </li>
         </ul>
      </li>
      {{-- @endif --}}
      {{-- @if(Auth::user()->can('subcategory.menu')) --}}
      <li>
         <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class='bx bx-home-circle'></i>
            </div>
            <div class="menu-title">Sub Category</div>
         </a>
         <ul>
            @if(Auth::user()->can('category.list'))
            <li> <a href="{{ route('all.subcategories') }}"><i class="bx bx-right-arrow-alt"></i>All Sub Category</a>
            </li>
            @endif
            @if(Auth::user()->can('subcategory.add'))
            <li> <a href="{{ route('add.subcategory') }}"><i class="bx bx-right-arrow-alt"></i>Add Sub Category</a>
            </li>
            @endif
         </ul>
      </li>
      {{-- @endif --}}
      {{-- @if(Auth::user()->can('product.menu')) --}}
      <li>
         <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="lni lni-fresh-juice"></i>
            </div>
            <div class="menu-title">Product Manage</div>
         </a>
         <ul>
            <li> <a href="{{ route('all.products') }}"><i class="bx bx-right-arrow-alt"></i>All Products</a>
            </li>
            <li> <a href="{{ route('add.product') }}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
            </li>
            <li> <a href="{{ route('bulk.upload.images') }}"><i class="bx bx-right-arrow-alt"></i>Bulk Upload Images</a>
            </li>
         </ul>
      </li>
      {{-- @endif --}}
      {{-- @if(Auth::user()->can('coupon.menu')) --}}
      <li>
         <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="lni lni-invention"></i>
            </div>
            <div class="menu-title">Coupon System</div>
         </a>
         <ul>
            <li> <a href="{{ route('all.coupon') }}"><i class="bx bx-right-arrow-alt"></i>All Coupon</a>
            </li>
            <li> <a href="{{ route('add.coupon') }}"><i class="bx bx-right-arrow-alt"></i>Add Coupon</a>
            </li>
         </ul>
      </li>
      {{-- @endif --}}
      {{-- @if(Auth::user()->can('delivery.menu')) --}}
      <li>
         <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="lni lni-map"></i>
            </div>
            <div class="menu-title">Deliver Area </div>
         </a>
         <ul>
            <li> <a href="{{ route('all.regions') }}"><i class="bx bx-right-arrow-alt"></i>Regions</a>
            </li>
            <li> <a href="{{ route('all.institutions') }}"><i class="bx bx-right-arrow-alt"></i>Institutions</a>
            </li>
            <li> <a href="{{ route('all.halls') }}"><i class="bx bx-right-arrow-alt"></i>Halls</a>
            </li>
         </ul>
      </li>
      {{-- @endif --}}
      {{-- @if(Auth::user()->can('stock.menu')) --}}
      {{-- <li>
         <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="lni lni-cart-full"></i>
            </div>
            <div class="menu-title">Stock Manage</div>
         </a>
         <ul>
            <li> <a href="{{ route('product.stock') }}"><i class="bx bx-right-arrow-alt"></i>Product Stock</a>
            </li>
         </ul>
      </li> --}}
      {{-- @endif --}}
      {{-- @if(Auth::user()->can('reviews.menu')) --}}
      <li>
         <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="lni lni-indent-increase"></i>
            </div>
            <div class="menu-title">Review Manage</div>
         </a>
         <ul>
            <li> <a href="{{ route('pending.review') }}"><i class="bx bx-right-arrow-alt"></i>Pending Review</a>
            </li>
            <li> <a href="{{ route('publish.review') }}"><i class="bx bx-right-arrow-alt"></i>Publish Review</a>
            </li>
         </ul>
      </li>
      {{-- @endif --}}
      {{-- @if(Auth::user()->can('slider.menu')) --}}
      <li class="menu-label">Settings</li>
      <li>
         <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="lni lni-gallery"></i>
            </div>
            <div class="menu-title">Slider Manage</div>
         </a>
         <ul>
            <li> <a href="{{ route('all.slider') }}"><i class="bx bx-right-arrow-alt"></i>All Slider</a>
            </li>
            <li> <a href="{{ route('add.slider') }}"><i class="bx bx-right-arrow-alt"></i>Add Slider</a>
            </li>
         </ul>
      </li>
      {{-- @endif --}}
      {{-- @if(Auth::user()->can('banner.menu')) --}}
      <li>
         <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">Banner Manage</div>
         </a>
         <ul>
            <li> <a href="{{ route('all.banner') }}"><i class="bx bx-right-arrow-alt"></i>All Banner</a>
            </li>
            <li> <a href="{{ route('add.banner') }}"><i class="bx bx-right-arrow-alt"></i>Add Banner</a>
            </li>
         </ul>
      </li>
      {{-- @endif --}}
      {{-- @if(Auth::user()->can('brand.menu')) --}}
      <li>
         <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class='bx bx-home-circle'></i>
            </div>
            <div class="menu-title">Brand</div>
         </a>
         <ul>
            <li> <a href="{{ route('all.brands') }}"><i class="bx bx-right-arrow-alt"></i>All Brands</a>
            </li>
            <li> <a href="{{ route('add.brand') }}"><i class="bx bx-right-arrow-alt"></i>Add Brand</a>
            </li>
         </ul>
      </li>
      {{-- @endif --}}
      {{-- @if(Auth::user()->can('settings.menu')) --}}
      <li>
         <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">Setting Manage</div>
         </a>
         <ul>
            <li> <a href="{{ route('site.setting') }}"><i class="bx bx-right-arrow-alt"></i>Site Setting</a>
            </li>
            <li> <a href="{{ route('seo.setting') }}"><i class="bx bx-right-arrow-alt"></i>Seo Setting</a>
            </li>
            <li> <a href="{{ route('all.recognition.tiers') }}"><i class="bx bx-right-arrow-alt"></i>Recognition Tiers</a>
            </li>
         </ul>
      </li>
      {{-- @endif --}}
      
      <li class="menu-label">Campus & Lifestyle Hub</li>
      <li>
         <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="lni lni-pulse"></i>
            </div>
            <div class="menu-title">Lifestyle Hub</div>
         </a>
         <ul>
            <li> <a href="{{ route('admin.lifestyle.categories') }}"><i class="bx bx-right-arrow-alt"></i>Expert Categories</a></li>
            <li> <a href="{{ route('admin.lifestyle.experts') }}"><i class="bx bx-right-arrow-alt"></i>Expert Profiles</a></li>
            <li> <a href="{{ route('admin.lifestyle.tips') }}"><i class="bx bx-right-arrow-alt"></i>Educational Health Tips</a></li>
            <li> <a href="{{ route('admin.lifestyle.bookings') }}"><i class="bx bx-right-arrow-alt"></i>Expert Bookings</a></li>
            <li> <a href="{{ route('admin.lifestyle.requests') }}"><i class="bx bx-right-arrow-alt"></i>Custom Item Requests</a></li>
            <li> <a href="{{ route('admin.lifestyle.blog_categories') }}"><i class="bx bx-right-arrow-alt"></i>Blog Categories</a></li>
            <li> <a href="{{ route('admin.lifestyle.blogs') }}"><i class="bx bx-right-arrow-alt"></i>Blog Posts</a></li>
         </ul>
      </li>

      {{--
      <li>
         <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">Application</div>
         </a>
         <ul>
            <li> <a href="app-emailbox.html"><i class="bx bx-right-arrow-alt"></i>Email</a>
            </li>
            <li> <a href="app-chat-box.html"><i class="bx bx-right-arrow-alt"></i>Chat Box</a>
            </li>
            <li> <a href="app-file-manager.html"><i class="bx bx-right-arrow-alt"></i>File Manager</a>
            </li>
            <li> <a href="app-contact-list.html"><i class="bx bx-right-arrow-alt"></i>Contatcs</a>
            </li>
            <li> <a href="app-to-do.html"><i class="bx bx-right-arrow-alt"></i>Todo List</a>
            </li>
            <li> <a href="app-invoice.html"><i class="bx bx-right-arrow-alt"></i>Invoice</a>
            </li>
            <li> <a href="app-fullcalender.html"><i class="bx bx-right-arrow-alt"></i>Calendar</a>
            </li>
         </ul>
      </li>
      <li class="menu-label">UI Elements</li>
      <li>
         <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class='bx bx-cart'></i>
            </div>
            <div class="menu-title">eCommerce</div>
         </a>
         <ul>
            <li> <a href="ecommerce-products.html"><i class="bx bx-right-arrow-alt"></i>Products</a>
            </li>
            <li> <a href="ecommerce-products-details.html"><i class="bx bx-right-arrow-alt"></i>Product Details</a>
            </li>
            <li> <a href="ecommerce-add-new-products.html"><i class="bx bx-right-arrow-alt"></i>Add New Products</a>
            </li>
            <li> <a href="ecommerce-orders.html"><i class="bx bx-right-arrow-alt"></i>Orders</a>
            </li>
         </ul>
      </li>
      <li>
         <a class="has-arrow" href="javascript:;">
            <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
            </div>
            <div class="menu-title">Components</div>
         </a>
         <ul>
            <li> <a href="component-alerts.html"><i class="bx bx-right-arrow-alt"></i>Alerts</a>
            </li>
            <li> <a href="component-accordions.html"><i class="bx bx-right-arrow-alt"></i>Accordions</a>
            </li>
            <li> <a href="component-badges.html"><i class="bx bx-right-arrow-alt"></i>Badges</a>
            </li>
            <li> <a href="component-buttons.html"><i class="bx bx-right-arrow-alt"></i>Buttons</a>
            </li>
            <li> <a href="component-cards.html"><i class="bx bx-right-arrow-alt"></i>Cards</a>
            </li>
            <li> <a href="component-carousels.html"><i class="bx bx-right-arrow-alt"></i>Carousels</a>
            </li>
            <li> <a href="component-list-groups.html"><i class="bx bx-right-arrow-alt"></i>List Groups</a>
            </li>
            <li> <a href="component-media-object.html"><i class="bx bx-right-arrow-alt"></i>Media Objects</a>
            </li>
            <li> <a href="component-modals.html"><i class="bx bx-right-arrow-alt"></i>Modals</a>
            </li>
            <li> <a href="component-navs-tabs.html"><i class="bx bx-right-arrow-alt"></i>Navs & Tabs</a>
            </li>
            <li> <a href="component-navbar.html"><i class="bx bx-right-arrow-alt"></i>Navbar</a>
            </li>
            <li> <a href="component-paginations.html"><i class="bx bx-right-arrow-alt"></i>Pagination</a>
            </li>
            <li> <a href="component-popovers-tooltips.html"><i class="bx bx-right-arrow-alt"></i>Popovers & Tooltips</a>
            </li>
            <li> <a href="component-progress-bars.html"><i class="bx bx-right-arrow-alt"></i>Progress</a>
            </li>
            <li> <a href="component-spinners.html"><i class="bx bx-right-arrow-alt"></i>Spinners</a>
            </li>
            <li> <a href="component-notifications.html"><i class="bx bx-right-arrow-alt"></i>Notifications</a>
            </li>
            <li> <a href="component-avtars-chips.html"><i class="bx bx-right-arrow-alt"></i>Avatrs & Chips</a>
            </li>
         </ul>
      </li>
      <li>
         <a class="has-arrow" href="javascript:;">
            <div class="parent-icon"><i class="bx bx-repeat"></i>
            </div>
            <div class="menu-title">Content</div>
         </a>
         <ul>
            <li> <a href="content-grid-system.html"><i class="bx bx-right-arrow-alt"></i>Grid System</a>
            </li>
            <li> <a href="content-typography.html"><i class="bx bx-right-arrow-alt"></i>Typography</a>
            </li>
            <li> <a href="content-text-utilities.html"><i class="bx bx-right-arrow-alt"></i>Text Utilities</a>
            </li>
         </ul>
      </li>
      <li>
         <a class="has-arrow" href="javascript:;">
            <div class="parent-icon"> <i class="bx bx-donate-blood"></i>
            </div>
            <div class="menu-title">Icons</div>
         </a>
         <ul>
            <li> <a href="icons-line-icons.html"><i class="bx bx-right-arrow-alt"></i>Line Icons</a>
            </li>
            <li> <a href="icons-boxicons.html"><i class="bx bx-right-arrow-alt"></i>Boxicons</a>
            </li>
            <li> <a href="icons-feather-icons.html"><i class="bx bx-right-arrow-alt"></i>Feather Icons</a>
            </li>
         </ul>
      </li>
      --}}
      {{--
      <li class="menu-label">Forms & Tables</li>
      --}}
      {{--
      <li>
         <a class="has-arrow" href="javascript:;">
            <div class="parent-icon"><i class='bx bx-message-square-edit'></i>
            </div>
            <div class="menu-title">Forms</div>
         </a>
         <ul>
            <li> <a href="form-elements.html"><i class="bx bx-right-arrow-alt"></i>Form Elements</a>
            </li>
            <li> <a href="form-input-group.html"><i class="bx bx-right-arrow-alt"></i>Input Groups</a>
            </li>
            <li> <a href="form-layouts.html"><i class="bx bx-right-arrow-alt"></i>Forms Layouts</a>
            </li>
            <li> <a href="form-validations.html"><i class="bx bx-right-arrow-alt"></i>Form Validation</a>
            </li>
            <li> <a href="form-wizard.html"><i class="bx bx-right-arrow-alt"></i>Form Wizard</a>
            </li>
            <li> <a href="form-text-editor.html"><i class="bx bx-right-arrow-alt"></i>Text Editor</a>
            </li>
            <li> <a href="form-file-upload.html"><i class="bx bx-right-arrow-alt"></i>File Upload</a>
            </li>
            <li> <a href="form-date-time-pickes.html"><i class="bx bx-right-arrow-alt"></i>Date Pickers</a>
            </li>
            <li> <a href="form-select2.html"><i class="bx bx-right-arrow-alt"></i>Select2</a>
            </li>
         </ul>
      </li>
      --}}
      {{--
      <li>
         <a class="has-arrow" href="javascript:;">
            <div class="parent-icon"><i class="bx bx-grid-alt"></i>
            </div>
            <div class="menu-title">Tables</div>
         </a>
         <ul>
            <li> <a href="table-basic-table.html"><i class="bx bx-right-arrow-alt"></i>Basic Table</a>
            </li>
            <li> <a href="table-datatable.html"><i class="bx bx-right-arrow-alt"></i>Data Table</a>
            </li>
         </ul>
      </li>
      --}}
      {{--
      <li class="menu-label">Pages</li>
      --}}
      {{--
      <li>
         <a class="has-arrow" href="javascript:;">
            <div class="parent-icon"><i class="bx bx-lock"></i>
            </div>
            <div class="menu-title">Authentication</div>
         </a>
         <ul>
            <li> <a href="authentication-signin.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Sign In</a>
            </li>
            <li> <a href="authentication-signup.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Sign Up</a>
            </li>
            <li> <a href="authentication-signin-with-header-footer.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Sign In with Header & Footer</a>
            </li>
            <li> <a href="authentication-signup-with-header-footer.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Sign Up with Header & Footer</a>
            </li>
            <li> <a href="authentication-forgot-password.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Forgot Password</a>
            </li>
            <li> <a href="authentication-reset-password.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Reset Password</a>
            </li>
            <li> <a href="authentication-lock-screen.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Lock Screen</a>
            </li>
         </ul>
      </li>
      --}}
      {{--
      <li>
         <a href="user-profile.html">
            <div class="parent-icon"><i class="bx bx-user-circle"></i>
            </div>
            <div class="menu-title">User Profile</div>
         </a>
      </li>
      --}}
      {{--
      <li>
         <a href="timeline.html">
            <div class="parent-icon"> <i class="bx bx-video-recording"></i>
            </div>
            <div class="menu-title">Timeline</div>
         </a>
      </li>
      --}}
      {{--
      <li>
         <a class="has-arrow" href="javascript:;">
            <div class="parent-icon"><i class="bx bx-error"></i>
            </div>
            <div class="menu-title">Errors</div>
         </a>
         <ul>
            <li> <a href="errors-404-error.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>404 Error</a>
            </li>
            <li> <a href="errors-500-error.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>500 Error</a>
            </li>
            <li> <a href="errors-coming-soon.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Coming Soon</a>
            </li>
            <li> <a href="error-blank-page.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Blank Page</a>
            </li>
         </ul>
      </li>
      --}}
      {{--
      <li>
         <a href="faq.html">
            <div class="parent-icon"><i class="bx bx-help-circle"></i>
            </div>
            <div class="menu-title">FAQ</div>
         </a>
      </li>
      --}}
      {{--
      <li>
         <a href="pricing-table.html">
            <div class="parent-icon"><i class="bx bx-diamond"></i>
            </div>
            <div class="menu-title">Pricing</div>
         </a>
      </li>
      --}}
      {{--
      <li class="menu-label">Charts & Maps</li>
      <li>
         <a class="has-arrow" href="javascript:;">
            <div class="parent-icon"><i class="bx bx-line-chart"></i>
            </div>
            <div class="menu-title">Charts</div>
         </a>
         <ul>
            <li> <a href="charts-apex-chart.html"><i class="bx bx-right-arrow-alt"></i>Apex</a>
            </li>
            <li> <a href="charts-chartjs.html"><i class="bx bx-right-arrow-alt"></i>Chartjs</a>
            </li>
            <li> <a href="charts-highcharts.html"><i class="bx bx-right-arrow-alt"></i>Highcharts</a>
            </li>
         </ul>
      </li>
      --}}
      {{--
      <li>
         <a class="has-arrow" href="javascript:;">
            <div class="parent-icon"><i class="bx bx-map-alt"></i>
            </div>
            <div class="menu-title">Maps</div>
         </a>
         <ul>
            <li> <a href="map-google-maps.html"><i class="bx bx-right-arrow-alt"></i>Google Maps</a>
            </li>
            <li> <a href="map-vector-maps.html"><i class="bx bx-right-arrow-alt"></i>Vector Maps</a>
            </li>
         </ul>
      </li>
      --}}
      {{--
      <li class="menu-label">Others</li>
      --}}
      {{--
      <li>
         <a class="has-arrow" href="javascript:;">
            <div class="parent-icon"><i class="bx bx-menu"></i>
            </div>
            <div class="menu-title">Menu Levels</div>
         </a>
         <ul>
            <li>
               <a class="has-arrow" href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Level One</a>
               <ul>
                  <li>
                     <a class="has-arrow" href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Level Two</a>
                     <ul>
                        <li> <a href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Level Three</a>
                        </li>
                     </ul>
                  </li>
               </ul>
            </li>
         </ul>
      </li>
      --}}
      {{--
      <li>
         <a href="https://codervent.com/rukada/documentation//" target="_blank">
            <div class="parent-icon"><i class="bx bx-folder"></i>
            </div>
            <div class="menu-title">Documentation</div>
         </a>
      </li>
      --}}
      {{--
      <li>
         <a href="" target="_blank">
            <div class="parent-icon"><i class="bx bx-support"></i>
            </div>
            <div class="menu-title">Support</div>
         </a>
      </li>
      --}}
      @endif
   </ul>
</div>
