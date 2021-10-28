@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager',[
  'image' => $course->thumbnail ? fromDLHost($course->thumbnail) : fromDLHost($course->img),
  'title' => $course->title . ' - ' . $course->titleEng . ' - لیندا کده',
  'description' => $course->description . ' - ' . $course->descriptionEng,
  'keywords' => $course->title . ', ' . $course->titleEng . ' , ' . get_seo_keywords(),
  ])
  @if ($course->slug_url && $course->slug)
    <link rel="alternate" href="{{ route('courses.show', [$course->slug_url, $course->slug, $course->id]) }}">
  @endif
  <link rel="alternate" href="{{ route('courses.show.short', [$course->id]) }}">

  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Course",
      "image": "{{ fromDLHost($course->img) }}",
      "name": "{{ $course->titleEng }} - {{ $course->title }}",
      "url": "{{ route('courses.show.linkedin', [$course->slug_linkedin]) }}",
      "description": "{{ $course->descriptionEng }} - {{ $course->description }}",
      "dateCreated": "{{ $course->updateDate ?? $course->releaseDate }}",
      "timeRequired": "{{ $course->durationHours > 0 ? $course->durationHours . 'h ' . $course->durationMinutes . 'm' : $course->durationMinutes . 'm' }}",
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
                <div class="course-info-stat-cont m-0 mb-2 w-100">
                  <span class="course-info-stat" style="background-color: darkgreen; font-size: 18px;">
                    {{ $course->price == 0 ? 'رایگان' : nPersian(number_format($course->price)) . ' تومان' }}
                  </span>
                </div>
                @if (auth()->check() && $course->price > 0)
                  @if ($course_state == '1')
                    <div id="cart-btn">
                      <span class="btn btn-secondary align-self-center m-0 mb-2 w-100">
                        خریداری شده
                      </span>
                    </div>
                  @elseif ($course_state == '2')
                    <div id="cart-btn">
                      <a data-id="1-{{ $course->id }}"
                        class="btn btn-danger align-self-center cart-remove-btn m-0 mb-2 w-100">
                        حذف از سبد خرید
                      </a>
                    </div>
                  @elseif($course_state == '3')
                    <div id="cart-btn">
                      <a data-id="1-{{ $course->id }}"
                        class="btn btn-download align-self-center cart-add-btn m-0 mb-2 w-100">
                        افزودن به سبد خرید
                      </a>
                    </div>
                  @endif
                @endif
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
                <div class="course-info-stat-cont m-0 mb-2 w-100">
                  <span class="course-info-stat" style="background-color: darkgreen; font-size: 18px;">
                    {{ $course->price == 0 ? 'FREE' : number_format($course->price) . ' Toman' }}
                  </span>
                </div>
                @if (auth()->check())
                  @if ($course_state == '1')
                    <div id="cart-btn">
                      <span class="btn btn-secondary align-self-center m-0 mb-2 w-100">
                        Purchased
                      </span>
                    </div>
                  @elseif ($course_state == '2')
                    <div id="cart-btn">
                      <a data-id="1-{{ $course->id }}"
                        class="btn btn-danger align-self-center cart-remove-btn m-0 mb-2 w-100">
                        Remove From Cart
                      </a>
                    </div>
                  @elseif($course_state == '3')
                    <div id="cart-btn">
                      <a data-id="1-{{ $course->id }}"
                        class="btn btn-download align-self-center cart-add-btn m-0 mb-2 w-100">
                        Add To Cart
                      </a>
                    </div>
                  @endif
                @endif
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
            @if (auth()->check() && (Auth::user()->role->id == TCG\Voyager\Models\Role::firstWhere('name', 'admin')->id || $course_state == '1' || $course->price == 0))

              <div class="row justify-content-center text-left" dir="ltr">
                <div class="col-lg-2 text-center">
                  <i class="lyndacon project-files" style="font-size: 120px; color: #ddd"></i>
                </div>
                <div class="col-lg-10">
                  <div></div>
                  <p></p>
                  <ul class="exercise-files-popover">
                    @if ($course->courseFile && count(json_decode($course->courseFile)) > 0)
                      @foreach (json_decode($course->courseFile) as $file)
                        <li role="presentation">
                          <a role="link"
                            href="{{ route('courses.download', [$course->id, hash('md5', 'courseFile') => hash('sha256', auth()->id())]) }}">
                            <i class="lyndacon unlock" style="font-size: 20px; color: #ddd"></i>
                            <span>
                              {{ prepare_course_file_name($file->original_name) }}
                            </span>
                            @if (isset($file->size))
                              <span class="text-muted small">
                                ({{ formatBytes($file->size) }})
                              </span>
                            @endif
                          </a>
                          {{-- <a role="link"
                                        href="https://dl.lyndakade.ir/download.php?token={{ create_hashed_data_if_not_exists(auth()->id()) }}&file={{ create_hashed_data_if_not_exists($file->download_link) }}&course={{ create_hashed_data_if_not_exists($course->id) }}&token2={{ create_hashed_data_if_not_exists(request()->ip()) }}">
                                        <i class="lyndacon unlock" style="font-size: 20px; color: #ddd"></i>
                                        <span>
                                        فایل دوره آموزشی
                                        </span>
                                    </a> --}}
                        </li>
                      @endforeach
                    @endif

                    @if ($course->exerciseFile && count(json_decode($course->exerciseFile)) > 0)
                      @php
                        $idx = 0;
                      @endphp
                      @foreach (json_decode($course->exerciseFile) as $file)
                        @php
                          $idx = $idx + 1;
                        @endphp
                        <li role="presentation">
                          <a role="link"
                            href="{{ route('courses.download', [$course->id, hash('md5', 'exFiles') => hash('sha256', auth()->id()), 'filename' => $file->original_name]) }}">
                            <i class="lyndacon unlock" style="font-size: 20px; color: #ddd"></i>
                            <span>
                              {{ prepare_course_file_name($file->original_name) }}
                            </span>
                            @if (isset($file->size))
                              <span class="text-muted small">
                                ({{ formatBytes($file->size) }})
                              </span>
                            @endif
                          </a>
                          {{-- <a role="link"
                                href="https://dl.lyndakade.ir/download.php?token={{ create_hashed_data_if_not_exists(auth()->id()) }}&file={{ create_hashed_data_if_not_exists($file->download_link) }}&course={{ create_hashed_data_if_not_exists($course->id) }}&token2={{ create_hashed_data_if_not_exists(request()->ip()) }}">
                                <i class="lyndacon unlock" style="font-size: 20px; color: #ddd"></i>
                                <span>
                                فایل تمرینی {{ $idx }}
                                </span>
                            </a> --}}
                        </li>
                      @endforeach
                    @endif

                    @if ($course->persianSubtitleFile && count(json_decode($course->persianSubtitleFile)) > 0)
                      @foreach (json_decode($course->persianSubtitleFile) as $file)

                        <li role="presentation">
                          <a role="link"
                            href="{{ route('courses.download', [$course->id, hash('md5', 'persianSubtitleFile') => hash('sha256', auth()->id())]) }}">
                            <i class="lyndacon unlock" style="font-size: 20px; color: #ddd"></i>
                            <span>
                              فایل زیرنویس فارسی دوره
                            </span>
                          </a>
                          {{-- <a role="link"
                                href="https://dl.lyndakade.ir/download.php?token={{ create_hashed_data_if_not_exists(auth()->id()) }}&file={{ create_hashed_data_if_not_exists($file->download_link) }}&course={{ create_hashed_data_if_not_exists($course->id) }}&token2={{ create_hashed_data_if_not_exists(request()->ip()) }}">
                                <i class="lyndacon unlock" style="font-size: 20px; color: #ddd"></i>
                                <span>
                                فایل زیرنویس فارسی دوره
                                </span>
                            </a> --}}
                        </li>
                      @endforeach
                    @endif
                  </ul>
                </div>
              </div>

            @else
              <div class="row justify-content-center text-left" dir="ltr">
                <div class="col-lg-2 text-center">
                  <i class="lyndacon project-files" style="font-size: 120px; color: #ddd"></i>
                </div>
                <div class="col-lg-10">
                  <div></div>
                  @if (!auth()->check())
                    <p class="text-center">برای دانلود، باید وارد حساب کاربری شوید</p>
                  @else
                    <p></p>
                  @endif
                  <div class="col-lg-10">
                    @if ($course->courseFile && count(json_decode($course->courseFile)) > 0)
                      @foreach (json_decode($course->courseFile) as $file)
                        <div>
                          <span>
                            <i class="lyndacon lock align-self-center m-1" style="font-size: 16px;"></i>
                            {{ prepare_course_file_name($file->original_name) }}
                          </span>
                          @if (isset($file->size))
                            <span class="text-muted small">
                              ({{ formatBytes($file->size) }})
                            </span>
                          @endif
                        </div>
                      @endforeach
                    @endif
                    @if ($course->exerciseFile && count(json_decode($course->exerciseFile)) > 0)
                      @foreach (json_decode($course->exerciseFile) as $file)
                        <div>
                          <span>
                            <i class="lyndacon lock align-self-center m-1" style="font-size: 16px;"></i>
                            {{ prepare_course_file_name($file->original_name) }}
                          </span>
                          @if (isset($file->size))
                            <span class="text-muted small">
                              ({{ formatBytes($file->size) }})
                            </span>
                          @endif
                        </div>
                      @endforeach
                    @endif
                  </div>
                </div>
              </div>
            @endif

            {{-- @if (!auth()->check())
            @elseif (Auth::user()->role->id == TCG\Voyager\Models\Role::firstWhere('name', 'admin')->id || $course_state
              == '1'
              || $course->price == 0)
            @endif --}}
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
