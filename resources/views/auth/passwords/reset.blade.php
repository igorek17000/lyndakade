@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager',[
  'image' => 'https://lyndakade.ir/image/logo.png',
  'title' => 'بازیابی رمز عبور - لیندا کده' ,
  'keywords' => get_seo_keywords() . ' , فراموشی کلمه عبور, فراموشی رمز عبور, reset password',
  'description' => ' صفحه فراموشی کلمه عبور | ' . get_seo_description(),
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
              "name": "بازیابی رمز عبور - لیندا کده",
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
            "@id": "https://LyndaKade.ir/#/schema/breadcrumb/LyndaKade"
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
                "@id": "{{ route('password.request') }}",
                "name": "Reset Password - بازیابی رمز عبور",
                "url": "{{ route('password.request') }}"
              }
            }]
          },
          {
            "@context": "https://schema.org",
            "@type": "WebPage",
            "name": "Reset Password - بازیابی رمز عبور",
            "url": "{{ route('password.request') }}"
          }
        ]
      }
    </script>
@endpush
@section('content')
  <h1 class="sr-only">{{ __('msg.Reset Password') }}</h1>
  <div class="container d-flex align-items-center reset-password-page">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('msg.Reset Password') }}</div>
          <div class="card-body">
            <form method="POST" action="{{ route('password.update') }}">
              @csrf

              <input type="hidden" name="token" value="{{ $token }}">

              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('msg.E-Mail Address') }}</label>

                <div class="col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('msg.Password') }}</label>

                <div class="col-md-6">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
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
                  class="col-md-4 col-form-label text-md-right">{{ __('msg.Confirm Password') }}</label>

                <div class="col-md-6">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password">
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('msg.Reset Password') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
