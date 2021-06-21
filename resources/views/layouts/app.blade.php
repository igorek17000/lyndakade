@php
session(['redirectToAfterLogin' => url()->previous()]);
@endphp
<!DOCTYPE html>
<html dir="rtl" lang="fa">
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
{{-- <html dir="rtl" lang="fa"> --}}

<head>
  <meta charset="UTF-8" />
  <meta name="format-detection" content="telephone=no" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <link rel="canonical" href="{{ request()->url() }}" />

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

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'لیندا کده') }}</title>

  <link href="{{ asset('image/favicon.ico') }}" rel="icon" />

  <!-- CSS Part Start-->
  <link rel="stylesheet" type="text/css" href="{{ asset('css/fonts.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('css/icons.css') }}" />


  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('black/img/apple-icon.png') }}">

  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />

  <link href="{{ asset('css/googlefont.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/font-awesome/all.css') }}" rel="stylesheet" />
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
  {{-- <link href="{{ asset('black/css/nucleo-icons.css') }}" rel="stylesheet" /> --}}
  {{-- <link href="{{ asset('black/css/black-dashboard.css') }}?v=1.0.0" rel="stylesheet" /> --}}
  {{-- <link href="{{ asset('black/css/theme.css') }}" rel="stylesheet" /> --}}

  <link rel="stylesheet" type="text/css" href="{{ asset('css/template-stylesheets/stylesheet.css') }}" />

  <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.transitions.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('css/template-stylesheets/stylesheet-skin2.css') }}" />

  <link rel="stylesheet" type="text/css" href="{{ asset('css/themify-icons.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('css/lyndacon.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('css/my-stylesheet.css') }}" />
  <!-- CSS Part End-->
  <link rel="manifest" href="/manifest.json">
  {{-- <link href="{{asset('css/video-js.min.css')}}" rel="stylesheet"/> --}}

  {{-- <link href="{{asset('video-js/video-js.min.css')}}" rel="stylesheet"> --}}
  {{-- <script src="{{asset('video-js/video.min.js')}}"></script> --}}

  <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">

  <script src="{{ mix('js/app.js') }}"></script>
  <script src="{{ mix('js/all.js') }}"></script>
  <script async src="{{ asset('js/lazysizes.min.js') }}"></script>
  <script src="{{ asset('js/toastr.min.js') }}"></script>

  @yield('script_head')
  @stack('css_head')

  @csrf


</head>

<body>
  <div class="wrapper-wide" style="    box-shadow: 0 0 4px rgba(0,0,0,.1);
    background: repeat-x #f7f7f7;
    background-image: -webkit-linear-gradient(top,#f7f7f7 0,#e5e5e5 100%);
    background-image: -o-linear-gradient(top,#f7f7f7 0,#e5e5e5 100%);
    background-image: linear-gradient(to bottom,#f7f7f7 0,#e5e5e5 100%);">

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
                                <a href="{{ route('learn.paths.show', [$library->slug, $path->slug]) }}">
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
                    <a class="nav-link" href="{{ route('login') }}">{{ __('msg.Login') }}</a>
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

    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark w-100 py-0">
      <a class="navbar-brand mb-1" href="https://lyndakade.ir">
        <img draggable="false" class="img-logo m-0 p-0" src="https://lyndakade.ir/image/logoedit2.png" title="لینداکده"
          alt="لینداکده">
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
                <a class="dropdown-item" href="{{ route('home.show', [$library->slug, $library->id]) }}">
                  <i class="lyndacon cat-{{ $library->slug }} category-icons" title="{{ $library->title }}"
                    aria-hidden="true"></i>
                  {{ $library->title }}
                  <br>
                  <small>{{ $library->titleEng }}</small>
                </a>
              @endforeach
            </div>
          </li>
          @if (\App\LearnPath::count() == 0)
            <li class="nav-item">
              <a class="nav-link" href="#" title="به زودی اضافه میشود">
                مسیرهای آموزشی
              </a>
            </li>
          @else
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                مسیرهای آموزشی
              </a>
              <div class="dropdown-menu  dropdown-menu-center" aria-labelledby="navbarDropdownMenuLink">
                @foreach (\App\LearnPath::get() as $path)
                  <a class="dropdown-item" style="color: #fff;"
                    href="{{ route('learn.paths.show', [$path->library->slug, $path->slug]) }}">
                    {{ $path->title }}
                  </a>
                @endforeach
              </div>
            </li>
          @endif
          <li class="nav-item">
            <a class="nav-link" href="#">درخواست دوره</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">تماس با ما</a>
          </li>
        </ul>

        <div class="dropdown">
          <a class="nav-link" id="cart-list" data-toggle="dropdown" role="button" aria-expanded="false">
            <img class="justify-content-center" src="{{ asset('smart-cart.png') }}" width="18" height="18">
          </a>
          <div class="dropdown-menu dropdown-cart dropdown-menu-center p-1 text-center" role="menu" id="cart-list-item"
            style="width: 400px!important;color: white;">
            @include('carts.partials._cart_list')
          </div>
        </div>
        @if (Auth::check())
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
        <form class="form-inline my-2 my-lg-0">
          <input type="search" name="q" class="form-control mr-sm-2" role="combobox" value=""
            style="font-size: 13px;border: 0;text-align: right;padding: 0;padding-right: 5px;min-width: 320px;border-radius: 5px;"
            placeholder="نرم افزار یا مهارتی که میخواهید یاد بگیرید را جستجو کنید" autocomplete="off">

          {{-- <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">جستجو</button> --}}
        </form>
      </div>
    </nav>

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
              {{-- <a rel="noreferrer" href="http://www.Instagram.com/lyndakadeh" target="_blank"> <img data-toggle="tooltip"
                  src="{{ asset('image/socialicons/instagram2.png') }}" alt="Instagram" title="اینستاگرام"
                  class="icon-instagram"></a> --}}
              <a rel="noreferrer" href="http://www.T.me/LyndaKade" target="_blank"> <img data-toggle="tooltip"
                  src="{{ asset('image/socialicons/telegram.png') }}" alt="Telegram" title="کانال تلگرام"
                  class="icon-telegram"> </a>
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
