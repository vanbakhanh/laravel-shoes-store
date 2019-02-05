@extends('layouts.master')

@section('title', trans('order.my_order'))

@section('content')

<div class="row">
	<div class="col-md-3">
		<h3 class="mb-4">{{ trans('order.my_order') }} ({{ count($orders) }})</h3>
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
				<h3 class="float-left mb-4">{{ trans('order.recent') }}</h3>
				@if ($orderDetail == null)
				@else
				@if ($orderDetail->status == 'Pending')
				<h3 class="float-right mb-4">{{ trans('order.pending') }}</h3>
				@endif
				@if ($orderDetail->status == 'Verified')
				<h3 class="float-right mb-4">{{ trans('order.verified') }}</h3>
				@endif
				@endif
			</div>
		</div>
		@if ($orderDetail == null)
		<p>{{ trans('order.empty') }}</p>
		@else
		<table class="table table-bordered text-center">
			<thead>
				<tr>
					<th scope="col">{{ trans('order.item') }}</th>
					<th scope="col">{{ trans('order.total') }}</th>
					<th scope="col">{{ trans('order.quantity') }}</th>
					<th scope="col">{{ trans('order.order') }}</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($orderDetail->products as $orderProduct)
				<tr>
					<td class="text-left">
						<img src="{{ asset($orderProduct->image[0]) }}" width="50" height="50" alt="Image" class="mr-2">
						<a href="{{ route('product.show',$orderProduct->pivot->product_id) }}">
							{{$orderProduct->name }}
						</a>
					</td>
					<td>${{ $orderProduct->pivot->total }}</td>
					<td>{{ $orderProduct->pivot->qty }}</td>
					<td>
						<a href="{{ route('order.detail', $orderProduct->pivot->order_id) }}">
							{{ $orderProduct->pivot->order_id }}
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@endif
	</div>
</div>

@endsection
