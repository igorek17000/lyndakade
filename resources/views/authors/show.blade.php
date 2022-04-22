@extends('layouts.app')
@push('meta.in.head')
  @if (isset($user))
    @include('meta::manager', [
        'image' => fromDLHost($user->avatar),
        'title' => 'دوبلور ' . $user->name . ' - لیندا کده',
        'keywords' => get_seo_keywords() . ' , ' . 'دوبلور ' . $user->name . ' , dubbed ' . $user->name,
        'description' => $user->description . ' | ' . get_seo_description(),
    ])
    <script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "headline": "دوبلور {{ $user->name }}",
        "url": "{{ route('dubbed.index', [$user->username]) }}",
        "image": "{{ fromDLHost($user->avatar) }}"
      }
    </script>
  @else
    @include('meta::manager', [
        'image' => fromDLHost($author->img),
        'title' => 'مدرس ' . $author->name . ' - لیندا کده',
        'keywords' => get_seo_keywords() . ' , ' . 'مدرس ' . $author->name . ' , author ' . $author->name,
        'description' => $author->description . ' | ' . get_seo_description(),
    ])
    <script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "headline": "مدرس {{ $author->name }}",
        "url": "{{ route('authors.show', [$author->slug]) }}",
        "image": "{{ fromDLHost($author->img) }}"
      }
    </script>
  @endif

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
        @if (isset($author))
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
        @else
          <link itemprop="url" href="{{ route('dubbed.index', [$user->username]) }}" rel="author">
        @endif
        <div class="row author-details">
          @if (isset($author))
            <div class="col-xs-4 col-sm-4 col-md-4 col-xl-3" style="text-align: center;">
              <img class="author lazyload" itemprop="image" data-src="{{ fromDLHost($author->img) }}"
                alt="عکس مدرس {{ $author->name }} - Image of Author {{ $author->name }}">
            </div>
            <div class="col-xs-8 col-sm-8 col-md-8 col-xl-9">
              <h1>درباره مدرس {{ $author->name }}</h1>
              <p id="author-bio" class="text-justify">
                {{-- {{ $author->description }} --}}
                {{-- {!! $author->description !!} --}}
                {!! nl2br(e($author->description)) !!}
              </p>
            </div>
          @else
            <div class="col-xs-4 col-sm-4 col-md-4 col-xl-3" style="text-align: center;">
              <img class="author lazyload" itemprop="image" data-src="{{ fromDLHost($user->avatar) }}"
                alt="عکس دوبلور {{ $user->name }} - Image of {{ $user->name }}">
            </div>
            <div class="col-xs-8 col-sm-8 col-md-8 col-xl-9">
              <h1>درباره دوبلور {{ $user->name }}</h1>
              <p id="author-bio" class="text-justify">
                {{-- {{ $author->description }} --}}
                {{-- {!! $author->description !!} --}}
                {!! nl2br(e($user->description)) !!}
              </p>
            </div>
          @endif
        </div>
      </div>
    </div>
    <div class="row mt-3 mr-0 ml-0">
      <div class="card col-md-12 mb-4">
        <article class="card-group-item">
          <div class="filter-content">
            {{-- {{ csrf_field() }} --}}
            <div class="card-header text-left mt-3 current-page-path">
              تعداد کل دروس <b>{{ $total_courses }}</b>
            </div>
            <div class="card-body clearfix" id="list-items">
              <div class="row d-flex ">
                <div class="col-sm-10 col-8 text-center" id="course-list-parent">
                  <div id="course-list">
                    <div class="d-flex justify-content-center mt-5">
                      <div class="spinner-border c-spinner-border" role="status">
                        <span class="sr-only">در حال بارگیری ...</span>
                      </div>
                    </div>
                  </div>
                  <button class="mt-2 btn btn-info load-more-courses">
                    موارد بیشتر
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
      var is_user = '{{ isset($author) ? false : true }}';
      console.log(is_user);

      var load_more_html = `
          <button class="mt-2 btn btn-info load-more-courses">
            موارد بیشتر
          </button>`;

      var loading_html = `
        <div class="d-flex justify-content-center mt-5">
            <div class="spinner-border c-spinner-border" role="status">
                <span class="sr-only">در حال بارگیری ...</span>
            </div>
        </div>`;

      var error_html = `
        <div class="d-flex justify-content-center mt-5">
            <div style="font-size: 1rem;">خطایی رخ داده است، لطفا دوباره امتحان کنید.</div>
        </div>`;
      var $request = null;
      var course_list_parent = document.getElementById('course-list-parent');
      var course_list = document.getElementById('course-list');

      function get_courses() {
        if ($request != null) {
          $request.abort();
          $request = null;
        }

        $(course_list).html(loading_html);

        var sortingOrder = document.querySelectorAll('input[name="sortingOrder"]:checked').length > 0 ?
          document.querySelectorAll('input[name="sortingOrder"]:checked')[0].getAttribute('data-id') :
          '1';
        var libraries = [...document.querySelectorAll('input[name="library"]:checked')].map((el) => {
          return $(el).data('id')
        }).join();

        var language = document.querySelectorAll('input[name="language"]:checked').length > 0 ?
          document.querySelectorAll('input[name="language"]:checked')[0].getAttribute('data-id') :
          '3';

        var data = {
          _token: $('[name="_token"]').val(),
          onlyFree: $('#onlyFree')[0].checked ? '1' : '0',
          sortingOrder: sortingOrder,
          libraries: libraries,
          language: language,
        };

        console.log(sortingOrder, libraries, language, data);

        $request = $.ajax({
          url: "{{ route('main-page.courses.api') }}",
          method: 'post',
          data: data,
          success: function(result) {
            // console.log("result", result);
            $(course_list).html(result.data);
            $request = null;
            if (!result.hasMore) {
              $('.load-more-courses').remove();
            } else {
              if (!document.querySelector('.load-more-courses'))
                course_list_parent.insertAdjacentHTML('beforeend', load_more_html)
            }
          },
          errors: function(xhr) {
            console.log("xhr", xhr);
            $(course_list).html(error_html);
            $request = null;
          }
        });
      }
      get_courses();

      var $request2 = null;

      function more_courses(relatedTarget) {
        if ($request2 != null) {
          $request2.abort();
          $request2 = null;
        }
        var sortingOrder = document.querySelectorAll('input[name="sortingOrder"]:checked').length > 0 ?
          document.querySelectorAll('input[name="sortingOrder"]:checked')[0].getAttribute('data-id') :
          '1';
        var libraries = [...document.querySelectorAll('input[name="library"]:checked')].map((el) => {
          return $(el).data('id')
        }).join();
        var language = document.querySelectorAll('input[name="language"]:checked').length > 0 ?
          document.querySelectorAll('input[name="language"]:checked')[0].getAttribute('data-id') :
          '3';
        var page = (document.querySelectorAll('#course-list > div').length / 20) + 1;
        var data = {
          _token: $('[name="_token"]').val(),
          onlyFree: $('#onlyFree')[0].checked ? '1' : '0',
          sortingOrder: sortingOrder,
          libraries: libraries,
          page: page,
          language: language,
        };

        console.log(sortingOrder, libraries, language, data);
        $request2 = $.ajax({
          url: "{{ route('main-page.courses.api') }}",
          method: 'post',
          data: data,
          success: function(result) {
            // console.log("result", result);
            course_list.insertAdjacentHTML('beforeend', result.data)
            // $(course_list).html(result.data);
            $request2 = null;
            if (!result.hasMore) {
              $('.load-more-courses').remove();
            } else {
              if (!document.querySelector('.load-more-courses'))
                course_list_parent.insertAdjacentHTML('beforeend', load_more_html)
            }
          },
          errors: function(xhr) {
            console.log("xhr", xhr);
            // $(course_list).html(error_html);
            $request2 = null;
          }
        });
      }
      $(document).on('click', '.load-more-courses', function(e) {
        more_courses(e.relatedTarget);
      });
    });
  </script>
@endpush
