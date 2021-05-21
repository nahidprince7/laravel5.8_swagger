@extends('layouts.master')
@section('title','Users | ')
@section('local_css')

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('css/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{url('css/customProfile.css')}}">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    {{--datatable css--}}
    <link href="{{url('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('local_css')

@endsection
@section('content')
    <div class="right_col" role="main">
        <div class="title_left">
            @include('partials.flushMessage')
            @yield("flushError")
            @yield("flushSuccess")
        </div>
        <div class="clearfix"></div>
        <section class="content">
            <div class="container-fluid">

                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0 text-dark">BRACNet External Links</h1>
                                </div><!-- /.col -->
{{--                                <div class="col-sm-6">--}}
{{--                                    <ol class="breadcrumb float-sm-right">--}}
{{--                                        <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
{{--                                        <li class="breadcrumb-item active">Dashboard v2</li>--}}
{{--                                    </ol>--}}
{{--                                </div><!-- /.col -->--}}
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>



{{--                <div class="row">--}}
{{--                    <div class="col-lg-3 col-6">--}}
{{--                        <!-- small box -->--}}
{{--                        <div class="small-box bg-info">--}}
{{--                            <div class="inner">--}}
{{--                                <h3>150</h3>--}}

{{--                                <p>New Orders</p>--}}
{{--                            </div>--}}
{{--                            <div class="icon">--}}
{{--                                <i class="ion ion-bag"></i>--}}
{{--                            </div>--}}
{{--                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- ./col -->--}}
{{--                    <div class="col-lg-3 col-6">--}}
{{--                        <!-- small box -->--}}
{{--                        <div class="small-box bg-success">--}}
{{--                            <div class="inner">--}}
{{--                                <h3>53<sup style="font-size: 20px">%</sup></h3>--}}

{{--                                <p>Bounce Rate</p>--}}
{{--                            </div>--}}
{{--                            <div class="icon">--}}
{{--                                <i class="ion ion-stats-bars"></i>--}}
{{--                            </div>--}}
{{--                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- ./col -->--}}
{{--                    <div class="col-lg-3 col-6">--}}
{{--                        <!-- small box -->--}}
{{--                        <div class="small-box bg-warning">--}}
{{--                            <div class="inner">--}}
{{--                                <h3>44</h3>--}}

{{--                                <p>User Registrations</p>--}}
{{--                            </div>--}}
{{--                            <div class="icon">--}}
{{--                                <i class="ion ion-person-add"></i>--}}
{{--                            </div>--}}
{{--                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- ./col -->--}}
{{--                    <div class="col-lg-3 col-6">--}}
{{--                        <!-- small box -->--}}
{{--                        <div class="small-box bg-danger">--}}
{{--                            <div class="inner">--}}
{{--                                <h3>65</h3>--}}

{{--                                <p>Unique Visitors</p>--}}
{{--                            </div>--}}
{{--                            <div class="icon">--}}
{{--                                <i class="ion ion-pie-graph"></i>--}}
{{--                            </div>--}}
{{--                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- ./col -->--}}
{{--                </div>--}}
                            <!-- Info boxes -->
                           <div class="row">



                                <div class=" col-sm-6 col-md-3">
                                    <a href="https://tada.bracnet.net/login" target="_blank">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info elevation-1" style="color: black"><i class="fa fa-money"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text" style="color: black" >TA-DA</span>
                                            <span class="info-box-number" style="color: black"><strong>Allowance Management System</strong>


                </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>     </a>
                                    <!-- /.info-box -->
                                </div>

                               <div class=" col-sm-6 col-md-3">
                                   <a href="https://attendance.bracnet.net/login" target="_blank">
                                   <div class="info-box mb-3">
                                       <span class="info-box-icon bg-warning elevation-1" style="color: black"><i class="fas fa-users"></i></span>

                                       <div class="info-box-content">
                                           <span class="info-box-text" style="color: black">AAS</span>
                                           <span class="info-box-number" style="color: black" >Attendance Adjustment System</span>
                                       </div>
                                       <!-- /.info-box-content -->
                                   </div></a>
                                   <!-- /.info-box -->
                               </div>

                                <!-- /.col -->
                                <div class="col-sm-6 col-md-3">
                                    <a href="http://intl.bracnet.net/login" target="_blank">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bar-chart"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text" style="color: black">PMS</span>
                                            <span class="info-box-number" style="color: black">Performance Management System</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div> </a>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->

                                <!-- fix for small devices only -->


                                <div class=" col-sm-6 col-md-3">
                                    <a style="color:black" href="http://wiki.bracnet.net/" target="_blank">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-success elevation-1"><i class="fa fa-wikipedia-w"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">BRACNet Wiki</span>
                                            <span class="info-box-number">Wiki for BRACNet</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    </a>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->

                                <!-- /.col -->
                            </div>











            </div>
        </section>
    </div>
@endsection
@section('footer')
    {{--datatable--}}
    <script src="{{url('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{url('vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{url('vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>

    <script>
        $('#datatable-responsive').DataTable({
            //"bDestroy": true,
            "paging": false,
            "bLengthChange": false,
            "bPaginate": false,
            // "order": [[ 0,'asc' ]],
            // "bSort" : false,
            // "aaSorting" : [[]],
            "bInfo": false,
            "bFilter": false,
            "columnDefs": [
                // {"orderable": false, "targets": 0}
            ]
        });

        function submitTrashForm() {
            $(document).on('click', '.trash-record', function () {
                if (confirm("Are you sure to delete?") == true) {
                    record_id = $(this).attr('data-trash-id');
                    form = $('#trash-form');
                    $("#record_id").val(record_id);
                    $(form).submit()
                }
                return false
            });
        }

        submitTrashForm();
    </script>
@endsection
