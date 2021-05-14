@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager',[
  'image' => 'https://lyndakade.ir/image/logo.png',
  'title' => ' لیندا کده | ' . date_get_seo_title($coursetype),
  'keywords' => get_seo_keywords() . ' , ' . date_get_seo_keywords($coursetype),
  'description' => date_get_seo_title($coursetype) . ' | ' . get_seo_description(),
  ])
@endpush
@section('content')

  @csrf
  <div class="row mx-0 justify-content-center">
    <aside class="col-md-10">
      <div class="section-module">
        <div class="row d-flex " id="course-list">
          @foreach ($courses as $course)
            @include('courses.partials._course_list_grid', ['course'=>$course])
          @endforeach
        </div>
        <div class="col-12 mb-4 mt-2">
          <button class="btn btn-light load-more w-100" coursetype="button" style="margin: auto;">
            <span class="text-t">نمایش دادن 40 دوره آموزشی بعدی</span>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="margin: auto;"></span>
          </button>
        </div>
      </div>
    </aside>
  </div>
@endsection
@push('js')
  <script>
    $(function() {
      $('.load-more').click(function(e) {
        var page = ($('#course-list .course').length / 40) + 1;
        var el = this;
        $(el).prop('disabled', true);
        $.ajax({
          url: '{{ route('courses.' . $coursetype) }}',
          method: 'get',
          data: {
            _token: $('[name="_token"]').val(),
            page: page,
          },
          success: function(result) {
            var course_list = document.getElementById('course-list');
            for (let res of result) {
              // console.log(res);
              course_list.insertAdjacentHTML('beforeend', res)
            }
            $(el).prop('disabled', false);
          },
          errors: function(xhr) {
            console.log(xhr);
            $(el).prop('disabled', false);
          }
        });
      })
    });

  </script>
@endpush
