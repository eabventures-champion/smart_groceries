@extends('back.admin.master')
@section('content')
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Affiliate Partners </div>
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
                     <th>Image</th>
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
                      $referralsCount = \App\Models\User::where('referred_by', $item->id)->count();
                      $totalEarned = \App\Models\AffiliateReferral::where('referrer_id', $item->id)->sum('commission_earned');
                  @endphp
                  <tr>
                     <td> {{ $key+1 }} </td>
                     <td> <img src="{{ (!empty($item->photo)) ? url('front/assets/imgs/users/'.$item->photo):url('front/assets/imgs/users/no_image.jpg') }}" alt="User" class="rounded-circle p-1 bg-primary" width="55" height="55"></td>
                     <td> 
                        <a href="{{ route('admin.client.detail', $item->id) }}" style="font-weight: 600; color: #212529; text-decoration: none;" class="hover-primary">
                           {{ $item->name }} 
                        </a> 
                     </td>
                     <td> {{ $item->email }} </td>
                     <td> <code style="font-size: 13px; font-weight: bold; color: #7B2828;">{{ $item->referral_code }}</code> </td>
                     <td> <span class="badge bg-info text-dark" style="font-size: 12px; font-weight: 600;">{{ $referralsCount }} referrals</span> </td>
                     <td style="font-weight: 600; color: #2e8b5e;"> Gh {{ number_format($totalEarned, 2) }} </td>
                     <td style="font-weight: 600; color: #7B2828;"> Gh {{ number_format($item->referral_balance, 2) }} </td>
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
@endsection
