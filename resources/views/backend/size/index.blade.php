@extends('layouts.dashboard')

@section('title', trans('size.list_title'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                {{ trans('size.list_title') }}
            </div>
            <div class="card-body table-responsive">
                @if ($sizes->isEmpty())
                <div class="alert alert-dismissible alert-warning">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <p class="mb-0">{{ trans('size.empty') }}</p>
                </div>
                @else
                <table id="table" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">{{ trans('size.id') }}</th>
                            <th scope="col">{{ trans('size.name') }}</th>
                            <th scope="col">{{ trans('size.action') }}</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach ($sizes as $size)
                        <tr>
                            <th scope="row">{{ $size->id }}</th>
                            <td>{{ $size->name }}</td>
                            <td>
                                {{ Form::open(['method' => 'DELETE', 'route' => ['size.destroy', $size->id]]) }}
                                <div class="btn-group btn-group-toggle">
                                    <a class="btn btn-outline-warning btn-sm"
                                        href="{{ route('size.edit', $size->id) }}">
                                        {{ trans('size.edit') }}
                                    </a>
                                    {{ Form::submit(trans('size.delete'), ['class' => 'btn btn-outline-danger btn-sm']) }}
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