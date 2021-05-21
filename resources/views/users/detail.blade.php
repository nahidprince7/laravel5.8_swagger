@extends('layouts.master')
@section('title','Users | ')
@section('local_css')
    {{--datatable css--}}
    <link href="{{url('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{url('css/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{url('css/customProfile.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="{{ asset('/css') }}/customJahid.css" rel="stylesheet">
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
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-md-3">

                                <!-- Profile Image -->
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            @if(is_file('storage/user-picture/'.$user['picture']))
                                                <img class="profile-user-img img-fluid img-circle"
                                                     src="{{asset('storage/user-picture/'.
                           $user['picture'])}}"  alt="User profile picture">
                                            @else
                                                <img class="profile-user-img img-fluid img-circle"
                                                     src="{{asset('images/'."profile.png")}}"  alt="User profile picture">
                                            @endif

                                        </div>

                                        <h3 class="profile-username text-center">{{$user['name']}}</h3>

                                        <p class="text-muted text-center"> @if(array_key_exists($user['designation_id'],$designations))
                                                {!! ($designations[$user['designation_id']]) !!}
                                            @endif</p>

                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <b>Pin Number</b> <a class="float-right">{{$user['pin']}}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Department</b> <a class="float-right"> @if(array_key_exists($user['department_id'],$departments))
                                                        {!! ($departments[$user['department_id']]) !!}
                                                    @endif</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Division</b> <a class="float-right"> @if(array_key_exists($user['division_id'],$divisions))
                                                        {!! ($divisions[$user['division_id']]) !!}
                                                    @endif</a>
                                            </li>
                                        </ul>

                                        {{--                        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>--}}
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->

                                <!-- About Me Box -->
                            {{--                <div class="card card-primary">--}}
                            {{--                    <div class="card-header">--}}
                            {{--                        <h3 class="card-title">About Me</h3>--}}
                            {{--                    </div>--}}
                            {{--                    <!-- /.card-header -->--}}
                            {{--                    <div class="card-body">--}}
                            {{--                        <strong><i class="fas fa-book mr-1"></i> Education</strong>--}}

                            {{--                        <p class="text-muted">--}}
                            {{--                            B.S. in Computer Science from the University of Tennessee at Knoxville--}}
                            {{--                        </p>--}}

                            {{--                        <hr>--}}

                            {{--                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>--}}

                            {{--                        <p class="text-muted">Malibu, California</p>--}}

                            {{--                        <hr>--}}

                            {{--                        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>--}}

                            {{--                        <p class="text-muted">--}}
                            {{--                            UI Design, HTML--}}
                            {{--                        </p>--}}

                            {{--                        <hr>--}}

                            {{--                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>--}}

                            {{--                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum--}}
                            {{--                            enim neque.</p>--}}
                            {{--                    </div>--}}
                            {{--                    <!-- /.card-body -->--}}
                            {{--                </div>--}}
                            <!-- /.card -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-header p-2">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item"><a class="nav-link active" href="#activity"
                                                                    data-toggle="tab">Information</a></li>

                                                                        <li class="nav-item">

    @if (in_array(ADMIN, Auth::user()->role) || Auth::id() == $user['id'])
        <a title="Edit" href="{{route('edit-user',$user['id'])}}" class="nav-link" ><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
    @endif



{{--
                                                                        </li>
                                            {{--                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a>--}}
                                            {{--                            </li>--}}
                                            {{--                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>--}}
                                            {{--                            </li>--}}
                                        </ul>
                                    </div><!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="active tab-pane" id="activity">
                                                <!-- Post -->
                                                <div class="row pad1">
                                                    <div class="col-md-2 col-sm-2">
                                                        <h4><strong>Full Name </strong>
                                                        </h4>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                        <h4>{{$user['name']}}</h4>
                                                    </div>
                                                    <div class="col-md-2 col-sm-2">
                                                        <h4><strong>Pin Number</strong>
                                                        </h4>

                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                        <h4>{{$user['pin']}}</h4>
                                                    </div>
                                                </div>

                                                <div class="row pad1">

                                                    <div class="col-md-2 col-sm-2">
                                                        <h4><strong> Mobile </strong>
                                                        </h4>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                        <h4>
                                                            {{$user['contact_number']}}
                                                        </h4>
                                                    </div>
                                                    <div class="col-md-2 col-sm-2">
                                                        <h4><strong>E-mail</strong>
                                                        </h4>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                        <h4>{{$user['email']}}</h4>
                                                    </div>
                                                </div>

                                                <div class="row pad1">

                                                    <div class="col-md-2 col-sm-2">
                                                        <h4><strong>Gender</strong>
                                                        </h4>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4"><h4>
                                                            @if(array_key_exists($user['gender'],GENDER))
                                                                {!! (GENDER[$user['gender']]) !!}
                                                            @endif
                                                        </h4>

                                                    </div>
                                                    <div class="col-md-2 col-sm-2">
                                                        <h4><strong> Designation </strong>
                                                        </h4>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                        <h4>  @if(array_key_exists($user['designation_id'],$designations))
                                                                {!! ($designations[$user['designation_id']]) !!}
                                                            @endif</h4>
                                                    </div>

                                                </div>

                                                <div class="row pad1">
                                                    <div class="col-md-2 col-sm-2">
                                                        <h4><strong>Department</strong>
                                                        </h4>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                        <h4> @if(array_key_exists($user['department_id'],$departments))
                                                                {!! ($departments[$user['department_id']]) !!}
                                                            @endif
                                                        </h4>
                                                    </div>
                                                    <div class="col-md-2 col-sm-2">
                                                        <h4><strong> Division </strong>
                                                        </h4>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                        <h4> @if(array_key_exists($user['division_id'],$divisions))
                                                                {!! ($divisions[$user['division_id']]) !!}
                                                            @endif</h4>
                                                    </div>
                                                </div>
                                                <div class="row pad1">
                                                    <div class="col-md-2 col-sm-2">
                                                        <h4><strong>Job Location</strong>
                                                        </h4>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                        <h4>
{{--                                                            @foreach($joblocations as $job)--}}
{{--                                                            {{$job}}--}}
{{--                                                            @endforeach--}}


{{--                                                            {{$user['job_location_id']}}--}}


                                                            @if(array_key_exists($user['job_location_id'],$joblocations))
                                                                {!! ($joblocations[$user['job_location_id']]) !!}
                                                            @endif</h4>
                                                    </div>
                                                    <div class="col-md-2 col-sm-2">
                                                        <h4><strong> Joining Date </strong>
                                                        </h4>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                        <h4>{{$user['joining_date']}}</h4>
                                                    </div>
                                                </div>

                                                <div class="row pad1">

                                                    <div class="col-md-2 col-sm-2">
                                                        <h4><strong>Religion</strong>
                                                        </h4>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                       <h4>@if(array_key_exists($user['religion'],RELIGIONS))
                                                               {!! (RELIGIONS[$user['religion']]) !!}
                                                           @endif </h4>
                                                    </div>


                                                </div>


                                            {{--                                <div class="post">--}}
                                            {{--                                    <div class="user-block">--}}
                                            {{--                                        <img class="img-circle img-bordered-sm" src="{{url('img')}}/user1-128x128.jpg"--}}
                                            {{--                                             alt="user image">--}}
                                            {{--                                        <span class="username">--}}
                                            {{--                          <a href="#">Jonathan Burke Jr.</a>--}}
                                            {{--                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>--}}
                                            {{--                        </span>--}}
                                            {{--                                        <span class="description">Shared publicly - 7:30 PM today</span>--}}
                                            {{--                                    </div>--}}
                                            {{--                                    <!-- /.user-block -->--}}
                                            {{--                                    <p>--}}
                                            {{--                                        Lorem ipsum represents a long-held tradition for designers,--}}
                                            {{--                                        typographers and the like. Some people hate it and argue for--}}
                                            {{--                                        its demise, but others ignore the hate as they create awesome--}}
                                            {{--                                        tools to help create filler text for everyone from bacon lovers--}}
                                            {{--                                        to Charlie Sheen fans.--}}
                                            {{--                                    </p>--}}

                                            {{--                                    <p>--}}
                                            {{--                                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i>--}}
                                            {{--                                            Share</a>--}}
                                            {{--                                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i>--}}
                                            {{--                                            Like</a>--}}
                                            {{--                                        <span class="float-right">--}}
                                            {{--                          <a href="#" class="link-black text-sm">--}}
                                            {{--                            <i class="far fa-comments mr-1"></i> Comments (5)--}}
                                            {{--                          </a>--}}
                                            {{--                        </span>--}}
                                            {{--                                    </p>--}}

                                            {{--                                    <input class="form-control form-control-sm" type="text"--}}
                                            {{--                                           placeholder="Type a comment">--}}
                                            {{--                                </div>--}}
                                            {{--                                <!-- /.post -->--}}

                                            {{--                                <!-- Post -->--}}
                                            {{--                                <div class="post clearfix">--}}
                                            {{--                                    <div class="user-block">--}}
                                            {{--                                        <img class="img-circle img-bordered-sm" src="{{url('img')}}/user7-128x128.jpg"--}}
                                            {{--                                             alt="User Image">--}}
                                            {{--                                        <span class="username">--}}
                                            {{--                          <a href="#">Sarah Ross</a>--}}
                                            {{--                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>--}}
                                            {{--                        </span>--}}
                                            {{--                                        <span class="description">Sent you a message - 3 days ago</span>--}}
                                            {{--                                    </div>--}}
                                            {{--                                    <!-- /.user-block -->--}}
                                            {{--                                    <p>--}}
                                            {{--                                        Lorem ipsum represents a long-held tradition for designers,--}}
                                            {{--                                        typographers and the like. Some people hate it and argue for--}}
                                            {{--                                        its demise, but others ignore the hate as they create awesome--}}
                                            {{--                                        tools to help create filler text for everyone from bacon lovers--}}
                                            {{--                                        to Charlie Sheen fans.--}}
                                            {{--                                    </p>--}}

                                            {{--                                    <form class="form-horizontal">--}}
                                            {{--                                        <div class="input-group input-group-sm mb-0">--}}
                                            {{--                                            <input class="form-control form-control-sm" placeholder="Response">--}}
                                            {{--                                            <div class="input-group-append">--}}
                                            {{--                                                <button type="submit" class="btn btn-danger">Send</button>--}}
                                            {{--                                            </div>--}}
                                            {{--                                        </div>--}}
                                            {{--                                    </form>--}}
                                            {{--                                </div>--}}
                                            {{--                                <!-- /.post -->--}}

                                            {{--                                <!-- Post -->--}}
                                            {{--                                <div class="post">--}}
                                            {{--                                    <div class="user-block">--}}
                                            {{--                                        <img class="img-circle img-bordered-sm" src="{{url('img')}}/user6-128x128.jpg"--}}
                                            {{--                                             alt="User Image">--}}
                                            {{--                                        <span class="username">--}}
                                            {{--                          <a href="#">Adam Jones</a>--}}
                                            {{--                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>--}}
                                            {{--                        </span>--}}
                                            {{--                                        <span class="description">Posted 5 photos - 5 days ago</span>--}}
                                            {{--                                    </div>--}}
                                            {{--                                    <!-- /.user-block -->--}}
                                            {{--                                    <div class="row mb-3">--}}
                                            {{--                                        <div class="col-sm-6">--}}
                                            {{--                                            <img class="img-fluid" src="{{url('img')}}/photo1.png" alt="Photo">--}}
                                            {{--                                        </div>--}}
                                            {{--                                        <!-- /.col -->--}}
                                            {{--                                        <div class="col-sm-6">--}}
                                            {{--                                            <div class="row">--}}
                                            {{--                                                <div class="col-sm-6">--}}
                                            {{--                                                    <img class="img-fluid mb-3" src="{{url('img')}}/photo2.png"--}}
                                            {{--                                                         alt="Photo">--}}
                                            {{--                                                    <img class="img-fluid" src="{{url('img')}}/photo3.jpg" alt="Photo">--}}
                                            {{--                                                </div>--}}
                                            {{--                                                <!-- /.col -->--}}
                                            {{--                                                <div class="col-sm-6">--}}
                                            {{--                                                    <img class="img-fluid mb-3" src="{{url('img')}}/photo4.jpg"--}}
                                            {{--                                                         alt="Photo">--}}
                                            {{--                                                    <img class="img-fluid" src="{{url('img')}}/photo1.png" alt="Photo">--}}
                                            {{--                                                </div>--}}
                                            {{--                                                <!-- /.col -->--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <!-- /.row -->--}}
                                            {{--                                        </div>--}}
                                            {{--                                        <!-- /.col -->--}}
                                            {{--                                    </div>--}}
                                            {{--                                    <!-- /.row -->--}}

                                            {{--                                    <p>--}}
                                            {{--                                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i>--}}
                                            {{--                                            Share</a>--}}
                                            {{--                                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i>--}}
                                            {{--                                            Like</a>--}}
                                            {{--                                        <span class="float-right">--}}
                                            {{--                          <a href="#" class="link-black text-sm">--}}
                                            {{--                            <i class="far fa-comments mr-1"></i> Comments (5)--}}
                                            {{--                          </a>--}}
                                            {{--                        </span>--}}
                                            {{--                                    </p>--}}

                                            {{--                                    <input class="form-control form-control-sm" type="text"--}}
                                            {{--                                           placeholder="Type a comment">--}}
                                            {{--                                </div>--}}
                                            <!-- /.post -->


                                            </div>
                                            <!-- /.tab-pane -->
                                        {{--                            <div class="tab-pane" id="timeline">--}}
                                        {{--                                <!-- The timeline -->--}}
                                        {{--                                <div class="timeline timeline-inverse">--}}
                                        {{--                                    <!-- timeline time label -->--}}
                                        {{--                                    <div class="time-label">--}}
                                        {{--                        <span class="bg-danger">--}}
                                        {{--                          10 Feb. 2014--}}
                                        {{--                        </span>--}}
                                        {{--                                    </div>--}}
                                        {{--                                    <!-- /.timeline-label -->--}}
                                        {{--                                    <!-- timeline item -->--}}
                                        {{--                                    <div>--}}
                                        {{--                                        <i class="fas fa-envelope bg-primary"></i>--}}

                                        {{--                                        <div class="timeline-item">--}}
                                        {{--                                            <span class="time"><i class="far fa-clock"></i> 12:05</span>--}}

                                        {{--                                            <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email--}}
                                        {{--                                            </h3>--}}

                                        {{--                                            <div class="timeline-body">--}}
                                        {{--                                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,--}}
                                        {{--                                                weebly ning heekya handango imeem plugg dopplr jibjab, movity--}}
                                        {{--                                                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle--}}
                                        {{--                                                quora plaxo ideeli hulu weebly balihoo...--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="timeline-footer">--}}
                                        {{--                                                <a href="#" class="btn btn-primary btn-sm">Read more</a>--}}
                                        {{--                                                <a href="#" class="btn btn-danger btn-sm">Delete</a>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                    <!-- END timeline item -->--}}
                                        {{--                                    <!-- timeline item -->--}}
                                        {{--                                    <div>--}}
                                        {{--                                        <i class="fas fa-user bg-info"></i>--}}

                                        {{--                                        <div class="timeline-item">--}}
                                        {{--                                            <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>--}}

                                        {{--                                            <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted--}}
                                        {{--                                                your friend request--}}
                                        {{--                                            </h3>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                    <!-- END timeline item -->--}}
                                        {{--                                    <!-- timeline item -->--}}
                                        {{--                                    <div>--}}
                                        {{--                                        <i class="fas fa-comments bg-warning"></i>--}}

                                        {{--                                        <div class="timeline-item">--}}
                                        {{--                                            <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>--}}

                                        {{--                                            <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post--}}
                                        {{--                                            </h3>--}}

                                        {{--                                            <div class="timeline-body">--}}
                                        {{--                                                Take me to your leader!--}}
                                        {{--                                                Switzerland is small and neutral!--}}
                                        {{--                                                We are more like Germany, ambitious and misunderstood!--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="timeline-footer">--}}
                                        {{--                                                <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                    <!-- END timeline item -->--}}
                                        {{--                                    <!-- timeline time label -->--}}
                                        {{--                                    <div class="time-label">--}}
                                        {{--                        <span class="bg-success">--}}
                                        {{--                          3 Jan. 2014--}}
                                        {{--                        </span>--}}
                                        {{--                                    </div>--}}
                                        {{--                                    <!-- /.timeline-label -->--}}
                                        {{--                                    <!-- timeline item -->--}}
                                        {{--                                    <div>--}}
                                        {{--                                        <i class="fas fa-camera bg-purple"></i>--}}

                                        {{--                                        <div class="timeline-item">--}}
                                        {{--                                            <span class="time"><i class="far fa-clock"></i> 2 days ago</span>--}}

                                        {{--                                            <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos--}}
                                        {{--                                            </h3>--}}

                                        {{--                                            <div class="timeline-body">--}}
                                        {{--                                                <img src="http://placehold.it/150x100" alt="...">--}}
                                        {{--                                                <img src="http://placehold.it/150x100" alt="...">--}}
                                        {{--                                                <img src="http://placehold.it/150x100" alt="...">--}}
                                        {{--                                                <img src="http://placehold.it/150x100" alt="...">--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                    <!-- END timeline item -->--}}
                                        {{--                                    <div>--}}
                                        {{--                                        <i class="far fa-clock bg-gray"></i>--}}
                                        {{--                                    </div>--}}
                                        {{--                                </div>--}}
                                        {{--                            </div>--}}
                                        {{--                            <!-- /.tab-pane -->--}}

                                        {{--                            <div class="tab-pane" id="settings">--}}
                                        {{--                                <form class="form-horizontal">--}}
                                        {{--                                    <div class="form-group row">--}}
                                        {{--                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>--}}
                                        {{--                                        <div class="col-sm-10">--}}
                                        {{--                                            <input type="email" class="form-control" id="inputName" placeholder="Name">--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                    <div class="form-group row">--}}
                                        {{--                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>--}}
                                        {{--                                        <div class="col-sm-10">--}}
                                        {{--                                            <input type="email" class="form-control" id="inputEmail"--}}
                                        {{--                                                   placeholder="Email">--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                    <div class="form-group row">--}}
                                        {{--                                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>--}}
                                        {{--                                        <div class="col-sm-10">--}}
                                        {{--                                            <input type="text" class="form-control" id="inputName2" placeholder="Name">--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                    <div class="form-group row">--}}
                                        {{--                                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>--}}
                                        {{--                                        <div class="col-sm-10">--}}
                                        {{--                                            <textarea class="form-control" id="inputExperience"--}}
                                        {{--                                                      placeholder="Experience"></textarea>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                    <div class="form-group row">--}}
                                        {{--                                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>--}}
                                        {{--                                        <div class="col-sm-10">--}}
                                        {{--                                            <input type="text" class="form-control" id="inputSkills"--}}
                                        {{--                                                   placeholder="Skills">--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                    <div class="form-group row">--}}
                                        {{--                                        <div class="offset-sm-2 col-sm-10">--}}
                                        {{--                                            <div class="checkbox">--}}
                                        {{--                                                <label>--}}
                                        {{--                                                    <input type="checkbox"> I agree to the <a href="#">terms and--}}
                                        {{--                                                        conditions</a>--}}
                                        {{--                                                </label>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                    <div class="form-group row">--}}
                                        {{--                                        <div class="offset-sm-2 col-sm-10">--}}
                                        {{--                                            <button type="submit" class="btn btn-danger">Submit</button>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                </form>--}}
                                        {{--                            </div>--}}
                                        <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
                                    </div><!-- /.card-body -->
                                </div>
                                <!-- /.nav-tabs-custom -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->











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
