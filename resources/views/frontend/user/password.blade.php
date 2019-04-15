@extends('layouts.master')

@section('title', trans('user.change_password'))

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-body col-md-8 offset-md-2">
                    <h3 class="card-title">{{ trans('user.change_password') }}</h3>
                    {{ Form::open(['route' => ['user.password.update', $user->id], 'method' => 'PUT']) }}
                    <div class="form-group">
                        <label>{{ trans('user.new_password') }}</label>
                        <input id="password" type="password"
                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                            required>
                        @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>{{ trans('user.confirm_password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required>
                    </div>
                    <div class="form-group">
                        {{ Form::submit(trans('user.update'),['class'=>'btn btn-primary']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection