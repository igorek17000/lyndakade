<div class="card course">
  <div class="card-horizontal py-2">
    <div class="img-square-wrapper">
      <img
        class="d-inline-block lazyload course-img
              @if (get_course_status_state($course->persian_subtitle_id)) persian-subtitle-img
              @elseif(get_course_status_state($course->english_subtitle_id)) english-subtitle-img @endif"
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
      @if (get_course_status_state($course->persian_subtitle_id))
        <div class="subtitle-state persian-subtitle-img">
          با زیرنویس فارسی
        </div>
      @elseif(get_course_status_state($course->english_subtitle_id))
        <div class="subtitle-state english-subtitle-img">
          با زیرنویس انگلیسی
        </div>
      @endif
      <a href="" class="card-img-overlay" data-toggle="modal" data-target="#preview-modal" class="text-center"
        data-src="{{ fromDLHost($course->previewFile) }}" data-title="{{ $course->title }}"
        data-price="{{ $course->price }}">
        پیش نمایش
      </a>
    </div>
    <div class="card-body">
      <h5 class="card-title">
        <p class="mt-2 text-right pr-2 mb-0"
          style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;">
          {{ $course->title }}
        </p>
        <p class="text-left pl-2 mb-0" style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;"
          dir="ltr">
          {{ $course->titleEng }}
        </p>
      </h5>
      <p class="card-text course-description text-justify">
        {{ $course->description }}
      </p>
    </div>
  </div>
  <div class="card-footer border-0">
    <small class="text-muted">Last updated 3 mins ago</small>
  </div>
</div>

