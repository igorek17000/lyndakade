@if (!auth()->check())
  <div class="col-12 text-center">
    <i class="lyndacon download align-self-center p-2" style="font-size: 24px;"></i>
    <br>
    برای تماشای آفلاین، این درس را خریداری و دانلود کنید.
    <br>
    <div class="col-12 px-0 mb-2" style="color: green; font-size: 2rem;">
      <p>
        {{ $course->price == 0 ? 'رایگان' : number_format($course->price) . ' تومان' }}
      </p>
    </div>
    <div>
      برای خرید این دوره آموزشی باید
      <a href="{{ route('login') }}" style="color: blue;">
        وارد حساب کاربری
      </a>
      خود شوید.
    </div>
  </div>
@else
  <div class="col-lg-2 text-center">
    <i class="lyndacon project-files" style="font-size: 120px; color: #ddd"></i>
  </div>
  <div class="col-lg-10">
    <div></div>
    <p></p>
    <ul class="exercise-files-popover">
      @if (Auth::user()->role->id == TCG\Voyager\Models\Role::firstWhere('name', 'admin')->id || $course_state == '1' || $course->price == 0)
        @if ($course->courseFile && count(json_decode($course->courseFile)) > 0)
          @foreach (json_decode($course->courseFile) as $file)
            <li role="presentation">
              {{-- <a role="link"
                href="{{ route('courses.download', [$course->id, hash('md5', 'courseFile') => hash('sha256', auth()->id())]) }}">
                <i class="lyndacon unlock" style="font-size: 20px; color: #ddd"></i>
                <span>
                  فایل دوره آموزشی
                </span>
              </a> --}}
              <a role="link"
                href="https://dl.lyndakade.ir/download.php?token={{ create_hashed_data_if_not_exists(auth()->id()) }}&file={{ create_hashed_data_if_not_exists($file->download_link) }}&course={{ create_hashed_data_if_not_exists($course->id) }}&token2={{ create_hashed_data_if_not_exists(request()->ip()) }}">
                <i class="lyndacon unlock" style="font-size: 20px; color: #ddd"></i>
                <span>
                  فایل دوره آموزشی
                </span>
              </a>
            </li>
          @endforeach
        @endif

        @if ($course->exerciseFile && count(json_decode($course->exerciseFile)) > 0)
          @php
            $idx = 0;
          @endphp
          @foreach (json_decode($course->exerciseFile) as $file)
            @php
              $idx = $idx + 1;
            @endphp
            <li role="presentation">
              {{-- <a role="link"
                href="{{ route('courses.download', [$course->id, hash('md5', 'exFiles') => hash('sha256', auth()->id()), 'filename' => $file->original_name]) }}">
                <i class="lyndacon unlock" style="font-size: 20px; color: #ddd"></i>
                <span>
                  فایل تمرینی {{ $idx }}
                </span>
              </a> --}}
              <a role="link"
                href="https://dl.lyndakade.ir/download.php?token={{ create_hashed_data_if_not_exists(auth()->id()) }}&file={{ create_hashed_data_if_not_exists($file->download_link) }}&course={{ create_hashed_data_if_not_exists($course->id) }}&token2={{ create_hashed_data_if_not_exists(request()->ip()) }}">
                <i class="lyndacon unlock" style="font-size: 20px; color: #ddd"></i>
                <span>
                  فایل تمرینی {{ $idx }}
                </span>
              </a>
            </li>
          @endforeach
        @endif

        @if ($course->persianSubtitleFile && count(json_decode($course->persianSubtitleFile)) > 0)
          @foreach (json_decode($course->persianSubtitleFile) as $file)

            <li role="presentation">
              {{-- <a role="link"
                href="{{ route('courses.download', [$course->id, hash('md5', 'persianSubtitleFile') => hash('sha256', auth()->id())]) }}">
                <i class="lyndacon unlock" style="font-size: 20px; color: #ddd"></i>
                <span>
                  فایل زیرنویس فارسی دوره
                </span>
              </a> --}}
              <a role="link"
                href="https://dl.lyndakade.ir/download.php?token={{ create_hashed_data_if_not_exists(auth()->id()) }}&file={{ create_hashed_data_if_not_exists($file->download_link) }}&course={{ create_hashed_data_if_not_exists($course->id) }}&token2={{ create_hashed_data_if_not_exists(request()->ip()) }}">
                <i class="lyndacon unlock" style="font-size: 20px; color: #ddd"></i>
                <span>
                  فایل زیرنویس فارسی دوره
                </span>
              </a>
            </li>
          @endforeach
        @endif

      @elseif ($course_state == '2')
        <div class="col-12 px-0 mb-2" style="color: green; font-size: 2rem;">
          <p>
            {{ $course->price == 0 ? 'رایگان' : number_format($course->price) . ' تومان' }}
          </p>
        </div>
        <div id="cart-btn">
          <a data-id="1-{{ $course->id }}" class="btn btn-danger align-self-center cart-remove-btn">
            حذف از سبد خرید
          </a>
        </div>
      @elseif($course_state == '3')
        <div class="col-12 px-0 mb-2" style="color: green; font-size: 2rem;">
          <p>
            {{ $course->price == 0 ? 'رایگان' : number_format($course->price) . ' تومان' }}
          </p>
        </div>
        <div id="cart-btn">
          <a data-id="1-{{ $course->id }}" class="btn btn-download align-self-center cart-add-btn">
            افزودن به سبد خرید
          </a>
        </div>
      @endif
    </ul>
  </div>
@endif
