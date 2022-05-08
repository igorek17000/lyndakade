@extends('layouts.app')

@push('meta.in.head')
  @include('meta::manager', [
      'image' => 'https://lyndakade.ir/image/logo.png',
      'title' => 'ثبت نام - لیندا کده',
      'keywords' => get_seo_keywords() . ' , ثبت نام , ثبت نام حساب کاربری , register , sign up , sign-up',
      'description' => ' ثبت نام حساب کاربری | ' . get_seo_description(),
  ])
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [{
          "@type": "Organization",
          "@id": "https://LyndaKade.ir/#/schema/organization/LyndaKade",
          "name": "Lynda Kade - لیندا کده",
          "url": "https://LyndaKade.ir",
          "sameAs": [
            "https://www.aparat.com/LyndaKade.ir",
            "https://www.instagram.com/LyndaKade.ir/",
            "https://t.me/LyndaKade/"
          ],
          "logo": {
            "@type": "ImageObject",
            "@id": "https://LyndaKade.ir/#/schema/image/LyndaKade",
            "url": "https://lyndakade.ir/image/logoedit2.png",
            "width": 100,
            "height": 100,
            "caption": "Lynda Kade - لیندا کده"
          },
          "image": {
            "@id": "https://LyndaKade.ir/#/schema/image/LyndaKade",
            "inLanguage": "fa-IR",
            "url": "https://lyndakade.ir/image/logoedit2.png",
            "width": 100,
            "height": 100,
            "caption": "Lynda Kade - لیندا کده"
          }
        },
        {
          "@type": "WebSite",
          "@id": "https://LyndaKade.ir/#/schema/website/LyndaKade",
          "url": "https://LyndaKade.ir",
          "name": "Lynda Kade - لیندا کده",
          "potentialAction": {
            "@type": "SearchAction",
            "target": "https://LyndaKade.ir/search?q={search_term_string}",
            "query-input": "required name=search_term_string"
          },
          "publisher": {
            "@id": "https://LyndaKade.ir/#/schema/organization/LyndaKade"
          }
        },

        {
            "@type": "WebPage",
            "@id": "{{ request()->url() }}",
            "url": "{{ request()->url() }}",
            "inLanguage": "fa-IR",
            "name": "ثبت نام - لیندا کده",
            "dateModified": "{{ \Carbon\Carbon::now() }}",
            "description": "",
            "isPartOf": {
              "@id": "https://LyndaKade.ir/#/schema/website/LyndaKade"
            },
            "about": {
              "@id": "https://LyndaKade.ir/#/schema/organization/LyndaKade"
            }
          },
        {
          "@context": "https://schema.org",
          "@id": "https://LyndaKade.ir/#/schema/breadcrumb/LyndaKade",
          "@type": "BreadcrumbList",
          "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "item": {
              "@id": "https://LyndaKade.ir/Learning",
              "name": "Learning",
              "url": "https://LyndaKade.ir/Learning"
            }
          }, {
            "@type": "ListItem",
            "position": 2,
            "item": {
              "@id": "{{ route('register') }}",
              "name": "Register - ثبت نام",
              "url": "{{ route('register') }}"
            }
          }]
        },
        {
          "@context": "https://schema.org",
          "@type": "WebPage",
          "name": "Register - ثبت نام",
          "url": "{{ route('register') }}"
        }
      ]
    }
  </script>
@endpush

@section('script_head')
  {!! NoCaptcha::renderJs() !!}
@endsection

@section('content')
  <h1 class="sr-only">{{ __('msg.Register') }}</h1>
  <div class="container d-flex align-items-center register-page">
    <div class="row justify-content-center m-4">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">{{ __('msg.Register') }}</div>
          <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
              @csrf

              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('msg.Name') }}</label>

                <div class="col-md-8 col-lg-6">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                  @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ __($message) }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="firstName" class="col-md-4 col-form-label text-md-left">{{ __('msg.FirstName') }}</label>

                <div class="col-md-8 col-lg-6">
                  <input id="firstName" type="text" class="form-control @error('firstName') is-invalid @enderror"
                    name="firstName" value="{{ old('firstName') }}" required autocomplete="firstName">

                  @error('firstName')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ __($message) }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="lastName" class="col-md-4 col-form-label text-md-left">{{ __('msg.LastName') }}</label>

                <div class="col-md-8 col-lg-6">
                  <input id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror"
                    name="lastName" value="{{ old('lastName') }}" required autocomplete="lastName">

                  @error('lastName')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ __($message) }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="mobile" class="col-md-4 col-form-label text-md-left">{{ __('msg.Mobile') }}</label>

                <div class="col-md-8 col-lg-6">
                  <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                    value="{{ old('mobile') }}" required autocomplete="mobile">

                  @error('mobile')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ __($message) }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="username" class="col-md-4 col-form-label text-md-left">{{ __('msg.UserName') }}</label>

                <div class="col-md-8 col-lg-6">
                  <input id="username" type="text"
                    class="form-control text-md-right @error('username') is-invalid @enderror" name="username"
                    value="{{ old('username') }}" required autocomplete="username">

                  @error('username')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ __($message) }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('msg.E-Mail Address') }}</label>

                <div class="col-md-8 col-lg-6">
                  <input id="email" type="email" class="form-control text-md-right @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email">
                  <small class="form-text text-muted">
                    لطفا از درستی آدرس ایمیل خود اطمینان حاصل نمایید، زیرا در صورت بروز رسانی دوره های خریداری شده شما،
                    اطلاعیه بروزرسانی به ایمیل شما ارسال خواهد شد، که میتوانید آن را رایگان دانلود کنید.
                  </small>
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ __($message) }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('msg.Password') }}</label>

                <div class="col-md-8 col-lg-6">
                  <input id="password" type="password"
                    class="form-control text-md-right @error('password') is-invalid @enderror" name="password" required
                    autocomplete="new-password">

                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ __($message) }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="password-confirm"
                  class="col-md-4 col-form-label text-md-left">{{ __('msg.Confirm Password') }}</label>

                <div class="col-md-8 col-lg-6">
                  <input id="password-confirm" type="password" class="form-control text-md-right"
                    name="password_confirmation" required autocomplete="new-password">
                </div>
              </div>

              <div class="form-group row text-center {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                <div class="col-md-12 col-lg-8 align-self-center">
                  {!! app('captcha')->display() !!}
                  @if ($errors->has('g-recaptcha-response'))
                    <span class="help-block">
                      <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-8 col-lg-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('msg.Register') }}
                  </button>
                </div>
              </div>
            </form>

            {{-- <hr>

                        <div class="row">
                            <div class="col-md-8 col-lg-6 row-block offset-md-4">
                                <a href="{{ route('login.google') }}" class="btn btn-lg btn-danger btn-block">
                                    <strong>ورود با حساب گوگل</strong>
                                </a>
                            </div>
                        </div> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
