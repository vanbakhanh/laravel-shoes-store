@extends('layouts.master')
@section('title', 'Your Cart')
@section('content')

@if (session('status'))
<div class="alert alert-dismissible alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	{{ session('status') }}
</div>
@endif
@if ($errors->any())
@foreach ($errors->all() as $err)
<p class="alert alert-dismissible alert-danger">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	{{ $err }}
</p>
@endforeach
@endif

<div class="card">
	<div class="card-body">
		<h3 class="card-title my-4">Order Details</h3>
		@if (Cart::count() == 0)
		<p class="card-text">There are no items in this cart. <a href="{{ route('home') }}" class="card-link">Continue Shopping now!</a></p>
		@else
		<div class="table-responsive">
			<table class="table table-md table-bordered text-center">
				<thead>
					<tr>
						<th scope="col">Item</th>
						<th scope="col">Size</th>
						<th scope="col">Color</th>
						<th scope="col">Price</th>
						<th scope="col">Quantity</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($items as $item)
					{{ Form::open(['route' => ['cart.update'], 'method' => 'PUT', 'class' => 'form-horizontal']) }}
					@csrf
					<tr>
						<td class="text-left">
							<img src="{{ asset("images/product/" . $item->options->image) }}" width="50" height="50" alt="image" class="mr-2">
							<a href="{{ route('product.show', $item->id) }}">{{ $item->name }}</a>
						</td>
						<td>{{ $item->options->size }}</td>
						<td>{{ $item->options->color }}</td>
						<td>${{ ($item->price) * ($item->qty) }}</td>
						<td>
							{{ Form::hidden('rowId', $item->rowId) }}
							{{ Form::number('qty', $item->qty, ['class' => 'form-control form-control-sm text-center', 'min' => '1', 'max' => '10']) }}
						</td>
						<td>
							<div class="btn-group btn-group-toggle">
								<a href="{{ route('cart.remove', $item->rowId) }}" class="btn btn-warning btn-sm">Remove</a>
								{{ Form::submit('Update', ['class'=>"btn btn-dark btn-sm"]) }}
							</div>
						</td>
					</tr>
					{{ Form::close() }}
					@endforeach
				</tbody>
			</table>
		</div>
		@endif
	</div>
</div>

<br>

<div class="card-deck">
	<div class="card">
		<div class="card-body table-responsive">
			<h3 class="card-title my-4">Shipping Addresss</h3>
			@guest
			<p class="card-text">You are not logged in. <a href="{{ route('login') }}" class="card-link">Login to checkout now!</a></p>
			@else
			<table class="table">
				<tbody>
					<tr>
						<th scope="row">Name</th>
						<td class="text-right">{{ Auth::user()->name }}</td>
					</tr>
					<tr>
						<th scope="row">Email</th>
						<td class="text-right">{{ Auth::user()->email }}</td>
					</tr>
					<tr>
						<th scope="row">Phone</th>
						<td class="text-right">{{ Auth::user()->phone }}</td>
					</tr>
					<tr>
						<th scope="row">Address</th>
						<td class="text-right">{{ Auth::user()->address }}</td>
					</tr>
				</tbody>
			</table>
			<div class="text-right">
				<a href="{{ route('user.edit', Auth::user()->id) }}" class="btn btn-dark">Edit</a>
			</div>
			@endguest
		</div>
	</div>
	<div class="card">
		<div class="card-body table-responsive">
			<h3 class="card-title my-4">Total Summary</h3>
			<table class="table">
				<tbody>
					<tr>
						<th scope="row">Items on Cart</th>
						<td class="text-right">{{ Cart::count() }}</td>
					</tr>
					<tr>
						<th scope="row">Sub Total</th>
						<td class="text-right">${{ Cart::subTotal() }}</td>
					</tr>
					<tr>
						<th scope="row">Tax</th>
						<td class="text-right">${{ Cart::Tax() }}</td>
					</tr>
					<tr>
						<th scope="row">Total</th>
						<td class="text-right">${{ Cart::total() }}</td>
					</tr>
				</tbody>
			</table>
			<div class="text-right">
				@if (Cart::count() == 0)
				@else
				<a href="{{ route('checkout') }}" class="btn btn-dark">Checkout</a>
				@endif
			</div>
		</div>
	</div>
</div>

@endsection