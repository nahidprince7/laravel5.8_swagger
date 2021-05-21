@section('sideNav')

    @php
        $user = Auth::user();
        $roles = $user->role
    @endphp
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{url('/')}}" class="site_title"><i class="fa fa-home"></i> <span>Project Name</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                @php($profilePic = $user->picture)
                @if(strlen($profilePic) < 1)
                    @php($profilePic = "profile.png")
                @endif

                @if(is_file("storage/user-picture/{$profilePic}"))
                    <img src="{{asset('storage/user-picture/'.$profilePic)}}"
                         alt="..." class="img-circle profile_img">
                @else
                    <img src="{{asset('images/'."profile.png")}}"
                         alt="..." class="img-circle profile_img">
                @endif




                {{--<img src="{{url($user->picture,'images/img.jpg')}}" alt="..." class="img-circle profile_img">--}}
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>
                    {{$user->name}}
                </h2>
            </div>
        </div>
        <!-- /menu profile quick info -->
        <br/>
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            @php($pDepartment ='department/')
            @php($pDivision ='division/')
            @php($pDesignation ='designation/')
            @php($pUser ='users/')

            <div class="menu_section">
                <ul class="nav side-menu">

                    <li><a href="{{url('/dashboard')}}"><i class="fa fa-home"></i>Home</a></li>

                    {{--@if(in_array(VERIFIER,$roles))
                        <li><a href="{{url($pVerify)}}"><i class="fa fa-check"></i>Verify</a></li>
                    @endif--}}
                    @if(in_array(ADMIN,$roles))
                        <li><a href="{{url($pUser)}}"><i class="fa fa-users"></i>Users</a></li>
                    @endif
                   
                    @if(in_array(ROLE_GENERAL_SETTINGS,$roles)  || in_array(ADMIN,$roles))
                        <li><a><i class="fa fa-briefcase"></i> General Settings <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{url('/designation')}}">Designations </a></li>
                                <li><a href="{{route('designation-sorting')}}">Sort Designations </a></li>
                                <li><a href="{{url('/division')}}">Divisions </a></li>
                                <li><a href="{{url('/department')}}">Departments </a></li>
                            </ul>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout"
               onclick="event.preventDefault(); document.getElementsByClassName('logout-form')[0].submit();">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>


            <form class="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
        <!-- /menu footer buttons -->
    </div>
@endsection
