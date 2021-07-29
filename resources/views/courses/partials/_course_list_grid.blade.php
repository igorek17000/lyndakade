<div class="col-12 {{ isset($col) ? $col : 'col-lg-3' }} col-md-6 mb-4 mt-2 course">
  <div class="card h-100 border-light  bg-light shadow course-grid">
    <img src="#" alt="{{ $course->title }}"
      data-src="{{ $course->thumbnail ? fromDLHost($course->thumbnail) : fromDLHost($course->img) }}"
      class="card-img lazyload" />
    <div class="card-img-overlay">
      <div class="card-title">
        <a href={{ courseURL($course) }} class="text-light">پیش نمایش</a>
      </div>
    </div>
    <div class="card-body row mx-0 pt-3 pb-0" style="max-height: 160px; min-height: 160px;">
      <div class="col-12 px-0 text-right mb-2" style="color: green;position: relative;font-size: 15px;">
        <span style="opacity: 0;">1</span>
        @if ($course->isPaid())
          @if (!User::find(auth()->id())->isAdmin())
            <div style="
                color: white;
                font-weight: 600;
                top: 0;
                left: 0;
                position: absolute;
                background-color: rgb(0, 167, 0);
                padding: 0 9px;
                border-radius: 5px;
            ">
              خریداری شده
            </div>
          @endif
        @elseif ($course->price == 0)
          <div style="
                color: white;
                font-weight: 600;
                top: 0;
                left: 0;
                position: absolute;
                background-color: #cc2222;
                padding: 0 9px;
                border-radius: 5px;
            ">
            رایگان
          </div>
        @else
          <div style="
                color: white;
                font-weight: 600;
                top: 0;
                left: 0;
                position: absolute;
                background-color: rgb(0, 2, 128);
                padding: 0 9px;
                border-radius: 5px;
            ">
            {{ number_format($course->price) . ' تومان' }}
          </div>
        @endif
        @if ($course->updateDate)
          <div style="
                color: white;
                font-weight: 600;
                top: 0;
                position: absolute;
                background-color: orange;
                padding: 0 9px;
                border-radius: 5px;
            ">
            بروز شده
          </div>
        @endif
      </div>

      <div class="col-12 px-0">
        <a href="{{ courseURL($course) }}">
          <strong>
            {{ $course->title }}
          </strong>
          <span class="text-muted">
            {{ get_course_state($course) == '1' ? 'خریداری شده' : '' }}
          </span>
        </a>
      </div>
      @if ($course->dubbed_id == 1)
        <div class="course-grid persian-subtitle text-center"
          style="color: white; font-weight: 600; bottom: 76px; font-size: 13px; width: 130px; position: absolute; background-color: darkgreen; padding: 2px 15px; border-radius: 5px;left: 0; right: 0; margin: auto;">
          دوبله فارسی
        </div>
      @elseif ($course->persian_subtitle_id == 1)
        <div class="course-grid persian-subtitle  text-center"
          style="color: white; font-weight: 600; bottom: 76px; font-size: 13px; width: 130px; position: absolute; background-color: darkgoldenrod; padding: 2px 15px; border-radius: 5px;left: 0; right: 0; margin: auto;">
          با زیرنویس فارسی
        </div>
      @else
        <div class="course-grid persian-subtitle  text-center" style="color: white; font-weight: 600; bottom: 76px; font-size: 13px;
    width: 140px;
    position: absolute;
    background-color: limegreen; padding: 2px 15px; border-radius: 5px;left: 0; right: 0; margin: auto;">
          با زیرنویس انگلیسی
        </div>

      @endif
    </div>
    <div class="card-footer d-flex">
      <div class="row w-100 align-items-center">
        <div class="p-3 col-12">
          <span class="meta-right">
            {{-- <span>{{ $course->created_at->format('M d, Y') }}</span> --}}
            <i class="ti-calendar"></i>
            @php
              $release_title = 'تاریخ انتشار مرجع به تاریخ شمسی';
              $releaseDate = explode('-', $course->releaseDate);
              if ($course->updateDate) {
                  $releaseDate = explode('-', $course->updateDate);
                  $release_title = 'تاریخ بروز رسانی مرجع به تاریخ شمسی';
              }
              $releaseDate_year = intval($releaseDate[0]);
              $releaseDate_month = intval($releaseDate[1]);
              $releaseDate_day = intval($releaseDate[2]);
              $jalaliDate = \Hekmatinasser\Verta\Verta::getJalali($releaseDate_year, $releaseDate_month, $releaseDate_day);
              $jalaliDate[0] = zerofill($jalaliDate[0], 4);
              $jalaliDate[1] = zerofill($jalaliDate[1]);
              $jalaliDate[2] = zerofill($jalaliDate[2]);
              $jalaliDate = implode('/', $jalaliDate);
            @endphp
            <span title="{{ $release_title }}">
              {{ $jalaliDate }}
            </span>
            {{-- <span>{{ $course->created_at->diffForHumans() }}</span> --}}
          </span>
          <span class="meta-left">
            <span>{{ number_format($course->views) }}</span>
            <i class="ti-eye"></i>
          </span>
        </div>
        <div class="p-3 col-12">
          {{-- <a class="meta-right" href="#"> --}}
          <a class="meta-right"
            href="{{ count($course->authors) > 0 ? route('authors.show', [$course->authors[0]->slug, $course->authors[0]->id]) : '#' }}">
            <i class="ti-user"></i>
            <span style="max-height: 20px; overflow-y: hidden; ">
              @foreach ($course->authors as $author)
                {{ $author->name }} <br />
              @endforeach
              {{-- {{ $course->authors[0]->name }} --}}
            </span>
          </a>
          <a class="meta-left" href="{{ courseURL($course) }}">
            <span>جزئیات بیشتر</span>
            <i class="ti-link"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
