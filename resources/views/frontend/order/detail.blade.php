@extends('layouts.master')
@section('title', 'Your Order')
@section('content')

<div class="row">
	<div class="col-md-3">
		<h4 class="my-4">My Orders ({{ $orders->count() }})</h4>
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
				<h4 class="float-left my-4">Order #{{ $orderDetail->id }}</h4>
				<h4 class="float-right my-4">Total ${{ $orderDetail->total }}</h4>
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
			<h4 class="text-center">Pending</h4>
			<div class="progress">
				<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%"></div>
			</div>
			@endif
			@if ($orderDetail->status == 'Verified')
			<h4 class="text-center">Verified</h4>
			<div class="progress">
				<div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
			</div>
			@endif
		</div>
		<table class="table table-hover table-md table-bordered text-center table-light">
			<thead>
				<tr>
					<th scope="col">Image</th>
					<th scope="col">Item</th>
					<th scope="col">Quantity</th>
					<th scope="col">Size</th>
					<th scope="col">Color</th>
					<th scope="col">Total</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($orderProducts as $orderProduct)
				<tr>
					<td>
						<img src="{{ asset("/images/product/" . $orderProduct->image) }}" width="30" height="30">
					</td>
					<td><a href="{!! route('product.show', $orderProduct->pivot->product_id) !!}">
						{{ $orderProduct->name }}</a>
					</td>
					<td>{{ $orderProduct->pivot->qty }}</td>
					<td>{{ $orderProduct->pivot->size }}</td>
					<td>{{ $orderProduct->pivot->color }}</td>
					<td>${{ $orderProduct->pivot->total }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection