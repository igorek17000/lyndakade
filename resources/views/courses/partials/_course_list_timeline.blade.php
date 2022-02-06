<li class="course">
  <a href="{{ courseURL($course) }}" class="timeline-panel">
    <div class="timeline-heading">
      <h2 class="timeline-title" style="font-size: 1.25rem;">
        <p class="m-0">
          {{ $course->title }}
          <small class="text-muted">
            توسط
            <span class="text-left" dir="ltr">
              @foreach ($course->authors as $author)
                {{-- <i class="glyphicon glyphicon-time"></i> --}}
                {{ $author->name }}
                @if (!$loop->last)
                  ,
                @endif
              @endforeach
            </span>
          </small>
        </p>
        <p dir="ltr" class="text-left m-0">
          {{ $course->titleEng }}
          <small class="text-muted">
            by
            <span>
              @foreach ($course->authors as $author)
                {{-- <i class="glyphicon glyphicon-time"></i> --}}
                {{ $author->name }}
                @if (!$loop->last)
                  ,
                @endif
              @endforeach
            </span>
          </small>
        </p>
      </h2>
    </div>
    <div class="timeline-body text-justify row">
      <div class="col-md-3 col-sm-12 text-center" itemscope itemtype="http://schema.org/Course">
        <meta itemprop="name" content="{{ $course->title }}" lang="fa" />
        <meta itemprop="name" content="{{ $course->titleEng }}" lang="en" />
        <meta itemprop="url" content="{{ courseURL($course) }}" />
        <meta itemprop="video" content="{{ fromDLHost($course->previewFile) }}" />
        <meta itemprop="description" content="{{ $course->description }}" lang="fa" />
        <meta itemprop="description" content="{{ $course->descriptionEng }}" lang="en" />

        <img itemprop="image" src="#" class="lazyload"
          data-src="{{ $course->thumbnail ? fromDLHost($course->thumbnail) : fromDLHost($course->img) }}"
          style="max-height: 150px;border-radius: 5px;"
          alt="دوره آموزشی {{ $course->title }} - Image of Course {{ $course->titleEng }}" />
        @if (count($course->users) > 0)
          <span
            style="position: absolute;left: 15px;text-align: left;top: 0;background-color: #222;color: #fffb00;padding: 1px 5px;border-top-left-radius: 5px;border-bottom-right-radius: 5px;font-size: 15px;">
            دوبله شده
          </span>
        @endif
      </div>
      <div class="col-md-9  col-sm-12">
        <p class="mt-md-3" style="word-break: break-word;
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                    display: -webkit-box;
                                    line-height: 2; /* fallback */
                                    /* fallback */
                                    -webkit-line-clamp: 3; /* number of lines to show */
                                    -webkit-box-orient: vertical;">
          {!! $course->description !!}
        </p>
        <div class="row">
          <div class="col-md-3 col-6 pb-1">
            <b>مدت زمان:</b>
            {{ $course->durationHours ? $course->durationHours . 'h ' : '' }}
            {{ $course->durationMinutes ? $course->durationMinutes . 'm' : '' }}
          </div>
          <div class="col-md-3 col-6">
            <b>سطح:</b>
            {{ \App\SkillLevel::find($course->skillLevel)->title }}
          </div>
          <div class="col-md-3 col-6">
            <b>تاریخ انتشار:</b>
            <span id="release-date" title="در لینکدین {{ date('Y/m/d', strtotime($course->releaseDate)) }}">
              {{ date('Y/m/d', strtotime($course->releaseDate)) }}
            </span>
          </div>
          <div class="col-md-3 col-6">
            <b>زیرنویس:</b>
            @if (get_course_status_state($course->dubbed_id))
              <span>دوبله شده</span>
            @elseif (get_course_status_state($course->persian_subtitle_id) && get_course_status_state($course->english_subtitle_id))
              <span>انگلیسی و فارسی</span>
            @elseif (get_course_status_state($course->persian_subtitle_id))
              <span>فارسی</span>
            @elseif (get_course_status_state($course->english_subtitle_id))
              <span>انگلیسی</span>
            @else
              <span style="color: red">
                ندارد
              </span>
            @endif
          </div>
        </div>
      </div>
    </div>
  </a>
</li>
