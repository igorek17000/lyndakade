@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager',[
  'image' => 'https://lyndakade.ir/image/logo.png',
  'title' => 'پنل دوبله من - لیندا کده',
  'keywords' => get_seo_keywords() . ' , پنل دوبله من , my dubbed panel, dubbed panel',
  'description' => 'پنل دوبله من | ' . get_seo_description(),
  ])
@endpush
@push('css_head')
  <style>
    .show-xs {
      display: none !important;
    }

    @media (max-width: 767px) {
      .show-xs {
        display: table-cell !important;
      }
    }

  </style>
@endpush
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <table class="table table-striped">
              <thead class="thead-light">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">نام دوره آموزشی</th>
                  <th scope="col">مبلغ دوره</th>
                  <th scope="col" class="hidden-xs">تعداد خرید دوره</th>
                  <th scope="col" class="hidden-xs">جمع کل خرید دوره</th>
                  <th scope="col" class="hidden-xs">تعداد خرید دوره از طریق اشتراک</th>
                  <th scope="col" class="hidden-xs">جمع کل خرید دوره از طریق اشتراک</th>

                  <th scope="col" class="show-xs" >جمع کل خرید دوره</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($courses as $course)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td><a href="{{ $course->link }}">{{ $course->title }}</a></td>
                    <td class="text-center">{{ $course->price }} تومان</td>
                    <td class="text-center hidden-xs">{{ $course->course_total_purchase }}</td>
                    <td class="text-center hidden-xs">{{ $course->balance_purchase }} تومان</td>
                    <td class="text-center hidden-xs">{{ $course->course_total_unlocked }}</td>
                    <td class="text-center hidden-xs">{{ $course->balance_unlocked }} تومان</td>

                    <td class="text-center show-xs">{{ $course->balance_unlocked + $course->balance_purchase }} تومان</td>

                  </tr>
                @endforeach
                <tr>
                  <th scope="row" colspan="2" class="text-center">جمع کل تسویه شده</th>
                  <td colspan="5" class="text-center">{{ $total_received }} تومان</td>
                </tr>
                <tr>
                  <th scope="row" colspan="2" class="text-center">جمع مبلغ قابل برداشت</th>
                  <td colspan="5" class="text-center">{{ $total_balance }} تومان</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <table class="table table-striped text-center">
              <thead class="thead-light">
                <tr>
                  <th scope="col" style="width: 40px;">#</th>
                  <th scope="col">تاریخ تسویه</th>
                  <th scope="col">مبلغ تسویه</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($invoices as $invoice)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $invoice->created_at }}</td>
                    <td>{{ $invoice->price }} تومان</td>
                  </tr>
                @endforeach
                <tr>
                  <th scope="row" colspan="2" class="text-center">جمع کل</th>
                  <td class="text-center">{{ $total_received }} تومان</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script_body')
  <script>
    $(document).ready(function() {});
  </script>
@endsection
