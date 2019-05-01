@extends('layouts.master')

@section('title', trans('home.branch'))

@section('cover')
<div class="site-blocks-cover" style="background-image: url(/storage/cover/1.jpg);">
    <div class="container">
        <div class="row align-items-start align-items-md-center justify-content-end">
            <div class="col-md-12 text-center">
                <h1 class="mb-2" data-aos="zoom-in">Finding Your Perfect Shoes</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div id="shop" data-aos="fade-up">
    <h3 class="text-center text-uppercase py-4 m-0" data-aos="zoom-in">{{ trans('home.new') }}</h3>
    <div class="row mx-2">
        @include('frontend.common.product-card')
    </div>
    <div class="d-flex justify-content-center">{{ $products->links() }}</div>
</div>
@endsection