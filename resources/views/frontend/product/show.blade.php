@extends('layouts.master')
@section('title', 'Nike ' . $productSelected->name)
@section('content')

<!-- Portfolio Item Row -->
<div class="row">
	<div class="col-md-6">
		<img class="img-fluid mw-100" src="{{ asset('/images/product/' . $productSelected->image) }}">
	</div>
	<div class="col-md-6 text-center">
		<p class="my-4">
			@if ($productSelected->gender == 'male') Men's @else Women's @endif 
			{{ $categorySelected->name }} Shoes
		</p>
		<h4 class="my-2">{{ $productSelected->name }}</h4>
		<h4 class="my-4">$<b>{{ $productSelected->price }}</b></h4>
		<hr>

		{{ Form::open(['action' => ['Admin\CartController@addItem'], 'method' => 'POST', 'class' => 'form-horizontal']) }}
		@csrf
		<div class="form-group row">
			<label class="col-md-6 col-form-label"><b>COLOR</b></label>
			<div class="col-md-6">
				<select class="form-control custom-select" name="color">
					@foreach ($productSelected->colors()->pluck('name')->sort() as $color)
					<option value="{{ $color }}">
						{{ $color }}
					</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-6 col-form-label"><b>SIZE</b></label>
			<div class="col-md-6">
				<select class="form-control custom-select" name="size">
					@foreach ($productSelected->sizes()->pluck('name')->sort() as $size)
					<option value="{{ $size }}">
						{{ $size }}
					</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-6 col-form-label"><b>QUANTITY</b></label>
			<div class="col-md-6">
				{{ Form::number('qty', 1, ['class' => 'form-control form-control-sm', 'min' => '1', 'max' => '10']) }}
			</div>
		</div>
		<div class="form-group row mb-0">
			<div class="col-md-12">
				{{ Form::hidden('productId', $productSelected->id) }}
				{{ Form::submit('Add to cart',['class'=>'btn btn-primary btn-block']) }}
			</div>
		</div>
		{{ Form::close() }}
		<p class="my-4">{{ $productSelected->description }}</p>
	</div>
</div>

<!-- Category Description -->
<div class="jumbotron text-center mt-4">
	<h4 class="display-5">{{ $categorySelected->name }}</h4>
	<p class="lead">{{ $categorySelected->description }}</p>
	<p class="lead">
		@if ($productSelected->gender == 'male')
		<a class="btn btn-link" href="{{ route('category.men', $productSelected->category_id) }}" role="button">See more</a>
		@else 
		<a class="btn btn-link" href="{{ route('category.women', $productSelected->category_id) }}" role="button">See more</a>
		@endif 
	</p>
</div>
<hr>

<!-- Related Projects Row -->
<div class="row">
	<div class="col-md-12 my-4 text-center">
		<h4>YOU MIGHT ALSO LIKE</h4>
	</div>
</div>
<div class="row">
	@foreach ($products as $product)
	<div class="col-md-3 col-sm-6 mb-4">
		<div class="card card-product h-100 text-center">
			<a href="{{ route('product.show', $product->id) }}"><img class="card-img-top" src="{{ asset('/images/product/' . $product->image) }}" alt=""></a>
			<div class="card-body">
				<p class="card-title"><a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a></p>
				<p class="card-text">{{ $product->colors()->count() }} Colors | {{ $product->sizes()->count() }} Sizes</p>
				<p class="card-text">${{ $product->price }}</p>
			</div>
		</div>
	</div>
	@endforeach
</div>
<hr>

<!-- Comments -->
<div class="row">
	<div class="col-md-12 my-4 text-center">
		<h4>Customer Reviews</h4>
	</div>
</div>

@guest
<div class="alert alert-dismissible alert-primary">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>You are not logged in! </strong> <a href="{{ route('login') }}" class="alert-link">Login</a> and try review again.
</div>
@else
{{ Form::open(['route' => ['comment.store']]) }}
@csrf
{{ Form::hidden('product_id', $productSelected->id) }}
<div class="form-group">
	{{ Form::textarea('content', '', ['placeholder' => 'Write a review...', 'class' => 'form-control', 'rows'=>'1', 'cols'=>'1', 'maxlength' => '255']) }}
</div>
<div class="form-group">
	{{ Form::submit('Review', ['class' => 'btn btn-primary btn-block']) }}
</div>
{{ Form::close() }}
@endguest

<div class="list-group">
	@foreach ($comments as $cmt)
	<div class="list-group-item flex-column align-items-start">
		<div class="d-flex w-100 justify-content-between">
			<h5 class="mb-1">{{ App\Models\User::find($cmt->user_id)->name }}</h5>
			<small class="text-muted">Joined at {{ App\Models\User::findOrFail($cmt->user_id)->created_at }}</small>
		</div>
		<p class="mb-1">{{ $cmt->content }}</p>
		<small class="text-muted">{{ $cmt->created_at->diffForHumans() }}</small>
	</div>
	@endforeach
</div>
<!-- /.Comments -->

@endsection