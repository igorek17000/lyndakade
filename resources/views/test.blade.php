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
      --sidebar-size: 350px;
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

    .sidebarCollapse {
      display: inline-block;
      margin-bottom: 0;
      padding: 0.4em;
      width: 40px;
      height: 40px;
      background: transparent;
      cursor: pointer;
      font-size: 13px;
      line-height: 1.42857143;
      border-radius: 5px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    .sidebarCollapse span {
      width: 80%;
      height: 2px;
      margin: 5px auto;
      display: block;
      background: #fff;
      transition: all 0.8s cubic-bezier(0.810, -0.330, 0.345, 1.375);
      transition-delay: 0.2s;
    }

    #sidebarCollapse {
      float: right;
      width: 110px;
      color: #ccc;
      padding: 5px;
      margin-left: 10px;
      display: flex;
      text-align: center;
      justify-content: center;
      align-content: center;
      align-items: center;
      flex-wrap: nowrap;
      flex-direction: row;
      border-left: 2px solid rgba(255, 255, 255, .35);
    }

    .video-player .title-wrapper {
      font-size: 1rem;
      color: white;
      background-color: #000;
      /* border-top-left-radius: 5px; */
      /* border-top-right-radius: 5px; */
      padding: 0 10px;
      display: flex;
      border-bottom: 1px solid rgba(255, 255, 255, .35);
    }

    #sidebarCollapse.active {
      display: none;
    }

    #video-player-title {
      padding: 6px 0;
    }

    #video-player-title>div {
      overflow: hidden !important;
      text-overflow: ellipsis !important;
      display: -webkit-box !important;
      -webkit-box-orient: vertical !important;
      -webkit-line-clamp: 2 !important;
      /* line-height: 2; */
    }

    /*
                        #sidebarCollapse.active .sidebarCollapse span:first-of-type {
                            transform: rotate(45deg) translate(2px, 2px);
                        }

                        #sidebarCollapse.active .sidebarCollapse span:nth-of-type(2) {
                            opacity: 0;
                        }

                        #sidebarCollapse.active .sidebarCollapse span:last-of-type {
                            transform: rotate(-45deg) translate(1px, -1px);
                        }

                        #sidebarCollapse.active .sidebarCollapse span {
                            transform: none;
                            opacity: 1;
                            margin: 0 auto;
                        }
                        */

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

    #preview-modal-body .plyr video {
      height: auto !important;
    }

    #sidebar ul>li:hover>a:before {
      width: 0;
    }

    .nav-tabs {
      display: flex;
      flex-wrap: wrap;
      align-content: center;
      justify-content: center;
      flex-direction: row;
      align-items: center;
    }

    .nav-tabs .nav-item {
      flex: .15;
    }

    .nav-tabs a.nav-link {
      color: #000;
      margin: 0 1.4rem;
      padding: 11px 8px;
      text-align: -webkit-center;
      text-align: center;
      border: 0;
    }

    .nav-tabs .nav-item:first-child a.nav-link {
      margin-right: 0;
    }

    .nav-tabs .nav-item:last-child a.nav-link {
      margin-left: 0;
    }

    .nav-tabs .nav-link.active {
      color: #0073b1;
      border: 0;
      border-bottom: 2px solid #0073b1;
    }

    .nav-tabs .nav-link:not(.active):hover {
      border: 0;
    }

    .dot-delimiter-after:after {
      content: '\a0\b7\a0';
    }

    .dot-delimited-list {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
    }

    .dot-delimited-list>li {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
    }

    .dot-delimited-list>li:not(:first-of-type):before {
      content: '\a0\b7\a0';
      margin: 0 var(--hue-web-dimension-spacing-2xsmall);
    }

    ul.classroom-workspace-overview__skills-list {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -ms-flex-wrap: wrap;
      flex-wrap: wrap;
    }

    ._basePadding_8b61ij {
      padding: .4rem .8rem;
    }

    ._pill_8b61ij {
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
      font-size: .75rem;
      font-weight: 600;
      text-align: left;
      margin: 0 .4rem .8rem 0;
      background: rgba(0, 0, 0, 0);
      border: .1rem solid rgba(0, 0, 0, 0.3);
      border-radius: 1.6rem;
      min-height: 1.6rem;
      display: -webkit-inline-box;
      display: -ms-inline-flexbox;
      display: inline-flex;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      vertical-align: middle;
      cursor: pointer;
    }

    ._label_8b61ij,
    a._label_8b61ij,
    a._label_8b61ij:focus,
    a._label_8b61ij:focus:visited,
    a._label_8b61ij:visited {
      color: rgba(0, 0, 0, 0.6);
      text-decoration: none;
    }

    .t-bold {
      font-weight: 600;
    }

    .classroom-workspace-overview__header {
      margin-bottom: .5rem;
    }

    .t-08 {
      font-size: .8rem;
      line-height: 1.5;
    }

    .t-10 {
      font-size: 1rem;
      line-height: 1.5;
    }

    .t-12 {
      font-size: 1.2rem;
      line-height: 1.42857;
    }

    .classroom-workspace-overview__mini-headline {
      margin-bottom: .5rem;
    }

    .t-black--light {
      color: rgba(0, 0, 0, .4);
    }


    ._pill_8b61ij:hover ._label_8b61ij,
    a._label_8b61ij:hover,
    a._label_8b61ij:hover:visited {
      color: rgba(0, 0, 0, .75);
      text-decoration: none;
    }

    ._pill_8b61ij:hover {
      background: rgba(0, 0, 0, .04);
      border: .1rem solid rgba(0, 0, 0, .45);
      -webkit-box-shadow: 0 0 0 0.1rem rgba(0, 0, 0, .45);
      box-shadow: 0 0 0 0.1rem rgba(0, 0, 0, .45);
    }

    .classroom-workspace-overview__files {
      margin-top: 15px;
      display: flex;
      flex-direction: column;
      align-content: stretch;
      align-items: stretch;
    }

    .classroom-workspace-overview__files .btn-link {
      text-decoration: none;
      cursor: pointer;
    }

    .classroom-workspace-overview__files .btn-link:hover:focus:visited {
      border: 0;
      text-decoration: none;
      outline: 0 !important;
    }

    .classroom-workspace-author-info {
      border-left: 2px solid #ccc;
    }

    #nav-overview .classroom-workspace-author-info {
      border-right: 2px solid #ccc;
      border-left: 0;
    }

    @media (max-width: 575px) {
      .classroom-workspace-author-info {
        border-left: 0;
      }

      #nav-overview .classroom-workspace-author-info {
        border-right: 0;
      }

      .classroom-workspace-overview__files>li>div {
        position: relative;
        width: 220px;
        margin: 0 auto;
      }
    }

    @media (min-width: 576px) {
      .classroom-workspace-author-info>a>div {
        width: 100%;
      }
    }

    #course-files-modal-body .c-table {
      padding: 15px;
      min-height: 250px;
    }

    #course-files-modal-body .c-table .c-header {
      text-align: center;
      border-radius: 10px 10px 0 0;
      background: #437593;
      font-size: 15px;
      color: #fff;
      line-height: 1.2;
      font-weight: 700;
      padding-right: 20px;
      padding-top: 19px;
      padding-bottom: 19px;
    }

    #course-files-modal-body .c-table .c-item {
      font-size: 11px;
      color: #666;
    }

    #course-files-modal-body .c-table .c-item a {
      display: block;
      background: #fff;
      padding: 7px 10px;
      color: gray;
      border-bottom: 1px solid #efefef;
      font-size: 12px;
      text-align: left;
      direction: ltr;
    }

    #course-files-modal-body .c-table .c-item a:hover {
        background-color: #9c9c9c;
        color: #fff;
        cursor: pointer;
    }
    #course-files-modal-body .c-table .c-item a::before {
        content: '\000BB';
        padding-right: 8px;
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
          <i class="fas fa-arrow-right"></i>
        </div>
        <p>سرفصل‌ها</p>
        @foreach ($chapters as $idx => $chapter)
          <li class="course-chapter">
            <a href="#chap-{{ $idx + 1 }}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
              {{ nPersian($chapter->title) }}
            </a>
            <ul class="list-unstyled collapse" id="chap-{{ $idx + 1 }}" style="">
              @foreach ($chapter->videos as $video)
                <li>
                  <a class="play-course-video" data-title="{{ nPersian($video->title) }}"
                    data-title-eng="{{ $video->titleEng }}" data-video-id="{{ $video->id }}"
                    href="javascript:void(0);">
                    {{ nPersian($video->title) }}
                    <br /><small>{{ $video->duration }}</small>
                  </a>
                </li>
              @endforeach
            </ul>
          </li>
        @endforeach
      </ul>

      {{-- <ul class="list-unstyled CTAs">
        <li>
          <a href="" class="download">Download</a>
        </li>
        <li>
        <a href="" class="article">Back</a>
      </li>
      </ul> --}}
    </nav>
    <div id="content">
      <div class="container-fluid" style="background-color: #fff;padding: 0">
        <h1 class="sr-only" lang="fa">
          {{ $course->title }}
          @if ($course->dubbed_id == 1)
            (<span style="color: green">دوبله فارسی</span>)
          @elseif ($course->persian_subtitle_id == 1)
            (<span style="color: green">با زیر نویس فارسی</span>)
          @endif
        </h1>
        {{-- <h1 class="sr-only panel-title " style="font-size: 1em;" lang="fa">
          <span class="course-title">
            {{ $course->title }}
            @if ($course->dubbed_id == 1)
              (<span style="color: green">دوبله فارسی</span>)
            @elseif ($course->persian_subtitle_id == 1)
              (<span style="color: green">با زیر نویس فارسی</span>)
            @endif
          </span>
        </h1>
        <div class="sr-only panel-title text-left" style="direction: ltr; font-size: 1em;">
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
        <hr class="mt-0 mb-5"> --}}

        <div class="video-player" style="padding: 0;margin-top: 0;">
          <div class="title-wrapper">
            <div id="sidebarCollapse">
              <span class="navbar-btn sidebarCollapse">
                <span></span>
                <span></span>
                <span></span>
              </span>
              سرفصل‌ها
            </div>
            <div id="video-player-title">
              <div></div>
              <div style="color: #bfc1c3!important;font-size: 80%;"></div>
            </div>
          </div>
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
        <ul class="nav nav-tabs justify-content-center">
          <li class="nav-item">
            <a class="nav-link active" id="nav-description-tab" data-toggle="tab" href="#nav-description" role="tab"
              aria-controls="nav-description" aria-selected="true">توضیحات</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="nav-overview-tab" data-toggle="tab" href="#nav-overview" role="tab"
              aria-controls="nav-overview" aria-selected="false">Overview</a>
          </li>
        </ul>

        <div class="container tab-content" id="nav-tabContent" style="margin-bottom: 0;">
          <div class="tab-pane fade show active" id="nav-description" role="tabpanel"
            aria-labelledby="nav-description-tab">
            <div class="row">
              <div class="col-sm-6 col-xs-12 classroom-workspace-author-info" style="margin-bottom: 1.6rem;">
                <h2 class="classroom-workspace-overview__mini-headline t-12 t-bold t-black--light">
                  @if (count($course->users) == 0)
                    مدرس
                  @else
                    دوبلور
                  @endif
                </h2>
                @php
                  $author = $course->authors[0];
                  if (count($course->users) > 0) {
                      $author = $course->users[0];
                  }
                @endphp
                @if (count($course->users) == 0)
                  <a href="{{ route('authors.show', [$author->slug]) }}"
                    style="display: flex; flex-wrap: nowrap; align-content: center; flex-direction: row; justify-content: center; align-items: center; height: 80px;">
                    <img src="#" class="lazyload" width="80" height="80"
                      data-src="{{ fromDLHost($author->img) }}" style="border-radius: 49.9%;"
                      alt="عکس مدرس {{ $author->name }} - Image of Author {{ $author->name }}">
                    <div style="/*width: 100%;*/ padding-right: 10px;">
                      <div>{{ $author->name }}</div>
                      {{-- <div>{{ $author->specialty }}</div> --}}
                    </div>
                  </a>
                @else
                  <a href="{{ route('dubbed.index', [$author->slug]) }}"
                    style="display: flex; flex-wrap: nowrap; align-content: center; flex-direction: row; justify-content: center; align-items: center; height: 80px;">
                    <img src="#" class="lazyload" width="80" height="80"
                      data-src="{{ fromDLHost($author->avatar) }}" style="border-radius: 49.9%;"
                      alt="عکس مدرس {{ $author->name }} - Image of Author {{ $author->name }}">
                    <div style="width: 100%;padding-right: 10px;">
                      <div>{{ $author->name }}</div>
                      {{-- <div>{{ $author->specialty }}</div> --}}
                    </div>
                  </a>
                @endif
              </div>
              <div class="col-sm-6 col-xs-12" style="margin-bottom:  1.6rem;">
                <h2 class="classroom-workspace-overview__mini-headline t-12 t-bold t-black--light">فایل‌های دوره</h2>
                <ul class="classroom-workspace-overview__files t-08 t-bold" style="margin-top: 15px;">
                  <li>
                    <div>
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24"
                        fill="currentColor" width="24" height="24" focusable="false"
                        style="float: right;margin-left: 7px;">
                        <path
                          d="M22.25 10H20V7a1 1 0 00-1-1h-7.83l-.61-1.4a1 1 0 00-.91-.6H3a1 1 0 00-1 1v15a1 1 0 001 1h15.62a1 1 0 00.94-.66L23 11a.8.8 0 000-.28.75.75 0 00-.75-.72zM4 14.7V6h5.13L10 8h8v2H6.4a1 1 0 00-.94.66zM18.05 19H4.42L7 12h13.6z">
                        </path>
                      </svg>
                      <span class="dot-delimiter-after">لینک فایل‌های دوره</span>
                      <button class="btn-link" data-toggle="modal" data-target="#course-files-modal">
                        نمایش
                      </button>
                    </div>
                  </li>
                  <li>
                    <div>
                      <svg class="svg-inline--fa fa-exclamation-triangle fa-w-18" aria-hidden="true" data-prefix="fa"
                        data-icon="exclamation-triangle" role="img" xmlns="http://www.w3.org/2000/svg"
                        data-fa-i2svg="" style="float: right;margin-left: 7px;font-size: 20px;" viewBox="0 0 576 512"
                        width="24" height="24">
                        <path fill="currentColor"
                          d="M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z">
                        </path>
                      </svg>
                      <span class="dot-delimiter-after">گزارش خرابی</span>
                      <button class="btn-link report-issue-toggle">
                        ثبت گزارش
                      </button>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="col-xs-12">
                <div style="margin-bottom: .8rem;">
                  <h3 class="classroom-workspace-overview__header t-12 t-bold">
                    <span style="border-bottom: 3px solid #005aff;">مشخصات دوره
                    </span>
                  </h3>
                  <ul class="dot-delimited-list" style="color: #4a4a4a;">
                    <li>
                      @if ($course->durationHours)
                        {{ $course->durationHours }}h
                      @endif
                      @if ($course->durationMinutes)
                        {{ $course->durationMinutes }}m
                      @endif
                    </li>
                    <li>{{ $skill }}</li>
                    <li>
                      تاریخ انتشار:
                      <span title="{{ nPersian(date('Y/m/d', strtotime($course->releaseDate))) }}">
                        @php
                          $d = date('Y/m/d', strtotime($course->releaseDate));
                          $d = explode('/', $d);
                          echo nPersian(gregorian_to_jalali(intval($d[0]), intval($d[1]), intval($d[2]), '/'));
                        @endphp
                      </span>
                    </li>
                    @if ($course->updateDate)
                      <li>
                        تاریخ بروز رسانی:
                        <span title="{{ nPersian(date('Y/m/d', strtotime($course->updateDate))) }}">
                          @php
                            $d = date('Y/m/d', strtotime($course->updateDate));
                            $d = explode('/', $d);
                            echo nPersian(gregorian_to_jalali(intval($d[0]), intval($d[1]), intval($d[2]), '/'));
                          @endphp
                        </span>
                      </li>
                    @endif
                  </ul>
                </div>
                <div style="text-align: justify;" class="classroom-workspace-overview__description t-10">
                  <div> {!! nl2br(e($course->description)) !!} </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="nav-overview" role="tabpanel" aria-labelledby="nav-overview-tab">
            <div class="row" dir="ltr" style="text-align: left;">
              <div class="col-sm-6 col-xs-12 classroom-workspace-author-info" style="margin-bottom: 1.6rem;">
                <h2 class="classroom-workspace-overview__mini-headline t-12 t-bold t-black--light">
                  @if (count($course->users) == 0)
                    INSTRUCTOR
                  @else
                    DUBBED BY
                  @endif
                </h2>
                @php
                  $author = $course->authors[0];
                  if (count($course->users) > 0) {
                      $author = $course->users[0];
                  }
                @endphp
                @if (count($course->users) == 0)
                  <a href="{{ route('authors.show', [$author->slug]) }}"
                    style="display: flex; flex-wrap: nowrap; align-content: center; flex-direction: row; justify-content: center; align-items: center; height: 80px;">
                    <img src="#" class="lazyload" width="80" height="80"
                      data-src="{{ fromDLHost($author->img) }}" style="border-radius: 49.9%;"
                      alt="عکس مدرس {{ $author->name }} - Image of Author {{ $author->name }}">
                    <div style="/*width: 100%;*/ padding-left: 10px;">
                      <div>{{ $author->name }}</div>
                      {{-- <div>{{ $author->specialty }}</div> --}}
                    </div>
                  </a>
                @else
                  <a href="{{ route('dubbed.index', [$author->slug]) }}"
                    style="display: flex; flex-wrap: nowrap; align-content: center; flex-direction: row; justify-content: center; align-items: center; height: 80px;">
                    <img src="#" class="lazyload" width="80" height="80"
                      data-src="{{ fromDLHost($author->avatar) }}" style="border-radius: 49.9%;"
                      alt="عکس مدرس {{ $author->name }} - Image of Author {{ $author->name }}">
                    <div style="width: 100%;padding-left: 10px;">
                      <div>{{ $author->name }}</div>
                      {{-- <div>{{ $author->specialty }}</div> --}}
                    </div>
                  </a>
                @endif
              </div>
              <div class="col-sm-6 col-xs-12" style="margin-bottom:  1.6rem;">
                <h2 class="classroom-workspace-overview__mini-headline t-12 t-bold t-black--light">RELATED TO THIS COURSE
                </h2>
                <ul class="classroom-workspace-overview__files t-08 t-bold" style="margin-top: 15px;">
                  <li>
                    <div>
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24"
                        fill="currentColor" width="24" height="24" focusable="false"
                        style="float: left;margin-right: 7px;">
                        <path
                          d="M22.25 10H20V7a1 1 0 00-1-1h-7.83l-.61-1.4a1 1 0 00-.91-.6H3a1 1 0 00-1 1v15a1 1 0 001 1h15.62a1 1 0 00.94-.66L23 11a.8.8 0 000-.28.75.75 0 00-.75-.72zM4 14.7V6h5.13L10 8h8v2H6.4a1 1 0 00-.94.66zM18.05 19H4.42L7 12h13.6z">
                        </path>
                      </svg>
                      <span class="dot-delimiter-after">Course Files</span>
                      <button class="btn-link" data-toggle="modal" data-target="#course-files-modal">
                        Show all
                      </button>
                    </div>
                  </li>
                  <li>
                    <div>
                      <svg class="svg-inline--fa fa-exclamation-triangle fa-w-18" aria-hidden="true" data-prefix="fa"
                        data-icon="exclamation-triangle" role="img" xmlns="http://www.w3.org/2000/svg"
                        data-fa-i2svg="" style="float: left;margin-right: 7px;font-size: 20px;" viewBox="0 0 576 512"
                        width="24" height="24">
                        <path fill="currentColor"
                          d="M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z">
                        </path>
                      </svg>
                      <span class="dot-delimiter-after">Report issue</span>
                      <button class="btn-link report-issue-toggle">
                        Send report
                      </button>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="col-xs-12">
                <div style="margin-bottom: .8rem;">
                  <h3 class="classroom-workspace-overview__header t-12 t-bold">
                    <span style="border-bottom: 3px solid #005aff;">Course Details
                    </span>
                  </h3>
                  <ul class="dot-delimited-list" style="color: #4a4a4a;">
                    <li>
                      @if ($course->durationHours)
                        {{ $course->durationHours }}h
                      @endif
                      @if ($course->durationMinutes)
                        {{ $course->durationMinutes }}m
                      @endif
                    </li>
                    <li>{{ $skillEng }}</li>
                    <li>
                      Release:
                      <span
                        title="@php
                                    $d = explode('/', date('Y/m/d', strtotime($course->releaseDate)));
                                    echo nPersian(gregorian_to_jalali(intval($d[0]), intval($d[1]), intval($d[2]), '/'));
                                @endphp">
                        {{ date('Y/m/d', strtotime($course->releaseDate)) }}
                      </span>
                    </li>
                    @if ($course->updateDate)
                      <li>
                        Updated:
                        <span
                          title="@php
                                    $d = explode('/', date('Y/m/d', strtotime($course->updateDate)));
                                    echo nPersian(gregorian_to_jalali(intval($d[0]), intval($d[1]), intval($d[2]), '/'));
                                @endphp">
                          {{ date('Y/m/d', strtotime($course->updateDate)) }}
                        </span>
                      </li>
                    @endif
                  </ul>
                </div>
                <div style="text-align: justify;" class="classroom-workspace-overview__description t-10">
                  <div> {!! nl2br(e($course->descriptionEng)) !!} </div>
                </div>
              </div>
            </div>

            {{-- <div class="row">
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
                        <img src="#" class="lazyload"
                          alt="عکس {{ $user->name }} - Image of {{ $user->name }}"
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
                  <span
                    title="@php
                    $d = explode('/', date('Y/m/d', strtotime($course->releaseDate)));
                    echo nPersian(gregorian_to_jalali(intval($d[0]), intval($d[1]), intval($d[2]), '/'));
                  @endphp">
                    Release:
                    {{ date('Y/m/d', strtotime($course->releaseDate)) }}
                    <i class="lyndacon closed-captioning pl-2" title="subtitle"></i>
                  </span>
                  @if ($course->updateDate)
                    <span
                      title="@php
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
                  <div class="course-info-stat-cont viewers"
                    title="Number of people watched this course (from linkedin)">
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
            </div> --}}
          </div>
        </div>

        @if (count($subjects))
          <div class="container tab-content" style="margin-bottom: 0;padding-left: 0;padding-right: 0;">
            <div class="col-xs-12">
              <h3 class="classroom-workspace-overview__header t-12 t-bold">
                <span style="border-bottom: 3px solid #005aff;">مهارت‌ها
                </span>
              </h3>
              <ul class="classroom-workspace-overview__skills-list">
                @foreach ($subjects as $subject)
                  <li>
                    <a target="_blank" titleEng="{{ $subject->title }}"
                      title="دارای {{ $subject->courses_count }} دوره آموزشی"
                      href="{{ route('home.show', [$subject->slug]) }}"
                      class="ember-view _pill_8b61ij _basePadding_8b61ij _label_8b61ij">
                      {{ $subject->title_per ?? $subject->title }}
                      {{-- <span
                                style="position: absolute;color: darkblue;top: 80%;font-weight: 600;left: 0;width: 100%;text-align: center;background-color: darkgray;font-size: 10px;padding: 2px 0;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;">
                                {{ $subject->courses_count }} دوره
                            </span> --}}
                    </a>
                  </li>
                @endforeach
              </ul>
            </div>
          </div>
        @endif

        @if (count($related_paths))
          <div class="container tab-content clearfix" style="margin-bottom: 0;padding-left: 0;padding-right: 0;">
            <div class="col-xs-12">
              <h3 class="classroom-workspace-overview__header t-12 t-bold">
                <span style="border-bottom: 3px solid #005aff;">
                  مسیرهای آموزشی مرتبط
                </span>
              </h3>
              <div>
                @for ($i = 0; $i < 4 && +$i < count($related_paths); $i++)
                  @include('learn_paths.partials.list_item_grid_new', [
                      'path' => $related_paths[$i],
                  ])
                @endfor
              </div>
            </div>
          </div>
        @endif

        @if (count($related_courses))
          <div class="container tab-content" style="margin-bottom: 0;padding-left: 0;padding-right: 0;">
            <div class="col-xs-12">
              <h3 class="classroom-workspace-overview__header t-12 t-bold">
                <span style="border-bottom: 3px solid #005aff;">
                  دوره‌های آموزشی مرتبط
                </span>
              </h3>
              <div>
                @for ($i = 0; $i < 4 && $i < count($related_courses); $i++)
                  @include('courses.partials._course_list_new', [
                      'course' => $related_courses[$i],
                  ])
                @endfor
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>

  <div class="modal fade" id="course-files-modal" tabindex="-1" role="dialog"
    aria-labelledby="course-files-modal-title" aria-hidden="true" style="background-color: #444c;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content text-center">
        <div class="modal-body p-0" id="course-files-modal-body">
          <div class="c-table">
                @php
                  $is_unlocked = auth()->check() && (Auth::user()->role->id == TCG\Voyager\Models\Role::firstWhere('name', 'admin')->id || $course_state == '1' || $course->price == 0);
                @endphp
            <div class="c-header">
              لینک فایل های تمرین
            </div>
            <div class="c-item">
                @if ($course->exerciseFile && json_decode($course->exerciseFile) != null)
                      @php
                        $idx = 0;
                      @endphp
                      @foreach (json_decode($course->exerciseFile) as $file)
                        @php
                          $idx = $idx + 1;
                        @endphp


                          @if ($is_unlocked)
                            <a href="{{ route('courses.download', [$course->id, hash('md5', 'exFiles') => hash('sha256', auth()->id()), 'filename' => $file->original_name]) }}">
                                <i class="lyndacon unlock" style="font-size: 20px;"></i>
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
                      @endforeach
                    @endif

              <a href="http://dl2.soft98.ir/adobe/Unity/2020.2.7f1/builtin_shaders.zip?1655423933">
                builtin_shaders
            </a>
            </div>
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
    var video_titleEng = '';
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
      video_titleEng = btn.titleEng;
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
      video_titleEng = $($next.find("a")).data('titleEng')
      PlayVideo(title, videoId);
    });

    function PlayVideo(title, video_id) {
      var current_lang = course_player.language;
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
      course_player.language = 'fa';
      course_player.currentTime = 0;
      course_player.play();
    }
    $('#sidebarCollapse').trigger("click");
    $('.course-chapter > a').trigger("click");
    course_player.on('loadedmetadata', function(event) {
      var c_title = course_title.replace('دوره آموزشی ', '');
      var c_titleEng = course_titleEng;
      var video_title = course_player.config.title;
      if (video_titleEng.includes(' - '))
        video_titleEng = video_titleEng.substring(video_titleEng.indexOf(' - ') + 3);
      var video_player_title_html =
        ` <div>${video_title} (${video_titleEng})</div><div style="color: #bfc1c3!important;font-size: 80%;">${c_title} (${c_titleEng})</div>`;
      $('#video-player-title').html(video_player_title_html);
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
