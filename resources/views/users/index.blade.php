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

            <div class="title_left">
                @include('partials.flushMessage')
                @yield("flushError")
                @yield("flushSuccess")
            </div>

            <div class="title_right float-right">
                <div class="col-md-12 col-sm-12  form-group pull-right top_search">
                    <form id="" action="{{url('users/')}}" method="get">
                        <div class="input-group">
                            <input type="text" name="searchKey" value="{{$searchKey}}" class="form-control"
                                   placeholder="Search by name/PIN...">
                            <span class="input-group-btn">
                      <button class="btn btn-default" type="submit">Go!</button>
                    </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <h2>User List</h2>
                            </div>
                            <div class="col-md-7 col-sm-12 col-xs-12">
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                            </div>
                            @php
                                $roles = Auth::user()->role
                            @endphp
                            @if (in_array(ADMIN, $roles))
                                <div class="col-md-1 col-sm-12 col-xs-12">
                                    <a title="Add New User" class="nav navbar-right btn btn-info btn-info-custom"
                                       href="{{ route('create-user') }}">
                                        <i class="fa fa-plus" style="padding-left: 20px"></i>
                                    </a>
                                </div>
                            @endif


                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-responsive"
                                   class="table table-hover table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th><span style="color: darkgray">Name</span></th>
                                    <th><span style="color: darkgray">Short Info</span></th>
                                    <th><span style="color: darkgray">Roles</span></th>
                                    <th><span style="color: darkgray">Action</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--                                {{$users->currentPage()}}--}}
                                @if(count($users) > 0)
                                    <?php
                                    $sl = $users->perPage() * ($users->currentPage() - 1)
                                    //$sl = 1
                                    ?>
                                    @foreach($users as $key=>$user)
                                        <?php
                                        $profilePic = $user->picture;
                                        // $sl = $paginator->perPage() * ($paginator->currentPage() - 1)
                                        // $sl = 1
                                        ?>
                                        <tr>
                                            <th scope="row">{{@++$sl}}</th>
                                            <th scope="row">
                                                @if(strlen($profilePic) > 0)
                                                    <img src="{{asset('storage/user-picture/'.
                                                    $profilePic)}}" alt="Missing Photo" width="50px">
                                                @else
                                                    <img src="{{asset('images/'."profile.png")}}" title="picture missing" alt="picture missing"
                                                         width="50px">
                                                @endif
                                                <figcaption>
                                                    <i class="fa fa-user text-success user-profile-icon"></i>
                                                    {{$user->name}}
                                                    <span style="color: green">{{$user->pin}}</span>
                                                </figcaption>
                                            </th>

                                            <td>
                                                <i class="fa fa-briefcase text-success user-profile-icon"></i>
                                                    @isset($designations[$user->designation_id])
                                                        {{$designations[$user->designation_id] }}
                                                    @else
                                                        N/A
                                                    @endisset
                                                    <br>
                                                    <i class="fa fa-hand-o-right text-info user-profile-icon"></i>
                                                    @isset($divisions[$user->division_id])
                                                        {{$divisions[$user->division_id] }}
                                                    @else
                                                        N/A
                                                    @endisset
                                                    <br>
                                                <i class="fa fa-hand-o-right text-info user-profile-icon"></i>
                                                    @isset($departments[$user->department_id])
                                                        {{$departments[$user->department_id] }}
                                                    @else
                                                        N/A
                                                    @endisset
                                            </td>

                                            <td>
                                                    @foreach($user->userRoles as $roler)
                                                       <i class="fa fa-unlock-alt text-info"></i>
                                                    {{isset(ROLES[$roler->role_id])?ROLES[$roler->role_id]:''}}
                                                    <br>
                                                    @endforeach

                                            </td>
                                            <td>
                                                @if (in_array(ADMIN, Auth::user()->role) || Auth::id() == $user->id)
                                                <a title="Edit" class="btn btn-sm btn-primary"
                                                   href="{{ route('edit-user', $user->id) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                @endif
                                                <a title="Detail" class="btn btn-sm btn-info"
                                                   href="{{ route('user-detail', $user->id) }}">
                                                    <i class="fa fa-user"></i>
                                                </a>
                                                @if (in_array(ADMIN, Auth::user()->role))
                                                    <a title="User Authorization" class="btn btn-sm btn-info"
                                                       href="{{ route('assign-userRole',$user->id)}}">
                                                        <i class="fa fa-certificate"></i>
                                                    </a>
                                                    <a
                                                        data-trash-id="{{$user->id}}"
                                                        class="btn btn-sm btn-danger trash-record"
                                                        href="">
                                                        <i class="fa fa-trash" title="Soft Delete"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            <div class="float-right">
                                <div class="col-md-10">
                                    {{$users->links()}}
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-1"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="trash-form" action="{{route('trash-user')}}" method="POST" style="display: none;">
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
