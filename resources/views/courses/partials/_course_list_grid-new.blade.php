<div class="col-12 col-lg-3 col-md-6 my-2 course" itemscope="" itemtype="http://schema.org/Course">
  <div class="card h-100 border-light  bg-light shadow course-grid">
    <meta itemprop="name" content="{{ $course->title }}" lang="fa" />
    <meta itemprop="name" content="{{ $course->titleEng }}" lang="en" />
    <meta itemprop="url" content="{{ courseURL($course) }}" />
    <meta itemprop="video" content="{{ fromDLHost($course->previewFile) }}" />
    <meta itemprop="description" content="{{ $course->description }}" lang="fa" />
    <meta itemprop="description" content="{{ $course->descriptionEng }}" lang="en" />

    <div class="img-square-wrapper" style="height: 130px;">
      <img itemprop="image" src="#"
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
      <button href="" class="card-img-overlay" data-toggle="modal" data-target="#preview-modal" class="text-center"
        data-src="{{ fromDLHost($course->previewFile) }}" data-title="{{ $course->title }}"
        data-price="{{ $course->price }}" data-url="{{ courseURL($course) }}">
        پیش نمایش
      </button>
    </div>
    <div class="card-body" style="height: auto;">
      <a href="{{ courseURL($course) }}">
        <h5 class="card-title">
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
