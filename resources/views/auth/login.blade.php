@extends('layouts.plain')

@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-8 col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body m-3">
                    @unless(\App\User::exists())
                        <div class="alert alert-info shadow-sm border-0 text-center">
                            <p>No administrator account has been created yet.</p>

                            <a class="btn btn-primary btn-block btn-sm shadow-sm" href="{{ route('register') }}">Create one now</a>
                        </div>

                        <hr/>
                    @endunless

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">{{ __('Email Address') }}</label>

                            <input id="email" type="email" class="shadow-sm form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>

                            <input id="password" type="password" class="shadow-sm form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group my-4">
                            <div class="custom-control custom-checkbox d-flex align-items-center">
                                <input name="remember" type="checkbox" class="custom-control-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label d-block" for="remember">{{ __('Keep me logged in') }}</label>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-block btn-primary shadow-sm">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
