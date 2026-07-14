@extends('front.master')
@section('content')
@section('title')
500 Server Error
@endsection

<div class="page-content pt-150 pb-150">
   <div class="container">
      <div class="row">
         <div class="col-xl-8 col-lg-10 col-md-12 m-auto text-center">
            <p class="mb-20">
               <svg viewBox="0 0 24 24" width="80" height="80" stroke="#ffb300" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 20px; animation: pulse 2s infinite;">
                  <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                  <line x1="12" y1="9" x2="12" y2="13"></line>
                  <line x1="12" y1="17" x2="12.01" y2="17"></line>
               </svg>
            </p>
            <h1 class="display-2 mb-30" style="font-family: 'Outfit', sans-serif; font-weight: 800; color: #253D4E;">Temporary Server Error</h1>
            <p class="font-lg text-grey-700 mb-30" style="font-size: 16px; line-height: 1.6;">
               We are currently experiencing a brief technical issue. Our team has been notified and is working to resolve it.<br />
               Please try refreshing the page, or return to the home page using the button below.
            </p>
            <a class="btn btn-default submit-auto-width font-xs hover-up mt-30" style="background-color: #3BB77E; border-color: #3BB77E; border-radius: 30px; padding: 12px 30px; font-weight: 700;" href="{{ url('/') }}"><i class="fi-rs-home mr-5"></i> Back To Home Page</a>
         </div>
      </div>
   </div>
</div>

<style>
@keyframes pulse {
   0% { transform: scale(1); opacity: 0.9; }
   50% { transform: scale(1.08); opacity: 1; }
   100% { transform: scale(1); opacity: 0.9; }
}
</style>
@endsection
