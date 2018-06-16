@extends('layouts.dashboard')
@section('title', 'Create Product')
@section('content')

{{ Form::open(['action' => ['Admin\ProductController@store'], 'files' => true, 'method' => 'POST', 'class' => 'form-horizontal']) }}
@csrf
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				New product
			</div>
			<div class="card-body">
				<div class="col-md-12">
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
				</div>
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Name</label>
					<div class="col-md-6">
						{{ Form::text('name', '', ['class' => 'form-control']) }}	
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Description</label>
					<div class="col-md-6">
						{{ Form::textarea('description', '', ['class' => 'form-control', 'maxlength' => '255', 'rows' => '3']) }}
					</div>	
				</div>
				<div class="form-group row">
					<label for="gender" class="col-md-4 col-form-label text-md-right">Gender</label>
					<div class="col-md-6">
						<select class="form-control" name="gender">
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Price</label>
					<div class="col-md-6">
						{{ Form::number('price', '', ['class' => 'form-control']) }}
					</div>	
				</div>
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Color</label>
					<div class="col-md-6">
						{{ Form::select('color[]', $colors, '', ['class' => 'form-control', 'multiple']) }}	
					</div>	
				</div>
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Size</label>
					<div class="col-md-6">
						{{ Form::select('size[]', $sizes, '', ['class' => 'form-control','multiple']) }}	
					</div>	
				</div>
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Category</label>
					<div class="col-md-6">
						<select class="form-control" id="category" name="category">
							@foreach ($categories as $category)
							<option value="{{ $category->id }}">
								{{ $category->name }}
							</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Image</label>
					<div class="col-md-6">
						{{ Form::file('image', ['class' => 'form-control']) }}
					</div>	
				</div>

				<div class="form-group row mb-0">
					<div class="col-md-6 offset-md-4">
						{{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{{ Form::close() }}

@endsection