@extends('layouts.app')

@php
$keyword_subs = '';
if (count($course->subjects) > 0) {
    foreach ($course->subjects as $subject) {
        $keyword_subs .= 'آموزش های ' . $subject->title;
        $keyword_subs .= ', ';
    }
}
@endphp

@push('meta.in.head')

  <script type="application/ld+json">
    {
      "@context": "http://schema.org/",
      "@id": "{{ fromDLHost($course->previewFile) }}",
      "@type": "VideoObject",
      {{-- "duration": "PT54S", --}} "name": "{{ $course->title }} - {{ $course->titleEng }}",
      "thumbnailUrl": "{{ $course->thumbnail ? fromDLHost($course->thumbnail) : fromDLHost($course->img) }}",
      "contentUrl": "{{ fromDLHost($course->previewFile) }}",
      "uploadDate": "{{ $course->releaseDate }}",
      "description": "{{ $course->shortDesc ?? $course->description }} - {{ $course->shortDescEng ?? $course->descriptionEng }}"
    }
  </script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.7.2/plyr.css"
    integrity="sha512-SwLjzOmI94KeCvAn5c4U6gS/Sb8UC7lrm40Wf+B0MQxEuGyDqheQHKdBmT4U+r+LkdfAiNH4QHrHtdir3pYBaw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  @include('meta::manager', [
      'image' => $course->thumbnail ? fromDLHost($course->thumbnail) : fromDLHost($course->img),
      'title' => $course->title . ' - ' . $course->titleEng . ' - لیندا کده',
      'description' =>
          ($course->shortDesc ?? $course->description) .
          ' - ' .
          ($course->shortDescEng ?? $course->descriptionEng),
      'keywords' =>
          'دانلود ' .
          $course->title .
          ', ' .
          'دانلود ' .
          $course->titleEng .
          ' , ' .
          'دانلود دوره ' .
          $course->title .
          ', ' .
          'دانلود دوره ' .
          $course->titleEng .
          ' , ' .
          'دانلود دوره آموزشی ' .
          $course->title .
          ', ' .
          'دانلود دوره آموزشی' .
          $course->titleEng .
          ' , ' .
          $keyword_subs .
          get_seo_keywords(),
  ])

  <link rel="alternate" href="{{ route('courses.show.linkedin', [$course->slug_linkedin]) }}">
  @if ($course->slug_url)
    @foreach (explode(',', $course->slug_url) as $item)
      <link rel="alternate" href="{{ route('courses.show.linkedin', [$item]) }}">
    @endforeach
  @endif

  <link rel="alternate" href="{{ route('courses.show.short', [$course->id]) }}">

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
          "name": "{{ $course->title }} - {{ $course->titleEng }} - لیندا کده",
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
              "@id": "https://LyndaKade.ir/Learning",
              "name": "Learning",
              "url": "https://LyndaKade.ir/Learning"
            }
          }, {
            "@type": "ListItem",
            "position": 2,
            "item": {
              "@id": "{{ route('courses.show.linkedin', [$course->slug_linkedin]) }}",
              "name": "{{ $course->title }} - {{ $course->titleEng }}",
              "url": "{{ route('courses.show.linkedin', [$course->slug_linkedin]) }}"
            }
          }]
        },
        {
          "@context": "https://schema.org",
          "@type": "Course",
          "image": "{{ fromDLHost($course->img) }}",
          "name": "{{ $course->titleEng }} - {{ $course->title }}",
          "url": "{{ route('courses.show.linkedin', [$course->slug_linkedin]) }}",
          "description": "{{ $course->shortDesc ?? $course->description }}",
          "dateCreated": "{{ $course->updateDate ?? $course->releaseDate }}",
          "timeRequired": "{{ $course->durationHours > 0 ? $course->durationHours . 'h ' . $course->durationMinutes . 'm' : $course->durationMinutes . 'm' }}",
          "provider": [
            @foreach ($course->authors as $author)
              {
                "@type": "Person",
                "name": "{{ $author->name }}",
                "url": {
                  "@id": "{{ route('authors.show', [$author->slug]) }}"
                }
              }
              @if (!$loop->last)
                ,
              @endif
            @endforeach
          ]
        }
      ]
    }
  </script>
@endpush
@section('content')
  <style>
    @media (max-width: 900px) {
      li.tags a:nth-child(n+7) {
        display: none;
      }
    }

    @media (max-width: 768px) {
      li.tags a:nth-child(n+5) {
        display: none;
      }
    }

    @media (max-width: 500px) {
      li.tags a:nth-child(n+4) {
        display: none;
      }
    }


    .wrapper {
      display: flex;
      width: 100%;
      align-items: stretch;
      position: relative;
    }

    :root {
      --sidebar-size: 300px;
    }

    #dismiss {
      width: 30px;
      height: 30px;
      line-height: 30px;
      text-align: center;
      border: 1px solid #7386D5;
      position: absolute;
      top: 5px;
      left: 12px;
      border-radius: 5px;
      cursor: pointer;
      -webkit-transition: all 0.3s;
      -o-transition: all 0.3s;
      transition: all 0.3s;
    }

    #dismiss:hover {
      background: #fff;
      color: #7386D5;
    }

    .overlay {
      display: none;
      position: fixed;
      width: 100vw;
      height: 100vh;
      background: rgba(0, 0, 0, 0.7);
      z-index: 998;
      opacity: 0;
      transition: all 0.5s ease-in-out;
    }

    .overlay.active {
      display: block;
      opacity: 1;
    }

    #sidebar {
      position: sticky;
      width: var(--sidebar-size);
      text-align: right;
      top: 0;
      text-align: right;
      height: 100vh;
      z-index: 999;
      background: #3a3a3a;
      color: #fff;
      transition: all 0.3s;
      overflow-y: auto;
      margin-right: calc(var(--sidebar-size)*(-1));
      scroll-behavior: smooth;
    }

    #sidebar ul ul,
    #sidebar ul.components {
      padding: 0;
    }

    #sidebar.active {
      margin-right: 0;
    }

    #sidebar ul p {
      color: #fff;
      padding: 10px;
      margin-bottom: 0;
      border-bottom: 1px solid #ccc;
    }

    #sidebar ul.components>li {
      border-bottom: 1px solid #ccc;
    }

    #sidebar ul.components>li>a {
      padding-right: 15px;
      padding-top: 10px;
      padding-bottom: 10px;
    }

    #sidebar ul li a {
      color: #fff !important;
      padding: 5px 10px;
      font-size: 1.1em;
      display: block;
    }

    #sidebar ul li a small {
      color: rgba(255, 255, 255, .7);
    }

    #sidebar ul ul li a:hover {
      color: #7386D5;
      background: rgba(255, 255, 255, .15);
    }

    #sidebar ul ul li.active>a,
    #sidebar ul ul li a[aria-expanded="true"] {
      color: #fff;
      background: rgba(0, 0, 0, .35);
    }

    #sidebar a[data-toggle="collapse"] {
      position: relative;
    }

    #sidebar .dropdown-toggle::after {
      display: block;
      position: absolute;
      top: 50%;
      left: 20px;
      transform: translateY(-50%);
    }

    #sidebar ul ul a {
      font-size: 0.9em !important;
      padding-right: 30px !important;
      background: transparent;
    }

    #sidebar ul.CTAs {
      padding: 20px;
    }

    #sidebar ul.CTAs a {
      text-align: center;
      font-size: 0.9em !important;
      display: block;
      border-radius: 5px;
      margin-bottom: 5px;
    }

    #sidebar a.article,
    #sidebar a.download {
      background: transparent !important;
      color: #fff !important;
      border-radius: 5px;
      border: 1px solid #ddd;
    }

    #content {
      width: 100%;
      padding: 0;
      min-height: 100vh;
      transition: all 0.3s;
    }

    #content.active {
      width: calc(100% - var(--sidebar-size));
    }

    #sidebarCollapse {
      display: inline-block;
      margin-bottom: 0;
      padding: 0.4em;
      border: 1px solid #6c757d;
      width: 40px;
      height: 40px;
      background: #f5f5f5;
      cursor: pointer;
      font-size: 13px;
      line-height: 1.42857143;
      border-radius: 5px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    #sidebarCollapse span {
      width: 80%;
      height: 2px;
      margin: 5px auto;
      display: block;
      background: #555;
      transition: all 0.8s cubic-bezier(0.810, -0.330, 0.345, 1.375);
      transition-delay: 0.2s;
    }

    #sidebarCollapse.active span:first-of-type {
      transform: rotate(45deg) translate(2px, 2px);
    }

    #sidebarCollapse.active span:nth-of-type(2) {
      opacity: 0;
    }

    #sidebarCollapse.active span:last-of-type {
      transform: rotate(-45deg) translate(1px, -1px);
    }

    #sidebarCollapse.active span {
      transform: none;
      opacity: 1;
      margin: 0 auto;
    }

    @media (max-width: 767px) {


      #sidebar {
        margin-right: calc(var(--sidebar-size)*(-1));
      }

      #sidebar.active {
        margin-right: 0;
        width: 100%;
      }

      #content {
        width: 100%;
      }

      #content.active {
        display: none;
      }

    }

    @media (min-width: 768px) {
      .overlay.active {
        display: none;
        opacity: 0;
      }

      .plyr video {
        height: 500px;
      }

    }

    #sidebar ul>li:hover>a:before {
      width: 0;
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
  <div class="wrapper">
    <nav id="sidebar">
      <ul class="list-unstyled components">
        <div id="dismiss">
          <i class="fas fa-arrow-left"></i>
        </div>
        <p>سرفصل‌ها</p>
        @foreach ($chapters as $idx => $chapter)
          <li class="course-chapter">
            <a href="#chap-{{ $idx + 1 }}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
              {{ $chapter->title }}
            </a>
            <ul class="list-unstyled collapse" id="chap-{{ $idx + 1 }}" style="">
              @foreach ($chapter->videos as $video)
                <li>
                  <a class="play-course-video" data-title="{{ $video->title }}" data-video-id="{{ $video->id }}"
                    href="javascript:void(0);">
                    {{ $video->title }}
                    <br /><small>{{ $video->duration }}</small>
                  </a>
                </li>
              @endforeach
            </ul>
          </li>
        @endforeach
      </ul>

      <ul class="list-unstyled CTAs">
        <li>
          <a href="" class="download">Download</a>
        </li>
        {{-- <li>
        <a href="" class="article">Back</a>
      </li> --}}
      </ul>
    </nav>
    <div id="content">
      <div class="section-module my-0" style="box-shadow: none;">
        <div style="padding: 0 40px 10px;">
          <button type="button" id="sidebarCollapse" class="navbar-btn">
            <span></span>
            <span></span>
            <span></span>
          </button>
        </div>
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
        <div class="video-player" style="padding: 0;">
          <video playsinline controls id="plyr-video" data-poster="{{ fromDLHost($course->img) }}">
            <source type="video/mp4" src="{{ fromDLHost($course->previewFile) }}" size="720" default />
            @if ($course->dubbed_id == 2)
              @if (strlen($previewSubtitleContent) > 0)
                <track kind="captions" label="فارسی"
                  src="{{ route('courses.subtitle_content', ['courseId' => $course->id]) }}&lang=fa" srclang="fa"
                  default>
              @endif
              @if (strlen($previewSubtitleContentEng) > 0)
                <track kind="captions" label="English"
                  src="{{ route('courses.subtitle_content', ['courseId' => $course->id]) }}&lang=en" srclang="en">
              @endif
            @endif
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
                    style="font-size: 1.25rem;margin-bottom: 0.5rem; font-family: inherit; font-weight: 500; line-height: 1.2;margin-top: 0;">
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
                      style="font-size: 1.25rem;margin-bottom: 0.5rem; font-family: inherit; font-weight: 500; line-height: 1.2;margin-top: 0;">
                      دوبلور
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
                    style="font-size: 1.25rem;margin-bottom: 0.5rem; font-family: inherit; font-weight: 500; line-height: 1.2;margin-top: 0;">
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
                      style="font-size: 1.25rem;margin-bottom: 0.5rem; font-family: inherit; font-weight: 500; line-height: 1.2;margin-top: 0;">
                      Dubbed By
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

        @if (count($subjects) > 0)
          <div class="tags subject-tags">
            <h5 class="course-title" style="font-size: 1.2rem;">عناوین مرتبط</h5>
            @foreach ($subjects as $subject)
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
      </div>

      @if (count($related_paths))
        <div class="section-module my-0" style="box-shadow: none;">
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
      @endif

      <div class="section-module my-0" style="box-shadow: none;">
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
    </div>
  </div>
@endsection
@section('script_body')
  <script>
    const course_player = new Plyr("#plyr-video", {
      title: "{{ $course->title }}",
      controls: [
        'play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'captions', 'settings', 'pip',
        'airplay', 'fullscreen'
      ],
      settings: ['captions', 'quality', 'speed', 'loop'],
      invertTime: true,
      toggleInvert: true,
      disableContextMenu: true,
      seekTime: 5,
      captions: {
        active: true,
        // language: 'fa',
        language: 'auto',
        update: true,
        // update: false,
      },
      keyboard: {
        focused: true,
        global: true
      },
      i18n: {
        restart: 'پخش مجدد',
        rewind: 'برگشت به {seektime}s',
        play: 'پخش',
        pause: 'توقف',
        fastForward: 'به جلو رفتن {seektime}s',
        seek: 'جابجا شدن',
        seekLabel: '{currentTime} از {duration}',
        played: 'پخش شده',
        buffered: 'بافر شده',
        currentTime: 'زمان فعلی',
        duration: 'مدت زمان',
        volume: 'صدا',
        mute: 'بی صدا',
        unmute: 'با صدا',
        enableCaptions: 'فعال کردن زیرنویس',
        disableCaptions: 'غیرفعال کردن زیرنویس',
        download: 'دانلود',
        enterFullscreen: 'فعال کردن تمام صفحه',
        exitFullscreen: 'غیر فعال کردن تمام صفحه',
        frameTitle: '{title}',
        captions: 'زیرنویس‌ها',
        settings: 'تنظیمات',
        pip: 'تصویر-در-تصویر',
        menuBack: 'برگشت به منوی قبلی',
        speed: 'سرعت',
        normal: 'عادی',
        quality: 'کیفیت',
        loop: 'حلقه پخش',
        start: 'شروع',
        end: 'پایان',
        all: 'همه',
        reset: 'بازنشانی',
        disabled: 'غیرفعال',
        enabled: 'فعال',
        advertisement: 'تبلیغات',
        qualityBadge: {
          2160: '4K',
          1440: 'HD',
          1080: 'HD',
          720: 'HD',
          576: 'SD',
          480: 'SD',
        },
      }
      //   ratio: '16:9',

    });



    // window.addEventListener('goftino_ready', function() {
    //   Goftino.setWidget({
    //     hasIcon: false,
    //     counter: '#unread_counter'
    //   });
    // });
    var current_playing_video_id = '';
    var course_id = '{{ $course->id }}';
    var course_title = '{{ $course->title }}';
    var course_titleEng = '{{ $course->titleEng }}';
    var isSent = false;
    $(document).on('click', '.report-issue-toggle', function(e) {
      Goftino.open();
      if (!isSent) {
        Goftino.sendMessage({
          text: 'سلام کاربر گرامی، لطفا گزارش خودتون رو برای "' + course_title + '" در اینجا ذکر کنید.'
        });
        isSent = true;
      }
    });

    $(document).on('click', '#dismiss, .overlay', function(event) {
      $('#sidebar').removeClass('active');
      $('.overlay').removeClass('active');
      $('#content').removeClass('active');
      $('#sidebarCollapse').removeClass('active');
    });

    $(document).on('click', '#sidebarCollapse', function(event) {
      $('#sidebar, #content, .overlay').toggleClass('active');
      $('.collapse.in').toggleClass('in');
      $('a[aria-expanded=true]').attr('aria-expanded', 'false');
      $(this).toggleClass('active');
    });

    $(document).on('click', '.play-course-video', function(event) {
      if (window.innerWidth < 768) {
        $('#sidebar').removeClass('active');
        $('.overlay').removeClass('active');
        $('#content').removeClass('active');
        $('#sidebarCollapse').removeClass('active');
      }
      $('.play-course-video').parent().removeClass('active');
      $(this).parent().toggleClass('active');

      const btn = event.currentTarget.dataset;
      var videoId = btn.videoId;
      var title = btn.title;
      PlayVideo(title, videoId);
    });
    course_player.on('ended', function(event) {
      var $next = $(".course-chapter li.active").next();
      if ($next.length == 0) {
        var $current_chapter = $(document.querySelector(".course-chapter li.active").closest('.course-chapter'));
        $current_chapter.trigger('click');
        var $next_chap = $current_chapter.next();
        if ($next_chap.length) {
          $next = $($next_chap.find('li')[0]);
        } else {
          console.log("last chapter finished");
          // last chapter finished
          return;
        }
      }
      $next.find("a").trigger("click");
      var videoId = $($next.find("a")).data('videoId');
      var title = $($next.find("a")).data('title');
      PlayVideo(title, videoId);
    });

    function PlayVideo(title, video_id) {
      course_player.source = {
        type: "video",
        title: title,
        sources: [{
          src: `//dl.lyndakade.ir/download.php?code=${video_id}&x=v`,
          type: 'video/mp4'
        }],
        tracks: ("{{ $course->dubbed_id }}" == "1") ? [] : [{
          kind: 'captions',
          label: 'فارسی',
          srclang: 'fa',
          src: `https://lyndakade.ir/api/courses/videos/get-sub?code=${video_id}&x=f`,
          default: true,
        }, {
          kind: 'captions',
          label: 'English',
          srclang: 'en',
          src: `https://lyndakade.ir/api/courses/videos/get-sub?code=${video_id}&x=e`,
          default: false,
        }, ],
        poster: "{{ fromDLHost($course->img) }}"
      };
      course_player.currentTime = 0;
      course_player.play();
    }
    $('#sidebarCollapse').trigger("click");
    $('.course-chapter > a').trigger("click");
    course_player.on('loadedmetadata', function(event) {
      console.log(event);
    });

    $(document).ready(function() {
      $('.carousel').carousel({
        interval: false,
        wrap: false,
        keyboard: false,
      });
      $(document.querySelector('.course-chapter .play-course-video')).trigger("click");
    });
  </script>
@endsection
