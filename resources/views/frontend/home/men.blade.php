@extends('layouts.master')
@section('title', $categorySelected->name . ' Shoes')
@section('content')

<div class="row">

	<div class="col-lg-3">
		<h4>Men's</h4>
		<div class="list-group list-group-flush my-4">
			@foreach ($categories as $category)
			<a href="{{ route('category.men', $category->id) }}" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
				{{ $category->name }}
				<span class="badge">{{ App\Models\Product::where('category_id', $category->id)->where('gender', 'male')->count() }}</span>
			</a>
			@endforeach
		</div>
		<h4 class="my-4">Filters</h4>
		<div class="form-group my-4">
			<select class="form-control custom-select">
				<option value="">Color</option>
				@foreach(App\Models\Color::all() as $color)
				<option value="{{ $color->id }}">{{ $color->name }}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group my-4">
			<select class="form-control custom-select">
				<option value="">Price</option>
				<option value="0-100">0-100</option>
				<option value="100-300">100-300</option>
				<option value="300-500">300-500</option>
				<option value="500-1000">500-1000</option>
			</select>
		</div>
		<div class="jumbotron text-center">
			<h5 class="display-5">{{ $categorySelected->name }}</h5>
			<p class="lead">{{ $categorySelected->description }}</p>
		</div>
	</div>

	<div class="col-lg-9">
		<div class="row">
			<div class="col-md-12">
				<h4 class="float-left">Men's {{ $categorySelected->name }} Shoes ({{ $products->count() }})</h4>
				<div class="dropdown float-right">
					<button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Sort by
					</button>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
						<button class="dropdown-item" type="button">Newest</button>
						<button class="dropdown-item" type="button">Oldest</button>
						<button class="dropdown-item" type="button">Price: $$-$</button>
						<button class="dropdown-item" type="button">Price: $-$$</button>
					</div>
				</div>
			</div>
		</div>
		<hr>

		<div class="row">
			@if ($products->isEmpty())
			<div class="col-md-12 text-center"><p>There are no items.</p></div>
			@else
			@foreach ($products as $product)
			<div class="col-lg-3 col-md-4 col-sm-6">
				<div class="card card-product h-100 text-center">
					<a href="{{ route('product.show', $product->id) }}"><img class="card-img-top" src="{{ asset('/images/product/' . $product->image) }}" alt=""></a>
					<div class="card-body">
						<h4 class="card-title"><small><a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a></small></h4>
						<p class="card-text">{{ $product->colors()->count() }} Colors | {{ $product->sizes()->count() }} Sizes</p>
						<p class="card-text">${{ $product->price }}</p>
					</div>
				</div>
			</div>
			@endforeach
			@endif
		</div>
		<div class="d-flex justify-content-center my-4">{{ $products->links() }}</div>
	</div>

</div>

@endsection