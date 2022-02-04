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
    <div class="row justify-content-center">
      <div class="col-md-12">
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
                <td><a href="{{ $course->link }}">{{ $course->title }}</a></td>
                <td class="text-center">{{ $course->price }}</td>
                <td class="text-center">{{ $course->course_total_purchase }}</td>
                <td class="text-center">{{ $course->balance_purchase }}</td>
                <td class="text-center">{{ $course->course_total_unlocked }}</td>
                <td class="text-center">{{ $course->balance_unlocked }}</td>
              </tr>
              @php
                $last_iteration = $loop->iteration;
              @endphp
            @endforeach
            <tr>
              <th scope="row" colspan="2" class="text-center">جمع کل</th>
              <td colspan="2" class="text-center">{{ $total_balance }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-12">
        <table class="table table-striped">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">تاریخ تسویه</th>
              <th scope="col">مبلغ تسویه</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($invoices as $invoice)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $invoice->created_at }}</td>
                <td>{{ $invoice->price }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@section('script_body')
  <script>
    $(document).ready(function() {});
  </script>
@endsection
