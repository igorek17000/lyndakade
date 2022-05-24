@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager', [
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
            <h2 class="text-center mb-3" style="font-size: 1.5rem;font-weight: 600;">لیست دوبله‌های من</h2>
            <table class="table table-sm table-striped table-bordered  text-center">
              <thead class="thead-light">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">شماره هفته</th>
                  {{-- <th class="show-xs" scope="col">شماره هفته</th>
                  <th class="hidden-xs" scope="col">تاریخ شروع</th>
                  <th class="hidden-xs" scope="col">تاریخ پایان</th> --}}
                  <th scope="col">مجموع دقایق</th>
                  <th scope="col">کد دوره(های) آموزشی</th>
                  <th scope="col">میزان دستمزد</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($factors as $factor)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ nPersian($factor->week_number) }}</td>
                    {{-- <td class="show-xs">{{ nPersian($factor->week_number) }}</td>
                    <td class="hidden-xs">{{ nPersian($factor->start_date) }}</td>
                    <td class="hidden-xs">{{ nPersian($factor->end_date) }}</td> --}}
                    <td>{{ nPersian($factor->total_minutes, false) }} دقیقه</td>
                    <td>
                      @foreach (explode(',', $factor->courses_id) as $c_course_id)
                        <a style="color:darkblue;"
                          href="https://lyndakade.ir/c/{{ $c_course_id }}">{{ $c_course_id }}</a>
                        @if (!$loop->last)
                          <br />
                        @endif
                      @endforeach
                    </td>
                    <td>{{ nPersian($factor->price) }} تومان</td>
                  </tr>
                @endforeach
                <tr>
                  <th scope="row" colspan="2" class="text-center">جمع کل</th>
                  <td colspan="3" class="text-center">{{ nPersian($total_income) }} تومان</td>
                </tr>
                {{-- <tr class="show-xs">
                  <th scope="row" colspan="2" class="text-center">جمع کل</th>
                  <td colspan="3" class="text-center">{{ nPersian($total_income) }} تومان</td>
                </tr>
                <tr class="hidden-xs">
                  <th scope="row" colspan="2" class="text-center">جمع کل</th>
                  <td colspan="4" class="text-center">{{ nPersian($total_income) }} تومان</td>
                </tr> --}}
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h2 class="text-center mb-3" style="font-size: 1.5rem;font-weight: 600;">تسویه حساب‌های من</h2>
            <table class="table table-sm table-striped table-bordered text-center">
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
                    <td>{{ nPersian($invoice->created_at) }}</td>
                    <td>{{ nPersian($invoice->price) }} تومان</td>
                  </tr>
                @endforeach
                <tr>
                  <th scope="row" colspan="2" class="text-center">جمع کل</th>
                  <td class="text-center">{{ nPersian($total_received) }} تومان</td>
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
