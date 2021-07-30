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
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">عنوان دوره</th>
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
                        <td>{{ $course->title }}</td>
                        <td>
                          @php
                            $paid = \App\Paid::all()
                                ->where('user_id', auth()->id())
                                ->where('type', '1')
                                ->where('item_id', $course->id)
                                ->first();
                            $d = date('Y/m/d', strtotime($paid->created_at));
                            $d = explode('/', $d);
                            echo gregorian_to_jalali(intval($d[0]), intval($d[1]), intval($d[2]), '/');
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
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">عنوان مسیر آموزشی</th>
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
                        <td>{{ $path->title }}</td>
                        <td>
                          @php
                            $paid = \App\Paid::all()
                                ->where('user_id', auth()->id())
                                ->where('type', '2')
                                ->where('item_id', $path->id)
                                ->first();
                            echo date('Y/m/d', strtotime($paid->created_at));
                          @endphp
                        </td>
                        <td><a href="{{ route('learn.paths.show', [$path->library->slug, $path->slug]) }}">لینک</a>
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
      </div>
    </div>
  </div>
@endsection
