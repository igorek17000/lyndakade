<div class="col-12 col-lg-3 col-md-6 my-2 course">
  <div class="card h-100 border-0 course-grid">

    <div class="img-square-wrapper" style="height: 130px;">
      <img src="#"
        data-src="{{ $course->thumbnail ? fromDLHost($course->thumbnail) : fromDLHost($course->img) }}"
        class="d-inline-block course-img persian-subtitle-img lazyload"
        alt="دوره آموزشی {{ $course->title }} - Image of Course {{ $course->titleEng }}"
        style="max-height: 130px;min-height: 130px;">
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
      data-poster="{{ fromDLHost($course->img) }}"
      data-price="{{ $course->price }}" data-url="{{ courseURL($course) }}" data-size="720"
      data-track-src="{{ route('courses.subtitle_content', ['courseId' => $course->id]) }}"
      data-track-label="فارسی" data-track-srclang="fa">
        پیش نمایش
      </button>
    </div>
    <div class="card-body py-1" style="height: auto;">
      <a href="{{ courseURL($course) }}">
        <h5 class="card-title" style="height: auto;">
          <p class="mt-2 text-right pr-2 mb-0"
            style="font-size: .9rem; font-weight: 600; max-height: 50px; overflow-y: hidden;">
            {{ $course->title }}
          </p>
          {{-- <p class="text-left pl-2 mb-0"
            style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;" dir="ltr">
            {{ $course->titleEng }}
          </p> --}}
        </h5>
      </a>
    </div>
  </div>
</div>
