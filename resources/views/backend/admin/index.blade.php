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
    <div class="card border-warning text-warning">
        <div class="card-body text-center">
            <p class="card-text">Products</p>
            <h1 class="text-warning">{{ $products }}</h1>
        </div>
    </div>
    <div class="card border-primary">
        <div class="card-body text-center text-primary">
            <p class="card-text">Users</p>
            <h1 class="text-primary">{{ $users }}</h1>
        </div>
    </div>
    <div class="card border-danger">
        <div class="card-body text-center text-danger">
            <p class="card-text">Orders</p>
            <h1 class="text-danger">{{ $orders }}</h1>
        </div>
    </div> 
</div>

@endsection
