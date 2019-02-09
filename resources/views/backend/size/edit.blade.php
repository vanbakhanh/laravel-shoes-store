@extends('layouts.dashboard')

@section('title', trans('size.edit_title'))

@section('content')

{{ Form::open(['route' => ['size.update', $size->id], 'method' => 'PUT', 'class' => 'form-horizontal']) }}
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body col-md-8 offset-md-2">
				<h3 class="card-title">{{ trans('size.edit_title') }}</h3>
				<div class="form-group">
					<label>{{ trans('size.name') }}</label>
					{{ Form::text('name', $size->name, ['class' => 'form-control']) }}	
				</div>
				<div class="form-group">
					{{ Form::submit(trans('size.update'), ['class' => 'btn btn-primary']) }}
				</div>
			</div>
		</div>
	</div>
</div>
{{ Form::close() }}

@endsection