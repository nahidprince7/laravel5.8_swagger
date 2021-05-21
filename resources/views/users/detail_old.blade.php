@extends('layouts.master')
@section('title','Users | ')
@section('local_css')
    {{--datatable css--}}
    <link href="{{url('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('local_css')
    <style>
        /*figure {
            display: inline-block;
            text-align: center;
            border: 1px dotted gray;
            margin: 5px; !* adjust as needed *!
        }
        figure img {
            vertical-align: top;
        }
        figure figcaption {
            border: 1px dotted blue;
        }*/
    </style>
@endsection
@section('content')
    <div class="right_col" role="main">
            <div class="title_left">
                @include('partials.flushMessage')
                @yield("flushError")
                @yield("flushSuccess")
            </div>
        <div class="clearfix"></div>
        <div class="row">
                    <div class="x_panel">
                        <div class="x_content" style="padding-left: 20px">
                            <div class="col-md-6 col-sm-12">
                                @php($profilePic = 'storage/user-picture/'.$user['picture'])
                                @if(strlen($user['picture']) < 1)
                                    @php($profilePic = "images/profile.png")
                                @endif
                                <img class="img-responsive avatar-view img-circle" src="{{asset(
                                                    $profilePic)}}" alt="Profile Pic" width="100">
                                <h2>{{$user['name']}} - {{$user['pin']}}</h2>
                            </div>
                            <div class="col-md-3 col-sm-12  profile_left">
                                <h2>Basic Info</h2>

                                <ul class="list-unstyled user_data">
                                    <li>
                                        <b>Gender: </b>
                                        @if(array_key_exists($user['gender'],GENDER))
                                            {!! (GENDER[$user['gender']]) !!}
                                        @endif
                                    </li>
                                    <li>
                                        <b>Religion: </b>
                                        @if(array_key_exists($user['religion'],RELIGIONS))
                                            {!! (RELIGIONS[$user['religion']]) !!}
                                        @endif
                                    </li>

                                    <li>
                                        <i class="fa fa-briefcase user-profile-icon"></i>
                                        @if(array_key_exists($user['designation_id'],$designations))
                                            {!! ($designations[$user['designation_id']]) !!}
                                        @endif
                                    </li>
                                    <li>
                                        <b>Division: </b>
                                        @if(array_key_exists($user['division_id'],$divisions))
                                            {!! ($divisions[$user['division_id']]) !!}
                                        @endif
                                    </li>
                                    <li>
                                        <b>Department: </b>
                                        @if(array_key_exists($user['department_id'],$departments))
                                            {!! ($departments[$user['department_id']]) !!}
                                        @endif
                                    </li>
                                </ul>
                                <!-- end of skills -->
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <h2>Contacts</h2>

                                <ul class="list-unstyled user_data">
                                    <li>
                                        <i class="fa fa-envelope"></i>
                                        {{$user['email']}}
                                    </li>
                                    <?php
                                            $contactList = [];
                                                if (strlen($user['contact_number'])>0){
                                               $contactList = explode(',',$user['contact_number']);
                                                }
                                        foreach ($contactList as $contact){
                                            ?>
                                    <li>
                                        <i class="fa fa-phone"></i>
                                        {{$contact}}<br>
                                    </li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                            </div>

                            <div class="col-md-6 col-sm-12 ">
                                <h2>Access Level:</h2>
                                <ul class="list-unstyled user_data">
                                    @foreach($userRoles as $roler)
                                        @if(isset(ROLES[$roler]))
                                            <li>
                                                <i class="fa fa-unlock-alt text-info"></i>
                                                {{ROLES[$roler]}}
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-6 col-sm-12 ">
                                @if (in_array(ADMIN, Auth::user()->role) || Auth::id() == $user['id'])
                                <a title="Edit" href="{{route('edit-user',$user['id'])}}" class="btn btn-success" style="color: white"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                                @endif
                            </div>

                        </div>
                    </div>
            </div>
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
