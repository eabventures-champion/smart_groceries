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
                {{-- <h6 class="text-body">There are products in this list</h6> --}}
            </div>
            <div class="table-responsive shopping-summery">
                <table class="table table-wishlist">
                    <thead>
                        <tr class="main-heading">
                            <th class="custome-checkbox start">

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
        </div>
    </div>
</div>

@endsection
