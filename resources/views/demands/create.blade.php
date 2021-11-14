@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager',[
  'image' => 'https://lyndakade.ir/image/logo.png',
  'title' => 'درخواست دوره آموزشی - لیندا کده',
  'keywords' => get_seo_keywords() . ' , درخواست دوره آموزشی , course request, request, demand, course demand ',
  'description' => 'برای درخواست دوره آموزشی از این صفحه اقدام فرمایید. | ' . get_seo_description(),
  ])
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name" : "Course Request - درخواست دوره آموزشی",
      "url": "{{ route('demands.create') }}"
    }
    </script>
@endpush
@section('content')
  @csrf
  <div class="container">
    <div class="row justify-content-center m-4">
      <div class="col-12 text-center">
        <h1>فرم درخواست دوره یا مسیر آموزشی</h1>
      </div>
      <div class="col-md-6 com-sm-12 pt-3">
        <div class="card" id="card">
          <div class="card-header">
            <h5>
              لینک درس یا مسیر آموزشی مطابق با وبسایت لینکدین باشد.
            </h5>
          </div>
          <div class="card-body">
            <div class="flip-card">
              <div class="flip-card-inner">
                <div class="flip-card-front">
                  <form id="method-2" method="POST" action="{{ route('demands.store') }}">
                    @csrf
                    <div class="form-group row">
                      <label for="link" class="col-md-4 col-form-label text-md-left">لینک درس در لینکدین</label>
                      <div class="col-md-6">
                        <input id="link" type="url" class="form-control @error('link') is-invalid @enderror" name="link"
                          value="{{ old('link') }}" autocomplete="link">
                        @error('link')
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
      </div>
      <div class="col-md-6 com-sm-12 pt-3">
        <div class="card" id="card">
          <div class="card-header">
            <h5>
              نام درس و نام مدرس مطابق با وبسایت لینکدین باشد.
            </h5>
          </div>
          <div class="card-body">
            <div class="flip-card">
              <div class="flip-card-inner">
                <div class="flip-card-front">
                  <form id="method-1" method="POST" action="{{ route('demands.store') }}">
                    @csrf
                    <div class="form-group row">
                      <label for="title" class="col-md-4 col-form-label text-md-left">نام درس</label>
                      <div class="col-md-6">
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                          name="title" value="{{ old('title') }}" autocomplete="title" autofocus>
                        @error('title')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="author" class="col-md-4 col-form-label text-md-left">نام مدرس</label>
                      <div class="col-md-6">
                        <input id="author" type="text" class="form-control @error('author') is-invalid @enderror"
                          name="author" value="{{ old('author') }}" autocomplete="author">
                        @error('author')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group row mb-0">
                      <div class="col-md-6">
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
      </div>
    </div>
  </div>
@endsection

{{-- @section('script_body')
    <script>
        $("#flip-btn").click(function () {
            $(".flip-card-inner")[0].classList.toggle('flip-card-clicked');
        });

        $("#unflip-btn").click(function () {
            $(".flip-card-inner")[0].classList.toggle('flip-card-clicked');
        });
    </script>
@endsection --}}
