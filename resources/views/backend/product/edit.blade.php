@extends('layouts.dashboard')
@section('title', trans('product.edit_title'))
@section('content')

{{ Form::open(['route' => ['product.update', $product->id], 'files' => true, 'method' => 'PUT', 'class' => 'form-horizontal']) }}
@csrf
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body col-md-8 offset-md-2">
				<h3 class="card-title">{{ trans('product.edit_title') }}</h3>
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
					<img class="img-thumbnail" src="{{ asset('images/product/' . $product->image) }}">
				</div>
				<div class="form-group">
					<label>{{ trans('product.name') }}</label>
					{{ Form::text('name', $product->name, ['class' => 'form-control']) }}	
				</div>
				<div class="form-group">
					<label>{{ trans('product.description') }}</label>
					{{ Form::textarea('description', $product->description, ['class' => 'form-control', 'rows' => '3']) }}
				</div>
				<div class="form-group">
					<label>{{ trans('product.gender') }}</label>
					<select class="form-control" id="gender" name="gender" value="{{ $product->gender }}">
						<option @if ($product->gender == 'male') selected="selected" @endif value="male">{{ trans('product.male') }}</option>
						<option @if ($product->gender == 'female') selected="selected" @endif value="female">{{ trans('product.female') }}</option>
					</select>
				</div>
				<div class="form-group">
					<label>{{ trans('product.price') }}</label>
					{{ Form::number('price', $product->price, ['class' => 'form-control']) }}
				</div>
				<div class="form-group">
					<label>{{ trans('product.color') }}</label>
					<select class="form-control" id="color" name="color[]" multiple>
						@foreach ($colors as $color)
						<option value="{{ $color->id }}" @if(in_array($color->id, $selectedColors)) selected="selected" @endif>
							{{ $color->name }}
						</option>
						@endforeach
					</select>	
				</div>
				<div class="form-group">
					<label>{{ trans('product.size') }}</label>
					<select id="size" class="form-control" name="size[]" multiple>
						@foreach ($sizes as $size)
						<option value="{{ $size->id }}" @if(in_array($size->id, $selectedSizes)) selected="selected" @endif>
							{{ $size->name }}
						</option>
						@endforeach
					</select>	
				</div>
				<div class="form-group">
					<label>{{ trans('product.category') }}</label>
					<select id="categoryId" class="form-control" name="category_id">
						@foreach ($categories as $category)
						<option value="{{ $category->id }}" @if ($category->id == $selectedCategory)) selected="selected" @endif>
							{{ $category->name }}
						</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label>{{ trans('product.image') }}</label>
					{{ Form::file('image', ['class' => 'form-control-file']) }}
				</div>
				<div class="form-group">
					{{ Form::submit(trans('product.update'), ['class' => 'btn btn-primary']) }}
				</div>
			</div>
		</div>
	</div>
</div>
{{ Form::close() }}

@endsection