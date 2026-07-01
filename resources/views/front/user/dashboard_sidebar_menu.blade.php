@php
$route = Route::current()->getName();
$userId = Auth::id();
$user = Auth::user();
$ordersCount = \App\Models\Order::where('user_id', $userId)->count();
$returnOrdersCount = \App\Models\Order::where('user_id', $userId)->where('return_order', '>', 0)->count();
@endphp
<div class="col-md-3 d-none d-lg-block">
   <div class="premium-sidebar-card">
      <!-- User Avatar Header -->
      <div class="sidebar-user-header">
         <div class="sidebar-avatar-wrap">
            <img src="{{ (!empty($user->photo)) ? url('front/assets/imgs/users/'.$user->photo) : url('front/assets/imgs/users/no_image.jpg') }}" alt="{{ $user->name }}">
            <span class="sidebar-online-dot"></span>
         </div>
         <h6 class="sidebar-user-name">{{ $user->name }}</h6>
         <span class="sidebar-user-email">{{ $user->email }}</span>
      </div>

      <!-- Navigation -->
      <nav class="sidebar-nav">
         <a class="sidebar-nav-item {{ ($route == 'dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <span class="sidebar-nav-icon"><i class="fi fi-ss-home"></i></span>
            <span class="sidebar-nav-text">Dashboard</span>
         </a>
         <a class="sidebar-nav-item {{ ($route == 'user.order.page') ? 'active' : '' }}" href="{{ route('user.order.page') }}">
            <span class="sidebar-nav-icon"><i class="fi fi-rs-order-history"></i></span>
            <span class="sidebar-nav-text">Orders</span>
            <span class="sidebar-badge bg-success-subtle text-success">{{ $ordersCount }}</span>
         </a>
         <a class="sidebar-nav-item {{ ($route == 'user.bookings') ? 'active' : '' }}" href="{{ route('user.bookings') }}">
            <span class="sidebar-nav-icon"><i class="fi fi-rs-calendar"></i></span>
            <span class="sidebar-nav-text">Expert Bookings</span>
         </a>
         <a class="sidebar-nav-item {{ ($route == 'return.order.page') ? 'active' : '' }}" href="{{ route('return.order.page') }}">
            <span class="sidebar-nav-icon"><i class="fi fi-rr-truck-arrow-left"></i></span>
            <span class="sidebar-nav-text">Return Orders</span>
            @if($returnOrdersCount > 0)
               <span class="sidebar-badge bg-danger-subtle text-danger">{{ $returnOrdersCount }}</span>
            @endif
         </a>
         <a class="sidebar-nav-item {{ ($route == 'user.track.order') ? 'active' : '' }}" href="{{ route('user.track.order') }}">
            <span class="sidebar-nav-icon"><i class="fi fi-rs-map-location-track"></i></span>
            <span class="sidebar-nav-text">Track Order</span>
         </a>

         <div class="sidebar-nav-divider"></div>

         <a class="sidebar-nav-item {{ ($route == 'user.account.page') ? 'active' : '' }}" href="{{ route('user.account.page') }}">
            <span class="sidebar-nav-icon"><i class="fi-rs-user"></i></span>
            <span class="sidebar-nav-text">Account Details</span>
         </a>
         <a class="sidebar-nav-item {{ ($route == 'user.change.password') ? 'active' : '' }}" href="{{ route('user.change.password') }}">
            <span class="sidebar-nav-icon"><i class="fi fi-rr-lock"></i></span>
            <span class="sidebar-nav-text">Change Password</span>
         </a>
         <a class="sidebar-nav-item sidebar-logout" href="{{ route('user.logout') }}">
            <span class="sidebar-nav-icon"><i class="fi-rs-sign-out"></i></span>
            <span class="sidebar-nav-text">Logout</span>
         </a>
      </nav>
   </div>
</div>

<style>
   .premium-sidebar-card {
      background: #ffffff;
      border-radius: 20px;
      border: 1px solid #f1f2f4;
      box-shadow: 0 10px 40px rgba(0,0,0,0.03);
      overflow: hidden;
      position: sticky;
      top: 20px;
   }
   /* User Header */
   .sidebar-user-header {
      padding: 30px 24px 24px;
      text-align: center;
      background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 50%, #f0f9ff 100%);
      border-bottom: 1px solid #f1f2f4;
   }
   .sidebar-avatar-wrap {
      position: relative;
      display: inline-block;
      margin-bottom: 12px;
   }
   .sidebar-avatar-wrap img {
      width: 72px;
      height: 72px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #fff;
      box-shadow: 0 4px 15px rgba(0,0,0,0.08);
   }
   .sidebar-online-dot {
      position: absolute;
      bottom: 4px;
      right: 4px;
      width: 14px;
      height: 14px;
      background: #22c55e;
      border-radius: 50%;
      border: 2.5px solid #fff;
   }
   .sidebar-user-name {
      font-family: 'Outfit', sans-serif;
      font-weight: 700;
      font-size: 16px;
      color: #253D4E;
      margin: 0 0 3px;
   }
   .sidebar-user-email {
      font-family: 'Inter', sans-serif;
      font-size: 12px;
      color: #9ca3af;
      font-weight: 500;
   }
   /* Navigation */
   .sidebar-nav {
      padding: 12px;
   }
   .sidebar-nav-item {
      display: flex;
      align-items: center;
      padding: 11px 16px;
      border-radius: 12px;
      color: #64748b;
      font-family: 'Inter', sans-serif;
      font-size: 14px;
      font-weight: 500;
      text-decoration: none;
      transition: all 0.2s ease;
      margin-bottom: 2px;
      position: relative;
   }
   .sidebar-nav-item:hover {
      background: #f8fafc;
      color: #253D4E;
      transform: translateX(3px);
   }
   .sidebar-nav-item.active {
      background: rgba(59, 183, 126, 0.08);
      color: #3bb77e;
      font-weight: 600;
   }
   .sidebar-nav-item.active .sidebar-nav-icon {
      color: #3bb77e;
   }
   .sidebar-nav-icon {
      width: 22px;
      margin-right: 12px;
      font-size: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #94a3b8;
      transition: color 0.2s ease;
   }
   .sidebar-nav-text {
      flex: 1;
   }
   .sidebar-badge {
      font-size: 11px;
      font-weight: 700;
      padding: 2px 8px;
      border-radius: 20px;
      font-family: 'Inter', sans-serif;
   }
   .bg-success-subtle { background: #dcfce7; }
   .text-success { color: #16a34a !important; }
   .bg-danger-subtle { background: #fee2e2; }
   .text-danger { color: #dc2626 !important; }
   .sidebar-nav-divider {
      height: 1px;
      background: #f1f2f4;
      margin: 8px 16px;
   }
   .sidebar-logout {
      color: #ef4444 !important;
   }
   .sidebar-logout:hover {
      background: #fef2f2 !important;
      color: #dc2626 !important;
   }
   .sidebar-logout .sidebar-nav-icon {
      color: #ef4444;
   }
</style>