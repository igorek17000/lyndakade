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
    <div class="row d-flex justify-content-center text-center mx-md-5 mt-3" style="font-size: 1.2em;">
      @foreach ($packages as $package)
        {{-- <a href="{{ route('packages.payment', ['code' => hash('sha256', $package->id)]) }}"
          class="w-20 col-sm-4 mb-4 mx-md-auto mx-5">
          <div class="card-body p-0" style="border: darkcyan 2px solid; border-radius: 10px; height: 300px !important;">
            <h3 class="pt-5 pb-4">{{ $package['title'] }}</h3>
            <p>{{ nPersian($package['days']) }} روزه</p>
            <p>{{ nPersian($package['count']) }} دوره آموزشی</p>
            <p>{{ nPersian(number_format($package['price'])) }} تومان</p>
            <button class="btn btn-secondary">خرید اشتراک</button>
          </div>
        </a> --}}
        <div class="w-20 col-sm-4 mb-4 mx-md-auto mx-5" data-toggle="modal" data-target="#modal{{ $package->id }}">
          <div class="card-body p-0" style="border: darkcyan 2px solid; border-radius: 10px; height: 300px !important;">
            <h3 class="pt-5 pb-4">{{ $package['title'] }}</h3>
            <p>{{ nPersian($package['days']) }} روزه</p>
            <p>{{ nPersian($package['count']) }} دوره آموزشی</p>
            <p>{{ nPersian(number_format($package['price'])) }} تومان</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
  @foreach ($packages as $package)
    <form action="{{ route('packages.payment') }}" method="get">
      <input type="hidden" name="code" value="{{ hash('sha256', $package->id) }}">
      <div class="modal text-center fade" id="modal{{ $package->id }}" tabindex="-1" role="dialog"
        aria-labelledby="modalLabel{{ $package->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLabel{{ $package->id }}">{{ $package['title'] }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                style="float: left;margin: 0 auto 0 0;padding: 3px;">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="card-body p-0" style="height: 300px !important;">
                <h3 class="pt-4 pb-4">{{ $package['title'] }}</h3>
                <p>{{ nPersian($package['days']) }} روزه</p>
                <p>{{ nPersian($package['count']) }} دوره آموزشی</p>
                <p>{{ nPersian(number_format($package['price'])) }} تومان</p>
                <label for="discount_code">کد تخفیف: </label>
                <input type="text" name="discount_code" id="discount_code">
                <button class="btn btn-info check-code-button mt-2" onclick="check_code_button(event)">بررسی کد تخفیف</button>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
              <button class="btn btn-primary" type="submit">رفتن به درگاه پرداخت</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  @endforeach
@endsection

@section('script_body')
  <script>
    async function check_code_button(e) {
      e.preventDefault();
      $.ajax({
        url: route('package.check-code.api', ['code' => ]),
        method: 'get',
        success: function(result) {

        },
        errors: function(xhr) {
          console.log("xhr", xhr);
        }
      })
      console.log(e);
      return false;
    }
  </script>
@endsection
