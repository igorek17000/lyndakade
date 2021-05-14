<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Black Dashboard') }}</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('black/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('black/img/favicon.png') }}">
    <!-- Fonts -->
    {{--    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet"/>--}}
    <link href="{{ asset('css/googlefont.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/font-awesome/all.css') }}" rel="stylesheet"/>
{{--    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">--}}
<!-- Icons -->
    <link href="{{ asset('black/css/nucleo-icons.css') }}" rel="stylesheet"/>
    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/tags-input/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tags-input/app.css') }}">
    <link href="{{ asset('black/css/black-dashboard.css') }}?v=1.0.0" rel="stylesheet"/>
    <link href="{{ asset('black/css/theme.css') }}" rel="stylesheet"/>
    <style>
        .progress {
            position: relative;
            width: 100%;
            height: 22px;
            border: 1px solid #7F98B2;
            padding: 1px;
            border-radius: 3px;
        }

        .bar {
            background-color: #B4F5B4;
            width: 0;
            height: 25px;
            border-radius: 3px;
        }

        .percent {
            position: absolute;
            display: inline-block;
            top: 3px;
            left: 48%;
            color: #7F98B2;
        }

        /* autocomplete tagsinput*/
        .bootstrap-tagsinput {
            background-color: transparent;
            border-color: #2b3553;
            border-radius: 0.4285rem;
            font-size: 0.75rem;
            -webkit-transition: color 0.3s ease-in-out, border-color 0.3s ease-in-out, background-color 0.3s ease-in-out;
            -moz-transition: color 0.3s ease-in-out, border-color 0.3s ease-in-out, background-color 0.3s ease-in-out;
            -o-transition: color 0.3s ease-in-out, border-color 0.3s ease-in-out, background-color 0.3s ease-in-out;
            -ms-transition: color 0.3s ease-in-out, border-color 0.3s ease-in-out, background-color 0.3s ease-in-out;
            transition: color 0.3s ease-in-out, border-color 0.3s ease-in-out, background-color 0.3s ease-in-out;
        }

        .bootstrap-tagsinput input {
            color: #fff;
        }

        .label-info {
            background-color: transparent;
            border: 1px solid #004ba8;
            display: inline-block;
            padding: 0.2em 0.6em 0.3em;
            /*font-size: 75%;*/
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25em;
        }

    </style>
</head>
<body class="{{ $class ?? '' }}">
<div class="wrapper">
    @include('layouts.navbars.sidebar')
    <div class="main-panel">
        @include('layouts.navbars.navbar')
        <div class="content">
            @yield('content')
        </div>
    </div>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<script src="{{ asset('black/js/core/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.form.js') }}"></script>
<script src="{{ asset('black/js/core/popper.min.js') }}"></script>
<script src="{{ asset('black/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('black/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
<script type="text/javascript"
        src="http://maps.google.com/maps/api/js?sensor=false&libraries=places&language=en-US"></script>
<script type="text/javascript" src="{{ asset('js/typeahead.min.js') }}"></script>
<script src="{{ asset('js/typeahead.bundle.js') }}"></script>
<script src="{{ asset('js/bootstrap-tagsinput.min.js') }}"></script>
<!--  Google Maps Plugin    -->
<!-- Place this tag in your head or just before your close body tag. -->
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> --}}
<!-- Chart JS -->
{{-- <script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script> --}}
<!--  Notifications Plugin    -->
<script src="{{ asset('black/js/plugins/bootstrap-notify.js') }}"></script>

<script src="{{ asset('black/js/black-dashboard.min.js') }}?v=1.0.0"></script>
<script src="{{ asset('black/js/theme.js') }}"></script>
{{--<script src="{{ asset('black/js/core/jquery.min.js') }}"></script>--}}

<script>
    $(document).ready(function () {
        $().ready(function () {
            $sidebar = $('.sidebar');
            $navbar = $('.navbar');
            $main_panel = $('.main-panel');

            $full_page = $('.full-page');

            $sidebar_responsive = $('body > .navbar-collapse');
            sidebar_mini_active = true;
            white_color = false;

            window_width = $(window).width();

            fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

            $('.fixed-plugin a').click(function (event) {
                if ($(this).hasClass('switch-trigger')) {
                    if (event.stopPropagation) {
                        event.stopPropagation();
                    } else if (window.event) {
                        window.event.cancelBubble = true;
                    }
                }
            });

            $('.fixed-plugin .background-color span').click(function () {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                var new_color = $(this).data('color');

                if ($sidebar.length !== 0) {
                    $sidebar.attr('data', new_color);
                }

                if ($main_panel.length !== 0) {
                    $main_panel.attr('data', new_color);
                }

                if ($full_page.length !== 0) {
                    $full_page.attr('filter-color', new_color);
                }

                if ($sidebar_responsive.length !== 0) {
                    $sidebar_responsive.attr('data', new_color);
                }
            });

            $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function () {
                var $btn = $(this);

                if (sidebar_mini_active === true) {
                    $('body').removeClass('sidebar-mini');
                    sidebar_mini_active = false;
                    blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
                } else {
                    $('body').addClass('sidebar-mini');
                    sidebar_mini_active = true;
                    blackDashboard.showSidebarMessage('Sidebar mini activated...');
                }

                // we simulate the window Resize so the charts will get updated in realtime.
                var simulateWindowResize = setInterval(function () {
                    window.dispatchEvent(new Event('resize'));
                }, 180);

                // we stop the simulation of Window Resize after the animations are completed
                setTimeout(function () {
                    clearInterval(simulateWindowResize);
                }, 1000);
            });

            $('.switch-change-color input').on("switchChange.bootstrapSwitch", function () {
                var $btn = $(this);

                if (white_color === true) {
                    $('body').addClass('change-background');
                    setTimeout(function () {
                        $('body').removeClass('change-background');
                        $('body').removeClass('white-content');
                    }, 900);
                    white_color = false;
                } else {
                    $('body').addClass('change-background');
                    setTimeout(function () {
                        $('body').removeClass('change-background');
                        $('body').addClass('white-content');
                    }, 900);

                    white_color = true;
                }
            });
            @if(session('success'))
            $.notify(
                {
                    icon: "tim-icons icon-bell-55",
                    message: "{{ session('success') }}"
                }, {
                    type: type[1],
                    timer: 5000,
                    placement: {
                        from: 'bottom',
                        align: 'right'
                    }
                }
            );
            @endif
            @if(session('error'))
            $.notify(
                {
                    icon: "tim-icons icon-bell-55",
                    message: "{{ session('error') }}"
                }, {
                    type: type[4],
                    timer: 5000,
                    placement: {
                        from: 'bottom',
                        align: 'right'
                    }
                }
            );
            @endif
        });
    });
</script>
@stack('js')
<script type="text/javascript" src="{{ asset('js/admin-js.js') }}"></script>
</body>
</html>
