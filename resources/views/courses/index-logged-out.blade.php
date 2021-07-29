@extends('layouts.app')
@push('meta.in.head')
  <link rel="canonical" href="https://lyndakade.ir">
  <link rel="alternate" hreflang="fa" href="https://lyndakade.ir">

  @include('meta::manager',[
  'image' => 'https://lyndakade.ir/image/logo.png',
  'title' => ' لیندا کده | بروز ترین سایت آموزشی',
  'keywords' => get_seo_keywords(),
  'description' => get_seo_description(),
  ])
@endpush
@section('content')
  <div class="row m-0 home-page">
    <div class="col-12 hero-space">
      <div class="hero-text">
        {{-- <div>
          <img style="width: 100px;" src="{{ asset('image/logoedit2.png') }}" alt="Lyndakade Logo">
        </div> --}}
        <h1 style="font-size: 2.25rem;">
          آموزش های وبسایت
          <a href="https://www.linkedin.com/" style="color: #2977c9;">لینکدین</a>
          به همراه زیرنویس
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
              <div class="row justify-content-center">
                <div class="col-12">
                  <input id="url" name="url" type="text" class="form-control"
                    placeholder="https://www.linkedin.com/learning/writing-articles-2" dir="ltr">
                </div>
                <button type="submit" class="btn btn-primary">ارسال</button>
              </div>
            </form>
          </div>
        </div>
        {{-- <p>
          @guest
            <a href="{{ route('register') }}" class="btn btn-sm btn-primary">ایجاد حساب کاربری</a>
          @endguest
        </p>
        <p>
          @guest
            حساب کاربری دارید؟
            <a href="{{ route('login') }}" class="btn btn-sm btn-dark cta">ورود به
              حساب</a>
          @endguest
        </p> --}}
      </div>
    </div>
  </div>

  <div class="container mt-5 home-page">
    <section class="row mx-0" id="top-level-sections">
      <div class="col-xs-12 col-sm-6 col-md-6" id="software">
        <a href="{{ get_library_link(50) }}" class="card h-100 border-0 rounded-20 text-light overflow zoom">
          <img src="#" data-src="{{ asset('software development.jpg') }}" alt="software"
            class="card-img h-100 lazyload" />
          <div class="card-img-overlay row mx-0 align-items-center">
            <div class="card-title col-12" style="text-align: center;">
              <h3>توسعه نرم افزار</h3>
              <p class="mb-0">حدود {{ count(get_courses_for_library(50)) }} دوره</p>
              {{-- <button class="button-1 align-items-center btn-subject-preview"> Previwe Subject <i
                  class="fas fa-play-circle"></i></button> --}}
            </div>
          </div>
        </a>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="row h-100">
          <div class="col-xs-12 col-sm-12 col-md-6 col-small">
            <a href="{{ get_library_link(40) }}" class="card h-100 border-0 rounded-20 text-light overflow zoom">
              <img src="#" data-src="{{ asset('design.jpg') }}" alt="software" class="card-img h-100 lazyload" />
              <div class="card-img-overlay row align-items-center">
                <div class="card-title col-12" style="text-align: center;">
                  <h3>طراحی</h3>
                  <p class="mb-0">حدود {{ count(get_courses_for_library(40)) }} دوره</p>
                  {{-- <button class="button-1 align-items-center btn-subject-preview"> Previwe Subject <i
                      class="fas fa-play-circle"></i></button> --}}
                </div>
              </div>
            </a>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-6 col-small">
            <a href="{{ get_library_link(29) }}" class="card h-100 border-0 rounded-20 text-light overflow zoom">
              <img src="#" data-src="{{ asset('business.jpg') }}" alt="software" class="card-img h-100 lazyload" />
              <div class="card-img-overlay row align-items-center">
                <div class="card-title col-12" style="text-align: center;">
                  <h3>بازار کار</h3>
                  <p class="mb-0">حدود {{ count(get_courses_for_library(29)) }} دوره</p>
                  {{-- <button class="button-1 align-items-center btn-subject-preview"> Previwe Subject <i
                      class="fas fa-play-circle"></i></button> --}}
                </div>
              </div>
            </a>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-6 col-small">
            <a href="{{ get_library_link(88) }}" class="card h-100 border-0 rounded-20 text-light overflow zoom">
              <img src="#" data-src="{{ asset('web development.jpg') }}" alt="software"
                class="card-img h-100 lazyload" />
              <div class="card-img-overlay row align-items-center">
                <div class="card-title col-12" style="text-align: center;">
                  <h3>طراحی وب</h3>
                  <p class="mb-0">حدود {{ count(get_courses_for_library(88)) }} دوره</p>
                  {{-- <button class="button-1 align-items-center btn-subject-preview"> Previwe Subject <i
                      class="fas fa-play-circle"></i></button> --}}
                </div>
              </div>
            </a>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-6 col-small">
            <a href="{{ get_library_link(70) }}" class="card h-100 border-0 rounded-20 text-light overflow zoom">
              <img src="#" data-src="{{ asset('photography.jpg') }}" alt="software" class="card-img h-100 lazyload" />
              <div class="card-img-overlay row align-items-center">
                <div class="card-title col-12" style="text-align: center;">
                  <h3>عکاسی</h3>
                  <p class="mb-0">حدود {{ count(get_courses_for_library(70)) }} دوره</p>
                  {{-- <button class="button-1 align-items-center btn-subject-preview"> Previwe Subject <i
                      class="fas fa-play-circle"></i></button> --}}
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="container my-3">
    <div class="row">
      <div class="col-lg-3 col-sm-6">
        <div class="card-box" style="background-color:#00aaca;border-radius: 10px">
          <div class="inner">
            <h3 class="counter" style="color: black">{{ get_number_of_all_courses() }} </h3>
            <p style="color: black"> تعداد کل دوره‌های آموزشی سایت </p>
          </div>
          <div class="icon">
            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card-box" style="background-color:#00aaca;border-radius: 10px">
          <div class="inner">
            <h3 class="counter" style="color: black"> {{ get_sum_of_all_courses_part_numbers() }} </h3>
            <p style="color: black"> تعداد کل ویدیوهای آموزشی </p>
          </div>
          <div class="icon">
            <i class="fa fa-video" aria-hidden="true"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card-box" style="background-color:#00aaca;border-radius: 10px">
          <div class="inner">
            <h3 class="counter" style="color: black"> {{ get_sum_of_all_courses_time() }} </h3>
            <p style="color: black"> زمان کل آموزشهای سایت (دقیقه)</p>
          </div>
          <div class="icon">
            <i class="fa fa-clock" aria-hidden="true"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card-box" style="background-color:#00aaca;border-radius: 10px">
          <div class="inner">
            <h3 class="counter" style="color: black"> {{ get_number_of_authors_has_at_least_one_course() }} </h3>
            <p style="color: black">تعداد مدرسان </p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  @if (isset($dubbed_courses))
    @if (count($dubbed_courses) > 0)
      <div class="row card mx-0 latest-courses border-0">
        <div class="col-12 card-body">
          <div class="container">
            <h5>
              <i class="fas fa-plus-square"></i>
              دوره های آموزشی دوبله شده
              (تعداد دوره ها {{ count($dubbed_courses) }})
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

  @if (count($paths) > 0)
    <div class="container my-3 photo-gallery">
      <h2>مسیرهای آموزشی</h2>
      <div class="row d-flex">
        @foreach ($paths as $path)
          <div class="col-12 col-md-4 col-lg-4 mb-4 mt-2">
            <div class="card h-100  border-light  bg-light shadow">
              <a href="{{ route('learn.paths.show', [$path->library->slug, $path->slug]) }}"
                class="row card-body photo-frame d-flex align-items-center">
                <div class="col-12 state-thumb">
                  <img src="#" data-src="{{ fromDLHost($path->img) }}" class="img-fluid lazyload">
                </div>
                <div class="col-12 tile-text text-center">
                  <span class="tile-name">{{ $path->title }}</span>
                  <br>
                  <span class="tile-name">{{ $path->titleEng }}</span>
                  <br>
                  <span class="tile-heading">تعداد دروس {{ count(js_to_courses($path->courses)) }}</span>
                </div>
              </a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
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
    <ul id="myTab" role="tablist" class="nav nav-tabs nav-pills flex-column flex-sm-row text-center border-0 rounded-nav">
      @foreach ($page_tabs as $tab)
        <li class="nav-item flex-sm-fill">
          <a id="lib-{{ $tab[0] }}-tab" data-toggle="tab" href="#lib-{{ $tab[0] }}" role="tab"
            aria-controls="lib-{{ $tab[0] }}" aria-selected="true"
            class="nav-link border-0 text-uppercase font-weight-bold {{ $loop->first ? 'active' : '' }}">{{ $tab[1] }}</a>
        </li>
      @endforeach
    </ul>
    <div id="myTabContent" class="tab-content">
      @foreach ($page_tabs as $tab)
        <div id="lib-{{ $tab[0] }}" role="tabpanel" aria-labelledby="lib-{{ $tab[0] }}-tab"
          class="tab-pane fade p-0 {{ $loop->first ? 'show active' : '' }}">
          <div class="row card mx-0 latest-courses border-0">
            <div class="col-12 card-body">
              <div class="container">
                <div class="row d-flex">
                  @foreach ($tab[2]->sortByDesc('created_at')->take(4) as $course)
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
  <div class="modal fade" id="form-link-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
    $(document).ready(function() {

      $('.counter').each(function() {
        $(this).prop('Counter', 0).animate({
          Counter: $(this).text()
        }, {
          duration: 5000,
          easing: 'swing',
          step: function(now) {
            $(this).text(Math.ceil(now));
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
