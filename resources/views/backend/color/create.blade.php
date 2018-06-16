@extends('layouts.dashboard')
@section('title','Create Color')
@section('content')

{{ Form::open(['action' => ['Admin\ColorController@store'], 'method' => 'POST', 'class' => 'form-horizontal']) }}
@csrf
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				New color
			</div>
			<div class="card-body">
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Name</label>
					<div class="col-md-6">
						{{ Form::text('name', '', ['class'=>'form-control']) }}	
					</div>
				</div>
				<div class="form-group row mb-0">
					<div class="col-md-6 offset-md-4">
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
						{{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{{ Form::close() }}

<div class="row justify-content-center">
	<div class="col-md-12 mt-4">
		<div class="card">
			<div class="card-header">
				Lists of colors
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
					<h4 class="alert-heading">Warning!</h4>
					<p class="mb-0">There is no color! <a href="{{ route('color.create') }}" class="alert-link">Click here to create new</a>.</p>
				</div>
				@else
				<table id="table" class="table table-hover table-md table-bordered text-center">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Name</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody id="myTable">
						@foreach ($colors as $color)
						<tr>
							<th scope="row">{{ $color->id }}</th>
							<td>{{ $color->name }}</td>
							<td>
								<div class="btn-group btn-group-toggle">
									<a class="btn btn-warning btn-sm" href="{{ route('color.edit', $color->id) }}">Edit</a>
									{{ Form::open(['method' => 'DELETE', 'route' => ['color.destroy', $color->id]]) }}
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
		$('#table').DataTable();
	} );
</script>

@endsection