@php
    $banner = App\Models\Banner::latest()->get();
@endphp

@if($banner->isNotEmpty())
<section class="banners d-block d-lg-none mb-15">
    <div class="container">
       <div class="mobile-banner-slick">
         @foreach($banner as $item)
           <div>
              <a href="{{ route('shop.page') }}">
                 <img src="{{ asset($item->banner_image) }}" alt="{{ $item->banner_title }}" style="width: 100%; border-radius: 15px; height: auto;" />
              </a>
           </div>
         @endforeach
       </div>
    </div>
</section>
<script>
   document.addEventListener("DOMContentLoaded", function() {
       var checkSlick = setInterval(function() {
           if (typeof jQuery !== 'undefined' && jQuery.fn.slick) {
               clearInterval(checkSlick);
               var $slider = jQuery(".mobile-banner-slick");
               if ($slider.length > 0 && !$slider.hasClass('slick-initialized')) {
                   $slider.slick({
                       slidesToShow: 1,
                       slidesToScroll: 1,
                       autoplay: true,
                       autoplaySpeed: 3000,
                       dots: false,
                       arrows: false,
                       fade: false,
                       infinite: true
                   });
               }
           }
       }, 100);
   });
</script>
@endif

@php
$categories = App\Models\Category::withCount(['products' => function($q) {
    $q->where('status', 1);
}])->orderBy('category_name','DESC')->get();
@endphp


{{-- For mobile Categories --}}
@if(!$categories->isEmpty())
<section class="popular-categories d-block d-lg-none">
   <div class="container wow animate__animated animate__fadeIn">
      <div class="section-title">
         <div class="title">
            {{-- <h3>Featured Categories</h3> --}}
         </div>
         <div class="slider-arrow slider-arrow-2 flex-right carausel-10-columns-arrow" id="carausel-10-columns-arrows"></div>
      </div>
      <div class="carausel-10-columns-cover position-relative">
         <div class="carausel-10-columns" id="carausel-10-columns">
            @foreach($categories as $category)
            <div style="max-width: 120px !important;" class="card-2 bg-{{ $category['id'] + 1 }} wow animate__animated animate__fadeInUp" data-wow-delay=".{{ $category['id'] }}s">
               <figure class="img-hover-scale overflow-hidden">
                  <a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}"><img src="{{ asset($category->category_photo) }}" alt="" loading="lazy" /></a>
               </figure>
               <h6><a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}">{{ $category->category_name }}</a></h6>
               <span>{{ $category->products_count }} items</span>
            </div>
            @endforeach
         </div>
      </div>
   </div>
</section>
@else
@endif

