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
    
    @media (max-width: 767px) {
        .track {
            margin-bottom: 50px;
            margin-top: 30px;
        }
        .track .text {
            font-size: 11px !important;
            margin-top: 5px;
        }
        .track .icon {
            width: 32px;
            height: 32px;
            line-height: 32px;
            font-size: 12px;
        }
        .track .step::before {
            top: 14px;
        }
        .track .step {
            margin-top: -14px;
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
               <div class="col-12 col-md-4 mb-15 mb-md-0"> 
                   <strong style="color: #253D4E; font-size: 14px;">Order Date:</strong> 
                   <div style="color: #7e7e7e; font-size: 13px; margin-top: 5px; font-weight: 600;">{{ $track->order_date }}</div> 
               </div>
               <div class="col-12 col-md-4 mb-15 mb-md-0"> 
                   <strong style="color: #253D4E; font-size: 14px;">Sending To:</strong> 
                   <div style="color: #7e7e7e; font-size: 13px; margin-top: 5px; line-height: 1.5; font-weight: 600;">
                       <span style="color: #253D4E; font-weight: 700;">{{ $track->name }}</span> <br>
                       <i class="fa fa-phone" style="color: #3BB77E; margin-right: 5px;"></i> {{ $track->phone }} <br> 
                       {{ $track->region->region_name }} / {{ $track->district->district_name }} / {{ $track->city->city }}
                   </div>   
               </div>
               <div class="col-12 col-md-4"> 
                   <strong style="color: #253D4E; font-size: 14px;">Total Amount:</strong> 
                   <div style="color: #7B2828; font-size: 15px; margin-top: 5px; font-weight: 700;">Gh {{ number_format($track->amount, 2) }}</div>
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
            @elseif($track->status == 'delivered')
            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Pending</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Confirmed</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Processing </span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered </span> </div>
            @endif
         </div>
         <hr>
         <a href="javascript:history.back()" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back</a>
         {{-- <a href="{{ route('user.track.order') }}" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to orders</a> --}}
      </div>
   </article>
</div>
@endsection