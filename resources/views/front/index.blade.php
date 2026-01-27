@extends('front.master')
@section('content')
@section('title')
    Smart Groceries & Delivery
@endsection
    @include('front.sections.hero')
    @include('front.sections.featured_categories')
    @include('front.sections.banners')
    @include('front.sections.products_new')
    @include('front.sections.featured_products')
    {{-- @include('front.sections.category_one') --}}
    {{-- @include('front.sections.category_two') --}}
    {{-- @include('front.sections.category_three') --}}
    {{-- @include('front.sections.special_category') --}}
    {{-- @include('front.sections.vendor_list') --}}
@endsection
