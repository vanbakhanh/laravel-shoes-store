@extends('layouts.master')

@section('title', trans('home.branch'))

@section('content')

<div class="col-md-12 text-uppercase text-center mb-4">
    <h3>{{ trans('home.search', ['keyword' => $keyword]) }}</h3>
    <p>{{ trans('home.top_results', ['results' => $results->count()]) }}</p>
</div>
<div class="row">
    @include('frontend.home.common')
</div>

@endsection