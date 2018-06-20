@extends('layouts.dashboard')
@section('title', 'Edit Product')
@section('content')

{{ Form::open(['action' => ['Admin\ProductController@update', $product->id], 'files' => true, 'method' => 'PUT', 'class' => 'form-horizontal']) }}
@csrf
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				Edit product
			</div>
			<div class="card-body">
				<div class="form-group row">
					<div class="col-md-12">
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
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Name</label>
					<div class="col-md-6">
						{{ Form::text('name', $product->name, ['class' => 'form-control']) }}	
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Description</label>
					<div class="col-md-6">
						{{ Form::textarea('description', $product->description, ['class' => 'form-control', 'maxlength' => '255', 'rows' => '3']) }}
					</div>	
				</div>
				<div class="form-group row">
                    <label for="gender" class="col-md-4 col-form-label text-md-right">Gender</label>
                    <div class="col-md-6">
                        <select class="form-control" name="gender" value="{{ $product->gender }}">
                          <option @if ($product->gender == 'male') selected="selected" @endif value="male">Male</option>
                          <option @if ($product->gender == 'female') selected="selected" @endif value="female">Female</option>
                        </select>
                    </div>
                </div>
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Price</label>
					<div class="col-md-6">
						{{ Form::number('price', $product->price, ['class' => 'form-control']) }}
					</div>	
				</div>
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Color</label>
					<div class="col-md-6">
						<select class="form-control" id="color" name="color[]" multiple>
							@foreach ($colors as $color)
							<option value="{{ $color->id }}" @if(in_array($color->id, $selectedColors)) selected="selected" @endif>
								{{ $color->name }}
							</option>
							@endforeach
						</select>	
					</div>	
				</div>
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Size</label>
					<div class="col-md-6">
						<select class="form-control" id="size" name="size[]" multiple>
							@foreach ($sizes as $size)
							<option value="{{ $size->id }}" @if(in_array($size->id, $selectedSizes)) selected="selected" @endif>
								{{ $size->name }}
							</option>
							@endforeach
						</select>	
					</div>	
				</div>
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Category</label>
					<div class="col-md-6">
						<select class="form-control" id="categoryId" name="category_id">
							@foreach ($categories as $category)
							<option value="{{ $category->id }}" @if ($category->id == $selectedCategories)) selected="selected" @endif>
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
						{{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{{ Form::close() }}

@endsection