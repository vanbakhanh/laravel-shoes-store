@extends('layouts.dashboard')

@section('title', trans('product.list_title'))

@section('content')

<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body table-responsive">
				<h3 class="card-title">{{ trans('product.list_title') }}</h3>
				@if ($products->isEmpty())
				<div class="alert alert-dismissible alert-warning">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<p class="mb-0">{{ trans('product.empty') }}</p>
				</div>
				@else
				<table id="table" class="table table-hover table-bordered text-center">
					<thead>
						<tr>
							<th scope="col">{{ trans('product.id') }}</th>
							<th scope="col">{{ trans('product.name') }}</th>
							<th scope="col">{{ trans('product.description') }}</th>
							<th scope="col">{{ trans('product.gender') }}</th>
							<th scope="col">{{ trans('product.price') }}</th>
							<th scope="col">{{ trans('product.action') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($products as $product)
						<tr>
							<th scope="row">{{ $product->id }}</th>
							<td><a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a></td>
							<td class="text-left">{{ $product->description }}</td>
							<td>{{ $product->gender }}</td>
							<td>${{ $product->price }}</td>
							<td>
								{{ Form::open(['method' => 'DELETE', 'route' => ['product.destroy', $product->id]]) }}
								<div class="btn-group btn-group-toggle">
									<a class="btn btn-outline-warning btn-sm" href="{{ route('product.edit', $product->id) }}">
										{{ trans('product.edit') }}
									</a>
									{{ Form::submit(trans('product.delete'), ['class' => 'btn btn-outline-danger btn-sm']) }}
								</div>
								{{ Form::close() }}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@endif
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#table').DataTable();
	});
</script>

@endsection
