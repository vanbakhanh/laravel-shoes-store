@extends('layouts.dashboard')
@section('title', trans('dashboard.dashboard'))
@section('content')

<div class="card-deck">
    <div class="card text-success text-center">
        <div class="card-body">
            <h3 class="card-title">{{ $admins }}</h3>
            <p class="card-text">{{ trans('dashboard.admin') }}</p>
            <a class="card-link text-success" href="{{ route('admin.index') }}">{{ trans('dashboard.view') }}</a>
        </div>
    </div>
    <div class="card text-primary text-center">
        <div class="card-body">
            <h3 class="card-title">{{ $users }}</h3>
            <p class="card-text">{{ trans('dashboard.user') }}</p>
            <a class="card-link text-primary" href="{{ route('user.index') }}">{{ trans('dashboard.view') }}</a>
        </div>
    </div>
    <div class="card text-info text-center">
        <div class="card-body">
            <h3 class="card-title">{{ $products }}</h3>
            <p class="card-text">{{ trans('dashboard.product') }}</p>
            <a class="card-link text-info" href="{{ route('product.index') }}">{{ trans('dashboard.view') }}</a>
        </div>
    </div>
    <div class="card text-warning text-center">
        <div class="card-body">
            <h3 class="card-title">{{ $orders->count() }}</h3>
            <p class="card-text">{{ trans('dashboard.order') }}</p>
            <a class="card-link text-warning" href="{{ route('order.manager') }}">{{ trans('dashboard.view') }}</a>
        </div>
    </div>
</div>

<div class="card-deck my-4">
    <div class="card">
        <div class="card-body text-center text-success">
            @if (Auth::guard('web')->check())
            <p class="text-success">
                {{ trans('dashboard.logged_in') }} <strong>{{ trans('dashboard.user') }}</strong>
            </p>
            @else
            <p class="text-danger">
                {{ trans('dashboard.logged_out') }} <strong>{{ trans('dashboard.user') }}</strong>
            </p>
            @endif
            @if (Auth::guard('admin')->check())
            <p class="text-success">
                {{ trans('dashboard.logged_in') }} <strong>{{ trans('dashboard.admin') }}</strong>
            </p>
            @else
            <p class="text-danger">
                {{ trans('dashboard.logged_out') }} <strong>{{ trans('dashboard.admin') }}</strong>
            </p>
            @endif
        </div>
    </div>
    <div class="card text-primary text-center">
        <div class="card-body">
            <h3 class="card-title">${{ $orders->sum('total') }}</h3>
            <p class="card-text">{{ trans('dashboard.profit') }}</p>
        </div>
    </div>
    <div class="card text-info text-center">
        <div class="card-body">
            <h3 class="card-title">{{ $comments }}</h3>
            <p class="card-text">{{ trans('dashboard.comment') }}</p>
        </div>
    </div>
    <div class="card text-warning text-center">
        <div class="card-body">
            <h3 class="card-title">{{ $orders->sum('quantity') }}</h3>
            <p class="card-text">{{ trans('dashboard.sold') }}</p>
        </div>
    </div>
</div>

@endsection
