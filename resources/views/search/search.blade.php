@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager', [
      'image' => 'https://lyndakade.ir/image/logo.png',
      'title' => 'جستجوی ' . $q . ' - لیندا کده',
      'keywords' => get_seo_keywords(),
      'description' => get_seo_description(),
  ])
@endpush
@section('content')
  <div class="row card mx-0 pb-4">
    <div class="container">
      <div class="row mx-0 author-details mt-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 container-fluid">
          <h1 style="font-size: 23px; font-weight: 700; margin: 0;">
            {{ nPersian($total_courses) }} نتیجه برای "{{ $q }}"
          </h1>
        </div>
      </div>
    </div>
    <div class="course container-fluid">
      <div class="text-center mt-3">
        <b style="font-size: 1rem;font-weight: 600;">
          تعداد کل دروس {{ $total_courses }}
        </b>
      </div>
      <hr style="border-top: 1px solid  #f8ba16" class="my-2">
      <div class="row mx-0">
        <div class="col-sm-2 col-4">
          <ul style="position: sticky;top: 15px;">
            <li><b>قیمت</b>
              <ul>
                <li>
                  <input type="checkbox" id="onlyFree" name="onlyFree" class="cat"><label for="onlyFree"
                    type="checkbox">رایگان</label>
                </li>
              </ul>
            </li>
            <li><b>ترتیب</b>
              <ul>
                <li>
                  <input type="radio" id="newest" name="sortingOrder" class="cat" data-id="1">
                  <label for="newest" type="radio">جدیدترین</label>
                </li>
                <li>
                  <input type="radio" id="popular" name="sortingOrder" class="cat" data-id="2">
                  <label for="popular" type="radio">محبوب ترین</label>
                </li>
              </ul>
            </li>
            <li><b>زبان</b>
              <ul>
                <li>
                  <input type="radio" id="language-persian" name="language" class="cat" data-id="1">
                  <label for="language-persian" type="radio">فارسی</label>
                </li>
                <li>
                  <input type="radio" id="language-english" name="language" class="cat" data-id="2">
                  <label for="language-english" type="radio">انگلیسی</label>
                </li>
                <li>
                  <input type="radio" id="language-all" name="language" class="cat" data-id="3">
                  <label for="language-all" type="radio">همه موارد</label>
                </li>
              </ul>
            </li>
            <li><b>کتابخانه</b>
              <ul>
                <li>
                  <input type="checkbox" id="business" name="library" class="cat" data-id="1">
                  <label for="business" type="checkbox">کسب و کار</label>
                </li>
                <li>
                  <input type="checkbox" id="technology" name="library" class="cat" data-id="3">
                  <label for="technology" type="checkbox">تکنولوژی</label>
                </li>
                <li>
                  <input type="checkbox" id="creative" name="library" class="cat" data-id="2">
                  <label for="creative" type="checkbox">خلاقیت</label>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="col-sm-10 col-8 text-center" id="course-list-parent">
          <div id="course-list">
            <div class="d-flex justify-content-center mt-5">
              <div class="spinner-border c-spinner-border" role="status">
                <span class="sr-only">در حال بارگیری ...</span>
              </div>
            </div>
          </div>
          {{-- <button class="mt-2 btn btn-info load-more-courses">
            موارد بیشتر
          </button> --}}
        </div>
      </div>
    </div>
  </div>
  {{-- <div class="container search-page">

    @if (isset($shown_item))
            <div class="row mb-5 justify-content-center shown-item">
                @if (isset($shown_item->img))
                    <div class="col-xs-12 col-md-6 subject-img" style="background-image: url({{ fromDLHost($shown_item->img) }});background-size: cover;" >
                    </div>
                @endif
                <div class="col-xs-12 col-md-6 subject-details">
                    <h1 class="subject-title">
                        {{ $shown_item->title }}
                    </h1>
                    @if ($shown_item->description)
                        <p class="subject-description text-justify">
                            {{ $shown_item->description }}
                        </p>
                    @endif
                </div>
            </div>
        @endif

    <div class="row my-3 justify-content-center">
      <aside id="search-filters" class="col-md-2 hidden-xs hiddem-sm search-filter-cont">
        <nav class="navbar navbar-expand  flex-md-column flex-row align-items-start">
          <ul
            class="filter-set ga-category accessible-tabs flex-md-column flex-row navbar-nav w-100 justify-content-between"
            data-context="Category Filters">
            @if (isset($categories_filter) && count($categories_filter) > 0)
              @foreach ($categories_filter as $category)
                <li class="nav-item">
                  <span style="font-size: 1rem;"><b>{{ $category['title'] }}</b></span>
                  <ul>
                    @foreach ($category['items'] as $index => $item)
                      <li class="filter-item"
                        @if ($index > 4) style="{{ $index > 4 ? 'display:none;' : '' }}" @endif>
                        @if (isset($_GET[$category['key']]) && ($_GET[$category['key']] == $item['title'] || (isset($item['titleEng']) && $_GET[$category['key']] == $item['titleEng'])))
                          <span>
                            <strong>{{ $item['title'] }}<span
                                class="result-count">({{ $item['count'] }})</span></strong>
                          </span>
                        @else
                          <a class="filter ga ga-multiple" rel="nofollow" href="{{ $item['link'] }}">
                            {{ $item['title'] }}<span class="result-count">&nbsp;({{ $item['count'] }})</span>
                          </a>
                        @endif
                      </li>
                    @endforeach
                    @if ($category['hasMore'])
                      <li class="show-more-toggle">
                        <button class="btn btn-link">
                          <span>+ موارد بیشتر</span>
                        </button>
                      </li>
                    @endif
                  </ul>
                </li>
              @endforeach
            @endif
          </ul>
        </nav>
      </aside>

      <section class="col-xs-12 col-md-10 search-results-cont pull-left">

        <div class="row">
          <section id="search-results-bar">
            <div class="row mx-1">
              @if (isset($result_count) && isset($q))
                <div class="results-heading col-xs-12 col-sm-8">
                  {{ $result_count }}
                  مورد برای
                  <span class="term">{{ $q }}</span>
                  {{ count($_GET) > 1 ? ' و موارد انتخاب شده ' : '' }}
                  یافته شد
                </div>
              @else
                <div class="results-heading col-xs-12 col-sm-8">
                </div>
              @endif
              <div class="hidden-xs col-sm-4">
                <div class="sort-filters">
                  <span>مرتب شده با</span>
                  <select name="sort">
                    <option value="1">بیشترین مطابقت</option>
                    <option value="2">تاریخ انتشار</option>
                  </select>
                </div>
              </div>
              @if (isset($filtered_items) && count($filtered_items) > 0)
                <div class="col-xs-12 pills">
                  <div class="selected-filters">
                    <span class="filtered-title">موارد انتخاب شده</span>
                    <ul class="active-filters">
                      @foreach ($filtered_items as $filtered_item)
                        <li>
                          <a class="filter-remove" href="{{ $filtered_item['link'] }}"
                            data-type="{{ $filtered_item['key'] }}" data-name="{{ $filtered_item['title'] }}">
                            <span class="sr-only">{{ $filtered_item['title'] }} - Remove filter</span>
                            <span class="label" aria-hidden="true"><i
                                class="lyndacon close-x"></i>{{ $filtered_item['title'] }}</span>
                          </a>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              @endif
            </div>
          </section>
          @if (isset($object))
            <div class="row flex-row flex-wrap w-100 py-3 {{ $object['img'] ? '' : ' px-3 ' }}">
              @if ($object['img'])
                <div class="card-header border-0" style="
                                        max-width: 160px;
                                        background: transparent;
                                    ">
                  <img src="{{ fromDLHost($object['img']) }}"
                    alt="جستجوی {{ $object['title'] }} - search for {{ $object['title'] }}" style="
                                        width: 100%;
                                        border-radius: 50%;
                                    ">
                </div>
              @endif
              <div class="card-block px-2" style="{{ $object['img'] ? ' max-width: 70%; ' : '' }}">
                <span class="card-title mb-2">{{ $object['type'] }}</span>
                <p></p>
                <h2 class="card-title">{{ $object['title'] }}</h2>
                <p class="card-text text-justify">{{ $object['description'] }}</p>
              </div>
              <div class="w-100"></div>
            </div>
          @endif
          <section id="search-results">

              <div class="row mx-1" id="search-results-list">
              @if (count($courses) == 0)
                نتیجه ای یافت نشد.
              @endif
              <div id="course-list">
                @include('courses.partials._course_list_new_total', [
                    'courses' => $courses,
                ])
              </div>
                @if ($hasMore ?? false)
                <div class="col-12 mb-4 mt-2">
                  <button class="btn btn-light load-more w-100" coursetype="button" style="margin: auto;">
                    <span class="text-t">نمایش موارد بیشتر</span>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                      style="margin: auto;"></span>
                  </button>
                </div>
              @endif
            </div>
          </section>
        </div>
      </section>
    </div>
  </div> --}}
@endsection
@push('js')
  <script>
    $(function() {

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
          q: '{{ $q }}',
        };

        console.log(data);

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
      $(document).on('click', '.cat', function(e) {
        get_courses();
      });

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
          q: '{{ $q }}',
        };

        console.log(data);

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

    // $(function() {
    //   $('.load-more').click(function(e) {
    //     var page = ($('#course-list .course').length / 20) + 1;
    //     var el = this;
    //     $(el).prop('disabled', true);
    //     urlObject = new URL(document.location.href);
    //     params = urlObject.searchParams;
    //     let data = {
    //       _token: $('[name="_token"]').val(),
    //       page: page,
    //     }
    //     for (let item of params) {
    //       let pa = item[0],
    //         pb = item[1];
    //       data[pa] = pb;
    //     }
    //     $.ajax({
    //       url: window.location.href.split('?')[0],
    //       method: 'get',
    //       data,
    //       success: function(result) {
    //         var course_list = document.getElementById('course-list');
    //         for (let res of result.courses) {
    //           // console.log(res);
    //           course_list.insertAdjacentHTML('beforeend', res)
    //         }
    //         if (result.hasMore) {
    //           $(el).prop('disabled', false);
    //         } else {
    //           setTimeout(() => {
    //             $(el).remove();
    //           }, 600);
    //         }
    //       },
    //       errors: function(xhr) {
    //         console.log(xhr);
    //         $(el).prop('disabled', false);
    //       }
    //     });
    //   })


    // });
  </script>
@endpush
