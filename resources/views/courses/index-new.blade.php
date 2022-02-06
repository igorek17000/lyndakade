@extends('layouts.app-test')
@push('meta.in.head')
  <link rel="canonical" href="https://lyndakade.ir">
  <link rel="alternate" hreflang="fa" href="https://lyndakade.ir">

  @include('meta::manager',[
  'image' => 'https://lyndakade.ir/image/logo.png',
  'title' => 'لیندا کده بروز ترین وبسایت آموزشی',
  'keywords' => get_seo_keywords(),
  'description' => get_seo_description(),
  ])

  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "Lynda Kade - لیندا کده",
      "url": "https://lyndakade.ir/",
      "potentialAction": {
        "@type": "SearchAction",
        "target": {
          "@type": "EntryPoint",
          "urlTemplate": "https://lyndakade.ir/search?q={search_term_string}"
        },
        "query-input": "required name=search_term_string"
      }
    }
  </script>

  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [{
        "@type": "ListItem",
        "position": 1,
        "item": {
          "@id": "{{ route('courses.newest') }}",
          "name": "New Courses - جدیدترین دوره ها"
        }
      }, {
        "@type": "ListItem",
        "position": 2,
        "item": {
          "@id": "{{ route('learn.paths.index') }}",
          "name": "Learning Paths - مسیر آموزشی"
        }
      }, {
        "@type": "ListItem",
        "position": 3,
        "item": {
          "@id": "{{ route('packages.index') }}",
          "name": "Buy Packages - خرید اشتراک"
        }
      }, {
        "@type": "ListItem",
        "position": 4,
        "item": {
          "@id": "{{ route('demands.create') }}",
          "name": "Request Course - درخواست دوره"
        }
      }, {
        "@type": "ListItem",
        "position": 5,
        "item": {
          "@id": "{{ route('root.contact.us') }}",
          "name": "Contact Us - تماس با ما"
        }
      }, {
        "@type": "ListItem",
        "position": 6,
        "item": {
          "@id": "{{ route('faq') }}",
          "name": "FAQ - سوالات متداول"
        }
      }]
    }
  </script>
@endpush
@section('content')
  <style>
    .hero-space {
      height: 450px !important;
    }

    @media (min-width: 426px) {
      .hero-space {
        height: 300px !important;
      }
    }

    @media (min-width: 769px) {
      .hero-space {
        height: 310px !important;
      }
    }

    @media (min-width: 1025px) {
      .hero-space {
        height: 260px !important;
      }
    }

    .show-xs {
      display: none !important;
    }

    @media (max-width: 767px) {
      .show-xs {
        display: block !important;
      }
    }

  </style>
  <div class="row m-0 home-page">
    <div class="col-12 hero-space">
      <div class="hero-text" style="background-color: rgba(255, 255, 255, 0.5) !important;">
        <h1 style="font-size: 2.25rem;">
          دانلود آموزش های وبسایت
          <a href="https://www.linkedin.com/" style="color: #2977c9;">لینکدین</a>
          به همراه زیرنویس فارسی و انگلیسی
        </h1>
        @guest
          <div>برای خرید و دانلود آموزش ها وارد حساب کاربری خود شوید</div>
        @endguest
        <div style="margin-top: 5%; margin-bottom: 2%;">
          برای جستجوی درس مربوطه کافی است لینک مربوط به درس را که در
          <a href="https://www.linkedin.com/" style="color: #2977c9;">سایت لینکدین</a>
          است را وارد کنید
        </div>
        <div class="row m-0 p-0">
          <div class="col-12 m-0 p-0">
            <form id="url-form" name="url-form">
              <div class="row justify-content-center px-0">
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

  @if (count($paths) > 0)

    <div class="row card mx-0">
      <div class="container">
        <h5 class="my-0 mt-2"> مسیرهای آموزشی
          <a class="btn btn-primary btn-xs my-2 mr-3" href="{{ route('learn.paths.index') }}"
            style="max-width: 110px;">مشاهده بیشتر</a>
        </h5>
        <hr style="border-top: 1px solid  #f8ba16" class="my-2">
        <div class="row">
          @foreach ($paths as $path)
            <div class="col-lg-3 my-1">
              <a href="{{ route('learn.paths.show', [$path->slug]) }}" class="text-center">
                <div class="mx-auto" style="position: relative;width: 255px;">
                  <img class="lazyload d-inline-block" data-src="{{ fromDLHost($path->thumbnail) }}"
                    alt="مسیر آموزشی {{ $path->title }} - Image of Learn Path {{ $path->titleEng }}"
                    style="border-radius: 5px; max-height: 143.44px; min-height: 143.44px;">
                  <span
                    style="width: 70px;text-align: center;position: absolute;right: 0;bottom: 0;border-radius: 3px 0 5px 0;padding: 2px 4px 0 4px;background-color: rgba(0,0,0,.8);color: #fff;">
                    {{ $path->durationHours() + ($path->durationMinutes() > 20 ? 1 : 0) }} ساعت
                  </span>
                </div>
                <div style="height: 100px;">
                  <p class="mt-2 d-inline-block text-right pr-2 mb-0"
                    style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;">
                    {{ $path->title }}
                  </p>
                  <p class="d-inline-block text-left pl-2 mb-0"
                    style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;" dir="ltr">
                    {{ $path->titleEng }}
                  </p>
                </div>
                {{-- <br />
                <span class="tile-heading py-2">تعداد دروس
                  {{ nPersian(count(js_to_courses($path->_courses))) }}</span> --}}
                {{-- <br />
                <span class="my-2 d-inline-block" style="max-height: 39px;overflow-y: hidden;">
                  مدرسین:

                  @foreach ($path->authors() as $author)
                    {{ $author->name }} @if (!$loop->last), @endif
                  @endforeach
                </span> --}}
              </a>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="container my-3 photo-gallery">
      <h2>مسیرهای آموزشی</h2>
      <div class="row d-flex">
        @foreach ($paths as $path)
          <div class="col-12 col-md-4 col-lg-4 mb-4 mt-2" itemscope itemtype="http://schema.org/Course">
            <div class="card h-100  border-light  bg-light shadow">
              <a href="{{ route('learn.paths.show', [$path->slug]) }}"
                class="row card-body photo-frame d-flex align-items-center">
                <div class="col-12 state-thumb">
                  <img itemprop="image" src="#" data-src="{{ fromDLHost($path->thumbnail) }}"
                    class="img-fluid lazyload"
                    alt="مسیر آموزشی {{ $path->title }} - Image of Learn Path {{ $path->titleEng }}" />
                </div>
                <div class="col-12 tile-text text-center">
                  <span class="tile-name">{{ $path->title }}</span>
                  <br>
                  <span class="tile-name">{{ $path->titleEng }}</span>
                  <br>
                  <span class="tile-heading py-2">تعداد دروس
                    {{ nPersian(count(js_to_courses($path->_courses))) }}</span>
                  {{-- <span class="tile-heading py-2">تعداد دروس
                    {{ nPersian(count(js_to_courses($path->courses))) }}</span> --}}
                  <br>
                  <del
                    style="background-color: #6c757d;padding: 3px 4px;border-radius: 5px;">{{ nPersian($path->old_price()) }}
                    تومان</del>
                  <span
                    style="background-color: lightgreen;padding: 3px 4px;border-radius: 5px;">{{ nPersian($path->price()) }}
                    تومان</span>
                </div>
              </a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  @endif

  @if (isset($dubbed_courses))
    @if (count($dubbed_courses) > 0)
      <div class="row card mx-0 latest-courses border-0">
        <div class="col-12 card-body">
          <div class="container">
            <h5>
              <i class="fas fa-plus-square"></i>
              دوره های آموزشی دوبله شده
              (تعداد دوره ها {{ nPersian(count($dubbed_courses)) }})
              <a class="btn btn-primary my-2" href="{{ route('courses.free') }}">مشاهده بیشتر</a>
            </h5>
            <hr style="border-top: 1px solid  #f8ba16">
            <div class="row d-flex ">
              @foreach ($dubbed_courses as $course)
                @include('courses.partials._course_list_grid', ['course' => $course])
              @endforeach
            </div>
          </div>
        </div>
      </div>
    @endif
  @endif

  <div class="row card mx-0 latest-courses border-0">
    <div class="col-12 card-body">
      <div class="container">
        <h5>
          <i class="fas fa-plus-square"></i>
          دوره های آموزشی رایگان
          (تعداد دوره ها {{ $free_courses_count }})
          <a class="btn btn-primary my-2" href="{{ route('courses.free') }}">مشاهده بیشتر</a>
        </h5>
        <hr style="border-top: 1px solid  #f8ba16">
        {{-- <h6>
          <strong>
            لینداکده به صورت هفتگی بروزرسانی می شود. پیشنهاد می کنیم که این بخش را دنبال کنید.
          </strong>
        </h6> --}}
        <div class="row d-flex ">
          @foreach ($free_courses as $course)
            @include('courses.partials._course_list_grid', ['course' => $course])
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <div class="row card mx-0 latest-courses border-0">
    <div class="col-12 card-body">
      <div class="container">
        <h5>
          <i class="fas fa-plus-square"></i>
          جدیدترین دوره های آموزشی
          <a class="btn btn-primary my-2" href="{{ route('courses.newest') }}">مشاهده بیشتر</a>
        </h5>
        <hr style="border-top: 1px solid  #f8ba16">
        {{-- <h6>
            <strong>
              لینداکده به صورت هفتگی بروزرسانی می شود. پیشنهاد می کنیم که این بخش را دنبال کنید.
            </strong>
          </h6> --}}
        <div class="row d-flex ">
          @foreach ($latest_courses as $course)
            @include('courses.partials._course_list_grid', ['course' => $course])
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <div class="row card mx-0 latest-courses border-0">
    <div class="col-12 card-body">
      <div class="container">
        <h5>
          <i class="fas fa-plus-square"></i>
          محبوب ترین دوره های آموزشی
          <a class="btn btn-primary my-2" href="{{ route('courses.best') }}">مشاهده بیشتر</a>
        </h5>
        <hr style="border-top: 1px solid  #f8ba16">
        {{-- <h6>
          <strong>
            لینداکده به صورت هفتگی بروزرسانی می شود. پیشنهاد می کنیم که این بخش را دنبال کنید.
          </strong>
        </h6> --}}
        <div class="row d-flex ">
          @foreach ($popular_courses as $course)
            @include('courses.partials._course_list_grid', ['course' => $course])
          @endforeach
        </div>
      </div>
    </div>
  </div>


  {{-- p-5 bg-white rounded shadow --}}
  <div class="row card mx-0 latest-courses border-0">
    <ul id="myTab" role="tablist"
      class="nav nav-tabs nav-pills flex-md-row text-center border-0 rounded-nav d-flex justify-content-center">
      @foreach ($page_tabs as $tab)
        <li class="nav-item flex-md-fill">
          <a id="{{ $tab[0] }}-tab" data-toggle="tab" href="#{{ $tab[0] }}" role="tab"
            aria-controls="{{ $tab[0] }}" aria-selected="true"
            class="nav-link border-0 text-uppercase font-weight-bold {{ $loop->first ? 'active' : '' }}">{{ $tab[1] }}</a>
        </li>
      @endforeach
    </ul>
    <div id="myTabContent" class="tab-content">
      @foreach ($page_tabs as $tab)
        <div id="{{ $tab[0] }}" role="tabpanel" aria-labelledby="{{ $tab[0] }}-tab"
          class="tab-pane fade p-0 {{ $loop->first ? 'show active' : '' }}">
          <div class="row card mx-0 latest-courses border-0">
            <div class="col-12 card-body px-0">
              <div class="container">
                <div class="row d-flex">
                  @foreach ($tab[2] as $course)
                    @include('courses.partials._course_list_grid', ['course' => $course])
                  @endforeach

                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <!-- End rounded tabs -->
  </div>
  <div class="modal fade" id="form-link-modal" tabindex="-1" role="dialog" aria-labelledby="form-link-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content text-center" style="background-color: orange;">
        <div class="modal-header" style="border-color: orange;">
          <h5 class="modal-title" id="form-link-modal-title">نتیجه جستجو</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
  <script>
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
  </script>

@endsection
