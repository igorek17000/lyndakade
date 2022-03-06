@foreach ($courses as $course)
  @include('courses.partials._course_list_new', [
      'course' => $course,
      'loop' => $loop,
  ])
@endforeach
