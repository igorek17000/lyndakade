<div class="card course">
  {{-- class="card course @if (isset($loop)) @if ($loop->iteration > 10) hidden-md hidden-sm hidden-xs @endif @endif"> --}}
  <div class="card-horizontal py-2">
    <div class="img-square-wrapper">
      <img
        class="d-inline-block lazyload course-img
              @if ($course->dubbed_id == 1) dubbed-subtitle-img
              @elseif (get_course_status_state($course->persian_subtitle_id)) persian-subtitle-img
              @elseif(get_course_status_state($course->english_subtitle_id)) english-subtitle-img
              @else no-subtitle-img @endif"
        data-src="{{ $course->thumbnail ? fromDLHost($course->thumbnail) : fromDLHost($course->img) }}"
        alt="دوره آموزشی {{ $course->title }} - Image of Course {{ $course->titleEng }}">
      <span class="course-time-state">
        @if ($course->durationHours == 0)
          {{ $course->durationMinutes }} دقیقه
        @else
          {{ $course->durationHours + ($course->durationMinutes > 40 ? 1 : 0) }} ساعت
        @endif
      </span>
      @if ($course->updateDate)
        <span class="course-update-state">
          بروز شده
        </span>
      @endif
      @if ($course->dubbed_id == 1)
        <div class="subtitle-state dubbed-subtitle-img">
          دوبله شده
        </div>
      @elseif (get_course_status_state($course->persian_subtitle_id))
        <div class="subtitle-state persian-subtitle-img">
          با زیرنویس فارسی و انگلیسی
        </div>
      @elseif(get_course_status_state($course->english_subtitle_id))
        <div class="subtitle-state english-subtitle-img">
          با زیرنویس انگلیسی
        </div>
      @else
        <div class="subtitle-state no-subtitle-img">
          بدون زیرنویس
        </div>
      @endif
      <button href="" class="card-img-overlay course-preview-button" data-toggle="modal" data-target="#preview-modal" class="text-center"
        data-src="{{ fromDLHost($course->previewFile) }}" data-title="{{ $course->title }}" data-type="video/mp4"
        data-poster="{{ fromDLHost($course->img) }}" data-dubbed="{{ $course->dubbed_id }}"
        data-price="{{ $course->price }}" data-url="{{ courseURL($course) }}" data-size="720"
        data-track-src="{{ route('courses.subtitle_content', ['courseId' => $course->id]) }}"
        data-track-label="فارسی" data-track-srclang="fa"
      data-track-src-eng="{{ route('courses.subtitle_content', ['courseId' => $course->id]) }}&lang=en"
      data-track-label-eng="English" data-track-srclang-eng="en">
        پیش نمایش
      </button>
    </div>
    <div class="card-body">
      <a href="{{ courseURL($course) }}">
        <div class="card-title" style="font-size: 1.25rem;font-family: inherit;
        font-weight: 500;
        line-height: 1.2;
        color: inherit;margin-top: 0;">
          <p class="mt-2 text-right pr-2 mb-2"
            style="font-size: .9rem; font-weight: 600; /*max-height: 43px;*/ overflow-y: hidden;">
            {{ $course->title }}
          </p>
          <p class="text-left pl-2 mb-0"
            style="font-size: .9rem; font-weight: 600; /*max-height: 43px;*/ overflow-y: hidden;" dir="ltr">
            {{ $course->titleEng }}
          </p>
        </div>
      </a>
      <p class="card-text course-description-grid text-justify">
        {{ $course->description }}
      </p>
    </div>
  </div>
  <div class="card-footer border-0 text-center"
    style="font-size: 11px; padding: .25rem .75rem;background-color: rgba(0,0,0,0.1);">
    <div class="row align-items-center no-dark">
      <div class="col-lg-3 col-sm-6 mb-sm-1 my-1">
        تاریخ انتشار
        @php
          $d = date('Y/m/d', strtotime($course->releaseDate));
          $d = explode('/', $d);
          echo nPersian(gregorian_to_jalali(intval($d[0]), intval($d[1]), intval($d[2]), '/'));
        @endphp
        ({{ date('Y/m/d', strtotime($course->releaseDate)) }})
      </div>
      <div class="col-lg-3 col-sm-6 mb-sm-1 my-1">
        تاریخ بروزرسانی
        @php
          if ($course->updateDate) {
              $d = date('Y/m/d', strtotime($course->updateDate));
              $d = explode('/', $d);
              echo nPersian(gregorian_to_jalali(intval($d[0]), intval($d[1]), intval($d[2]), '/'));
          } else {
              echo '<span style="color: darkred"> ندارد</span>';
          }
        @endphp
        @if ($course->updateDate)
          ({{ date('Y/m/d', strtotime($course->updateDate)) }})
        @endif
      </div>
      @if (count($course->users) > 0)
        <div class="col-lg-3 col-sm-6 mb-sm-1 my-1">
          <a class="lazyload" href="{{ route('dubbed.index', [$course->users[0]->username]) }}">
            <img src="{{ fromDLHost($course->users[0]->avatar) }}" width="30" height="30"
              style="border-radius: 20%;">
            {{ $course->users[0]->name }}
          </a>
        </div>
      @elseif(count($course->authors) > 0)
        <div class="col-lg-3 col-sm-6 mb-sm-1 my-1">
          <a href="{{ route('authors.show', [$course->authors[0]->slug]) }}">
            <img class="lazyload" src="{{ fromDLHost($course->authors[0]->img) }}" width="30" height="30"
              style="border-radius: 20%;">
            {{ $course->authors[0]->name }}
          </a>
        </div>
      @endif
      <div class="col-lg-3 col-sm-6 mb-sm-1 my-1">
        @if ($course->exerciseFile)
          @if (json_decode($course->exerciseFile))
            @if (count(json_decode($course->exerciseFile)) > 0)
              فایل های تمرینی <span style="color: green">دارد</span>
            @endif
          @else
            فایل های تمرینی <span style="color: darkred">ندارد</span>
          @endif
        @else
          فایل های تمرینی <span style="color: darkred">ندارد</span>
        @endif
      </div>
    </div>
  </div>
</div>
