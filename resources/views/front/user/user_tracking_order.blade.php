@extends('front.master')
@section('content')
@section('title')
Order Tracking Page 
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style type="text/css">
    body{ }
    .container{ }
    .card{position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;-ms-flex-direction: column;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #fff;background-clip: border-box;border: 1px solid rgba(0, 0, 0, 0.1);border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); overflow: hidden;}.card-header:first-child{border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0}.card-header{padding: 0.75rem 1.25rem;margin-bottom: 0;background-color: #f8f9fa;border-bottom: 1px solid rgba(0, 0, 0, 0.1); font-weight: 700; color: #253D4E;}.track{position: relative;background-color: #ddd;height: 7px;display: -webkit-box;display: -ms-flexbox;display: flex;margin-bottom: 60px;margin-top: 50px}.track .step{-webkit-box-flex: 1;-ms-flex-positive: 1;flex-grow: 1;width: 25%;margin-top: -18px;text-align: center;position: relative}.track .step.active:before{background: #3BB77E}.track .step::before{height: 7px;position: absolute;content: "";width: 100%;left: 0;top: 18px}.track .step.active .icon{background: #3BB77E;color: #fff}.track .icon{display: inline-block;width: 40px;height: 40px;line-height: 40px;position: relative;border-radius: 100%;background: #ddd}.track .step.active .text{font-weight: 400;color: #000}.track .text{display: block;margin-top: 7px; font-weight: 600; color: #7e7e7e; font-size: 13px;}p{margin-top: 0;margin-bottom: 1rem}.btn-warning{color: #ffffff;background-color: #3BB77E;border-color: #3BB77E;border-radius: 8px; padding: 10px 20px; font-weight: 600;}.btn-warning:hover{color: #ffffff;background-color: #27ae60;border-color: #27ae60;}
    .track .step.return-pending:before{background: #f59e0b}
    .track .step.return-pending .icon{background: #f59e0b;color: #fff}
    .track .step.return-pending .text{font-weight: 400;color: #f59e0b}
    .track .step.return-approved:before{background: #3BB77E}
    .track .step.return-approved .icon{background: #3BB77E;color: #fff}
    .track .step.return-approved .text{font-weight: 400;color: #3BB77E}
    .track .step.return-denied:before{background: #ef4444}
    .track .step.return-denied .icon{background: #ef4444;color: #fff}
    .track .step.return-denied .text{font-weight: 400;color: #ef4444}
    .return-info-banner { padding: 12px 18px; border-radius: 8px; margin-top: 15px; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 10px; }
    .return-info-banner i { font-size: 18px; }
    .return-info-banner.pending { background: #fef3c7; color: #92400e; border: 1px solid #fcd34d; }
    .return-info-banner.approved { background: #d1fae5; color: #065f46; border: 1px solid #6ee7b7; }
    .return-info-banner.denied { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }
    
    @media (max-width: 767px) {
        .track {
            margin-bottom: 50px;
            margin-top: 30px;
        }
        .track .text {
            font-size: 10px !important;
            margin-top: 5px;
        }
        .track .icon {
            width: 30px;
            height: 30px;
            line-height: 30px;
            font-size: 11px;
        }
        .track .step::before {
            top: 13px;
        }
        .track .step {
            margin-top: -13px;
        }
    }
</style>
<div class="container mb-30 mt-30">
   <article class="card" style="border-radius: 12px;">
      <header class="card-header"> My Orders / Tracking </header>
      <div class="card-body" style="padding: 20px;">
         <h6 class="mb-15" style="color: #253D4E; font-weight: 700;">Tracking Number : <span style="color: #7B2828;">{{ $track->invoice_no }}</span></h6>
         <article class="card" style="border: 1px solid #ececec; border-radius: 12px; background: #fafafa; margin-bottom: 25px;">
            <div class="card-body row" style="padding: 20px;">
               <div class="col-12 col-md-3 mb-15 mb-md-0"> 
                   <strong style="color: #253D4E; font-size: 14px;">Order Date:</strong> 
                   <div style="color: #7e7e7e; font-size: 13px; margin-top: 5px; font-weight: 600;">{{ $track->order_date }}</div> 
               </div>
               <div class="col-12 col-md-3 mb-15 mb-md-0"> 
                   <strong style="color: #253D4E; font-size: 14px;">Sending To:</strong> 
                   <div style="color: #7e7e7e; font-size: 13px; margin-top: 5px; line-height: 1.5; font-weight: 600;">
                       <span style="color: #253D4E; font-weight: 700;">{{ $track->name }}</span> <br>
                       <i class="fa fa-phone" style="color: #3BB77E; margin-right: 5px;"></i> {{ $track->phone }} <br> 
                       {{ $track->region->region_name }} / {{ $track->district->district_name }} / {{ $track->city->city }}
                   </div>   
               </div>
               <div class="col-12 col-md-3 mb-15 mb-md-0"> 
                   <strong style="color: #253D4E; font-size: 14px;">Total Amount:</strong> 
                   <div style="color: #7B2828; font-size: 15px; margin-top: 5px; font-weight: 700;">Gh {{ number_format($track->amount, 2) }}</div>
               </div>
               <div class="col-12 col-md-3"> 
                   <strong style="color: #253D4E; font-size: 14px;">Status:</strong> 
                   <div style="font-size: 14px; margin-top: 5px; font-weight: 700; text-transform: capitalize;
                       @if($track->return_order == 1) color: #f59e0b;
                       @elseif($track->return_order == 2) color: #3BB77E;
                       @elseif($track->return_order == 3) color: #ef4444;
                       @else color: #3BB77E;
                       @endif">
                       @if($track->status == 'delivering')
                           Out for Delivery
                       @elseif($track->status == 'delivered' && $track->return_order == 1)
                           Delivered — Return Pending
                       @elseif($track->status == 'delivered' && $track->return_order == 2)
                           Delivered — Return Approved
                       @elseif($track->status == 'delivered' && $track->return_order == 3)
                           Delivered — Return Denied
                       @else
                           {{ $track->status }}
                       @endif
                   </div>
               </div>
            </div>
         </article>
         <div class="track">
            @if($track->status == 'pending')           
            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Pending</span> </div>
            <div class="step"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Confirmed</span> </div>
            <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Processing </span> </div>
            <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered </span> </div>
            @elseif($track->status == 'confirmed')
            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Pending</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Confirmed</span> </div>
            <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Processing </span> </div>
            <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered </span> </div>
            @elseif($track->status == 'processing')
            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Pending</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Confirmed</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Processing </span> </div>
            <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered </span> </div>
            @elseif($track->status == 'delivering')
            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Pending</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Confirmed</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Processing </span> </div>
            <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered </span> </div>
            @elseif($track->status == 'delivered')
            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Pending</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Confirmed</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Processing </span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered </span> </div>
            @if($track->return_order >= 1)
            <div class="step {{ $track->return_order == 1 ? 'return-pending' : ($track->return_order == 2 ? 'return-approved' : 'return-denied') }}"> 
                <span class="icon"> <i class="fa fa-rotate-left"></i> </span> 
                <span class="text">
                    @if($track->return_order == 1)
                        Return Pending
                    @elseif($track->return_order == 2)
                        Return Approved
                    @else
                        Return Denied
                    @endif
                </span> 
            </div>
            @endif
            @endif
         </div>

         {{-- Return Info Banner --}}
         @if($track->status == 'delivered' && $track->return_order >= 1)
         <div class="return-info-banner {{ $track->return_order == 1 ? 'pending' : ($track->return_order == 2 ? 'approved' : 'denied') }}">
             @if($track->return_order == 1)
                 <i class="fa fa-clock"></i>
                 <span>Your return request is being reviewed by the admin. You'll be notified once a decision is made.</span>
             @elseif($track->return_order == 2)
                 <i class="fa fa-check-circle"></i>
                 <span>Your return request has been approved. Please follow the return instructions provided.</span>
             @else
                 <i class="fa fa-times-circle"></i>
                 <span>Your return request was not approved. If you believe this is an error, please contact support.</span>
             @endif
         </div>
         @endif

         <hr>
         <a href="javascript:history.back()" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back</a>
         {{-- <a href="{{ route('user.track.order') }}" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to orders</a> --}}
      </div>
   </article>
</div>
@endsection