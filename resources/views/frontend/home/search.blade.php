@extends('layouts.master')

@section('title', trans('home.branch'))

@section('content')

<div class="col-md-12 text-uppercase text-center mb-4">
	<h3>{{ trans('home.search', ['keyword' => $keyword]) }}</h3>
	<p>{{ trans('home.top_results', ['results' => $results->count()]) }}</p>
</div>
<div class="row">
	@if ($results->isEmpty())
	<div class="col-md-12 text-center"><p>{{ trans('home.empty') }}</p></div>
	@else
	@foreach ($results as $product)
	<div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4">
		<div class="card card-product h-100 text-center">
			<a href="{{ route('product.show', $product->id) }}">
				<img class="card-img-top" src="{{ asset($product->image[0]) }}" alt="{{ $product->name }}">
			</a>
			<div class="card-body">
				<h5 class="card-title m-0 p-0">
					<small>
						<a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
					</small>
				</h5>
				<p class="card-text m-0 p-0">
					{{ count($product->colors) }} {{ trans('home.colors') }} | {{ count($product->sizes) }} {{ trans('home.sizes') }}
				</p>
				<p class="card-text m-0 p-0">${{ $product->price }}</p>
			</div>
		</div>
	</div>
	@endforeach
	@endif
</div>

@endsection
