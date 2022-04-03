@php
$packages = \App\Package::get();
@endphp
@extends('layouts.app')
@push('meta.in.head')
  @include('meta::manager', [
      'image' => 'https://lyndakade.ir/image/logo.png',
      'title' => 'خرید اشتراک - لیندا کده',
      'keywords' => get_seo_keywords() . ', خرید اشتراک , buy package , package, lyndakade package',
      'description' => 'خرید اشتراک | ' . get_seo_description(),
  ])
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "ItemList",
      "itemListElement": [
        @foreach ($packages as $package)
          {
          "@type":"ListItem",
          "position":{{ $loop->index + 1 }},
          "url":"{{ route('packages.index', ['id' => $loop->index + 1]) }}"
          @if (!$loop->last)
            ,
          @endif
        @endforeach
      ]
    }
  </script>
@endpush
@section('content')
  <h1 class="sr-only">خرید اشتراک</h1>
  <style>
    .w-20 {
      user-select: none;
    }

    .w-20 .card-body {
      transition-duration: 200ms;
    }

    .w-20 .card-body:hover {
      background-color: #00a9d3 !important;
      color: #fff !important;
    }

    @media(min-width: 768px) {
      .w-20 {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 20% !important;
        flex: 0 0 20% !important;
        max-width: 20%;
      }
    }

    @media(max-width: 768px) {

      .w-20 .card-body {
        background-color: #00a9d3 !important;
      }

    }

    .card-body>p {
      border-top: 2px solid #919191;
      margin: 0;
      padding: 0.5rem 0;
    }

  </style>
  @if (number_of_available_package(auth()->id()) > -1)
    <div class="container card mt-0 my-md-5 py-3 ">
      <h2>اشتراک های فعلی من</h2>
      <div class="row d-flex justify-content-center text-center mx-md-5 mt-3" style="font-size: 1.2em;">
        <table class="table table-bordered table-sm col-sm-12 col-md-8">
          <tbody>
            <tr>
              <td>
                از اعتبار اشتراک فعلی شما <b>{{ nPersian(number_of_available_package(auth()->id())) }}</b>
                دوره آموزشی باقی مانده است و تا
                <b>
                  تاریخ
                  @php
                    $date = strtotime(end_date_of_available_package(auth()->id())->toDateTimeString());
                    $d = date('Y/m/d', $date);
                    $d = explode('/', $d);
                    echo nPersian(gregorian_to_jalali(intval($d[0]), intval($d[1]), intval($d[2]), '/')) . ' و ساعت ' . nPersian(date('H:i:s', $date));
                  @endphp
                </b>
                اعتبار دارد.
              </td>
            </tr>
            <tr>
              <td>
                <b>
                  توجه داشته باشید، در صورت پایان یافتن زمان این اشتراک، اعتبار دوره آموزشی آن از بین خواهد رفت،
                  اما در صورت خرید اشتراک دیگر، اعتبار دوره آموزشی فعلی نیز به اشتراک جدید اضافه خواهد شد.
                </b>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  @endif
  <div class="container card mt-0 my-md-5 py-3 ">
    <h2>خرید اشتراک</h2>
    <div class="chart-area">
      <canvas id="chartBig5"></canvas>
    </div>
  </div>
@endsection

@section('script_body')
  <script src="https://lyndakade.ir/black/js/plugins/chartjs.min.js"></script>
  <script>
    var ctx = document.getElementById("chartBig5").getContext("2d"),
      labels = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],
      data = [50, 50, 50, 50, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100];
    for (let idx = 0; idx < labels.length; idx++) {
      labels[idx] = engToPer(labels[idx]);
      data[idx] = engToPer(data[idx]);
    }
    const config = {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: 'دستمزد دوبلور',
          data: data,
          fill: true,
          borderColor: 'rgb(75, 192, 192)',
          tension: 0.1
        }],
        options: {
          scales: {
            y: {
              stacked: true
            }
          }
        }
      },
    };
    var myChartData = new Chart(ctx, config);
  </script>

  <script>
    function numFormat(n) {
      return n
        .toString()
        .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }

    function check_code_button(e) {
      e.preventDefault();
      //   console.log(e.target);
      var this_btn = e.target,
        price = this_btn.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement
        .querySelector(
          '[name="price"]').value.trim(),
        result_div = this_btn.parentElement.parentElement.querySelector('.check-code-result'),
        package_price = this_btn.parentElement.parentElement.querySelector('.package-price');

      var code = this_btn.parentElement.parentElement.querySelector('[name="discount_code"]').value.trim();
      if (code == '') {
        result_div.innerHTML =
          `<span style="color: red;border: 1px solid;padding: 2px;">کد نا معتبر می‌باشد.</span>`;
        package_price.innerHTML = `${engToPer(numFormat(price))} تومان`;
        return;
      }
      this_btn.setAttribute('disabled', true);
      $.ajax({
        url: "{{ route('package.check-code.api') }}?code=" + code + '&price=' + price,
        method: 'get',
        // async: false,
        success: function(result) {
          this_btn.removeAttribute('disabled');
          var tt = result.percent;
          if (tt && result.data) {
            package_price.innerHTML = `${engToPer(numFormat(price))} تومان
            <span style="color: #39c300;">
                            با تخفیف
            ${engToPer(numFormat(result.new_price))}
                تومان</span>`;
            result_div.innerHTML =
              `<span style="color: green;border: 1px solid;padding: 2px;">کد دارای ${tt} تخفیف می‌باشد.</span>`;
          } else {
            result_div.innerHTML =
              `<span style="color: red;border: 1px solid;padding: 2px;">کد نا معتبر می‌باشد.</span>`;
            package_price.innerHTML = `${engToPer(numFormat(price))} تومان`;
          }
        },
        errors: function(xhr) {
          this_btn.removeAttribute('disabled');
          console.log("xhr", xhr);
          result_div.innerHTML =
            `<span style="color: red;border: 1px solid;padding: 2px;">کد نا معتبر می‌باشد.</span>`;
          package_price.innerHTML = `${engToPer(numFormat(price))} تومان`;
        }
      });
      return false;
    }
  </script>
@endsection
