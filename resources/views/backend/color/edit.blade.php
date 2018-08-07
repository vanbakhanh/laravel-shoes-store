@extends('layouts.dashboard')
@section('title', trans('color.edit_title'))
@section('content')

{{ Form::open(['route' => ['color.update', $color->id], 'method' => 'PUT', 'class' => 'form-horizontal']) }}
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body col-md-8 offset-md-2">
				<h3 class="card-title">{{ trans('color.edit_title') }}</h3>
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
				<div class="form-group">
					<label>{{ trans('color.name') }}</label>
					{{ Form::text('name', $color->name, ['class' => 'form-control']) }}	
				</div>
				<div class="form-group">
					{{ Form::submit(trans('color.update'), ['class' => 'btn btn-primary']) }}
				</div>
			</div>
		</div>
	</div>
</div>
{{ Form::close() }}

@endsection