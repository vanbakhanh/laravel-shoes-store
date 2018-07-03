@extends('layouts.dashboard')
@section('title', 'Category Manager')
@section('content')

<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				List of categories
			</div>
			<div class="card-body table-responsive">
				@if (session('delete'))
				<div class="alert alert-dismissible alert-success">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					{{ session('delete') }}
				</div>
				@endif
				@if ($categories->isEmpty())
				<div class="alert alert-dismissible alert-warning">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<h4 class="alert-heading">Warning!</h4>
					<p class="mb-0">There is no category! <a href="{{ route('category.create') }}" class="alert-link">Click here to create new</a>.</p>
				</div>
				@else
				<table id="table" class="table table-hover table-bordered">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Name</th>
							<th scope="col">Description</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody id="myTable">
						@foreach ($categories as $category)
						<tr>
							<th scope='row'>{{ $category->id }}</th>
							<td>{{ $category->name }}</td>
							<td>{{ $category->description }}</td>
							<td>
								{{ Form::open(['method' => 'DELETE', 'route' => ['category.destroy', $category->id]]) }}
								@csrf
								<div class="btn-group btn-group-toggle">
									<a class="btn btn-warning btn-sm" href="{{ route('category.edit', $category->id) }}">Edit</a>
									{{ Form::submit('Delete',['class'=>"btn btn-danger btn-sm"]) }}
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
	} );
</script>

@endsection
