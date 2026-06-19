@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">My Bookings</div>
      <div class="ps-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
               <li class="breadcrumb-item active" aria-current="page">Session Bookings List</li>
            </ol>
         </nav>
      </div>
   </div>
   <!--end breadcrumb-->
   <hr/>
   <div class="card">
      <div class="card-body">
         <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
               <thead>
                  <tr>
                     <th>S/N</th>
                     <th>User Info</th>
                     <th>Booking Date/Time</th>
                     <th>Notes</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                @foreach ($bookings as $key => $booking)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            <strong>{{ $booking->user_name }}</strong><br/>
                            <span class="text-muted" style="font-size: 11px;">{{ $booking->user_email }}</span>
                        </td>
                        <td>
                            📅 {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}<br/>
                            ⏰ {{ $booking->booking_time }}
                        </td>
                        <td style="max-width: 250px; white-space: normal;">{{ $booking->notes ?? 'N/A' }}</td>
                        <td>
                            @if ($booking->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif ($booking->status == 'confirmed')
                                <span class="badge bg-info">Confirmed</span>
                            @elseif ($booking->status == 'completed')
                                <span class="badge bg-success">Completed</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('expert.bookings.status') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="id" value="{{ $booking->id }}">
                                <div class="d-flex flex-column gap-2" style="min-width: 180px;">
                                    <select name="status" class="form-select form-select-sm">
                                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirm</option>
                                        <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Complete</option>
                                    </select>
                                    <textarea name="expert_feedback" class="form-control form-control-sm" rows="2" placeholder="Reschedule suggestion/feedback...">{{ $booking->expert_feedback }}</textarea>
                                    <button type="submit" class="btn btn-sm btn-primary w-100">Update</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
@endsection
