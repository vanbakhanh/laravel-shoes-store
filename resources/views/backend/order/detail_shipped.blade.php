@extends('layouts.dashboard')

@section('title', trans('order.manager'))

@section('content')
<div class="justify-content-center">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h3>{{ trans('order.shipped') }} ({{ $ordersShipped->count() }})</h3>
                    <div class="list-group list-group-flush">
                        @foreach ($ordersShipped as $orderShipped)
                        <a href="{{ route('order.detail.shipped', $orderShipped->id) }}"
                            class="list-group-item list-group-item-action">
                            {{ $orderShipped->created_at }} - {{ trans('order.order') }} {{ $orderShipped->id }}
                        </a>
                        @endforeach
                    </div>
                    <a href="{{ route('order.manager') }}"
                        class="btn btn-outline-primary btn-block mt-4">{{ trans('order.view_more') }}</a>
                </div>
                <div class="col-md-9 table-responsive">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="float-left">{{ trans('order.order') }} #{{ $orderDetail->id }}</h3>
                            <h3 class="float-right">{{ trans('order.total') }} ${{ $orderDetail->total }}</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="float-left">{{ trans('order.created') }} {{ $orderDetail->created_at }}</p>
                            <p class="float-right">{{ trans('order.updated') }} {{ $orderDetail->updated_at }}</p>
                        </div>
                    </div>
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">{{ trans('order.image') }}</th>
                                <th scope="col">{{ trans('order.item') }}</th>
                                <th scope="col">{{ trans('order.quantity') }}</th>
                                <th scope="col">{{ trans('order.size') }}</th>
                                <th scope="col">{{ trans('order.color') }}</th>
                                <th scope="col">{{ trans('order.total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderDetail->products as $orderProduct)
                            <tr>
                                <td>
                                    <img src="{{ asset($orderProduct->image[0]) }}" width="50" height="50" alt="Image">
                                </td>
                                <td><a
                                        href="{{ route('product.show', $orderProduct->pivot->product_id) }}">{{ $orderProduct->name }}</a>
                                </td>
                                <td>{{ $orderProduct->pivot->qty }}</td>
                                <td>{{ $orderProduct->pivot->size }}</td>
                                <td>{{ $orderProduct->pivot->color }}</td>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection