@extends('layouts.master')

@section('title', trans('home.branch'))

@section('content')
<div class="col-md-12 text-center my-5">
    <h3 class="title">{{ trans('home.search', ['keyword' => $keyword]) }}</h3>
    <p class="m-0">{{ trans('home.top_results', ['products' => $products->count()]) }}</p>
</div>
<div class="row">
    @include('frontend.common.product-card')
</div>
@endsection