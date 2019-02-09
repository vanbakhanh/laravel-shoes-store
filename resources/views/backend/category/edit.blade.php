@extends('layouts.dashboard')

@section('title', trans('category.edit_title'))

@section('content')

{{ Form::open(['route' => ['category.update', $category->id], 'method' => 'PUT', 'class' => 'form-horizontal']) }}
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body col-md-8 offset-md-2">
				<h3 class="card-title">{{ trans('category.edit_title') }}</h3>
				<div class="form-group">
					<label>{{ trans('category.name') }}</label>
					{{ Form::text('name', $category->name, ['class' => 'form-control']) }}	
				</div>
				<div class="form-group">
					<label>{{ trans('category.description') }}</label>
					{{ Form::textarea('description', $category->description, ['class' => 'form-control', 'rows' => '3']) }}
				</div>	
				<div class="form-group">
					{{ Form::submit(trans('category.update'), ['class' => 'btn btn-primary' ]) }}
				</div>
			</div>
		</div>
	</div>
</div>
{{ Form::close() }}

@endsection