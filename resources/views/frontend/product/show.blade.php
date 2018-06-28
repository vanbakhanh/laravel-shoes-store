@extends('layouts.master')
@section('title', 'Nike ' . $productSelected->name)
@section('content')

<!-- Portfolio Item Row -->
<div class="row">
	<div class="col-md-6">
		<img class="img-fluid mw-100" src="{{ asset('images/product/' . $productSelected->image) }}">
	</div>
	<div class="col-md-6 text-center">
		<p class="mt-2 mb-4">
			@if ($productSelected->gender == 'male') Men's @else Women's @endif 
			{{ $categorySelected->name }} Shoes
		</p>
		<h3 class="my-2 text-uppercase">{{ $productSelected->name }}</h3>
		<h3 class="my-4">$<b>{{ $productSelected->price }}</b></h3>

		{{ Form::open(['class' => 'form-horizontal']) }}
		@csrf
		<div class="form-group row">
			<label class="col-md-6 col-form-label text-uppercase"><b>COLOR</b></label>
			<div class="col-md-6">
				<select class="form-control" name="color">
					@foreach ($productSelected->colors()->pluck('name')->sort() as $color)
					<option value="{{ $color }}" id="color">
						{{ $color }}
					</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-6 col-form-label text-uppercase"><b>SIZE</b></label>
			<div class="col-md-6">
				<select class="form-control" name="size">
					@foreach ($productSelected->sizes()->pluck('name')->sort() as $size)
					<option value="{{ $size }}" id="size">
						{{ $size }}
					</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-6 col-form-label text-uppercase"><b>QUANTITY</b></label>
			<div class="col-md-6">
				{{ Form::number('qty', 1, ['id' => 'qty', 'class' => 'form-control', 'min' => '1', 'max' => '10']) }}
			</div>
		</div>
		<div class="form-group row mb-0">
			<div class="col-md-12">
				{{ Form::hidden('productId', $productSelected->id, ['id' => 'productId']) }}
				{{ Form::submit('Add', ['class' => 'btn btn-dark btn-block', 'id' => 'addToCart']) }}
			</div>
		</div>
		{{ Form::close() }}
		<div class="my-4">
			<p>{{ $productSelected->description }}</p>
			<a class="text-uppercase" href="#comment">Read {{ $comments->count() }} reviews</a>
		</div>
	</div>
</div>

<br>

<!-- Related Projects Row -->
<div class="row">
	<div class="col-md-12 my-4 text-center">
		<h3 class="text-uppercase">You might also like</h3>
	</div>
</div>
<div class="row">
	@foreach ($products as $product)
	<div class="col mb-4">
		<div class="card card-product h-100 text-center">
			<a href="{{ route('product.show', $product->id) }}">
				<img class="card-img-top" src="{{ asset('images/product/' . $product->image) }}" alt="">
			</a>
			<div class="card-body">
				<h5 class="card-title m-0 p-0">
					<small>
						<a class="text-dark" href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
					</small>
				</h5>
				<p class="card-text m-0 p-0">{{ $product->colors()->count() }} Colors | {{ $product->sizes()->count() }} Sizes</p>
				<p class="card-text m-0 p-0">${{ $product->price }}</p>
			</div>
		</div>
	</div>
	@endforeach
</div>

<br>

<!-- Comments -->
<div class="row">
	<div class="col-md-12 my-4 text-center">
		<h3 class="text-uppercase">Customer reviews</h3>
	</div>
</div>

<div class="list-group my-4" id="comment">
	<div class="list-group-item flex-column align-items-start">
		@if ($comments->isNotEmpty())
		@foreach ($comments as $cmt)
		<div class="d-flex w-100 justify-content-between">
			<h5 class="my-2 text-dark">{{ $cmt->user->name }}
				<small class="text-muted pl-1">{{ $cmt->created_at->diffForHumans() }}</small>
			</h5>
		</div>
		<p class="mb-2">{{ $cmt->content }}</p>
		@endforeach
		@else
		<p class="text-center p-0 m-0">No review</p>
		@endif
	</div>
</div>

@guest
<div class="alert alert-dismissible alert-dark">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>You are not logged in! </strong> <a href="{{ route('login') }}" class="alert-link">Login</a> and try review again.
</div>
@else
<div class="list-group my-4">
	<div class="list-group-item">
		{{ Form::open(['route' => ['comment.store']]) }}
		@csrf
		{{ Form::hidden('product_id', $productSelected->id) }}
		<div class="form-group">
			{{ Form::textarea('content', '', ['placeholder' => 'Write a review...', 'class' => 'form-control', 'rows'=>'1', 'cols'=>'1', 'maxlength' => '255']) }}
		</div>
		{{ Form::submit('Review', ['class' => 'btn btn-dark btn-block']) }}
		{{ Form::close() }}
	</div>
</div>
@endguest

<br>

<!-- Category Description -->
<div class="text-center my-4">
	<h3 class="display-5 text-uppercase">{{ $categorySelected->name }}</h3>
	<p class="lead">{{ $categorySelected->description }}</p>
	<p class="lead">
		@if ($productSelected->gender == 'male')
		<a class="btn btn-link" href="{{ route('category.men', $productSelected->category_id) }}" role="button">See more</a>
		@else 
		<a class="btn btn-link" href="{{ route('category.women', $productSelected->category_id) }}" role="button">See more</a>
		@endif 
	</p>
</div>

<!-- Script -->
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#addToCart').click(function(e) {
			e.preventDefault();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			jQuery.ajax({
				url: "{{ url('/cart/add') }}",
				method: 'POST',
				data: {
					color: jQuery('#color').val(),
					size: jQuery('#size').val(),
					qty: jQuery('#qty').val(),
					productId: jQuery('#productId').val(),
				},
			});
		});
	});
</script>

@endsection