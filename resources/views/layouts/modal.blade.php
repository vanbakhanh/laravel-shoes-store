<!-- Modal -->
@guest
<div class="modal fade" id="authModalCenter" tabindex="-1" role="dialog" aria-labelledby="authModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
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
                        @if (session('status'))
                        <script type="text/javascript">
                            $(window).on('load', function() {
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
                            $(window).on('load', function() {
                                $('#authModalCenter').modal('show');
                            });
                        </script>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="emailLogin">{{ trans('auth.email') }}</label>

                                <input id="emailLogin" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="passwordLogin">{{ trans('auth.password') }}</label>

                                <input id="passwordLogin" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ trans('auth.remember') }}
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
                        @if (session('status'))
                        <script type="text/javascript">
                            $(window).on('load', function() {
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
                            $(window).on('load', function() {
                                $('#authModalCenter').modal('show');
                            });
                        </script>
                        @endif
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <label for="nameRegister">{{ trans('auth.name') }}</label>

                                <input id="nameRegister" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="emailRegister">{{ trans('auth.email') }}</label>

                                <input id="emailRegister" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="passwordRegister">{{ trans('auth.password') }}</label>

                                <input id="passwordRegister" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password-confirmRegister">{{ trans('auth.confirm_password') }}</label>

                                <input id="password-confirmRegister" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                            <div class="form-group">
                                <label for="addressRegister">{{ trans('auth.address') }}</label>

                                <input id="addressRegister" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required autofocus>

                                @if ($errors->has('address'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="phoneRegister">{{ trans('auth.phone') }}</label>

                                <input id="phoneRegister" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus>

                                @if ($errors->has('phone'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="birthdayRegister">{{ trans('auth.birthday') }}</label>

                                <input id="birthdayRegister" type="date" class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}" name="birthday" value="{{ old('birthday') }}" required autofocus>

                                @if ($errors->has('birthday'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('birthday') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="genderRegister">{{ trans('auth.gender') }}</label>

                                <select id="genderRegister" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="{{ old('gender') }}" required autofocus>
                                    <option value="male">{{ trans('auth.male') }}</option>
                                    <option value="female">{{ trans('auth.female') }}</option>
                                </select>

                                @if ($errors->has('gender'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                                @endif
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