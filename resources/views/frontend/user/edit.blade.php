@extends('layouts.master')

@section('title', trans('user.profile', ['name' => $user->profile->full_name]))

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        @if (session('status'))
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('status') }}
        </div>
        @endif
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body">
                <h3 class="card-title">{{ trans('user.status') }}</h3>
                <dl class="row">
                    <dt class="col-sm-4">{{ trans('user.joined') }}</dt>
                    <dd class="col-sm-8">{{ $user->created_at }}</dd>
                    <dt class="col-sm-4">{{ trans('user.comment') }}</dt>
                    <dd class="col-sm-8">{{ count($user->comments) }}</dd>
                    <dt class="col-sm-4">{{ trans('user.order') }}</dt>
                    <dd class="col-sm-8">{{ count($user->orders) }}</dd>
                    <dt class="col-sm-4">{{ trans('user.total') }}</dt>
                    <dd class="col-sm-8">${{ $user->orders->sum('total') }}</dd>
                </dl>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <h3 class="card-title">{{ trans('user.change_password') }}</h3>
                {{ Form::open(['route' => ['user.password.update', $user->id], 'method' => 'PUT']) }}
                <div class="form-group">
                    <label>{{ trans('user.new_password') }}</label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                        name="password" required>
                    @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>{{ trans('user.confirm_password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
                <div class="form-group">
                    {{ Form::submit(trans('user.update'),['class'=>'btn btn-primary btn-block']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ trans('user.profile', ['name' => $user->profile->full_name]) }}</h3>
                {{ Form::open(['route' => ['profile.update', $user->id], 'method' => 'PUT']) }}
                <div class="form-group">
                    <label>{{ trans('user.email') }}</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                        name="email" value="{{ $user->email }}" disabled>
                    @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>{{ trans('user.first_name') }}</label>
                    <input id="firstname" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                        name="first_name" value="{{ $user->profile->first_name }}" required autofocus>
                    @if ($errors->has('first_name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>{{ trans('user.last_name') }}</label>
                    <input id="lastname" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                        name="last_name" value="{{ $user->profile->last_name }}" required autofocus>
                    @if ($errors->has('last_name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>{{ trans('user.address') }}</label>
                    <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                        name="address" value="{{ $user->profile->address }}" required autofocus>
                    @if ($errors->has('address'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>{{ trans('user.phone') }}</label>
                    <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                        name="phone" value="{{ $user->profile->phone }}" required autofocus>
                    @if ($errors->has('phone'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>{{ trans('user.birthday') }}</label>
                    <input id="birthday" type="date" class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}"
                        name="birthday" value="{{ $user->profile->birthday }}" required autofocus>
                    @if ($errors->has('birthday'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('birthday') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>{{ trans('user.gender') }}</label>
                    <select id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}"
                        name="gender" value="{{ $user->profile->gender }}" required autofocus>
                        <option @if($user->profile->gender == 'Male') selected="selected" @endif value="0">
                            {{ trans('user.male') }}
                        </option>
                        <option @if($user->profile->gender == 'Female') selected="selected" @endif value="1">
                            {{ trans('user.female') }}
                        </option>
                    </select>
                    @if ($errors->has('gender'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('gender') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    {{ Form::submit(trans('user.update'), ['class' => 'btn btn-primary']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@endsection
