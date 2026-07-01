@extends('front.master')
@section('content')
@section('title')
 Dashboard
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<style>
/* ── Student Dashboard Styles ── */
.student-dashboard-hero {
   border-radius: 16px;
   padding: 32px;
   margin-bottom: 24px;
   position: relative;
   overflow: hidden;
}

/* Existing Student = Green Theme */
.student-dashboard-hero.existing {
   background: linear-gradient(135deg, #1b8a4a 0%, #2ecc71 50%, #27ae60 100%);
   color: white;
}

/* Completed Student = Blue/Purple Theme */
.student-dashboard-hero.completed {
   background: linear-gradient(135deg, #2c3e8f 0%, #3b82f6 50%, #6366f1 100%);
   color: white;
}

.student-dashboard-hero::before {
   content: '';
   position: absolute;
   top: -50%;
   right: -20%;
   width: 400px;
   height: 400px;
   background: rgba(255,255,255,0.06);
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
   background: rgba(255,255,255,0.04);
   border-radius: 50%;
   pointer-events: none;
}

.hero-content {
   position: relative;
   z-index: 2;
}

.hero-greeting {
   font-size: 14px;
   opacity: 0.85;
   text-transform: uppercase;
   letter-spacing: 1.5px;
   margin-bottom: 4px;
   font-weight: 500;
}

.hero-name {
   font-size: 28px;
   font-weight: 700;
   margin-bottom: 16px;
   line-height: 1.2;
}

.student-id-badge {
   display: inline-flex;
   align-items: center;
   gap: 8px;
   background: rgba(255,255,255,0.18);
   backdrop-filter: blur(10px);
   border: 1px solid rgba(255,255,255,0.25);
   padding: 8px 18px;
   border-radius: 50px;
   font-family: 'Courier New', monospace;
   font-size: 15px;
   font-weight: 700;
   letter-spacing: 1px;
   margin-bottom: 12px;
}

.student-id-badge .id-icon {
   font-size: 18px;
}

.status-pill {
   display: inline-flex;
   align-items: center;
   gap: 6px;
   padding: 6px 16px;
   border-radius: 50px;
   font-size: 13px;
   font-weight: 600;
   letter-spacing: 0.5px;
}

.status-pill.active-student {
   background: rgba(255,255,255,0.22);
   border: 1px solid rgba(255,255,255,0.35);
   color: white;
}

.status-pill.alumni {
   background: rgba(255,255,255,0.22);
   border: 1px solid rgba(255,255,255,0.35);
   color: white;
}

/* ── Academic Info Card ── */
.academic-card {
   background: white;
   border-radius: 14px;
   padding: 24px;
   box-shadow: 0 2px 12px rgba(0,0,0,0.06);
   margin-bottom: 20px;
   border: 1px solid #f0f0f0;
}

.academic-card .card-title-sm {
   font-size: 12px;
   text-transform: uppercase;
   letter-spacing: 1px;
   color: #999;
   font-weight: 600;
   margin-bottom: 16px;
}

.academic-row {
   display: flex;
   justify-content: space-between;
   align-items: center;
   gap: 16px;
   flex-wrap: wrap;
}

.academic-item {
   text-align: center;
   flex: 1;
   min-width: 100px;
}

.academic-item .value {
   font-size: 26px;
   font-weight: 800;
   color: #253D4E;
   line-height: 1;
   margin-bottom: 4px;
}

.academic-item .label {
   font-size: 12px;
   color: #999;
   text-transform: uppercase;
   letter-spacing: 0.5px;
}

.academic-divider {
   width: 1px;
   height: 50px;
   background: #e8e8e8;
}

/* ── Progress Bar ── */
.progress-section {
   margin-top: 20px;
}

.progress-label {
   display: flex;
   justify-content: space-between;
   margin-bottom: 8px;
   font-size: 13px;
   color: #666;
}

.progress-bar-track {
   width: 100%;
   height: 10px;
   background: #f0f0f0;
   border-radius: 20px;
   overflow: hidden;
}

.progress-bar-fill {
   height: 100%;
   border-radius: 20px;
   transition: width 1.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.progress-bar-fill.green {
   background: linear-gradient(90deg, #27ae60, #2ecc71);
}

.progress-bar-fill.blue {
   background: linear-gradient(90deg, #3b82f6, #6366f1);
}

/* ── Stats Cards ── */
.stats-grid {
   display: grid;
   grid-template-columns: repeat(3, 1fr);
   gap: 16px;
   margin-bottom: 24px;
}

@media (max-width: 768px) {
   .stats-grid {
      grid-template-columns: 1fr;
   }
   .academic-row {
      flex-direction: column;
   }
   .academic-divider {
      display: none;
   }
}

.stat-card {
   background: white;
   border-radius: 14px;
   padding: 20px;
   text-align: center;
   box-shadow: 0 2px 12px rgba(0,0,0,0.06);
   border: 1px solid #f0f0f0;
   transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.stat-card:hover {
   transform: translateY(-3px);
   box-shadow: 0 6px 20px rgba(0,0,0,0.1);
}

.stat-card .stat-icon {
   font-size: 28px;
   margin-bottom: 8px;
}

.stat-card .stat-value {
   font-size: 28px;
   font-weight: 800;
   color: #253D4E;
   line-height: 1.2;
}

.stat-card .stat-label {
   font-size: 13px;
   color: #999;
   margin-top: 4px;
}

/* ── Quick Links ── */
.quick-links-card {
   background: white;
   border-radius: 14px;
   padding: 24px;
   box-shadow: 0 2px 12px rgba(0,0,0,0.06);
   border: 1px solid #f0f0f0;
}

.quick-links-card .card-title-sm {
   font-size: 12px;
   text-transform: uppercase;
   letter-spacing: 1px;
   color: #999;
   font-weight: 600;
   margin-bottom: 16px;
}

.quick-link-item {
   display: flex;
   align-items: center;
   gap: 12px;
   padding: 12px 16px;
   border-radius: 10px;
   color: #253D4E;
   text-decoration: none;
   transition: background 0.2s ease, transform 0.1s ease;
   font-weight: 500;
   font-size: 14px;
}

.quick-link-item:hover {
   background: #f7f8fa;
   transform: translateX(4px);
   color: #3BB77E;
   text-decoration: none;
}

.quick-link-item .link-icon {
   width: 36px;
   height: 36px;
   border-radius: 10px;
   display: flex;
   align-items: center;
   justify-content: center;
   font-size: 16px;
   flex-shrink: 0;
}

.quick-link-item .link-icon.green { background: #e8f5e9; }
.quick-link-item .link-icon.blue { background: #e3f2fd; }
.quick-link-item .link-icon.orange { background: #fff3e0; }
.quick-link-item .link-icon.purple { background: #f3e5f5; }
.quick-link-item .link-icon.red { background: #fce4ec; }

/* ── Completion Badge ── */
.completion-badge {
   display: flex;
   align-items: center;
   gap: 12px;
   background: linear-gradient(135deg, #e8f5e9, #f1f8e9);
   border: 1px solid #c8e6c9;
   padding: 16px 20px;
   border-radius: 12px;
   margin-top: 16px;
}

.completion-badge.alumni-badge {
   background: linear-gradient(135deg, #e3f2fd, #ede7f6);
   border: 1px solid #bbdefb;
}

.completion-badge .badge-icon {
   font-size: 32px;
}

.completion-badge .badge-text {
   font-size: 14px;
   color: #555;
   line-height: 1.5;
}

.completion-badge .badge-text strong {
   display: block;
   font-size: 15px;
   color: #253D4E;
}

/* ── Photo Section ── */
.dashboard-avatar {
   position: relative;
   display: inline-block;
}

.dashboard-avatar img {
   width: 80px;
   height: 80px;
   object-fit: cover;
   border: 3px solid rgba(255,255,255,0.4);
}
</style>

<div class="page-content pt-50 pb-50 account-mobile-padding">
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

                                    <div style="margin-top: 8px;">
                                       @if($isCompleted)
                                          <span class="status-pill alumni">🎓 Alumni &mdash; Completed</span>
                                       @elseif($isExisting)
                                          <span class="status-pill active-student">🎓 Active Student</span>
                                       @else
                                          <span class="status-pill active-student">👤 Member</span>
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
                        <div class="academic-card">
                           <div class="card-title-sm">📚 Academic Information</div>
                           @if($user->institution)
                           <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px; padding: 10px 14px; background: rgba(46,125,50,0.06); border-radius: 10px; border-left: 3px solid #2e7d32;">
                              <span style="font-size: 18px;">🏫</span>
                              <div>
                                 <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: #999; font-weight: 600;">Institution</div>
                                 <div style="font-size: 15px; font-weight: 600; color: #333;">{{ $user->institution }}</div>
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
                                 <div class="value">{{ $totalYears }} <span style="font-size:14px;font-weight:400;color:#999;">yrs</span></div>
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
                        <div class="quick-links-card">
                           <div class="card-title-sm">⚡ Quick Links</div>
                           <a href="{{ route('user.order.page') }}" class="quick-link-item">
                              <div class="link-icon green">📋</div>
                              <span>View My Orders</span>
                           </a>
                           <a href="{{ route('user.track.order') }}" class="quick-link-item">
                              <div class="link-icon blue">📍</div>
                              <span>Track an Order</span>
                           </a>
                           <a href="{{ route('user.account.page') }}" class="quick-link-item">
                              <div class="link-icon orange">👤</div>
                              <span>Account Details</span>
                           </a>
                           <a href="{{ route('user.change.password') }}" class="quick-link-item">
                              <div class="link-icon purple">🔒</div>
                              <span>Change Password</span>
                           </a>
                           <a href="{{ route('return.order.page') }}" class="quick-link-item">
                              <div class="link-icon red">↩️</div>
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

@endsection
