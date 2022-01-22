@php
session(['redirectToAfterLogin' => url()->previous()]);
@endphp
<!DOCTYPE html>
<html dir="rtl" lang="fa">
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->isLocale('fa') ? 'rtl' : 'ltr' }}"> --}}

<head>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-5V9HN76');</script>
    <!-- End Google Tag Manager -->

  <meta charset="UTF-8" />
  <meta name="format-detection" content="telephone=no" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

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

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  {{-- <link href="{{ mix('css/app.css') }}" rel="stylesheet"> --}}

  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />

  {{-- <link href="{{ asset('css/font-awesome/all.css') }}" rel="stylesheet" /> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.6.0/css/all.min.css" integrity="sha512-ykRBEJhyZ+B/BIJcBuOyUoIxh0OfdICfHPnPfBy7eIiyJv536ojTCsgX8aqrLQ9VJZHGz4tvYyzOM0lkgmQZGw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.6.0/js/all.min.js" integrity="sha512-kWTrl8apDL/aScTYauVsRnGkZv4n7JpH03mIdTmiELoAvAT+CGmfBQx03EMkTT34f5jvyY0DRa/M/it7iecBKw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  {{-- <link href="{{ asset('css/toastr.css') }}" rel="stylesheet"> --}}
  {{-- <script src="{{ asset('js/toastr.min.js') }}"></script> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <link rel="stylesheet" type="text/css" href="{{ asset('css/fonts.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('css/icons.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('css/my-stylesheet.css') }}" />

  {{-- <script async src="{{ asset('js/lazysizes.min.js') }}"></script> --}}
  <script async src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" integrity="sha512-q583ppKrCRc7N5O0n2nzUiJ+suUv7Et1JGels4bXOaMFQcamPk9HjdUknZuuFjBNs7tsMuadge5k9RzdmO+1GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{ mix('js/all.js') }}"></script>

  @yield('script_head')
  @stack('css_head')

  @csrf

    <style>
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

        .fab-container:hover  .sub-button:nth-child(5) {
            transform: translateY(-260px);
        }

        .fab-container:hover  .sub-button:nth-child(6) {
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
            bottom: 0; left: 0;
            height: 35px; width: 35px;
            background-color: inherit;
            border-radius: 0 0 10px 0;
            z-index: -1;
        }
        .fab-container .fab-content {
            display: flex;
            align-items: center; justify-content: center;
            height: 100%; width: 100%;
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
            z-index:200;
        }
        .fab-container .sub-button:hover {
            cursor: pointer;
        }
    </style>

</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5V9HN76"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

  <div class="wrapper-wide" style="    box-shadow: 0 0 4px rgba(0,0,0,.1);
    background: repeat-x #f7f7f7;
    background-image: -webkit-linear-gradient(top,#f7f7f7 0,#e5e5e5 100%);
    background-image: -o-linear-gradient(top,#f7f7f7 0,#e5e5e5 100%);
    background-image: linear-gradient(to bottom,#f7f7f7 0,#e5e5e5 100%);">
    {{-- @if (\App\Notification::where('expire', '>=', date(now()))->count() > 0)
        <div class="w-100 " style="height: 190px; background: url(https://lyndakade.ir/yalda.webp)  no-repeat center center; -webkit-background-size: 100% 100%; -moz-background-size: 100% 100%; -o-background-size: 100% 100%; background-size: 100% 100%; position: relative;">
            <div style="position: absolute;bottom: 5px;" class="p-1 px-2 text-center w-100">
            <span style="background-color: #fff; border-radius: 5px; font-size: 14px;" class="p-1 px-2 text-center w-100">
                <span id="yalda-counter">

                </span>
                تا پایان تخفیفات یلدایی
            </span>
            </div>
            <script>

                function engToPer(n) {
                    const farsiDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

                    return n
                        .toString()
                        .replace(/\d/g, x => farsiDigits[x]);
                }

                var countDownDate = new Date("Dec 25, 2021 00:00:00").getTime();
                var x = setInterval(function() {
                var now = new Date().getTime();
                var distance = countDownDate - now;
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                if(days == 0)
                    days = '';
                else {
                    days = engToPer(days) + " روز ";
                    if (hours || minutes || seconds){
                    days += 'و ';
                    }
                }
                if(hours == 0)
                    hours = '';
                else{
                    hours = engToPer(hours) + " ساعت ";
                    if (minutes || seconds){
                    hours += 'و ';
                    }
                }
                if(minutes == 0)
                    minutes = '';
                else{
                    minutes = engToPer(minutes) + " دقیقه ";
                    if (seconds){
                    minutes += 'و ';
                    }
                }
                if(seconds == 0)
                    seconds = '';
                else{
                    seconds = engToPer(seconds) + " ثانیه";
                }
                document.getElementById("yalda-counter").innerHTML = days + hours + minutes + seconds;
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("yalda-counter").innerHTML = "EXPIRED";
                }
                }, 700);
            </script>
        </div>
    @endif --}}
{{-- <div class="fab-container">
  <div class="fab shadow">
    <div class="fab-content">
      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" style="-ms-transform: rotate(360deg);-webkit-transform: rotate(360deg);transform: rotate(360deg);height: 50px;" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M21 12.22C21 6.73 16.74 3 12 3c-4.69 0-9 3.65-9 9.28c-.6.34-1 .98-1 1.72v2c0 1.1.9 2 2 2h1v-6.1c0-3.87 3.13-7 7-7s7 3.13 7 7V19h-8v2h8c1.1 0 2-.9 2-2v-1.22c.59-.31 1-.92 1-1.64v-2.3c0-.7-.41-1.31-1-1.62z" fill="white"></path><circle cx="9" cy="13" r="1" fill="white"></circle><circle cx="15" cy="13" r="1" fill="white"></circle><path d="M18 11.03A6.04 6.04 0 0 0 12.05 6c-3.03 0-6.29 2.51-6.03 6.45a8.075 8.075 0 0 0 4.86-5.89c1.31 2.63 4 4.44 7.12 4.47z" fill="white"></path></svg>
    </div>
  </div>
  <div class="sub-button shadow" style="
    background-color: #0d0;
">
    <a href="https://wa.me/+989910510634" target="_blank" dideo-checked="true">
      <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" fill="white"></path></svg>
    </a>
  </div>
  <div class="sub-button shadow" style="
    background-color: #0088cc;
">
    <a href="https://t.me/lyndakadeSupport" target="_blank" dideo-checked="true">
      <svg width="32" height="32" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path id="telegram-5" d="M12,0c-6.627,0 -12,5.373 -12,12c0,6.627 5.373,12 12,12c6.627,0 12,-5.373 12,-12c0,-6.627 -5.373,-12 -12,-12Zm0,2c5.514,0 10,4.486 10,10c0,5.514 -4.486,10 -10,10c-5.514,0 -10,-4.486 -10,-10c0,-5.514 4.486,-10 10,-10Zm2.692,14.889c0.161,0.115 0.368,0.143 0.553,0.073c0.185,-0.07 0.322,-0.228 0.362,-0.42c0.435,-2.042 1.489,-7.211 1.884,-9.068c0.03,-0.14 -0.019,-0.285 -0.129,-0.379c-0.11,-0.093 -0.263,-0.12 -0.399,-0.07c-2.096,0.776 -8.553,3.198 -11.192,4.175c-0.168,0.062 -0.277,0.223 -0.271,0.4c0.006,0.177 0.125,0.33 0.296,0.381c1.184,0.354 2.738,0.847 2.738,0.847c0,0 0.725,2.193 1.104,3.308c0.047,0.139 0.157,0.25 0.301,0.287c0.145,0.038 0.298,-0.001 0.406,-0.103c0.608,-0.574 1.548,-1.461 1.548,-1.461c0,0 1.786,1.309 2.799,2.03Zm-5.505,-4.338l0.84,2.769l0.186,-1.754c0,0 3.243,-2.925 5.092,-4.593c0.055,-0.048 0.062,-0.13 0.017,-0.188c-0.045,-0.057 -0.126,-0.071 -0.188,-0.032c-2.143,1.368 -5.947,3.798 -5.947,3.798Z" fill="white"></path></svg>
    </a>
  </div>
  <div class="sub-button shadow" style="
    background-color: #B23121;
">
    <a href="https://lyndakade.ir/contact-us" target="_blank" dideo-checked="true">
      <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path d="M12 2.02c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm0 12.55l-5.992-4.57h11.983l-5.991 4.57zm0 1.288l-6-4.629v6.771h12v-6.771l-6 4.629z" fill="white"></path></svg>
    </a>
  </div>

</div> --}}

    @include('go-to-top-btn')
    {{-- <div class="navbar sticky-top navbar-expand-md navbar-dark bg-dark shadow-sm" style="padding: 0!important;">
      <div class="container">
        <a class="navbar-brand" href="{{ route('root.home') }}">
          <img draggable="false" class="img-logo m-0 p-0" src="{{ asset('image/logoedit2.png') }}" title="لینداکده"
            alt="لینداکده" />
          <span class="hidden-md hidden-lg">لیندا کده</span>
        </a>
        <button class="btn btn-mobile hidden-sm hidden-md hidden-lg" data-toggle="collapse"
          data-target=".nav-main-collapse">
          <i class="fa fa-bars" style="color: white"></i>
        </button>
        <div class="collapse navbar-collapse nav-main-collapse">
          <ul class="navbar-nav">
            <li class="nav-item dropright" id="navbarLibrary">
              <a id="navbarLibraryButton" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                کتابخانه <span class="caret"></span>
              </a>
              @php
                $libraries = \App\Library::with(['subjects', 'software', 'paths'])->get();
              @endphp
              <div class="dropdown-menu container-fluid bg-transparent border-0">
                <div class="row bg-transparent dropdown-menu-content">
                  <div class="col-sm-4 col-12 dropdown-title-bg">
                    <ul id="libraries-sub-menu">
                      @foreach ($libraries as $library)
                        <li class="dropdown-item dropdown-title" data-id="tab-{{ $library->id }}">
                          <a class="" style="color: #fff;"
                            href="{{ route('home.show', [$library->slug, $library->id]) }}">
                            <i class="lyndacon cat-{{ $library->slug }} category-icons"
                              title="{{ $library->title }}" aria-hidden="true"></i>
                            {{ $library->title }}
                          </a>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                  <div class="col-sm-8 hidden-xs dropdown-content-bg">
                    @foreach ($libraries as $library)
                      <div class="row dropdown-content{{ $loop->first ? ' active' : '' }}"
                        id="tab-{{ $library->id }}">
                        <div class="col-md-4">
                          <h5>دسته ها</h5>
                          <ul>
                            @foreach ($library->subjects->sortByDesc(function ($item) {
            return count($item->courses);
        })->take(7)
    as $subject)
                              <li class="dropdown-item dropdown-content-item">
                                <a href="{{ route('home.show', [$subject->slug, $subject->id]) }}">
                                  {{ $subject->title }}
                                </a>
                              </li>
                            @endforeach
                            <li class="dropdown-item dropdown-content-item">
                              <a href="{{ route('home.show', [$library->slug, $library->id]) }}">
                                موارد بیشتر
                              </a>
                            </li>
                          </ul>
                        </div>
                        <div class="col-md-4">
                          <h5>نرم افزارها</h5>
                          <ul>
                            @foreach ($library->software->sortByDesc(function ($item) {
            return count($item->courses);
        })->take(7)
    as $software)
                              <li class="dropdown-item dropdown-content-item">
                                <a href="{{ route('home.show', [$software->slug, $software->id]) }}">
                                  {{ $software->title }}
                                </a>
                              </li>
                            @endforeach
                            <li class="dropdown-item dropdown-content-item">
                              <a href="{{ route('home.show', [$library->slug, $library->id]) }}">
                                موارد بیشتر
                              </a>
                            </li>
                          </ul>
                        </div>
                        <div class="col-md-4">
                          <h5>مسیرهای آموزشی</h5>
                          <ul>
                            @foreach ($library->paths->take(5) as $path)
                              <li class="dropdown-item dropdown-content-item">
                                <a href="{{ route('learn.paths.show', [$path->slug]) }}">
                                  {{ $path->title }}
                                </a>
                              </li>
                            @endforeach
                            <li class="dropdown-item dropdown-content-item">
                              <a href="{{ route('learn.paths.show_category', [$library->slug]) }}">
                                موارد بیشتر
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </li>

            <li class="nav-item">
              <form id="submenu-search" name="topsrch" class="typeahead navbar-form" role="search"
                action="{{ route('search') }}">
                <div class="form-group">
                  <input type="search" name="q" class="form-control search-input" id="header-search-field"
                    role="combobox" value="{{ $q ?? '' }}"
                    style="font-size: 14px; border: 0; text-align: right; padding: 0; padding-right: 5px;"
                    placeholder="نرم افزار یا مهارتی که میخواهید یاد بگیرید را جستجو کنید" autocomplete="off" />
                </div>
              </form>
            </li>

            <li class="nav-item">
              <!-- Right Side Of Navbar -->
              <ul class="navbar-nav login-in-header">
                <!-- Authentication Links -->
                @if (Auth::check())

                  <li class="nav-item dropdown">
                    <a class="nav-link" id="cart-list" data-toggle="dropdown" role="button" aria-expanded="false">
                      <img class="justify-content-center" src="{{ asset('smart-cart.png') }}" width="18" height="18">
                    </a>
                    <div class="dropdown-menu dropdown-cart dropdown-menu-center p-1" role="menu" id="cart-list-item"
                      style="width: 400px!important;">
                      @include('carts.partials._cart_list')
                    </div>
                  </li>

                  <li class="nav-item dropdown" style="width: fit-content">
                    <a id="navbarUser" class="nav-link" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false">
                      <span class="account-name">سلام {{ Auth::user()->name }}
                      </span>
                      <div class="photo">
                        <img src="#" class="lazyload" data-src="{{ fromDLHost(Auth::user()->avatar) }}"
                          alt="{{ __('Profile Photo') }}">
                      </div>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="navbarUser">
                      @if (Auth::user()->isAdmin())
                        <li>
                          <a class="dropdown-item"
                            href="{{ route('voyager.dashboard') }}">{{ __('msg.Dashboard') }}</a>
                        </li>
                      @else
                        <li>
                          <a class="dropdown-item" href="{{ route('courses.mycourses') }}">دروس خریداری شده</a>
                        </li>
                      @endif
                      <li>
                        <a class="dropdown-item" href="{{ route('my-profile') }}">{{ __('msg.Profile') }}</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                          {{ __('msg.Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                        </form>
                      </li>
                    </ul>
                  </li>
                @else
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('login', ['returnUrl'=>request()->url()]) }}">{{ __('msg.Login') }}</a>
                  </li>
                  @if (Route::has('register'))
                    <li class="nav-item">
                      <a class="nav-link" style="background-color: #008cc9;"
                        href="{{ route('register') }}">{{ __('msg.Register') }}</a>
                    </li>
                  @endif
                @endif

              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div> --}}
    <style>
        nav.navbar ul li a {
            position: relative !important;
        }
    </style>
    {{-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100 py-0" @if(app()->isLocal('en')) dir="ltr" @endif> --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100 py-0">
      <a class="navbar-brand mb-1" href="https://lyndakade.ir">
        <img draggable="false" class="img-logo m-0 p-0" src="https://lyndakade.ir/image/logoedit2.png" title="لینداکده"
          alt="لینداکده - LyndaKade - Lynda Kade - LinkedIN" style="width: 60px; height: 55px;">
        <span class="hidden-md hidden-lg">لیندا کده</span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link px-md-1" href="{{ route('root.home') }}">صفحه اصلی</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle px-md-1" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              کتابخانه
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              @foreach (\App\Library::get() as $library)
                <a class="dropdown-item text-center" href="{{ route('home.show', [$library->slug]) }}">
                  <i class="category-icons" aria-hidden="true">
                    @if($library->slug == "business")
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" width="24" height="24" focusable="false">
                        <path d="M5 19h16v2H4a1 1 0 01-1-1V3h2v16zM20 3.1l-5 3.11 2.17 1.17-2.48 4.52-3.26-1.75a1.2 1.2 0 00-1.62.48l-3.12 5.74 1.65.9 2.78-5.21 3.28 1.79a1.2 1.2 0 001.6-.48l2.76-5.11L21 9.46V3.67a.67.67 0 00-1-.57z"></path>
                      </svg>
                      @elseif($library->slug == "creative")
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" width="24" height="24" focusable="false">
                        <path d="M21.71 5L19 2.29a1 1 0 00-1.41 0L4 15.85 2 22l6.15-2L21.71 6.45a1 1 0 00.29-.74 1 1 0 00-.29-.71zM6.87 18.64l-1.5-1.5L15.92 6.57l1.5 1.5zM18.09 7.41l-1.5-1.5 1.67-1.67 1.5 1.5zm-11-6l4.38 4.38-1.37 1.3-3.76-3.75-3 3 1.5 1.5 1.5-1.5.71.71-1.5 1.5 1.54 1.55-1.32 1.33-4.38-4.38a1 1 0 010-1.41l4.25-4.25a1 1 0 011.41 0zm15.56 17l-4.24 4.24a1 1 0 01-1.41 0l-4.38-4.38 1.33-1.33 1.55 1.55 1.5-1.5.71.71-1.5 1.5 1.5 1.5 3-3-3.8-3.8 1.33-1.33 4.38 4.38a1 1 0 01-.01 1.41z"></path>
                      </svg>
                      @else
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" width="24" height="24" focusable="false">
                        <path d="M20 6v12H4V6h16m1-2H3a1 1 0 00-1 1v14a1 1 0 001 1h18a1 1 0 001-1V5a1 1 0 00-1-1zM7.37 16l3.33-3.36a1 1 0 000-1.42L7.46 8 6 9.34l2.54 2.56L6 14.62 7.33 16h.04zM18 14h-6v2h6v-2z"></path>
                      </svg>
                    @endif
                  </i>

                  {{ $library->title }}
                  <br>
                  <small>{{ $library->titleEng }}</small>
                </a>
              @endforeach
            </div>
          </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle px-md-1" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                مسیرهای آموزشی
                </a>
                <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink1">

                @foreach (\App\Library::get() as $lib)
                    <a class="dropdown-item  text-center" style="color: #fff;"
                    href="{{ route('learn.paths.show', [$lib->slug]) }}">
                    <i class="category-icons" aria-hidden="true">
                        @if($lib->slug == "business")
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" width="24" height="24" focusable="false">
                            <path d="M5 19h16v2H4a1 1 0 01-1-1V3h2v16zM20 3.1l-5 3.11 2.17 1.17-2.48 4.52-3.26-1.75a1.2 1.2 0 00-1.62.48l-3.12 5.74 1.65.9 2.78-5.21 3.28 1.79a1.2 1.2 0 001.6-.48l2.76-5.11L21 9.46V3.67a.67.67 0 00-1-.57z"></path>
                        </svg>
                        @elseif($lib->slug == "creative")
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" width="24" height="24" focusable="false">
                            <path d="M21.71 5L19 2.29a1 1 0 00-1.41 0L4 15.85 2 22l6.15-2L21.71 6.45a1 1 0 00.29-.74 1 1 0 00-.29-.71zM6.87 18.64l-1.5-1.5L15.92 6.57l1.5 1.5zM18.09 7.41l-1.5-1.5 1.67-1.67 1.5 1.5zm-11-6l4.38 4.38-1.37 1.3-3.76-3.75-3 3 1.5 1.5 1.5-1.5.71.71-1.5 1.5 1.54 1.55-1.32 1.33-4.38-4.38a1 1 0 010-1.41l4.25-4.25a1 1 0 011.41 0zm15.56 17l-4.24 4.24a1 1 0 01-1.41 0l-4.38-4.38 1.33-1.33 1.55 1.55 1.5-1.5.71.71-1.5 1.5 1.5 1.5 3-3-3.8-3.8 1.33-1.33 4.38 4.38a1 1 0 01-.01 1.41z"></path>
                        </svg>
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" width="24" height="24" focusable="false">
                            <path d="M20 6v12H4V6h16m1-2H3a1 1 0 00-1 1v14a1 1 0 001 1h18a1 1 0 001-1V5a1 1 0 00-1-1zM7.37 16l3.33-3.36a1 1 0 000-1.42L7.46 8 6 9.34l2.54 2.56L6 14.62 7.33 16h.04zM18 14h-6v2h6v-2z"></path>
                        </svg>
                        @endif
                    </i>
                    {{ $lib->title }}
                    <br>
                    <small>{{ $lib->titleEng }}</small>
                    </a>
                @endforeach
                <a class="dropdown-item text-center" style="color: #fff;"
                href="{{ route('learn.paths.index') }}">
                    همه مسیرهای آموزشی
                </a>
                </div>
            </li>
          <li class="nav-item">
            <a class="nav-link px-md-1" href="{{ route('packages.index') }}">خرید اشتراک</a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-md-1" href="{{ route('demands.create') }}">درخواست دوره</a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-md-1" href="{{ route('faq') }}">سوالات متداول</a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-md-1" href="{{ route('root.contact.us') }}">تماس با ما</a>
          </li>
        </ul>
        @if (Auth::check())
          <div class="dropdown">
            <a class="nav-link p-md-0" id="cart-list" data-toggle="dropdown" role="button" aria-expanded="false">
              <img class="justify-content-center" src="{{ asset('smart-cart.png') }}" width="18" height="18">
            </a>
            <div class="dropdown-menu dropdown-cart dropdown-menu-center p-1 text-center" role="menu"
              id="cart-list-item" style="width: 400px!important;color: white;">
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
          <div class="nav-item">
            <a class="nav-link btn btn-outline-primary" href="{{ route('login', ['returnUrl'=>request()->url()]) }}">{{ __('msg.Login') }}</a>
          </div>
          @if (Route::has('register'))
            <div class="nav-item">
              <a class="nav-link btn btn-outline-primary" style="background-color: #008cc9;"
                href="{{ route('register') }}">{{ __('msg.Register') }}</a>
            </div>
          @endif
        @endif
        <form class="form-inline my-2 my-lg-0" role="search" action="{{ route('search') }}">
          <input type="search" name="q" class="form-control mr-sm-2" role="combobox" value="{{ $q ?? '' }}"
            style="font-size: 13px;border: 0;text-align: right; /*padding: 0;*/ padding-right: 5px;min-width: 320px;border-radius: 5px;"
            placeholder="نرم افزار یا مهارتی که میخواهید یاد بگیرید را جستجو کنید">

          {{-- <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">جستجو</button> --}}
        </form>
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
    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"> --}}
    {{-- Launch demo modal --}}
    {{-- </button> --}}
    <!--Footer Start-->
    <style>
        footer ul > li > a, footer p {
            color: #ccc;
        }
        #footer .column img{
          height: 150px;
          width: 100%;
        }
    </style>

    {{-- <footer id="footer" class="bg-dark text-muted p-md-5 pt-4 @if(app()->isLocal('en')) text-left @endif"  @if(app()->isLocal('en')) dir="ltr" @endif> --}}
    <footer id="footer" class="bg-dark text-muted p-md-5 pt-4">
      <div class="container">
        <div class="row">
          <div class="contact col-lg-6 col-md-6 col-sm-12 col-xs-12 text-sm-right text-center">
            <h5 class="pt-1 pb-3" style="color: #00aaca;">درباره ما</h5>
            <p class="text-white pl-md-5 text-justify">
              لینداکده یک بستر یادگیری پیشرو است که به هر کس کمک می کند تا کسب و کار ، نرم افزار ، فناوری و
              مهارت های خلاقانه را برای دستیابی به اهداف شخصی و حرفه ای بیاموزد.
            </p>
            <div class="row">
              <div class="col-12 text-center">
                <ul class="list-inline">
                  <li class="list-inline-item text-white">
                    لینداکده-1400
                  </li>
                  <li class="list-inline-item">
                    <a href="{{ route('root.contact.us') }}" style="color: #00aaca;">تماس با ما</a>
                  </li>
                  <li class="list-inline-item">
                    <a rel="noreferrer" class="social-icon text-xs-center" target="_blank" href="http://www.Instagram.com/lyndakade.ir">
                      <img data-toggle="tooltip" src="#"
                        data-src="{{ asset('image/socialicons/instagram2.png') }}" alt="Instagram - اینستاگرام" title="اینستاگرام"
                        class="icon-instagram lazyload">
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a rel="noreferrer" class="social-icon text-xs-center" target="_blank" href="http://www.T.me/LyndaKadeSupport">
                      <img  data-toggle="tooltip" src="#"
                        data-src="{{ asset('image/socialicons/telegram.png') }}" alt="Telegram - پیشتبانی تلگرام" title="پیشتبانی تلگرام"
                        class="icon-telegram lazyload">
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a rel="noreferrer" class="social-icon text-xs-center" target="_blank" href="http://www.Aparat.com/LyndaKade.ir">
                      <img  data-toggle="tooltip" src="#"
                        data-src="{{ asset('image/socialicons/aparat.png') }}" alt="Aparat - آپارات" title="آپارات"
                        class="icon-aparat lazyload">
                    </a>
                  </li>
                </ul>
              </div>
              <div class="col-12 text-center">
                <p class="my-0 text-white">کلیه‌ی حقوق مادی و معنوی این سایت متعلق به LyndaKade.ir است</p>
              </div>
            </div>
          </div>
          <div class="column col-lg-2 col-md-2 col-sm-4 col-xs-12 text-center my-2 enamad-logo">
            <a referrerpolicy="origin" target="_blank" href="https://trustseal.enamad.ir/?id=212458&amp;Code=PmAs0cswBnOXzNOOqfGD">
              <img  src="#" class="lazyload" referrerpolicy="origin" data-src="https://Trustseal.eNamad.ir/logo.aspx?id=212458&amp;Code=PmAs0cswBnOXzNOOqfGD" alt="نماد الکترونیک enamad در صورت اتصال با آی‌پی داخل کشور، نمایش داده خواهد شد." style="cursor:pointer;" id="PmAs0cswBnOXzNOOqfGD">
            </a>
          </div>
          <div class="column col-lg-2 col-md-2 col-sm-4 col-xs-12 text-center my-2 enamad-logo">
            <img  src="#"  class="lazyload" referrerpolicy='origin' id='nbqejzpeapfujxlzsizpesgt' style='cursor:pointer;' onclick='window.open("https:\/\/logo.samandehi.ir/Verify.aspx?id=275190&p=uiwkjyoedshwrfthpfvlobpd", "Popup","toolbar=no, scrollbars=no, location=no, statusbar=no, menubar=no, resizable=0, width=450, height=630, top=30")' alt='logo-samandehi - لوگو ساماندهی' data-src='https://logo.samandehi.ir/logo.aspx?id=275190&p=odrfyndtujynnbpdbsiylyma' />
          </div>
          <div class="column col-lg-2 col-md-2 col-sm-4 col-xs-12 text-center my-2 zarinpal-logo">
            <script src="https://www.zarinpal.com/webservice/TrustCode" type="text/javascript"></script>
          </div>
        </div>
      </div>
    </footer>
  </div>


  {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/themify-icons.css') }}" /> --}}
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css" />
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
  !function(){var i="Xj7nlW",a=window,d=document;function g(){var g=d.createElement("script"),s="https://www.goftino.com/widget/"+i,l=localStorage.getItem("goftino_"+i);g.async=!0,g.src=l?s+"?o="+l:s;d.getElementsByTagName("head")[0].appendChild(g);}"complete"===d.readyState?g():a.attachEvent?a.attachEvent("onload",g):a.addEventListener("load",g,!1);}();
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
      .zarinpal-logo img{
          max-height: 120px;
      }
      .enamad-logo img{
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
  </script>

  @yield('script_body')
  @stack('js')
  <script>
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
  </script>
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