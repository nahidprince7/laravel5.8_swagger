@section('global_css')
    <!-- Bootstrap -->
    <link href="{{url('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{url('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{url('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{url('vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">

    <link href="{{url('/build/css/custom.min.css')}}" rel="stylesheet">

    <link href="{{ asset('/css/tool') }}/ace.min.css" rel="stylesheet">
    <link href="{{ asset('/css/tool') }}/ace-ie.min.css" rel="stylesheet">
    <link href="{{ asset('/css/tool') }}/ace-part2.min.css" rel="stylesheet">
    <link href="{{ asset('/css/tool') }}/ace-rtl.min.css" rel="stylesheet">
    <link href="{{ asset('/css/tool') }}/ace-skins.min.css" rel="stylesheet">
    <link href="{{ asset('/css/tool') }}/scroll.css" rel="stylesheet">
    <link href="{{ asset('/css') }}/customJahid.css" rel="stylesheet">


{{--    <link href="{{url('/build/css/page.loader.css')}}" rel="stylesheet">--}}

@endsection
