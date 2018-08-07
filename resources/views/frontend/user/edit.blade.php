@extends('layouts.master')
@section('title', trans('user.profile', ['name' => $user->name]))
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
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
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
                    {{ Form::submit(trans('user.update'),['class'=>'btn btn-primary']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ trans('user.profile', ['name' => $user->name]) }}</h3>
                @if ($errors->any())
                @foreach ($errors->all() as $err)
                <p class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ $err }}
                </p>
                @endforeach
                @endif
                {{ Form::open(['route' => ['user.update', $user->id], 'method' => 'PUT']) }}
                <div class="form-group">
                    <label>{{ trans('user.name') }}</label>
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus>
                    @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>{{ trans('user.email') }}</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>
                    @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>{{ trans('user.address') }}</label>
                    <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $user->address }}" required autofocus>
                    @if ($errors->has('address'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>{{ trans('user.phone') }}</label>
                    <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $user->phone }}" required autofocus>
                    @if ($errors->has('phone'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>{{ trans('user.birthday') }}</label>
                    <input id="birthday" type="date" class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}" name="birthday" value="{{ $user->birthday }}" required autofocus>
                    @if ($errors->has('birthday'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('birthday') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>{{ trans('user.gender') }}</label>
                    <select id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="{{ $user->gender }}" required autofocus>
                        <option @if($user->gender == 'male') selected="selected" @endif value="male">
                            {{ trans('user.male') }}
                        </option>
                        <option @if($user->gender == 'female') selected="selected" @endif value="female">
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
