@extends('layouts.master')

@section('title', trans('home.branch'))

@section('content')

<div class="container">
    <div class="col-md-12 text-uppercase text-center py-4 m-0">
        <h3>{{ trans('home.search', ['keyword' => $keyword]) }}</h3>
        <p>{{ trans('home.top_results', ['products' => $products->count()]) }}</p>
    </div>
    <div class="row">
        @include('frontend.common.product-card')
    </div>
</div>

@endsection