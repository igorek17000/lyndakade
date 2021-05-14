@if (Auth::check())
  @if (Auth::user()->role->id ==
        TCG\Voyager\Models\Role::firstWhere('name', 'admin')->id ||
    $course_state == '1' ||
    $course->price == 0)
    @include('courses.partials._link_download_btn', ['course' => $course])
  @else
    <div class="col-12 px-0 mb-2" style="color: green; font-size: 2rem;">
      <p>
        {{ $course->price == 0 ? 'رایگان' : number_format($course->price) . ' تومان' }}
      </p>
    </div>
    @if ($course_state == '2')
      @include('courses.partials._link_cart_remove_btn', ['course' => $course])
    @elseif($course_state == '3')
      @include('courses.partials._link_cart_add_btn', ['course' => $course])
    @endif
  @endif
@else
  <div class="col-12 px-0 mb-2" style="color: green; font-size: 2rem;">
    <p>
      {{ $course->price == 0 ? 'رایگان' : number_format($course->price) . ' تومان' }}
    </p>
  </div>
  @include('courses.partials._link_signin_btn', ['course' => $course])
@endif
