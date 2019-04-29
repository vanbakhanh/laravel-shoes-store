@extends('layouts.master')

@section('title', trans('order.my_order'))

@section('content')
<div class="row">
    <div class="col-md-3">
        <h3 class="my-4">{{ trans('order.my_order') }} ({{ count($orders) }})</h3>
        <div class="list-group list-group-flush mb-4">
            @foreach ($orders as $order)
            <a href="{{ route('order.detail', $order->id) }}" class="list-group-item list-group-item-action">
                {{ $order->created_at }} - {{ trans('order.order') }} {{ $order->id }}
            </a>
            @endforeach
        </div>
    </div>
    <div class="col-md-9 table-responsive">
        <div class="row">
            <div class="col-md-12">
                <h3 class="float-left my-4">{{ trans('order.order') }} #{{ $orderDetail->id }}</h3>
                <h3 class="float-right my-4">{{ trans('order.total') }} ${{ $orderDetail->total }}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="float-left">{{ trans('order.created') }} {{ $orderDetail->created_at }}</p>
                <p class="float-right">{{ trans('order.updated') }} {{ $orderDetail->updated_at }}</p>
            </div>
        </div>
        <div class="jumbotron">
            @if ($orderDetail->status == 'Pending')
            <h3 class="text-center">{{ trans('order.pending') }}</h3>
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%"></div>
            </div>
            @endif
            @if ($orderDetail->status == 'Verified')
            <h3 class="text-center">{{ trans('order.verified') }}</h3>
            <div class="progress">
                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar"
                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
            </div>
            @endif
        </div>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">{{ trans('order.image') }}</th>
                    <th scope="col">{{ trans('order.product') }}</th>
                    <th scope="col">{{ trans('order.size') }}</th>
                    <th scope="col">{{ trans('order.color') }}</th>
                    <th scope="col">{{ trans('order.total') }}</th>
                    <th scope="col">{{ trans('order.quantity') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderDetail->products as $orderProduct)
                <tr>
                    <td>
                        <img src="{{ asset($orderProduct->image[0]) }}" width="50" height="50" alt="Image">
                    </td>
                    <td>
                        <a href="{!! route('product.show', $orderProduct->pivot->product_id) !!}">
                            {{ $orderProduct->name }}
                        </a>
                    </td>
                    <td>{{ $orderProduct->pivot->size }}</td>
                    <td>{{ $orderProduct->pivot->color }}</td>
                    <td>${{ $orderProduct->pivot->total }}</td>
                    <td>{{ $orderProduct->pivot->qty }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table class="table">
            <tbody>
                <tr>
                    <th scope="row">{{ trans('order.user_id') }}</th>
                    <td class="text-right">{{ $orderDetail->user->id }}</td>
                </tr>
                <tr>
                    <th scope="row">{{ trans('order.name') }}</th>
                    <td class="text-right">{{ $orderDetail->user->profile->full_name }}</td>
                </tr>
                <tr>
                    <th scope="row">{{ trans('order.email') }}</th>
                    <td class="text-right">{{ $orderDetail->user->email }}</td>
                </tr>
                <tr>
                    <th scope="row">{{ trans('order.phone') }}</th>
                    <td class="text-right">{{ $orderDetail->user->profile->phone }}</td>
                </tr>
                <tr>
                    <th scope="row">{{ trans('order.address') }}</th>
                    <td class="text-right">{{ $orderDetail->address }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection