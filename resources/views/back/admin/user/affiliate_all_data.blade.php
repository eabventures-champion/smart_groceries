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
          @role('Developer')
          @php
              $onlyEmailsCount = $affiliates->filter(function($user) {
                  return empty($user->phone);
              })->count();

              $bothCount = $affiliates->filter(function($user) {
                  return !empty($user->phone);
              })->count();
          @endphp
          <!-- Premium Filter & Export Bar -->
          <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4 p-3" style="background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0;">
             <div class="d-flex align-items-center gap-2 flex-nowrap">
                <label for="affiliateFilter" style="font-weight: 600; color: #475569; margin: 0; font-size: 14px; white-space: nowrap; display: inline-flex; align-items: center; gap: 4px;">
                   <i class="bx bx-filter-alt" style="font-size: 16px;"></i> Filter By:
                </label>
                <select id="affiliateFilter" class="form-select form-select-sm px-3 py-2" style="border-radius: 8px; border-color: #cbd5e1; font-weight: 500; min-width: 220px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); cursor: pointer;">
                   <option value="all">All Partners ({{ count($affiliates) }})</option>
                   <option value="only_emails">Only Emails (No Contact) ({{ $onlyEmailsCount }})</option>
                   <option value="both">Both Contact & Email ({{ $bothCount }})</option>
                </select>
             </div>
             
             <button id="btnExportCSV" class="btn btn-sm text-white px-4 py-2" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; border-radius: 8px; font-weight: 600; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2); display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s;">
                <i class="bx bx-export" style="font-size: 16px;"></i> Export to CSV
             </button>
          </div>
          @endrole

          <div class="table-responsive">
             <table id="example" class="table table-striped table-bordered" style="width:100%">
               <thead>
                  <tr>
                     <th>S/N</th>
                     <th>Name</th>
                     <th>Referral Code</th>
                     <th>Referrals Count</th>
                     <th>Total Earned</th>
                     <th>Total Redrawal</th>
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
                      $totalRedrawal = 0;
                      $displayedBalance = 0;
                      if ($item->status === 'active') {
                          $activeCount = \App\Models\User::where('referred_by', $item->id)->where('status', 'active')->count();
                          $totalCount = \App\Models\User::where('referred_by', $item->id)->count();
                          
                          // Calculated dynamically: flat bonus only on first delivered order of active referred users
                          $flatAmount = \App\Models\SiteSetting::find(1)->referral_flat_amount ?? 2.00;
                          $referredUserIds = \App\Models\User::where('referred_by', $item->id)->where('status', 'active')->pluck('id');
                          $qualifyingReferralsCount = \App\Models\Order::whereIn('user_id', $referredUserIds)->where('status', 'delivered')->distinct('user_id')->count('user_id');
                          
                          $totalEarned = $qualifyingReferralsCount * $flatAmount;
                          $totalRedrawal = \App\Models\AffiliatePayout::where('user_id', $item->id)->where('status', 'completed')->sum('amount');
                          $displayedBalance = max(0, $totalEarned - $totalRedrawal);
                      }
                  @endphp
                  <tr data-has-email="{{ !empty($item->email) ? 'true' : 'false' }}" data-has-phone="{{ !empty($item->phone) ? 'true' : 'false' }}">
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
                        <div class="d-flex flex-wrap gap-1 mt-1 align-items-center">
                           <span class="badge bg-light text-secondary border affiliate-email-badge" style="font-size: 10px; font-weight: 500; text-transform: none;">
                              {{ $item->email }}
                           </span>
                           @if($item->phone)
                           <span class="badge bg-light-success text-success border border-success affiliate-phone-badge" style="font-size: 10px; font-weight: 600; box-shadow: 0 0 8px rgba(59, 183, 126, 0.4); text-transform: none; display: inline-flex; align-items: center; gap: 4px;">
                              <i class="fa fa-phone" style="font-size: 9px;"></i> {{ $item->phone }}
                           </span>
                           @endif
                        </div>
                     </td>
                     <td> 
                        <code style="font-size: 13px; font-weight: bold; color: #7B2828; display: block; margin-bottom: 4px;">{{ $item->referral_code }}</code> 
                        <span class="badge bg-light-success text-success border border-success" style="font-size: 10px; font-weight: 500; text-transform: none; display: inline-block;" title="{{ $item->created_at->format('d M Y, h:i A') }}">
                           Joined: {{ $item->created_at->diffForHumans() }}
                        </span>
                     </td>
                     <td>
                        <a href="javascript:void(0);" onclick="showReferralDetails({{ $item->id }}, '{{ addslashes($item->name) }}')" class="badge bg-info text-dark hover-shadow" style="font-size: 12px; font-weight: 600; text-decoration: none; cursor: pointer; display: inline-block;">
                           {{ $activeCount }}/{{ $totalCount }} referrals
                        </a>
                        @if($item->referrer)
                        <div class="mt-1">
                           <span class="badge bg-success text-white" style="font-size: 10px; font-weight: 500; text-transform: none; display: inline-block;">
                              Referred by: {{ $item->referrer->name }}
                           </span>
                        </div>
                        @endif
                     </td>
                     <td style="font-weight: 600; color: #2e8b5e;"> Gh {{ number_format($totalEarned, 2) }} </td>
                     <td style="font-weight: 600; color: #17a2b8;"> Gh {{ number_format($totalRedrawal, 2) }} </td>
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
                    
                    const orderedBadge = user.has_ordered
                        ? `<span class="badge bg-info text-dark ms-2" style="font-size: 9px; font-weight: 600;">Ordered Successfully</span>`
                        : '';
                    
                    rowsHtml += `
                        <tr>
                            <td>
                                <strong>${user.name}</strong>
                                ${orderedBadge}
                            </td>
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

@role('Developer')
window.addEventListener('load', function() {
    if (typeof jQuery !== 'undefined' && typeof jQuery.fn.dataTable !== 'undefined') {
        var $ = jQuery;
        
        // Push custom search filter to DataTables global search array
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                // Only apply to our specific table
                if (settings.nTable.id !== 'example') {
                    return true;
                }
                
                var filterValue = $('#affiliateFilter').val();
                if (!filterValue || filterValue === 'all') {
                    return true;
                }
                
                var rowNode = settings.aoData[dataIndex].nTr;
                var hasEmail = $(rowNode).attr('data-has-email') === 'true';
                var hasPhone = $(rowNode).attr('data-has-phone') === 'true';
                
                if (filterValue === 'only_emails') {
                    return hasEmail && !hasPhone;
                } else if (filterValue === 'both') {
                    return hasEmail && hasPhone;
                }
                
                return true;
            }
        );
        
        var table = $('#example').DataTable();
        
        // Trigger table redraw when select value changes
        $('#affiliateFilter').on('change', function() {
            table.draw();
        });
        
        // Handle CSV Export
        $('#btnExportCSV').on('click', function() {
            var csvContent = [];
            var headers = ['S/N', 'Name', 'Email', 'Contact', 'Referral Code', 'Referrals Count', 'Total Earned', 'Total Redrawal', 'Current Balance'];
            csvContent.push(headers.join(','));
            
            table.rows({ search: 'applied' }).every(function(rowIdx, tableLoop, rowLoop) {
                var rowNode = this.node();
                var sn = rowLoop + 1;
                
                var name = $(rowNode).find('td:eq(1) a').text().trim().replace(/,/g, '');
                var emailText = $(rowNode).find('.affiliate-email-badge').text().trim().replace(/,/g, '');
                var phoneText = $(rowNode).find('.affiliate-phone-badge').text().trim().replace(/,/g, '');
                if (!phoneText) {
                    phoneText = 'N/A';
                }
                
                var referralCode = $(rowNode).find('td:eq(2) code').text().trim().replace(/,/g, '');
                var referralsCount = $(rowNode).find('td:eq(3) a').text().trim().replace(/,/g, '').replace(/\s+/g, ' ');
                
                var totalEarned = $(rowNode).find('td:eq(4)').text().trim().replace('Gh ', '').replace(/,/g, '');
                var totalRedrawal = $(rowNode).find('td:eq(5)').text().trim().replace('Gh ', '').replace(/,/g, '');
                var balance = $(rowNode).find('td:eq(6)').text().trim().replace('Gh ', '').replace(/,/g, '');
                
                var rowData = [sn, name, emailText, phoneText, referralCode, referralsCount, totalEarned, totalRedrawal, balance];
                csvContent.push(rowData.map(function(val) {
                    return '"' + String(val).replace(/"/g, '""') + '"';
                }).join(','));
            });
            
            var csvString = csvContent.join('\n');
            var blob = new Blob([csvString], { type: 'text/csv;charset=utf-8;' });
            var url = URL.createObjectURL(blob);
            var link = document.createElement("a");
            link.setAttribute("href", url);
            link.setAttribute("download", "affiliate_partners.csv");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    }
});
@endrole
</script>
@endsection
