@extends('layouts.dashboard')
@section('title', 'Order Manager')
@section('content')

<div class="row">
	<div class="col-md-3">
		<h4>Pending ({{ $ordersPending->count() }})</h4>
		<div class="list-group list-group-flush my-4">
			@foreach ($ordersPending as $orderPending)
			<a href="{{ route('admin.order.detail.pending', $orderPending->id) }}" class="list-group-item list-group-item-action">
				{{ $orderPending->created_at }} - Order {{ $orderPending->id }}
			</a>
			@endforeach
		</div>
	</div>
	<div class="col-md-9 table-responsive">
		<div class="row">
			<div class="col-md-12">
				<h4 class="float-left">Order #{{ $orderDetail->id }}</h4>
				<h4 class="float-right">Total ${{ $orderDetail->total }}</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p class="float-left">Created at {{ $orderDetail->created_at }}</p>
				<p class="float-right">Updated at {{ $orderDetail->updated_at }}</p>
			</div>
		</div>
		<table class="table table-hover table-bordered text-center table-light">
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
				@foreach ($orderProducts as $orderProduct)
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
		<table class="table table-light">
			<tbody>
				<tr>
					<th scope="row">User ID</th>
					<td class="text-right">{{ $user->id }}</td>
				</tr>
				<tr>
					<th scope="row">Name</th>
					<td class="text-right">{{ $user->name }}</td>
				</tr>
				<tr>
					<th scope="row">Email</th>
					<td class="text-right">{{ $user->email }}</td>
				</tr>
				<tr>
					<th scope="row">Phone</th>
					<td class="text-right">{{ $user->phone }}</td>
				</tr>
				<tr>
					<th scope="row">Address</th>
					<td class="text-right">{{ $user->address }}</td>
				</tr>
			</tbody>
		</table>
		<div class="row mb-4">
			<a href="{{ route('admin.order.verify', $orderDetail->id) }}" class="btn btn-primary btn-block">Verify</a>
		</div>
	</div>
</div>

@endsection