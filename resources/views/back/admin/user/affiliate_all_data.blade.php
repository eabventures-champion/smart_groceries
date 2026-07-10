@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Affiliate Partners <span class="badge bg-success ms-2" style="font-size: 13px;">{{ count($affiliates) }}</span></div>
      <div class="ps-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
               <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">Affiliate Program Members</li>
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
                     <th>Name</th>
                     <th>Email</th>
                     <th>Referral Code</th>
                     <th>Referrals Count</th>
                     <th>Total Earned</th>
                     <th>Current Balance</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($affiliates as $key => $item)		
                  @php
                      $activeCount = 0;
                      $totalCount = 0;
                      $totalEarned = 0;
                      $displayedBalance = 0;
                      if ($item->status === 'active') {
                          $activeCount = \App\Models\User::where('referred_by', $item->id)->where('status', 'active')->count();
                          $totalCount = \App\Models\User::where('referred_by', $item->id)->count();
                          $totalEarned = \App\Models\AffiliateReferral::where('referrer_id', $item->id)
                              ->whereHas('referred', function($q) {
                                  $q->where('status', 'active');
                              })->sum('commission_earned');
                          $displayedBalance = $totalEarned; // For now equal to total earned (no withdrawals made yet)
                      }
                  @endphp
                  <tr>
                     <td> {{ $key+1 }} </td>
                     <td> 
                        <div class="d-flex align-items-center gap-2">
                           <a href="{{ route('admin.client.detail', $item->id) }}" style="font-weight: 600; color: #212529; text-decoration: none;" class="hover-primary">
                              {{ $item->name }} 
                           </a> 
                           @if($item->status === 'active')
                               <span class="badge bg-light-success text-success" style="font-size: 10px; font-weight: 600;">Active</span>
                           @else
                               <span class="badge bg-light-danger text-danger" style="font-size: 10px; font-weight: 600;">Inactive</span>
                           @endif
                        </div>
                        @if($item->referrer)
                        <div class="mt-1">
                           <span class="badge bg-success text-white" style="font-size: 10px; font-weight: 500; text-transform: none;">
                              Referred by: {{ $item->referrer->name }}
                           </span>
                        </div>
                        @endif
                     </td>
                     <td> {{ $item->email }} </td>
                     <td> <code style="font-size: 13px; font-weight: bold; color: #7B2828;">{{ $item->referral_code }}</code> </td>
                     <td>
                        <a href="javascript:void(0);" onclick="showReferralDetails({{ $item->id }}, '{{ addslashes($item->name) }}')" class="badge bg-info text-dark hover-shadow" style="font-size: 12px; font-weight: 600; text-decoration: none; cursor: pointer; display: inline-block;">
                           {{ $activeCount }}/{{ $totalCount }} referrals
                        </a>
                     </td>
                     <td style="font-weight: 600; color: #2e8b5e;"> Gh {{ number_format($totalEarned, 2) }} </td>
                     <td style="font-weight: 600; color: #7B2828;"> Gh {{ number_format($displayedBalance, 2) }} </td>
                     <td>
                        <a href="{{ route('admin.client.detail', $item->id) }}" class="btn btn-sm text-white" style="background-color: #3bb77e; border-color: #3bb77e; border-radius: 6px;">
                           <i class="fa fa-eye"></i> View Profile
                        </a>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>

<!-- Referral Details Modal -->
<div class="modal fade" id="referralDetailsModal" tabindex="-1" aria-labelledby="referralDetailsModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
         <div class="modal-header text-white" style="background: linear-gradient(135deg, #3bb77e 0%, #2fa56f 100%); border-radius: 16px 16px 0 0; padding: 18px 24px;">
            <h5 class="modal-title text-white fw-bold" id="referralDetailsModalLabel">
               <i class="bx bx-group me-2" style="font-size: 20px;"></i>Referred Users
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body p-4" style="max-height: 450px; overflow-y: auto;">
            <div id="referrals-modal-loader" class="text-center py-4">
               <div class="spinner-border text-success" role="status">
                  <span class="visually-hidden">Loading...</span>
               </div>
               <p class="text-muted mt-2">Loading referred user list...</p>
            </div>
            
            <div id="referrals-table-wrapper" style="display: none;">
               <div class="table-responsive">
                  <table class="table table-hover align-middle">
                     <thead class="table-light">
                        <tr>
                           <th>Name</th>
                           <th>Email</th>
                           <th>Phone</th>
                           <th>Joined</th>
                           <th>Status</th>
                        </tr>
                     </thead>
                     <tbody id="referrals-list-tbody">
                        <!-- Dynamic referred users here -->
                     </tbody>
                  </table>
               </div>
            </div>

            <div id="referrals-empty-state" class="text-center py-4" style="display: none;">
               <i class="bx bx-info-circle text-muted" style="font-size: 48px;"></i>
               <p class="text-muted mt-2 mb-0">No active referred users found for this affiliate partner.</p>
            </div>
         </div>
         <div class="modal-footer border-0" style="padding: 16px 24px;">
            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal" style="border-radius: 8px;">Close</button>
         </div>
      </div>
   </div>
</div>

<script>
function showReferralDetails(referrerId, referrerName) {
    // Set referrer name in modal title
    document.getElementById('referralDetailsModalLabel').innerHTML = `<i class="bx bx-group me-2" style="font-size: 20px;"></i>Referred by ${referrerName}`;
    
    // Reset modal display states
    document.getElementById('referrals-modal-loader').style.display = 'block';
    document.getElementById('referrals-table-wrapper').style.display = 'none';
    document.getElementById('referrals-empty-state').style.display = 'none';
    document.getElementById('referrals-list-tbody').innerHTML = '';
    
    // Show modal
    const referralModal = new bootstrap.Modal(document.getElementById('referralDetailsModal'));
    referralModal.show();
    
    // Fetch referred users via AJAX
    fetch(`/admin/affiliate/referrals/${referrerId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('referrals-modal-loader').style.display = 'none';
            
            if (data && data.length > 0) {
                let rowsHtml = '';
                data.forEach(user => {
                    const statusBadge = user.status === 'active' 
                        ? `<span class="badge bg-success">Active</span>` 
                        : `<span class="badge bg-danger">Inactive</span>`;
                        
                    const phoneText = user.phone ? user.phone : '<span class="text-muted">N/A</span>';
                    
                    rowsHtml += `
                        <tr>
                            <td><strong>${user.name}</strong></td>
                            <td>${user.email}</td>
                            <td>${phoneText}</td>
                            <td>${user.date_joined}</td>
                            <td>${statusBadge}</td>
                        </tr>
                    `;
                });
                
                document.getElementById('referrals-list-tbody').innerHTML = rowsHtml;
                document.getElementById('referrals-table-wrapper').style.display = 'block';
            } else {
                document.getElementById('referrals-empty-state').style.display = 'block';
            }
        })
        .catch(err => {
            console.error('Error fetching referrals:', err);
            document.getElementById('referrals-modal-loader').style.display = 'none';
            document.getElementById('referrals-empty-state').style.display = 'block';
        });
}
</script>
@endsection
