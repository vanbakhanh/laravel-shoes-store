@extends('layouts.master')

@section('title', trans('cart.cart'))

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
		<h3 class="card-title">{{ trans('cart.detail') }}</h3>
		@if (Cart::count() == 0)
		<p class="card-text">{{ trans('cart.empty') }} <a href="{{ route('home') }}" class="card-link">{{ trans('cart.shopping') }}</a></p>
		@else
		<div class="table-responsive">
			<table class="table table-bordered text-center">
				<thead>
					<tr>
						<th scope="col">{{ trans('cart.item') }}</th>
						<th scope="col">{{ trans('cart.size') }}</th>
						<th scope="col">{{ trans('cart.color') }}</th>
						<th scope="col">{{ trans('cart.price') }}</th>
						<th scope="col">{{ trans('cart.quantity') }}</th>
						<th scope="col">{{ trans('cart.action') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($items as $item)
					{{ Form::open(['class' => 'form-horizontal']) }}
					<tr>
						<td class="text-left">
							<img src="{{ asset($item->options->image[0]) }}" width="50" height="50" alt="Image" class="mr-2">
							<a href="{{ route('product.show', $item->id) }}">{{ $item->name }}</a>
						</td>
						<td>{{ $item->options->size }}</td>
						<td>{{ $item->options->color }}</td>
						<td>${{ ($item->price) * ($item->qty) }}</td>
						<td>
							{{ Form::hidden('rowId', $item->rowId, ['id' => 'rowId' . $item->id]) }}
							{{ Form::number('qty', $item->qty, ['class' => 'form-control form-control-sm text-center', 'min' => '1', 'max' => '10', 'id' => 'qty' . $item->id]) }}
						</td>
						<td>
							<button type="button" class="close float-none" aria-label="Close" id="remove{{ $item->id }}">
								<span aria-hidden="true">&times;</span>
							</button>
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
			<h3 class="card-title">{{ trans('cart.ship_address') }}</h3>
			@guest
			<p class="card-text">{{ trans('cart.logged_in') }} <a href="{{ route('login') }}" class="card-link">{{ trans('cart.login') }}</a></p>
			@else
			<table class="table">
				<tbody>
					<tr>
						<th scope="row">{{ trans('cart.name') }}</th>
						<td class="text-right">{{ Auth::user()->name }}</td>
					</tr>
					<tr>
						<th scope="row">{{ trans('cart.email') }}</th>
						<td class="text-right">{{ Auth::user()->email }}</td>
					</tr>
					<tr>
						<th scope="row">{{ trans('cart.phone') }}</th>
						<td class="text-right">{{ Auth::user()->phone }}</td>
					</tr>
					<tr>
						<th scope="row">{{ trans('cart.address') }}</th>
						<td class="text-right">{{ Auth::user()->address }}</td>
					</tr>
				</tbody>
			</table>
			<div class="text-right">
				<a href="{{ route('user.edit', Auth::user()->id) }}" class="btn btn-primary">{{ trans('cart.edit') }}</a>
			</div>
			@endguest
		</div>
	</div>
	<div class="card">
		<div class="card-body table-responsive">
			<h3 class="card-title">{{ trans('cart.payment') }}</h3>
			<table class="table">
				<tbody>
					<tr>
						<th scope="row">{{ trans('cart.items_on_cart') }}</th>
						<td class="text-right">{{ Cart::count() }}</td>
					</tr>
					<tr>
						<th scope="row">{{ trans('cart.sub_total') }}</th>
						<td class="text-right">${{ Cart::subTotal() }}</td>
					</tr>
					<tr>
						<th scope="row">{{ trans('cart.tax') }}</th>
						<td class="text-right">${{ Cart::Tax() }}</td>
					</tr>
					<tr>
						<th scope="row">{{ trans('cart.total') }}</th>
						<td class="text-right">${{ Cart::total() }}</td>
					</tr>
				</tbody>
			</table>
			<div class="text-right">
				@if (Cart::count() == 0)
				@else
				<a href="{{ route('checkout') }}" class="btn btn-primary">{{ trans('cart.checkout') }}</a>
				@endif
			</div>
		</div>
	</div>
</div>
<!-- Remove item using Ajax -->
<script type="text/javascript">
	jQuery(document).ready(function() {
		@foreach ($items as $item)
		jQuery('#remove{{ $item->id }}').click(function(e) {
			e.preventDefault();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			jQuery.ajax({
				url: "{{ route('cart.remove', $item->rowId) }}",
				method: 'POST',
				data: { _method: 'DELETE' },
				success: function() {
					location.reload();
				},
			});
		});
		@endforeach
	});
</script>
<!-- Update item using Ajax -->
<script type="text/javascript">
	jQuery(document).ready(function() {
		@foreach ($items as $item)
		jQuery('#qty{{ $item->id }}').change(function(e) {
			e.preventDefault();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			jQuery.ajax({
				url: "{{ route('cart.update') }}",
				method: 'POST',
				data: {
					_method: 'PUT',
					rowId: jQuery('#rowId{{ $item->id }}').val(),
					qty: jQuery('#qty{{ $item->id }}').val(),
				},
				success: function() {
					location.reload();
				},
			});
		});
		@endforeach
	});
</script>

@endsection
