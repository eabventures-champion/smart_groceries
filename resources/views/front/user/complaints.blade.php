@extends('front.master')
@section('title')
 Complaints & Suggestions
@endsection
@section('content')

<style>
@media (max-width: 575.98px) {
   .account-card-header {
      padding: 20px 15px !important;
   }
   .account-card-title {
      font-size: 17px !important;
      white-space: nowrap !important;
   }
   .account-header-icon {
      width: 40px !important;
      height: 40px !important;
      margin-right: 12px !important;
      font-size: 16px !important;
   }
}
</style>

<div class="page-content pt-50 pb-50 account-mobile-padding" style="font-family: 'Inter', sans-serif; background: #f8fafb;">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 m-auto">
            <div class="row">
               @include('front.user.dashboard_sidebar_menu')
               <div class="col-md-9">
                  
                  <!-- Form Card -->
                  <div class="premium-account-card mb-4" style="background: #ffffff; border-radius: 20px; border: 1px solid #f1f2f4; box-shadow: 0 10px 40px rgba(0,0,0,0.03); overflow: hidden;">
                     <!-- Card Header -->
                     <div class="account-card-header" style="display: flex; align-items: center; padding: 28px 32px; border-bottom: 1px solid #f1f2f4; background: linear-gradient(135deg, #fafffe 0%, #f8fbfa 100%);">
                        <div class="account-header-icon" style="width: 48px; height: 48px; border-radius: 14px; background: rgba(59, 183, 126, 0.1); display: flex; align-items: center; justify-content: center; color: #3bb77e; font-size: 20px; margin-right: 18px; flex-shrink: 0;">
                           <i class="fi fi-rs-document-signed"></i>
                        </div>
                        <div>
                           <h3 class="account-card-title" style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 22px; color: #253D4E; margin: 0 0 3px;">Complaints & Suggestions</h3>
                           <p class="account-card-subtitle" style="font-size: 13px; color: #9ca3af; margin: 0; font-weight: 400;">Send us your complaints or suggestions. We appreciate your feedback.</p>
                        </div>
                     </div>

                     <!-- Form Body -->
                     <form method="post" action="{{ route('user.complaint.store') }}">
                        @csrf
                        <div class="account-form-body" style="padding: 28px 32px 32px;">
                           <h6 class="account-section-label" style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 14px; color: #253D4E; margin: 0 0 18px; padding-bottom: 10px; border-bottom: 1px solid #f1f2f4; text-transform: uppercase; letter-spacing: 0.5px;">New Submission</h6>
                           @if (session('message'))
                              <div class="alert alert-{{ session('alert-type') == 'success' ? 'success' : 'info' }} mb-4" style="border-radius: 10px;">
                                 {{ session('message') }}
                              </div>
                           @endif

                           @if ($errors->any())
                              <div class="alert alert-danger mb-4" style="border-radius: 10px;">
                                 <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                       <li>{{ $error }}</li>
                                    @endforeach
                                 </ul>
                              </div>
                           @endif

                           <div class="row">
                              <div class="form-group col-md-6 mb-3">
                                 <label class="account-label" style="font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px; display: block;">Submission Type <span class="account-required" style="color: #ef4444;">*</span></label>
                                 <div class="account-input-wrap" style="position: relative;">
                                    <select required class="form-control" name="type" style="height: 50px; border-radius: 10px; border: 1px solid #ececec; font-size: 14px; padding-left: 15px; color: #4f5d77;">
                                       <option value="" disabled selected>-- Select Type --</option>
                                       <option value="complaint">Complaint</option>
                                       <option value="suggestion">Suggestion</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group col-md-6 mb-3">
                                 <label class="account-label" style="font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px; display: block;">Subject <span class="account-required" style="color: #ef4444;">*</span></label>
                                 <div class="account-input-wrap" style="position: relative;">
                                    <input required class="form-control" name="subject" type="text" placeholder="Enter subject" style="height: 50px; border-radius: 10px; border: 1px solid #ececec; font-size: 14px; padding-left: 15px;" />
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="form-group col-md-12 mb-4">
                                 <label class="account-label" style="font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px; display: block;">Message / Comment <span class="account-required" style="color: #ef4444;">*</span></label>
                                 <div class="account-input-wrap" style="position: relative;">
                                    <textarea required class="form-control" name="comment" rows="5" placeholder="Enter details..." style="border-radius: 10px; border: 1px solid #ececec; font-size: 14px; padding: 15px;"></textarea>
                                 </div>
                              </div>
                           </div>

                           <!-- Submit Button -->
                           <div class="account-actions">
                              <button type="submit" class="account-save-btn" style="background: #3bb77e; color: #ffffff; border: none; padding: 12px 30px; border-radius: 10px; font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 15px; cursor: pointer; transition: background 0.2s ease;">
                                 <i class="fi fi-rs-paper-plane" style="margin-right: 6px;"></i> Submit Feedback
                              </button>
                           </div>
                        </div>
                     </form>
                  </div>

                  <!-- History Card -->
                  <div class="orders-card" style="background: #fff; border-radius: 20px; border: 1px solid #f1f2f4; box-shadow: 0 4px 24px rgba(0,0,0,0.04), 0 1px 4px rgba(0,0,0,0.02); overflow: hidden;">
                     <div class="orders-card-header" style="display: flex; align-items: center; gap: 16px; padding: 28px 32px 24px; border-bottom: 1px solid #f1f2f4;">
                        <div class="orders-icon-badge" style="width: 52px; height: 52px; border-radius: 14px; background: linear-gradient(135deg, #3bb77e 0%, #29a56c 100%); display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 12px rgba(59,183,126,0.25);">
                           <i class="fi fi-rs-time-past" style="color: #fff; font-size: 20px;"></i>
                        </div>
                        <div class="orders-header-text">
                           <h3 style="margin: 0 0 2px; font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 22px; color: #253D4E; line-height: 1.2;">Submission History</h3>
                           <p style="margin: 0; font-family: 'Inter', sans-serif; font-size: 13px; color: #7e8a9a; font-weight: 500;">History of your complaints and suggestions</p>
                        </div>
                     </div>

                     <div class="orders-table-wrap" style="padding: 8px 0 0; overflow-x: auto;">
                        <table class="orders-table" style="width: 100%; border-collapse: collapse; font-family: 'Inter', sans-serif;">
                           <thead>
                              <tr style="background: #f8f9fa;">
                                 <th style="font-family: 'Outfit', sans-serif; font-weight: 600; font-size: 12px; color: #7e8a9a; text-transform: uppercase; letter-spacing: 0.6px; padding: 14px 20px; text-align: left; padding-left: 32px;">S/N</th>
                                 <th style="font-family: 'Outfit', sans-serif; font-weight: 600; font-size: 12px; color: #7e8a9a; text-transform: uppercase; letter-spacing: 0.6px; padding: 14px 20px; text-align: left;">Type</th>
                                 <th style="font-family: 'Outfit', sans-serif; font-weight: 600; font-size: 12px; color: #7e8a9a; text-transform: uppercase; letter-spacing: 0.6px; padding: 14px 20px; text-align: left;">Subject</th>
                                 <th style="font-family: 'Outfit', sans-serif; font-weight: 600; font-size: 12px; color: #7e8a9a; text-transform: uppercase; letter-spacing: 0.6px; padding: 14px 20px; text-align: left;">Date</th>
                                 <th style="font-family: 'Outfit', sans-serif; font-weight: 600; font-size: 12px; color: #7e8a9a; text-transform: uppercase; letter-spacing: 0.6px; padding: 14px 20px; text-align: left;">Status</th>
                                 <th style="font-family: 'Outfit', sans-serif; font-weight: 600; font-size: 12px; color: #7e8a9a; text-transform: uppercase; letter-spacing: 0.6px; padding: 14px 20px; text-align: left; padding-right: 32px;">Details & Response</th>
                              </tr>
                           </thead>
                           <tbody>
                              @forelse($complaints as $key => $item)
                              <tr style="border-bottom: 1px solid #f1f2f4;">
                                 <td style="padding: 16px 20px; padding-left: 32px; font-weight: 600;">{{ $key+1 }}</td>
                                 <td style="padding: 16px 20px;">
                                    @if($item->type == 'complaint')
                                       <span class="badge bg-danger" style="padding: 6px 12px; border-radius: 20px; color: #fff;">Complaint</span>
                                    @else
                                       <span class="badge bg-info" style="padding: 6px 12px; border-radius: 20px; color: #fff; background-color: #0dcaf0 !important;">Suggestion</span>
                                    @endif
                                 </td>
                                 <td style="padding: 16px 20px; font-weight: 600;">{{ $item->subject }}</td>
                                 <td style="padding: 16px 20px; color: #7e8a9a; font-size: 13px;">{{ $item->created_at->format('d M Y, h:i A') }}</td>
                                 <td style="padding: 16px 20px;">
                                    @if($item->status == 'pending')
                                       <span class="badge bg-warning text-dark" style="padding: 6px 12px; border-radius: 20px;">Pending</span>
                                    @elseif($item->status == 'reviewed')
                                       <span class="badge bg-secondary" style="padding: 6px 12px; border-radius: 20px; color: #fff;">Reviewed</span>
                                    @elseif($item->status == 'resolved')
                                       <span class="badge bg-success" style="padding: 6px 12px; border-radius: 20px; color: #fff; background-color: #198754 !important;">Resolved</span>
                                    @endif
                                 </td>
                                 <td style="padding: 16px 20px; padding-right: 32px; white-space: normal; max-width: 250px;">
                                    <div style="font-size: 13px; color: #4f5d77; margin-bottom: 5px;">
                                       <strong>My Comment:</strong> {{ $item->comment }}
                                    </div>
                                    @if($item->admin_reply)
                                       <div style="font-size: 13px; background: #f8fafc; border-left: 3px solid #3bb77e; padding: 8px 12px; border-radius: 4px; margin-top: 5px; color: #253D4E;">
                                          <strong>Admin Reply:</strong> {{ $item->admin_reply }}
                                       </div>
                                    @endif
                                 </td>
                              </tr>
                              @empty
                              <tr>
                                 <td colspan="6" style="padding: 30px; text-align: center; color: #9ca3af;">
                                    You have not submitted any complaints or suggestions yet.
                                 </td>
                              </tr>
                              @endforelse
                           </tbody>
                        </table>
                     </div>
                  </div>

               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection
