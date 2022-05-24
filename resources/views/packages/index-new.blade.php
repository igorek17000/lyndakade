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
      "@graph": [{
          "@type": "Organization",
          "@id": "https://LyndaKade.ir/#/schema/organization/LyndaKade",
          "name": "Lynda Kade - لیندا کده",
          "url": "https://LyndaKade.ir",
          "sameAs": [
            "https://www.aparat.com/LyndaKade.ir",
            "https://www.instagram.com/LyndaKade.ir/",
            "https://t.me/LyndaKade/"
          ],
          "logo": {
            "@type": "ImageObject",
            "@id": "https://LyndaKade.ir/#/schema/image/LyndaKade",
            "url": "https://lyndakade.ir/image/logoedit2.png",
            "width": 100,
            "height": 100,
            "caption": "Lynda Kade - لیندا کده"
          },
          "image": {
            "@id": "https://LyndaKade.ir/#/schema/image/LyndaKade",
            "inLanguage": "fa-IR",
            "url": "https://lyndakade.ir/image/logoedit2.png",
            "width": 100,
            "height": 100,
            "caption": "Lynda Kade - لیندا کده"
          }
        },
        {
          "@type": "WebSite",
          "@id": "https://LyndaKade.ir/#/schema/website/LyndaKade",
          "url": "https://LyndaKade.ir",
          "name": "Lynda Kade - لیندا کده",
          "potentialAction": {
            "@type": "SearchAction",
            "target": "https://LyndaKade.ir/search?q={search_term_string}",
            "query-input": "required name=search_term_string"
          },
          "publisher": {
            "@id": "https://LyndaKade.ir/#/schema/organization/LyndaKade"
          }
        },
        {
          "@type": "WebPage",
          "@id": "{{ request()->url() }}",
          "url": "{{ request()->url() }}",
          "inLanguage": "fa-IR",
          "name": "خرید اشتراک - لیندا کده",
          "dateModified": "{{ \Carbon\Carbon::now() }}",
          "description": "",
          "isPartOf": {
            "@id": "https://LyndaKade.ir/#/schema/website/LyndaKade"
          },
          "about": {
            "@id": "https://LyndaKade.ir/#/schema/organization/LyndaKade"
          }
        },
        {
          "@context": "https://schema.org",
          "@id": "https://LyndaKade.ir/#/schema/breadcrumb/LyndaKade",
          "@type": "BreadcrumbList",
          "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "item": {
              "@id": "https://LyndaKade.ir/",
              "name": "Learning",
              "url": "https://LyndaKade.ir/"
            }
          }, {
            "@type": "ListItem",
            "position": 2,
            "item": {
              "@id": "{{ route('packages.index') }}",
              "name": "خرید اشتراک - لیندا کده",
              "url": "{{ route('packages.index') }}"
            }
          }]
        },
        {
          "@context": "https://schema.org",
          "@type": "ItemList",
          "itemListElement": [
            @foreach ($packages as $package)
              {
                "@type": "ListItem",
                "position": {{ $loop->index + 1 }},
                "url": "{{ route('packages.index', ['id' => $loop->index + 1]) }}"
              }
              @if (!$loop->last)
                ,
              @endif
            @endforeach
          ]
        }
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

    @media (min-width: 768px) {
      .w-20 {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 20% !important;
        flex: 0 0 20% !important;
        max-width: 20%;
      }
    }

    @media (max-width: 768px) {

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

    @if (!auth()->check())
      <div class="px-2 py-1 text-center"
        style="background-color: orange;border-radius: 20px;font-weight: 600;font-size: 15px;">
        قبل از خرید اشتراک، لطفا <a href="{{ route('login') }}" style="color: white;">وارد حساب کاربری</a> خود شوید.
      </div>
    @endif
    <div class="row d-flex justify-content-center text-center mx-md-5 mt-3" style="font-size: 1.2em;">
      @foreach ($packages as $package)
        <div class="w-20 col-sm-4 mb-4 mx-md-auto mx-5" data-toggle="modal" data-target="#modal{{ $package->id }}">
          <div class="card-body p-0" style="border: darkcyan 2px solid; border-radius: 10px; height: 300px !important;">
            <h3 class="pt-5 pb-4">{{ $package['title'] }}</h3>
            <p>{{ nPersian($package['days']) }} روزه</p>
            <p>{{ nPersian($package['count']) }} دوره آموزشی</p>
            <p>{{ nPersian(number_format($package['price'])) }} تومان</p>
            <p class="px-1" style="font-size: 13px;color: #7a00ad;font-weight: 600;">
              قیمت هر دوره آموزشی بطور متوسط
              @php
                $ratio = $package['price'] / $package['count'];
                echo nPersian(number_format($ratio));
              @endphp
              تومان
            </p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
  @foreach ($packages as $package)
    <form action="{{ route('packages.payment') }}" method="get">
      <input type="hidden" name="code" value="{{ hash('sha256', $package->id) }}">
      <input type="hidden" name="price" value="{{ $package['price'] }}">
      <div class="modal text-center fade" id="modal{{ $package->id }}" tabindex="-1" role="dialog"
        aria-labelledby="modalLabel{{ $package->id }}" aria-hidden="true" style="margin-top: 50px;padding: 0 10px;">
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
              <div class="card-body p-0" style="height: 250px !important;">
                <h3 style="padding: .4rem 0 !important;">{{ $package['title'] }}</h3>
                <p>{{ nPersian($package['days']) }} روزه</p>
                <p>{{ nPersian($package['count']) }} دوره آموزشی</p>
                <p class="package-price">{{ nPersian(number_format($package['price'])) }} تومان</p>
                <label for="discount_code{{ $package->id }}">کد تخفیف: </label>
                <input type="text" name="discount_code" id="discount_code{{ $package->id }}">
                <br />
                <button class="btn btn-info check-code-button mt-2" onclick="check_code_button(event)" type="button">
                  بررسی کد تخفیف
                </button>
                <div class="check-code-result" style="padding: 5px 0;"></div>
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
