@extends('layouts.dashboard')
@section('title', 'Change Password')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div  class="card-body">
                <h5 class="card-title text-center">{{ __('Change Admin Password') }}</h5>
            </div>
            <div class="card-body">

                {{ Form::open(['route' => ['admin.password.update', $admin->id], 'method' => 'PUT']) }}
                @csrf
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        @if (session('status'))
                        <div class="alert alert-dismissible alert-success">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ session('status') }}
                        </div>
                        @endif
                        {{ Form::submit('Change', ['class'=>'btn btn-primary']) }}
                    </div>
                </div>
                {{ Form::close() }}

            </div>
        </div>
    </div>
</div>

@endsection
