@extends('front.master')
@section('content')
@section('title')
Page Expired
@endsection

<div class="page-content pt-150 pb-150">
   <div class="container">
      <div class="row">
         <div class="col-xl-8 col-lg-10 col-md-12 m-auto text-center">
            <h1 class="display-2 mb-30" style="font-size: 4rem; color: #253D4E;">Page Expired</h1>
            <p class="font-lg text-grey-700 mb-30">
               Your session has expired or the security token for this form is invalid.<br />
               This is a security measure designed to protect your account.
            </p>
            
            <div class="card m-auto p-4 mb-40 text-start" style="max-width: 550px; background-color: #f7f8f9; border: 1px solid #e2e8f0; border-radius: 15px;">
               <h5 class="mb-15 text-center" style="color: #3BB77E; font-weight: 700;">How to resolve this on your device:</h5>
               <ol class="list-unstyled ps-0" style="color: #7E7E7E; line-height: 1.8; margin-bottom: 0;">
                  <li class="mb-10">
                     <strong>🔄 1. Refresh & Try Again:</strong> 
                     Most of the time, simply reloading the page will retrieve a new secure token and fix the issue immediately.
                  </li>
                  <li class="mb-10">
                     <strong>🔑 2. Re-enter Form Details:</strong> 
                     If you were filling out a form, you might need to re-enter your information after refreshing the page.
                  </li>
                  <li>
                     <strong>🍪 3. Clear Browser Cookies & Cache:</strong> 
                     If you continue to see this page, your browser might be holding onto an expired session cookie. Clearing your cookies/cache for this site will fix it.
                  </li>
               </ol>
            </div>

            <div class="d-flex justify-content-center align-items-center gap-3 flex-wrap">
               <button onclick="window.location.reload();" class="btn btn-default hover-up font-xs" style="background-color: #3BB77E; border-color: #3BB77E;">
                  Reload Page
               </button>
               <a class="btn btn-default btn-outline hover-up font-xs" href="{{ url('/') }}" style="color: #253D4E; background: transparent; border: 1px solid #e2e8f0;">
                  Go to Homepage
               </a>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
