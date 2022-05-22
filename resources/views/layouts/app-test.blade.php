@php
//session(['redirectToAfterLogin' => url()->previous()]);
@endphp
<!DOCTYPE html>
<html dir="rtl" lang="fa">
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->isLocale('fa') ? 'rtl' : 'ltr' }}"> --}}

<head>
  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-5V9HN76');
  </script>
  <!-- End Google Tag Manager -->

  <meta charset="UTF-8" />
  <meta name="format-detection" content="telephone=no" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="ahrefs-site-verification" content="aa83e5ce5c77eea3020a703c0314d147b6de80f758c8bf3e24a3aefc9d48a47c">


  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-SB27JF9C9Y"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-SB27JF9C9Y');
  </script>

  {{-- <script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "97to84h0rp");
</script> --}}

  <meta name="google-site-verification" content="TPdR7eAXlaJ5SPRxpwWcQbG7yNX3s-DS3tLUHlOp9RY" />
  @stack('meta.in.head')
  {{-- @include('meta::manager') --}}

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- <title>{{ config('app.name', 'لیندا کده') }}</title> --}}

  <link href="{{ asset('image/favicon.ico') }}" rel="icon" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('black/img/apple-icon.png') }}">
  <link rel="manifest" href="/manifest.json">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"
    media="print" onload="this.media='all'">

  <noscript>
    <link rel="stylesheet" href="style.css">
  </noscript>

  {{-- <link href="{{ mix('css/app.css') }}" rel="stylesheet"> --}}

  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />

  {{-- <link href="{{ asset('css/font-awesome/all.css') }}" rel="stylesheet" /> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.6.0/css/all.min.css"
    integrity="sha512-ykRBEJhyZ+B/BIJcBuOyUoIxh0OfdICfHPnPfBy7eIiyJv536ojTCsgX8aqrLQ9VJZHGz4tvYyzOM0lkgmQZGw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.6.0/js/all.min.js"
    integrity="sha512-kWTrl8apDL/aScTYauVsRnGkZv4n7JpH03mIdTmiELoAvAT+CGmfBQx03EMkTT34f5jvyY0DRa/M/it7iecBKw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  {{-- <link href="{{ asset('css/toastr.css') }}" rel="stylesheet"> --}}
  {{-- <script src="{{ asset('js/toastr.min.js') }}"></script> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <link rel="stylesheet" type="text/css" href="{{ asset('css/fonts.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('css/icons.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('css/my-stylesheet.css') }}" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.7.2/plyr.css"
    integrity="sha512-SwLjzOmI94KeCvAn5c4U6gS/Sb8UC7lrm40Wf+B0MQxEuGyDqheQHKdBmT4U+r+LkdfAiNH4QHrHtdir3pYBaw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  {{-- <script async src="{{ asset('js/lazysizes.min.js') }}"></script> --}}
  <script async src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"
    integrity="sha512-q583ppKrCRc7N5O0n2nzUiJ+suUv7Et1JGels4bXOaMFQcamPk9HjdUknZuuFjBNs7tsMuadge5k9RzdmO+1GQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{ mix('js/all.js') }}"></script>

  {!! NoCaptcha::renderJs() !!}

  @yield('script_head')
  @stack('css_head')

  @csrf

  <style>
    .wrapper-wide {
      box-shadow: 0 0 4px rgba(0, 0, 0, .1);
      background: repeat-x #f7f7f7;
      background-image: -webkit-linear-gradient(top, #f7f7f7 0, #e5e5e5 100%);
      background-image: -o-linear-gradient(top, #f7f7f7 0, #e5e5e5 100%);
      background-image: linear-gradient(to bottom, #f7f7f7 0, #e5e5e5 100%);
    }

    .hero-text {
      background-color: rgba(255, 255, 255, 0.5) !important;
    }


    .wrapper-wide.dark-theme {
      background: repeat-x #171717;
      background-image: -webkit-linear-gradient(top, #171717 0, #111 100%);
      background-image: -o-linear-gradient(top, #171717 0, #111 100%);
      background-image: linear-gradient(to bottom, #171717 0, #111 100%);
      color: white;
    }

    .wrapper-wide.dark-theme a,
    .wrapper-wide.dark-theme pre {
      color: white;
    }

    .wrapper-wide.dark-theme a:hover,
    .wrapper-wide.dark-theme h5.course-title {
      color: #17a2b8;
    }

    .wrapper-wide.dark-theme .section-module,
    .wrapper-wide.dark-theme .container:not(.no-dark),
    .wrapper-wide.dark-theme .container-fluid:not(.no-dark),
    .wrapper-wide.dark-theme .row:not(.no-dark) {
      background-color: #222;
    }

    .wrapper-wide.dark-theme .card.course {

      background-color: #353535;
    }

    .wrapper-wide.dark-theme .course-title {
      text-shadow: none;
    }

    .wrapper-wide.dark-theme .course-grid,
    .wrapper-wide.dark-theme [data-slide] {
      background: transparent !important;
    }

    .wrapper-wide.dark-theme .tags>a {
      background: #333;
    }

    .wrapper-wide.dark-theme .hero-text {
      background-color: rgba(0, 0, 0, 0.5) !important;
      color: white;
    }

    .fab-container {
      position: fixed;
      width: 70px;
      height: 70px;
      bottom: 30px;
      left: 30px;
      z-index: 2000;
    }

    .fab-container:hover .sub-button:nth-child(2) {
      transform: translateY(-80px);
    }

    .fab-container:hover .sub-button:nth-child(3) {
      transform: translateY(-140px);
    }

    .fab-container:hover .sub-button:nth-child(4) {
      transform: translateY(-200px);
    }

    .fab-container:hover .sub-button:nth-child(5) {
      transform: translateY(-260px);
    }

    .fab-container:hover .sub-button:nth-child(6) {
      transform: translateY(-320px);
    }

    .fab-container .fab {
      position: absolute;
      left: 0;
      top: 0;
      height: 70px;
      width: 70px;
      background-color: #465773;
      border-radius: 50%;
      z-index: 2000;
    }

    .fab-container .fab::before {
      content: " ";
      position: absolute;
      bottom: 0;
      left: 0;
      height: 35px;
      width: 35px;
      background-color: inherit;
      border-radius: 0 0 10px 0;
      z-index: -1;
    }

    .fab-container .fab-content {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100%;
      width: 100%;
      border-radius: 50%;
    }

    .fab-container .sub-button {
      position: absolute;
      display: flex;
      align-items: center;
      justify-content: center;
      bottom: 10px;
      left: 10px;
      height: 50px;
      width: 50px;
      background-color: royalblue;
      border-radius: 50%;
      transition: all .3s ease;
      z-index: 200;
    }

    .fab-container .sub-button:hover {
      cursor: pointer;
    }

  </style>

  <style>
    .hero-space {
      min-height: 560px !important;
    }

    @media (min-width: 426px) {
      .hero-space {
        min-height: 510px !important;
      }
    }

    @media (min-width: 426px) {
      .hero-space {
        min-height: 340px !important;
      }
    }

    @media (min-width: 769px) {
      .hero-space {
        min-height: 360px !important;
      }
    }

    @media (min-width: 1025px) {
      .hero-space {
        min-height: 300px !important;
      }
    }

    @media (min-width: 1441px) {
      .hero-space {
        min-height: 370px !important;
      }
    }

    .show-xs {
      display: none !important;
    }

    @media (max-width: 767px) {
      .show-xs {
        display: block !important;
      }
    }


    .persian-subtitle-img {
      border: 2px solid rgb(0, 0, 163);
      background-color: rgb(0, 0, 163);
    }

    .english-subtitle-img {
      border: 2px solid green;
      background-color: green;
    }

    .no-subtitle-img {
      border: 2px solid rgb(168, 0, 0);
      background-color: rgb(168, 0, 0);
    }

    .dubbed-subtitle-img {
      border: 2px solid darkgoldenrod;
      background-color: darkgoldenrod;
    }

    .course-img {
      border-radius: 5px;
      max-height: 170px;
      min-height: 170px;
      width: 100%;
    }

    @media (min-width: 575px) {
      .card-horizontal {
        display: flex;
        flex: 1 1 auto;
      }

      .course-img {
        border-radius: 5px;
        max-height: 170px;
        min-height: 170px;
        width: 300px;
      }

    }

    [data-target="#preview-modal"] {
      text-align: center;
      /* position: absolute;
                                                                                                right: 0;
                                                                                                left: 0;
                                                                                                top: 0;
                                                                                                bottom: 0; */
      border-radius: 5px;
      padding: 2px 4px 0 4px;
      font-size: 20px;
      background-color: rgba(0, 0, 0, .8);
      color: #fff;
      display: -webkit-box;
      display: -moz-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      align-items: center;
      justify-content: center;
      float: left;
      width: 100%;
      height: 100%;
    }

    .img-square-wrapper {
      position: relative;
      height: 170px;
    }

    .subtitle-state {
      color: white;
      bottom: 2px;
      font-size: .7rem;
      width: 5.6rem;
      position: absolute;
      left: 0;
      right: 0;
      margin: auto;
      text-align: center;
      /* padding: 0.01rem 0; */
      border-top-left-radius: 0.3rem;
      border-top-right-radius: 0.3rem;
    }

    .course-update-state {
      width: 3.7rem;
      text-align: center;
      position: absolute;
      left: 2px;
      bottom: 2px;
      border-radius: 0 0.25rem 0 0.25rem;
      padding: 2px 4px 0 4px;
      background-color: rgba(240, 0, 0, .8);
      color: #fff;
    }

    .course-time-state {
      width: 3.7rem;
      text-align: center;
      position: absolute;
      right: 2px;
      bottom: 2px;
      border-radius: 0.3rem 0 0.3rem 0;
      padding: 2px 4px 0 4px;
      background-color: rgba(0, 0, 0, .8);
      color: #fff;
    }

    .card.course {
      border-top-width: 0;
      border-left-width: 0;
      border-right-width: 0;
    }

    .course-description-grid {
      font-size: 12px !important;
      overflow: hidden;
      max-width: 500px;
      text-overflow: ellipsis;
      display: -webkit-box;
      -webkit-line-clamp: 4;
      line-height: 1.7;
      line-clamp: 4;
      -webkit-box-orient: vertical;
    }

    @media (min-width: 900px) {
      .course-description-grid {
        max-width: 850px;
      }

    }

    .border-0 {
      border: 0;
    }

    .card.course .card-img-overlay {
      background-color: rgba(0, 0, 0, .8);
      display: flex;
      flex-direction: column;
      justify-content: center;
      color: #fff;
      text-align: center;
      font-size: 1.3rem;
      border-radius: 5px;
      cursor: pointer;
      opacity: 0;
      transition: opacity .3s linear;
    }

    .card.course:hover .card-img-overlay {
      opacity: 1;
    }

    @media (hover: none) {
      .card.course .card-img-overlay {
        opacity: 1;
        background-color: rgba(0, 0, 0, .6);
      }
    }

    a.card-img-overlay:hover {
      color: #fff;
    }

    @media (min-width: 576px) {
      .course.container {
        max-width: 750px;

      }
    }

    @media (min-width: 768px) {
      .course.container {
        max-width: 980px;

      }
    }

    .course .card-body {
      -webkit-box-flex: 1;
      -ms-flex: 1 1 auto;
      flex: 1 1 auto;
      padding: 1rem;
    }

    .course ul li {
      position: relative;
    }

    .course ul>li ul {
      padding-right: 25px;
      padding-top: 4px;
    }

    .course ul input:not(#price-range) {
      position: absolute;
      left: 0;
      top: 0;
      visibility: hidden;
    }

    .course ul label {
      display: block;
      line-height: 25px;
      position: relative;
      padding-right: 25px;
      font-size: 14px;
    }

    @media (max-width: 1023px) {
      .course ul label {
        margin-right: -15px;
        font-size: 12px;
      }
    }

    @media (max-width: 576px) {
      .course ul label {
        margin-right: -15px;
        font-size: 11px;
      }

    }

    .course ul label[type="checkbox"]::before {
      width: 18px;
      height: 18px;
      border-radius: 3px;
      -moz-border-radius: 3px;
      -webkit-border-radius: 3px;
      border: 1px solid #d7e1e6;
      content: '';
      position: absolute;
      right: 0;
      top: 2px;
    }

    .course ul label[type="checkbox"]::after {
      width: 14px;
      height: 14px;
      border-radius: 2px;
      -moz-border-radius: 2px;
      -webkit-border-radius: 2px;
      background-color: #00aaca;
      content: '';
      position: absolute;
      right: 2px;
      top: 4px;
      opacity: 0;
      transition: opacity .3s linear;
    }

    .course ul label[type="radio"]::before {
      width: 18px;
      height: 18px;
      border-radius: 8px;
      -moz-border-radius: 8px;
      -webkit-border-radius: 8px;
      border: 1px solid #d7e1e6;
      content: '';
      position: absolute;
      right: 0;
      top: 2px;
    }

    .course ul label[type="radio"]::after {
      width: 14px;
      height: 14px;
      border-radius: 8px;
      -moz-border-radius: 8px;
      -webkit-border-radius: 8px;
      background-color: #00aaca;
      content: '';
      position: absolute;
      right: 2px;
      top: 4px;
      opacity: 0;
      transition: opacity .3s linear;
    }

    .course ul li input:checked+label:after,
    .course ul li label:hover:after {
      opacity: 1;
    }

    .course ul li input:checked+label:before,
    .course ul li label:hover:before {
      border: 1px solid #00aaca;
    }

    .learn-path *[data-target="#preview-modal"],
    .course *[data-target="#preview-modal"] {
      cursor: pointer;
    }

    .path .card-img-overlay {
      background-color: rgba(0, 0, 0, .8);
      display: flex;
      flex-direction: column;
      justify-content: center;
      color: #fff;
      text-align: center;
      font-size: 1.3rem;
      border-radius: 5px;
      cursor: pointer;
      opacity: 0;
      transition: opacity .3s linear;
    }

    .path:hover .card-img-overlay {
      opacity: 1;
    }

    @media (hover: none) {
      .path .card-img-overlay {
        opacity: 1;
        background-color: rgba(0, 0, 0, .6);
      }
    }

    @keyframes spinner-border {
      to {
        transform: rotate(360deg);
      }
    }

    .spinner-border {
      display: inline-block;
      width: 4rem;
      height: 4rem;
      vertical-align: text-bottom;
      border: 0.23em solid currentColor;
      border-right-color: transparent;
      border-radius: 50%;
      animation: spinner-border .95s linear infinite;
    }

    .spinner-border-sm {
      width: 1rem;
      height: 1rem;
      border-width: 0.2em;
    }

    footer .list-inline-item img {
      transition: transform .7s ease-in-out;
    }

    footer .list-inline-item img:hover {
      transform: rotate(360deg);
    }

  </style>
</head>

<body>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5V9HN76" height="0" width="0"
      style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <div class="wrapper-wide">

    {{-- @include('go-to-top-btn') --}}
    <style>
      nav.navbar ul li a {
        position: relative !important;
      }

    </style>
    @if (false)
      <div class="sticky-top text-center" data-toggle="modal" data-target="#dubbed-modal"
        style="font-size: 17px; padding: 10px 0px; background-color: rgb(0, 170, 202); font-family: IranSANS; font-weight: bold; color: rgb(221, 221, 221); cursor: pointer;">
        <img
          src="data:img/png;base64,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"
          width="30" height="30">
        جذب دوبلور، جهت ارسال رزومه اینجا کلیک کنید
      </div>
      <div class="modal fade" id="dubbed-modal" tabindex="-1" role="dialog" aria-labelledby="dubbed-modal-title">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <p class="text-center" style="font-size: 20px;font-weight: 400;margin-bottom: 0;">فرم جذب دوبلور</p>
              <form id="dubbed-form">
                <div class="form-group">
                  <label for="name" class="col-form-label">نام و نام خانوادگی</label>
                  <input type="text" class="form-control form-control-sm" id="name" name="name" required
                    aria-required="true">

                  <label for="gender" class="col-form-label">جنسیت</label>
                  <select class="form-control form-control-sm" id="gender" name="gender">
                    <option value="female" selected="">زن</option>
                    <option value="male">مرد</option>
                  </select>

                  <label for="skills" class="col-form-label">مهارت‌ها</label>
                  <input type="text" class="form-control form-control-sm" name="skills" id="skills"
                    placeholder="اکسل، پاورپوینت، اتوکد و ..." required aria-required="true">

                  <label for="email" class="col-form-label">ایمیل</label>
                  <input type="email" class="form-control form-control-sm text-left" name="email" id="email" dir="ltr"
                    required aria-required="true">

                  <label for="phone" class="col-form-label">شماره تماس</label>
                  <span style="color: #af4848;font-size: 12px;margin-right: 4px;">
                    (ترجیحا شماره‌ای که واتساپ یا تلگرام داره رو وارد کنید)
                  </span>
                  <input type="tel" class="form-control form-control-sm" name="phone" id="phone" required
                    aria-required="true" minlength="10" maxlength="14" onkeypress="return onlyNumberKey(event)">
                </div>
                <div class="form-group text-center m-0" id="dubbed-form-submit">
                  <button type="submit" class="btn btn-primary">ارسال</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endif

    @php
      $discount_count = \App\Discount::where('type', 1)
          ->whereDate('start_date', '<=', \Carbon\Carbon::now())
          ->whereDate('end_date', '>=', \Carbon\Carbon::now())
          ->count();
      $discount = \App\Discount::where('type', 1)
          ->whereDate('start_date', '<=', \Carbon\Carbon::now())
          ->whereDate('end_date', '>=', \Carbon\Carbon::now())
          ->first();
    @endphp

    @if ($discount_count > 0)
      <div class="sticky-top text-center" style="font-size: 17px;
        padding: 15px 0;
        background-color: #00aaca;
        font-family: 'IranSANS';
        font-weight: bold;">
        {{ nPersian($discount_count) }} عدد تخفیف {{ nPersian($discount->percent) }} درصدی ویژه
        <a href="{{ route('packages.index') }}" style="color: #df9000;text-shadow: 0px 0px 6px black">
          خرید اشتراک
        </a>
        <span style="color:#df9000;text-shadow: 0px 0px 6px black">
          کد تخفیف: {{ $discount->code }}
        </span>
      </div>
    @endif
    {{-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100 py-0" @if (app()->isLocal('en')) dir="ltr" @endif> --}}
    <nav class="navbar navbar-expand-lg navbar-dark w-100 py-0" style="background-color: #252525;">
      <a class="navbar-brand mb-1" href="https://lyndakade.ir">
        <img draggable="false" class="img-logo m-0 p-0" src="https://lyndakade.ir/image/logoedit2.png" title="لینداکده"
          alt="لینداکده - LyndaKade - Lynda Kade - LinkedIN" style="width: 60px; height: 55px;">
        <span class="hidden-md hidden-lg">لیندا کده</span>
      </a>
      {{-- <span class="theme-toggle hidden-md hidden-lg" style="margin-right: auto;color: #eee;">
        <i class="fa fa-sun" style="font-size: 28px;margin: 10px;"></i>
      </span> --}}
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link px-md-1" href="{{ route('root.home') }}">صفحه اصلی</a>
          </li>
          {{-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle px-md-1" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              کتابخانه
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              @foreach (\App\Library::get() as $library)
                <a class="dropdown-item text-center" href="{{ route('home.show', [$library->slug]) }}">
                  <i class="category-icons" aria-hidden="true">
                    @if ($library->slug == 'business')
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24"
                        fill="currentColor" width="24" height="24" focusable="false">
                        <path
                          d="M5 19h16v2H4a1 1 0 01-1-1V3h2v16zM20 3.1l-5 3.11 2.17 1.17-2.48 4.52-3.26-1.75a1.2 1.2 0 00-1.62.48l-3.12 5.74 1.65.9 2.78-5.21 3.28 1.79a1.2 1.2 0 001.6-.48l2.76-5.11L21 9.46V3.67a.67.67 0 00-1-.57z">
                        </path>
                      </svg>
                    @elseif($library->slug == 'creative')
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24"
                        fill="currentColor" width="24" height="24" focusable="false">
                        <path
                          d="M21.71 5L19 2.29a1 1 0 00-1.41 0L4 15.85 2 22l6.15-2L21.71 6.45a1 1 0 00.29-.74 1 1 0 00-.29-.71zM6.87 18.64l-1.5-1.5L15.92 6.57l1.5 1.5zM18.09 7.41l-1.5-1.5 1.67-1.67 1.5 1.5zm-11-6l4.38 4.38-1.37 1.3-3.76-3.75-3 3 1.5 1.5 1.5-1.5.71.71-1.5 1.5 1.54 1.55-1.32 1.33-4.38-4.38a1 1 0 010-1.41l4.25-4.25a1 1 0 011.41 0zm15.56 17l-4.24 4.24a1 1 0 01-1.41 0l-4.38-4.38 1.33-1.33 1.55 1.55 1.5-1.5.71.71-1.5 1.5 1.5 1.5 3-3-3.8-3.8 1.33-1.33 4.38 4.38a1 1 0 01-.01 1.41z">
                        </path>
                      </svg>
                    @else
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24"
                        fill="currentColor" width="24" height="24" focusable="false">
                        <path
                          d="M20 6v12H4V6h16m1-2H3a1 1 0 00-1 1v14a1 1 0 001 1h18a1 1 0 001-1V5a1 1 0 00-1-1zM7.37 16l3.33-3.36a1 1 0 000-1.42L7.46 8 6 9.34l2.54 2.56L6 14.62 7.33 16h.04zM18 14h-6v2h6v-2z">
                        </path>
                      </svg>
                    @endif
                  </i>

                  {{ $library->title }}
                  <br>
                  <small>{{ $library->titleEng }}</small>
                </a>
              @endforeach
            </div>
          </li> --}}
          {{-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle px-md-1" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              مسیرهای آموزشی
            </a>
            <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink1">
             @foreach (\App\Library::get() as $lib)
                <a class="dropdown-item  text-center" style="color: #fff;"
                  href="{{ route('learn.paths.show', [$lib->slug]) }}">
                  <i class="category-icons" aria-hidden="true">
                    @if ($lib->slug == 'business')
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24"
                        fill="currentColor" width="24" height="24" focusable="false">
                        <path
                          d="M5 19h16v2H4a1 1 0 01-1-1V3h2v16zM20 3.1l-5 3.11 2.17 1.17-2.48 4.52-3.26-1.75a1.2 1.2 0 00-1.62.48l-3.12 5.74 1.65.9 2.78-5.21 3.28 1.79a1.2 1.2 0 001.6-.48l2.76-5.11L21 9.46V3.67a.67.67 0 00-1-.57z">
                        </path>
                      </svg>
                    @elseif($lib->slug == 'creative')
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24"
                        fill="currentColor" width="24" height="24" focusable="false">
                        <path
                          d="M21.71 5L19 2.29a1 1 0 00-1.41 0L4 15.85 2 22l6.15-2L21.71 6.45a1 1 0 00.29-.74 1 1 0 00-.29-.71zM6.87 18.64l-1.5-1.5L15.92 6.57l1.5 1.5zM18.09 7.41l-1.5-1.5 1.67-1.67 1.5 1.5zm-11-6l4.38 4.38-1.37 1.3-3.76-3.75-3 3 1.5 1.5 1.5-1.5.71.71-1.5 1.5 1.54 1.55-1.32 1.33-4.38-4.38a1 1 0 010-1.41l4.25-4.25a1 1 0 011.41 0zm15.56 17l-4.24 4.24a1 1 0 01-1.41 0l-4.38-4.38 1.33-1.33 1.55 1.55 1.5-1.5.71.71-1.5 1.5 1.5 1.5 3-3-3.8-3.8 1.33-1.33 4.38 4.38a1 1 0 01-.01 1.41z">
                        </path>
                      </svg>
                    @else
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24"
                        fill="currentColor" width="24" height="24" focusable="false">
                        <path
                          d="M20 6v12H4V6h16m1-2H3a1 1 0 00-1 1v14a1 1 0 001 1h18a1 1 0 001-1V5a1 1 0 00-1-1zM7.37 16l3.33-3.36a1 1 0 000-1.42L7.46 8 6 9.34l2.54 2.56L6 14.62 7.33 16h.04zM18 14h-6v2h6v-2z">
                        </path>
                      </svg>
                    @endif
                  </i>
                  {{ $lib->title }}
                  <br>
                  <small>{{ $lib->titleEng }}</small>
                </a>
              @endforeach
              <a class="dropdown-item text-center" style="color: #fff;" href="{{ route('learn.paths.index') }}">
                همه مسیرهای آموزشی
              </a>
            </div>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link px-md-1" href="{{ route('learn.paths.index') }}">مسیرهای آموزشی</a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-md-1" href="{{ route('packages.index') }}">خرید اشتراک</a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-md-1" href="" data-toggle="modal" data-target="#course-request-modal">درخواست دوره</a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-md-1" href="{{ route('faq') }}">سوالات متداول</a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-md-1" href="{{ route('root.contact.us') }}">تماس با ما</a>
          </li>
          {{-- <li class="nav-item">
            <span class="theme-toggle" style="color: #eee;">
              <i class="fa fa-moon" style="font-size: 28px;margin: 10px;"></i>
            </span>
          </li> --}}
        </ul>
        <form class="form-inline my-2 my-lg-0" role="search" action="{{ route('search') }}">
          <input type="search" name="q" class="form-control mr-sm-2" role="combobox" value="{{ $q ?? '' }}"
            style="font-size: 13px;border: 0;text-align: right; /*padding: 0;*/ padding-right: 5px;min-width: 320px;border-radius: 5px;"
            placeholder="نرم افزار یا مهارتی که میخواهید یاد بگیرید را جستجو کنید">

          {{-- <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">جستجو</button> --}}
        </form>
        @if (Auth::check())
          <div class="dropdown pr-md-2">
            <a class="nav-link p-md-0 text-white" id="cart-list" data-toggle="dropdown" role="button"
              aria-expanded="false">
              سبد خرید
            </a>
            <div class="dropdown-menu dropdown-cart dropdown-menu-left p-1 text-center" role="menu" id="cart-list-item"
              style="width: 400px!important;color: white;">
              @include('carts.partials._cart_list')
            </div>
          </div>
          <div class="dropdown">
            <a id="navbarUser" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="account-name">سلام {{ Auth::user()->name }}
              </span>
              <div class="photo">
                <img src="#" class="lazyload" data-src="{{ fromDLHost(Auth::user()->avatar) }}"
                  alt="{{ __('Profile Photo') }}">
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-center text-center" aria-labelledby="navbarUser">
              @if (Auth::user()->isAdmin())
                <li>
                  <a class="dropdown-item" href="{{ route('voyager.dashboard') }}">{{ __('msg.Dashboard') }}</a>
                </li>
              @else
                <li>
                  <a class="dropdown-item" href="{{ route('courses.mycourses') }}">دروس خریداری شده</a>
                </li>
              @endif
              @if (Auth::user()->role_id == 3)
                <li>
                  <a class="dropdown-item" href="{{ route('users.dubbed-courses') }}">مدیریت دوبله</a>
                </li>
              @endif
              <li>
                <a class="dropdown-item" href="{{ route('my-profile') }}">{{ __('msg.Profile') }}</a>
              </li>
              <li>
                <a class="dropdown-item" href="#"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  {{ __('msg.Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </li>
            </ul>
          </div>
        @else
          <div class="nav-item pr-md-2">
            @php
              $login_link = route('login', ['returnUrl' => request()->url()]);
              if (request()->has('returnUrl')) {
                  $login_link = route('login', ['returnUrl' => request()->get('returnUrl')]);
              }

            @endphp
            {{-- <a class="nav-link btn btn-outline-primary" rel="nofollow"
              href="{{ $login_link }}">{{ __('msg.Login') }}</a> --}}
            <a class="nav-link btn btn-outline-primary" rel="nofollow" href="" data-toggle="modal"
              data-target="#login-register-modal"
              onclick="(()=>{document.querySelector('#login-register-modal-login-tab').click();})()">{{ __('msg.Login') }}</a>

          </div>
          @if (Route::has('register'))
            <div class="nav-item">
              {{-- <a class="nav-link btn btn-outline-primary" style="background-color: #008cc9;"
                href="{{ route('register') }}">{{ __('msg.Register') }}</a> --}}
              <a class="nav-link btn btn-outline-primary" style="background-color: #008cc9;" href="" data-toggle="modal"
                data-target="#login-register-modal"
                onclick="(()=>{document.querySelector('#login-register-modal-register-tab').click();})()">{{ __('msg.Register') }}</a>
            </div>
          @endif
        @endif
      </div>
    </nav>

    {{-- @if (\App\Notification::where('expire', '>=', date(now()))->count() > 0)
      <div id="notifications">
        <div class="" style="background-color: orange; padding: 15px;">
          <div class="container">
            @foreach (\App\Notification::all() as $notification)
              @if ($notification->expire > date(now()))
                <h5>{!! $notification->message !!}</h5>
              @endif
            @endforeach
          </div>
        </div>
      </div>
    @endif --}}

    <main id="app">
      @yield('content')

    </main>

    <style>
      footer ul>li>a,
      footer p {
        color: #ccc;
      }

      #footer .column img {
        height: 150px;
        width: 100%;
      }

    </style>

    {{-- <footer id="footer" class="bg-dark text-muted p-md-5 pt-4 @if (app()->isLocal('en')) text-left @endif"  @if (app()->isLocal('en')) dir="ltr" @endif> --}}
    {{-- <footer id="footer" class="bg-dark text-muted p-md-5 pt-4">
      <div class="container no-dark">
        <div class="row no-dark">
          <div class="contact col-lg-6 col-md-6 col-sm-12 col-xs-12 text-sm-right text-center">
            <h5 class="pt-1 pb-3" style="color: #00aaca;">درباره ما</h5>
            <p class="text-white pl-md-5 text-justify">
              لینداکده یک بستر یادگیری پیشرو است که به هر کس کمک می کند تا کسب و کار ، نرم افزار ، فناوری و
              مهارت های خلاقانه را برای دستیابی به اهداف شخصی و حرفه ای بیاموزد.
            </p>
            <div class="row no-dark">
              <div class="col-12 text-center">
                <ul class="list-inline">
                  <li class="list-inline-item text-white">
                    لینداکده-1400
                  </li>
                  <li class="list-inline-item">
                    <a rel="noopener noreferrer" href="{{ route('root.contact.us') }}" style="color: #00aaca;">
                      تماس با ما
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a rel="noopener noreferrer" class="social-icon text-xs-center" target="_blank"
                      href="http://www.Instagram.com/lyndakade.ir">
                      <i class="fab fa-instagram"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a rel="noopener noreferrer" class="social-icon text-xs-center" target="_blank"
                      href="http://www.T.me/LyndaKadeSupport">
                      <i class="fab fa-telegram"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a rel="noopener noreferrer" class="social-icon text-xs-center" target="_blank"
                      href="http://www.Aparat.com/LyndaKade.ir">
                      <img data-toggle="tooltip" src="#" data-src="{{ asset('image/socialicons/aparat.png') }}"
                        alt="Aparat - آپارات" title="آپارات" class="icon-aparat lazyload">
                    </a>
                  </li>
                </ul>
              </div>
              <div class="col-12 text-center">
                <p class="my-0 text-white">کلیه‌ی حقوق این سایت متعلق به لینداکده است.</p>
              </div>
            </div>
          </div>
          <div class="column col-lg-2 col-md-2 col-sm-4 col-xs-12 text-center my-2 enamad-logo">
            <a referrerpolicy="origin" target="_blank"
              href="https://trustseal.enamad.ir/?id=212458&amp;Code=PmAs0cswBnOXzNOOqfGD">
              <img src="#" class="lazyload" referrerpolicy="origin"
                data-src="https://Trustseal.eNamad.ir/logo.aspx?id=212458&amp;Code=PmAs0cswBnOXzNOOqfGD"
                alt="نماد الکترونیک enamad در صورت اتصال با آی‌پی داخل کشور، نمایش داده خواهد شد."
                style="cursor:pointer;" id="PmAs0cswBnOXzNOOqfGD">
            </a>
          </div>
          <div class="column col-lg-2 col-md-2 col-sm-4 col-xs-12 text-center my-2 enamad-logo">
            <img src="#" class="lazyload" referrerpolicy='origin' id='nbqejzpeapfujxlzsizpesgt'
              style='cursor:pointer;'
              onclick='window.open("https:\/\/logo.samandehi.ir/Verify.aspx?id=275190&p=uiwkjyoedshwrfthpfvlobpd", "Popup","toolbar=no, scrollbars=no, location=no, statusbar=no, menubar=no, resizable=0, width=450, height=630, top=30")'
              alt='logo-samandehi - لوگو ساماندهی'
              data-src='https://logo.samandehi.ir/logo.aspx?id=275190&p=odrfyndtujynnbpdbsiylyma' />
          </div>
          <div class="column col-lg-2 col-md-2 col-sm-4 col-xs-12 text-center my-2 zarinpal-logo">
            <script src="https://www.zarinpal.com/webservice/TrustCode" type="text/javascript"></script>
          </div>
        </div>
      </div>
    </footer> --}}

    <footer id="footer" class="p-md-5 pt-4" style="background-color: #252525;">
      <div class="container no-dark">
        <div class=" row no-dark">
          <div class="column col-lg-2 col-md-2 col-sm-4 col-xs-12 text-center my-2 enamad-logo">
            <a referrerpolicy="origin" target="_blank"
              href="https://trustseal.enamad.ir/?id=212458&amp;Code=PmAs0cswBnOXzNOOqfGD">
              <img src="https://Trustseal.eNamad.ir/logo.aspx?id=212458&amp;Code=PmAs0cswBnOXzNOOqfGD"
                class=" lazyloaded" referrerpolicy="origin"
                data-src="https://Trustseal.eNamad.ir/logo.aspx?id=212458&amp;Code=PmAs0cswBnOXzNOOqfGD"
                alt="نماد الکترونیک enamad در صورت اتصال با آی‌پی داخل کشور، نمایش داده خواهد شد."
                style="cursor:pointer;" id="PmAs0cswBnOXzNOOqfGD">
            </a>
          </div>
          <div class="column col-lg-2 col-md-2 col-sm-4 col-xs-12 text-center my-2 enamad-logo">
            <img src="https://logo.samandehi.ir/logo.aspx?id=275190&amp;p=odrfyndtujynnbpdbsiylyma"
              class=" lazyloaded" referrerpolicy="origin" id="nbqejzpeapfujxlzsizpesgt" style="cursor:pointer;"
              onclick="window.open(&quot;https:\/\/logo.samandehi.ir/Verify.aspx?id=275190&amp;p=uiwkjyoedshwrfthpfvlobpd&quot;, &quot;Popup&quot;,&quot;toolbar=no, scrollbars=no, location=no, statusbar=no, menubar=no, resizable=0, width=450, height=630, top=30&quot;)"
              alt="logo-samandehi - لوگو ساماندهی"
              data-src="https://logo.samandehi.ir/logo.aspx?id=275190&amp;p=odrfyndtujynnbpdbsiylyma">
          </div>
          <div class="column col-lg-2 col-md-2 col-sm-4 col-xs-12 text-center my-2 zarinpal-logo">
            <script src="https://www.zarinpal.com/webservice/TrustCode" type="text/javascript"></script>
          </div>
          <div class="contact col-lg-6 col-md-6 col-sm-12 col-xs-12 text-sm-right text-center">
            <h5 class="pt-1 pb-3" style="color: #00aaca;">درباره ما</h5>
            <p class="text-white pl-md-5 text-justify">
              لینداکده یک بستر یادگیری پیشرو است که به هر کس کمک می کند تا کسب و کار ، نرم افزار ، فناوری و
              مهارت های خلاقانه را برای دستیابی به اهداف شخصی و حرفه ای بیاموزد.
            </p>
            <div class="row no-dark">
              <div class="col-12 text-center">
                <ul class="list-inline">
                  <li class="list-inline-item text-white">
                    لینداکده-1400
                  </li>
                  <li class="list-inline-item mx-0">
                    <a href="https://lyndakade.ir/contact-us">
                      <img class="" src="https://img.icons8.com/plasticine/344/apple-phone.png"
                        width="32px" alt="تماس با ما">
                      {{-- <i class="fab fa-phone"></i> --}}
                    </a>
                  </li>
                  <li class="list-inline-item mx-0">
                    <a rel="noreferrer" class="social-icon text-xs-center" target="_blank"
                      href="http://www.Instagram.com/lyndakade.ir">
                      <img class="" src="https://img.icons8.com/plasticine/344/instagram-new--v2.png"
                        width="32px" alt="کانال اینستاگرام">
                      {{-- <i class="fab fa-instagram"></i> --}}
                    </a>
                  </li>
                  <li class="list-inline-item mx-0">
                    <a rel="noreferrer" class="social-icon text-xs-center" target="_blank"
                      href="http://www.T.me/LyndaKadeSupport">
                      <img class="" src="https://img.icons8.com/plasticine/344/telegram-app.png"
                        width="32px" alt="کانال تلگرام">
                      {{-- <i class="fab fa-telegram"></i> --}}
                    </a>
                  </li>
                  <li class="list-inline-item mx-0">
                    <a rel="noreferrer" class="social-icon text-xs-center" target="_blank"
                      href="http://www.Aparat.com/LyndaKade.ir">
                      <img class="" src="https://img.icons8.com/plasticine/344/aparat.png" width="32px"
                        alt="کانال آپارات">
                    </a>
                  </li>
                </ul>
              </div>
              <div class="col-12 text-center">
                <p class="mb-md-0 text-white">کلیه‌ی حقوق این سایت متعلق به لینداکده است.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>

  <div class="modal fade" id="preview-modal" tabindex="-1" role="dialog" aria-labelledby="preview-modal-title"
    aria-hidden="true" style="background-color: #444c;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content text-center">
        <div class="modal-body p-0" id="preview-modal-body">
          {{-- <video src="" controls aria-controls="true"
            style="border-top-left-radius: 3px; border-top-right-radius: 3px;"></video> --}}
          <video class="w-100" playsinline controls aria-controls="true" id="preview-video-player"
            data-poster="" style="border-top-left-radius: 3px; border-top-right-radius: 3px;">
            <source type="video/mp4" src="" size="720" default />
            <track kind="captions" label="فارسی" src="" srclang="fa" default>
          </video>
          <div class="text-right px-2">
            <div>
              <span style="font-size: 1.2rem;" id="preview-modal-title">عنوان دوره</span>
              <a href="#" id="preview-modal-url" style="float: left;" class="btn btn-success mb-2">مشاهده جزئیات</a>
              {{-- <span style="float: left;cursor: auto;" class="btn" id="preview-modal-price">قیمت</span> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="login-register-modal" tabindex="-1" role="dialog"
    aria-labelledby="login-register-modal-title" aria-hidden="true" style="background-color: #444c;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content text-center">
        <div class="modal-body p-0" id="login-register-modal-body">
          <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="login-register-modal-login-tab" data-toggle="tab"
                href="#login-register-modal-login" role="tab" aria-controls="login-register-modal-login"
                aria-selected="true">
                فرم ورود به حساب کاربری
              </a>
              <a class="nav-item nav-link" id="login-register-modal-register-tab" data-toggle="tab"
                href="#login-register-modal-register" role="tab" aria-controls="login-register-modal-register"
                aria-selected="true">
                فرم ثبت نام
              </a>
            </div>
          </nav>
          <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
            <div class="tab-pane fade  show active" id="login-register-modal-login" role="tabpanel"
              aria-labelledby="login-register-modal-login-tab">
              <form id="login-modal-form" method="POST" action="{{ route('login') }}" class="container-fluid">
                @csrf
                @if (request()->has('returnUrl'))
                  <input type="hidden" name="returnUrl" value="{{ request()->get('returnUrl') }}" />
                @endif
                <div class="form-group row">
                  <label for="username" class="col-md-4 col-form-label text-md-left">
                    آدرس ایمیل یا نام کاربری
                  </label>
                  <div class="col-md-5">
                    <input id="username" type="text"
                      class="form-control text-md-right @error('username') is-invalid @enderror" name="username"
                      value="{{ old('username') }}" required autocomplete="username" autofocus>
                    @error('username')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ __($message) }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="password"
                    class="col-md-4 col-form-label text-md-left">{{ __('msg.Password') }}</label>
                  <div class="col-md-5">
                    <input id="password" type="password"
                      class="form-control text-md-right @error('password') is-invalid @enderror" name="password"
                      required autocomplete="current-password">
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ __($message) }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                      <label class="form-check-label" for="remember">
                        {{ __('msg.Remember Me') }}
                      </label>
                    </div>
                    @if (Route::has('password.request'))
                      <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('msg.Forgot Your Password?') }}
                      </a>
                    @endif
                  </div>
                </div>
                <div class="form-group row mb-0">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                      {{ __('msg.Login') }}
                    </button>
                  </div>
                </div>
              </form>
            </div>
            <div class="tab-pane fade" id="login-register-modal-register" role="tabpanel"
              aria-labelledby="login-register-modal-register-tab">
              <form id="register-modal-form" method="POST" action="{{ route('register') }}" class="container-fluid">
                @csrf

                <div class="form-group row">

                  <div class="col-md-6 col-sm-12">
                    <label for="name">{{ __('msg.Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                      value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ __($message) }}</strong>
                      </span>
                    @enderror
                  </div>


                  <div class="col-md-6 col-sm-12">
                    <label for="firstName">{{ __('msg.FirstName') }}</label>
                    <input id="firstName" type="text" class="form-control @error('firstName') is-invalid @enderror"
                      name="firstName" value="{{ old('firstName') }}" required autocomplete="firstName">

                    @error('firstName')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ __($message) }}</strong>
                      </span>
                    @enderror
                  </div>

                </div>
                <div class="form-group row">
                  <div class="col-md-6 col-sm-12">
                    <label for="lastName">{{ __('msg.LastName') }}</label>
                    <input id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror"
                      name="lastName" value="{{ old('lastName') }}" required autocomplete="lastName">

                    @error('lastName')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ __($message) }}</strong>
                      </span>
                    @enderror
                  </div>


                  <div class="col-md-6 col-sm-12">
                    <label for="mobile">{{ __('msg.Mobile') }}</label>
                    <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror"
                      name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile">

                    @error('mobile')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ __($message) }}</strong>
                      </span>
                    @enderror
                  </div>

                </div>
                <div class="form-group row">

                  <div class="col-md-6 col-sm-12">
                    <label for="username">{{ __('msg.UserName') }}</label>
                    <input type="text"
                      class="register-username-modal form-control text-md-right @error('username') is-invalid @enderror"
                      name="username" value="{{ old('username') }}" required autocomplete="username">

                    @error('username')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ __($message) }}</strong>
                      </span>
                    @enderror
                  </div>


                  <div class="col-md-6 col-sm-12">
                    <label for="email">{{ __('msg.E-Mail Address') }}</label>
                    <input id="email" type="email"
                      class="register-email-modal form-control text-md-right @error('email') is-invalid @enderror"
                      name="email" value="{{ old('email') }}" required autocomplete="email">
                    <small class="form-text text-muted">
                      لطفا از درستی آدرس ایمیل خود اطمینان حاصل نمایید، زیرا در صورت بروز رسانی دوره های خریداری شده
                      شما،
                      اطلاعیه بروزرسانی به ایمیل شما ارسال خواهد شد، که میتوانید آن را رایگان دانلود کنید.
                    </small>
                    @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ __($message) }}</strong>
                      </span>
                    @enderror
                  </div>

                </div>
                <div class="form-group row">
                  <div class="col-md-6 col-sm-12">
                    <label for="password">{{ __('msg.Password') }}</label>

                    <input type="password" class="form-control text-md-right @error('password') is-invalid @enderror"
                      name="password" required autocomplete="new-password">

                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ __($message) }}</strong>
                      </span>
                    @enderror
                  </div>

                  <div class="col-md-6 col-sm-12">
                    <label for="password-confirm">{{ __('msg.Confirm Password') }}</label>

                    <input id="password-confirm" type="password" class="form-control text-md-right"
                      name="password_confirmation" required autocomplete="new-password">
                  </div>

                </div>
                <div class="form-group row mb-0">
                  <div
                    class="col-md-12 align-self-center {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                    {!! app('captcha')->display() !!}
                    @if ($errors->has('g-recaptcha-response'))
                      <span class="help-block">
                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                      </span>
                    @endif
                  </div>

                  <div dType="register" class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">
                      {{ __('msg.Register') }}
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="course-request-modal" tabindex="-1" role="dialog"
    aria-labelledby="course-request-modal-title" aria-hidden="true" style="background-color: #444c;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content text-center">
        <div class="modal-body p-0" id="course-request-modal-body">
          <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="course-request-link-tab" data-toggle="tab"
                href="#course-request-link" role="tab" aria-controls="course-request-link" aria-selected="true">
                از طریق لینک دوره
              </a>
              <a class="nav-item nav-link" id="course-request-author-tab" data-toggle="tab"
                href="#course-request-author" role="tab" aria-controls="course-request-author" aria-selected="true">
                از طریق نام دوره و نام مدرس
              </a>
            </div>
          </nav>
          <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
            <div class="tab-pane fade  show active" id="course-request-link" role="tabpanel"
              aria-labelledby="course-request-link-tab">
              <form id="course-request-method-2" method="POST" action="{{ route('demands.store') }}">
                @csrf
                <div class="form-group row">
                  <label for="link" class="col-md-4 col-form-label text-md-left">لینک درس در لینکدین</label>
                  <div class="col-md-6">
                    <input id="link" type="url" class="form-control @error('link') is-invalid @enderror" name="link"
                      value="{{ old('link') }}" autocomplete="link">
                    @error('link')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group text-center m-0">
                  <button type="submit" class="btn btn-primary">ارسال</button>
                </div>
              </form>
            </div>
            <div class="tab-pane fade" id="course-request-author" role="tabpanel"
              aria-labelledby="course-request-author-tab">
              <form id="course-request-method-1" method="POST" action="{{ route('demands.store') }}">
                @csrf
                <div class="form-group row">
                  <label for="title" class="col-md-4 col-form-label text-md-left">نام درس</label>
                  <div class="col-md-6">
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                      name="title" autocomplete="title" autofocus>
                    @error('title')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="author" class="col-md-4 col-form-label text-md-left">نام مدرس</label>
                  <div class="col-md-6">
                    <input id="author" type="text" class="form-control @error('author') is-invalid @enderror"
                      name="author" autocomplete="author">
                    @error('author')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group text-center m-0">
                  <button type="submit" class="btn btn-primary">ارسال</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/themify-icons.css') }}" /> --}}
  <link rel="stylesheet" type="text/css"
    href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css" />
  {{-- <script src="https://themify.me/wp-content/plugins/themify-custom-plugins/js/themify.js"></script> --}}

  {{-- <link href="{{ asset('css/googlefont.css') }}" rel="stylesheet" /> --}}

  {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.transitions.css') }}" /> --}}


  {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/lyndacon.css') }}" /> --}}
  {{-- <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}"> --}}

  {{-- <script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script> --}}

  {{-- <script>
        CRISP_RUNTIME_CONFIG = {
            locale : "{{ app()->getLocale() }}"
        };
        window.CRISP_RUNTIME_CONFIG = {
            locale : "{{ app()->getLocale() }}"
        };
    </script>
    <script type="text/javascript">
        window.$crisp=[];
        window.CRISP_WEBSITE_ID="87ad3840-8311-47fb-b849-0eb3e6cc113c";
        (function(){
            d=document;
            s=d.createElement("script");
            s.src="https://client.crisp.chat/l.js";
            s.async=1;
            d.getElementsByTagName("head")[0].appendChild(s);
            })();
    </script> --}}

  <!---start GOFTINO code--->
  <script type="text/javascript">
    ! function() {
      var i = "Xj7nlW",
        a = window,
        d = document;

      function g() {
        var g = d.createElement("script"),
          s = "https://www.goftino.com/widget/" + i,
          l = localStorage.getItem("goftino_" + i);
        g.async = !0, g.src = l ? s + "?o=" + l : s;
        d.getElementsByTagName("head")[0].appendChild(g);
      }
      "complete" === d.readyState ? g() : a.attachEvent ? a.attachEvent("onload", g) : a.addEventListener("load", g, !1);
    }();
  </script>
  <!---end GOFTINO code--->
  @if (Session::has('message'))
    <script>
      toastr.options.rtl = true;
      toastr.options.positionClass = 'toast-bottom-left';
      toastr.info("{{ Session::get('message') }}");

      //   var alertType = {!! json_encode(Session::get('alert-type', 'info')) !!};
      //   var alertMessage = {!! json_encode(Session::get('message')) !!};
      //   var alerter = toastr[alertType];

      //   if (alerter) {
      //     alerter(alertMessage);
      //   } else {
      //     toastr.error("toastr alert-type " + alertType + " is unknown");
      //   }
    </script>
  @endif
  @if (Session::has('error'))
    <script>
      toastr.options.rtl = true;
      toastr.options.positionClass = 'toast-bottom-left';
      toastr.error("{{ Session::get('error') }}");
    </script>
  @endif

  <style>
    .zarinpal-logo img {
      max-height: 120px;
    }

    .enamad-logo img {
      max-width: 110px;
      max-height: 120px;
      background-color: #fff;
      padding: 5px;
      border-radius: 8px;
      margin: 2px;
    }

    .twitter-typeahead {
      width: 100% !important;
      height: 100% !important;
    }

    /*
    for courses
    */
    .search-result-item[data-type][data-type="0"] .icon {
      display: inline-block !important;
      background-position: -5px -35px;
      background-image: url("{{ asset('image/autocomplete-type-icon-sprite.png') }}");
    }


    /*
    for authors
    */
    .search-result-item[data-type][data-type="5"] .icon {
      display: inline-block !important;
      background-position: -5px -155px;
      background-image: url("{{ asset('image/autocomplete-type-icon-sprite.png') }}");
    }


    /*
    for learn path
    */
    .search-result-item[data-type][data-type="6"] .icon {
      display: inline-block !important;
      background-position: -5px -184px;
      background-image: url("{{ asset('image/autocomplete-type-icon-sprite.png') }}");
    }

    /*
    for tracks
    */
    .search-result-item[data-type][data-type="2"] .icon {
      display: inline-block !important;
      background-position: -5px -95px;
      background-image: url("{{ asset('image/autocomplete-type-icon-sprite.png') }}");
    }

    .search-result-item[data-type] .icon {
      display: none;
      content: '';
      background-repeat: no-repeat;
      vertical-align: middle;
      width: 26px;
      height: 23px;
      position: absolute;
    }

    .search-result-item span {
      font-style: normal;
      font-weight: 700;
    }

    .tt-menu.tt-open {
      width: 100% !important;
    }

  </style>

  {{-- <script>
    jQuery_1_11_3(document).ready(function() {
      var engine = new Bloodhound({
        remote: {
          url: '/search?q=%QUERY%',
          wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
      });

      jQuery_1_11_3('.search-input').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
      }, {
        source: engine.ttAdapter(),
        name: 'searchList',
        templates: {
          empty: [
            '<div class="list-group search-results-dropdown"><div class="list-group-item">نتیجه ای یافت نشد.</div></div>'
          ],
          header: [
            '<div class="list-group search-results-dropdown">'
          ],
          suggestion: function(data) {
            console.log("search data: ", data);

            function create_row(href, data_type, title1, title2) {
              return `<li class="search-result-item" data-type="${data_type}">
                            <a href="${href}" class="list-group-item px-1 py-1"
                                role="option" aria-selected="false">
                                <span class="icon" aria-hidden="true"></span>
                                <span class="term">
                                    <div style="margin-right: 30px;">
                                        ${title1}
                                    </div>
                                    ${title2 ? `
                                        <div style="margin-right: 30px;">
                                            ${title2}
                                        </div>
                                        ` : ''}
                                </span>
                            </a>
                        </li>`;

              // return `
              //     <a href="${href}" class="list-group-item" data-type="${data_type}">
              //         <div>
              //             ${title1}
              //         </div>
              //         ${title2 ? `
              //             <div>
              //                 ${title2}
              //             </div>
              //             ` : ''}
              //     </a>
              // `;
            }

            var href = ''
            if (data.views) {
              href = '{{ route('courses.show', [':subject_slug', ':slug', ':id', rand(0, 20)]) }}';
              href = href.replace(':subject_slug', data.subjects[0].slug)
                .replace(':slug', data.slug)
                .replace(':id', data.id);
              return create_row(href, '0', data.title, data.titleEng);
            }

            if (data.specialty) {
              href = '{{ route('authors.show', [':slug', ':id']) }}';
              href = href.replace(':slug', data.slug)
                .replace(':id', data.id);
              return create_row(href, '5', data.name, null);
            }

            if (data.price) {
              href = '{{ route('learn.paths.show', [':library_slug', ':slug']) }}';
              href = href.replace(':library_slug', data.library.slug)
                .replace(':slug', data.slug);
              return create_row(href, '6', data.title, data.titleEng);
            }
            return 'nothing to show';
          }
        }
      })
    });

  </script> --}}

  <script src="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.7.2/plyr.js"
    integrity="sha512-OlPa3CLz34wRV8+Aq+Zn39Nc5FNHJPPYLeh/ZXjapjWIQl21a4f6gDM6futqnCIF0IQHEQUf3JJkDdLw+mxglA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  @yield('script_body')
  @stack('js')


  <script>
    function toggleDropdown(e) {
      const _d = $(e.target).closest('.dropdown'),
        _m = $('.dropdown-menu', _d);
      setTimeout(function() {
        const shouldOpen = e.type !== 'click' && _d.is(':hover');
        _m.toggleClass('show', shouldOpen);
        _d.toggleClass('show', shouldOpen);
        $('[data-toggle="dropdown"]', _d).attr('aria-expanded', shouldOpen);
      }, e.type === 'mouseleave' ? 200 : 0);
    }

    $('body')
      .on('mouseenter mouseleave', '.dropdown', toggleDropdown)
      .on('click', '.dropdown-menu a', toggleDropdown);

    $(function() {
      var wrapper_wide = document.querySelector('.wrapper-wide');
      var sun_class = 'fa-sun';
      var moon_class = 'fa-moon';
      var dark_theme_class = 'dark-theme';


      document.querySelectorAll('.theme-toggle').forEach((toggle_icon) => {
        if (wrapper_wide.classList.contains(dark_theme_class)) {
          $(toggle_icon).html(`<i class="fa fa-sun"  style="font-size: 28px;margin: 10px;"></i>`);
        } else {
          $(toggle_icon).html(`<i class="fa fa-moon"  style="font-size: 28px;margin: 10px;"></i>`);
        }

        toggle_icon.addEventListener('click', function() {
          if (wrapper_wide.classList.contains(dark_theme_class)) {
            $(toggle_icon).html(`<i class="fa fa-moon"  style="font-size: 28px;margin: 10px;"></i>`);
            // toggle_icon.querySelector('i').classList.add(moon_class);
            // toggle_icon.querySelector('i').classList.remove(sun_class);

            wrapper_wide.classList.remove(dark_theme_class);

            setCookie('theme', 'light');
          } else {
            $(toggle_icon).html(`<i class="fa fa-sun"  style="font-size: 28px;margin: 10px;"></i>`);
            // toggle_icon.querySelector('i').classList.add(sun_class);
            // toggle_icon.querySelector('i').classList.remove(moon_class);

            wrapper_wide.classList.add(dark_theme_class);

            setCookie('theme', 'dark');
          }
        });
      });


      function setCookie(name, value) {
        var d = new Date();
        d.setTime(d.getTime() + (365 * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
      }
    });

    $(function() {
      $('.form-control.search-input.tt-input').on('keyup', function(event) {
        if (event.keyCode == 13) {
          $('#submenu-search').submit();
        }
      });
    });
    $(function() {
      $('#cart-list').dropdown();
    });
    $(function() {
      $('#navbarUser').dropdown();
      // $('.toast').toast({
      //     delay: 3500,
      // });
      // $('.toast').toast('show');
    });

    function perToEng(str) {
      var
        persianNumbers = [/۰/g, /۱/g, /۲/g, /۳/g, /۴/g, /۵/g, /۶/g, /۷/g, /۸/g, /۹/g],
        arabicNumbers = [/٠/g, /١/g, /٢/g, /٣/g, /٤/g, /٥/g, /٦/g, /٧/g, /٨/g, /٩/g];
      if (typeof str === 'string') {
        for (var i = 0; i < 10; i++) {
          str = str.replace(persianNumbers[i], i).replace(arabicNumbers[i], i);
        }
      }
      return str;
    }

    function engToPer(n) {
      const farsiDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

      return n
        .toString()
        .replace(/\d/g, x => farsiDigits[x]);
    }

    const preview_video_player = new Plyr("#preview-video-player", {
      title: "",
      controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'captions', 'settings', 'pip',
        'airplay', 'fullscreen'
      ],
      settings: ['captions', 'quality', 'speed', 'loop'],
      invertTime: true,
      toggleInvert: true,
      captions: {
        active: true,
        language: 'fa',
        update: false
      },
      i18n: {
        restart: 'پخش مجدد',
        rewind: 'برگشت به {seektime}s',
        play: 'پخش',
        pause: 'توقف',
        fastForward: 'به جلو رفتن {seektime}s',
        seek: 'جابجا شدن',
        seekLabel: '{currentTime} از {duration}',
        played: 'پخش شده',
        buffered: 'بافر شده',
        currentTime: 'زمان فعلی',
        duration: 'مدت زمان',
        volume: 'صدا',
        mute: 'بی صدا',
        unmute: 'با صدا',
        enableCaptions: 'فعال کردن زیرنویس',
        disableCaptions: 'غیرفعال کردن زیرنویس',
        download: 'دانلود',
        enterFullscreen: 'فعال کردن تمام صفحه',
        exitFullscreen: 'غیر فعال کردن تمام صفحه',
        frameTitle: '{title}',
        captions: 'زیرنویس‌ها',
        settings: 'تنظیمات',
        pip: 'تصویر-در-تصویر',
        menuBack: 'برگشت به منوی قبلی',
        speed: 'سرعت',
        normal: 'عادی',
        quality: 'کیفیت',
        loop: 'حلقه پخش',
        start: 'شروع',
        end: 'پایان',
        all: 'همه',
        reset: 'بازنشانی',
        disabled: 'غیرفعال',
        enabled: 'فعال',
        advertisement: 'تبلیغات',
        qualityBadge: {
          2160: '4K',
          1440: 'HD',
          1080: 'HD',
          720: 'HD',
          576: 'SD',
          480: 'SD',
        },
      }
    });

    $(document).on('click', '.course-preview-button', function(event) {
      const btn = event.currentTarget.dataset;
      preview_video_player.source = {
        type: "video",
        title: btn.title,
        sources: [{
          src: btn.src,
          type: btn.type,
          size: Number(btn.size)
        }],
        tracks: (btn.dubbed == "1") ? [] : [{
          kind: 'captions',
          label: btn.trackLabel,
          srclang: btn.trackSrclang,
          src: btn.trackSrc,
          default: true,
        }, {
          kind: 'captions',
          label: btn.trackLabelEng,
          srclang: btn.trackSrclangEng,
          src: btn.trackSrcEng,
          default: false,
        }, ],
        poster: btn.poster
      };
    });

    $(function() {
      //   document.querySelectorAll('*[data-price]').forEach(element => {
      //     element.setAttribute('data-price', engToPer(element.getAttribute('data-price')));
      //   });
      $('#preview-modal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        if (button) {
          $('#preview-modal #preview-modal-title').text(button.data('title'));
          document.querySelector('#preview-modal #preview-modal-url').setAttribute('href', button.data('url'));
          // $('#preview-modal-price').text(button.data('price') + ' تومان');
          //   document.querySelector('#preview-modal #preview-modal-body video').setAttribute('src', button.data(
          //     'src'));
          //   document.querySelector('#preview-modal #preview-modal-body video').play();
        } else {
          $('#preview-modal #preview-modal-title').text('');
          //   document.querySelector('#preview-modal #preview-modal-url').setAttribute('href', '');
          // $('#preview-modal-price').text('');
        }
      });
      $('#preview-modal').on('hidden.bs.modal', function() {
        document.querySelector('#preview-modal #preview-modal-body video').setAttribute('src', '');
      });
    });

    function onlyNumberKey(evt) {

      // Only ASCII character in that range allowed
      var ASCIICode = (evt.which) ? evt.which : evt.keyCode
      if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
      return true;
    }

    function validatePhoneNumber(input_str) {
      var re = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
      return re.test(input_str);
    }

    $(function() {
      const form_button_default = `<button type="submit" class="btn btn-primary">ارسال</button>`;
      const form_button_loading = `
      <button class="btn btn-primary" type="button" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        <span class="sr-only">درحال ارسال...</span>
      </button>
      `;
      const form_button_done = `<button type="button" class="btn btn-success" disabled="">ارسال شد.</button>`;

      const formToJSON = elements => [].reduce.call(elements, (data, element) => {
        data[element.name] = element.value;
        return data;
      }, {});
      const form = document.forms['dubbed-form'];
      if (form) {
        form.addEventListener('submit', (event) => {
          event.preventDefault();
          const sub_btn = document.querySelector('#dubbed-form #dubbed-form-submit');
          sub_btn.innerHTML = form_button_loading;

          const data = formToJSON(form.elements);
          // console.log(data);
          const jdata = JSON.stringify(data);
          // console.log(jdata);

          (async () => {
            const rawResponse = await fetch("{{ route('dubbed-join.api') }}", {
              method: 'POST',
              headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
              },
              body: jdata
            });
            const content = await rawResponse.json();
            if (content.status == 'success') {
              form.reset();
              sub_btn.innerHTML = form_button_done;
              setTimeout(() => {
                sub_btn.innerHTML = form_button_default;
              }, 4000);
            } else {
              sub_btn.innerHTML = form_button_default;
            }
            // console.log(content);
          })();
        });
      }

      function prepare_course_req_forms(course_req_form) {
        if (course_req_form) {
          course_req_form.addEventListener('submit', (event) => {
            event.preventDefault();
            const sub_btn = course_req_form.querySelector('button[type="submit"]').parentElement;
            sub_btn.innerHTML = form_button_loading;

            const data = formToJSON(course_req_form.elements);
            if (!(data.link || (data.author && data.title))) {
              toastr.options.rtl = true;
              toastr.options.positionClass = 'toast-top-center';
              toastr.warning('اطلاعات بدرستی وارد نشده‌اند. لطفا دوباره تلاش کنید.')
              sub_btn.innerHTML = form_button_default;
              return false;
            }
            if (data.link) {
              if (!data.link.toLowerCase().includes('/learning/')) {
                toastr.options.rtl = true;
                toastr.options.positionClass = 'toast-top-center';
                toastr.warning('اطلاعات بدرستی وارد نشده‌اند. لطفا دوباره تلاش کنید.')
                sub_btn.innerHTML = form_button_default;
                return false;
              }
            }

            data.isApi = true;
            // console.log("data", data);
            const jdata = JSON.stringify(data);
            // console.log("jdata", jdata);
            // setTimeout(() => {
            //   toastr.options.rtl = true;
            //   toastr.options.positionClass = 'toast-top-center';
            //   toastr.info('درخواست دوره ثبت شده است، از طریق ایمیل به شما اطلاع رسانی خواهد شد.')
            //   course_req_form.reset();
            //   sub_btn.innerHTML = form_button_done;
            //   setTimeout(() => {
            //     sub_btn.innerHTML = form_button_default;
            //   }, 4000);
            // }, 2000);
            (async () => {
              const rawResponse = await fetch("{{ route('demands.store') }}", {
                method: 'POST',
                headers: {
                  'Accept': 'application/json',
                  'Content-Type': 'application/json'
                },
                body: jdata
              });
              //   let cc = await rawResponse.text();
              //   console.log(cc);
              const content = await rawResponse.json();
              if (content.status == 'success') {
                course_req_form.reset();
                sub_btn.innerHTML = form_button_done;
                toastr.options.rtl = true;
                toastr.options.positionClass = 'toast-top-center';
                toastr.info('درخواست دوره ثبت شده است، از طریق ایمیل به شما اطلاع رسانی خواهد شد.')
                setTimeout(() => {
                  sub_btn.innerHTML = form_button_default;
                }, 5000);
              } else {
                toastr.options.rtl = true;
                toastr.options.positionClass = 'toast-top-center';
                toastr.warning('در ارسال اطلاعات مشکلی رخ داده است، مجددا تلاش کنید.')
                sub_btn.innerHTML = form_button_default;
              }
              //   console.log(content);
            })();
          });
        }
      }
      prepare_course_req_forms(document.forms['course-request-method-1']);
      prepare_course_req_forms(document.forms['course-request-method-2']);


      function prepare_login_register_forms(login_register_form) {
        if (login_register_form) {
          login_register_form.addEventListener('submit', (event) => {
            event.preventDefault();
            const sub_btn = login_register_form.querySelector('button[type="submit"]').parentElement;
            sub_btn.innerHTML = form_button_loading;
            var url = '',
              msg = '',
              isRegisterForm = (sub_btn.getAttribute('dType') == 'register');
            if (isRegisterForm) {
              url = "{{ route('register') }}";
              msg = "ثبت نام با موفقیت انجام شد.";
            } else {
              url = "{{ route('login') }}";
              msg = "ورود با موفقیت انجام شد.";
            }

            const data = formToJSON(login_register_form.elements);
            data.isApi = true;
            // console.log("data", data);
            const jdata = JSON.stringify(data);
            // console.log("jdata", jdata);
            // setTimeout(() => {
            //   toastr.options.rtl = true;
            //   toastr.options.positionClass = 'toast-top-center';
            //   toastr.info('درخواست دوره ثبت شده است، از طریق ایمیل به شما اطلاع رسانی خواهد شد.')
            //   login_register_form.reset();
            //   sub_btn.innerHTML = form_button_done;
            //   setTimeout(() => {
            //     sub_btn.innerHTML = form_button_default;
            //   }, 4000);
            // }, 2000);
            (async () => {
              const rawResponse = await fetch(url, {
                method: 'POST',
                headers: {
                  'Accept': 'application/json',
                  'Content-Type': 'application/json'
                },
                body: jdata
              });
              //   let cc = await rawResponse.text();
              //   console.log(cc);
              const content = await rawResponse.json();
              if (content.status == 'success') {
                // login_register_form.reset();
                sub_btn.innerHTML = form_button_done;
                toastr.options.rtl = true;
                toastr.options.positionClass = 'toast-top-center';
                toastr.info(content.message)
                setTimeout(() => {
                  window.location.reload();
                }, 1000);
              } else {
                toastr.options.rtl = true;
                toastr.options.positionClass = 'toast-top-center';
                // toastr.warning('در ارسال اطلاعات مشکلی رخ داده است، مجددا تلاش کنید.')
                toastr.warning(content.message);
                sub_btn.innerHTML = form_button_default;
                if (isRegisterForm) {
                  login_register_form.querySelector('button[type="submit"]').textContent = 'ثبت نام';
                } else {
                  login_register_form.querySelector('button[type="submit"]').textContent = 'ورود';
                }
              }
              //   console.log(content);
            })();
          });
        }
      }
      prepare_login_register_forms(document.forms['register-modal-form']);
      prepare_login_register_forms(document.forms['login-modal-form']);

      var username_email_keyup = (event) => {
        let target = event.target,
          targetName = event.target.getAttribute('name');
        console.log(target, targetName);
      }
      $(document).on('keyup', '.register-username-modal', username_email_keyup);
      $(document).on('keyup', '.register-email-modal', username_email_keyup);
    });
  </script>
  @if (Auth::check())
    <script>
      window.addEventListener('goftino_ready', function() {
        Goftino.setUser({
          email: '{{ Auth::user()->email }}',
          name: '{{ Auth::user()->name }}',
          about: '{{ Auth::user()->username }}',
          phone: '{{ Auth::user()->mobile }}',
          avatar: '{{ fromDLHost(Auth::user()->avatar) }}',
          tags: '',
          forceUpdate: true
        });
      });
    </script>
  @endif
  {{-- <script type="text/javascript" src="{{ asset('js/my-js.js') }}"></script> --}}
  {{-- <p>
    @php
        $expire_time = \App\Notification::where('expire', '>=', date(now()))->first()->expire;
        $expire_time = strtotime($expire_time);

        $current_time = \Carbon\Carbon::now()->timestamp;

        echo $expire_time - $current_time;

    @endphp
  </p> --}}
</body>

</html>
