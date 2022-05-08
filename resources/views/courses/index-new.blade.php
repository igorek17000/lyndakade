@extends('layouts.app')
@push('meta.in.head')
  <link rel="canonical" href="https://lyndakade.ir">
  <link rel="alternate" hreflang="fa" href="https://lyndakade.ir">
  {{-- <link rel="stylesheet" href="https://seiyria.com/bootstrap-slider/css/bootstrap-slider.css"> --}}

  @include('meta::manager', [
      'image' => 'https://lyndakade.ir/image/logo.png',
      'title' => 'لیندا کده بروز ترین وبسایت آموزشی',
      'keywords' => get_seo_keywords(),
      'description' => get_seo_description(),
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
            "name": "لیندا کده بروز ترین وبسایت آموزشی",
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
              "@id": "{{ route('courses.newest') }}",
              "name": "New Courses - جدیدترین دوره ها",
              "url": "{{ route('courses.newest') }}"
            }
          }, {
            "@type": "ListItem",
            "position": 2,
            "item": {
              "@id": "{{ route('learn.paths.index') }}",
              "name": "Learning Paths - مسیر آموزشی",
              "url": "{{ route('learn.paths.index') }}"
            }
          }, {
            "@type": "ListItem",
            "position": 3,
            "item": {
              "@id": "{{ route('packages.index') }}",
              "name": "Buy Packages - خرید اشتراک",
              "url": "{{ route('packages.index') }}"
            }
          }, {
            "@type": "ListItem",
            "position": 4,
            "item": {
              "@id": "{{ route('demands.create') }}",
              "name": "Request Course - درخواست دوره",
              "url": "{{ route('demands.create') }}"
            }
          }, {
            "@type": "ListItem",
            "position": 5,
            "item": {
              "@id": "{{ route('root.contact.us') }}",
              "name": "Contact Us - تماس با ما",
              "url": "{{ route('root.contact.us') }}"
            }
          }, {
            "@type": "ListItem",
            "position": 6,
            "item": {
              "@id": "{{ route('faq') }}",
              "name": "FAQ - سوالات متداول",
              "url": "{{ route('faq') }}"
            }
          }]
        }
      ]
    }
  </script>
@endpush

@section('content')
  <div class="row m-0 home-page">
    <div class="col-12 hero-space" style="min-height: 440px; height: auto;">
      <div class="hero-text">
        <h1 style="font-size: 2.25rem;">
          دانلود آموزش های وبسایت
          <a href="https://www.linkedin.com/learning" style="color: #2977c9;">لینکدین</a>
          به همراه زیرنویس فارسی و انگلیسی
        </h1>
        @guest
          <div>برای خرید و دانلود آموزش ها وارد حساب کاربری خود شوید</div>
        @endguest
        <div style="margin-top: 5%; margin-bottom: 2%;">
          برای جستجوی درس مربوطه کافی است لینک مربوط به درس را که در
          <a href="https://www.linkedin.com/learning" style="color: #2977c9;">سایت لینکدین</a>
          است را وارد کنید
        </div>
        <div class="row m-0 p-0 no-dark">
          <div class="col-12 m-0 p-0">
            <form id="url-form" name="url-form">
              <div class="row justify-content-center px-0 no-dark">
                <div class="col-12 px-0 px-md-2">
                  <input id="url" name="url" type="text" class="form-control"
                    placeholder="https://www.linkedin.com/learning/writing-articles-2" dir="ltr">
                </div>
                <button type="submit" class="btn btn-primary w-auto">ارسال</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container my-3">
    <div class="row">
      <div class="col-lg-3 col-sm-6 d-md-block d-none">
        <div class="card-box pb-2"
          style="background-color:#00aaca;border-radius: 10px;max-height: 143px;height: 143px !important">
          <div class="inner pt-0" style="position: relative;">
            <h3 class="counter"
              style="color: black;float: left;margin: auto;position: absolute;top: 50%;left: 20px;-ms-transform: translateY(-50%);transform: translateY(-50%);">
              {{ get_number_of_all_courses() }}</h3>
            <p style="color: black;width: 60%;" class="text-center"> تعداد دوره‌های آموزشی سایت </p>
          </div>
          <div class="inner pt-0" style="position: relative;">
            <h3 class="counter"
              style="color: black;float: left;margin: auto;position: absolute;top: 50%;left: 20px;-ms-transform: translateY(-50%);transform: translateY(-50%);">
              {{ get_number_of_all_paths() }}</h3>
            <p style="color: black;width: 60%;" class="text-center">تعداد مسیرهای آموزشی سایت</p>
          </div>
          <div class="icon">
            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6 d-md-none">
        <div class="card-box" style="background-color:#00aaca;border-radius: 10px">
          <div class="inner">
            <h3 class="counter ml-2" style="color: black">{{ get_number_of_all_courses() }}</h3>
            <p style="color: black" class="mr-2"> تعداد دوره‌های آموزشی سایت </p>
          </div>
          <div class="icon">
            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 d-md-none">
        <div class="card-box" style="background-color:#00aaca;border-radius: 10px">
          <div class="inner">
            <h3 class="counter ml-2" style="color: black">{{ get_number_of_all_paths() }}</h3>
            <p style="color: black" class="mr-2"> تعداد مسیرهای آموزشی سایت </p>
          </div>
          <div class="icon">
            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card-box" style="background-color:#00aaca;border-radius: 10px">
          <div class="inner">
            <h3 class="counter ml-2" style="color: black">{{ get_sum_of_all_courses_part_numbers() }}</h3>
            <p style="color: black" class="mr-2"> تعداد کل ویدیوهای آموزشی </p>
          </div>
          <div class="icon">
            <i class="fa fa-video" aria-hidden="true"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card-box" style="background-color:#00aaca;border-radius: 10px">
          <div class="inner">
            <h3 class="counter ml-2" style="color: black">{{ get_sum_of_all_courses_time() }}</h3>
            <p style="color: black" class="mr-2"> زمان کل آموزشهای سایت (دقیقه)</p>
          </div>
          <div class="icon">
            <i class="fa fa-clock" aria-hidden="true"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card-box" style="background-color:#00aaca;border-radius: 10px">
          <div class="inner">
            <h3 class="counter ml-2" style="color: black">{{ get_number_of_authors_has_at_least_one_course() }}</h3>
            <p style="color: black" class="mr-2">تعداد مدرسان </p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row card mx-0 pb-3">
    <div class="learn-path container">
      <h5 class="my-0 mt-2"> مسیرهای آموزشی
        <a class="btn btn-primary btn-xs mr-3" href="{{ route('learn.paths.index') }}" style="max-width: 110px;">مشاهده
          بیشتر</a>
      </h5>
      <hr style="border-top: 1px solid  #f8ba16" class="my-2">
      <div class="row">
        @foreach (\App\LearnPath::inRandomOrder()->limit(8)->get()
      as $path)
          @include('learn_paths.partials.list_item_grid_new', [
              'path' => $path,
              'loop' => $loop,
          ])
        @endforeach
      </div>
    </div>
  </div>

  <div class="row card mx-0 mt-4 pb-4">
    <div class="course container-fluid">
      <h5 class="mt-3 ">
        دوره های آموزشی
      </h5>
      <hr style="border-top: 1px solid  #f8ba16" class="my-2">
      <div class="row">
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


  <div class="modal fade" id="form-link-modal" tabindex="-1" role="dialog" aria-labelledby="form-link-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content text-center" style="background-color: orange;">
        <div class="modal-header" style="border-color: orange;">
          <h5 class="modal-title" id="form-link-modal-title">نتیجه جستجو</h5>
          <button type="button" class="close ml-0 mr-auto" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="form-link-modal-body" style="font-size: 1.5rem;">
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
      </div>
    </div>
  </div>
@endsection

@section('script_body')
  {{-- <script src="https://seiyria.com/bootstrap-slider/js/bootstrap-slider.js"></script> --}}

  <script>
    function range(start, stop, step = 1) {
      if (stop > start) {
        return [...range(start, stop - step, step), stop];
      }
      return [start];
    }
    // $(function() {
    //   $("#price-range").slider({
    //     min: 0,
    //     max: 100000,
    //     value: [0, 100000],
    //     step: 5000,
    //     // ticks: range(5000, 100000, 5000),
    //     // lock_to_ticks: true,
    //     // ticks_tooltip: true,
    //   });
    // });

    function perToEng(str) {
      var
        persianNumbers = [/۰/g, /۱/g, /۲/g, /۳/g, /۴/g, /۵/g, /۶/g, /۷/g, /۸/g, /۹/g],
        arabicNumbers = [/٠/g, /١/g, /٢/g, /٣/g, /٤/g, /٥/g, /٦/g, /٧/g, /٨/g, /٩/g];
      if (typeof str === 'string') {
        for (var i = 0; i < 10; i++) {
          str = str.replace(persianNumbers[i], i).replace(arabicNumbers[i], i);
        }
      }
      return str;
    }

    function engToPer(n) {
      const farsiDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

      return n
        .toString()
        .replace(/\d/g, x => farsiDigits[x]);
    }

    $(document).ready(function() {
      $('.counter').each(function() {
        $(this).prop('Counter', 0).animate({
          Counter: perToEng($(this).text())
        }, {
          duration: 5000,
          easing: 'swing',
          step: function(now) {
            $(this).text(engToPer(Math.ceil(now)));
          }
        });
      });

      //   $(document).on('click', '.btn-subject-preview', function(e) {
      //     e.preventDefault();
      //     alert($(e.target.parentNode).text());
      //   });
    });

    $(function() {
      $('.shadow #myTab > li > a').click((e) => {
        setTimeout(() => {
          document.querySelectorAll('#myTabContent div[role="tabpanel"].show').forEach(el => {
            el1 = $(el);
            el1.removeClass('show');
          });
          let element = $('#myTabContent div[role="tabpanel"].active');
          element.addClass('show');
        }, 200);
      });
    });

    $(function() {
      document.getElementById('url-form').onsubmit = function(e) {
        let url = $('#url').val();
        $.ajax({
          url: "{{ route('course.api.with-link') }}",
          method: 'post',
          data: {
            'link': url
          },
          success: (result) => {
            console.log("result", result);
            if (result.status == 'success') {
              // $('#url').val('');
              window.location.href = result.url;
              return;
            } else if (result.status == 'link is required') {
              $('#form-link-modal-body').text('لینک را باید وارد کنید.');
            } else if (result.status == 'link is not valid') {
              $('#form-link-modal-body').text('لینک نامعتبر میباشد.');
            } else if (result.status == 'course was not found') {
              // $('#form-link-modal-body').text('دوره آموزشی یافت نشد.');
              $('#form-link-modal-body')[0].innerHTML =
                '<p>دوره آموزشی یافت نشد</p><a class="btn btn-primary" href="{{ route('demands.create') }}">درخواست دوره</a>';
            } else {
              $('#form-link-modal-body').text('خطای پیش بینی نشده رخ داده است، لطفا دوباره تلاش کنید.');
            }
            $('#form-link-modal').modal('toggle');
          },
          errors: (xhr) => {
            $('#form-link-modal-body').text('خطای پیش بینی نشده رخ داده است، لطفا دوباره تلاش کنید.');
            $('#form-link-modal').modal('toggle');
          }
        })
        return false;
      };
    });

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
        // console.log('event', e);
        // document.querySelector('.load-more-courses').setAttribute('disabled', true);
        // setTimeout(() => {
        //   document.querySelector('.load-more-courses').setAttribute('disabled', false);
        // }, 4000);
        more_courses(e.relatedTarget);
      });
    });
  </script>
@endsection
