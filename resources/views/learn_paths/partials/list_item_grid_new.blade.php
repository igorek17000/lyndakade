<div
  class="path col-xl-3 col-lg-4 col-md-6 col-sm-6 my-1 @if (isset($loop)) @if ($loop->iteration > 6) hidden-md hidden-sm hidden-xs @endif @endif">
  <div class="mx-auto" style="position: relative;width: 255px;">
    <img class="lazyload d-inline-block" data-src="{{ fromDLHost($path->thumbnail) }}"
      alt="مسیر آموزشی {{ $path->title }} - Image of Learn Path {{ $path->titleEng }}"
      style="border-radius: 5px; max-height: 143.44px; min-height: 143.44px;">
    <span
      style="width: 70px;text-align: center;position: absolute;right: 0;bottom: 0;border-radius: 3px 0 5px 0;padding: 2px 4px 0 4px;background-color: rgba(0,0,0,.8);color: #fff;">
      {{ $path->durationHours() + ($path->durationMinutes() > 20 ? 1 : 0) }} ساعت
    </span>
    @php
      try {
          $previewFile = fromDLHost($path->_courses[0]->previewFile);
          $courseId = $path->_courses[0]->id;
      } catch (\Throwable $th) {
          $previewFile = '#';
          $courseId = -1;
      }
    @endphp
    <button href="" class="card-img-overlay" data-toggle="modal" data-target="#preview-modal" class="text-center"
      data-src="{{ $previewFile }}" data-title="مسیر آموزشی {{ $path->title }}" data-price="{{ $path->price() }}"
      data-url="{{ route('learn.paths.show', [$path->slug]) }}" data-type="video/mp4"
      data-poster="{{ fromDLHost($path->img) }}" data-size="720"
      data-track-src="{{ route('courses.subtitle_content', ['courseId' => $courseId]) }}" data-track-label="فارسی"
      data-track-srclang="fa">
      پیش نمایش
    </button>
  </div>
  <a href="{{ route('learn.paths.show', [$path->slug]) }}" class="text-center">
    <p class="mt-2 text-center pr-2 mb-0"
      style="font-size: .9rem; font-weight: 600; max-height: 86px; overflow-y: hidden;">
      {{ $path->title }}
    </p>
    {{-- <p class="text-center pl-2 mb-0"
        style="font-size: .9rem; font-weight: 600; max-height: 43px; overflow-y: hidden;" dir="ltr">
        {{ $path->titleEng }}
    </p> --}}
  </a>
</div>
