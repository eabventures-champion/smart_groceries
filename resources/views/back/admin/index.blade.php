@extends('back.admin.master')
@section('content')

@php
    $date = date('d F Y');
    $today = App\Models\Order::where('order_date', $date)->sum('amount');

    $month = date('F');
    $month = App\Models\Order::where('order_month', $month)->sum('amount');

    $year = date('Y');
    $year = App\Models\Order::where('order_year', $year)->sum('amount');

    $pending_count = App\Models\Order::where('status', 'pending')->count();
    $vendor_count = App\Models\User::where('status', 'active')->where('role','vendor')->count();
    $customer_count = App\Models\User::where('status', 'active')->where('role','user')->count();

    $total_orders_count = App\Models\Order::count();
    $total_delivered_count = App\Models\Order::where('status', 'delivered')->count();
    $total_experts_count = App\Models\Expert::count();
@endphp

<!--start page wrapper -->
<div class="page-content">
   <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
      <div class="col">
         <div class="card radius-10 bg-gradient-deepblue">
            <div class="card-body">
               <div class="d-flex align-items-center">
                  <h5 class="mb-0 text-white">Gh {{ number_format($today, 2) }}</h5>
                  <div class="ms-auto">
                     <i class='bx bx-cart fs-3 text-white'></i>
                  </div>
               </div>
               <div class="progress my-3 bg-light-transparent" style="height:3px;">
                  <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
               <div class="d-flex align-items-center text-white">
                  <p class="mb-0">Today's Sale</p>
                  {{-- <p class="mb-0 ms-auto">+4.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
               </div>
            </div>
         </div>
      </div>
      <div class="col">
         <div class="card radius-10 bg-gradient-orange">
            <div class="card-body">
               <div class="d-flex align-items-center">
                  <h5 class="mb-0 text-white">Gh {{ number_format($month, 2) }}</h5>
                  <div class="ms-auto">
                     <i class='bx bx-dollar fs-3 text-white'></i>
                  </div>
               </div>
               <div class="progress my-3 bg-light-transparent" style="height:3px;">
                  <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
               <div class="d-flex align-items-center text-white">
                  <p class="mb-0">Monthly Sale</p>
                  {{-- <p class="mb-0 ms-auto">+1.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
               </div>
            </div>
         </div>
      </div>
      <div class="col">
         <div class="card radius-10 bg-gradient-ohhappiness">
            <div class="card-body">
               <div class="d-flex align-items-center">
                  <h5 class="mb-0 text-white">Gh {{ number_format($year, 2) }}</h5>
                  <div class="ms-auto">
                     <i class='bx bx-group fs-3 text-white'></i>
                  </div>
               </div>
               <div class="progress my-3 bg-light-transparent" style="height:3px;">
                  <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
               <div class="d-flex align-items-center text-white">
                  <p class="mb-0">Yearly Sale</p>
                  {{-- <p class="mb-0 ms-auto">+5.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
               </div>
            </div>
         </div>
      </div>
      <div class="col">
         <div class="card radius-10 bg-gradient-ibiza">
            <div class="card-body">
               <div class="d-flex align-items-center">
                  <h5 class="mb-0 text-white">{{ $pending_count }}</h5>
                  <div class="ms-auto">
                     <i class='bx bx-envelope fs-3 text-white'></i>
                  </div>
               </div>
               <div class="progress my-3 bg-light-transparent" style="height:3px;">
                  <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
               <div class="d-flex align-items-center text-white">
                  <p class="mb-0">Pending Orders</p>
                  {{-- <p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
               </div>
            </div>
         </div>
      </div>
      {{-- <div class="col">
         <div class="card radius-10 bg-gradient-ibiza">
            <div class="card-body">
               <div class="d-flex align-items-center">
                  <h5 class="mb-0 text-white">{{ count($vendor) }}</h5>
                  <div class="ms-auto">
                     <i class='bx bx-envelope fs-3 text-white'></i>
                  </div>
               </div>
               <div class="progress my-3 bg-light-transparent" style="height:3px;">
                  <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
               <div class="d-flex align-items-center text-white">
                  <p class="mb-0">Total Vendor </p>
                  <p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p>
               </div>
            </div>
         </div>
      </div> --}}
      <div class="col">
         <div class="card radius-10 bg-gradient-cosmic">
            <div class="card-body">
               <div class="d-flex align-items-center">
                  <h5 class="mb-0 text-white">{{ $customer_count }}</h5>
                  <div class="ms-auto">
                     <i class='bx bx-group fs-3 text-white'></i>
                  </div>
               </div>
               <div class="progress my-3 bg-light-transparent" style="height:3px;">
                  <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
               <div class="d-flex align-items-center text-white">
                  <p class="mb-0">Total Users</p>
               </div>
            </div>
         </div>
      </div>
      <div class="col">
         <div class="card radius-10 bg-gradient-burning">
            <div class="card-body">
               <div class="d-flex align-items-center">
                  <h5 class="mb-0 text-white">{{ $total_orders_count }}</h5>
                  <div class="ms-auto">
                     <i class='bx bx-shopping-bag fs-3 text-white'></i>
                  </div>
               </div>
               <div class="progress my-3 bg-light-transparent" style="height:3px;">
                  <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
               <div class="d-flex align-items-center text-white">
                  <p class="mb-0">Total Orders</p>
               </div>
            </div>
         </div>
      </div>
      <div class="col">
         <div class="card radius-10 bg-gradient-lush">
            <div class="card-body">
               <div class="d-flex align-items-center">
                  <h5 class="mb-0 text-white">{{ $total_delivered_count }}</h5>
                  <div class="ms-auto">
                     <i class='bx bx-check-circle fs-3 text-white'></i>
                  </div>
               </div>
               <div class="progress my-3 bg-light-transparent" style="height:3px;">
                  <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
               <div class="d-flex align-items-center text-white">
                  <p class="mb-0">Total Delivered</p>
               </div>
            </div>
         </div>
      </div>
      <div class="col">
         <div class="card radius-10 bg-gradient-moonlit">
            <div class="card-body">
               <div class="d-flex align-items-center">
                  <h5 class="mb-0 text-white">{{ $total_experts_count }}</h5>
                  <div class="ms-auto">
                     <i class='bx bx-support fs-3 text-white'></i>
                  </div>
               </div>
               <div class="progress my-3 bg-light-transparent" style="height:3px;">
                  <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
               <div class="d-flex align-items-center text-white">
                  <p class="mb-0">Total Experts</p>
               </div>
            </div>
         </div>
      </div>
   </div>

   @php
   // Query orders by institution (district)
   $institution_stats = App\Models\Order::select('district_id', DB::raw('count(id) as order_count'), DB::raw('sum(amount) as total_amount'))
       ->groupBy('district_id')
       ->with('district')
       ->get();

   $inst_labels = [];
   $inst_data = [];
   foreach ($institution_stats as $stat) {
       $inst_labels[] = $stat->district ? $stat->district->district_name : 'Direct/Other';
       $inst_data[] = $stat->order_count;
   }

    // Query top booked experts
    $expert_bookings = App\Models\ExpertBooking::select('expert_name', 'expert_category', DB::raw('count(id) as booking_count'))
        ->groupBy('expert_name', 'expert_category')
        ->orderBy('booking_count', 'desc')
        ->limit(5)
        ->get();

   // Query top customers by total order count and total amount spent
   $top_customers = App\Models\Order::select('user_id', DB::raw('count(id) as order_count'), DB::raw('sum(amount) as total_spent'))
       ->groupBy('user_id')
       ->orderBy('order_count', 'desc')
       ->limit(5)
       ->with('user')
       ->get();

   // Recalculate customer tiers based on dynamic database recognition tiers
   $tiers = App\Models\RecognitionTier::orderBy('min_spent', 'desc')->get();

   foreach ($top_customers as $cust) {
       if ($cust->user) {
           $spent = (float)$cust->total_spent;
           $new_tier = 'Regular Customer';
           foreach ($tiers as $t) {
               if ($spent >= (float)$t->min_spent) {
                   $new_tier = $t->name;
                   break;
               }
           }

           if ($cust->user->recognition_tier !== $new_tier) {
               $cust->user->recognition_tier = $new_tier;
               $cust->user->save();
           }
       }
   }
   @endphp

    <div class="row">
        <!-- Institution Orders Chart & Table -->
        <div class="col-12 col-lg-6 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div>
                            <h6 class="mb-0">Orders by Institution</h6>
                        </div>
                    </div>
                    <div class="chart-container" style="position: relative; height: 180px; margin-bottom: 20px;">
                        <canvas id="institutionOrdersChart"></canvas>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 table-sm" style="font-size: 12px;">
                            <thead class="table-light">
                                <tr>
                                    <th>Institution</th>
                                    <th>Total Orders</th>
                                    <th>Revenue Generated</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($institution_stats as $stat)
                                <tr>
                                    <td><strong>{{ $stat->district ? $stat->district->district_name : 'Direct/Other' }}</strong></td>
                                    <td>{{ $stat->order_count }} Orders</td>
                                    <td style="font-weight: 600; color: #2e8b5e;">Gh {{ number_format($stat->total_amount, 2) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">No institutional orders found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Booked Experts -->
        <div class="col-12 col-lg-6 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center mb-3">
                            <div>
                                <h6 class="mb-0">Most Booked Experts</h6>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush w-100">
                            @forelse($expert_bookings as $expert)
                            <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent py-3">
                                <div>
                                    <i class="bx bx-support text-primary fs-4 me-2"></i>
                                    <strong>{{ $expert->expert_name }}</strong>
                                    <span class="badge text-primary ms-2" style="font-size: 10px; font-weight: 700; background-color: rgba(13, 110, 253, 0.08); border: 1px solid rgba(13, 110, 253, 0.15); padding: 4px 8px; border-radius: 6px;">{{ $expert->expert_category }}</span>
                                </div>
                                <span class="badge bg-gradient-deepblue text-white rounded-pill px-3 py-2" style="font-size: 11px;">{{ $expert->booking_count }} Bookings</span>
                            </li>
                            @empty
                            <li class="list-group-item text-muted bg-transparent">No bookings recorded yet.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Customers for Recognition & Discounts -->
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <h6 class="mb-0">Top Customers for Recognition & Discount Packages</h6>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Customer</th>
                            <th>Total Orders</th>
                            <th>Total Spent</th>
                            <th>Recognition Tier</th>
                            <th>Discount Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($top_customers as $key => $cust)
                            @if($cust->user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center justify-content-center text-white" style="width: 35px; height: 35px; border-radius: 50%; font-weight: bold; background: #3bb77e;">
                                            {{ strtoupper(substr($cust->user->name, 0, 1)) }}
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="mb-0" style="font-size: 13px;">
                                                <a href="{{ route('admin.client.detail', $cust->user->id) }}" class="text-primary fw-bold" style="text-decoration: none;">
                                                    {{ $cust->user->name }}
                                                </a>
                                            </h6>
                                            <p class="mb-0 text-muted" style="font-size: 11px;">{{ $cust->user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span style="font-weight: 600;">{{ $cust->order_count }}</span> Orders</td>
                                <td style="font-weight: 600; color: #2e8b5e;">Gh {{ number_format($cust->total_spent, 2) }}</td>
                                <td>
                                    @php
                                        $userTierObj = \App\Models\RecognitionTier::where('name', $cust->user->recognition_tier)->first();
                                        $badgeStyle = $userTierObj ? $userTierObj->badge_style : 'light';
                                        $discountPct = $userTierObj ? $userTierObj->discount_percent : 0;
                                        $slugName = strtoupper(Str::slug($cust->user->name));
                                        $tierPrefix = $userTierObj ? strtoupper(Str::slug($userTierObj->name)) . '-' : 'REGULAR-';
                                    @endphp
                                    <span class="badge 
                                        @if($badgeStyle === 'warning') bg-warning text-dark
                                        @elseif($badgeStyle === 'secondary') bg-secondary text-white
                                        @elseif($badgeStyle === 'light') bg-light text-dark border
                                        @elseif($badgeStyle === 'success') bg-success text-white
                                        @elseif($badgeStyle === 'danger') bg-danger text-white
                                        @else bg-primary text-white
                                        @endif">
                                        <i class="bx 
                                            @if($badgeStyle === 'warning') bxs-crown
                                            @elseif($badgeStyle === 'secondary') bxs-medal
                                            @elseif($badgeStyle === 'light') bx-award
                                            @elseif($badgeStyle === 'success') bx-check-shield
                                            @elseif($badgeStyle === 'danger') bx-star
                                            @else bx-medal
                                            @endif me-1"></i>{{ $cust->user->recognition_tier ?? 'Regular' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('add.coupon') }}?code={{ $tierPrefix }}{{ $slugName }}&discount={{ $discountPct }}&user_id={{ $cust->user->id }}" 
                                       class="btn btn-sm text-white" 
                                       style="background: #3bb77e; font-size: 11px; padding: 5px 10px; font-weight: 700; border-radius: 8px;">
                                        <i class="bx bx-check-circle me-1"></i>Approve & Set Discount
                                    </a></td>
                            </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No order data available yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Top Affiliate Partners -->
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <h6 class="mb-0">Top Affiliate Partners</h6>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Affiliate</th>
                            <th>Referral Code</th>
                            <th>Total Referrals</th>
                            <th>Total Commission Earned</th>
                            <th>Current Balance</th>
                            <th>Profile</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(App\Models\User::where('role', 'user')->whereNotNull('referral_code')->get()->map(function($user) {
                            $user->referrals_count = App\Models\User::where('referred_by', $user->id)->count();
                            $user->total_earned = App\Models\AffiliateReferral::where('referrer_id', $user->id)->sum('commission_earned');
                            return $user;
                        })->sortByDesc('referrals_count')->take(5) as $affiliate)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center justify-content-center text-white" style="width: 35px; height: 35px; border-radius: 50%; font-weight: bold; background: #7B2828;">
                                        {{ strtoupper(substr($affiliate->name, 0, 1)) }}
                                    </div>
                                    <div class="ms-2">
                                        <h6 class="mb-0" style="font-size: 13px;">{{ $affiliate->name }}</h6>
                                        <p class="mb-0 text-muted" style="font-size: 11px;">{{ $affiliate->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td><code style="font-size: 12px; font-weight: bold; color: #7B2828;">{{ $affiliate->referral_code }}</code></td>
                            <td><span class="badge bg-info text-dark" style="font-size: 11px; font-weight: 600;">{{ $affiliate->referrals_count }} referrals</span></td>
                            <td style="font-weight: 600; color: #2e8b5e;">Gh {{ number_format($affiliate->total_earned, 2) }}</td>
                            <td style="font-weight: 600; color: #7B2828;">Gh {{ number_format($affiliate->referral_balance, 2) }}</td>
                            <td>
                                <a href="{{ route('admin.client.detail', $affiliate->id) }}" class="btn btn-sm text-white" style="background-color: #3bb77e; border-color: #3bb77e; border-radius: 6px; font-size: 11px; padding: 4px 8px;">
                                    View Details
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                           <td colspan="6" class="text-center text-muted">No affiliate data available yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ChartJS Initialization Script -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('institutionOrdersChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($inst_labels) !!},
                datasets: [{
                    label: 'Orders',
                    data: {!! json_encode($inst_data) !!},
                    backgroundColor: 'rgba(59, 183, 126, 0.75)',
                    borderColor: 'rgba(59, 183, 126, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }]
                }
            }
        });
    });
    </script>

   @php
   $orders = App\Models\Order::where('status','pending')->orderBy('id','DESC')->limit(10)->get();
   @endphp

   <div class="card radius-10">
      <div class="card-body">
         <div class="d-flex align-items-center">
            <div>
               <h5 class="mb-0">Orders Summary</h5>
            </div>
            <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
            </div>
         </div>
         <hr>
         <div class="table-responsive">
            <table class="table align-middle mb-0">
               <thead class="table-light">
                  <tr>
                     <th>S/N</th>
                     <th>Date</th>
                     <th>Invoice</th>
                     <th>Amount</th>
                     {{-- <th>Payment</th> --}}
                     <th>Status</th>
                     <th>Time</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($orders as $key => $order)
                  <tr>
                     <td>{{ $key+1 }}</td>
                     <td>{{ $order->order_date }}</td>
                     <td>{{ $order->invoice_no }}</td>
                     <td>Gh {{ number_format($order->amount, 2) }}</td>
                     {{-- <td>{{ $order->payment_method }}</td> --}}
                     <td>
                        <div class="badge rounded-pill bg-light-primary text-primary w-100"> 
                           {{ $order->status  }}
                        </div>
                     </td>
                     <td>{{ ($order->created_at)->diffForHumans() }}</td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<!--end page wrapper -->
@endsection