@extends('layouts.master')

@section('title', trans('auth.register'))

@section('modal')
@endsection

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body col-md-8 offset-md-2">
                <h3 class="card-title text-center py-2">{{ trans('auth.register') }}</h3>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    @include('frontend.common.oauth-button')
                    <div class="form-group">
                        <label for="firstname">{{ trans('auth.first_name') }}</label>
                        <input id="firstname" type="text"
                            class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name"
                            value="{{ old('first_name') }}" required autofocus>
                        @if ($errors->has('first_name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="lastname">{{ trans('auth.last_name') }}</label>
                        <input id="lastname" type="text"
                            class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name"
                            value="{{ old('last_name') }}" required autofocus>
                        @if ($errors->has('last_name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email">{{ trans('auth.email') }}</label>
                        <input id="email" type="email"
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                            value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password">{{ trans('auth.password') }}</label>
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
                        <label for="password-confirm">{{ trans('auth.confirm_password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ trans('auth.register') }}
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                {{ trans('auth.have_account') }} <a href="{{ route('login') }}">{{ trans('auth.login') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection