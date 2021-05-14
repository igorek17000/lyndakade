@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="row">
      @foreach ($courses as $course)
        @include ('.courses.partials._course_list_grid', ['course' => $course])
      @endforeach
    </div>
  </div>

@endsection
