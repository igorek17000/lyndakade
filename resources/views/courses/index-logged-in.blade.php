@extends('layouts.app')
@section('content')
  <div class="container" id="home-page">
    <div class="row my-3 justify-content-center">
      @csrf
      <!-- start of right sidebar -->
      <aside class="col-md-4">
        <!-- start of playlist -->
        <div class="card mb-3">
          <article class="card-group-item">
            <header class="card-header clearfix pb-0">
              <h5 class="title pull-right">لیست علاقه مندی ها</h5>
              <span class="title pull-left"><a href="{{ route('bookmark.index') }}">موارد بیشتر</a></span>
            </header>
            <div class="overflow-auto" style="height: 400px !important;">
              <div class="filter-content">
                <div class="card-body clearfix py-2">
                  @if (count($bookmarks) > 0)
                    @foreach ($bookmarks as $bookmark)
                      @include('.bookmark.partials._bookmarks_list', ['bookmark', $bookmark])
                      @if ($bookmarks->last()->id != $bookmark->id)
                        <hr class="my-1">
                      @endif
                    @endforeach
                  @else
                    <span>
                      لیست علاقمه مندی های شما خالی میباشد.
                    </span>
                  @endif
                </div>
              </div>
            </div>

          </article>
        </div>
        <!-- end of playlist -->
      </aside>
      <!-- end of right sidebar -->

      <!-- start of left sidebar -->
      <aside class="col-md-8">
        <!-- start of path -->
        <div class="learn-path card">
          <div class="learn-path-title">
            <a href="{{ route('learn.paths.index') }}" class="pull-left learn-path-see-all">موارد بیشتر</a>
            <h2>مسیرهای آموزشی</h2>
          </div>
          <div class="row">
            @foreach ($paths as $path)
              <div class="tile col-xs-6 col-sm-4 col-md-4">
                <a class="tile-text" href="{{ route('learn.paths.show', [$path->slug]) }}" style="
                                         background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('{{ asset($path->img) }}');
                                         ">
                  <span class="tile-name">{{ $path->title }}</span>
                  <br>
                  <span class="tile-heading">تعداد دروس {{ count($path->_courses) }}</span>
                  {{-- <span class="tile-heading">تعداد دروس {{ count($path->courses) }}</span> --}}
                </a>
              </div>
            @endforeach
          </div>
          <!-- start of Nav tabs -->
          <div class="tab-list">
            <ul class="nav nav-tabs " id="tab-list">
              <li class="nav-item">
                <a class="nav-link py-0 my-0 active" data-toggle="tab" data-id="1"
                  data-url="{{ route('load.more.all') }}">
                  همه
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link py-0 my-0" data-toggle="tab" data-id="2" data-url="{{ route('load.more.new') }}">
                  جدیدترین ها
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link py-0 my-0" data-toggle="tab" data-id="3" data-url="{{ route('load.more.popular') }}">
                  محبوب ترین ها
                </a>
              </li>
            </ul>
          </div>
          <!-- end of Nav tabs -->

          <!-- start of container for active tab -->
          <article class="card-group-item">
            <div class="filter-content">
              <div class="card-body clearfix p-0" id="list-items">
                @foreach ($courses as $course)
                  {{-- <hr> --}}
                  @include ('.courses.partials._course_list', ['course' => $course])
                @endforeach
                <div id="load-more" class="btn form-control text-center" data-id="1">
                  موارد بیشتر
                </div>
              </div>
            </div>
          </article>
        </div>
        <!-- end of container for active tab -->
      </aside>
      <!-- end of left sidebar -->
    </div>
  </div>
@endsection

@section('script_body')
  <script>
    $(function() {
      let headings = $('.tile-heading');
      for (let i = 0; i < headings.length; i++) {
        let heading = headings[i];
        // console.log(heading.parentNode);
        heading.parentNode.onmouseover = function() {
          heading.style.visibility = "visible";
          heading.style.display = "inline-block";
        };
        heading.parentNode.onmouseleave = function() {
          heading.style.display = "block";
          heading.style.visibility = "hidden";
        };
      }
    });

  </script>
@endsection
