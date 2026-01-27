@extends('front.master')
{{-- @extends('dashboard')  --}}
@section('content')
@section('title')
 Track your Order
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{-- <div class="page-header breadcrumb-wrap">
   <div class="container">
      <div class="breadcrumb">
         <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
      </div>
   </div>
</div> --}}
<div class="page-content pt-50 pb-50 account-mobile-padding">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 m-auto">
            <div class="row">
               <!-- // Start Col md 3 menu -->
               @include('front.user.dashboard_sidebar_menu')
               <!-- // End Col md 3 menu -->
               <div class="col-md-9">
                  <div class="tab-content account dashboard-content pl-50 mobile-pl-50">
                     <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                        <div class="card">
                           <div class="card-header text-center-dashboard">
                              <h3>Track Your Order<span><i class="fi fi-rs-map-location-track pl-15"></i></span></h3>
                           </div>
                           <div class="card-body">
                              <form method="post" action="{{ route('order.tracking') }}" >
                                 @csrf
                                 <div class="row">
                                    <div class="form-group col-md-12">
                                       {{-- <label>Invoice Code <span class="required">*</span></label> --}}
                                       <input  class="form-control" name="code" type="text" placeholder="Your Order Invoice Number" required="" />
                                    </div>
                                    <div class="col-md-12">
                                       <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Track Order</button>
                                    </div>
                                 </div>
                              </form>
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
