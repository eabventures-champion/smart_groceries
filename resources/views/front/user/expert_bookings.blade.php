@extends('front.master')
@section('content')
@section('title')
 Expert Bookings
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="page-content pt-50 pb-50 account-mobile-padding">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 m-auto">
            <div class="row">
               @include('front.user.dashboard_sidebar_menu')
               <div class="col-md-9">
                  <div class="tab-content account dashboard-content">
                     <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                        <div class="card">
                           <div class="card-header text-center-dashboard">
                              <h3 class="mb-0">Your Expert Bookings<span><i class="fi fi-rs-calendar pl-15"></i></span></h3>
                           </div>
                           <div class="card-body">
                              @if($bookings->isEmpty())
                                 <div class="text-center py-5">
                                    <span style="font-size: 48px;">📅</span>
                                    <h4 class="mt-3" style="color: #253D4E;">No Expert Bookings Yet</h4>
                                    <p class="text-muted">You haven't booked any expert consultations yet. Open the green features dock on the right to find an expert!</p>
                                 </div>
                              @else
                                  <div class="table-responsive">
                                     <table class="table table-striped table-bordered" style="background:#dddddd57; font-weight: 600; width:100%;">
                                        <thead>
                                           <tr>
                                              <th>S/N</th>
                                              <th>Expert Name</th>
                                              <!-- <th>Category</th> -->
                                              <th>Consult Date</th>
                                              <!-- <th>Time Slot</th> -->
                                              <th>Status</th>
                                              <th>Notes</th>
                                              <th>Expert Feedback / Suggestion</th>
                                           </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($bookings as $key => $booking)
                                           <tr>
                                              <td>{{ $key + 1 }}</td>
                                              <td>{{ $booking->expert_name }} <span class="badge rounded-pill bg-warning text-dark">{{ $booking->expert_category }}</span></td>
                                              <!-- <td>{{ $booking->expert_category }}</td> -->
                                              <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }} <span class="badge rounded-pill bg-warning text-dark">{{ $booking->booking_time }}</span></td>
                                              <!-- <td>{{ $booking->booking_time }}</td> -->
                                              <td>
                                                 @if($booking->status == 'pending')
                                                    <span class="badge rounded-pill bg-warning text-dark">Pending</span>
                                                 @elseif($booking->status == 'confirmed')
                                                    <span class="badge rounded-pill bg-success">Confirmed</span>
                                                 @elseif($booking->status == 'completed')
                                                    <span class="badge rounded-pill bg-secondary">Completed</span>
                                                 @else
                                                    <span class="badge rounded-pill bg-danger">{{ ucfirst($booking->status) }}</span>
                                                 @endif
                                              </td>
                                              <td>
                                                 <small style="font-weight: 400; color: #666; font-style: italic;">
                                                    {{ $booking->notes ? Str::limit($booking->notes, 60) : 'None' }}
                                                 </small>
                                              </td>
                                              <td>
                                                 @if($booking->expert_feedback)
                                                    <div class="alert alert-info py-1 px-2 mb-0" style="font-size: 11px; font-weight: 500; line-height: 1.4;">
                                                       {{ $booking->expert_feedback }}
                                                    </div>
                                                 @else
                                                    <span class="text-muted" style="font-weight: 400; font-size: 11px;">Waiting for review...</span>
                                                 @endif
                                              </td>
                                           </tr>
                                           @endforeach
                                        </tbody>
                                     </table>
                                  </div>
                              @endif
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
