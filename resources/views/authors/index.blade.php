@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager',[
  'image' => 'https://lyndakade.ir/image/logo.png',
  'title' => 'لیندا کده | مدرسین',
  'keywords' => get_seo_keywords() . ' , مدرسین , authors ',
  'description' => 'لیست تمامی مدرسین در وبسایت لیندا کده. | ' . get_seo_description(),
  ])
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "ItemList",
      @foreach (array_keys($authors) as $key)
        @foreach ($authors[$key] as $author)
          {"@type":"ListItem", "position":{{ $loop->index + 1 }},
          "item": {
          "@type": "Person",
          "image": "{{ fromDLHost($author->img) }}",
          "name": "{{ $author->name }}",
          "url":"{{ route('authors.show', [$author->slug]) }}"
          }
          }@if (!$loop->last),
            @endif @endforeach @if (!$loop->last),
            @endif
          @endforeach]
    }
  </script>
@endpush
@section('content')

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ asset('css/mastersStyle.css') }}">
  <div class="container">
    <div class="row">
      <div class="col-lg-12" style="border-bottom: 10px solid #ffca08;margin-top: 15px">
        <h1 class="text-center" style="font-size: 1.5rem"> مدرسین لینکدین </h1>
      </div>
    </div>
    {{-- <div class="category-details">
      <div class="category-more-details mt-4" STYLE="border-radius: 20px">
        <div class="category-description" style="padding-top: 5px;padding-bottom: 2px">
          <div class="container">
            <p class="text-center">
              نویسندگان با دقت انتخاب شده ما مربیان کلاس ، نویسندگان پرفروش و مقامات شناخته شده هستند. ما این
              متخصصان را انتخاب می کنیم زیرا آنها معلمان مؤثر ، پرشور و پرشور هستند که موضوع را قابل دستیابی و درک
              آسان می کنند.
            </p>
          </div>
        </div>
      </div>
    </div> --}}

    <ul class="alpha-nav">
      @foreach (array_keys($authors) as $key)
        <li style="float: left;"><a href="#{{ $key }}">{{ $key }}</a></li>
      @endforeach
    </ul>
  </div>
  <div class="container mt-40 text-left" dir="ltr">
    @foreach (array_keys($authors) as $key)
      <div id="{{ $key }}">
        <h4>{{ $key }}</h4>
      </div>
      <ul class="row">
        @foreach ($authors[$key] as $author)
          <li class="col-12 col-md-4">
            <a href="{{ route('authors.show', [$author->slug]) }}">
              {{ $author->name }}
            </a>
          </li>
        @endforeach
      </ul>
      {{-- <div class="row mt-30 mb-5">
        @foreach ($authors[$key] as $author)
          <div class="col-md-2 col-sm-4">
            <a href="{{ route('authors.show', [$author->slug]) }}">
              <div class="box2 m-0 mt-1" style="border-radius: 20px">
                <img src="#" data-src="{{ fromDLHost($author->img) }}" class="lazyload">
                <div class="box-content">
                  <div class="inner-content">
                    <h3 class="title">{{ $author->name }}</h3>
                    <span class="post">
                    </span>
                  </div>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div> --}}
    @endforeach
  </div>
@endsection
