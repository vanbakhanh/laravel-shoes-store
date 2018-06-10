@extends('layouts.master')
@section('title', 'Profile')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div  class="card-body">
                <h5 class="card-title text-center">{{ __('Profile') }}</h5>
            </div>

            <div class="card-body">
                {{ Form::open(['route' => ['user.update', $user->slug], 'method' => 'PUT']) }}
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus>

                        @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>

                        @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                    <div class="col-md-6">
                        <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $user->address }}" required autofocus>

                        @if ($errors->has('address'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                    <div class="col-md-6">
                        <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $user->phone }}" required autofocus>

                        @if ($errors->has('phone'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="birthday" class="col-md-4 col-form-label text-md-right">{{ __('Birthday') }}</label>

                    <div class="col-md-6">
                        <input id="birthday" type="date" class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}" name="birthday" value="{{ $user->birthday }}" required autofocus>

                        @if ($errors->has('birthday'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('birthday') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                    <div class="col-md-6">
                        <select id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="{{ $user->gender }}" required autofocus>
                          <option @if($user->gender == 'male') selected="selected" @endif value="male">Male</option>
                          <option @if($user->gender == 'female') selected="selected" @endif value="female">Female</option>
                      </select>

                      @if ($errors->has('gender'))
                      <span class="invalid-feedback">
                        <strong>{{ $errors->first('gender') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    @if (session('status'))
                    <div class="alert alert-success">
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
                    {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
</div>

@endsection
