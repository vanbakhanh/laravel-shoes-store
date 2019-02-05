@extends('layouts.dashboard')

@section('title', trans('color.new_title'))

@section('content')

{{ Form::open(['route' => ['color.store'], 'method' => 'POST', 'class' => 'form-horizontal']) }}
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body col-md-8 offset-md-2">
				<h3 class="card-title">{{ trans('color.new_title') }}</h3>
				@if (session('status'))
				<div class="alert alert-dismissible alert-success">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					{{ session('status') }}
				</div>
				@endif
				@if ($errors->any())
				@foreach($errors->all() as $err)
				<p class="alert alert-dismissible alert-danger">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					{{ $err }}
				</p>
				@endforeach
				@endif
				<div class="form-group">
					<label>{{ trans('color.name') }}</label>
					{{ Form::text('name', '', ['class' => 'form-control']) }}	
				</div>
				<div class="form-group">
					{{ Form::submit(trans('color.create'), ['class' => 'btn btn-primary']) }}
				</div>
			</div>
		</div>
	</div>
</div>
{{ Form::close() }}
<div class="row justify-content-center">
	<div class="col-md-12 mt-4">
		<div class="card">
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