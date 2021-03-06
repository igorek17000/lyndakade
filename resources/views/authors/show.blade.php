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
              "name": "دوبلور {{ $user->name }} - لیندا کده",
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
                "@id": "{{ route('dubbed.index', [$user->username]) }}",
                "name": "دوبلور {{ $user->name }}",
                "url": "{{ route('dubbed.index', [$user->username]) }}"
              }
            }]
          },
          {
            "@context": "https://schema.org",
            "@type": "WebPage",
            "headline": "دوبلور {{ $user->name }}",
            "url": "{{ route('dubbed.index', [$user->username]) }}",
            "image": "{{ fromDLHost($user->avatar) }}"
          }
        ]
      }
    </script>
  @elseif (isset($author))
    @include('meta::manager', [
        'image' => fromDLHost($author->img),
        'title' => 'مدرس ' . $author->name . ' - لیندا کده',
        'keywords' => get_seo_keywords() . ' , ' . 'مدرس ' . $author->name . ' , author ' . $author->name,
        'description' => $author->description . ' | ' . get_seo_description(),
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
              "name": "مدرس {{ $author->name }} - لیندا کده",
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
                "@id": "{{ route('authors.show', [$author->slug]) }}",
                "name": "مدرس {{ $author->name }}",
                "url": "{{ route('authors.show', [$author->slug]) }}"
              }
            }]
          },
          {
            "@context": "https://schema.org",
            "@type": "WebPage",
            "headline": "مدرس {{ $author->name }}",
            "url": "{{ route('authors.show', [$author->slug]) }}",
            "image": "{{ fromDLHost($author->img) }}"
          }
        ]
      }
    </script>
  @endif

@endpush
@section('content')
  <div class="row card mx-0 pb-4">
    <div class="container">
      @if (isset($author))
        <div class="row mx-0 mt-3">
          <div class="col-xs-12">
            <div class="current-page-path">
              <a href="{{ route('authors.index') }}">تمام مدرسان</a>
              <i class="lyndacon arrow-left"></i>
              <span>{{ $author->name }}</span>
            </div>
          </div>
        </div>
      @endif
      <div class="row mx-0 author-details mt-3">
        @if (isset($author))
          <div class="col-xs-4 col-sm-4 col-md-4 col-xl-3" style="text-align: center;">
            <img class="author lazyload" data-src="{{ fromDLHost($author->img) }}"
              alt="عکس مدرس {{ $author->name }} - Image of Author {{ $author->name }}"
              style="width: 200px !important;height: 200px !important; border-radius: 50% !important;">
          </div>
          <div class="col-xs-8 col-sm-8 col-md-8 col-xl-9">
            <h1 style="font-size: 23px; font-weight: 700; margin: 0;">درباره مدرس {{ $author->name }}</h1>
            <p class="text-justify" style="font-size: 17px;margin: 0;">
              {!! nl2br(e($author->description)) !!}
            </p>
          </div>
        @else
          <div class="col-xs-4 col-sm-4 col-md-4 col-xl-3" style="text-align: center;">
            <img class="author lazyload" data-src="{{ fromDLHost($user->avatar) }}"
              alt="عکس دوبلور {{ $user->name }} - Image of {{ $user->name }}"
              style="width: 200px !important;height: 200px !important; border-radius: 50% !important;">
          </div>
          <div class="col-xs-8 col-sm-8 col-md-8 col-xl-9">
            <h1 style="font-size: 23px; font-weight: 700; margin: 0;">درباره دوبلور {{ $user->name }}</h1>
            <p class="text-justify" style="font-size: 17px;margin: 0;">
              {!! nl2br(e($user->description)) !!}
            </p>
          </div>
        @endif
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
@endsection

@push('js')
  <script>
    $(function() {
      var is_user = "{{ isset($author) ? 'false' : 'true' }}";
      var user_username_or_author_slug = "{{ isset($author) ? $author->slug : $user->username }}";

      //   console.log(is_user);
      //   console.log(is_user, (is_user == 'false'));

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

        if (is_user == 'false') {
          data['author_slug'] = user_username_or_author_slug;
        } else {
          data['user_username'] = user_username_or_author_slug;
        }
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
        };

        if (is_user == 'false') {
          data['author_slug'] = user_username_or_author_slug;
        } else {
          data['user_username'] = user_username_or_author_slug;
        }
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
  </script>
@endpush
