@extends('layouts.master')
@section('title', 'Your Order')
@section('content')

<div class="row">
	<div class="col-md-3">
		<h3 class="my-4">My Orders ({{ $orders->count() }})</h3>
		<div class="list-group list-group-flush">
			@foreach ($orders as $order)
			<a href="{{ route('order.detail', $order->id) }}" class="list-group-item list-group-item-action">
				{{ $order->created_at }} - Order {{ $order->id }}
			</a>
			@endforeach
		</div>
	</div>
	<div class="col-md-9 table-responsive">
		<div class="row">
			<div class="col-md-12">
				<h3 class="float-left my-4">Order #{{ $orderDetail->id }}</h3>
				<h3 class="float-right my-4">Total ${{ $orderDetail->total }}</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p class="float-left">Created at {{ $orderDetail->created_at }}</p>
				<p class="float-right">Update at {{ $orderDetail->updated_at }}</p>
			</div>
		</div>
		<div class="jumbotron">
			@if ($orderDetail->status == 'Pending')
			<h3 class="text-center">Pending</h3>
			<div class="progress">
				<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%"></div>
			</div>
			@endif
			@if ($orderDetail->status == 'Verified')
			<h3 class="text-center">Verified</h3>
			<div class="progress">
				<div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
			</div>
			@endif
		</div>
		<table class="table table-hover table-md table-bordered table-light">
			<thead>
				<tr>
					<th scope="col">Item</th>
					<th scope="col">Size</th>
					<th scope="col">Color</th>
					<th scope="col">Total</th>
					<th scope="col">Quantity</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($orderDetail->products as $orderProduct)
				<tr>
					<td class="text-left">
						<img src="{{ asset("images/product/" . $orderProduct->image) }}" width="50" height="50" alt="image" class="mr-2">
						<a href="{!! route('product.show', $orderProduct->pivot->product_id) !!}">
						{{ $orderProduct->name }}</a>
					</td>
					<td>{{ $orderProduct->pivot->size }}</td>
					<td>{{ $orderProduct->pivot->color }}</td>
					<td>${{ $orderProduct->pivot->total }}</td>
					<td>{{ $orderProduct->pivot->qty }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection