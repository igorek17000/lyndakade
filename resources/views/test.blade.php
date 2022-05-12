@extends('layouts.app')
@push('meta.in.head')
  <link rel="stylesheet" href="https://cdn.plyr.io/2.0.15/plyr.css">
@endpush

@section('content')
  <style>
    @media(max-width: 900px) {
      li.tags a:nth-child(n+7) {
        display: none;
      }
    }

    @media(max-width: 768px) {
      li.tags a:nth-child(n+5) {
        display: none;
      }
    }

    @media(max-width: 500px) {
      li.tags a:nth-child(n+4) {
        display: none;
      }
    }

  </style>
  @csrf
  @if (isset($has_dubbed))
    @if ($has_dubbed)
      <div class="text-center"
        style="font-size: 17px;padding: 15px 0 15px 100px;background-color: rgb(0 59 122);color: #fff;font-family: 'IranSANS';font-weight: bold;bottom: 0;position: fixed;z-index: 100;width: 100%;">
        دوبله‌ی فارسی این دوره آموزشی، در وبسایت قرار داده شده است. <a href="https://lyndakade.ir/c/{{ $has_dubbed }}">
          اینجا کلیک کنید. </a>
      </div>
    @endif
  @endif

  <div class="row mx-0 justify-content-center">
    <aside class="col-md-10">
      <div class="section-module">
        <h1 class="panel-title" style="font-size: 1em;">
          <span class="course-title" lang="fa">
            {{ $course->title }}
            @if ($course->dubbed_id == 1)
              (<span style="color: green">دوبله فارسی</span>)
            @elseif ($course->persian_subtitle_id == 1)
              (<span style="color: green">با زیر نویس فارسی</span>)
            @endif
          </span>
        </h1>
        <div class="panel-title text-left" style="direction: ltr; font-size: 1em;">
          <span class="course-title">{{ $course->titleEng }}</span>
        </div>

        <div style="position: relative;">
          {{-- @if (count($subjects) > 0)
            <ul style="padding-left: 200px;">
              <li class="pr-4 tags">دسته:
                @foreach ($subjects as $subject)
                  <a target="_blank" titleEng="{{ $subject->title }}"
                    title="دارای {{ $subject->courses_count }} دوره آموزشی"
                    style="position: relative;background-color: #ddd;margin-bottom: 15px;"
                    href="{{ route('home.show', [$subject->slug]) }}">
                    <em>{{ $subject->title_per ?? $subject->title }}</em>
                    <span
                      style="position: absolute;color: darkblue;top: 80%;font-weight: 600;left: 0;width: 100%;text-align: center;background-color: darkgray;font-size: 10px;padding: 2px 0;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;">
                      {{ $subject->courses_count }} دوره
                    </span>
                  </a>
                @endforeach
              </li>
            </ul>
          @endif --}}
          <div class="input-group" style="text-align: left;position: absolute;width: 200px;left: 0;top: 2px;">
            <span class="input-group-addon"><i class="fa fa-copy"
                style=" position: absolute; z-index: 10; left: 8px; top: 7px; font-size: 18px;"></i></span>
            <input readonly=""
              onclick="(()=>{this.select(); this.setSelectionRange(0, 99999); navigator.clipboard.writeText(this.value); toastr.options.rtl = true; toastr.options.positionClass = 'toast-bottom-left'; toastr.info('لینک کوتاه کپی شد.');})()"
              style=" font-size: 12px; text-align: left; direction: rtl; padding-left: 27px; padding-right: 2px; "
              title="لینک کوتاه این دوره" type="text" value="lyndakade.ir/C/{{ $course->id }}" id="shorturl"
              class="form-control">
          </div>
        </div>
        <hr class="mt-0 mb-5">

        {{-- <div class="video-player">
          <video id="course-video-player" class="video-js vjs-theme-city vjs-16-9 vjs-big-play-centered" controls
            preload="auto" poster="{{ fromDLHost($course->img) }}" style="width: 100%; max-height: 100%;">
            <source type="video/mp4" src="{{ fromDLHost(str_replace('preview', 'preview1', $course->previewFile)) }}" />
            <p class="vjs-no-js">
              To view this video please enable JavaScript, and consider upgrading to a
              web browser that
              <a href="https://videojs.com/html5-video-support/" target="_blank">
                supports HTML5 video
              </a>
            </p>
          </video>
        </div> --}}
        <div class="video-player">
          <video playsinline id="plyr-video" poster="{{ fromDLHost($course->img) }}" controls>
            <source type="video/mp4" src="{{ fromDLHost($course->previewFile) }}" size="480" />
            <source type="video/mp4" src="{{ fromDLHost(str_replace('preview', 'preview1', $course->previewFile)) }}"
              size="720" />

            <track kind="captions" label="English captions"
              src="{{ route('courses.subtitle_content', ['courseId' => $course->id]) }}" srclang="en">

            <track kind="captions" label="Persian captions"
              src="{{ route('courses.subtitle_content', ['courseId' => $course->id]) }}" srclang="fa" default>

            {{-- @if ($course->previewSubtitleContent)
              @php echo '<script type="text/vtt">'; @endphp
                {{ $course->previewSubtitleContent }}
            @php echo '</script>'; @endphp
            @endif --}}
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
          </div>
        </nav>

        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-description" role="tabpanel"
            aria-labelledby="nav-description-tab">
            <div class="row">
              <div class="col-sm-2 col-md-3 col-lg-2 course-meta">
                <div class="course-info-stat-cont m-0 mb-2 w-100">
                  <span class="course-info-stat" style="background-color: darkgreen; font-size: 18px;">
                    @if (get_course_price($course->price) != $course->price)
                      <del style="color: #f44">
                        {{ $course->price == 0 ? 'رایگان' : nPersian(number_format($course->price)) . ' تومان' }}
                      </del>
                      <br>
                    @endif
                    {{ $course->price == 0 ? 'رایگان' : nPersian(number_format(get_course_price($course->price))) . ' تومان' }}
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
                    <div id="cart-btn" data-lang="FA">
                      <a data-id="1-{{ $course->id }}" data-lang="FA"
                        class="btn btn-danger align-self-center cart-remove-btn m-0 mb-2 w-100">
                        حذف از سبد خرید
                      </a>
                    </div>
                  @elseif($course_state == '3')
                    <div id="cart-btn" data-lang="FA">
                      <a data-id="1-{{ $course->id }}" data-lang="FA"
                        class="btn btn-download align-self-center cart-add-btn m-0 mb-2 w-100">
                        افزودن به سبد خرید
                      </a>
                    </div>
                  @endif
                @endif
                <div class="author-thumb">
                  <div
                    style="font-size: 1.25rem;margin-bottom: 0.5rem;font-family: inherit;font-weight: 500;line-height: 1.2;margin-top: 0;">
                    مدرس
                  </div>
                  @foreach ($course->authors as $author)
                    <a href="{{ route('authors.show', [$author->slug]) }}">
                      <img src="#" class="lazyload" width="100" height="100"
                        data-src="{{ fromDLHost($author->img) }}" style="border-radius: 10px;"
                        alt="عکس مدرس {{ $author->name }} - Image of Author {{ $author->name }}" />
                      <cite>{{ $author->name }}</cite>
                    </a>
                  @endforeach
                </div>

                @if (count($course->users) > 0)
                  <div style="background-color: #ece81a;padding: 10px 0;border-radius: 15px;margin-top: 5px;"
                    class="author-thumb">
                    <div
                      style="font-size: 1.25rem;margin-bottom: 0.5rem;font-family: inherit;font-weight: 500;line-height: 1.2;margin-top: 0;">
                      دوبله
                      کننده
                    </div>
                    @foreach ($course->users as $user)
                      <a href="{{ route('dubbed.index', [$user->username]) }}">
                        <img src="#" class="lazyload" alt="عکس {{ $user->name }} - Image of {{ $user->name }}"
                          data-src="{{ fromDLHost($user->avatar) }}" style="border-radius: 10px;" width="100"
                          height="100">
                        <cite>{{ $user->name }}</cite>
                      </a>
                    @endforeach
                  </div>
                @endif
              </div>
              <div class="col-sm-7 col-md-6 col-lg-8 course-description" role="contentinfo">
                <div style="margin: 0;font-size: 13px;font-weight: 600;">
                  <span title="{{ nPersian(date('Y/m/d', strtotime($course->releaseDate))) }}">
                    تاریخ انتشار
                    @php
                      $d = date('Y/m/d', strtotime($course->releaseDate));
                      $d = explode('/', $d);
                      echo nPersian(gregorian_to_jalali(intval($d[0]), intval($d[1]), intval($d[2]), '/'));
                    @endphp
                    <i class="lyndacon closed-captioning pl-2" title="زیرنویس"></i>
                  </span>
                  @if ($course->updateDate)
                    <span title="{{ nPersian(date('Y/m/d', strtotime($course->updateDate))) }}">
                      تاریخ بروزرسانی
                      @php
                        $d = date('Y/m/d', strtotime($course->updateDate));
                        $d = explode('/', $d);
                        echo nPersian(gregorian_to_jalali(intval($d[0]), intval($d[1]), intval($d[2]), '/'));
                      @endphp
                    </span>
                    <i class="lyndacon closed-captioning pl-2" title="زیرنویس"></i>
                  @endif
                </div>

                <div class="text-justify" style="font-size: 13px;">
                  {{-- {{ $course->description }} --}}
                  {!! nl2br(e($course->description)) !!}
                </div>
                @php
                  $is_unlocked = auth()->check() && (Auth::user()->role->id == TCG\Voyager\Models\Role::firstWhere('name', 'admin')->id || $course_state == '1' || $course->price == 0);
                @endphp
                <div
                  style="border: 2px solid orange;border-radius: 15px;margin-top: 15px;padding: 15px 20px;font-size: 13px;text-align: left;direction: ltr;">
                  <p
                    style="text-align: center;direction: rtl;margin-bottom: 10px;@if ($is_unlocked) font-weight: 600; @endif">
                    این دوره شامل {{ nPersian($course->partNumbers) }} ویدئو آموزشی
                    @if ($course->dubbed_id == 1)
                      دوبله فارسی می‌باشد.
                    @elseif ($course->persian_subtitle_id == 1)
                      به همراه زیرنویس فارسی و انگلیسی می‌باشد.
                    @elseif ($course->english_subtitle_id == 1)
                      به همراه زیرنویس انگلیسی می‌باشد.
                    @else
                      دارای زیرنویس نمی‌باشد
                    @endif
                  </p>
                  <ul class="exercise-files-popover">
                    @if ($course->courseFile && json_decode($course->courseFile) != null)
                      @foreach (json_decode($course->courseFile) as $file)
                        <li role="presentation">
                          @if ($is_unlocked)
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
                          @else
                            <span>
                              <i class="lyndacon lock align-self-center m-1" style="font-size: 16px;"></i>
                              {{ prepare_course_file_name($file->original_name) }}
                            </span>
                            @if (isset($file->size))
                              <span class="text-muted small">
                                ({{ formatBytes($file->size) }})
                              </span>
                            @endif
                          @endif
                        </li>
                      @endforeach
                    @endif

                    @if ($course->exerciseFile && json_decode($course->exerciseFile) != null)
                      @php
                        $idx = 0;
                      @endphp
                      @foreach (json_decode($course->exerciseFile) as $file)
                        @php
                          $idx = $idx + 1;
                        @endphp
                        <li role="presentation">
                          @if ($is_unlocked)
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
                          @else
                            <span>
                              <i class="lyndacon lock align-self-center m-1" style="font-size: 16px;"></i>
                              {{ prepare_course_file_name($file->original_name) }}
                            </span>
                            @if (isset($file->size))
                              <span class="text-muted small">
                                ({{ formatBytes($file->size) }})
                              </span>
                            @endif
                          @endif
                        </li>
                      @endforeach
                    @endif
                    @if ($course->persianSubtitleFile && json_decode($course->persianSubtitleFile) != null)
                      @foreach (json_decode($course->persianSubtitleFile) as $file)
                        <li role="presentation">
                          @if ($is_unlocked)
                            <a role="link"
                              href="{{ route('courses.download', [$course->id, hash('md5', 'persianSubtitleFile') => hash('sha256', auth()->id())]) }}">
                              <i class="lyndacon unlock" style="font-size: 20px; color: #ddd"></i>
                              <span>
                                فایل زیرنویس فارسی
                              </span>
                            </a>
                          @else
                            <span>
                              <i class="lyndacon lock align-self-center m-1" style="font-size: 16px;"></i>
                              فایل زیرنویس فارسی
                            </span>
                            @if (isset($file->size))
                              <span class="text-muted small">
                                ({{ formatBytes($file->size) }})
                              </span>
                            @endif
                          @endif
                        </li>
                      @endforeach
                    @endif
                  </ul>
                  @if (!auth()->check())
                    <p style="text-align: center;direction: rtl;font-size: 14px;font-weight: 600;">
                      برای دانلود، لطفا
                      <a style="color: blue;" href="{{ route('login', ['returnUrl' => request()->url()]) }}">
                        وارد حساب کاربری
                      </a>
                      شوید.
                    </p>
                  @endif
                </div>
              </div>
              <div class="col-sm-3 col-md-3 col-lg-2 text-center">
                <div class="course-info-stat-cont">
                  <span class="course-info-stat skill-levels clearfix">
                    <span class="beginner {{ $skillEng == 'Beginner' ? 'active' : '' }}"></span>
                    <span class="intermediate {{ $skillEng == 'Intermediate' ? 'active' : '' }}"></span>
                    <span class="advanced {{ $skillEng == 'Advanced' ? 'active' : '' }}"></span>
                  </span>
                  <span style="color: #888; margin-bottom: 4px;">
                    سطح
                    <strong>
                      {{ $skill }}
                    </strong>
                  </span>
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

                  <span style="color: #888; margin-bottom: 4px;">
                    مدت زمان دوره
                  </span>
                </div>
                @if ($course->views > 0)
                  <div class="course-info-stat-cont viewers"
                    title="تعدادی افرادی که این دوره را مشاهده کردند (در لینکدین)">
                    <span id="course-viewers" class="course-info-stat">{{ number_format($course->views) }}</span>
                    <span style="color: #888; margin-bottom: 4px;">
                      تعدادی افرادی که این دوره را مشاهده کردند
                    </span>
                  </div>
                @endif
                <button type="button" class="btn btn-warning report-issue-toggle">
                  <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                  گزارش خرابی
                </button>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="nav-overview" role="tabpanel" aria-labelledby="nav-overview-tab">
            <div class="row">
              <div class="col-sm-2 col-md-3 col-lg-2 course-meta">
                <div class="course-info-stat-cont m-0 mb-2 w-100 text-left" dir="ltr">
                  <span class="course-info-stat" style="background-color: darkgreen; font-size: 18px;">
                    @if (get_course_price($course->price) != $course->price)
                      <del style="color: #f44">
                        {{ $course->price == 0 ? 'FREE' : number_format($course->price) . ' Toman' }}
                      </del>
                      <br>
                    @endif
                    {{ $course->price == 0 ? 'FREE' : number_format(get_course_price($course->price)) . ' Toman' }}
                  </span>
                </div>
                @if (auth()->check() && $course->price > 0)
                  @if ($course_state == '1')
                    <div id="cart-btn">
                      <span class="btn btn-secondary align-self-center m-0 mb-2 w-100">
                        Purchased
                      </span>
                    </div>
                  @elseif ($course_state == '2')
                    <div id="cart-btn" data-lang="EN">
                      <a data-id="1-{{ $course->id }}" data-lang="EN"
                        class="btn btn-danger align-self-center cart-remove-btn m-0 mb-2 w-100">
                        Remove From Cart
                      </a>
                    </div>
                  @elseif($course_state == '3')
                    <div id="cart-btn" data-lang="EN">
                      <a data-id="1-{{ $course->id }}" data-lang="EN"
                        class="btn btn-download align-self-center cart-add-btn m-0 mb-2 w-100">
                        Add To Cart
                      </a>
                    </div>
                  @endif
                @endif
                <div class="author-thumb">
                  <div
                    style="font-size: 1.25rem;margin-bottom: 0.5rem;font-family: inherit;font-weight: 500;line-height: 1.2;margin-top: 0;">
                    Author
                  </div>
                  @foreach ($course->authors as $author)
                    <a href="{{ route('authors.show', [$author->slug]) }}">
                      <img src="#" class="lazyload" width="100" height="100"
                        data-src="{{ fromDLHost($author->img) }}" style="border-radius: 10px;"
                        alt="عکس مدرس {{ $author->name }} - Image of Author {{ $author->name }}" />
                      <cite>{{ $author->name }}</cite>
                    </a>
                  @endforeach
                </div>

                @if (count($course->users) > 0)
                  <div style="background-color: #ece81a;padding: 10px 0;border-radius: 15px;margin-top: 5px;"
                    class="author-thumb">
                    <div
                      style="font-size: 1.25rem;margin-bottom: 0.5rem;font-family: inherit;font-weight: 500;line-height: 1.2;margin-top: 0;">
                      Dubbed
                      By
                    </div>
                    @foreach ($course->users as $user)
                      <a href="{{ route('dubbed.index', [$user->username]) }}">
                        <img src="#" class="lazyload" alt="عکس {{ $user->name }} - Image of {{ $user->name }}"
                          data-src="{{ fromDLHost($user->avatar) }}" style="border-radius: 10px;" width="100"
                          height="100">
                        <cite>{{ $user->name }}</cite>
                      </a>
                    @endforeach
                  </div>
                @endif
              </div>
              <div class="col-sm-7 col-md-6 col-lg-8 course-description-english" role="contentinfo" dir="ltr">
                <div style="margin: 0;font-size: 13px;font-weight: 600;">
                  <span title="@php
                    $d = explode('/', date('Y/m/d', strtotime($course->releaseDate)));
                    echo nPersian(gregorian_to_jalali(intval($d[0]), intval($d[1]), intval($d[2]), '/'));
                  @endphp">
                    Release:
                    {{ date('Y/m/d', strtotime($course->releaseDate)) }}
                    <i class="lyndacon closed-captioning pl-2" title="subtitle"></i>
                  </span>
                  @if ($course->updateDate)
                    <span title="@php
                      $d = explode('/', date('Y/m/d', strtotime($course->updateDate)));
                      echo nPersian(gregorian_to_jalali(intval($d[0]), intval($d[1]), intval($d[2]), '/'));
                    @endphp">
                      Update:
                      {{ date('Y/m/d', strtotime($course->updateDate)) }}
                    </span>
                    <i class="lyndacon closed-captioning pl-2" title="subtitle"></i>
                  @endif
                </div>
                <div class="text-justify" style="font-size: 13px; margin-top: 10px;">
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

                  <span style="color: #888; margin-bottom: 4px;">
                    Skill Level <strong>{{ $skillEng }}</strong>
                  </span>
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
                  <span style="color: #888; margin-bottom: 4px;">
                    Duration
                  </span>
                </div>
                @if ($course->views > 0)
                  <div class="course-info-stat-cont viewers" title="Number of people watched this course (from linkedin)">
                    <span id="course-viewers" class="course-info-stat">{{ number_format($course->views) }}</span>
                    <span style="color: #888; margin-bottom: 4px;">
                      People watched this course
                    </span>
                  </div>
                @endif
                <button type="button" class="btn btn-warning report-issue-toggle">
                  <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                  Report
                </button>
              </div>
            </div>
          </div>
          @if ($course->concepts)
            <div class="tab-pane fade" id="nav-concepts" role="tabpanel" aria-labelledby="nav-concepts-tab">
              <div class="row" style="font-size: 1em;">
                <div class="col-sm-6">
                  <pre style="font-family: 'IranSANS'; overflow-y: hidden; line-height: 1.5;">{!! $course->concepts !!}</pre>
                </div>
                <div class="col-sm-6 text-left" dir="ltr">
                  <pre style="overflow-y: hidden; line-height: 1.5;">{!! $course->conceptsEng !!}</pre>
                </div>
              </div>
            </div>
          @endif
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
                {{-- <a target="_blank"
                  href="{{ route('home.show', [$subject->slug]) }}"><em>{{ $subject->title_per ?? $subject->title }}</em></a> --}}
                <a target="_blank" titleEng="{{ $subject->title }}"
                  title="دارای {{ $subject->courses_count }} دوره آموزشی"
                  style="position: relative;background-color: #ddd;margin-bottom: 15px;"
                  href="{{ route('home.show', [$subject->slug]) }}">
                  <em>{{ $subject->title_per ?? $subject->title }}</em>
                  <span
                    style="position: absolute;color: darkblue;top: 80%;font-weight: 600;left: 0;width: 100%;text-align: center;background-color: darkgray;font-size: 10px;padding: 2px 0;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;">
                    {{ $subject->courses_count }} دوره
                  </span>
                </a>
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

  @if (count($related_paths))
    <div class="row mx-0 justify-content-center">
      <aside class="col-md-10">
        <div class="section-module">
          <div class="row p-0 m-0">
            <div class="col-6">
              <div class="course-title" style="margin-bottom: 0.5rem;">مسیرهای آموزشی مرتبط</div>
            </div>
            <div id="carousel-arrows" class="col-6">
              <a class="align-self-center" href="#related_paths" role="button" data-slide="next">
                <i class="lyndacon arrow-right" aria-hidden="true"></i>
                <span class="sr-only">بعدی</span>
              </a>
              <a class="align-self-center" href="#related_paths" role="button" data-slide="prev">
                <i class="lyndacon arrow-left" aria-hidden="true"></i>
                <span class="sr-only">قبلی</span>
              </a>
            </div>
          </div>
          <div id="related_paths" class="carousel slide" data-interval="1000000">
            <div class="carousel-inner" count="{{ count($related_paths) }}">
              @for ($index = 0; $index < count($related_paths); $index += 4)
                <div class="carousel-item {{ $index < 4 ? 'active' : '' }}" index=" {{ $index }}">
                  <div class="row d-flex">
                    @for ($i = 0; $i < 4 && $index + $i < count($related_paths); $i++)
                      @include('learn_paths.partials.list_item_grid_new', [
                          'path' => $related_paths[$index + $i],
                      ])
                    @endfor
                  </div>
                </div>
              @endfor
            </div>
          </div>
        </div>
      </aside>
    </div>
  @endif
  <div class="row mx-0 justify-content-center">
    <aside class="col-md-10">
      <div class="section-module">
        <div class="row p-0 m-0">
          <div class="col-6">
            <div class="course-title" style="margin-bottom: 0.5rem;">دوره‌های مرتبط</div>
          </div>
          <div id="carousel-arrows" class="col-6">
            <a class="align-self-center" href="#related_courses" role="button" data-slide="next">
              <i class="lyndacon arrow-right" aria-hidden="true"></i>
              <span class="sr-only">بعدی</span>
            </a>
            <a class="align-self-center" href="#related_courses" role="button" data-slide="prev">
              <i class="lyndacon arrow-left" aria-hidden="true"></i>
              <span class="sr-only">قبلی</span>
            </a>
          </div>
        </div>
        <div id="related_courses" class="carousel slide" data-interval="1000000">
          <div class="carousel-inner" count="{{ count($related_courses) }}">
            @for ($index = 0; $index < count($related_courses); $index += 4)
              <div class="carousel-item {{ $index < 4 ? 'active' : '' }}" index=" {{ $index }}">
                <div class="row d-flex">
                  @for ($i = 0; $i < 4 && $index + $i < count($related_courses); $i++)
                    @include('courses.partials._course_list_grid-new', [
                        'course' => $related_courses[$index + $i],
                    ])
                  @endfor
                </div>
              </div>
            @endfor
          </div>
        </div>
      </div>
    </aside>
  </div>
@endsection
@section('script_body')
  <script src="https://cdn.plyr.io/2.0.15/plyr.js"></script>

  <script>
    plyr.setup("#plyr-video", {
      title: "{{ $course->title }}",
      controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'captions', 'settings', 'pip',
        'airplay', 'fullscreen'
      ],
      setting: ['captions', 'quality', 'speed', 'loop'],
      invertTime: true,
      toggleInvert: true,
      captions: {
        active: true,
        language: 'auto',
        update: false
      },
      ratio: '16:9',

    });

    // var player = videojs(document.querySelector('.video-js'), {
    //   fluid: true,
    //   //   playbackRates: [0.5, 1, 1.5, 2],
    //   controls: true,
    //   autoplay: true,
    //   preload: "auto",
    //   seek: true
    // });

    // if ("{{ $course->previewSubtitle }}" != "") {
    //   player.on('loadedmetadata', function() {
    //     var srtText = '';
    //     $.ajax({
    //       url: "{{ route('courses.subtitle_content', ['courseId' => $course->id, 'lang' => 'fa']) }}",
    //       method: 'get',
    //       async: false,
    //       success: function(result) {
    //         srtText = result;
    //       },
    //       errors: function(xhr) {
    //         console.log("xhr", xhr);
    //       }
    //     });
    //     if (srtText != "") {
    //       var srtRegex = /(.*\n)?(\d:\d\d:\d\d),(\d\d --> \d:\d\d:\d\d),(\d\d)/g;
    //       var vttText = 'WEBVTT\n\n' + srtText.replace(srtRegex, '$1$2.$3.$4');
    //       var vttBlob = new Blob([vttText], {
    //         type: 'text/vtt'
    //       });
    //       var blobURL = URL.createObjectURL(vttBlob);
    //       this.addRemoteTextTrack({
    //         src: blobURL,
    //         srclang: 'en',
    //         label: 'english',
    //         kind: 'subtitles',
    //         default: true
    //       }, true);
    //     }
    //   });
    // }

    // window.addEventListener('goftino_ready', function() {
    //   Goftino.setWidget({
    //     hasIcon: false,
    //     counter: '#unread_counter'
    //   });
    // });

    $(function() {
      var course_id = '{{ $course->id }}';
      var course_title = '{{ $course->title }}';
      var course_titleEng = '{{ $course->titleEng }}';
      var isSent = false;
      $(document).on('click', '.report-issue-toggle', function(e) {
        Goftino.open();
        if (!isSent) {
          Goftino.sendMessage({
            text: 'سلام، لطفا گزارش خودتون رو برای "' + course_title + '" در اینجا ذکر کنید.'
          });
          isSent = true;
        }
      });
      $('.carousel').carousel({
        interval: false,
        wrap: false,
        keyboard: false,
      })
    })
  </script>
@endsection
