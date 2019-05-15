@extends('layouts.dashboard')

@section('title', trans('order.manager'))

@section('content')
<div class="card-deck text-center mb-4">
    <div class="card">
        <div class="card-body">
            <p class="card-text">{{ trans('order.pending') }}</p>
            <h3 class="card-title">{{ $ordersPending }}</h3>
            <a class="card-link"
                href="{{ route('order.manager.status', ['status' => 'pending']) }}">{{ trans('order.view') }}</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <p class="card-text">{{ trans('order.verified') }}</p>
            <h3 class="card-title">{{ $ordersVerified }}</h3>
            <a class="card-link"
                href="{{ route('order.manager.status', ['status' => 'verified']) }}">{{ trans('order.view') }}</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <p class="card-text">{{ trans('order.shipped') }}</p>
            <h3 class="card-title">{{ $ordersShipped }}</h3>
            <a class="card-link"
                href="{{ route('order.manager.status', ['status' => 'shipped']) }}">{{ trans('order.view') }}</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <p class="card-text">{{ trans('order.canceled') }}</p>
            <h3 class="card-title">{{ $ordersCanceled }}</h3>
            <a class="card-link"
                href="{{ route('order.manager.status', ['status' => 'canceled']) }}">{{ trans('order.view') }}</a>
        </div>
    </div>
</div>

@yield('manager-status')
@endsection