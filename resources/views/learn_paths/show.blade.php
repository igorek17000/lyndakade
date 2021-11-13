@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager',[
  'image' => fromDLHost($path->img),
  'title' => $path->titleEng . ' - ' . $path->title,
  'keywords' => get_seo_keywords() . ' , لیست مسیر آموزشی , learn path, learn-path, all learn paths ' . $path->title,
  'description' => 'مسیر آموزشی ' . $path->description . '| ' . get_seo_description(),
  ])
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "ItemList",
      "itemListElement": [
        @foreach (js_to_courses($path->_courses) as $course)
          {
          "@type": "ListItem",
          "position": "{{ $loop->index + 1 }}",
          "item": {
          "@type": "Course",
          "image": "{{ fromDLHost($course->img) }}",
          "url": "{{ route('courses.show.linkedin', [$course->slug_linkedin]) }}",
          "name": "{{ $course->titleEng }} - {{ $course->title }}",
          "description": "{{ $course->description }}",
          "dateCreated": "{{ $course->updateDate ?? $course->releaseDate }}",
          "timeRequired":
          "{{ $course->durationHours > 0 ? $course->durationHours . 'h ' . $course->durationMinutes . 'm' : $course->durationMinutes . 'm' }}",
          "provider": [
          @foreach ($course->authors as $author)
            {
            "@type": "Person",
            "name": "{{ $author->name }}",
            "url": {"@id": "{{ route('authors.show', [$author->slug]) }}"}
            }@if (!$loop->last),
            @endif
          @endforeach
          ]
          }
          }@if (!$loop->last),
          @endif
        @endforeach
      ]
    }
  </script>
@endpush
@section('content')
  <div id="learn-path-top" class="px-0 pt-0" style="margin-bottom: 150px;">
    <div class="row m-0">
      <div class="path-big-img" style="
                                                  max-width: 100%; width: 100%;
                                                  background: url({{ fromDLHost($path->img) }});
                                                  background-size: auto;
                                                  height: 300px !important;">
        <img src="#" class="lazyload" data-src="{{ fromDLHost($path->img) }}">
      </div>
      <div class="path-big-img-content w-100">
        <div class="container-fluid" style="height: 630px;overflow: hidden;">
          <div class="row">
            <div class="col-xs-12 col-md-12 path-title-desc ">
              <div class="container h-100 mt-3" style="background-color: #ffffff;border-radius: 5px;">
                <div class="path-big-img-path pt-3" style="width: -moz-fit-content;">
                  <a href="{{ route('learn.paths.index') }}">
                    مسیرهای یادگیری
                  </a>
                  <i class="lyndacon arrow-left"></i>
                </div>
                {{-- <h1 class="pt-md-3 container" style="padding-top: 30px;">
                  <span>
                    {{ $path->title }}
                  </span>
                  <span style="float: left;" class="ml-auto d-none d-md-block">
                    {{ $path->titleEng }}
                  </span>
                </h1>
                <h1 class="container text-left d-block d-md-none" dir="ltr">
                  <span>
                    {{ $path->titleEng }}
                  </span>
                </h1> --}}
                <div class="row mx-auto">
                  <div class="col-md-6">
                    <h1 style="min-height: 72px;">
                      <span>
                        {{ $path->title }}
                      </span>
                      <span class="ml-auto text-left d-block d-md-none" dir="ltr">
                        {{ $path->titleEng }}
                      </span>
                    </h1>
                    <div class="path-description text-justify mb-2"
                      style="height: 125px !important; word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 1.5;-webkit-line-clamp: 5;-webkit-box-orient: vertical;">
                      {!! nPersian($path->description) !!}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <h1 class="container text-left d-none d-md-block" dir="ltr" style="min-height: 72px;">
                      <span>
                        {{ $path->titleEng }}
                      </span>
                    </h1>
                    <div class="path-description text-justify mb-2 text-left"
                      style="height: 125px !important; word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 1.5;-webkit-line-clamp: 5;-webkit-box-orient: vertical;"
                      dir="ltr">
                      {!! nPersian($path->descriptionEng) !!}
                    </div>
                  </div>
                </div>
                <div class="row py-md-3 text-center" style="font-size: 1.25em;">
                  <div class="col-6 my-md-1">
                    <b>مدت زمان: </b>{{ $path->durationHours() ? $path->durationHours() . 'h' : '' }}
                    {{ $path->durationMinutes() ? $path->durationMinutes() . 'm' : '' }}
                  </div>
                  <div class="col-6 my-md-1">
                    <b>تعداد دوره ها: </b>{{ count(js_to_courses($path->_courses)) }}
                  </div>
                  @if ($path->price() > 0)
                    <div class="col-6 my-md-1">
                      <b>مجموع قیمت:</b>
                      <del class="text-muted">({{ nPersian($path->old_price()) }})</del>
                    </div>
                  @endif
                  <div class="col-6 my-md-1">
                    <b>قیمت @if ($path->price() > 0) با 30% تخفیف @endif:
                    </b>
                    @if ($path->price() == 0)
                      <span style="color: darkgreen">رایگان</span>
                    @else
                      {{ nPersian($path->price()) }}
                    @endif
                  </div>
                  <div class="col-6 my-md-1">
                    <b>تعداد مدرسین: </b>{{ count($authors) }}
                  </div>
                  <div class="col-6 my-md-1">
                    @if (\Illuminate\Support\Facades\Auth::check())
                      <div id="cart-btn">
                        @if ($path_state == '2')
                          <a data-id="2-{{ $path->id }}" class="btn btn-danger align-self-center cart-remove-btn">
                            حذف از سبد خرید
                          </a>
                        @elseif($path_state == '1')
                          <a data-id="2-{{ $path->id }}" class="btn btn-download align-self-center cart-add-btn">
                            افزودن به سبد خرید
                          </a>
                        @elseif($path_state == '3')
                          خریداری شده است.
                        @endif
                      </div>
                    @else
                      <div>
                        برای خرید این مسیر آموزشی باید
                        <a href="{{ route('login') }}" style="color: orange">
                          وارد حساب کاربری
                        </a>
                        خود شوید.
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- <div id="learn-path-top" class="px-0 pt-0" style="margin-bottom: 100px;">
    <div class="row m-0">
      <div class="path-big-img" style="
                          max-width: 100%; width: 100%;
                          background: url({{ fromDLHost($path->img) }});
                          background-size: auto;
                          height: 300px !important;">
        <img src="#" class=" lazyload" data-src="{{ fromDLHost($path->img) }}">
      </div>
      <div class="path-big-img-content w-100">
        <div class="container-fluid" style="height: 580px;overflow: hidden;">
          <div class="row">
            <div class="col-xs-12 col-md-12 path-title-desc ">
              <div class="container mt-3" style="background-color: #ffffff;border-radius: 5px;">
                <div class="path-big-img-path pt-3" style="width: -moz-fit-content;"><a
                    href="{{ route('learn.paths.index') }}">مسیرهای
                    یادگیری</a> <i class="lyndacon arrow-left"></i>
                </div>
                <h1 class="pt-md-3 container" style="padding-top: 30px;">
                  <span>
                    {{ $path->title }}
                  </span>
                  <span style="float: left;" class="ml-auto d-none d-md-block">
                    {{ $path->titleEng }}
                  </span>
                </h1>
                <h1 class="container text-left d-block d-md-none" dir="ltr">
                  <span>
                    {{ $path->titleEng }}
                  </span>
                </h1>
                <div class="row mx-auto">
                  <div class="col-md-6 path-description text-justify mb-2"
                    style="word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 1.5;-webkit-line-clamp: 5;-webkit-box-orient: vertical;">
                    {!! nPersian($path->description) !!}
                  </div>
                  <div class="col-md-6 path-description text-justify mb-2 text-left"
                    style="word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 1.5;-webkit-line-clamp: 5;-webkit-box-orient: vertical;"
                    dir="ltr">
                    {!! nPersian($path->descriptionEng) !!}
                  </div>
                </div>
                <div class="row py-md-3 text-center" style="font-size: 1.25em;">
                  <div class="col-6 my-md-1">
                    <b>مدت زمان: </b>{{ $path->durationHours() ? $path->durationHours() . 'h' : '' }}
                    {{ $path->durationMinutes() ? $path->durationMinutes() . 'm' : '' }}
                  </div>
                  @if ($path->price() > 0)
                    <div class="col-6 my-md-1">
                      <b>مجموع قیمت:</b>
                      <del class="text-muted">({{ nPersian($path->old_price()) }})</del>
                    </div>
                  @endif
                  <div class="col-6 my-md-1">
                    <b>قیمت @if ($path->price() > 0) با 30% تخفیف @endif:
                    </b>
                    @if ($path->price() == 0)
                      <span style="color: darkgreen">رایگان</span>
                    @else
                      {{ nPersian($path->price()) }}
                    @endif
                  </div>
                  <div class="col-6 my-md-1">
                    <b>تعداد دوره ها: </b>{{ count(js_to_courses($path->_courses)) }}
                  </div>
                  <div class="col-6 my-md-1">
                    <b>تعداد مدرسین: </b>{{ count($authors) }}
                  </div>
                  <div class="col-6 my-md-1">
                    @if (\Illuminate\Support\Facades\Auth::check())
                      <div id="cart-btn">
                        @if ($path_state == '2')
                          <a data-id="2-{{ $path->id }}" class="btn btn-danger align-self-center cart-remove-btn">
                            حذف از سبد خرید
                          </a>
                        @elseif($path_state == '1')
                          <a data-id="2-{{ $path->id }}" class="btn btn-download align-self-center cart-add-btn">
                            افزودن به سبد خرید
                          </a>
                        @elseif($path_state == '3')
                          خریداری شده است.
                        @endif
                      </div>
                    @else
                      <div>
                        برای خرید این مسیر آموزشی باید
                        <a href="{{ route('login') }}" style="color: orange">
                          وارد حساب کاربری
                        </a>
                        خود شوید.
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> --}}


  {{-- <div id="learn-path-top" class="px-0 pt-0">
    <div class="row m-0">
      <div class="path-big-img" style="max-width: 100%;width: 100%;
                          background:linear-gradient(to left, #fff 36%, rgba(255, 255, 255, 0) 60%, #fff 96%),
                          url({{ fromDLHost($path->img) }})">
        <img src="#" class="lazyload" data-src="{{ fromDLHost($path->img) }}">
        <div class="path-big-img-over"></div>
      </div>
      <div class="path-big-img-content">
        <div class="container-fluid" style="height: 500px; overflow: hidden;">
          <div class="row">
            <div class="col-xs-12 col-md-12 path-title-desc">
              <div class="current-page-path path-big-img-path" style="width: -moz-fit-content;"><a
                  href="{{ route('learn.paths.index') }}">مسیرهای
                  یادگیری</a> <i class="lyndacon arrow-left"></i>
              </div>
              <h1 class="pt-md-3" style="padding-top: 30px;">{{ $path->title }}</h1>
              <p class="col-md-6 path-description text-justify"
                style="word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 1.5;-webkit-line-clamp: 4;-webkit-box-orient: vertical;">
                <!-- {{ nl2br(e($path->description)) }} -->
                {!! nPersian($path->description) !!}
              </p>
            </div>
          </div>
          <div class="row pt-md-3" style="font-size: 1.25em;">
            <div class="col-12 my-md-1">
              <b>مدت زمان: </b>{{ $path->durationHours() ? $path->durationHours() . 'h' : '' }}
              {{ $path->durationMinutes() ? $path->durationMinutes() . 'm' : '' }}
            </div>
            @if ($path->price() > 0)
              <div class="col-12 my-md-1">
                <b>مجموع قیمت:</b>
                <del class="text-muted">({{ nPersian($path->old_price()) }})</del>
              </div>
            @endif
            <div class="col-12 my-md-1">
              <b>قیمت @if ($path->price() > 0) با 30% تخفیف @endif:
              </b>
              @if ($path->price() == 0)
                <span style="color: darkgreen">رایگان</span>
              @else
                {{ nPersian($path->price()) }}
              @endif
            </div>
            <div class="col-12 my-md-1">
              <b>تعداد دوره ها: </b>{{ count(js_to_courses($path->_courses)) }}
            </div>
            <div class="col-12 my-md-1">
              <b>تعداد مدرسین: </b>{{ count($authors) }}
            </div>
            <div class="col-12 my-md-1">
              @if (\Illuminate\Support\Facades\Auth::check())
                <div id="cart-btn">
                  @if ($path_state == '2')
                    <a data-id="2-{{ $path->id }}" class="btn btn-danger align-self-center cart-remove-btn">
                      حذف از سبد خرید
                    </a>
                  @elseif($path_state == '1')
                    <a data-id="2-{{ $path->id }}" class="btn btn-download align-self-center cart-add-btn">
                      افزودن به سبد خرید
                    </a>
                  @elseif($path_state == '3')
                    خریداری شده است.
                  @endif
                </div>
              @else
                <div>
                  برای خرید این مسیر آموزشی باید
                  <a href="{{ route('login') }}" style="color: orange">
                    وارد حساب کاربری
                  </a>
                  خود شوید.
                </div>
              @endif
            </div>
          </div>
        </div>
        <div class="row position-relative m-0">
        </div>
      </div>
    </div>
  </div> --}}
  <div class="container">
    <ul class="timeline">
      @foreach ($courses as $index => $course)
        <li>
          <div class="timeline-badge">{{ $index + 1 }}</div>
          <a href="{{ courseURL($course) }}" class="timeline-panel">
            <div class="timeline-heading">
              <h2 class="timeline-title" style="font-size: 1.25rem;">
                <p class="m-0">
                  {{ $course->title }}
                  <small class="text-muted">
                    توسط
                    <span class="text-left" dir="ltr">
                      @foreach ($course->authors as $author)
                        {{-- <i class="glyphicon glyphicon-time"></i> --}}
                        {{ $author->name }}
                        @if (!$loop->last)
                          ,
                        @endif
                      @endforeach
                    </span>
                  </small>
                </p>
                <p dir="ltr" class="text-left m-0">
                  {{ $course->titleEng }}
                  <small class="text-muted">
                    by
                    <span>
                      @foreach ($course->authors as $author)
                        {{-- <i class="glyphicon glyphicon-time"></i> --}}
                        {{ $author->name }}
                        @if (!$loop->last)
                          ,
                        @endif
                      @endforeach
                    </span>
                  </small>

                </p>
              </h2>
            </div>
            <div class="timeline-body text-justify row">
              <div class="col-md-3 col-sm-12 text-center">
                <img src="#" class="lazyload"
                  data-src="{{ $course->thumbnail ? fromDLHost($course->thumbnail) : fromDLHost($course->img) }}"
                  style="max-height: 150px;" />

              </div>
              <div class="col-md-9  col-sm-12">
                <p class="mt-md-3" style="word-break: break-word;
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                            display: -webkit-box;
                                            line-height: 2; /* fallback */
                                            -webkit-line-clamp: 3; /* number of lines to show */
                                            -webkit-box-orient: vertical;">
                  {!! $course->description !!}
                </p>
                <div class="row">
                  <div class="col-md-3 col-6 pb-1">
                    <b>مدت زمان:</b>
                    {{ $course->durationHours ? $course->durationHours . 'h ' : '' }}
                    {{ $course->durationMinutes ? $course->durationMinutes . 'm' : '' }}
                  </div>
                  <div class="col-md-3 col-6">
                    <b>سطح:</b>
                    {{ \App\SkillLevel::find($course->skillLevel)->title }}
                  </div>
                  <div class="col-md-3 col-6">
                    <b>تاریخ انتشار:</b>
                    <span id="release-date" title="در لینکدین {{ date('Y/m/d', strtotime($course->releaseDate)) }}">
                      @php
                        $d = date('Y/m/d', strtotime($course->releaseDate));
                        $d = explode('/', $d);
                        echo nPersian(gregorian_to_jalali(intval($d[0]), intval($d[1]), intval($d[2]), '/'));
                      @endphp
                    </span>
                  </div>
                  <div class="col-md-3 col-6">
                    <b>زیرنویس:</b>
                    @if (get_course_status_state($course->dubbed_id))
                      <span>دوبله شده</span>
                    @elseif (get_course_status_state($course->persian_subtitle_id) &&
                      get_course_status_state($course->english_subtitle_id))
                      <span>انگلیسی و فارسی</span>
                    @elseif (get_course_status_state($course->persian_subtitle_id))
                      <span>فارسی</span>
                    @elseif (get_course_status_state($course->english_subtitle_id))
                      <span>انگلیسی</span>
                    @else
                      <span style="color: red">
                        ندارد
                      </span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </a>
        </li>
      @endforeach
    </ul>
    <div class="row position-relative mx-0" style="height: 60px;">
      <div id="cart-btn">
        @if (auth()->check())
          <div id="cart-btn">
            @if ($path_state == '2')
              <a data-id="2-{{ $path->id }}" class="btn btn-danger align-self-center cart-remove-btn">
                حذف از سبد خرید
              </a>
            @elseif($path_state == '1')
              <a data-id="2-{{ $path->id }}" class="btn btn-download align-self-center cart-add-btn">
                افزودن به سبد خرید
              </a>
            @elseif($path_state == '3')
              خریداری شده است.
            @endif
          </div>
        @else
          <div>
            برای خرید این مسیر آموزشی باید
            <a href="{{ route('login') }}">
              وارد حساب کاربری
            </a>
            خود شوید.
          </div>
        @endif
      </div>
    </div>
  </div>
  <div id="learning-path">
    <div class="row path-experts mx-0">
      <div class="col-12">
        <h5 class="course-title">شما این مسیر آموزشی را با مدرسان زیر میگذرانید</h5>
      </div>
      @foreach ($authors as $index => $author)
        @include('authors.partials._item-grid', ['author' => $author])
      @endforeach
    </div>
    {{-- <div class="row path-experts mx-0">
      <div class="col-md-12">
        <div class="row p-0 m-0">
          <div class="col-9">
            <h5 class="course-title">شما این مسیر آموزشی را با مدرسان زیر میگذرانید</h5>
          </div>
          <div id="carousel-arrows" class="col-3">
            <a class="align-self-center" href="#blogCarousel" role="button" data-slide="prev">
              <i class="lyndacon arrow-right" aria-hidden="true"></i>
              <span class="sr-only">Previous</span>
            </a>
            <a class="align-self-center" href="#blogCarousel" role="button" data-slide="next">
              <i class="lyndacon arrow-left" aria-hidden="true"></i>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
        <div id="blogCarousel" class="carousel slide" data-interval="1000000">
          <!-- Carousel items -->
          <div class="carousel-inner">
            @foreach ($authors as $index => $author)
              @if ($index % 3 == 0)
                <div class="carousel-item {{ $index < 3 ? 'active' : '' }}">
                  <div class="row mx-0">
                    @for ($i = $index; $i < count($authors); $i++)
                      @include('authors.partials._item-grid', ['author' => $authors[$i]])
                      @if (($i + 1) % 3 == 0)
                      @break
                    @endif
              @endfor
          </div>
        </div>
        @endif
        @endforeach
      </div>
      <!--.carousel-inner-->
    </div>
    <!--.Carousel-->
  </div>
  </div> --}}
  </div>
@endsection
@section('script_body')
  <script>
    $(function() {
      $('.carousel').carousel({
        interval: false,
        wrap: false,
        keyboard: false,
      });

      // $('.btn-buy').click(function(event) {
      //   console.log(event);
      // });

      // $('.btn-preview-first').click(function(event) {
      //   var modal = $('#exampleModalCenter');
      //   event.stopPropagation();
      //   var video_url = $(this).attr('data-video-url');
      //   var title = $(this).attr('data-title');
      //   var subtitle_url = $(this).attr('data-subtitle-url');
      //   var poster_url = $(this).attr('data-poster-url');

      //   var body = '<div class="video-player" style="width: 100%;">' +
      //     '   <video \n' +
      //     '       style="width: 100%;"' +
      //     '       controls\n' +
      //     '       preload="auto"\n' +
      //     '       poster="' + poster_url + '">' +
      //     '       <source type="video/mp4" src="' + video_url + '"/>' +
      //     '       <track\n' +
      //     '           default\n' +
      //     '           kind="captions"\n' +
      //     '           srclang="en"\n' +
      //     '           label="Persian"\n' +
      //     '           src="' + subtitle_url + '"/>' +
      //     '   </video>' +
      //     '</div>';

      //   // var body = '<div class="video-player" style="padding: 0; margin: 0;">\n' +
      //   //     '                            <video\n' +
      //   //     '                                id="preview-player"\n' +
      //   //     '                                class="video-js vjs-big-play-centered vjs-16-9"\n' +
      //   //     '                                controls\n' +
      //   //     '                                preload="auto"\n' +
      //   //     '                                poster="' + poster_url + '"\n' +
      //   //     '                                data-setup=\'{ "fluid" : true , "controls": true, "autoplay": false, "preload": "auto", "seek": true  }\'>\n' +
      //   //     '                                <source type="video/mp4" src="/' + video_url + '"/>\n' +
      //   //     '\n' +
      //   //     '                                <track\n' +
      //   //     '                                    default\n' +
      //   //     '                                    kind="captions"\n' +
      //   //     '                                    srclang="en"\n' +
      //   //     '                                    label="Persian"\n' +
      //   //     '                                    src="' + subtitle_url + '"/>\n' +
      //   //     '\n' +
      //   //     '                                <p class="vjs-no-js">\n' +
      //   //     '                                    To view this video please enable JavaScript, and consider upgrading to a\n' +
      //   //     '                                    web browser that\n' +
      //   //     '                                    <a href="https://videojs.com/html5-video-support/" target="_blank">\n' +
      //   //     '                                        supports HTML5 video\n' +
      //   //     '                                    </a>\n' +
      //   //     '                                </p>\n' +
      //   //     '                            </video>\n' +
      //   //     '                        </div>'

      //   modal.find('.modal-title').text(title);
      //   $('.modal-body .video-player').remove();
      //   modal.find('.modal-body')[0].innerHTML = body;
      //   modal.modal('toggle');
      //   //var player = videojs('preview-player');

      //   modal.on('hidden.bs.modal', function(e) {
      //     // console.log(e)
      //     $('.modal-body .video-player').remove();
      //     // modal.find('.modal-body')[0].innerHTML = "";
      //   });
      // });
    })
  </script>
@endsection
