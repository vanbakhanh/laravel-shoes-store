@extends('layouts.master')
@section('title', $categorySelected->name . ' Shoes')
@section('content')

<div class="row">

	<div class="col-lg-3">
		<h3 class="my-4">Men's</h3>
		<div class="list-group list-group-flush">
			@foreach ($categories as $category)
			<a href="{{ route('category.men', $category->id) }}" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
				{{ $category->name }}
				<span class="badge">{{ App\Models\Product::where('category_id', $category->id)->where('gender', 'male')->count() }}</span>
			</a>
			@endforeach
		</div>
		<br>
		<div class="jumbotron text-center">
			<h5 class="display-5">{{ $categorySelected->name }}</h5>
			<p class="lead">{{ $categorySelected->description }}</p>
		</div>
	</div>

	<div class="col-lg-9">
		<div class="row">
			<div class="col-md-12">
				<h3 class="float-left my-4">Men's {{ $categorySelected->name }} Shoes ({{ $products->count() }})</h3>
				<div class="dropdown float-right my-4">
					<button class="btn btn-sm btn-dark dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

		<div class="row">
			@if ($products->isEmpty())
			<div class="col-md-12 text-center"><p>There are no items.</p></div>
			@else
			@foreach ($products as $product)
			<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
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
			@endif
		</div>
		<div class="d-flex justify-content-center my-4">{{ $products->links() }}</div>
	</div>

</div>

@endsection