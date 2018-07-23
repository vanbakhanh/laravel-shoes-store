@extends('layouts.dashboard')
@section('title', trans('order.manager'))
@section('content')

<div class="row">
	<div class="col-md-3">
		<h3 class="my-4">{{ trans('order.verified') }} ({{ $ordersVerified->count() }})</h3>
		<div class="list-group list-group-flush">
			@foreach ($ordersVerified as $orderVerified)
			<a href="{{ route('order.detail.verified', $orderVerified->id) }}" class="list-group-item list-group-item-action">
				{{ $orderVerified->created_at }} - {{ trans('order.order') }} {{ $orderVerified->id }}
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
		<table class="table table-hover table-bordered text-center">
			<thead>
				<tr>
					<th scope="col">{{ trans('order.item') }}</th>
					<th scope="col">{{ trans('order.quantity') }}</th>
					<th scope="col">{{ trans('order.size') }}</th>
					<th scope="col">{{ trans('order.color') }}</th>
					<th scope="col">{{ trans('order.total') }}</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($orderDetail->product as $orderProduct)
				<tr>
					<td><a href="{{ route('product.show', $orderProduct->pivot->product_id) }}">{{ $orderProduct->name }}</a></td>
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
					<td class="text-right">{{ $orderDetail->user->name }}</td>
				</tr>
				<tr>
					<th scope="row">{{ trans('order.email') }}</th>
					<td class="text-right">{{ $orderDetail->user->email }}</td>
				</tr>
				<tr>
					<th scope="row">{{ trans('order.phone') }}</th>
					<td class="text-right">{{ $orderDetail->user->phone }}</td>
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