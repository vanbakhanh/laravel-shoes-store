@extends('layouts.dashboard')

@section('title', trans('user.list_title'))

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body table-responsive">
                <h3 class="card-title">{{ trans('user.list_title') }}</h3>
                @if ($users->isEmpty())
                <div class="alert alert-dismissible alert-warning">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <p class="mb-0">{{ trans('user.empty') }}</p>
                </div>
                @else
                <table id="table" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">{{ trans('user.id') }}</th>
                            <th scope="col">{{ trans('user.email') }}</th>
                            <th scope="col">{{ trans('user.name') }}</th>
                            <th scope="col">{{ trans('user.gender') }}</th>
                            <th scope="col">{{ trans('user.phone') }}</th>
                            <th scope="col">{{ trans('user.birthday') }}</th>
                            <th scope="col">{{ trans('user.address') }}</th>
                            <th scope="col">{{ trans('user.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->profile->full_name }}</td>
                            <td>{{ $user->profile->gender }}</td>
                            <td>{{ $user->profile->phone }}</td>
                            <td>{{ $user->profile->birthday }}</td>
                            <td>{{ $user->profile->address }}</td>
                            <td>
                                {{ Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $user->id]]) }}
                                {{ Form::submit(trans('user.delete'), ['class' => 'btn btn-outline-danger btn-sm']) }}
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