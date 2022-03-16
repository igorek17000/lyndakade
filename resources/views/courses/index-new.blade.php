@extends('layouts.app-test')
@push('meta.in.head')
  <link rel="canonical" href="https://lyndakade.ir">
  <link rel="alternate" hreflang="fa" href="https://lyndakade.ir">
  <link rel="stylesheet" href="https://seiyria.com/bootstrap-slider/css/bootstrap-slider.css">

  @include('meta::manager', [
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
      min-height: 560px !important;
    }

    @media (min-width: 426px) {
      .hero-space {
        min-height: 510px !important;
      }
    }

    @media (min-width: 426px) {
      .hero-space {
        min-height: 340px !important;
      }
    }

    @media (min-width: 769px) {
      .hero-space {
        min-height: 360px !important;
      }
    }

    @media (min-width: 1025px) {
      .hero-space {
        min-height: 300px !important;
      }
    }

    @media (min-width: 1441px) {
      .hero-space {
        min-height: 370px !important;
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


    .persian-subtitle-img {
      border: 2px solid darkgoldenrod;
      background-color: darkgoldenrod;
    }

    .english-subtitle-img {
      border: 2px solid green;
      background-color: green;
    }

    .course-img {
      border-radius: 5px;
      max-height: 170px;
      min-height: 170px;
      width: 100%;
    }

    @media(min-width: 575px) {
      .card-horizontal {
        display: flex;
        flex: 1 1 auto;
      }

      .course-img {
        border-radius: 5px;
        max-height: 170px;
        min-height: 170px;
        width: 300px;
      }

    }

    [data-toggle="modal"] {
      text-align: center;
      /* position: absolute;
                                                                    right: 0;
                                                                    left: 0;
                                                                    top: 0;
                                                                    bottom: 0; */
      border-radius: 5px;
      padding: 2px 4px 0 4px;
      font-size: 20px;
      background-color: rgba(0, 0, 0, .8);
      color: #fff;
      display: -webkit-box;
      display: -moz-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      align-items: center;
      justify-content: center;
      float: left;
      width: 100%;
      height: 100%;
    }

    .img-square-wrapper {
      position: relative;
      height: 170px;
    }

    .subtitle-state {
      color: white;
      bottom: 2px;
      font-size: .7rem;
      width: 5.6rem;
      position: absolute;
      left: 0;
      right: 0;
      margin: auto;
      text-align: center;
      /* padding: 0.01rem 0; */
      border-top-left-radius: 0.3rem;
      border-top-right-radius: 0.3rem;
    }

    .course-update-state {
      width: 3.7rem;
      text-align: center;
      position: absolute;
      left: 2px;
      bottom: 2px;
      border-radius: 0 0.25rem 0 0.25rem;
      padding: 2px 4px 0 4px;
      background-color: rgba(240, 0, 0, .8);
      color: #fff;
    }

    .course-time-state {
      width: 3.7rem;
      text-align: center;
      position: absolute;
      right: 2px;
      bottom: 2px;
      border-radius: 0.3rem 0 0.3rem 0;
      padding: 2px 4px 0 4px;
      background-color: rgba(0, 0, 0, .8);
      color: #fff;
    }

    .card.course {
      border-top-width: 0;
      border-left-width: 0;
      border-right-width: 0;
    }

    .course-description {
      overflow: hidden;
      max-width: 500px;
      text-overflow: ellipsis;
      display: -webkit-box;
      -webkit-line-clamp: 4;
      line-height: 1.7;
      line-clamp: 4;
      -webkit-box-orient: vertical;
    }

    @media(min-width: 900px) {
      .course-description {
        max-width: 850px;
      }

    }

    .border-0 {
      border: 0;
    }

    .card.course .card-img-overlay {
      background-color: rgba(0, 0, 0, .8);
      display: flex;
      flex-direction: column;
      justify-content: center;
      color: #fff;
      text-align: center;
      font-size: 1.3rem;
      border-radius: 5px;
      cursor: pointer;
      opacity: 0;
      transition: opacity .3s linear;
    }

    .card.course:hover .card-img-overlay {
      opacity: 1;
    }

    @media (hover: none) {
      .card.course .card-img-overlay {
        opacity: 1;
        background-color: rgba(0, 0, 0, .6);
      }
    }

    a.card-img-overlay:hover {
      color: #fff;
    }

    @media (min-width: 576px) {
      .course.container {
        max-width: 750px;

      }
    }

    @media (min-width: 768px) {
      .course.container {
        max-width: 980px;

      }
    }

    .course .card-body {
      -webkit-box-flex: 1;
      -ms-flex: 1 1 auto;
      flex: 1 1 auto;
      padding: 1rem;
    }

    .course ul li {
      position: relative;
    }

    .course ul>li ul {
      padding-right: 25px;
      padding-top: 4px;
    }

    .course ul input:not(#price-range) {
      position: absolute;
      left: 0;
      top: 0;
      visibility: hidden;
    }

    .course ul label {
      display: block;
      line-height: 25px;
      position: relative;
      padding-right: 25px;
      font-size: 14px;
    }

    @media(max-width: 1023px) {
      .course ul label {
        margin-right: -15px;
        font-size: 12px;
      }
    }

    @media(max-width: 576px) {
      .course ul label {
        margin-right: -15px;
        font-size: 11px;
      }

    }

    .course ul label[type="checkbox"]::before {
      width: 18px;
      height: 18px;
      border-radius: 3px;
      -moz-border-radius: 3px;
      -webkit-border-radius: 3px;
      border: 1px solid #d7e1e6;
      content: '';
      position: absolute;
      right: 0;
      top: 2px;
    }

    .course ul label[type="checkbox"]::after {
      width: 14px;
      height: 14px;
      border-radius: 2px;
      -moz-border-radius: 2px;
      -webkit-border-radius: 2px;
      background-color: #00aaca;
      content: '';
      position: absolute;
      right: 2px;
      top: 4px;
      opacity: 0;
      transition: opacity .3s linear;
    }

    .course ul label[type="radio"]::before {
      width: 18px;
      height: 18px;
      border-radius: 8px;
      -moz-border-radius: 8px;
      -webkit-border-radius: 8px;
      border: 1px solid #d7e1e6;
      content: '';
      position: absolute;
      right: 0;
      top: 2px;
    }

    .course ul label[type="radio"]::after {
      width: 14px;
      height: 14px;
      border-radius: 8px;
      -moz-border-radius: 8px;
      -webkit-border-radius: 8px;
      background-color: #00aaca;
      content: '';
      position: absolute;
      right: 2px;
      top: 4px;
      opacity: 0;
      transition: opacity .3s linear;
    }

    .course ul li input:checked+label:after,
    .course ul li label:hover:after {
      opacity: 1;
    }

    .course ul li input:checked+label:before,
    .course ul li label:hover:before {
      border: 1px solid #00aaca;
    }

    .learn-path *[data-target="#preview-modal"],
    .course *[data-target="#preview-modal"] {
      cursor: pointer;
    }

    .path .card-img-overlay {
      background-color: rgba(0, 0, 0, .8);
      display: flex;
      flex-direction: column;
      justify-content: center;
      color: #fff;
      text-align: center;
      font-size: 1.3rem;
      border-radius: 5px;
      cursor: pointer;
      opacity: 0;
      transition: opacity .3s linear;
    }

    .path:hover .card-img-overlay {
      opacity: 1;
    }

    @media (hover: none) {
      .path .card-img-overlay {
        opacity: 1;
        background-color: rgba(0, 0, 0, .6);
      }
    }

    @keyframes spinner-border {
      to {
        transform: rotate(360deg);
      }
    }

    .spinner-border {
      display: inline-block;
      width: 4rem;
      height: 4rem;
      vertical-align: text-bottom;
      border: 0.23em solid currentColor;
      border-right-color: transparent;
      border-radius: 50%;
      animation: spinner-border .95s linear infinite;
    }

    .price-range .slider {
      width: 170px;
    }

  </style>
  <div class="row m-0 home-page">
    <div class="col-12 hero-space" style="min-height: 440px; height: auto;">
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

  <div class="row card mx-0 pb-3">
    <div class="learn-path container">
      <h5 class="my-0 mt-2"> مسیرهای آموزشی
        <a class="btn btn-primary btn-xs mr-3" href="{{ route('learn.paths.index') }}" style="max-width: 110px;">مشاهده
          بیشتر</a>
      </h5>
      <hr style="border-top: 1px solid  #f8ba16" class="my-2">
      <div class="row">
        @foreach ($paths as $path)
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
          <ul>
            <li><b>قیمت</b>
              <ul>
                <li>
                  <input type="checkbox" id="onlyFree" name="onlyFree" class="cat"><label for="onlyFree"
                    type="checkbox">رایگان</label>
                </li>
                <li class="price-range">
                  <input id="price-range" name="price-range" type="text" />
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
        <div class="col-sm-10 col-8" id="course-list">
          <div class="d-flex justify-content-center mt-5">
            <div class="spinner-border" role="status">
              <span class="sr-only">در حال بارگیری ...</span>
            </div>
          </div>
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

  <div class="modal fade" id="preview-modal" tabindex="-1" role="dialog" aria-labelledby="preview-modal-title"
    aria-hidden="true" style="background-color: #444c;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content text-center">
        <div class="modal-body p-0" id="preview-modal-body">
          <video class="w-100" src="" controls aria-controls="true"
            style="border-top-left-radius: 3px; border-top-right-radius: 3px;"></video>
          <div class="text-right px-2">

            <div>
              <span style="font-size: 1.2rem;" id="preview-modal-title">عنوان دوره</span>
              <a href="#" id="preview-modal-url" style="float: left;" class="btn btn-success mb-2">مشاهده جزئیات</a>
              {{-- <span style="float: left;cursor: auto;" class="btn" id="preview-modal-price">قیمت</span> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script_body')
  <script src="https://seiyria.com/bootstrap-slider/js/bootstrap-slider.js"></script>

  <script>
    function range(start, stop, step = 1) {
      if (stop > start) {
        return [...range(start, stop - step, step), stop];
      }
      return [start];
    }
    $(function() {
      //   $("#price-range").slider();
      $("#price-range").slider({
        value: [5000, 100000],
        // ticks: range(5000, 100000, 5000),
        // lock_to_ticks: true,
        step: 5000,
        // ticks_tooltip: true,
      });
    });

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
      document.querySelectorAll('*[data-price]').forEach(element => {
        element.setAttribute('data-price', engToPer(element.getAttribute('data-price')));
      });
      $('#preview-modal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        if (button) {
          $('#preview-modal #preview-modal-title').text(button.data('title'));
          document.querySelector('#preview-modal #preview-modal-url').setAttribute('href', button.data('url'));
          // $('#preview-modal-price').text(button.data('price') + ' تومان');
          document.querySelector('#preview-modal #preview-modal-body video').setAttribute('src', button.data(
            'src'));
          document.querySelector('#preview-modal #preview-modal-body video').play();
        } else {
          $('#preview-modal #preview-modal-title').text('');
          document.querySelector('#preview-modal #preview-modal-url').setAttribute('href', '');
          // $('#preview-modal-price').text('');
        }
      });
      $('#preview-modal').on('hidden.bs.modal', function() {
        document.querySelector('#preview-modal #preview-modal-body video').setAttribute('src', '');
      });
    });

    $(function() {
      var loading_html = `
        <div class="d-flex justify-content-center mt-5">
            <div class="spinner-border" role="status">
                <span class="sr-only">در حال بارگیری ...</span>
            </div>
        </div>`;

      var error_html = `
        <div class="d-flex justify-content-center mt-5">
            <div style="font-size: 1rem;">خطایی رخ داده است، لطفا دوباره امتحان کنید.</div>
        </div>`;
      var $request = null;
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

        // var subtitle = document.querySelectorAll('input[name="sortingOrder"]:checked').length > 0 ?
        //   document.querySelectorAll('input[name="sortingOrder"]:checked')[0].getAttribute('data-id') :
        //   '1';
        var data = {
          _token: $('[name="_token"]').val(),
          onlyFree: $('#onlyFree')[0].checked,
          sortingOrder: sortingOrder,
          libraries: libraries,
          //   subtitle: subtitle,
        };

        console.log(sortingOrder, libraries, data);

        $request = $.ajax({
          url: "{{ route('main-page.courses.api') }}",
          method: 'post',
          data: data,
          success: function(result) {
            console.log("result", result);
            $(course_list).html(result.data);
            $request = null;
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
      })
    });
  </script>
@endsection
