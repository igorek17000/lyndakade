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
@endpush
@section('content')
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
