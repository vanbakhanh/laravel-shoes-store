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

@section('manager-status')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ trans('order.all') }}</h3>
                <div class="table-responsive">
                    <table id="table" class="table table-hover table-bordered text-center">
                        <thead>
                            <tr>
                                <th scope="col">{{ trans('order.id') }}</th>
                                <th scope="col">{{ trans('order.user') }}</th>
                                <th scope="col">{{ trans('order.quantity') }}</th>
                                <th scope="col">{{ trans('order.total') }}</th>
                                <th scope="col">{{ trans('order.created') }}</th>
                                <th scope="col">{{ trans('order.status') }}</th>
                                <th scope="col">{{ trans('order.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <th scope="row">{{ $order->id }}</th>
                                <td>{{ $order->user->email }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>${{ $order->total }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->status }}</td>
                                <td>
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['order.delete', $order->id]]) }}
                                    <div class="btn-group btn-group-toggle">
                                        <a href="{{ route('order.detail.' . $order->status, $order->id) }}"
                                            class="btn btn-outline-info btn-sm">{{ trans('order.detail') }}</a>
                                        {{ Form::submit(trans('order.delete'), ['class' => 'btn btn-outline-danger btn-sm']) }}
                                    </div>
                                    {{ Form::close() }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@show
@endsection