@extends('layouts.dashboard')
@section('title', 'Admin')
@section('content')

<div class="card-deck">
    <div class="card border-success">
        <div class="card-body text-center text-success">
            <p class="card-text">Status</p>
            @if (session('status'))
            <p class="card-text">
                {{ session('status') }}
            </p>
            @endif
            @if (Auth::guard('web')->check())
            <p class="text-success">
                You are Logged In as a <strong>USER</strong>
            </p>
            @else
            <p class="text-danger">
                You are Logged Out as a <strong>USER</strong>
            </p>
            @endif
            @if (Auth::guard('admin')->check())
            <p class="text-success">
                You are Logged In as a <strong>ADMIN</strong>
            </p>
            @else
            <p class="text-danger">
                You are Logged Out as a <strong>ADMIN</strong>
            </p>
            @endif
        </div>
    </div>
    <div class="card border-warning text-warning text-center">
        <div class="card-body">
            <h3 class="card-title">{{ $products }}</h3>
            <p class="card-text">Products</p>
            <a class="card-link text-warning" href="{{ route('product.index') }}">View</a>
        </div>
    </div>
    <div class="card border-primary text-primary text-center">
        <div class="card-body">
            <h3 class="card-title">{{ $users }}</h3>
            <p class="card-text">Users</p>
            <a class="card-link text-primary" href="{{ route('user.index') }}">View</a>
        </div>
    </div>
    <div class="card border-danger text-danger text-center">
        <div class="card-body">
            <h3 class="card-title">{{ $orders->count() }}</h3>
            <p class="card-text">Orders</p>
            <a class="card-link text-danger" href="{{ route('order.manager') }}">View</a>
        </div>
    </div>
</div>

<div class="card-deck my-4">
    <div class="card border-primary text-primary text-center">
        <div class="card-body">
            <h3 class="card-title">${{ $orders->sum('total') }}</h3>
            <p class="card-text">Total Profit</p>
        </div>
    </div>
    <div class="card border-info text-info text-center">
        <div class="card-body">
            <h3 class="card-title">{{ $comments }}</h3>
            <p class="card-text">Comments</p>
        </div>
    </div>
    <div class="card border-dark text-dark text-center">
        <div class="card-body">
            <h3 class="card-title">{{ $orders->count('product_id') }}</h3>
            <p class="card-text">Products sold</p>
        </div>
    </div>
    <div class="card border-success text-success text-center">
        <div class="card-body">
            <h3 class="card-title">{{ $admins }}</h3>
            <p class="card-text">Administrator</p>
            <a class="card-link text-success" href="{{ route('admin.index') }}">View</a>
        </div>
    </div>
</div>

@endsection
