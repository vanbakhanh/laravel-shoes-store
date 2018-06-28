@extends('layouts.master')
@section('title', 'Change Password')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body col-md-8 offset-md-2">
                <h3 class="card-title my-4">Change Password</h3>
                @if (session('status'))
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('status') }}
                </div>
                @endif
                {{ Form::open(['route' => ['user.password.update', $user->id], 'method' => 'PUT']) }}
                @csrf

                <div class="form-group">
                    <label>{{ __('New Password') }}</label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label>{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>

                <div class="form-group">

                    {{ Form::submit('Change',['class'=>'btn btn-dark']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@endsection
