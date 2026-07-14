@extends('back.admin.master')

@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Client Profile</div>
      <div class="ps-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
               <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
               </li>
               <li class="breadcrumb-item"><a href="{{ route('all.users') }}">All Users</a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">Client Details</li>
            </ol>
         </nav>
      </div>
      <div class="ms-auto">
         <a href="{{ route('all.users') }}" class="btn btn-sm btn-secondary" style="background-color: #6c757d; border-color: #6c757d;">
            <i class="bx bx-arrow-back"></i> Back to List
         </a>
      </div>
   </div>
   <!--end breadcrumb-->

   @php
      $isStudent = ($user->status_identity === 'student');
      $isExisting = $user->isExistingStudent();
      $isCompleted = $user->isCompletedStudent();
      
      if ($user->year_of_admission && $user->year_of_completion) {
         $totalYears = max(1, $user->year_of_completion - $user->year_of_admission);
         $elapsed = max(0, min($totalYears, date('Y') - $user->year_of_admission));
         $progress = round(($elapsed / $totalYears) * 100);
      } else {
         $totalYears = 0;
         $elapsed = 0;
         $progress = 0;
      }
   @endphp

   <div class="container">
      <div class="main-body">
         <div class="row">
            <!-- Left Column: User Card -->
            <div class="col-lg-4">
               <div class="card shadow-sm border-0" style="border-radius: 12px;">
                  <div class="card-body">
                     <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{ (!empty($user->photo)) ? url('front/assets/imgs/users/'.$user->photo) : url('front/assets/imgs/users/no_image.jpg') }}" alt="Client" class="rounded-circle p-1 bg-primary" width="110" height="110" style="object-fit: cover;">
                        <div class="mt-3">
                           <h4>{{ $user->name }}</h4>
                           <p class="text-secondary mb-1">{{ $user->username ?? 'No Username' }}</p>
                           <p class="text-muted font-size-sm mb-3">
                              <i class="bx bx-map"></i> {{ $user->address ?? 'No Address provided' }}
                           </p>
                           
                           <!-- Status Badge -->
                           <div class="mb-2">
                              @if($isStudent)
                                 @if($isCompleted)
                                    <span class="badge bg-info p-2" style="font-size: 13px;"><i class="fa fa-graduation-cap"></i> Alumni</span>
                                 @else
                                    <span class="badge bg-success p-2" style="font-size: 13px;"><i class="fa fa-user-graduate"></i> Active Student</span>
                                 @endif
                              @else
                                 <span class="badge bg-secondary p-2" style="font-size: 13px;"><i class="fa fa-user"></i> Non-Student Member</span>
                              @endif
                           </div>

                           <!-- Online Status -->
                           <div>
                              @if($user->user_online())
                                 <span class="badge bg-success rounded-pill px-3 py-1"><i class="fa fa-circle"></i> Active Now</span>
                              @else
                                 <span class="badge bg-danger rounded-pill px-3 py-1">
                                    <i class="fa fa-clock"></i> Last seen {{ $user->last_seen ? Carbon\Carbon::parse($user->last_seen)->diffForHumans() : 'N/A' }}
                                 </span>
                              @endif
                           </div>
                        </div>
                     </div>
                     <hr class="my-4" />
                     <ul class="list-group list-group-flush" style="border-radius: 8px; overflow: hidden;">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap px-0">
                           <h6 class="mb-0 text-muted"><i class="fa fa-id-badge me-2"></i> User ID</h6>
                           <span class="text-secondary font-weight-bold">#{{ $user->id }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap px-0">
                           <h6 class="mb-0 text-muted"><i class="fa fa-calendar me-2"></i> Joined Date</h6>
                           <span class="text-secondary">{{ $user->created_at ? $user->created_at->format('M d, Y') : 'N/A' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap px-0">
                           <h6 class="mb-0 text-muted"><i class="fa fa-check-circle me-2"></i> Account Status</h6>
                           @if($user->status == 'active')
                              <span class="badge bg-success"><i class="fa fa-check-circle me-1"></i>Active</span>
                           @elseif($user->status == 'suspended')
                              <span class="badge bg-warning text-dark"><i class="fa fa-pause-circle me-1"></i>Suspended</span>
                           @elseif($user->status == 'disabled')
                              <span class="badge bg-danger"><i class="fa fa-ban me-1"></i>Disabled</span>
                           @else
                              <span class="badge bg-secondary"><i class="fa fa-clock me-1"></i>Inactive</span>
                           @endif
                        </li>
                     </ul>

                     {{-- Manage Account Actions --}}
                     <div class="card mt-4 border shadow-none" style="border-radius: 8px; background-color: #f8f9fa;">
                        <div class="card-body p-3">
                           <h6 class="mb-3 font-weight-bold text-dark text-center"><i class="bx bx-shield me-1 fs-5"></i> Manage Account</h6>
                           <div class="d-grid gap-2">
                              @if($user->status == 'active')
                                 <form action="{{ route('admin.client.suspend', $user->id) }}" method="POST" class="detail-action-form" data-action="suspend" data-username="{{ $user->name }}">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm w-100">
                                       <i class="fa fa-pause-circle me-1"></i> Suspend Account
                                    </button>
                                 </form>
                                 <form action="{{ route('admin.client.disable', $user->id) }}" method="POST" class="detail-action-form" data-action="disable" data-username="{{ $user->name }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm w-100">
                                       <i class="fa fa-ban me-1"></i> Disable Account
                                    </button>
                                 </form>
                              @elseif($user->status == 'suspended')
                                 <form action="{{ route('admin.client.reactivate', $user->id) }}" method="POST" class="detail-action-form" data-action="reactivate" data-username="{{ $user->name }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm w-100">
                                       <i class="fa fa-check-circle me-1"></i> Reactivate Account
                                    </button>
                                 </form>
                                 <form action="{{ route('admin.client.disable', $user->id) }}" method="POST" class="detail-action-form" data-action="disable" data-username="{{ $user->name }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm w-100">
                                       <i class="fa fa-ban me-1"></i> Disable Account
                                    </button>
                                 </form>
                              @elseif($user->status == 'disabled')
                                 <form action="{{ route('admin.client.reactivate', $user->id) }}" method="POST" class="detail-action-form" data-action="reactivate" data-username="{{ $user->name }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm w-100">
                                       <i class="fa fa-check-circle me-1"></i> Reactivate Account
                                    </button>
                                 </form>
                              @endif
                           </div>
                        </div>
                     </div>

                      <div class="card mt-4 border shadow-none" style="border-radius: 8px; background-color: #fbfbfb;">
                         <div class="card-body p-3 text-center">
                            <h6 class="mb-3 font-weight-bold text-dark"><i class="bx bx-award me-1 text-warning fs-5"></i> Recognition Tier</h6>
                            
                             @php
                                 $recTier = Schema::hasColumn('users', 'recognition_tier') ? ($user->recognition_tier ?? null) : null;
                                 $userTierObj = null;
                                 if (\Illuminate\Support\Facades\Schema::hasTable('recognition_tiers')) {
                                     $userTierObj = \App\Models\RecognitionTier::where('name', $recTier)->first();
                                 }
                                 $badgeStyle = $userTierObj ? $userTierObj->badge_style : 'light';
                                 if (!$userTierObj && $recTier) {
                                     if ($recTier === 'VIP Platinum') { $badgeStyle = 'warning'; }
                                     elseif ($recTier === 'Gold Tier') { $badgeStyle = 'secondary'; }
                                     elseif ($recTier === 'Silver Tier') { $badgeStyle = 'light'; }
                                 }
                             @endphp

                             <div class="mb-2">
                                 <span class="badge px-3 py-2" style="font-size: 13px;
                                     @if($badgeStyle === 'warning') background-color: #ffc107; color: #000;
                                     @elseif($badgeStyle === 'secondary') background-color: #6c757d; color: #fff;
                                     @elseif($badgeStyle === 'light') background-color: #f8f9fa; color: #212529; border: 1px solid #ccc;
                                     @elseif($badgeStyle === 'success') background-color: #198754; color: #fff;
                                     @elseif($badgeStyle === 'danger') background-color: #dc3545; color: #fff;
                                     @else background-color: #0d6efd; color: #fff;
                                     @endif">
                                     <i class="bx 
                                         @if($badgeStyle === 'warning') bxs-crown
                                         @elseif($badgeStyle === 'secondary') bxs-medal
                                         @elseif($badgeStyle === 'light') bx-award
                                         @elseif($badgeStyle === 'success') bx-check-shield
                                         @elseif($badgeStyle === 'danger') bx-star
                                         @else bx-medal
                                         @endif me-1"></i>{{ $recTier ?? 'Regular Customer' }}
                                 </span>
                             </div>

                             <hr class="my-3">

                             <div class="text-start" style="font-size: 11px; line-height: 1.6;">
                                 <div class="d-flex justify-content-between text-muted mb-1">
                                     <span>Total Spent (All Orders):</span>
                                     <strong class="text-dark">GH¢ {{ number_format(\App\Models\Order::where('user_id', $user->id)->sum('amount'), 2) }}</strong>
                                 </div>
                                 @php
                                     if (\Illuminate\Support\Facades\Schema::hasTable('recognition_tiers')) {
                                         $tiersList = \App\Models\RecognitionTier::orderBy('min_spent', 'desc')->get();
                                     } else {
                                         $tiersList = collect([
                                             (object)['name' => 'VIP Platinum', 'min_spent' => 500.00, 'badge_style' => 'warning'],
                                             (object)['name' => 'Gold Tier', 'min_spent' => 300.00, 'badge_style' => 'secondary'],
                                             (object)['name' => 'Silver Tier', 'min_spent' => 100.00, 'badge_style' => 'light'],
                                         ]);
                                     }
                                 @endphp
                                 <div class="border-top pt-2 mt-2">
                                    @foreach($tiersList as $t)
                                        <div class="d-flex justify-content-between mb-1 {{ $recTier == $t->name ? 'fw-bold text-success' : 'text-muted' }}">
                                            <span>{{ $t->name }}:</span>
                                            <span>&ge; GH¢ {{ number_format($t->min_spent, 2) }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                         </div>
                      </div>
                  </div>
               </div>
            </div>

            <!-- Right Column: Personal Info, Academic Info, Order Stats -->
            <div class="col-lg-8">
               
               <!-- 1. Personal & Contact Details -->
               <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
                  <div class="card-header bg-transparent border-0 pt-3 pb-0">
                     <h5 class="mb-0 font-weight-bold" style="color: #333;"><i class="fa fa-user me-2 text-primary"></i> Personal Details</h5>
                  </div>
                  <div class="card-body">
                     <div class="row mb-3">
                        <div class="col-sm-3">
                           <h6 class="mb-0 font-weight-semibold text-muted">Full Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                           {{ $user->name }}
                        </div>
                     </div>
                     <div class="row mb-3">
                        <div class="col-sm-3">
                           <h6 class="mb-0 font-weight-semibold text-muted">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                           {{ $user->email }}
                        </div>
                     </div>
                     <div class="row mb-3">
                        <div class="col-sm-3">
                           <h6 class="mb-0 font-weight-semibold text-muted">Phone</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                           {{ $user->phone ?? 'Not Provided' }}
                        </div>
                     </div>
                     <div class="row mb-3">
                        <div class="col-sm-3">
                           <h6 class="mb-0 font-weight-semibold text-muted">Address</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                           {{ $user->address ?? 'Not Provided' }}
                        </div>
                     </div>
                  </div>
               </div>

               <!-- 2. Academic Information (Conditional) -->
               @if($isStudent)
                  <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px; border-left: 5px solid #3bb77e !important;">
                     <div class="card-header bg-transparent border-0 pt-3 pb-0">
                        <h5 class="mb-0 font-weight-bold" style="color: #2e7d32;"><i class="fa fa-graduation-cap me-2 text-success"></i> Academic Information</h5>
                     </div>
                     <div class="card-body">
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0 font-weight-semibold text-muted">Institution</h6>
                           </div>
                           <div class="col-sm-9 text-secondary font-weight-bold">
                              {{ $user->institution ?? 'N/A' }}
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0 font-weight-semibold text-muted">Residence Hall</h6>
                           </div>
                           <div class="col-sm-9 text-secondary font-weight-bold">
                              {{ $user->hall ?? 'Not Provided' }}
                           </div>
                        </div>
                        @if($user->student_id)
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0 font-weight-semibold text-muted">Student ID / Badge</h6>
                           </div>
                           <div class="col-sm-9">
                              <span class="badge bg-light text-dark font-monospace border px-3 py-2" style="font-size: 13px; letter-spacing: 0.5px;">
                                 🪪 {{ $user->student_id }}
                              </span>
                           </div>
                        </div>
                        @endif
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0 font-weight-semibold text-muted">Academic Timeline</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <div class="d-flex align-items-center flex-wrap gap-4">
                                 <div>
                                    <span class="text-muted" style="font-size: 12px; display: block; text-transform: uppercase;">Admission Year</span>
                                    <strong>{{ $user->year_of_admission }}</strong>
                                 </div>
                                 <div class="border-start ps-4">
                                    <span class="text-muted" style="font-size: 12px; display: block; text-transform: uppercase;">Completion Year</span>
                                    <strong>{{ $user->year_of_completion }}</strong>
                                 </div>
                                 <div class="border-start ps-4">
                                    <span class="text-muted" style="font-size: 12px; display: block; text-transform: uppercase;">Duration</span>
                                    <strong>{{ $totalYears }} Years</strong>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <!-- Progress Section -->
                        <div class="row mb-1">
                           <div class="col-sm-3">
                              <h6 class="mb-0 font-weight-semibold text-muted">Academic Progress</h6>
                           </div>
                           <div class="col-sm-9">
                              @if($isExisting)
                                 <div class="d-flex align-items-center justify-content-between mb-1">
                                    <span style="font-size: 13px;">Progress in studies</span>
                                    <span class="font-weight-bold text-success">{{ $progress }}%</span>
                                 </div>
                                 <div class="progress mb-3" style="height: 10px; border-radius: 5px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                                 </div>
                                 <div class="alert alert-success d-flex align-items-center border-0 p-2 mb-0" style="background-color: #e8f5e9; color: #2e7d32; border-radius: 8px; font-size: 13px;">
                                    <span class="me-2">⏳</span>
                                    <span><strong>Expected completion in {{ $user->year_of_completion }}</strong> &mdash; {{ $user->year_of_completion - date('Y') }} year(s) remaining.</span>
                                 </div>
                              @else
                                 <div class="d-flex align-items-center justify-content-between mb-1">
                                    <span style="font-size: 13px;">Completed Studies</span>
                                    <span class="font-weight-bold text-info">100% Complete</span>
                                 </div>
                                 <div class="progress mb-3" style="height: 10px; border-radius: 5px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                 </div>
                                 <div class="alert alert-info d-flex align-items-center border-0 p-2 mb-0" style="background-color: #e0f7fa; color: #006064; border-radius: 8px; font-size: 13px;">
                                    <span class="me-2">🎉</span>
                                    <span><strong>Congratulations!</strong> This client completed their studies in {{ $user->year_of_completion }} and is considered Alumni.</span>
                                 </div>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
               @endif

               <!-- 3. Order Statistics -->
               <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
                  <div class="card-header bg-transparent border-0 pt-3 pb-0">
                     <h5 class="mb-0 font-weight-bold" style="color: #333;"><i class="fa fa-shopping-basket me-2 text-warning"></i> Order Statistics</h5>
                  </div>
                  <div class="card-body">
                     <div class="row g-3">
                        <!-- Total Orders -->
                        <div class="col-md-4">
                           <div class="p-3 border text-center order-stat-card" style="border-radius: 10px; background-color: #fafafa; cursor: pointer; transition: transform 0.2s ease, box-shadow 0.2s ease;" data-bs-toggle="modal" data-bs-target="#totalOrdersModal">
                              <div style="font-size: 24px;">📦</div>
                              <h3 class="mb-0 mt-2 font-weight-bold">{{ $totalOrders }}</h3>
                              <span class="text-muted" style="font-size: 13px; font-weight: 600;">Total Orders</span>
                           </div>
                        </div>
                        <!-- Pending Orders -->
                        <div class="col-md-4">
                           <div class="p-3 border text-center order-stat-card" style="border-radius: 10px; background-color: #fafafa; cursor: pointer; transition: transform 0.2s ease, box-shadow 0.2s ease;" data-bs-toggle="modal" data-bs-target="#pendingOrdersModal">
                              <div style="font-size: 24px;">⏳</div>
                              <h3 class="mb-0 mt-2 font-weight-bold" style="color: #fd7e14;">{{ $pendingOrders }}</h3>
                              <span class="text-muted" style="font-size: 13px; font-weight: 600;">Pending Orders</span>
                           </div>
                        </div>
                        <!-- Completed Orders -->
                        <div class="col-md-4">
                           <div class="p-3 border text-center order-stat-card" style="border-radius: 10px; background-color: #fafafa; cursor: pointer; transition: transform 0.2s ease, box-shadow 0.2s ease;" data-bs-toggle="modal" data-bs-target="#deliveredOrdersModal">
                              <div style="font-size: 24px;">✅</div>
                              <h3 class="mb-0 mt-2 font-weight-bold" style="color: #198754;">{{ $completedOrders }}</h3>
                              <span class="text-muted" style="font-size: 13px; font-weight: 600;">Delivered Orders</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>
         </div>
      </div>
   </div>
</div>

<!-- Styles for Order Statistics -->
<style>
   .order-stat-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
      border-color: #fd7e14 !important;
      background-color: #ffffff !important;
   }
</style>

<!-- Total Orders Modal -->
<div class="modal fade" id="totalOrdersModal" tabindex="-1" aria-labelledby="totalOrdersModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
         <div class="modal-header bg-light" style="border-bottom: 1px solid #eef0f2; border-radius: 16px 16px 0 0; padding: 16px 24px;">
            <h5 class="modal-title font-weight-bold" id="totalOrdersModalLabel" style="color: #253D4E;">📦 Total Orders ({{ $totalOrders }})</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body" style="padding: 24px; max-height: 70vh; overflow-y: auto;">
            @if(count($orders) > 0)
               <div class="table-responsive">
                  <table class="table align-middle table-hover">
                     <thead class="table-light">
                        <tr>
                           <th>Invoice No</th>
                           <th>Order Placed</th>
                           <th>Order Delivered</th>
                           <th>Amount</th>
                           <th>Status</th>
                           <th style="width: 250px;">Items Ordered</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($orders as $order)
                           <tr>
                              <td class="font-weight-bold" style="color: #333;">#{{ $order->invoice_no }}</td>
                              <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                              <td>
                                 @if($order->status == 'delivered' || $order->delivered_date)
                                    {{ Carbon\Carbon::parse($order->delivered_date)->format('d M Y, h:i A') }}
                                 @else
                                    <span class="text-muted">—</span>
                                 @endif
                              </td>
                              <td class="font-weight-bold">Gh {{ number_format($order->amount, 2) }}</td>
                              <td>
                                 @if($order->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                 @elseif($order->status == 'delivered' || $order->status == 'deliverd')
                                    <span class="badge bg-success">Delivered</span>
                                 @else
                                    <span class="badge bg-info">{{ ucfirst($order->status) }}</span>
                                 @endif
                              </td>
                              <td>
                                 <ul class="list-unstyled mb-0" style="font-size: 13px; color: #555; line-height: 1.5;">
                                    @foreach($order->orderItems as $item)
                                       <li class="mb-1 d-flex justify-content-between align-items-center">
                                          <span>• {{ $item->product->product_name ?? 'Product' }}</span>
                                          <span class="text-muted ms-2">x{{ $item->qty }}</span>
                                       </li>
                                    @endforeach
                                 </ul>
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            @else
               <div class="text-center py-4">
                  <span style="font-size: 40px;">📭</span>
                  <p class="text-muted mt-2">No orders found for this client.</p>
               </div>
            @endif
         </div>
      </div>
   </div>
</div>

<!-- Pending Orders Modal -->
<div class="modal fade" id="pendingOrdersModal" tabindex="-1" aria-labelledby="pendingOrdersModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
         <div class="modal-header bg-light" style="border-bottom: 1px solid #eef0f2; border-radius: 16px 16px 0 0; padding: 16px 24px;">
            <h5 class="modal-title font-weight-bold" id="pendingOrdersModalLabel" style="color: #253D4E;">⏳ Pending Orders ({{ $pendingOrders }})</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body" style="padding: 24px; max-height: 70vh; overflow-y: auto;">
            @php
               $hasPending = $orders->contains('status', 'pending');
            @endphp
            @if($hasPending)
               <div class="table-responsive">
                  <table class="table align-middle table-hover">
                     <thead class="table-light">
                        <tr>
                           <th>Invoice No</th>
                           <th>Order Placed</th>
                           <th>Order Delivered</th>
                           <th>Amount</th>
                           <th>Status</th>
                           <th style="width: 250px;">Items Ordered</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($orders as $order)
                           @if($order->status == 'pending')
                              <tr>
                                 <td class="font-weight-bold" style="color: #333;">#{{ $order->invoice_no }}</td>
                                 <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                                 <td>
                                    @if($order->status == 'delivered' || $order->delivered_date)
                                       {{ Carbon\Carbon::parse($order->delivered_date)->format('d M Y, h:i A') }}
                                    @else
                                       <span class="text-muted">—</span>
                                    @endif
                                 </td>
                                 <td class="font-weight-bold">Gh {{ number_format($order->amount, 2) }}</td>
                                 <td><span class="badge bg-warning text-dark">Pending</span></td>
                                 <td>
                                    <ul class="list-unstyled mb-0" style="font-size: 13px; color: #555; line-height: 1.5;">
                                       @foreach($order->orderItems as $item)
                                          <li class="mb-1 d-flex justify-content-between align-items-center">
                                             <span>• {{ $item->product->product_name ?? 'Product' }}</span>
                                             <span class="text-muted ms-2">x{{ $item->qty }}</span>
                                          </li>
                                       @endforeach
                                    </ul>
                                 </td>
                              </tr>
                           @endif
                        @endforeach
                     </tbody>
                  </table>
               </div>
            @else
               <div class="text-center py-4">
                  <span style="font-size: 40px;">⏳</span>
                  <p class="text-muted mt-2">No pending orders found for this client.</p>
               </div>
            @endif
         </div>
      </div>
   </div>
</div>

<!-- Delivered Orders Modal -->
<div class="modal fade" id="deliveredOrdersModal" tabindex="-1" aria-labelledby="deliveredOrdersModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
         <div class="modal-header bg-light" style="border-bottom: 1px solid #eef0f2; border-radius: 16px 16px 0 0; padding: 16px 24px;">
            <h5 class="modal-title font-weight-bold" id="deliveredOrdersModalLabel" style="color: #253D4E;">✅ Delivered Orders ({{ $completedOrders }})</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body" style="padding: 24px; max-height: 70vh; overflow-y: auto;">
            @php
               $hasDelivered = $orders->contains(function ($o) {
                   return $o->status == 'delivered' || $o->status == 'deliverd';
               });
            @endphp
            @if($hasDelivered)
               <div class="table-responsive">
                  <table class="table align-middle table-hover">
                     <thead class="table-light">
                        <tr>
                           <th>Invoice No</th>
                           <th>Order Placed</th>
                           <th>Order Delivered</th>
                           <th>Amount</th>
                           <th>Status</th>
                           <th style="width: 250px;">Items Ordered</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($orders as $order)
                           @if($order->status == 'delivered' || $order->status == 'deliverd')
                              <tr>
                                 <td class="font-weight-bold" style="color: #333;">#{{ $order->invoice_no }}</td>
                                 <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                                 <td>
                                    @if($order->status == 'delivered' || $order->delivered_date)
                                       {{ Carbon\Carbon::parse($order->delivered_date)->format('d M Y, h:i A') }}
                                    @else
                                       <span class="text-muted">—</span>
                                    @endif
                                 </td>
                                 <td class="font-weight-bold">Gh {{ number_format($order->amount, 2) }}</td>
                                 <td><span class="badge bg-success">Delivered</span></td>
                                 <td>
                                    <ul class="list-unstyled mb-0" style="font-size: 13px; color: #555; line-height: 1.5;">
                                       @foreach($order->orderItems as $item)
                                          <li class="mb-1 d-flex justify-content-between align-items-center">
                                             <span>• {{ $item->product->product_name ?? 'Product' }}</span>
                                             <span class="text-muted ms-2">x{{ $item->qty }}</span>
                                          </li>
                                       @endforeach
                                    </ul>
                                 </td>
                              </tr>
                           @endif
                        @endforeach
                     </tbody>
                  </table>
               </div>
            @else
               <div class="text-center py-4">
                  <span style="font-size: 40px;">✅</span>
                  <p class="text-muted mt-2">No delivered orders found for this client.</p>
               </div>
            @endif
         </div>
      </div>
   </div>
</div>

{{-- SweetAlert Confirmation for Account Actions --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
   document.querySelectorAll('.detail-action-form').forEach(function(form) {
      form.addEventListener('submit', function(e) {
         e.preventDefault();
         var action = this.dataset.action;
         var username = this.dataset.username;
         var formEl = this;

         var config = {
            suspend: {
               title: 'Suspend Account?',
               text: 'Are you sure you want to suspend ' + username + '\'s account? They will be logged out and unable to access the platform.',
               icon: 'warning',
               confirmText: 'Yes, Suspend',
               confirmColor: '#ffc107'
            },
            disable: {
               title: 'Disable Account?',
               text: 'Are you sure you want to disable ' + username + '\'s account? This will permanently deactivate their access.',
               icon: 'error',
               confirmText: 'Yes, Disable',
               confirmColor: '#dc3545'
            },
            reactivate: {
               title: 'Reactivate Account?',
               text: 'Are you sure you want to reactivate ' + username + '\'s account? They will regain full access.',
               icon: 'question',
               confirmText: 'Yes, Reactivate',
               confirmColor: '#198754'
            }
         };

         var c = config[action];

         Swal.fire({
            title: c.title,
            text: c.text,
            icon: c.icon,
            showCancelButton: true,
            confirmButtonColor: c.confirmColor,
            cancelButtonColor: '#6c757d',
            confirmButtonText: c.confirmText,
            cancelButtonText: 'Cancel'
         }).then(function(result) {
            if (result.isConfirmed) {
               formEl.submit();
            }
         });
      });
   });
});
</script>
@endsection
