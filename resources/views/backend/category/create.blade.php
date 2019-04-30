@extends('layouts.dashboard')

@section('title', trans('category.new_title'))

@section('content')

{{ Form::open(['route' => ['category.store'], 'method' => 'POST', 'class' => 'form-horizontal']) }}
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body col-md-8 offset-md-2">
                <h3 class="card-title">{{ trans('category.new_title') }}</h3>
                <div class="form-group">
                    <label>{{ trans('category.name') }}</label>
                    {{ Form::text('name', '', ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    <label>{{ trans('category.description') }}</label>
                    {{ Form::textarea('description', '', ['class' => 'form-control', 'rows' => '1']) }}
                </div>
                <div class="form-group">
                    {{ Form::submit(trans('category.create'), ['class' => 'btn btn-primary']) }}
                </div>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
<div class="row justify-content-center">
    <div class="col-md-12 mt-4">
        <div class="card">
            <div class="card-body table-responsive">
                @if ($categories->isEmpty())
                <div class="alert alert-dismissible alert-warning">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <p class="mb-0">{{ trans('category.empty') }}</p>
                </div>
                @else
                <table id="table" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">{{ trans('category.id') }}</th>
                            <th scope="col">{{ trans('category.name') }}</th>
                            <th scope="col">{{ trans('category.description') }}</th>
                            <th scope="col">{{ trans('category.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <th scope="row">{{ $category->id }}</th>
                            <td>{{ $category->name }}</td>
                            <td class="text-left">{{ $category->description }}</td>
                            <td>
                                {{ Form::open(['method' => 'DELETE', 'route' => ['category.destroy', $category->id]]) }}
                                <div class="btn-group btn-group-toggle">
                                    <a class="btn btn-outline-warning btn-sm"
                                        href="{{ route('category.edit',$category->id) }}">
                                        {{ trans('category.edit') }}
                                    </a>
                                    {{ Form::submit(trans('category.delete'), ['class' => 'btn btn-outline-danger btn-sm']) }}
                                </div>
                                {{ Form::close() }}
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

@endsection