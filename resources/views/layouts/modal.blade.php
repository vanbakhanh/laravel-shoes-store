<!-- Login/Register Modal -->
@guest
<div class="modal fade" id="authModalCenter" tabindex="-1" role="dialog" aria-labelledby="authModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                @if (session('status'))
                <script type="text/javascript">
                    $(window).on('load', function () {
                        $('#authModalCenter').modal('show');
                    });
                </script>
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('status') }}
                </div>
                @endif
                @if ($errors->any())
                <script type="text/javascript">
                    $(window).on('load', function () {
                        $('#authModalCenter').modal('show');
                    });
                </script>
                @endif
                <ul class="nav nav-tabs nav-fill">
                    <li class="nav-item">
                        <a data-toggle="tab" class="nav-link active show" href="#login">
                            {{ trans('auth.login') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" class="nav-link" href="#register">
                            {{ trans('auth.register') }}
                        </a>
                    </li>
                </ul>
                <br>
                <div class="tab-content">
                    <div id="login" class="tab-pane fade active show">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <input id="emailLogin" type="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                    value="{{ old('email') }}" placeholder="{{ trans('auth.email') }}" required
                                    autofocus>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input id="passwordLogin" type="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" placeholder="{{ trans('auth.password') }}" required>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                            {{ old('remember') ? 'checked' : '' }}>{{ trans('auth.remember') }}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('auth.login') }}
                                </button>
                                <button type="button" class="btn btn-link" data-dismiss="modal">
                                    {{ trans('auth.cancel') }}
                                </button>
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ trans('auth.forgot') }}
                                </a>
                            </div>
                        </form>
                    </div>
                    <div id="register" class="tab-pane fade">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <input id="firstNameRegister" type="text"
                                    class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                    name="first_name" value="{{ old('first_name') }}"
                                    placeholder="{{ trans('auth.first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input id="lastNameRegister" type="text"
                                    class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                    name="last_name" value="{{ old('last_name') }}"
                                    placeholder="{{ trans('auth.last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input id="emailRegister" type="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                    value="{{ old('email') }}" placeholder="{{ trans('auth.email') }}" required>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input id="passwordRegister" type="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" placeholder="{{ trans('auth.password') }}" required>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input id="password-confirmRegister" type="password" class="form-control"
                                    name="password_confirmation" placeholder="{{ trans('auth.confirm_password') }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('auth.register') }}
                                </button>
                                <button type="button" class="btn btn-link" data-dismiss="modal">
                                    {{ trans('auth.cancel') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endguest