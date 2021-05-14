@extends('layouts.admin', ['page' => $user ?? '' ? __('Edit User') : __('Add New User'), 'pageSlug' => 'user'])

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ $user ?? '' ? __('Edit User') : __('Add New User') }}</h5>
                </div>
                <form method="post"
                      action="{{ $user ?? '' ? route('admins.user.edit') : route('admins.user.store') }}"
                      autocomplete="off"
                      enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        {{--                        @include('alerts.success')--}}

                        @if($user ?? '')<input type="hidden" name="id" value="{{$user->id}}">@endif

                        <div class="form-group row">
                            <label for="name"
                                   class="col-md-4 col-form-label text-md-left">{{ __('Display Name') }}</label>

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
                                   class="col-md-4 col-form-label text-md-left">{{ __('FirstName') }}</label>

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
                                   class="col-md-4 col-form-label text-md-left">{{ __('LastName') }}</label>

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
                            <label for="mobile"
                                   class="col-md-4 col-form-label text-md-left">{{ __('Mobile') }}</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text"
                                       class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                       value="{{ old('mobile') }}" required autocomplete="mobile">

                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                   class="col-md-4 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

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
                                   class="col-md-4 col-form-label text-md-left">{{ __('Password') }}</label>

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
                                   class="col-md-4 col-form-label text-md-left">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control text-md-right"
                                       name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Register') }}</button>
                    </div>
                </form>
            </div>
        </div>

        {{--        <div class="col-md-4">--}}
        {{--            <div class="card card-user">--}}
        {{--                <div class="card-body">--}}
        {{--                    <div class="card-text">--}}
        {{--                        <div class="author">--}}
        {{--                            <div class="block block-one"></div>--}}
        {{--                            <div class="block block-two"></div>--}}
        {{--                            <div class="block block-three"></div>--}}
        {{--                            <div class="block block-four"></div>--}}
        {{--                            <a href="#">--}}
        {{--                                <img class="avatar" src="{{ asset('black/img/emilyz.jpg') }}" alt="">--}}
        {{--                                <h5 class="title">{{ auth()->user()->name }}</h5>--}}
        {{--                            </a>--}}
        {{--                            <p class="description">--}}
        {{--                                {{ __('Ceo/Co-Founder') }}--}}
        {{--                            </p>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="card-description">--}}
        {{--                        {{ __('Do not be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...') }}--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <div class="card-footer">--}}
        {{--                    <div class="button-container">--}}
        {{--                        <button class="btn btn-icon btn-round btn-facebook">--}}
        {{--                            <i class="fab fa-facebook"></i>--}}
        {{--                        </button>--}}
        {{--                        <button class="btn btn-icon btn-round btn-twitter">--}}
        {{--                            <i class="fab fa-twitter"></i>--}}
        {{--                        </button>--}}
        {{--                        <button class="btn btn-icon btn-round btn-google">--}}
        {{--                            <i class="fab fa-google-plus"></i>--}}
        {{--                        </button>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
    </div>
@endsection
