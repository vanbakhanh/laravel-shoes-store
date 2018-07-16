@extends('layouts.dashboard')
@section('title', trans('category.list_title'))
@section('content')

<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				{{ trans('category.list_title') }}
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
					<p class="mb-0">{{ trans('category.empty') }}</p>
				</div>
				@else
				<table id="table" class="table table-hover table-bordered text-center">
					<thead>
						<tr>
							<th scope="col">{{ trans('category.id') }}</th>
							<th scope="col">{{ trans('category.name') }}</th>
							<th scope="col">{{ trans('category.description') }}</th>
							<th scope="col">{{ trans('category.action') }}</th>
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
									<a class="btn btn-outline-warning btn-sm" href="{{ route('category.edit', $category->id) }}">
										{{ trans('category.edit') }}
									</a>
									{{ Form::submit(trans('category.delete'), ['class'=>"btn btn-outline-danger btn-sm"]) }}
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
