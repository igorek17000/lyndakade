@php
session(['redirectToAfterLogin' => url()->previous()]);
@endphp
<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
  <meta charset="UTF-8" />
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
  <meta name="google-site-verification" content="TPdR7eAXlaJ5SPRxpwWcQbG7yNX3s-DS3tLUHlOp9RY" />
  @stack('meta.in.head')
  {{-- @include('meta::manager') --}}

  <title>{{ config('app.name', 'لیندا کده') }}</title>

  <link href="{{ asset('image/favicon.ico') }}" rel="icon" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- CSS Part Start-->
  <link rel="stylesheet" type="text/css" href="{{ asset('css/fonts.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('css/icons.css') }}" />

  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('black/img/apple-icon.png') }}">

  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />

  <link href="{{ asset('css/googlefont.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/font-awesome/all.css') }}" rel="stylesheet" />
  {{-- <link href="{{ mix('css/app.css') }}" rel="stylesheet"> --}}
  <link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
  {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/template-stylesheets/stylesheet.css') }}" /> --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.transitions.css') }}" />
  {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/template-stylesheets/stylesheet-skin2.css') }}" /> --}}

  <link rel="stylesheet" type="text/css" href="{{ asset('css/themify-icons.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('css/lyndacon.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('css/my-stylesheet.css') }}" />
  <link rel="manifest" href="/manifest.json">
  <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">

  {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <script src="{{ mix('js/all.js') }}"></script>
  <script async src="{{ asset('js/lazysizes.min.js') }}"></script>
  <script src="{{ asset('js/toastr.min.js') }}"></script>

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
  <div class="wrapper-wide" style="    box-shadow: 0 0 4px rgba(0,0,0,.1);
    background: repeat-x #f7f7f7;
    background-image: -webkit-linear-gradient(top,#f7f7f7 0,#e5e5e5 100%);
    background-image: -o-linear-gradient(top,#f7f7f7 0,#e5e5e5 100%);
    background-image: linear-gradient(to bottom,#f7f7f7 0,#e5e5e5 100%);">

    <div class="fab-container">
      <div class="fab shadow">
        <div class="fab-content">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" style="-ms-transform: rotate(360deg);-webkit-transform: rotate(360deg);transform: rotate(360deg);height: 50px;" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M21 12.22C21 6.73 16.74 3 12 3c-4.69 0-9 3.65-9 9.28c-.6.34-1 .98-1 1.72v2c0 1.1.9 2 2 2h1v-6.1c0-3.87 3.13-7 7-7s7 3.13 7 7V19h-8v2h8c1.1 0 2-.9 2-2v-1.22c.59-.31 1-.92 1-1.64v-2.3c0-.7-.41-1.31-1-1.62z" fill="white"></path><circle cx="9" cy="13" r="1" fill="white"></circle><circle cx="15" cy="13" r="1" fill="white"></circle><path d="M18 11.03A6.04 6.04 0 0 0 12.05 6c-3.03 0-6.29 2.51-6.03 6.45a8.075 8.075 0 0 0 4.86-5.89c1.31 2.63 4 4.44 7.12 4.47z" fill="white"></path></svg>
        </div>
      </div>
      <div class="sub-button shadow" style="background-color: #0d0;">
        <a href="https://wa.me/+989910510634" target="_blank" dideo-checked="true">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" fill="white"></path></svg>
        </a>
      </div>
      <div class="sub-button shadow" style="background-color: #0088cc;">
        <a href="https://t.me/lyndakadeSupport" target="_blank" dideo-checked="true">
          <svg width="32" height="32" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path id="telegram-5" d="M12,0c-6.627,0 -12,5.373 -12,12c0,6.627 5.373,12 12,12c6.627,0 12,-5.373 12,-12c0,-6.627 -5.373,-12 -12,-12Zm0,2c5.514,0 10,4.486 10,10c0,5.514 -4.486,10 -10,10c-5.514,0 -10,-4.486 -10,-10c0,-5.514 4.486,-10 10,-10Zm2.692,14.889c0.161,0.115 0.368,0.143 0.553,0.073c0.185,-0.07 0.322,-0.228 0.362,-0.42c0.435,-2.042 1.489,-7.211 1.884,-9.068c0.03,-0.14 -0.019,-0.285 -0.129,-0.379c-0.11,-0.093 -0.263,-0.12 -0.399,-0.07c-2.096,0.776 -8.553,3.198 -11.192,4.175c-0.168,0.062 -0.277,0.223 -0.271,0.4c0.006,0.177 0.125,0.33 0.296,0.381c1.184,0.354 2.738,0.847 2.738,0.847c0,0 0.725,2.193 1.104,3.308c0.047,0.139 0.157,0.25 0.301,0.287c0.145,0.038 0.298,-0.001 0.406,-0.103c0.608,-0.574 1.548,-1.461 1.548,-1.461c0,0 1.786,1.309 2.799,2.03Zm-5.505,-4.338l0.84,2.769l0.186,-1.754c0,0 3.243,-2.925 5.092,-4.593c0.055,-0.048 0.062,-0.13 0.017,-0.188c-0.045,-0.057 -0.126,-0.071 -0.188,-0.032c-2.143,1.368 -5.947,3.798 -5.947,3.798Z" fill="white"></path></svg>
        </a>
      </div>
      <div class="sub-button shadow" style="background-color: #B23121;">
        <a href="https://lyndakade.ir/contact-us" target="_blank" dideo-checked="true">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path d="M12 2.02c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm0 12.55l-5.992-4.57h11.983l-5.991 4.57zm0 1.288l-6-4.629v6.771h12v-6.771l-6 4.629z" fill="white"></path></svg>
        </a>
      </div>
    </div>

    @include('go-to-top-btn')

    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark w-100 py-0">
      <a class="navbar-brand mb-1" href="https://lyndakade.ir">
        <img draggable="false" class="img-logo m-0 p-0" src="https://lyndakade.ir/image/logoedit2.png" title="لینداکده"
          alt="لینداکده" style="width: 60px; height: 55px;">
        <span class="hidden-md hidden-lg">لیندا کده</span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              کتابخانه
            </a>
            <div class="dropdown-menu dropdown-menu-center" aria-labelledby="navbarDropdownMenuLink">
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
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            مسیرهای آموزشی
            </a>
            <div class="dropdown-menu  dropdown-menu-center" aria-labelledby="navbarDropdownMenuLink">

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
            <a class="nav-link" href="{{ route('demands.create') }}">درخواست دوره</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('root.contact.us') }}">تماس با ما</a>
          </li>
        </ul>
        @if (Auth::check())
          <div class="dropdown">
            <a class="nav-link" id="cart-list" data-toggle="dropdown" role="button" aria-expanded="false">
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
            <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="navbarUser">
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
            <a class="nav-link btn btn-outline-primary" href="{{ route('login') }}">{{ __('msg.Login') }}</a>
          </div>
          @if (Route::has('register'))
            <div class="nav-item">
              <a class="nav-link btn btn-outline-primary" style="background-color: #008cc9;"
                href="{{ route('register') }}">{{ __('msg.Register') }}</a>
            </div>
          @endif
        @endif
        <form class="form-inline my-2 my-lg-0" role="search" action="{{ route('search') }}">
          <input type="search" name="q" class="form-control mr-sm-2" role="combobox" value=""
            style="font-size: 13px;border: 0;text-align: right;padding: 0;padding-right: 5px;min-width: 320px;border-radius: 5px;"
            placeholder="نرم افزار یا مهارتی که میخواهید یاد بگیرید را جستجو کنید" autocomplete="off">

          {{-- <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">جستجو</button> --}}
        </form>
      </div>
    </nav>
    @if (\App\Notification::where('expire', '>=', date(now()))->count() > 0)
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
    @endif

    <main id="app">
      @yield('content')

      <!-- Modal -->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {{-- <div class="video-player" style="padding: 0; margin: 0;"> --}}
              {{-- <video --}}
              {{-- id="preview-player" --}}
              {{-- class="video-js vjs-big-play-centered vjs-16-9" --}}
              {{-- controls --}}
              {{-- preload="auto" --}}
              {{-- poster="{{  }}" --}}
              {{-- data-setup='{ "fluid" : true , "controls": true, "autoplay": false, "preload": "auto", "seek": true  }'> --}}
              {{-- <source type="video/mp4" src="{{  }}"/> --}}

              {{-- <track --}}
              {{-- default --}}
              {{-- kind="captions" --}}
              {{-- srclang="en" --}}
              {{-- label="Persian" --}}
              {{-- src="{{  }}"/> --}}

              {{-- <p class="vjs-no-js"> --}}
              {{-- To view this video please enable JavaScript, and consider upgrading to a --}}
              {{-- web browser that --}}
              {{-- <a href="https://videojs.com/html5-video-support/" target="_blank"> --}}
              {{-- supports HTML5 video --}}
              {{-- </a> --}}
              {{-- </p> --}}
              {{-- </video> --}}
              {{-- </div> --}}
            </div>
            {{-- <div class="modal-footer"> --}}
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
            {{--  --}}{{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            {{-- </div> --}}
          </div>
        </div>
      </div>
    </main>
    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"> --}}
    {{-- Launch demo modal --}}
    {{-- </button> --}}
    <!--Footer Start-->
    <footer id="footer">
      <div class="fpart-first">
        <div class="container">
          <div class="row">
            <div class="contact col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <h5>درباره ما</h5>
              <p>لینداکده یک بستر یادگیری پیشرو است که به هر کس کمک می کند تا کسب و کار ، نرم افزار ، فناوری و
                مهارت های خلاقانه را برای دستیابی به اهداف شخصی و حرفه ای بیاموزد. </p>
            </div>
            <div class="column col-lg-2 col-md-2 col-sm-3 col-xs-12">
            </div>
            <div class="column col-lg-2 col-md-2 col-sm-3 col-xs-12">
            </div>
            <div class="column col-lg-2 col-md-2 col-sm-3 col-xs-12">
              <h5>ارتباطات</h5>
              <ul>
                {{-- <li><a href="#"> </a></li> --}}
                {{-- <li><a href="#"></a></li> --}}
                {{-- <li><a href="#"> </a></li> --}}
                {{-- <li><a href="#"></a></li> --}}
                <li><a href="{{ route('root.contact.us') }}">تماس با ما</a></li>
                <li><a href="{{ route('demands.create') }}">درخواست دوره آموزشی</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="fpart-second">
        <div class="container">
          <div id="powered" class="clearfix">
            <div class="powered_text pull-right flip">
              <p>لینداکده-1400</p>
            </div>
            <div class="social pull-left flip">
              <a rel="noreferrer" href="http://www.Instagram.com/lyndakade.ir" target="_blank"> <img data-toggle="tooltip"
                  src="{{ asset('image/socialicons/instagram2.png') }}" alt="Instagram" title="اینستاگرام"
                  class="icon-instagram"></a>
              {{-- <a rel="noreferrer" href="http://www.T.me/LyndaKade" target="_blank"> <img data-toggle="tooltip"
                  src="{{ asset('image/socialicons/telegram.png') }}" alt="Telegram" title="کانال تلگرام"
                  class="icon-telegram"> </a> --}}
              <a rel="noreferrer" href="http://www.T.me/LyndaKadeSupport" target="_blank"> <img data-toggle="tooltip"
                  src="{{ asset('image/socialicons/telegram.png') }}" alt="Telegram" title="پیشتبانی تلگرام"
                  class="icon-telegram"> </a>
              <a rel="noreferrer" href="http://www.Aparat.com/LyndaKade.ir" target="_blank"> <img data-toggle="tooltip"
                  src="{{ asset('image/socialicons/aparat.png') }}" alt="Aparat" title="آپارات" class="icon-aparat">
              </a>
            </div>
            <div class="bottom-row">
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!--Footer End-->
  </div>

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
  <style>
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
  <script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
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
</body>

</html>