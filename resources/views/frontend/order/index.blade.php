@extends('layouts.master')
@section('title', 'Your Order')

@section('content')

<div class="row">
	<div class="col-md-3">
		<h3 class="my-4">My Orders ({{ $orders->count() }})</h3>
		<div class="list-group list-group-flush">
			@foreach($orders as $order)
			<a href="{{ route('order.detail', $order->id) }}" class="list-group-item list-group-item-action">
				{{ $order->created_at }} - Order {{ $order->id }}
			</a>
			@endforeach
		</div>	
	</div>
	<div class="col-md-9 table-responsive">
		<div class="row">
			<div class="col-md-12">
				<h3 class="float-left my-4">Recent Orders</h3>
				@if ($orderDetail == null)
				@else
				<h3 class="float-right my-4">{{ $orderDetail->status }}</h3>
				@endif
			</div>
		</div>
		@if ($orderDetail == null)
		<p>There are no orders.</p>
		@else
		<table class="table table-md table-bordered text-center">
			<thead>
				<tr>
					<th scope="col">Item</th>
					<th scope="col">Total</th>
					<th scope="col">Quantity</th>
					<th scope="col">Order#</th>
				</tr>
			</thead>
			<tbody>
				
				@foreach ($orderDetail->products as $orderProduct)
				<tr>
					<td class="text-left">
						<img src="{{ asset("images/product/" . $orderProduct->image) }}" width="50" height="50" alt="image" class="mr-2">
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
			</tbody>
		</table>
		@endforeach
		@endif
	</div>
</div>

@endsection