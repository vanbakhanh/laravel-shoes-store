@extends('layouts.dashboard')
@section('title', 'Edit Category')
@section('content')

{{ Form::open(['route' => ['category.update', $category->id], 'method' => 'PUT', 'class' => 'form-horizontal']) }}
@csrf
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body col-md-8 offset-md-2">
				<h3 class="card-title my-4">Edit category</h3>
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
					<label>Name</label>
					{{ Form::text('name', $category->name, ['class' => 'form-control']) }}	
				</div>
				<div class="form-group">
					<label>Description</label>
					{{ Form::textarea('description', $category->description, ['class' => 'form-control', 'maxlength' => '255', 'rows' => '3']) }}
				</div>	
				<div class="form-group">
					{{ Form::submit('Update', ['class' => 'btn btn-primary' ]) }}
				</div>
			</div>
		</div>
	</div>
</div>
{{ Form::close() }}

@endsection