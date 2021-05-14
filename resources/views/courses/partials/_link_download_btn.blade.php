{{-- <a href="{{ route('course.download', [$course->id]) }}"
    class="btn btn-download align-self-center">
    دانلود فایل
</a> --}}
@if ($course->courseFile && count(json_decode($course->courseFile)) > 0)
  @foreach (json_decode($course->courseFile) as $file)
    <a href="{{ route('courses.download', [$course->id, hash('md5', 'courseFile') => hash('sha256', auth()->id())]) }}"
      class="btn btn-download align-self-center">
      {{-- <span>{{ Storage::disk('FTP')->size($file->download_link) }}</span> --}}
      {{-- <a href="{{ fromDLHost($file->download_link) }}" class="btn btn-download align-self-center"> --}}
      فایل دوره آموزشی
    </a>
  @endforeach
  {{-- <a href="{{ fromDLHost($course->courseFile) }}" class="btn btn-download align-self-center">
    دانلود فایل کل دوره
  </a> --}}
@endif
{{-- @if ($course->previewFile && count(json_decode($course->previewFile)) > 0)
  <a href="{{ fromDLHost($course->previewFile) }}" class="btn btn-download align-self-center">
    دانلود فایل پیش نمایش
  </a>
@endif
@if ($course->previewSubtitle && count(json_decode($course->previewSubtitle)) > 0)
  <a href="{{ fromDLHost($course->previewSubtitle) }}" class="btn btn-download align-self-center">
    دانلود فایل زیرنویس پیش نمایش
  </a>
@endif --}}
@if ($course->exerciseFile && count(json_decode($course->exerciseFile)) > 0)
  @php
    $idx = 0;
  @endphp
  @foreach (json_decode($course->exerciseFile) as $file)
    @php
      $idx = $idx + 1;
    @endphp
    <a href="{{ route('courses.download', [$course->id, hash('md5', 'exFiles') => hash('sha256', auth()->id()), 'filename' => $file->original_name]) }}"
      class="btn btn-download align-self-center">
      {{-- <a href="{{ fromDLHost($file->download_link) }}" class="btn btn-download align-self-center"> --}}
      {{-- <span>{{ Storage::disk('FTP')->size($file->download_link) }}</span> --}}
      فایل تمرینی {{ $idx }}
    </a>
  @endforeach
  {{-- <a href="{{ fromDLHost($course->exerciseFile) }}" class="btn btn-download align-self-center">
    دانلود فایل های تمرینی
  </a> --}}
  {{-- @else
  <span class="btn align-self-center">No File Found</span> --}}
@endif

@if ($course->persianSubtitleFile && count(json_decode($course->persianSubtitleFile)) > 0)
  @foreach (json_decode($course->persianSubtitleFile) as $file)
    <a href="{{ fromDLHost($file->download_link) }}" class="btn btn-download align-self-center">
      {{-- <a href="{{ route('courses.download', [$course->id, hash('md5', 'exFiles') => hash('sha256', auth()->id()), 'filename' => $file->original_name]) }}" --}}
      فایل زیرنویس فارسی دوره
    </a>
  @endforeach
  {{-- <a href="{{ fromDLHost($course->exerciseFile) }}" class="btn btn-download align-self-center">
    دانلود فایل های تمرینی
  </a> --}}
  {{-- @else
  <span class="btn align-self-center">No File Found</span> --}}
@endif
