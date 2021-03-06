@extends('voyager::master')

@section('content')
  <div class="page-content">
    @include('voyager::alerts')
    @include('voyager::dimmers')
    <div class="analytics-container">
      <div class="card card-chart">
        <div class="card-header ">
          <div class="row">
            <div class="col-sm-6 text-left">
              {{-- <h5 class="card-category" style="padding: 0 0 0 15px;">Total Shipments</h5> --}}
              {{-- <h2 class="card-title" style="padding: 0 0 0 15px;">Performance</h2> --}}
            </div>
            <div class="col-sm-6">
              <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                <label class="btn btn-sm btn-primary btn-simple active" id="update-chart-views">
                  <input type="radio" name="options" checked>
                  <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Views</span>
                  <span class="d-block d-sm-none">
                    <i class="tim-icons icon-"></i>
                  </span>
                </label>
                <label class="btn btn-sm btn-primary btn-simple" id="update-chart-purchase">
                  <input type="radio" class="d-none d-sm-none" name="options">
                  <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Purchases</span>
                  <span class="d-block d-sm-none">
                    <i class="tim-icons icon-money-coins"></i>
                  </span>
                </label>
                {{-- <label class="btn btn-sm btn-primary btn-simple" id="2"> --}}
                {{-- <input type="radio" class="d-none" name="options"> --}}
                {{-- <span --}}
                {{-- class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Purchases (Price)</span> --}}
                {{-- <span class="d-block d-sm-none"> --}}
                {{-- <i class="tim-icons icon-tap-02"></i> --}}
                {{-- </span> --}}
                {{-- </label> --}}
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <canvas id="chartBig1"></canvas>
          </div>
        </div>
        <div class="card-header">
          <div class="row" id="chart-total-view">
            <div class="col-sm-12 col-md-6">
              <h5 class="card-category text-center font-weight-bold">Views</h5>
              <span class="card-title"
                style="margin-top: 10px; margin-bottom: 10px; padding-top: 0 !important; padding-bottom: 0 !important;"><i
                  class="tim-icons icon-money-coins text-primary"></i>
                Total Views in Last Month: <span class="float-right" id="charBig1TotalViewLastMonth"></span></span>
              <span class="card-title"
                style="margin-top: 10px; margin-bottom: 10px; padding-top: 0 !important; padding-bottom: 0 !important;"><i
                  class="tim-icons icon-money-coins text-primary"></i>
                Total Views All Time: <span class="float-right" id="charBig1TotalViewAllTime"></span>
              </span>
            </div>
          </div>
          <div class="row" id="chart-total-purchase" style="display:none;">
            <div class="col-sm-12 col-md-6">
              <h5 class="card-category text-center font-weight-bold">Counts</h5>
              <span class="card-title"
                style="margin-top: 10px; margin-bottom: 10px; padding-top: 0 !important; padding-bottom: 0 !important;"><i
                  class="tim-icons icon-money-coins text-primary"></i> Total Last
                Month: <span class="float-right" id="charBig1TotalCountLastMonth"></span></span>
              <span class="card-title"
                style="margin-top: 10px; margin-bottom: 10px; padding-top: 0 !important; padding-bottom: 0 !important;"><i
                  class="tim-icons icon-money-coins text-primary"></i> Total All
                Time: <span class="float-right" id="charBig1TotalCountAllTime"></span></span>
            </div>
            <div class="col-sm-12 col-md-6">
              <h5 class="card-category text-center font-weight-bold">Prices</h5>
              <span class="card-title"
                style="margin-top: 10px; margin-bottom: 10px; padding-top: 0 !important; padding-bottom: 0 !important;"><i
                  class="tim-icons icon-money-coins text-primary"></i> Total Last
                Month:
                <span class="float-right" id="charBig1TotalPriceLastMonth"></span></span>
              <span class="card-title"
                style="margin-top: 10px; margin-bottom: 10px; padding-top: 0 !important; padding-bottom: 0 !important;"><i
                  class="tim-icons icon-money-coins text-primary"></i> Total All
                Time:
                <span class="float-right" id="charBig1TotalPriceAllTime"></span></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <style>
      .table-wrapper {
        max-height: 250px;
        overflow: auto;
        display: inline-block;
      }

      .col-md-6 .card {
        min-height: 370px;
        max-height: 370px;
      }

    </style>
    <div class="container c-tables">
      <div class="row">
        <div class="col-md-6 mb-3">
          <div class="card">
            <div class="card-body">
              <h2 class="card-title text-center">MOST PAID USERS</h2>
              <div class="card-text table-wrapper">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Username</th>
                      <th scope="col">Total Payments</th>
                      <th scope="col">Number Of Payments</th>
                      <th scope="col">Last Payment</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $paids = \App\Paid::orderBy('totalprice', 'desc')
                          ->select('*', DB::raw('count(*) as total'), DB::raw('sum(price) as totalprice'))
                          ->groupBy('user_id')
                          ->limit(20)
                          ->get();
                    @endphp
                    @foreach ($paids as $index => $paid)
                      <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $paid->user->username }}</td>
                        <td>{{ number_format($paid->totalprice) }}</td>
                        <td>{{ number_format($paid->total) }}</td>
                        <td>{{ $paid->user->paids->first()->created_at }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div class="card">
            <div class="card-body">
              <h2 class="card-title text-center">Dubbed Users Balance</h2>
              <div class="card-text table-wrapper">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">User ID</th>
                      <th scope="col">Username</th>
                      <th scope="col">Total Dubbed Courses</th>
                      <th scope="col">Total Balance</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    @foreach (get_dashboard_dubbed_table_data() as $row)
                      @if ($row->id != -1)
                        <tr>
                          @php
                            $user_data = prepare_dubbed_panel_data_for_user(\App\User::firstWhere('username', $row->username));
                            $user_total_balance = $user_data['total_income'] - $user_data['total_received'];
                            $user_total_balance = $user_data['total_balance'];
                          @endphp
                          <th scope="row">{{ $loop->iteration }}</th>
                          <td>{{ $row->id }}</td>
                          <td>{{ $row->username }}</td>
                          <td>{{ $row->total_courses }}</td>
                          <td>{{ $user_total_balance }}</td>
                          {{-- <td>{{ $row->total_balance }}</td> --}}
                        </tr>
                      @else
                        <tr>
                          <td colspan="3"><b>{{ $row->username }}</b></td>
                          <td><b>{{ $row->total_courses }}</b></td>
                          <td><b>{{ $row->total_balance }}</b></td>
                        </tr>
                      @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h2 class="card-title text-center">MOST PAID COURSES</h2>
              <div class="card-text table-wrapper">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Course Title</th>
                      <th scope="col">Total Sells</th>
                      <th scope="col">Last Sell</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $courses = \App\Course::query()
                          ->leftJoin('paids', 'paids.item_id', '=', 'courses.id')
                          ->select('courses.id', 'courses.dubbed_id', 'courses.titleEng', DB::raw('count(*) as total'))
                          ->groupBy('paids.item_id')
                          ->orderBy('total', 'desc')
                          ->whereNotNull('paids.item_id')
                          ->take(20)
                          ->get();
                    @endphp
                    @foreach ($courses as $index => $course)
                      <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $course->titleEng }} @if ($course->dubbed_id == 1)
                            <b> (Dubbed)</b>
                          @endif
                        </td>
                        <td>{{ number_format($course->total) }}</td>
                        <td>
                          {{ \App\Paid::where('item_id', $course->id)->where('type', '1')->latest()->first()->created_at }}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h2 class="card-title text-center">MOST UNLOCKED COURSES</h2>
              <div class="card-text table-wrapper">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Course Title</th>
                      <th scope="col">Total Unlocks</th>
                      <th scope="col">Last Sell</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $courses = \App\Course::query()
                          ->leftJoin('unlocked_courses', 'unlocked_courses.course_id', '=', 'courses.id')
                          ->select('courses.id', 'courses.dubbed_id', 'courses.titleEng', DB::raw('count(*) as total'))
                          ->groupBy('unlocked_courses.course_id')
                          ->orderBy('total', 'desc')
                          ->whereNotNull('unlocked_courses.course_id')
                          ->take(20)
                          ->get();
                    @endphp
                    @foreach ($courses as $index => $course)
                      <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $course->titleEng }} @if ($course->dubbed_id == 1)
                            <b> (Dubbed)</b>
                          @endif
                        </td>
                        <td>{{ number_format($course->total) }}</td>
                        <td>{{ \App\UnlockedCourse::where('course_id', $course->id)->latest()->first()->created_at }}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
@stop

@section('javascript')
  <script src="{{ asset('black/js/plugins/chartjs.min.js') }}"></script>
  <script async src="{{ asset('black/js/initChart.js') }}"></script>

@stop
