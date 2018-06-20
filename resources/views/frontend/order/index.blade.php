@extends('layouts.master')
@section('title', 'Your Order')

@section('content')

<div class="row">
	<div class="col-md-3">
		<h4 class="my-4">My Orders ({{ $orders->count() }})</h4>
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
				<h4 class="float-left my-4">Recent Orders</h4>
				<h4 class="float-right my-4">{{ $orders->first()['status'] }}</h4>
			</div>
		</div>
		<table class="table table-hover table-md table-bordered text-center table-light">
			<thead>
				<tr>
					<th scope="col">Order#</th>
					<th scope="col">Image</th>
					<th scope="col">Item</th>
					<th scope="col">Quantity</th>
					<th scope="col">Total</th>
				</tr>
			</thead>
			<tbody>
				@if ($orders->count() > 0)
				@foreach ($orders->first()->products as $orderProduct)
				<tr>
					<th scope="row"><a href="{{ route('order.detail', $orderProduct->pivot->order_id) }}">{{ $orderProduct->pivot->order_id }}</a></th>
					<th>
						<img src="{{ asset("images/product/" . $orderProduct->image) }}" width="50" height="50">
					</th>
					<td><a href="{!! route('product.show',$orderProduct->pivot->product_id) !!}">
						{{$orderProduct->name }}</a>
					</td>
					<td>{{ $orderProduct->pivot->qty }}</td>
					<td>${{ $orderProduct->pivot->total }}</td>
				</tr>
				@endforeach
				@else
				@endif
			</tbody>
		</table>
	</div>
</div>

@endsection