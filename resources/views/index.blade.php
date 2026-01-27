@extends('front.master')
{{-- @extends('dashboard') --}}
@section('content')
@section('title')
 Dashboard
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
                @include('front.user.dashboard_sidebar_menu')
                <div class="col-md-9">
                  <div class="tab-content account dashboard-content pl-50 mobile-pl-50">
                     <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                        <div class="card">
                           <div class="card-header text-center-dashboard">
                              <h3 class="mb-0">Hello {{ Auth::user()->name }}!</h3>
                              <br>
                              <img id="showImage" class="rounded-circle p-1 bg-primary" src="{{ (!empty($user->photo)) ? url('front/assets/imgs/users/'.$user->photo) : url('front/assets/imgs/users/no_image.jpg') }}" alt="Admin" width="110">
                           </div>
                           <div class="card-body">
                              <p>
                                 From your account dashboard. you can easily check &amp; view your <a href="{{ route('user.order.page') }}">recent orders</a>,<br />
                                 manage your <a href="{{ route('user.account.page') }}">account details</a> and <a href="{{ route('user.change.password') }}">edit your password</a>
                              </p>
                           </div>
                        </div>
                     </div>
                     {{-- no --}}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection
