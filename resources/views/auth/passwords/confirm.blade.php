@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager', [
      'image' => 'https://lyndakade.ir/image/logo.png',
      'title' => __('msg.Confirm Password') . ' - لیندا کده',
      'keywords' => get_seo_keywords() . __('msg.Confirm Password') . ', Confirm Password',
      'description' => ' صفحه ' . __('msg.Confirm Password') . ' | ' . get_seo_description(),
  ])
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name": "Confirm Password - {{ __('msg.Confirm Password') }}",
      "url": "{{ route('password.request') }}"
    }
  </script>
@endpush
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('msg.Confirm Password') }}</div>

          <div class="card-body">
            {{ __('msg.Please confirm your password before continuing.') }}

            <form method="POST" action="{{ route('password.confirm') }}">
              @csrf

              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('msg.Password') }}</label>

                <div class="col-md-6">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">

                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('msg.Confirm Password') }}
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
