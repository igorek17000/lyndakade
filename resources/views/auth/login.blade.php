@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager',[
  'image' => 'https://lyndakade.ir/image/logo.png',
  'title' => ' لیندا کده | صفحه ورود به حساب کاربری' ,
  'keywords' => get_seo_keywords() . ' , ورود , ورود به حساب کاربری , login , sign in , sign-in',
  'description' => ' صفحه ورود به حساب کاربری | ' . get_seo_description(),
  ])
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name" : "Login - ورود",
      "url": "{{ route('login') }}"
    }
    </script>
@endpush
@section('content')
  <input type="hidden" name="abcd" value="{{ url()->previous() }}" />
  <h1 class="sr-only">{{ __('msg.Login') }}</h1>
  <div class="container d-flex align-items-center login-page">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">{{ __('msg.Login') }}</div>
          <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
              @csrf

              <div class="form-group row">
                <label for="username" class="col-md-4 col-form-label text-md-left">آدرس ایمیل یا نام
                  کاربری</label>

                <div class="col-md-6">
                  <input id="username" type="text"
                    class="form-control text-md-right @error('username') is-invalid @enderror" name="username"
                    value="{{ old('username') }}" required autocomplete="username" autofocus>

                  @error('username')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ __($message) }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('msg.Password') }}</label>

                <div class="col-md-6">
                  <input id="password" type="password"
                    class="form-control text-md-right @error('password') is-invalid @enderror" name="password" required
                    autocomplete="current-password">

                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ __($message) }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                      {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                      {{ __('msg.Remember Me') }}
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('msg.Login') }}
                  </button>

                  @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                      {{ __('msg.Forgot Your Password?') }}
                    </a>
                  @endif
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
