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
    <script>
        var APP_URL = '{{url('/')}}';
    </script>
</head>
<body class="nav-md">
<div class="container body">
    {{--<div role="main">--}}

    <div class="col-middle">
        <div class="text-center text-center">
            <h1 class="error-number">404</h1>
            <h2>Sorry but we couldn't find this page</h2>
            <p>This page you are looking for does not exist
            </p>
        </div>
    </div>

</div>
{{--end global js--}}
</body>
</html>

@section('local_style')
    <style>
        footer,.nav_menu {
            background-color: rgb(42, 63, 84) !important;
            border-bottom: rgb(42, 63, 84) !important;

        }
    </style>

@endsection
