@extends('layouts.master')

@section('title', trans('order.my_order'))

@section('content')
<div class="justify-content-center mt-4">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h3 class="card-title">{{ trans('order.recent') }}</h3>
                    <div class="list-group list-group-flush">
                        @foreach ($orders as $order)
                        <a href="{{ route('order.detail', $order->id) }}"
                            class="list-group-item list-group-item-action">
                            {{ $order->created_at }} - {{ trans('order.order') }} {{ $order->id }}
                        </a>
                        @endforeach
                    </div>
                    <a href="{{ route('order') }}"
                        class="btn btn-outline-primary btn-block mt-4">{{ trans('order.view_more') }}</a>
                </div>
                <div class="col-md-9 table-responsive">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title float-left">{{ trans('order.order') }} #{{ $orderDetail->id }}</h3>
                            <h3 class="card-title float-right">{{ trans('order.total') }} ${{ $orderDetail->total }}
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="float-left">{{ trans('order.created') }} {{ $orderDetail->created_at }}</p>
                            <p class="float-right">{{ trans('order.updated') }} {{ $orderDetail->updated_at }}</p>
                        </div>
                    </div>
                    <div class="jumbotron">
                        <div class="row">
                            @if ($orderDetail->status == 'canceled')
                            <div class="col">
                                <h3 class="text-center text-danger">{{ trans('order.canceled') }}</h3>
                            </div>
                            @else
                            <div class="col">
                                <h3 class="text-center text-warning">{{ trans('order.pending') }}</h3>
                            </div>
                            <div class="col">
                                <h3 class="text-center text-primary">{{ trans('order.verified') }}</h3>
                            </div>
                            <div class="col">
                                <h3 class="text-center text-success">{{ trans('order.shipped') }}</h3>
                            </div>
                            @endif
                        </div>
                        <div class="progress bg-light rounded">
                            @if ($orderDetail->status == 'pending')
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning"
                                role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"
                                style="width: 15%"></div>
                            @elseif ($orderDetail->status == 'verified')
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"
                                style="width: 50%"></div>
                            @elseif ($orderDetail->status == 'shipped')
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"
                                style="width: 100%"></div>
                            @elseif ($orderDetail->status == 'canceled')
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                                role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"
                                style="width: 100%"></div>
                            @endif
                        </div>
                    </div>
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th scope="col">{{ trans('order.image') }}</th>
                                <th scope="col">{{ trans('order.product') }}</th>
                                <th scope="col">{{ trans('order.size') }}</th>
                                <th scope="col">{{ trans('order.color') }}</th>
                                <th scope="col">{{ trans('order.price') }}</th>
                                <th scope="col">{{ trans('order.quantity') }}</th>
                                <th scope="col">{{ trans('order.total') }}</th>
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
                                <td>${{ $orderProduct->pivot->price }}</td>
                                <td>{{ $orderProduct->pivot->qty }}</td>
                                <td>${{ $orderProduct->pivot->total }}</td>
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
                    @if ($orderDetail->status == 'pending')
                    <div class="row mb-4">
                        <a href="{{ route('order.cancel', $orderDetail->id) }}"
                            class="btn btn-danger btn-block">{{ trans('order.cancel') }}</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection