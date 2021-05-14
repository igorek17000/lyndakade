@extends('layouts.app')
@section('content')
  @csrf
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-1"></div>
      <div class="col-md-8 col-sm-12">
        <article class="card-group-item">
          <div class="filter-content">
            <div class="card-body clearfix p-0" id="list-items">
              @foreach ($courses as $course)
                {{-- <hr> --}}
                @include ('.courses.partials._course_list', ['course' => $course])
              @endforeach
            </div>
          </div>
        </article>
      </div>
    </div>
  </div>
@endsection
