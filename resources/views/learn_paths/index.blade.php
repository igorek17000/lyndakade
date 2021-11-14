@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager',[
  'image' => 'https://lyndakade.ir/image/logo.png',
  'title' => 'مسیرهای آموزشی - لیندا کده',
  'keywords' => get_seo_keywords() . ' , لیست مسیرهای آموزشی , learn path, learn-path, all learn paths ',
  'description' => 'لیست مسیرهای آموزشی | ' . get_seo_description(),
  ])
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [{
        "@type": "ListItem",
        "position": 1,
        "item": {
          "@id": "{{ route('learn.paths.show', ['business']) }}",
          "name": "Business - کسب و کار"
        }
      }, {
        "@type": "ListItem",
        "position": 2,
        "item": {
          "@id": "{{ route('learn.paths.show', ['creative']) }}",
          "name": "Creative - خلاقیت"
        }
      }, {
        "@type": "ListItem",
        "position": 3,
        "item": {
          "@id": "{{ route('learn.paths.show', ['technology']) }}",
          "name": "Technology - تکنولوژی"
        }
      }]
    }
  </script>
@endpush
@section('content')
  <div id="paths-hero" class="card bg-dark text-white">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3 paths-hero-content">
          <h1>مسیرهای آموزشی</h1>
          <h2>مهارت های خود را تقویت کنید. تیز بمانید. جلو بروید.</h2>
          <p>کارشناسان صنعت برای شروع کار خود دانش و مهارت را به شما یاد می دهند.
            <br>
            مسیر خود را پیدا کنید. سفر خود را شروع کنید.
          </p>

          <div class="dropdown" dir="ltr">
            <button class="btn btn-dark btn-lg filter-paths" type="button" id="dropdownFilter" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              فیلتربندی
            </button>
            <div class="dropdown-menu dropdown-menu-center" aria-labelledby="dropdownFilter">
              <span class="dropdown-item {{ $selected_library == 'all' ? ' active' : '' }}" id="dropdown-see-all"
                onclick="changePaths('see-all')">همه</span>
              @foreach ($libraries as $library)
                <span class="dropdown-item {{ $selected_library == $library->slug ? ' active' : '' }}"
                  id="dropdown-{{ $library->slug }}"
                  onclick="changePaths('{{ $library->slug }}')">{{ $library->title }}</span>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- <img --}}
    {{-- class="card-img" --}}
    {{-- style=" --}}
    {{-- /*height: 450px;*/ --}}
    {{--  --}}{{-- background-size: cover; --}}
    {{--  --}}{{-- background: linear-gradient(to right,#000 0,rgba(0,0,0,.70) 40%,rgba(0,0,0,.70) 60%,#000 100%), --}}
    {{--  --}}{{-- url('{{ asset('learn paths/path-hero.jpg') }}'); --}}
    {{--  --}}{{-- background: url('{{ asset('learn paths/path-hero.jpg') }}') 50% 0 no-repeat; --}}
    {{-- "> --}}
  </div>
  <div id="learn-path-page">
    <div class="container">
      @foreach ($libraries as $library)
        <div id="{{ $library->slug }}" class="library-title row active">
          <div class="col-12">
            <h3>{{ $library->title }}</h3>
          </div>
          @foreach ($library->paths as $learn_path)
            @include('learn_paths.partials.list_item_grid', ['learn_path' => $learn_path])
          @endforeach
        </div>
      @endforeach
    </div>
  </div>
@endsection
@section('script_body')
  <script>
    function changePaths(id) {
      if (id === 'see-all') {

        [].forEach.call(document.querySelectorAll(".dropdown-item"), function(el) {
          el.classList.remove("active");
        });
        document.getElementById('dropdown-see-all').classList.add("active");

        [].forEach.call(document.querySelectorAll(".library-title"), function(el) {
          el.classList.remove("active");
          el.classList.add("active");
        });

      } else {
        [].forEach.call(document.querySelectorAll(".dropdown-item"), function(el) {
          el.classList.remove("active");
        });
        document.getElementById('dropdown-' + id).classList.add("active");


        [].forEach.call(document.querySelectorAll(".library-title"), function(el) {
          el.classList.remove("active");
        });
        document.getElementById(id).classList.add("active");
      }
    }

    $(function() {
      $('#dropdownFilter').dropdown();
    });
  </script>
@endsection
