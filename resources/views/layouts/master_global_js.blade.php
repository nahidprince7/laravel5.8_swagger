@section('globalJs')
    <script src="https://unpkg.com/vue@next"></script>
    <!-- jQuery -->
    <script src="{{url('vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{url('vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{url('vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{url('vendors/nprogress/nprogress.js')}}"></script>

    <script src="{{url('vendors/iCheck/icheck.min.js')}}"></script>

    <script src="{{ asset('/js') }}/ace.min.js"></script>

    <script src="{{ asset('/js') }}/ace-elements.min.js"></script>
    <script src="{{ asset('/js') }}/ace-extra.min.js"></script>



    <!-- Autosize -->
{{--    <script src="{{url('vendors/autosize/dist/autosize.min.js')}}"></script>--}}
    <!-- Custom Theme Scripts -->
    <script src="{{url('build/js/custom.js')}}"></script>

@endsection
