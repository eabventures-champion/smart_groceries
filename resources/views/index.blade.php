@extends('front.master')
@section('title')
 Dashboard
@endsection
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<style>
/* ── Fonts ── */
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap');

.dashboard-page-bg {
   background: #f8fafb;
   font-family: 'Inter', sans-serif;
}

/* ── Premium Card Containers ── */
.premium-dashboard-card {
   background: #ffffff;
   border-radius: 20px;
   border: 1px solid #f1f2f4;
   box-shadow: 0 10px 40px rgba(0, 0, 0, 0.03);
   padding: 28px;
   margin-bottom: 24px;
   overflow: hidden;
}

.premium-card-title {
   font-family: 'Outfit', sans-serif;
   font-weight: 700;
   font-size: 15px;
   text-transform: uppercase;
   letter-spacing: 0.8px;
   color: #94a3b8;
   margin-bottom: 20px;
   display: flex;
   align-items: center;
   gap: 8px;
}

/* ── Hero Banner ── */
.student-dashboard-hero {
   border-radius: 24px;
   padding: 36px;
   margin-bottom: 24px;
   position: relative;
   overflow: hidden;
}

.student-dashboard-hero.existing {
   background: linear-gradient(135deg, #1b8a4a 0%, #3bb77e 100%);
   color: white;
   box-shadow: 0 10px 30px rgba(59, 183, 126, 0.15);
}

.student-dashboard-hero.completed {
   background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
   color: white;
   box-shadow: 0 10px 30px rgba(59, 130, 246, 0.15);
}

.student-dashboard-hero::before {
   content: '';
   position: absolute;
   top: -50%;
   right: -20%;
   width: 400px;
   height: 400px;
   background: rgba(255, 255, 255, 0.08);
   border-radius: 50%;
   pointer-events: none;
}

.student-dashboard-hero::after {
   content: '';
   position: absolute;
   bottom: -30%;
   left: -10%;
   width: 300px;
   height: 300px;
   background: rgba(255, 255, 255, 0.05);
   border-radius: 50%;
   pointer-events: none;
}

.hero-content {
   position: relative;
   z-index: 2;
}

.hero-greeting {
   font-size: 12px;
   opacity: 0.9;
   text-transform: uppercase;
   letter-spacing: 1.5px;
   margin-bottom: 6px;
   font-weight: 600;
}

.hero-name {
   font-family: 'Outfit', sans-serif;
   font-size: 32px;
   font-weight: 800;
   margin-bottom: 16px;
   line-height: 1.2;
}

.student-id-badge {
   display: inline-flex;
   align-items: center;
   gap: 8px;
   background: rgba(255, 255, 255, 0.15);
   backdrop-filter: blur(10px);
   border: 1px solid rgba(255, 255, 255, 0.2);
   padding: 8px 18px;
   border-radius: 50px;
   font-family: 'Courier New', monospace;
   font-size: 14px;
   font-weight: 700;
   letter-spacing: 1.5px;
}

.status-pill {
   display: inline-flex;
   align-items: center;
   gap: 6px;
   padding: 6px 16px;
   border-radius: 50px;
   font-size: 12px;
   font-weight: 700;
   letter-spacing: 0.5px;
   background: rgba(255, 255, 255, 0.2);
   border: 1px solid rgba(255, 255, 255, 0.25);
   color: white;
}

/* ── Avatar ── */
.dashboard-avatar {
   position: relative;
   display: inline-block;
}
.dashboard-avatar img {
   width: 84px;
   height: 84px;
   object-fit: cover;
   border: 3.5px solid rgba(255, 255, 255, 0.6);
   box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
}

/* ── Academic Details ── */
.academic-row {
   display: flex;
   justify-content: space-between;
   align-items: center;
   gap: 16px;
   flex-wrap: wrap;
   margin-top: 15px;
}

.academic-item {
   text-align: center;
   flex: 1;
   min-width: 100px;
}

.academic-item .value {
   font-family: 'Outfit', sans-serif;
   font-size: 26px;
   font-weight: 800;
   color: #253D4E;
   margin-bottom: 4px;
}

.academic-item .label {
   font-size: 12px;
   color: #94a3b8;
   font-weight: 600;
   text-transform: uppercase;
   letter-spacing: 0.5px;
}

.academic-divider {
   width: 1px;
   height: 45px;
   background: #f1f2f4;
}

/* Progress bar */
.progress-section {
   margin-top: 24px;
}
.progress-label {
   display: flex;
   justify-content: space-between;
   margin-bottom: 8px;
   font-size: 13px;
   color: #64748b;
   font-weight: 600;
}
.progress-bar-track {
   width: 100%;
   height: 8px;
   background: #f1f2f4;
   border-radius: 20px;
   overflow: hidden;
}
.progress-bar-fill {
   height: 100%;
   border-radius: 20px;
   transition: width 1.5s ease-in-out;
}
.progress-bar-fill.green {
   background: linear-gradient(90deg, #16a34a, #3bb77e);
}
.progress-bar-fill.blue {
   background: linear-gradient(90deg, #2563eb, #3b82f6);
}

.completion-badge {
   display: flex;
   align-items: center;
   gap: 14px;
   background: #f0fdf4;
   border: 1px solid #bbf7d0;
   padding: 16px 20px;
   border-radius: 14px;
   margin-top: 20px;
}
.completion-badge.alumni-badge {
   background: #eff6ff;
   border: 1px solid #bfdbfe;
}
.completion-badge .badge-icon {
   font-size: 26px;
}
.completion-badge .badge-text {
   font-size: 13.5px;
   color: #475569;
   line-height: 1.5;
}
.completion-badge .badge-text strong {
   display: block;
   font-family: 'Outfit', sans-serif;
   font-size: 15px;
   color: #253D4E;
   margin-bottom: 2px;
}

/* ── Stats Grid ── */
.stats-grid {
   display: grid;
   grid-template-columns: repeat(3, 1fr);
   gap: 20px;
   margin-bottom: 24px;
}

.stat-card {
   background: white;
   border-radius: 20px;
   padding: 24px;
   text-align: center;
   box-shadow: 0 10px 40px rgba(0, 0, 0, 0.02);
   border: 1px solid #f1f2f4;
   transition: all 0.25s ease;
}

.stat-card:hover {
   transform: translateY(-3px);
   box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
   border-color: #3bb77e;
}

.stat-card .stat-icon {
   font-size: 32px;
   margin-bottom: 10px;
   display: inline-block;
}

.stat-card .stat-value {
   font-family: 'Outfit', sans-serif;
   font-size: 30px;
   font-weight: 800;
   color: #253D4E;
   line-height: 1.1;
}

.stat-card .stat-label {
   font-size: 13px;
   color: #94a3b8;
   margin-top: 6px;
   font-weight: 600;
}

/* ── Quick Links ── */
.quick-links-grid {
   display: grid;
   grid-template-columns: 1fr;
   gap: 10px;
}

.quick-link-item {
   display: flex;
   align-items: center;
   gap: 15px;
   padding: 14px 20px;
   border-radius: 12px;
   color: #475569;
   text-decoration: none;
   transition: all 0.25s ease;
   font-weight: 600;
   font-size: 14px;
   border: 1px solid transparent;
}

.quick-link-item:hover {
   background: #fafbfc;
   border-color: #e5e7eb;
   color: #3BB77E;
   text-decoration: none;
   transform: translateX(4px);
}

.quick-link-item .link-icon {
   width: 38px;
   height: 38px;
   border-radius: 10px;
   display: flex;
   align-items: center;
   justify-content: center;
   font-size: 18px;
   flex-shrink: 0;
}

.quick-link-item .link-icon.green { background: #f0fdf4; color: #16a34a; }
.quick-link-item .link-icon.blue { background: #eff6ff; color: #2563eb; }
.quick-link-item .link-icon.orange { background: #fff7ed; color: #ea580c; }
.quick-link-item .link-icon.purple { background: #faf5ff; color: #7c3aed; }
.quick-link-item .link-icon.red { background: #fdf2f8; color: #db2777; }

/* ── Responsive ── */
@media (max-width: 768px) {
   .stats-grid {
      grid-template-columns: repeat(3, 1fr) !important;
      gap: 10px !important;
   }
   .stat-card {
      padding: 16px 8px !important;
      border-radius: 16px !important;
   }
   .stat-card .stat-icon {
      font-size: 24px !important;
   }
   .stat-card .stat-value {
      font-size: 22px !important;
   }
   .stat-card .stat-label {
      font-size: 11px !important;
   }
   .academic-row {
      flex-direction: column;
   }
   .academic-divider {
      display: none;
   }
}
</style>

<div class="page-content pt-50 pb-50 account-mobile-padding dashboard-page-bg">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 m-auto">
            <div class="row">
               @include('front.user.dashboard_sidebar_menu')
               <div class="col-md-9">
                  <div class="tab-content account dashboard-content pl-50 mobile-pl-50">
                     <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">

                        {{-- ═══ HERO BANNER ═══ --}}
                        @php
                           $isExisting = $user->isExistingStudent();
                           $isCompleted = $user->isCompletedStudent();
                           $studentStatus = $user->student_status;
                           $heroClass = $isCompleted ? 'completed' : 'existing';

                           // Calculate progress
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

                        <div class="student-dashboard-hero {{ $heroClass }}">
                           <div class="hero-content">
                              <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap:16px;">
                                 <div>
                                    <div class="hero-greeting">
                                       @if($user->status_identity === 'non-student')
                                          Welcome back
                                       @elseif($isCompleted)
                                          Welcome back, Alumni
                                       @else
                                          Welcome back, Student
                                       @endif
                                    </div>
                                    <div class="hero-name">{{ $user->name }}</div>

                                    @if($user->student_id)
                                       <div class="student-id-badge">
                                          <span class="id-icon">🪪</span>
                                          {{ $user->student_id }}
                                       </div>
                                    @endif

                                    <div style="margin-top: 10px;">
                                       @if($isCompleted)
                                          <span class="status-pill">🎓 Alumni &mdash; Completed</span>
                                       @elseif($isExisting)
                                          <span class="status-pill">🎓 Active Student</span>
                                       @else
                                          <span class="status-pill">👤 Member</span>
                                       @endif
                                    </div>
                                 </div>

                                 <div class="dashboard-avatar">
                                    <img class="rounded-circle p-1" style="border-color: rgba(255,255,255,0.4); background: rgba(255,255,255,0.15);" src="{{ (!empty($user->photo)) ? url('front/assets/imgs/users/'.$user->photo) : url('front/assets/imgs/users/no_image.jpg') }}" alt="{{ $user->name }}">
                                 </div>
                              </div>
                           </div>
                        </div>

                        {{-- ═══ ACADEMIC INFO CARD ═══ --}}
                        @if($user->year_of_admission && $user->year_of_completion)
                        <div class="premium-dashboard-card">
                           <div class="premium-card-title">
                              <i class="fa-solid fa-graduation-cap" style="color: #3bb77e;"></i> Academic Information
                           </div>
                           @if($user->institution)
                           <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 18px; padding: 12px 16px; background: #f0fdf4; border-radius: 12px; border-left: 4px solid #16a34a;">
                              <span style="font-size: 20px;">🏫</span>
                              <div>
                                 <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: #94a3b8; font-weight: 700;">Institution</div>
                                 <div style="font-size: 14.5px; font-weight: 700; color: #253D4E;">{{ $user->institution }}</div>
                              </div>
                           </div>
                           @endif
                           <div class="academic-row">
                              <div class="academic-item">
                                 <div class="value">{{ $user->year_of_admission }}</div>
                                 <div class="label">Admission Year</div>
                              </div>
                              <div class="academic-divider"></div>
                              <div class="academic-item">
                                 <div class="value">{{ $user->year_of_completion }}</div>
                                 <div class="label">Completion Year</div>
                              </div>
                              <div class="academic-divider"></div>
                              <div class="academic-item">
                                 <div class="value">{{ $totalYears }} <span style="font-size:14px;font-weight:400;color:#94a3b8;">yrs</span></div>
                                 <div class="label">Duration</div>
                              </div>
                           </div>

                           @if($isExisting)
                              {{-- Progress bar for existing students --}}
                              <div class="progress-section">
                                 <div class="progress-label">
                                    <span>Academic Progress</span>
                                    <span><strong>{{ $progress }}%</strong></span>
                                 </div>
                                 <div class="progress-bar-track">
                                    <div class="progress-bar-fill green" style="width: {{ $progress }}%;"></div>
                                 </div>
                              </div>

                              <div class="completion-badge">
                                 <span class="badge-icon">⏳</span>
                                 <div class="badge-text">
                                    <strong>Expected completion in {{ $user->year_of_completion }}</strong>
                                    {{ $user->year_of_completion - date('Y') }} year(s) remaining in your academic journey.
                                 </div>
                              </div>
                           @else
                              {{-- Completed bar for alumni --}}
                              <div class="progress-section">
                                 <div class="progress-label">
                                    <span>Academic Journey</span>
                                    <span><strong>100% Complete</strong></span>
                                 </div>
                                 <div class="progress-bar-track">
                                    <div class="progress-bar-fill blue" style="width: 100%;"></div>
                                 </div>
                              </div>

                              <div class="completion-badge alumni-badge">
                                 <span class="badge-icon">🎉</span>
                                 <div class="badge-text">
                                    <strong>Congratulations, Alumni!</strong>
                                    You completed your studies in {{ $user->year_of_completion }}. Your student ID has been updated to Alumni status.
                                 </div>
                              </div>
                           @endif
                        </div>
                        @endif

                        {{-- Coupons --}}
                        @php
                            $userCoupons = \App\Models\Coupon::where('user_id', Auth::id())
                                ->where('status', 1)
                                ->whereDate('coupon_validity', '>=', date('Y-m-d'))
                                ->get();
                        @endphp

                        @if($userCoupons->count() > 0)
                        <div class="card mb-4" style="border: 2px dashed #3BB77E; background-color: #f6fdf9; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 40px rgba(59, 183, 126, 0.04);">
                            <div class="card-body" style="padding: 24px;">
                                <div class="d-flex align-items-center" style="margin-bottom: 12px;">
                                    <span style="font-size: 24px; margin-right: 12px;">🎁</span>
                                    <div>
                                        <h5 style="color: #16a34a; font-weight: 700; margin-bottom: 2px; font-size: 16px; font-family: 'Outfit', sans-serif;">Your Personal Discount Coupon!</h5>
                                        <p class="text-muted mb-0" style="font-size: 12px;">Use this coupon code at checkout to apply your discount.</p>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap align-items-center mt-3" style="gap: 15px;">
                                    @foreach($userCoupons as $coupon)
                                    <div style="background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; padding: 12px 18px; display: inline-flex; align-items: center; gap: 12px; flex-wrap: wrap; box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
                                        <span class="badge bg-success" style="font-size: 11px; font-weight: bold; padding: 6px 12px; color: #fff; border-radius: 20px;">{{ $coupon->coupon_discount }}% OFF</span>
                                        <code style="font-size: 14px; font-weight: 700; color: #16a34a; background: #f0fdf4; padding: 4px 10px; border-radius: 6px; border: 1px dashed #3BB77E; font-family: monospace;">{{ $coupon->coupon_name }}</code>
                                        <small class="text-muted" style="font-size: 11.5px; font-weight: 500;">Expires: {{ date('d M Y', strtotime($coupon->coupon_validity)) }}</small>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif

                        {{-- ═══ ORDER STATS ═══ --}}
                        <div class="stats-grid">
                           <div class="stat-card">
                              <div class="stat-icon">📦</div>
                              <div class="stat-value">{{ $totalOrders ?? 0 }}</div>
                              <div class="stat-label">Total Orders</div>
                           </div>
                           <div class="stat-card">
                              <div class="stat-icon">⏳</div>
                              <div class="stat-value">{{ $pendingOrders ?? 0 }}</div>
                              <div class="stat-label">Pending</div>
                           </div>
                           <div class="stat-card">
                              <div class="stat-icon">✅</div>
                              <div class="stat-value">{{ $completedOrders ?? 0 }}</div>
                              <div class="stat-label">Delivered</div>
                           </div>
                        </div>

                        {{-- ═══ QUICK LINKS ═══ --}}
                        <div class="premium-dashboard-card">
                           <div class="premium-card-title">
                              <i class="fa-solid fa-bolt" style="color: #eab308;"></i> Quick Actions
                           </div>
                           <div class="quick-links-grid">
                              <a href="{{ route('user.order.page') }}" class="quick-link-item">
                                 <div class="link-icon green"><i class="fa-solid fa-list-check"></i></div>
                                 <span>View My Orders</span>
                              </a>
                              <a href="{{ route('user.track.order') }}" class="quick-link-item">
                                 <div class="link-icon blue"><i class="fa-solid fa-map-pin"></i></div>
                                 <span>Track an Order</span>
                              </a>
                              <a href="{{ route('user.account.page') }}" class="quick-link-item">
                                 <div class="link-icon orange"><i class="fa-solid fa-user-gear"></i></div>
                                 <span>Account Details</span>
                              </a>
                              <a href="{{ route('user.change.password') }}" class="quick-link-item">
                                 <div class="link-icon purple"><i class="fa-solid fa-key"></i></div>
                                 <span>Change Password</span>
                              </a>
                              <a href="{{ route('return.order.page') }}" class="quick-link-item">
                                 <div class="link-icon red"><i class="fa-solid fa-arrow-rotate-left"></i></div>
                                 <span>Return Orders</span>
                              </a>
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

@endsection
