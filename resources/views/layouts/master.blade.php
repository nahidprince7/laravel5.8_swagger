<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.master_header')
    @yield('header')

    <link rel="icon" href="{{url('images/bracnet.ico')}}" type="image/ico"/>
    @include('layouts.master_global_css')
    {{--start global css--}}
    @yield('global_css')
    @yield('local_css')
    @yield('local_style')
    {{--end  global css--}}
    @yield('local_guest_style')


    <style>
        ul.pagination{
            flex-wrap:wrap;
        }
        .x_panel {
            padding: 0 0 0 0;
        }

        .col-md-12, .col-sm-12, .col-xs-12 {
            padding: 0 0 0 0;
        }
        .nav.side-menu > li.current-page, .nav.side-menu > li.active {
            border-right-color: #F19927 !important;
        }
        #nprogress .bar {
            background: #f7ba22 !important;
        }
        #nprogress .spinner-icon {
            border-top-color: #f78e1c !important;
            border-left-color: #f78e1c !important;
        }
        .page-item.active .page-link {
            background-color: #F69320;
            border-color: #F58F17;
        }



    </style>
    <script>
        var APP_URL = '{{url('/')}}';
    </script>
</head>

<body class="nav-md">
<div id="pageloader" class="pageloaderCenter"></div>
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <!-- sidebar menu -->


        @include('partials.sideNavbar')
        @yield('sideNav')
        <!-- /sidebar menu -->
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            @include('partials.topNavbar')
            @yield('topNav')
        </div>
{{--    @include('partials.toolTip')--}}
{{--    @yield('tool-tip')--}}

        <!-- /top navigation -->
        <!-- page content -->
        {{--<div class="right_col" role="main">
            @include('dashboards.dashboard')
        </div>--}}
        {{--<div role="main">--}}
        @yield('content')
        <title>@yield('title') </title>

        {{--</div>--}}
    <!-- /page content -->

        @include('layouts.master_footer')
        {{--start footer--}}

        {{--end footer--}}
    </div>
</div>
@include('layouts.master_global_js')
{{--start global js--}}
@yield('globalJs')
<footer>
    @yield('footer')
    @yield('guestPageJs')
</footer>

{{--end global js--}}
</body>
</html>
