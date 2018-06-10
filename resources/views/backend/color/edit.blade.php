@extends('layouts.dashboard')
@section('title', 'Edit Color')
@section('content')

{{ Form::open(['action' => ['Admin\ColorController@update', $color->id], 'method' => 'PUT', 'class' => 'form-horizontal']) }}
@csrf
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				Edit color
			</div>
			<div class="card-body">
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Name</label>
					<div class="col-md-6">
						{{ Form::text('name', $color->name, ['class'=>'form-control']) }}	
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
						@foreach ($errors->all() as $err)
						<p class="alert alert-dismissible alert-danger">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							{{ $err }}
						</p>
						@endforeach
						@endif
						{{ Form::submit('Update', ['class'=>'btn btn-primary']) }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{{ Form::close() }}

@endsection