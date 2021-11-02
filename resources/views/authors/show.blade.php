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
      "url": "{{ route('authors.show', [$author->slug]) }}",
      "image": "{{ fromDLHost($author->img) }}"
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
                <style>
                  .timeline>li>.timeline-panel {
                    width: calc(100% - 15px) !important;
                  }

                  .timeline:before {
                    width: 0 !important;
                  }

                </style>
                <ul class="timeline pb-0" id="course-list">
                  @foreach ($courses as $course)
                    @include('courses.partials._course_list_timeline', ['course'=> $course])
                  @endforeach
                </ul>

                <div class="col-12 mb-4 mt-2">
                  <button class="btn btn-light load-more w-100" coursetype="button" style="margin: auto;">
                    <span class="text-t">نمایش موارد بیشتر</span>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                      style="margin: auto;"></span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </article>
      </div>
    </div>

  </div>
@endsection

@push('js')
  <script>
    $(function() {
      $('.load-more').click(function(e) {
        var page = ($('#course-list .course').length / 20) + 1;
        var el = this;
        $(el).prop('disabled', true);
        urlObject = new URL(document.location.href);
        params = urlObject.searchParams;
        let data = {
          _token: $('[name="_token"]').val(),
          page: page,
        }
        $.ajax({
          url: window.location.href.split('?')[0],
          method: 'get',
          data,
          success: function(result) {
            var course_list = document.getElementById('course-list');
            for (let res of result.courses) {
              // console.log(res);
              course_list.insertAdjacentHTML('beforeend', res)
            }
            if (result.hasMore) {
              $(el).prop('disabled', false);
            } else {
              setTimeout(() => {
                $(el).remove();
              }, 600);
            }
          },
          errors: function(xhr) {
            console.log(xhr);
            $(el).prop('disabled', false);
          }
        });
      })
    });
  </script>
@endpush
