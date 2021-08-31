@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager',[
  'image' => $course->thumbnail ? fromDLHost($course->thumbnail) : fromDLHost($course->img),
  'title' => $course->title . ' - ' . $course->titleEng . ' - لیندا کده',
  'description' => $course->description . ' - ' . $course->descriptionEng,
  'keywords' => $course->title . ', ' . $course->titleEng . ' , ' . get_seo_keywords(),
  ])
  <link rel="canonical" href="{{ request()->url() }}" />
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Course",
      "name": "{{ $course->title }}",
      "description": "{{ $course->description }}",
      "provider": [
        @foreach ($course->authors as $author)
          {
          "@type": "Person",
          "name": "{{ $author->name }}",
          "url": {"@id": "{{ route('authors.show', [$author->slug]) }}"}
          }
          @if (!$loop->last)
            ,
          @endif
        @endforeach
      ]
    }
  </script>
@endpush
@section('content')
  @csrf
  <div class="row mx-0 justify-content-center">
    <aside class="col-md-10">
      <div class="section-module">
        {{-- <div class="current-page-path">
          <a href="{{ route('root.home') }}"><span>صفحه اصلی</span></a>
          <i class="lyndacon arrow-left"></i>
          <span>{{ $course->title }}</span>
        </div> --}}

        <h1 class="panel-title" style="font-size: 1em;">
          <span class="course-title">
            {{ $course->title }}
            @if ($course->persian_subtitle_id == 1)
              (<span style="color: green">با زیر نویس فارسی</span>)
            @endif
          </span>
        </h1>
        <div class="panel-title text-left" style="direction: ltr; font-size: 1em;">
          <span class="course-title">{{ $course->titleEng }}</span>
        </div>
        <div class="video-player">
          <video controls {{-- id="my-player" --}} class="w-100" {{-- preload="auto" --}}
            poster="{{ fromDLHost($course->img) }}" {{-- data-setup='{ "fluid" : true , "controls": true, "autoplay": false, "preload": "auto", "seek": true  }' --}} {{-- data-setup='{ "fluid" : true , "preload" : "auto"}' --}}>
            <source type="video/mp4" src="{{ fromDLHost($course->previewFile) }}" />

            {{-- <source type="video/mp4" src="//vjs.zencdn.net/v/oceans.mp4" /> --}}
            @if ($has_subtitle)
              @foreach (json_decode($course->previewSubtitle) as $subtitle)
                <track default kind="subtitles" srclang="en" label="English"
                  src="{{ route('courses.subtitle_content', ['courseId' => $course->id, 'videoId' => 123]) }}" />
              @endforeach
            @endif
            <p class="vjs-no-js">
              To view this video please enable JavaScript, and consider upgrading to a
              web browser that
              <a href="https://videojs.com/html5-video-support/" target="_blank">
                supports HTML5 video
              </a>
            </p>
          </video>
        </div>
        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-description-tab" data-toggle="tab" href="#nav-description"
              role="tab" aria-controls="nav-description" aria-selected="true">توضیحات</a>
            <a class="nav-item nav-link" id="nav-overview-tab" data-toggle="tab" href="#nav-overview" role="tab"
              aria-controls="nav-overview" aria-selected="false">Overview</a>
            @if ($course->concepts)
              <a class="nav-item nav-link" id="nav-concepts-tab" data-toggle="tab" href="#nav-concepts" role="tab"
                aria-controls="nav-concepts" aria-selected="false">سرفصل ها</a>
            @endif
            <a class="nav-item nav-link" id="nav-download-links-tab" data-toggle="tab" href="#nav-download-links"
              role="tab" aria-controls="nav-download-links" aria-selected="false">لینک های دانلود</a>
          </div>
        </nav>

        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-description" role="tabpanel"
            aria-labelledby="nav-description-tab">
            <div class="row">
              <div class="col-sm-2 col-md-3 col-lg-2 course-meta">
                <div class="author-thumb">
                  <h5>مدرس</h5>
                  @foreach ($course->authors as $author)
                    <a href="{{ route('authors.show', [$author->slug]) }}">
                      <img src="#" class="lazyload" width="100" height="100"
                        data-src="{{ fromDLHost($author->img) }}" alt="image of author {{ $author->name }}">
                      <cite>{{ $author->name }}</cite>
                    </a>
                  @endforeach
                </div>
              </div>
              <div class="col-sm-7 col-md-6 col-lg-8 course-description" role="contentinfo">
                <h6 title="{{ nPersian(date('Y/m/d', strtotime($course->releaseDate))) }}">
                  تاریخ
                  انتشار</h6>
                <span id="release-date" title="{{ nPersian(date('Y/m/d', strtotime($course->releaseDate))) }}">
                  <b>
                    @php
                      $d = date('Y/m/d', strtotime($course->releaseDate));
                      $d = explode('/', $d);
                      echo nPersian(gregorian_to_jalali(intval($d[0]), intval($d[1]), intval($d[2]), '/'));
                    @endphp
                  </b>
                </span>
                {{-- {{ $course->created_at->format('Y/m/d') }}</span> --}}
                <i class="lyndacon closed-captioning" title="زیرنویس"></i>
                @if ($course->updateDate)
                  <h6 title="{{ nPersian(date('Y/m/d', strtotime($course->updateDate))) }}">
                    تاریخ
                    بروزرسانی</h6>
                  <span id="release-date" title="{{ nPersian(date('Y/m/d', strtotime($course->updateDate))) }}">
                    <b>
                      @php
                        $d = date('Y/m/d', strtotime($course->updateDate));
                        $d = explode('/', $d);
                        echo nPersian(gregorian_to_jalali(intval($d[0]), intval($d[1]), intval($d[2]), '/'));
                      @endphp
                    </b>
                  </span>
                  {{-- {{ $course->created_at->format('Y/m/d') }}</span> --}}
                  <i class="lyndacon closed-captioning" title="زیرنویس"></i>
                @endif
                <div itemprop="description" class="text-justify" style="font-size: 13px;">
                  {{-- {{ $course->description }} --}}
                  {!! nl2br(e($course->description)) !!}
                </div>
                <div class="row" style="font-weight: 600;">
                  <div class="col-md-4">
                    زیرنویس انگلیسی:
                    @if (get_course_status_state($course->english_subtitle_id))
                      <span style="color: green;">دارد</span>
                    @else
                      <span style="color: red;">ندارد</span>
                    @endif
                  </div>
                  <div class="col-md-4">
                    زیرنویس فارسی:
                    @if (get_course_status_state($course->persian_subtitle_id))
                      <span style="color: green;">دارد</span>
                    @else
                      <span style="color: red;">ندارد</span>
                    @endif
                  </div>
                  <div class="col-md-4">
                    دوبله:
                    @if (get_course_status_state($course->dubbed_id))
                      <span style="color: green;">دارد</span>
                    @else
                      <span style="color: red;">ندارد</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-2 text-center">
                <div class="course-info-stat-cont">
                  <span class="course-info-stat skill-levels clearfix">
                    <span class="beginner {{ $skillEng == 'Beginner' ? 'active' : '' }}"></span>
                    <span class="intermediate {{ $skillEng == 'Intermediate' ? 'active' : '' }}"></span>
                    <span class="advanced {{ $skillEng == 'Advanced' ? 'active' : '' }}"></span>
                  </span>
                  <h6>سطح <strong>{{ $skill }}</strong></h6>
                </div>
                <div class="course-info-stat-cont duration">
                  <span class="course-info-stat">
                    @if ($course->durationHours)
                      {{ $course->durationHours }}h
                    @endif
                    @if ($course->durationMinutes)
                      {{ $course->durationMinutes }}m
                    @endif
                  </span>
                  <h6>مدت زمان دوره</h6>
                </div>
                @if ($course->views > 0)
                  <div class="course-info-stat-cont viewers"
                    title="تعدادی افرادی که این دوره را مشاهده کردند (در لینکدین)">
                    <span id="course-viewers" class="course-info-stat">{{ number_format($course->views) }}</span>
                    <h6>تعدادی افرادی که این دوره را مشاهده کردند</h6>
                  </div>
                @endif
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#report-modal">
                  <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                  گزارش خرابی
                </button>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="nav-overview" role="tabpanel" aria-labelledby="nav-overview-tab">
            <div class="row">
              <div class="col-sm-2 col-md-3 col-lg-2 course-meta">
                <div class="author-thumb">
                  <h5>Author</h5>
                  @foreach ($course->authors as $author)
                    <a href="{{ route('authors.show', [$author->slug]) }}">
                      <img src="#" class="lazyload" width="100" height="100"
                        data-src="{{ fromDLHost($author->img) }}" alt="image of author {{ $author->name }}">
                      <cite>{{ $author->name }}</cite>
                    </a>
                  @endforeach
                </div>
              </div>
              <div class="col-sm-7 col-md-6 col-lg-8 course-description-english" role="contentinfo" dir="ltr">
                <h6 title="@php
                  $d = date('Y/m/d', strtotime($course->releaseDate));
                  $d = explode('/', $d);
                  echo nPersian(gregorian_to_jalali(intval($d[0]), intval($d[1]), intval($d[2]), '/'));
                @endphp">
                  Released:
                </h6>
                <span id="release-date" title="@php
                  $d = date('Y/m/d', strtotime($course->releaseDate));
                  $d = explode('/', $d);
                  echo nPersian(gregorian_to_jalali(intval($d[0]), intval($d[1]), intval($d[2]), '/'));
                @endphp">
                  <b>{{ date('Y/m/d', strtotime($course->releaseDate)) }}</b>
                </span>
                {{-- {{ $course->created_at->format('Y/m/d') }}</span> --}}
                <i class="lyndacon closed-captioning px-1" title="Subtitle"></i>
                @if ($course->updateDate)
                  <h6 title="@php
                    $d = date('Y/m/d', strtotime($course->updateDate));
                    $d = explode('/', $d);
                    echo nPersian(gregorian_to_jalali(intval($d[0]), intval($d[1]), intval($d[2]), '/'));
                  @endphp">
                    Updated:
                  </h6>
                  <span id="release-date" title="@php
                    $d = date('Y/m/d', strtotime($course->updateDate));
                    $d = explode('/', $d);
                    echo nPersian(gregorian_to_jalali(intval($d[0]), intval($d[1]), intval($d[2]), '/'));
                  @endphp">
                    <b>{{ date('Y/m/d', strtotime($course->updateDate)) }}</b>
                  </span>
                  {{-- {{ $course->created_at->format('Y/m/d') }}</span> --}}
                  <i class="lyndacon closed-captioning px-1" title="Subtitle"></i>
                @endif
                <div class="text-justify" itemprop="description" style="font-size: 13px; margin-top: 10px;">
                  {{-- {!! $course->descriptionEng !!} --}}
                  {!! nl2br(e($course->descriptionEng)) !!}
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-2 text-center">
                <div class="course-info-stat-cont">
                  <span class="course-info-stat skill-levels clearfix">
                    <span class="beginner {{ $skillEng == 'Beginner' ? 'active' : '' }}"></span>
                    <span class="intermediate {{ $skillEng == 'Intermediate' ? 'active' : '' }}"></span>
                    <span class="advanced {{ $skillEng == 'Advanced' ? 'active' : '' }}"></span>
                  </span>
                  <h6>Skill Level <strong>{{ $skillEng }}</strong></h6>
                </div>
                <div class="course-info-stat-cont duration">
                  <span class="course-info-stat">
                    @if ($course->durationHours)
                      {{ $course->durationHours }}h
                    @endif
                    @if ($course->durationMinutes)
                      {{ $course->durationMinutes }}m
                    @endif
                  </span>
                  <h6>Duration</h6>
                </div>

                @if ($course->views > 0)
                  <div class="course-info-stat-cont viewers" title="Number of people watched this course (from linkedin)">
                    <span id="course-viewers" class="course-info-stat">{{ number_format($course->views) }}</span>
                    <h6>People watched this course</h6>
                  </div>
                @endif
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#report-modal">
                  <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                  Report
                </button>
              </div>
            </div>
          </div>
          @if ($course->concepts)
            <div class="tab-pane fade" id="nav-concepts" role="tabpanel" aria-labelledby="nav-concepts-tab">
              <div class="row" style="font-size: 1.3em;">
                <div class="col-sm-6">
                  <pre
                    style="font-family: 'IranSANS'; overflow-y: hidden; line-height: 1.5;">{!! $course->concepts !!}</pre>
                </div>
                <div class="col-sm-6 text-left" dir="ltr">
                  <pre style="overflow-y: hidden; line-height: 1.5;">{!! $course->conceptsEng !!}</pre>
                </div>
              </div>
            </div>
          @endif
          <div class="tab-pane fade" id="nav-download-links" role="tabpanel" aria-labelledby="nav-download-links-tab">
            <div class="row">
              @include('courses.partials._project_files', ['course' => $course])

              {{-- <div class="col-12 text-center">
                <i class="lyndacon download align-self-center p-2" style="font-size: 24px;"></i>
                <br>
                برای تماشا بصورت آفلاین، این درس را {{ $course->price > 0 ? 'خریداری' : 'دانلود' }} کنید.

                <br>
                @include('courses.partials._link_btn', ['course' => $course])
              </div> --}}
            </div>
          </div>
        </div>
      </div>
    </aside>
  </div>

  @if (count($course->subjects) > 0 || count($course->softwares) > 0)
    <div class="row mx-0 justify-content-center">
      <aside class="col-md-10">
        <div class="section-module">
          @if (count($course->subjects) > 0)
            <div class="tags subject-tags">
              <h5 class="course-title" style="font-size: 1.2rem;">عناوین مرتبط</h5>
              @foreach ($course->subjects as $subject)
                <a target="_blank"
                  href="{{ route('home.show', [$subject->slug]) }}"><em>{{ $subject->title }}</em></a>
              @endforeach
            </div>
          @endif

          @if (count($course->softwares) > 0)
            <div class="tags software-tags">
              <h5 class="course-title" style="font-size: 1.2rem;">نرم افزارهای مرتبط</h5>
              @foreach ($course->softwares as $software)
                <a target="_blank"
                  href="{{ route('home.show', [$software->slug]) }}"><em>{{ $software->title }}</em></a>
              @endforeach
            </div>
          @endif
        </div>
      </aside>
    </div>
  @endif

  <div class="row mx-0 justify-content-center">
    <aside class="col-md-10">
      <div class="section-module">
        <div class="row p-0 m-0">
          <div class="col-6">
            <h5 class="course-title">دروس مرتبط</h5>
          </div>
          <div id="carousel-arrows" class="col-6">
            <a class="align-self-center" href="#blogCarousel" role="button" data-slide="next">
              <i class="lyndacon arrow-right" aria-hidden="true"></i>
              بعدی
              <span class="sr-only">Next</span>
            </a>
            <a class="align-self-center" href="#blogCarousel" role="button" data-slide="prev">
              قبلی
              <i class="lyndacon arrow-left" aria-hidden="true"></i>
              <span class="sr-only">Previous</span>
            </a>
          </div>
        </div>
        <div id="blogCarousel" class="carousel slide" data-interval="1000000">
          <div class="carousel-inner" count="{{ count($related_courses) }}">
            @for ($index = 0; $index < count($related_courses); $index += 4)
              <div class="carousel-item {{ $index < 4 ? 'active' : '' }}" index=" {{ $index }}">
                <div class="row d-flex">
                  @for ($i = 0; $i < 4 && $index + $i < count($related_courses); $i++)
                    @include('courses.partials._course_list_grid', ['course'=>
                    $related_courses[$index + $i]])
                  @endfor
                </div>
              </div>
            @endfor
          </div>
        </div>
      </div>
    </aside>
  </div>

  <div id="report-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="report-modal-title"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title w-100" id="report-modal-title">
            <span>گزارش خرابی - {{ $course->title }}</span> <br />
            <span style="float: left;">Report issues - {{ $course->titleEng }}</span>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="لغو">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body pb-0">
          <form action="{{ route('courses.report-issues') }}" method="post">
            @csrf
            <input type="hidden" name="id" id="id" value="{{ $course->id }}" />
            <div class="form-group">
              <label for="report_text">پیام:</label>
              <textarea rows="5" name="report_text" id="report_text" class="form-control col-12"
                placeholder="متن را اینجا بنویسید ..."> </textarea>
            </div>
            <div class="form-group">
              <label for="report_type">
                دلیل خرابی:
              </label>
              <select name="report_type" id="report_type">
                <option value="links-{{ $course->id }}">لینک فایل</option>
                <option value="details-{{ $course->id }}">مشخصات دوره</option>
                <option value="others-{{ $course->id }}">سایر</option>
              </select>
            </div>
            <div class="form-group modal-footer">
              <button type="submit" class="btn btn-primary">ارسال</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">لغو</button>
            </div>
          </form>
        </div>
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
      })
    })
  </script>
@endsection
