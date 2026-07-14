@extends('front.master')
@section('content')
@section('title')
 Wishlist Page
@endsection

{{-- <div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
        </div>
    </div>
</div> --}}
<div class="container mb-80 mt-50">
    <div class="row">
        <div class="col-xl-10 col-lg-12 m-auto">
            <div class="mb-50 wishlist-mobile">
                <h4 class="heading-2 text-center">Your Wishlist</h4>
                <div class="text-center mt-3 mb-3">
                    <button class="btn btn-sm btn-danger d-none" id="bulkDeleteWishlistBtn" onclick="bulkDeleteWishlist()"><i class="fi-rs-trash mr-5"></i>Delete Selected</button>
                </div>
                {{-- <h6 class="text-body">There are products in this list</h6> --}}
            </div>
            <div id="wishlist-table-container" class="table-responsive shopping-summery d-none d-md-block">
                <table class="table table-wishlist">
                    <thead>
                        <tr class="main-heading">
                            <th style="width: 50px; text-align: center;">
                                <input class="form-check-input" type="checkbox" id="selectAllWishlist" onclick="toggleSelectAllWishlist(this)" style="display: block !important; margin: 0 auto;">
                            </th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            {{-- <th scope="col">Stock Status</th> --}}
                            <th scope="col" class="end">Remove</th>
                        </tr>
                    </thead>
                    <tbody id="wishlist">

                    </tbody>
                </table>
            </div>

            <!-- Mobile View Wishlist List -->
            <div id="wishlist-mobile-container" class="d-block d-md-none mb-50"></div>

            <!-- Premium Empty Wishlist State -->
            <div id="wishlist-empty-state" class="d-none text-center pt-50 pb-50" style="font-family: 'Outfit', sans-serif; background: #ffffff; border-radius: 24px; border: 1px solid #f1f2f4; padding: 60px 40px !important; box-shadow: 0 10px 40px rgba(0,0,0,0.02);">
               <div style="font-size: 80px; margin-bottom: 25px; animation: heartBeat 2s infinite ease-in-out;">❤️</div>
               <h3 style="font-weight: 800; color: #253D4E; margin-bottom: 12px; font-size: 24px;">Your Wishlist is Empty</h3>
               <p style="color: #7E7E7E; font-size: 15px; margin-bottom: 30px; line-height: 1.6;">
                  You haven't added any items to your wishlist yet.<br>Explore our products and tap the heart icon to save your favorites!
               </p>
               <a href="{{ url('/') }}" class="btn btn-default hover-up" style="background-color: #3BB77E; border-color: #3BB77E; color: white; padding: 14px 35px; border-radius: 12px; font-weight: 700; text-decoration: none; font-size: 14px; display: inline-flex; align-items: center; gap: 8px;">
                  <i class="fi-rs-shopping-bag"></i> Continue Shopping
               </a>
            </div>

            <style>
            @keyframes heartBeat {
               0%, 100% { transform: scale(1); }
               50% { transform: scale(1.12); }
            }
            </style>
        </div>
    </div>
</div>

@endsection
