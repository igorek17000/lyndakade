@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager',[
  'image' => 'https://lyndakade.ir/image/logo.png',
  'title' => 'لیندا کده | دروس خریداری شده من',
  'keywords' => get_seo_keywords() . ' , دروس خریداری شده من , my paid courses, my paid courses',
  'description' => 'صفحه دروس خریداری شده من | ' . get_seo_description(),
  ])
@endpush
@section('content')
  @csrf
  <div class="container">
    <div class="row justify-content-center my-3">
      <div class="col-md-8 col-sm-12">
        <article class="card">
          <div class="filter-content">
            <div class="card-body clearfix">
              <h2 class="text-center">لیست دوره های خریداری شده</h2>
              <table class="table table-bordered  text-center">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">عنوان دوره</th>
                    <th scope="col">میزان پرداختی</th>
                    <th scope="col">تاریخ خرید</th>
                    <th scope="col">لینک دوره</th>
                  </tr>
                </thead>
                <tbody>
                  @if (count($courses) > 0)
                    @php
                      $i = 1;
                    @endphp
                    @foreach ($courses as $course)
                      <tr>
                        <th scope="row">@php echo $i;@endphp</th>
                        <td>
                            <h4>{{ $course->title }}</h4>
                            <h4>{{ $course->titleEng }}</h4></td>
                        <td>
                          @php
                            $paid = \App\Paid::all()
                                ->where('user_id', auth()->id())
                                ->where('type', '1')
                                ->where('item_id', $course->id)
                                ->first();
                            echo nPersian($paid->price);
                          @endphp
                          تومان
                        </td>
                        <td>
                          @php
                            $paid = \App\Paid::all()
                                ->where('user_id', auth()->id())
                                ->where('type', '1')
                                ->where('item_id', $course->id)
                                ->first();
                            $d = date('Y/m/d', strtotime($paid->created_at));
                            $d = explode('/', $d);
                            echo nPersian(gregorian_to_jalali(intval($d[0]), intval($d[1]), intval($d[2]), '/'));
                          @endphp
                        </td>
                        <td><a href="{{ courseURL($course) }}">لینک</a></td>
                      </tr>
                      @php
                        $i += 1;
                      @endphp
                    @endforeach
                  @else
                    <tr>
                      <th colspan="12">هیچ دوره ای خریداری نشده است</th>
                    </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </article>
        <article class="card mt-3">
          <div class="filter-content">
            <div class="card-body clearfix">
              <h2 class="text-center">لیست مسیرهای آموزشی خریداری شده</h2>
              <table class="table table-bordered  text-center">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">عنوان مسیر آموزشی</th>
                    <th scope="col">میزان پرداختی</th>
                    <th scope="col">تاریخ خرید</th>
                    <th scope="col">لینک مسیر آموزشی</th>
                  </tr>
                </thead>
                <tbody>
                  @if (count($learn_paths) > 0)
                    @php
                      $i = 1;
                    @endphp
                    @foreach ($learn_paths as $path)
                      <tr>
                        <th scope="row">@php echo $i;@endphp</th>
                        <td>
                            <h4>{{ $path->title }}</h4>
                            <h4>{{ $path->titleEng }}</h4>
                        </td>
                        <td>
                          @php
                            $paid = \App\Paid::all()
                                ->where('user_id', auth()->id())
                                ->where('type', '2')
                                ->where('item_id', $path->id)
                                ->first();
                            echo nPersian(number_format($paid->price));
                          @endphp
                          تومان
                        </td>
                        <td>
                          @php
                            $paid = \App\Paid::all()
                                ->where('user_id', auth()->id())
                                ->where('type', '2')
                                ->where('item_id', $path->id)
                                ->first();
                            echo nPersian(date('Y/m/d', strtotime($paid->created_at)));
                          @endphp
                        </td>
                        <td><a href="{{ route('learn.paths.show', [$path->slug]) }}">لینک</a>
                        </td>
                      </tr>
                      @php
                        $i += 1;
                      @endphp
                    @endforeach
                  @else
                    <tr>
                      <th colspan="12">هیچ مسیر آموزشی ای خریداری نشده است</th>
                    </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </article>
        <article class="card mt-3">
          <div class="filter-content">
            <div class="card-body clearfix">
              <h2 class="text-center">تخفیفات براساس میزان خرید</h2>
              <table class="table table-bordered  text-center">
                <thead>
                  <tr>
                    <th scope="col">سطح</th>
                    <th scope="col">مجموع خرید</th>
                    <th scope="col">درصد تخفیف (برای تمامی خریدها)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>بین {{ nPersian(number_format(200000)) }} تا {{ nPersian(number_format(400000 - 1000)) }}
                      تومان
                    </td>
                    <td>{{ nPersian(number_format(5)) }}%</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>بین {{ nPersian(number_format(400000)) }} تا {{ nPersian(number_format(600000 - 1000)) }}
                      تومان
                    </td>
                    <td>{{ nPersian(number_format(10)) }}%</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>بین {{ nPersian(number_format(600000)) }} تا {{ nPersian(number_format(800000 - 1000)) }}
                      تومان
                    </td>
                    <td>{{ nPersian(number_format(15)) }}%</td>
                  </tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>بین {{ nPersian(number_format(800000)) }} تا {{ nPersian(number_format(1000000 - 1000)) }}
                      تومان
                    </td>
                    <td>{{ nPersian(number_format(20)) }}%</td>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td>{{ nPersian(number_format(1000000)) }} تومان به بالا</td>
                    <td>{{ nPersian(number_format(25)) }}%</td>
                  </tr>
                  <tr>
                    @if (check_user_level_up() < 5)
                      <th colspan="12"> مجموع خرید شما
                        <b>{{ nPersian(
    number_format(
        auth()->user()->paids->sum('price'),
    ),
) }}</b>
                        میباشد و به
                        <b>{{ nPersian(number_format(left_to_next_level())) }}</b> نیاز دارید به سطح
                        <b>{{ nPersian(check_user_level_up() + 1) }}</b> برسید
                      </th>
                    @else
                      <th colspan="12">شما هم اکنون در سطح آخر قرار دارید و در هر خرید {{ nPersian(25) }}% تخفیف خواهید
                        داشت.</th>
                    @endif
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </article>
      </div>
    </div>
  </div>
@endsection
