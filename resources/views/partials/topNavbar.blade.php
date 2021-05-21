@section('topNav')
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        @php
            $user = Auth::user();
        @endphp
        <nav class="nav navbar-nav">
            <ul class="navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown"
                       data-toggle="dropdown" aria-expanded="false">
                        @php($profilePic = $user->picture)
                        @if(strlen($profilePic) < 1)
                            @php($profilePic = "profile.png")
                        @endif
                        <img src="{{asset('storage/user-picture/'.$profilePic)}}" alt="">
                        {{$user->name}}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('user-detail', Auth::id()) }}">
                            <i class="fa fa-user text-info pull-right"></i>Profile</a>
                        <a class="dropdown-item" href="{{ route('edit-user', Auth::id()) }}">
                            <i class="fa fa-edit text-primary pull-right"></i>Edit Profile
                        </a>
                        <a class="dropdown-item" href="{{url('/')}}">
                            <i class="fa fa-home text-primary pull-right"></i>Home</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out pull-right"></i> {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
@endsection
