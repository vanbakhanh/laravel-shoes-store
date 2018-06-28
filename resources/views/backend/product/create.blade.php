@extends('layouts.dashboard')
@section('title', 'Create Product')
@section('content')

{{ Form::open(['route' => ['product.store'], 'files' => true, 'method' => 'POST', 'class' => 'form-horizontal']) }}
@csrf
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body col-md-8 offset-md-2">
				<h3 class="card-title my-4">New product</h3>
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
					{{ Form::text('name', '', ['class' => 'form-control']) }}	
				</div>
				<div class="form-group">
					<label>Description</label>
					{{ Form::textarea('description', '', ['class' => 'form-control', 'maxlength' => '255', 'rows' => '1']) }}
				</div>
				<div class="form-group">
					<label>Gender</label>
					<select class="form-control" name="gender">
						<option value="male">Male</option>
						<option value="female">Female</option>
					</select>
				</div>
				<div class="form-group">
					<label>Price</label>
					{{ Form::number('price', '', ['class' => 'form-control']) }}
				</div>
				<div class="form-group">
					<label>Color</label>
					{{ Form::select('color[]', $colors, '', ['class' => 'form-control', 'multiple']) }}	
				</div>
				<div class="form-group">
					<label>Size</label>
					{{ Form::select('size[]', $sizes, '', ['class' => 'form-control','multiple']) }}	
				</div>
				<div class="form-group">
					<label>Category</label>
					<select class="form-control" id="category" name="category">
						@foreach ($categories as $category)
						<option value="{{ $category->id }}">
							{{ $category->name }}
						</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label>Image</label>
					{{ Form::file('image', ['class' => 'form-control-file']) }}
				</div>

				<div class="form-group">
					{{ Form::submit('Create', ['class' => 'btn btn-dark']) }}
				</div>
			</div>
		</div>
	</div>
</div>
{{ Form::close() }}

@endsection