@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager',[
  'image' => 'https://lyndakade.ir/image/logo.png',
  'title' => 'پنل دوبله من - لیندا کده',
  'keywords' => get_seo_keywords() . ' , پنل دوبله من , my dubbed pandel, dubbed panel',
  'description' => 'پنل دوبله من | ' . get_seo_description(),
  ])
@endpush
@push('css_head')
@endpush
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <table class="table table-striped">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">نام دوره آموزشی</th>
              <th scope="col">مبلغ دوره</th>
              <th scope="col">تعداد خرید دوره</th>
              <th scope="col">جمع کل خرید دوره</th>
              <th scope="col">تعداد خرید دوره از طریق اشتراک</th>
              <th scope="col">جمع کل خرید دوره از طریق اشتراک</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($courses as $course)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $course->title }}</td>
                <td>{{ $course->price }}</td>
                <td>{{ $course->course_total_purchase }}</td>
                <td>{{ $course->balance_purchase }}</td>
                <td>{{ $course->course_total_unlocked }}</td>
                <td>{{ $course->balance_unlocked }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      {{-- <div class="col-md-6">
          {{ auth()->user()->courses }}
      </div>
      <div class="col-md-2">
          {{ auth()->user()->invoices }}
      </div> --}}
    </div>
    <div class="row">
      <div class="col-md-4">
      </div>
      <div class="col-md-8">
      </div>
    </div>
  </div>
@endsection

@section('script_body')
  <script>
    $(document).ready(function() {});
  </script>
@endsection
