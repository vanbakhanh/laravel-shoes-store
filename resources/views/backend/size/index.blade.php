@extends('layouts.dashboard')
@section('title', 'Size Manager')
@section('content')

<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				List of sizes
			</div>
			<div class="card-body table-responsive">
				@if (session('delete'))
				<div class="alert alert-dismissible alert-success">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					{{ session('delete') }}
				</div>
				@endif
				@if ($sizes->isEmpty())
				<div class="alert alert-dismissible alert-warning">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<h4 class="alert-heading">Warning!</h4>
					<p class="mb-0">There is no size.</p>
				</div>
				@else
				<table id="table" class="table table-hover table-bordered text-center">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Name</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody id="myTable">
						@foreach ($sizes as $size)
						<tr>
							<th scope="row">{{ $size->id }}</th>
							<td>{{ $size->name }}</td>
							<td>
								{{ Form::open(['method' => 'DELETE', 'route' => ['size.destroy', $size->id]]) }}
								@csrf
								<div class="btn-group btn-group-toggle">
									<a class="btn btn-warning btn-sm" href="{{ route('size.edit', $size->id) }}">Edit</a>
									{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
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
