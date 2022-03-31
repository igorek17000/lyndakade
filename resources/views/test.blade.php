@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager', [
      'image' => 'https://lyndakade.ir/image/logo.png',
      'title' => 'جذب دوبلور - لیندا کده',
      'keywords' => get_seo_keywords() . 'جذب دوبلور , استخدام دوبلور , ',
      'description' => 'فرم جهت جذب دوبلور. | ' . get_seo_description(),
  ])
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name": "جذب دوبلور",
      "url": "{{ route('dubbed.request') }}"
    }
  </script>
@endpush
@section('content')
  <style>

  </style>
  @csrf
  <div class="container">
    <div class="row justify-content-center m-4">
      <div class="col-md-6 com-sm-12 pt-3">
        <div class="card" id="card">
          <div class="card-header text-center">
            <h1>جذب دوبلور</h1>
          </div>
          <div class="card-body">
            <form id="method-2" method="POST" action="{{ route('dubbed.request') }}">
              @csrf
              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-left">لینک درس در لینکدین</label>
                <div class="col-md-6">
                  <input id="email" type="url" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" autocomplete="email">
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row mb-0">
                <div class="col-md-6 col-xs-6 col-sm-6">
                  <button type="submit" class="btn btn-success my-2">
                    ثبت درخواست
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
@push('js')
  <script>
    $(function() {});
  </script>
@endpush
