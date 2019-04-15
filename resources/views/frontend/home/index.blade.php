@extends('layouts.master')

@section('title', trans('home.branch'))

@section('content')

<div class="site-blocks-cover" style="background-image: url(/storage/cover/hero_1.jpg);">
    <div class="container">
        <div class="row align-items-start align-items-md-center justify-content-end">
            <div class="col-md-5 text-center text-md-left pt-5 pt-md-0">
                <h1 class="mb-2">Finding Your Perfect Shoes</h1>
                <div class="intro-text text-center text-md-left">
                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam.
                        Integer accumsan tincidunt fringilla. </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" id="collection-box">
    <h3 class="text-center text-uppercase py-4 m-0">{{ trans('home.new') }}</h3>
    <div class="row">
        @include('frontend.common.product-card')
    </div>
    <div class="d-flex justify-content-center">{{ $products->links() }}</div>
</div>

@endsection