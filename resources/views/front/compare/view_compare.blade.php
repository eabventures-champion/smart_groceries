@extends('front.master')
@section('content')
@section('title')
   Compare Page 
@endsection

 <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                     <span></span> Compare
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <h4 class="heading-2 mb-10">Compare</h4>
                    <h6 class="text-body mb-40">Products to compare appears here</h6>
                    <div class="table-responsive">
                        <table class="table text-center table-compare">
                            <tbody id="compare"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

@endsection