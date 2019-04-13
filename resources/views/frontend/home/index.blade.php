@extends('layouts.master')

@section('title', trans('home.branch'))

@section('content')

<h3 class="text-center text-uppercase mb-4">{{ trans('home.new') }}</h3>
<div class="row">
    @include('frontend.common.product-card')
</div>
<div class="d-flex justify-content-center">{{ $products->links() }}</div>

@endsection