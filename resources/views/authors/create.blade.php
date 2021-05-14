@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center m-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">ثبت مدرس جدید</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('authors.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-left">نام</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="firstName"
                                       class="col-md-4 col-form-label text-md-left">{{ __('msg.FirstName') }}</label>

                                <div class="col-md-6">
                                    <input id="firstName" type="text"
                                           class="form-control @error('firstName') is-invalid @enderror"
                                           name="firstName" value="{{ old('firstName') }}" required
                                           autocomplete="firstName">

                                    @error('firstName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lastName"
                                       class="col-md-4 col-form-label text-md-left">{{ __('msg.LastName') }}</label>

                                <div class="col-md-6">
                                    <input id="lastName" type="text"
                                           class="form-control @error('lastName') is-invalid @enderror" name="lastName"
                                           value="{{ old('lastName') }}" required autocomplete="lastName">

                                    @error('lastName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-left">{{ __('msg.E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control text-md-right @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-left">{{ __('msg.Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control text-md-right @error('password') is-invalid @enderror"
                                           name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-left">{{ __('msg.Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control text-md-right"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div
                                class="form-group row text-center {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                <div class="col-md-6 align-self-center">
                                    {!! app('captcha')->display() !!}
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('msg.Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <hr>

                        <div class="row">
                            <div class="col-md-12 row-block">
                                <a href="{{ route('login.google') }}" class="btn btn-lg btn-danger btn-block">
                                    <strong>ورود با حساب گوگل</strong>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
