@extends('layouts.dashboard')

@section('title', trans('color.list_title'))

@section('content')

<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				{{ trans('color.list_title') }}
			</div>
			<div class="card-body table-responsive">
				@if (session('delete'))
				<div class="alert alert-dismissible alert-success">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					{{ session('delete') }}
				</div>
				@endif
				@if ($colors->isEmpty())
				<div class="alert alert-dismissible alert-warning">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<p class="mb-0">{{ trans('color.empty') }}</p>
				</div>
				@else
				<table id="table" class="table table-hover table-bordered text-center">
					<thead>
						<tr>
							<th scope="col">{{ trans('color.id') }}</th>
							<th scope="col">{{ trans('color.name') }}</th>
							<th scope="col">{{ trans('color.action') }}</th>
						</tr>
					</thead>
					<tbody id="myTable">
						@foreach ($colors as $color)
						<tr>
							<th scope="row">{{ $color->id }}</th>
							<td>{{ $color->name }}</td>
							<td>
								{{ Form::open(['method' => 'DELETE', 'route' => ['color.destroy', $color->id]]) }}
								<div class="btn-group btn-group-toggle">
									<a class="btn btn-outline-warning btn-sm" href="{{ route('color.edit', $color->id) }}">
										{{ trans('color.edit') }}
									</a>
									{{ Form::submit(trans('color.delete'), ['class' => 'btn btn-outline-danger btn-sm']) }}
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
