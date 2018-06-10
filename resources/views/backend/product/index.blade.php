@extends('layouts.dashboard')
@section('title', 'Product Manager')
@section('content')

<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				List of products
			</div>
			<div class="card-body table-responsive">
				@if (session('delete'))
				<div class="alert alert-dismissible alert-success">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					{{ session('delete') }}
				</div>
				@endif
				@if ($products->isEmpty())
				<div class="alert alert-dismissible alert-warning">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<h4 class="alert-heading">Warning!</h4>
					<p class="mb-0">There is no product! <a href="{{ route('product.create') }}" class="alert-link">Click here to create new</a>.</p>
				</div>
				@else
				<table id="example" class="table table-hover table-md text-center table-bordered">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Name</th>
							<th scope="col">Description</th>
							<th scope="col">Gender</th>
							<th scope="col">Price</th>
							<th scope="col">Image</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($products as $product)
						<tr>
							<th scope="row">{{ $product->id }}</th>
							<td><a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a></td>
							<td>{{ $product->description }}</td>
							<td>{{ $product->gender }}</td>
							<td>${{ $product->price }}</td>
							<td>{{ $product->image }}</td>
							<td>
								<div class="btn-group btn-group-toggle">
									<a class="btn btn-warning btn-sm" href="{{ route('product.edit', $product->id) }}">Edit</a>
									{{ Form::open(['method' => 'DELETE', 'route' => ['product.destroy', $product->id]]) }}
									@csrf
									{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
									{{ Form::close() }}
								</div>
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
		$('#example').DataTable();
	} );
</script>

@endsection
