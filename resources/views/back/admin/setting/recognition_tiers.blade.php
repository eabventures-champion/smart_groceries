@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Site Settings</div>
      <div class="ps-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
               <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
               <li class="breadcrumb-item active" aria-current="page">Recognition Tiers</li>
            </ol>
         </nav>
      </div>
   </div>
   <!--end breadcrumb-->

   <hr/>

   <div class="row">
      <!-- Left Column: Tiers List Table -->
      <div class="col-lg-8">
         <div class="card radius-10">
            <div class="card-header bg-transparent border-0 pt-3 pb-0">
               <h5 class="mb-0 font-weight-bold"><i class="bx bx-award me-1 text-primary"></i> Current Recognition Tiers</h5>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table align-middle mb-0">
                     <thead class="table-light">
                        <tr>
                           <th>S/N</th>
                           <th>Tier Label</th>
                           <th>Min Spent</th>
                           <th>Discount</th>
                           <th>Badge Color</th>
                           <th>Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse($tiers as $key => $tier)
                        <tr>
                           <td>{{ $key + 1 }}</td>
                           <td>
                              <strong>{{ $tier->name }}</strong>
                           </td>
                           <td style="font-weight: 600; color: #2e8b5e;">GH¢ {{ number_format($tier->min_spent, 2) }}</td>
                           <td><span class="badge bg-light-success text-success">{{ $tier->discount_percent }}% Off</span></td>
                           <td>
                              @if($tier->badge_style === 'warning')
                                 <span class="badge bg-warning text-dark"><i class="bx bxs-crown me-1"></i>{{ $tier->name }}</span>
                              @elseif($tier->badge_style === 'secondary')
                                 <span class="badge bg-secondary text-white"><i class="bx bxs-medal me-1"></i>{{ $tier->name }}</span>
                              @elseif($tier->badge_style === 'light')
                                 <span class="badge bg-light text-dark border"><i class="bx bx-award me-1"></i>{{ $tier->name }}</span>
                              @elseif($tier->badge_style === 'success')
                                 <span class="badge bg-success text-white"><i class="bx bx-check-shield me-1"></i>{{ $tier->name }}</span>
                              @elseif($tier->badge_style === 'danger')
                                 <span class="badge bg-danger text-white"><i class="bx bx-star me-1"></i>{{ $tier->name }}</span>
                              @else
                                 <span class="badge bg-primary text-white"><i class="bx bx-medal me-1"></i>{{ $tier->name }}</span>
                              @endif
                           </td>
                           <td>
                              <button type="button" class="btn btn-sm btn-info text-white me-1 editBtn" data-id="{{ $tier->id }}">
                                 <i class="bx bx-edit-alt"></i> Edit
                              </button>
                              <a href="{{ route('admin.delete.recognition.tier', $tier->id) }}" class="btn btn-sm btn-danger" id="delete">
                                 <i class="bx bx-trash"></i> Delete
                              </a>
                           </td>
                        </tr>
                        @empty
                        <tr>
                           <td colspan="6" class="text-center text-muted">No recognition tiers defined yet.</td>
                        </tr>
                        @endforelse
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>

      <!-- Right Column: Add/Edit Form Card -->
      <div class="col-lg-4">
         <!-- Add Tier Card -->
         <div class="card radius-10" id="formCard">
            <div class="card-header bg-transparent border-0 pt-3 pb-0">
               <h5 class="mb-0 font-weight-bold" id="formTitle"><i class="bx bx-plus-circle me-1 text-success"></i> Add Recognition Tier</h5>
            </div>
            <div class="card-body">
               <form id="tierForm" action="{{ route('admin.store.recognition.tier') }}" method="POST">
                  @csrf
                  <input type="hidden" name="id" id="tier_id">

                  <div class="mb-3">
                     <label class="form-label font-weight-semibold">Tier Label / Name</label>
                     <input type="text" name="name" id="name" class="form-control" placeholder="e.g. VIP Platinum" required>
                  </div>

                  <div class="mb-3">
                     <label class="form-label font-weight-semibold">Minimum Spent (GH¢)</label>
                     <input type="number" step="0.01" name="min_spent" id="min_spent" class="form-control" placeholder="e.g. 500.00" required>
                  </div>

                  <div class="mb-3">
                     <label class="form-label font-weight-semibold">Discount Percent (%)</label>
                     <input type="number" step="0.01" name="discount_percent" id="discount_percent" class="form-control" placeholder="e.g. 20.00" required>
                  </div>

                  <div class="mb-3">
                     <label class="form-label font-weight-semibold">Badge Styling Theme</label>
                     <select name="badge_style" id="badge_style" class="form-select" required>
                        <option value="warning">Crown / Yellow (warning)</option>
                        <option value="secondary">Medal / Gray (secondary)</option>
                        <option value="light">Award / Light-Border (light)</option>
                        <option value="primary">Shield / Blue (primary)</option>
                        <option value="success">Success / Green (success)</option>
                        <option value="danger">Star / Red (danger)</option>
                     </select>
                  </div>

                  <div class="row pt-2">
                     <div class="col-6">
                        <button type="submit" class="btn btn-primary w-100" id="submitBtn">Save Tier</button>
                     </div>
                     <div class="col-6">
                        <button type="button" class="btn btn-secondary w-100" id="cancelBtn" style="display: none;">Cancel</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
      // Handle Edit Button Click
      $('.editBtn').click(function(){
         var tierId = $(this).data('id');
         
         // Fetch data via AJAX
         $.ajax({
            url: "/admin/recognition-tier/edit/" + tierId,
            type: "GET",
            dataType: "json",
            success: function(data) {
               // Fill form values
               $('#tier_id').val(data.id);
               $('#name').val(data.name);
               $('#min_spent').val(data.min_spent);
               $('#discount_percent').val(data.discount_percent);
               $('#badge_style').val(data.badge_style);

               // Update Form Titles and Actions
               $('#formTitle').html('<i class="bx bx-edit-alt me-1 text-info"></i> Edit Recognition Tier');
               $('#tierForm').attr('action', "{{ route('admin.update.recognition.tier') }}");
               $('#submitBtn').text('Update Tier').removeClass('btn-primary').addClass('btn-info text-white');
               $('#cancelBtn').show();
            }
         });
      });

      // Handle Cancel Button Click
      $('#cancelBtn').click(function(){
         // Reset values
         $('#tier_id').val('');
         $('#name').val('');
         $('#min_spent').val('');
         $('#discount_percent').val('');
         $('#badge_style').val('primary');

         // Reset titles & action
         $('#formTitle').html('<i class="bx bx-plus-circle me-1 text-success"></i> Add Recognition Tier');
         $('#tierForm').attr('action', "{{ route('admin.store.recognition.tier') }}");
         $('#submitBtn').text('Save Tier').removeClass('btn-info text-white').addClass('btn-primary');
         $(this).hide();
      });
   });
</script>
@endsection
