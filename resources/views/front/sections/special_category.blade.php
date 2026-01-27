@php
$hot_deals = App\Models\Product::where(['hot_deals' => 1, 'status' => 1])->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();
$special_offer = App\Models\Product::where(['special_offer' => 1, 'status' => 1])->orderBy('id','DESC')->limit(3)->get();
$new = App\Models\Product::where('status',1)->orderBy('id','DESC')->limit(3)->get();
$special_deals = App\Models\Product::where(['special_deals' => 1, 'status' => 1])->orderBy('id','DESC')->limit(3)->get();
@endphp
<section class="section-padding mb-30">
   <div class="container">
      <div class="row">
         <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp" data-wow-delay="0">
            <div class="product-list-small animated animated">
               <h4 class="section-title style-1 mb-30 animated animated"> Hot Deals </h4>
               @foreach($hot_deals as $item)                   
               <article class="row align-items-center hover-up">
                  <figure class="col-md-4 mb-0">
                     <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"><img src="{{ asset( $item->product_thumbnail ) }}" alt="" /></a>
                  </figure>
                  <div class="col-md-8 mb-0">
                     <h6>
                        <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"> {{ $item->product_name }} </a>
                     </h6>
                     {{-- @php
                     $reviewcount = App\Models\Review::where('product_id',$item->id)->where('status',1)->latest()->get();
                     $average = App\Models\Review::where('product_id',$item->id)->where('status',1)->avg('rating');
                     @endphp 
                     <div class="product-rate-cover">
                        <div class="product-rate d-inline-block">
                           @if($average == 0)
                           @elseif($average == 1 || $average < 2)                     
                           <div class="product-rating" style="width: 20%"></div>
                           @elseif($average == 2 || $average < 3)                     
                           <div class="product-rating" style="width: 40%"></div>
                           @elseif($average == 3 || $average < 4)                     
                           <div class="product-rating" style="width: 60%"></div>
                           @elseif($average == 4 || $average < 5)                     
                           <div class="product-rating" style="width: 80%"></div>
                           @elseif($average == 5 || $average < 5)                     
                           <div class="product-rating" style="width: 100%"></div>
                           @endif
                        </div>
                        <span class="font-small ml-5 text-muted"> ({{count($reviewcount)}})</span>
                     </div> --}}
                     @php
                     $amount = (100 - $item->discount_price)/100;
                     $new_price = $amount * $item->selling_price;
                     @endphp
                     @if($item->discount_price == NULL)
                     <div class="product-price">
                        <span>Gh {{ number_format($item->selling_price, 2) }}</span>
                     </div>
                     @else
                     <div class="product-price">
                        <span>Gh {{ number_format($new_price, 2) }}</span><br>
                        <span class="old-price">Gh {{ number_format($item->selling_price, 2) }}</span>
                     </div>
                     @endif
                  </div>
               </article>
               @endforeach
            </div>
         </div>
         <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
            <div class="product-list-small animated animated">
               <h4 class="section-title style-1 mb-30 animated animated">  Special Offer </h4>
               @foreach($special_offer as $item)                   
               <article class="row align-items-center hover-up">
                  <figure class="col-md-4 mb-0">
                     <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"><img src="{{ asset( $item->product_thumbnail ) }}" alt="" /></a>
                  </figure>
                  <div class="col-md-8 mb-0">
                     <h6>
                        <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"> {{ $item->product_name }} </a>
                     </h6>
                     {{-- @php
                     $reviewcount = App\Models\Review::where('product_id',$item->id)->where('status',1)->latest()->get();
                     $average = App\Models\Review::where('product_id',$item->id)->where('status',1)->avg('rating');
                     @endphp 
                     <div class="product-rate-cover">
                        <div class="product-rate d-inline-block">
                           @if($average == 0)
                           @elseif($average == 1 || $average < 2)                     
                           <div class="product-rating" style="width: 20%"></div>
                           @elseif($average == 2 || $average < 3)                     
                           <div class="product-rating" style="width: 40%"></div>
                           @elseif($average == 3 || $average < 4)                     
                           <div class="product-rating" style="width: 60%"></div>
                           @elseif($average == 4 || $average < 5)                     
                           <div class="product-rating" style="width: 80%"></div>
                           @elseif($average == 5 || $average < 5)                     
                           <div class="product-rating" style="width: 100%"></div>
                           @endif
                        </div>
                        <span class="font-small ml-5 text-muted"> ({{count($reviewcount)}})</span>
                     </div> --}}
                     @php
                     $amount = (100 - $item->discount_price)/100;
                     $new_price = $amount * $item->selling_price;
                     @endphp
                     @if($item->discount_price == NULL)
                     <div class="product-price">
                        <span>Gh {{ number_format($item->selling_price, 2) }}</span>
                     </div>
                     @else
                     <div class="product-price">
                        <span>Gh {{ number_format($new_price, 2) }}</span><br>
                        <span class="old-price">Gh {{ number_format($item->selling_price, 2) }}</span>
                     </div>
                     @endif
                  </div>
               </article>
               @endforeach
            </div>
         </div>
         <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
            <div class="product-list-small animated animated">
               <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>
               @foreach($new as $item)                   
               <article class="row align-items-center hover-up">
                  <figure class="col-md-4 mb-0">
                     <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"><img src="{{ asset( $item->product_thumbnail ) }}" alt="" /></a>
                  </figure>
                  <div class="col-md-8 mb-0">
                     <h6>
                        <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"> {{ $item->product_name }} </a>
                     </h6>
                     {{-- @php
                     $reviewcount = App\Models\Review::where('product_id',$item->id)->where('status',1)->latest()->get();
                     $average = App\Models\Review::where('product_id',$item->id)->where('status',1)->avg('rating');
                     @endphp 
                     <div class="product-rate-cover">
                        <div class="product-rate d-inline-block">
                           @if($average == 0)
                           @elseif($average == 1 || $average < 2)                     
                           <div class="product-rating" style="width: 20%"></div>
                           @elseif($average == 2 || $average < 3)                     
                           <div class="product-rating" style="width: 40%"></div>
                           @elseif($average == 3 || $average < 4)                     
                           <div class="product-rating" style="width: 60%"></div>
                           @elseif($average == 4 || $average < 5)                     
                           <div class="product-rating" style="width: 80%"></div>
                           @elseif($average == 5 || $average < 5)                     
                           <div class="product-rating" style="width: 100%"></div>
                           @endif
                        </div>
                        <span class="font-small ml-5 text-muted"> ({{count($reviewcount)}})</span>
                     </div> --}}
                     @php
                     $amount = (100 - $item->discount_price)/100;
                     $new_price = $amount * $item->selling_price;
                     @endphp
                     @if($item->discount_price == NULL)
                     <div class="product-price">
                        <span>Gh {{ number_format($item->selling_price, 2) }}</span>
                     </div>
                     @else
                     <div class="product-price">
                        <span>Gh {{ number_format($new_price, 2) }}</span><br>
                        <span class="old-price">Gh {{ number_format($item->selling_price, 2) }}</span>
                     </div>
                     @endif
                  </div>
               </article>
               @endforeach
            </div>
         </div>
         <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
            <div class="product-list-small animated animated">
               <h4 class="section-title style-1 mb-30 animated animated"> Special Deals </h4>
               @foreach($special_deals as $item)                   
               <article class="row align-items-center hover-up">
                  <figure class="col-md-4 mb-0">
                     <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"><img src="{{ asset( $item->product_thumbnail ) }}" alt="" /></a>
                  </figure>
                  <div class="col-md-8 mb-0">
                     <h6>
                        <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"> {{ $item->product_name }} </a>
                     </h6>
                     {{-- @php
                     $reviewcount = App\Models\Review::where('product_id',$item->id)->where('status',1)->latest()->get();
                     $average = App\Models\Review::where('product_id',$item->id)->where('status',1)->avg('rating');
                     @endphp 
                     <div class="product-rate-cover">
                        <div class="product-rate d-inline-block">
                           @if($average == 0)
                           @elseif($average == 1 || $average < 2)                     
                           <div class="product-rating" style="width: 20%"></div>
                           @elseif($average == 2 || $average < 3)                     
                           <div class="product-rating" style="width: 40%"></div>
                           @elseif($average == 3 || $average < 4)                     
                           <div class="product-rating" style="width: 60%"></div>
                           @elseif($average == 4 || $average < 5)                     
                           <div class="product-rating" style="width: 80%"></div>
                           @elseif($average == 5 || $average < 5)                     
                           <div class="product-rating" style="width: 100%"></div>
                           @endif
                        </div>
                        <span class="font-small ml-5 text-muted"> ({{count($reviewcount)}})</span>
                     </div> --}}
                     @php
                     $amount = (100 - $item->discount_price)/100;
                     $new_price = $amount * $item->selling_price;
                     @endphp
                     @if($item->discount_price == NULL)
                     <div class="product-price">
                        <span>Gh {{ number_format($item->selling_price, 2) }}</span>
                     </div>
                     @else
                     <div class="product-price">
                        <span>Gh {{ number_format($new_price, 2) }}</span><br>
                        <span class="old-price">Gh {{ number_format($item->selling_price, 2) }}</span>
                     </div>
                     @endif
                  </div>
               </article>
               @endforeach
            </div>
         </div>
      </div>
   </div>
</section>