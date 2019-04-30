@extends('layouts.dashboard')

@section('title', trans('dashboard.dashboard'))

@section('content')
<div class="card-deck text-center">
    <div class="card">
        <div class="card-body">
            <p class="card-text">{{ trans('dashboard.admin') }}</p>
            <h3 class="card-title">{{ $admins }}</h3>
            <a class="card-link" href="{{ route('admin.index') }}">{{ trans('dashboard.view') }}</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <p class="card-text">{{ trans('dashboard.user') }}</p>
            <h3 class="card-title">{{ $users }}</h3>
            <a class="card-link" href="{{ route('user.index') }}">{{ trans('dashboard.view') }}</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <p class="card-text">{{ trans('dashboard.product') }}</p>
            <h3 class="card-title">{{ $products }}</h3>
            <a class="card-link" href="{{ route('product.index') }}">{{ trans('dashboard.view') }}</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <p class="card-text">{{ trans('dashboard.order') }}</p>
            <h3 class="card-title">{{ count($orders) }}</h3>
            <a class="card-link" href="{{ route('order.manager') }}">{{ trans('dashboard.view') }}</a>
        </div>
    </div>
</div>
<br>
<div class="card-deck text-center">
    <div class="card">
        <div class="card-body">
            @if (Auth::guard('web')->check())
            <p>
                {{ trans('dashboard.logged_in') }} <strong>{{ trans('dashboard.user') }}</strong>
            </p>
            @else
            <p>
                {{ trans('dashboard.logged_out') }} <strong>{{ trans('dashboard.user') }}</strong>
            </p>
            @endif
            @if (Auth::guard('admin')->check())
            <p>
                {{ trans('dashboard.logged_in') }} <strong>{{ trans('dashboard.admin') }}</strong>
            </p>
            @else
            <p>
                {{ trans('dashboard.logged_out') }} <strong>{{ trans('dashboard.admin') }}</strong>
            </p>
            @endif
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <p class="card-text">{{ trans('dashboard.profit') }}</p>
            <h3 class="card-title">${{ $orders->sum('total') }}</h3>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <p class="card-text">{{ trans('dashboard.review') }}</p>
            <h3 class="card-title">{{ $reviews }}</h3>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <p class="card-text">{{ trans('dashboard.sold') }}</p>
            <h3 class="card-title">{{ $orders->sum('quantity') }}</h3>
        </div>
    </div>
</div>
@endsection