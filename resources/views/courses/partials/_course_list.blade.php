{{-- <div class="card flex-row flex-wrap">
  <div class="card-header border-0">
    <img src="//placehold.it/200" alt="">
  </div>
  <div class="card-block px-2">
    <h4 class="card-title">{{ $course->title }}</h4>
    <p class="card-text">Description</p>
    <a href="#" class="btn btn-primary">BUTTON</a>
  </div>
  <div class="w-100"></div>
  <div class="card-footer w-100 text-muted">
    Footer stating cats are CUTE little animals
  </div>
</div> --}}

<div class="row no-gutters list-item-row">
  <div class="col-md-3 align-self-center list-item-img">
    <div class="list-item-img-text align-self-center">
      <button data-title="{{ $course->title }}" data-video-url="http://dl.lyndakade.ir/{{ $course->previewFile }}"
        @if ($course->previewSubtitle) data-subtitle-url="http://dl.lyndakade.ir/{{ $course->previewSubtitle }}" @endif data-poster-url="http://dl.lyndakade.ir/{{ $course->img }}" class="btn btn-dark ga btn-preview">
        پیش نمایش
      </button>
    </div>
    <img src="#" data-src="{{ fromDLHost($course->img) }}" style="height: 100px;" class="card-img lazyload"
       alt="دوره آموزشی {{ $course->title }} - Image of Course {{ $course->titleEng }}" >
  </div>
  <div class="col-md-8">
    <div class="card-body py-0">
      <a href="{{ courseURL($course) }}">
        <h5 class="card-title list-item-title" title-eng="{{ $course->titleEng }}"> {{ $course->title }} <cite
            class="meta-author">توسط {{ $course->authors[0]->name }}</cite>
        </h5>
        <div class="list-item-description text-justify">{{ $course->description }}</div>
        <p class="card-text">
        </p>
        <table class="table table-sm table-borderless badge">
          <tbody>
            <tr class="row">
              <td class="col-auto">
                <span class="ml-2">
                  <i class="skill-level" style="background-image: url('{{ asset('/image/time.png') }}');"></i>

                  @if ($course->durationHours != '0')
                    {{ $course->durationHours }} ساعت و {{ $course->durationMinutes }}
                    دقیقه
                  @else
                    {{ $course->durationMinutes }} دقیقه
                  @endif
                </span>
              </td>
              <td class="col-auto">
                <span class="ml-2">
                  @if ($course->skillLevel == 1)
                    <i class="skill-level"
                      style="background-image: url('{{ asset('/image/skill-level/1.svg') }}');"></i>
                    مبتدی
                  @elseif ($course->skillLevel == 2)
                    <i class="skill-level"
                      style="background-image: url('{{ asset('/image/skill-level/2.svg') }}');"></i>
                    متوسط
                  @else
                    <i class="skill-level"
                      style="background-image: url('{{ asset('/image/skill-level/3.svg') }}');"></i>
                    پیشرفته
                  @endif
                </span>
              </td>

              <td class="col-auto">
                <span class="ml-2">
                  <i class="skill-level" style="
                                   background-image: url('{{ asset('/image/view.png') }}');
                                   "></i>
                  بازدید: {{ number_format($course->views) }}
                </span>
              </td>
              <td class="col-auto">
                <span class="ml-2"
                  title="{{ 'تاریخ انتشار در لینکدین ' . str_replace('-', '/', $course->releaseDate) }}">
                  <i class="skill-level" style="background-image: url('{{ asset('/image/date-icon.png') }}');"></i>
                  تاریخ انتشار:
                  @if (\Carbon\Carbon::parse($course->created_at) > (new \Illuminate\Support\Carbon())->subDays(2))
                    {{ \Carbon\Carbon::parse($course->created_at)->diffForHumans() }}
                  @else
                    {{ (new \Hekmatinasser\Verta\Verta($course->created_at))->format('Y/m/d H:i') }}
                  @endif
                </span>
              </td>
            </tr>
          </tbody>
        </table>
      </a>
    </div>
  </div>
</div>
