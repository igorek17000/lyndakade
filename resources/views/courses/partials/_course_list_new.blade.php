<div
  class="card course @if (isset($loop)) @if ($loop->iteration > 10) hidden-md hidden-sm hidden-xs @endif @endif">
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
      <button href="" class="card-img-overlay" data-toggle="modal" data-target="#preview-modal" class="text-center"
        data-src="{{ fromDLHost($course->previewFile) }}" data-title="{{ $course->title }}"
        data-price="{{ $course->price }}" data-url="{{ courseURL($course) }}">
        پیش نمایش
      </button>
    </div>
    <div class="card-body">
      <a href="{{ courseURL($course) }}">
        <h5 class="card-title">
          <p class="mt-2 text-right pr-2 mb-0"
            style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;">
            {{ $course->title }}
          </p>
          <p class="text-left pl-2 mb-0"
            style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;" dir="ltr">
            {{ $course->titleEng }}
          </p>
        </h5>
      </a>
      <p class="card-text course-description text-justify">
        {{ $course->description }}
      </p>
    </div>
  </div>
  <div class="card-footer border-0">
    <div class="row">
      <div class="col-lg-2 col-sm-6 mb-sm-1">
        تاریخ انتشار
        {{ $course->releaseDate }}
      </div>
      <div class="col-lg-2 col-sm-6 mb-sm-1">
        تاریخ بروزرسانی
        {{ $course->updateDate ? $course->updateDate : 'ندارد' }}
      </div>
      <div class="col-lg-2 col-sm-6 mb-sm-1">
        مدرس
        {{ $course->authors[0]->name }}
      </div>
      <div class="col-lg-2 col-sm-6 mb-sm-1">
        فایل های همراه
      </div>
      <div class="col-lg-2 col-sm-6 mb-sm-1">
        قیمت
        {{ $course->price }}
      </div>
      <div class="col-lg-2 col-sm-6 mb-sm-1">
        بازدید
        {{ $course->views }}
      </div>
    </div>
  </div>
</div>
