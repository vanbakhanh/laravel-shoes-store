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
            <h1 class="card-title">{{ $products }}</h1>
            <p class="card-text">Products</p>
            <a class="card-link text-warning" href="{{ route('product.index') }}">View</a>
        </div>
    </div>
    <div class="card border-primary text-primary text-center">
        <div class="card-body">
            <h1 class="card-title">{{ $users }}</h1>
            <p class="card-text">Users</p>
            <a class="card-link text-primary" href="{{ route('user.index') }}">View</a>
        </div>
    </div>
    <div class="card border-danger text-danger text-center">
        <div class="card-body">
            <h1 class="card-title">{{ $orders }}</h1>
            <p class="card-text">Orders</p>
            <a class="card-link text-danger" href="{{ route('order.manager') }}">View</a>
        </div>
    </div> 
</div>

@endsection
