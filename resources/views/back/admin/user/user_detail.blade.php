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
                           <span class="badge bg-success">Active</span>
                        </li>
                     </ul>
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
                           <div class="p-3 border text-center" style="border-radius: 10px; background-color: #fafafa;">
                              <div style="font-size: 24px;">📦</div>
                              <h3 class="mb-0 mt-2 font-weight-bold">{{ $totalOrders }}</h3>
                              <span class="text-muted" style="font-size: 13px;">Total Orders</span>
                           </div>
                        </div>
                        <!-- Pending Orders -->
                        <div class="col-md-4">
                           <div class="p-3 border text-center" style="border-radius: 10px; background-color: #fafafa;">
                              <div style="font-size: 24px;">⏳</div>
                              <h3 class="mb-0 mt-2 font-weight-bold" style="color: #fd7e14;">{{ $pendingOrders }}</h3>
                              <span class="text-muted" style="font-size: 13px;">Pending Orders</span>
                           </div>
                        </div>
                        <!-- Completed Orders -->
                        <div class="col-md-4">
                           <div class="p-3 border text-center" style="border-radius: 10px; background-color: #fafafa;">
                              <div style="font-size: 24px;">✅</div>
                              <h3 class="mb-0 mt-2 font-weight-bold" style="color: #198754;">{{ $completedOrders }}</h3>
                              <span class="text-muted" style="font-size: 13px;">Delivered Orders</span>
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
