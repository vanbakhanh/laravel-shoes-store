@extends('layouts.master')

@section('title', trans('order.my_order'))

@section('content')
<div class="row">
    <div class="col-md-12 table-responsive">
        <div class="row">
            <div class="col-md-12">
                <h3 class="float-left my-4">{{ trans('order.recent') }}</h3>
                @if ($orderDetail !== null)
                <h3 class="float-right my-4">{{ trans('order.' . strtolower($orderDetail->status)) }}</h3>
                @endif
            </div>
        </div>
        @if ($orderDetail == null)
        <p>{{ trans('order.empty') }}</p>
        @else
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">{{ trans('order.id') }}</th>
                    <th scope="col">{{ trans('order.image') }}</th>
                    <th scope="col">{{ trans('order.product') }}</th>
                    <th scope="col">{{ trans('order.total') }}</th>
                    <th scope="col">{{ trans('order.quantity') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderDetail->products as $orderProduct)
                <tr>
                    <td>
                        <a href="{{ route('order.detail', $orderProduct->pivot->order_id) }}">
                            {{ $orderProduct->pivot->order_id }}
                        </a>
                    </td>
                    <td>
                        <img src="{{ asset($orderProduct->image[0]) }}" width="50" height="50" alt="Image">
                    </td>
                    <td>
                        <a href="{{ route('product.show',$orderProduct->pivot->product_id) }}">
                            {{$orderProduct->name }}
                        </a>
                    </td>
                    <td>${{ $orderProduct->pivot->total }}</td>
                    <td>{{ $orderProduct->pivot->qty }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h3 class="my-4">{{ trans('order.my_order') }} ({{ count($orders) }})</h3>
        <table id="table" class="table table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">{{ trans('order.id') }}</th>
                    <th scope="col">{{ trans('order.created') }}</th>
                    <th scope="col">{{ trans('order.product') }}</th>
                    <th scope="col">{{ trans('order.quantity') }}</th>
                    <th scope="col">{{ trans('order.total') }}</th>
                    <th scope="col">{{ trans('order.status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <th><a href="{{ route('order.detail', $order->id) }}">{{ $order->id }}</a></th>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        @if (count($order->products) == 1)
                        {{ $order->products[0]->name }}
                        @else
                        {{ $order->products[0]->name }}...
                        {{ trans('order.other_products', ['num' => count($order->products) - 1]) }}
                        @endif
                    </td>
                    <td>{{ $order->quantity }}</td>
                    <td>${{ $order->total }}</td>
                    <td>{{ $order->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection