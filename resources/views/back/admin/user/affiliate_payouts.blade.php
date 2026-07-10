@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Affiliate Payouts <span class="badge bg-success ms-2" style="font-size: 13px;">{{ count($payoutUsers) }}</span></div>
      <div class="ps-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
               <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">Redrawal Requests</li>
            </ol>
         </nav>
      </div>
   </div>
   <!--end breadcrumb-->
   <hr/>
   <div class="card">
      <div class="card-body">
         <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered align-middle" style="width:100%">
               <thead>
                  <tr>
                     <th>S/N</th>
                     <th>Affiliate Partner</th>
                     <th>Email</th>
                     <th>Total Requests</th>
                     <th>Total Requested Amount</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($payoutUsers as $key => $item)		
                  <tr>
                     <td> {{ $key+1 }} </td>
                     <td> 
                        <strong>{{ $item->name }}</strong>
                     </td>
                     <td>{{ $item->email }}</td>
                     <td>{{ $item->total_requests }} {{ Str::plural('request', $item->total_requests) }}</td>
                     <td><strong class="text-success">Gh {{ number_format($item->total_amount, 2) }}</strong></td>
                     <td>
                        @if($item->pending_requests > 0)
                           <span class="badge bg-warning text-dark px-3 py-1 text-uppercase" style="font-size: 10px; font-weight: 700;">
                              {{ $item->pending_requests }} Pending (Gh {{ number_format($item->pending_amount, 2) }})
                           </span>
                        @else
                           <span class="badge bg-success px-3 py-1 text-uppercase" style="font-size: 10px; font-weight: 700;">All Processed</span>
                        @endif
                     </td>
                     <td>
                        <button type="button" class="btn btn-sm btn-primary px-3 d-flex align-items-center gap-1" style="border-radius: 6px;" onclick="showPayoutDetails({{ $item->id }}, '{{ addslashes($item->name) }}')">
                           <i class="bx bx-cog"></i> Manage Payouts
                        </button>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>

<!-- Modal for User Payout Details -->
<div class="modal fade" id="payoutDetailsModal" tabindex="-1" aria-labelledby="payoutDetailsModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.12);">
         <div class="modal-header border-0 bg-light" style="padding: 20px 24px; border-radius: 16px 16px 0 0;">
            <h5 class="modal-title" id="payoutDetailsModalLabel" style="font-family: 'Outfit', sans-serif; font-weight: 700; color: #2d3748;">
               <i class="bx bx-wallet me-2" style="font-size: 22px; vertical-align: middle;"></i>Redrawal Requests Details
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body" style="padding: 24px;">
            <!-- Loader -->
            <div id="payout-modal-loader" class="text-center py-5">
               <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                  <span class="visually-hidden">Loading...</span>
               </div>
               <p class="text-muted mt-2">Loading redrawal requests...</p>
            </div>
            
            <!-- Table Container -->
            <div id="payouts-table-wrapper" style="display: none;">
               <div class="table-responsive">
                  <table class="table table-hover align-middle">
                     <thead class="table-light">
                        <tr>
                           <th>Amount</th>
                           <th>Payment Method</th>
                           <th>Date Requested</th>
                           <th>Status</th>
                           <th style="text-align: right;">Action</th>
                        </tr>
                     </thead>
                     <tbody id="payouts-list-tbody">
                        <!-- Dynamic payout requests here -->
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="modal-footer border-0" style="padding: 16px 24px;">
            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal" style="border-radius: 8px;">Close</button>
         </div>
      </div>
   </div>
</div>

<script>
function showPayoutDetails(userId, userName) {
    // Set user name in modal title
    document.getElementById('payoutDetailsModalLabel').innerHTML = `<i class="bx bx-wallet me-2" style="font-size: 22px; vertical-align: middle;"></i>Redrawal Requests: ${userName}`;
    
    // Reset modal display states
    document.getElementById('payout-modal-loader').style.display = 'block';
    document.getElementById('payouts-table-wrapper').style.display = 'none';
    document.getElementById('payouts-list-tbody').innerHTML = '';
    
    // Show modal
    const payoutModal = new bootstrap.Modal(document.getElementById('payoutDetailsModal'));
    payoutModal.show();
    
    // Fetch payouts via AJAX
    fetch(`/admin/payout/user-details/${userId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('payout-modal-loader').style.display = 'none';
            
            if (data && data.length > 0) {
                let rowsHtml = '';
                data.forEach(payout => {
                    let statusBadge = '';
                    if (payout.status === 'pending') {
                        statusBadge = `<span class="badge bg-warning text-dark text-uppercase" style="font-size: 10px; font-weight: 600;">Pending</span>`;
                    } else if (payout.status === 'completed') {
                        statusBadge = `<span class="badge bg-success text-uppercase" style="font-size: 10px; font-weight: 600;">Approved</span>`;
                    } else if (payout.status === 'rejected') {
                        statusBadge = `<span class="badge bg-danger text-uppercase" style="font-size: 10px; font-weight: 600;">Rejected</span>`;
                    }

                    let actionHtml = '';
                    if (payout.status === 'pending') {
                        actionHtml = `
                            <div class="d-flex gap-2 justify-content-end">
                                <form action="/admin/payout/approve/${payout.id}" method="POST" onsubmit="return confirm('Are you sure you want to approve this payout request?');" style="margin: 0;">
                                    <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                    <button type="submit" class="btn btn-sm btn-success px-3" style="border-radius: 6px; font-size: 11px; font-weight: 600;">Approve</button>
                                </form>
                                <form action="/admin/payout/reject/${payout.id}" method="POST" onsubmit="return confirm('Are you sure you want to reject this payout request and refund the user?');" style="margin: 0;">
                                    <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                    <button type="submit" class="btn btn-sm btn-danger px-3" style="border-radius: 6px; font-size: 11px; font-weight: 600;">Reject</button>
                                </form>
                                <a href="/affiliate/payout/receipt/${payout.id}" class="btn btn-sm btn-primary px-3 text-white d-flex align-items-center gap-1" style="border-radius: 6px; font-size: 11px; font-weight: 600;" target="_blank">
                                    <i class="bx bx-printer"></i> Receipt
                                </a>
                            </div>
                        `;
                    } else {
                        actionHtml = `
                            <div class="d-flex justify-content-end">
                                <a href="/affiliate/payout/receipt/${payout.id}" class="btn btn-sm btn-primary px-3 text-white d-flex align-items-center gap-1" style="border-radius: 6px; font-size: 11px; font-weight: 600;" target="_blank">
                                    <i class="bx bx-printer"></i> Receipt
                                </a>
                            </div>
                        `;
                    }
                    
                    rowsHtml += `
                        <tr>
                            <td><strong class="text-success">Gh ${parseFloat(payout.amount).toFixed(2)}</strong></td>
                            <td>${payout.payment_method}</td>
                            <td>${payout.date_requested}</td>
                            <td>${statusBadge}</td>
                            <td style="text-align: right;">${actionHtml}</td>
                        </tr>
                    `;
                });
                
                document.getElementById('payouts-list-tbody').innerHTML = rowsHtml;
                document.getElementById('payouts-table-wrapper').style.display = 'block';
            } else {
                document.getElementById('payouts-list-tbody').innerHTML = '<tr><td colspan="5" class="text-center py-4 text-muted">No redrawal requests found for this partner.</td></tr>';
                document.getElementById('payouts-table-wrapper').style.display = 'block';
            }
        })
        .catch(err => {
            console.error('Error fetching payouts:', err);
            document.getElementById('payout-modal-loader').style.display = 'none';
            document.getElementById('payouts-list-tbody').innerHTML = '<tr><td colspan="5" class="text-center py-4 text-danger">Error loading requests. Please try again.</td></tr>';
            document.getElementById('payouts-table-wrapper').style.display = 'block';
        });
}
</script>
@endsection
