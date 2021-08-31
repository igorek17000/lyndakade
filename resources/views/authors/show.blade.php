@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager',[
  'image' => fromDLHost($author->img),
  'title' => ' لیندا کده | مدرس' . ' ' . $author->name,
  'keywords' => get_seo_keywords() . ' , ' . 'مدرس ' . $author->name . ' , author ' . $author->name,
  'description' => $author->description . ' | ' . get_seo_description(),
  ])
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "headline": "{{ $author->name }}",
      "url": "{{ route('authors.show', [$author->slug]) }}"
      "image": "{{ fromDLHost($author->img) }}",
    }
    </script>
@endpush
@section('content')
  {{-- <div class="row mx-0 px-0" style="height: 400px; background-color:#fff;"> --}}
  {{-- <div class="col-md-4 h-100 py-5" style="text-align: center;"> --}}
  {{-- <img src="{{ asset($author->img) }}" class="h-50 w-50 d-inline-block" alt="image" style="margin-top: 22%;"> --}}
  {{-- </div> --}}

  {{-- <div class="col-md-8 py-5"> --}}
  {{-- <span class="card-title">{{ $author->name }}</span> --}}
  {{-- </div> --}}
  {{-- </div> --}}

  <div class="container">
    <div class="title-banner">
      <div class="container" itemprop="author" itemscope="" itemtype="http://schema.org/Person">
        <link itemprop="url" href="{{ route('authors.show', [$author->slug]) }}" rel="author">
        <div class="row">
          <div class="col-xs-12">
            <div class="current-page-path">
              <a href="{{ route('authors.index') }}">تمام مدرسان</a>
              <i class="lyndacon arrow-left"></i>
              <span>{{ $author->name }}</span>
            </div>
          </div>
        </div>
        <div class="row author-details">
          <div class="col-xs-4 col-sm-4 col-md-4 col-xl-3" style="text-align: center;">
            <img class="author lazyload" itemprop="image" data-src="{{ fromDLHost($author->img) }}" alt="">
          </div>
          <div class="col-xs-8 col-sm-8 col-md-8 col-xl-9">
            <h1>درباره مدرس {{ $author->name }}</h1>
            <p id="author-bio" class="text-justify">
              {{-- {{ $author->description }} --}}
              {{-- {!! $author->description !!} --}}
              {!! nl2br(e($author->description)) !!}
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3 mr-0 ml-0">
      <div class="card col-md-12 mb-4">
        <article class="card-group-item">
          <div class="filter-content">
            {{-- {{ csrf_field() }} --}}
            <div class="card-header text-left my-3 current-page-path">
              تعداد کل دروس <b>{{ $total_courses }}</b>
            </div>
            <div class="card-body clearfix" id="list-items">
              <div class="row d-flex ">
                @foreach ($courses as $course)
                  @include('courses.partials._course_list_grid', ['course' => $course])
                @endforeach
              </div>
            </div>
          </div>
        </article>
      </div>
    </div>

  </div>
@endsection
