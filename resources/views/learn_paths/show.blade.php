@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager',[
  'image' => fromDLHost($path->img),
  'title' => 'لیندا کده | مسیر آموزشی' ,
  'keywords' => get_seo_keywords() . ' , لیست مسیر آموزشی , learn path, learn-path, all learn paths ' . $path->title,
  'description' => 'مسیر آموزشی ' . $path->description . '| ' . get_seo_description(),
  ])
@endpush
@section('content')

  <div id="learn-path-top" class="px-0 pt-0">
    <div class="row m-0">
      <div class="path-big-img" style="
                                                                           max-width: 100%;
                                                                           width: 100%;
                                                                           background:linear-gradient(to left, #fff 36%, rgba(255, 255, 255, 0) 60%, #fff 96%),
                                                                           url({{ fromDLHost($path->img) }})">
        <img src="#" class="lazyload" data-src="{{ fromDLHost($path->img) }}">
        <div class="path-big-img-over"></div>
      </div>
      <div class="path-big-img-content">
        <div class="container-fluid" style="height: 400px; overflow: hidden;">
          <div class="row">
            <div class="col-xs-12 col-md-12 path-title-desc">
              <div class="current-page-path path-big-img-path"><a href="{{ route('learn.paths.index') }}">مسیرهای
                  یادگیری</a> <i class="lyndacon arrow-left"></i>
              </div>
              <h1>{{ $path->title }}</h1>
              <div class="col-md-6 path-description text-justify">
                {{-- {{ nl2br(e($path->description)) }} --}}
                {!! $path->description !!}
              </div>
            </div>
          </div>
          <div class="path-btns">
            <button class="btn ga btn-preview-first" data-title="{{ $courses[0]->title }}"
              data-video-url="{{ fromDLHost($courses[0]->previewFile) }}"
              data-subtitle-url="{{ fromDLHost($courses[0]->previewSubtitle) }}"
              data-poster-url="{{ fromDLHost($courses[0]->img) }}">
              اجرای پیش نمایش اولین درس
              <i class="lyndacon ad-play"></i>
            </button>
          </div>
        </div>
        <div class="row position-relative m-0">
          @if (\Illuminate\Support\Facades\Auth::check())
            <div id="cart-btn">
              @if ($path_state)
                <a data-id="2-{{ $path->id }}" class="btn btn-danger align-self-center cart-remove-btn">
                  حذف از سبد خرید
                </a>
              @else
                <a data-id="2-{{ $path->id }}" class="btn btn-download align-self-center cart-add-btn">
                  افزودن به سبد خرید
                </a>
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
  <div class="container">
    <ul class="timeline">
      @foreach ($courses as $index => $course)
        <li>
          <div class="timeline-badge">{{ $index + 1 }}</div>
          <a href="{{ courseURL($course) }}" class="timeline-panel">
            <div class="timeline-heading">
              <h4 class="timeline-title">{{ $course->title }}</h4>
            </div>
            <div class="timeline-body text-justify row">
              <div class="col-md-3 col-sm-12">
                <img src="#" class="lazyload" data-src="{{ fromDLHost($course->img) }}" style="max-height: 150px;" />
                <p style="text-align: center">
                  @foreach ($course->authors as $author)
                    <small class="text-muted">
                      <i class="glyphicon glyphicon-time"></i>
                      {{ $author->name }}
                    </small>
                    @if (!$loop->last)
                      <br>
                    @endif
                  @endforeach
                </p>
              </div>
              <div class="col-md-9  col-sm-12">
                <p class="mt-md-1" style="
                                                  word-break: break-word;
                                                  overflow: hidden;
                                                  text-overflow: ellipsis;
                                                  display: -webkit-box;
                                                  line-height: 2; /* fallback */
                                                  /* fallback */
                                                  -webkit-line-clamp: 3; /* number of lines to show */
                                                  -webkit-box-orient: vertical;
                                              ">
                  {!! $course->description !!}
                </p>
                <div class="row">
                  <div class="col-md-3 col-sm-6">
                    <b>مدت زمان:</b>
                    {{ $course->durationHours ? $course->durationHours . 'h ' : '' }}
                    {{ $course->durationMinutes ? $course->durationMinutes . 'm' : '' }}
                  </div>
                  <div class="col-md-3 col-sm-6">
                    <b>سطح:</b>

                  </div>
                  <div class="col-md-3 col-sm-6">
                    <b>تاریخ انتشار:</b>
                    <span id="release-date" title="در لیندا {{ date('Y/m/d', strtotime($course->releaseDate)) }}">
                      {{ date('Y/m/d', strtotime($course->releaseDate)) }}
                    </span>
                  </div>
                  <div class="col-md-3 col-sm-6">
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
            @if ($path_state)
              <a data-id="2-{{ $path->id }}" class="btn btn-danger align-self-center cart-remove-btn">
                حذف از سبد خرید
              </a>
            @else
              <a data-id="2-{{ $path->id }}" class="btn btn-download align-self-center cart-add-btn">
                افزودن به سبد خرید
              </a>
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
  </div>
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

      $('.btn-buy').click(function(event) {
        console.log(event);
      });

      $('.btn-preview-first').click(function(event) {
        var modal = $('#exampleModalCenter');
        event.stopPropagation();
        var video_url = $(this).attr('data-video-url');
        var title = $(this).attr('data-title');
        var subtitle_url = $(this).attr('data-subtitle-url');
        var poster_url = $(this).attr('data-poster-url');

        var body = '<div class="video-player" style="width: 100%;">' +
          '   <video \n' +
          '       style="width: 100%;"' +
          '       controls\n' +
          '       preload="auto"\n' +
          '       poster="' + poster_url + '">' +
          '       <source type="video/mp4" src="' + video_url + '"/>' +
          '       <track\n' +
          '           default\n' +
          '           kind="captions"\n' +
          '           srclang="en"\n' +
          '           label="Persian"\n' +
          '           src="' + subtitle_url + '"/>' +
          '   </video>' +
          '</div>';

        // var body = '<div class="video-player" style="padding: 0; margin: 0;">\n' +
        //     '                            <video\n' +
        //     '                                id="preview-player"\n' +
        //     '                                class="video-js vjs-big-play-centered vjs-16-9"\n' +
        //     '                                controls\n' +
        //     '                                preload="auto"\n' +
        //     '                                poster="' + poster_url + '"\n' +
        //     '                                data-setup=\'{ "fluid" : true , "controls": true, "autoplay": false, "preload": "auto", "seek": true  }\'>\n' +
        //     '                                <source type="video/mp4" src="/' + video_url + '"/>\n' +
        //     '\n' +
        //     '                                <track\n' +
        //     '                                    default\n' +
        //     '                                    kind="captions"\n' +
        //     '                                    srclang="en"\n' +
        //     '                                    label="Persian"\n' +
        //     '                                    src="' + subtitle_url + '"/>\n' +
        //     '\n' +
        //     '                                <p class="vjs-no-js">\n' +
        //     '                                    To view this video please enable JavaScript, and consider upgrading to a\n' +
        //     '                                    web browser that\n' +
        //     '                                    <a href="https://videojs.com/html5-video-support/" target="_blank">\n' +
        //     '                                        supports HTML5 video\n' +
        //     '                                    </a>\n' +
        //     '                                </p>\n' +
        //     '                            </video>\n' +
        //     '                        </div>'

        modal.find('.modal-title').text(title);
        $('.modal-body .video-player').remove();
        modal.find('.modal-body')[0].innerHTML = body;
        modal.modal('toggle');
        //var player = videojs('preview-player');

        modal.on('hidden.bs.modal', function(e) {
          // console.log(e)
          $('.modal-body .video-player').remove();
          // modal.find('.modal-body')[0].innerHTML = "";
        });
      });
    })
  </script>
@endsection
