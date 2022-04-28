
function gregorian_to_jalali(gy, gm, gd) {
    g_d_m = [0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334];
    if (gy > 1600) {
        jy = 979;
        gy -= 1600;
    }
    else {
        jy = 0;
        gy -= 621;
    }
    gy2 = (gm > 2) ? (gy + 1) : gy;
    days = (365 * gy) + (parseInt((gy2 + 3) / 4)) - (parseInt((gy2 + 99) / 100)) + (parseInt((gy2 + 399) / 400)) - 80 + gd + g_d_m[gm - 1];
    jy += 33 * (parseInt(days / 12053));
    days %= 12053;
    jy += 4 * (parseInt(days / 1461));
    days %= 1461;
    if (days > 365) {
        jy += parseInt((days - 1) / 365);
        days = (days - 1) % 365;
    }
    jm = (days < 186) ? 1 + parseInt(days / 31) : 7 + parseInt((days - 186) / 30);
    jd = 1 + ((days < 186) ? (days % 31) : ((days - 186) % 30));

    var resultY = jy.toString();
    var resultM = jm < 10 ? "0" + jm.toString() : jm.toString();
    var resultD = jd < 10 ? "0" + jd.toString() : jd.toString();
    return [resultY, resultM, resultD];
}

function courseURL($course) {
    if ($course.slug_linkedin) {
        return 'https:/lyndakade.ir/learning/' + $course.slug_linkedin;
    }
    return '#';
}

function fromDLHost($path) {
    if ($path == '')
        return '#';
    try {
        $json = JSON.parse($path);
        $path = $json[0].download_link.replace("\\", "/");
    } catch ($error) {
        $path = $path.replace("\\", "/");
        if ($path.indexOf('http') > -1) {
            return $path.replace('http:', 'https:');
        }
    }
    return "https://dl.lyndakade.ir/".$path;
}

function course_list_new($course) {
    let duration = ($course.durationHours == 0)
        ? (
            $course.durationMinutes + ' دقیقه'
        ) : (
            $course.durationHours + ($course.durationMinutes > 40 ? 1 : 0) + ' ساعت'
        );
    let updated = ($course.updateDate) ? `<span class="course-update-state">
    بروز شده
  </span>` : '';

    let $classes = '',
        $sub_text = '';
    if ($course.dubbed_id == 1) {
        $classes = 'dubbed-subtitle-img';
        $sub_text = `<div class="subtitle-state dubbed-subtitle-img">
        دوبله شده
      </div>`;
    } else if ($course.persian_subtitle_id == 1) {
        $classes = 'persian-subtitle-img';
        $sub_text = `<div class="subtitle-state persian-subtitle-img">
        با زیرنویس فارسی و انگلیسی
      </div>`;
    } else if ($course.english_subtitle_id == 1) {
        $classes = 'english-subtitle-img';
        $sub_text = `<div class="subtitle-state english-subtitle-img">
        با زیرنویس انگلیسی
      </div>`;
    } else {
        $classes = 'no-subtitle-img';
        $sub_text = `<div class="subtitle-state no-subtitle-img">
        بدون زیرنویس
      </div>`;
    }

    return `
<div
    class="card course">
    <div class="card-horizontal py-2">
      <div class="img-square-wrapper">
        <img
          class="d-inline-block lazyload course-img ${$classes}"
          data-src="${$course.thumbnail ? fromDLHost($course.thumbnail) : fromDLHost($course.img)}"
          alt="دوره آموزشی ${$course.title} - Image of Course ${$course.titleEng}">
        <span class="course-time-state">
          ${duration}
        </span>
        ${updated}
        ${$sub_text}
        <button href="" class="card-img-overlay" data-toggle="modal" data-target="#preview-modal" class="text-center"
          data-src="${fromDLHost($course.previewFile)}" data-title="${$course.title}"
          data-price="${$course.price}" data-url="${courseURL($course)}">
          پیش نمایش
        </button>
      </div>
      <div class="card-body">
        <a href="${courseURL($course)}">
          <h5 class="card-title">
            <p class="mt-2 text-right pr-2 mb-2"
              style="font-size: .9rem; font-weight: 600; /*max-height: 43px;*/ overflow-y: hidden;">
              ${$course.title}
            </p>
            <p class="text-left pl-2 mb-0"
              style="font-size: .9rem; font-weight: 600; /*max-height: 43px;*/ overflow-y: hidden;" dir="ltr">
              ${$course.titleEng}
            </p>
          </h5>
        </a>
        <p class="card-text course-description-grid text-justify">
          ${$course.description}
        </p>
      </div>
    </div>
    <div class="card-footer border-0 text-center" style="font-size: 11px; padding: .25rem .75rem;background-color: rgba(0,0,0,0.1);">
      <div class="row align-items-center no-dark">
        <div class="col-lg-3 col-sm-6 mb-sm-1 my-1">
          تاریخ انتشار
          @php
            $d = date('Y/m/d', strtotime($course.releaseDate));
            $d = explode('/', $d);
            echo nPersian(gregorian_to_jalali(intval($d[0]), intval($d[1]), intval($d[2]), '/'));
          @endphp
          ({{ date('Y/m/d', strtotime($course.releaseDate)) }})
        </div>
        <div class="col-lg-3 col-sm-6 mb-sm-1 my-1">
          تاریخ بروزرسانی
          @php
            if ($course.updateDate) {
                $d = date('Y/m/d', strtotime($course.updateDate));
                $d = explode('/', $d);
                echo nPersian(gregorian_to_jalali(intval($d[0]), intval($d[1]), intval($d[2]), '/'));
            } else {
                echo '<span style="color: darkred"> ندارد</span>';
            }
          @endphp
          @if ($course.updateDate)
            ({{ date('Y/m/d', strtotime($course.updateDate)) }})
          @endif
        </div>
        @if (count($course.users) > 0)
          <div class="col-lg-3 col-sm-6 mb-sm-1 my-1">
            <a class="lazyload" href="{{ route('dubbed.index', [$course.users[0].username]) }}">
              <img src="{{ fromDLHost($course.users[0].avatar) }}" width="30" height="30"
                style="border-radius: 20%;">
              {{ $course.users[0].name }}
            </a>
          </div>
        @elseif(count($course.authors) > 0)
          <div class="col-lg-3 col-sm-6 mb-sm-1 my-1">
            <a href="{{ route('authors.show', [$course.authors[0].slug]) }}">
              <img class="lazyload" src="{{ fromDLHost($course.authors[0].img) }}" width="30" height="30"
                style="border-radius: 20%;">
              {{ $course.authors[0].name }}
            </a>
          </div>
        @endif
        <div class="col-lg-3 col-sm-6 mb-sm-1 my-1">
          @if ($course.exerciseFile)
            @if (json_decode($course.exerciseFile))
              @if (count(json_decode($course.exerciseFile)) > 0)
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
    `;
}
