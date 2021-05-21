@extends('layouts.master')
@section('title','Users | ')
@section('local_css')
    {{--datatable css--}}
    <link href="{{url('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    @include('partials.flushMessage')
                    @yield("flushError")
                    @yield("flushSuccess")
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <h2>Division List</h2>
                                <button class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <div class="col-md-7 col-sm-12 col-xs-12">
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-responsive"
                                   class="table table-hover table-striped table-bordered dt-responsive">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th><span style="color: darkgray">Division Name</span></th>
                                    <th><span style="color: darkgray">Action</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($divisions) > 0)
                                    @php
                                        $sl= 0;
                                    @endphp
                                    @foreach($divisions as $key=>$division)
                                        <tr>
                                            <td scope="row">{{@++$sl}}</td>
                                            <td scope="row">{{$division->label}}</td>

                                            <td>
                                                <a title="Edit" class="btn btn-sm btn-primary"
                                                   href="#editModal{{$division->id}}" data-toggle="modal">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <a data-trash-id="{{$division->id}}"
                                                   class="btn btn-sm btn-danger trash-record"
                                                   href="">
                                                    <i class="fa fa-trash" title="Soft Delete"></i>
                                                </a>

                                            </td>
                                        </tr>
                                        @include('division.edit-division')
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="trash-form" action="{{url('division/trash')}}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" id="record_id" name="record_id" value="">
    </form>
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
            "paging": true,
            "bLengthChange": false,
            "bPaginate": false,
            // "order": [[ 0,'asc' ]],
            // "bSort" : false,
            // "aaSorting" : [[]],
            "bInfo": true,
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
    @include('division.add-division')

@endsection
