@extends('layouts.dashboard')
@section('title', trans('admin.change_password'))
@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body col-md-8 offset-md-2">
                <h3 class="card-title">
                    {{ trans('admin.change_password') }}
                </h3>
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

                {{ Form::open(['route' => ['admin.password.update', $admin->id], 'method' => 'PUT']) }}
                @csrf
                <div class="form-group">
                    <label>{{ trans('admin.new_password') }}</label>
                    {{ Form::password('password', ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    <label>{{ trans('admin.confirm_password') }}</label>
                    {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::submit(trans('admin.update'), ['class' => 'btn btn-dark']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@endsection
