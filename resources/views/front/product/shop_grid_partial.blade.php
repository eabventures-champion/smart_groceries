<div class="shop-product-fillter" style="margin-top: 30px !important; display: flex !important; justify-content: space-between !important; align-items: center !important; flex-wrap: wrap !important; gap: 15px !important;">
   <div class="totall-product">
      <p>
         We found <strong class="text-brand">{{ $products->total() }}</strong> products for you!
      </p>
   </div>
    @if(Route::currentRouteName() === 'shop.page')
    <div class="reset-filter-container">
       <button type="button" class="btn-reset-filter-header" onclick="resetFilters()"><i class="fi fi-rs-refresh"></i> Reset Filters</button>
    </div>
    @endif
</div>

<div class="row product-grid">
   @forelse($products as $product)
    <div class="col-lg-3 col-md-4 col-6 col-sm-6">
      <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
         <div class="product-img-action-wrap">
            <div class="product-img product-img-zoom">
               <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
               <img class="default-img" src="{{ asset( $product->product_thumbnail ) }}" alt="" />
               </a>
            </div>
            <div class="product-action-1 shop d-none d-lg-block">
               <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>
               <a aria-label="Compare" class="action-btn" id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
               <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
            </div>
            <div class="product-badges product-badges-position product-badges-mrg">
               @if($product->discount_price == NULL)
               @else
               <span class="hot"> {{ round((float)$product->discount_price) }} %</span>
               @endif
            </div>
         </div>
         <div class="product-content-wrap">
            <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"> {{ $product->product_name }} </a></h2>
            @php
             $amount = (100 - (float)($product->discount_price ?? 0))/100;
             $new_price = $amount * (float)$product->selling_price;
            @endphp
            <div class="product-card-bottom">
               @if($product->discount_price == NULL)
               <div class="product-price">
                  <span>Gh {{ number_format((float)$product->selling_price, 2) }}</span>
               </div>
               @else
               <div class="product-price">
                  <span>Gh {{ number_format((float)$new_price, 2) }}</span><br>
                  <span class="old-price">Gh {{ number_format((float)$product->selling_price, 2) }}</span>
               </div>
               @endif
               <div class="add-cart">
                  <a class="add" href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
               </div>
            </div>
         </div>
      </div>
   </div>
   @empty
   <div class="col-12 text-center py-5">
      <h4 class="text-muted">No products found matching the selected filters.</h4>
   </div>
   @endforelse
</div>

<!--product grid-->
<div class="pagination-area mt-15">
   <nav aria-label="Page navigation example">
      {{ $products->links('vendor.pagination.custom') }}
   </nav>
</div>
