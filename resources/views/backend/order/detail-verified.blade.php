@extends('layouts.dashboard')
@section('title', 'Order Manager')
@section('content')

<div class="row">
	<div class="col-md-3">
		<h3 class="my-4">Verified ({{ $ordersVerified->count() }})</h3>
		<div class="list-group list-group-flush">
			@foreach ($ordersVerified as $orderVerified)
			<a href="{{ route('order.detail.verified', $orderVerified->id) }}" class="list-group-item list-group-item-action">
				{{ $orderVerified->created_at }} - Order {{ $orderVerified->id }}
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
				<p class="float-right">Updated at {{ $orderDetail->updated_at }}</p>
			</div>
		</div>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th scope="col">Items</th>
					<th scope="col">Quantity</th>
					<th scope="col">Size</th>
					<th scope="col">Color</th>
					<th scope="col">Total</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($orderDetail->products as $orderProduct)
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
					<th scope="row">User ID</th>
					<td class="text-right">{{ $orderDetail->user->id }}</td>
				</tr>
				<tr>
					<th scope="row">Name</th>
					<td class="text-right">{{ $orderDetail->user->name }}</td>
				</tr>
				<tr>
					<th scope="row">Email</th>
					<td class="text-right">{{ $orderDetail->user->email }}</td>
				</tr>
				<tr>
					<th scope="row">Phone</th>
					<td class="text-right">{{ $orderDetail->user->phone }}</td>
				</tr>
				<tr>
					<th scope="row">Address</th>
					<td class="text-right">{{ $orderDetail->user->address }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

@endsection