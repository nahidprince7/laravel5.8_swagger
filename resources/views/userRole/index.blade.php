@extends('layouts.master')
@section('title','Assign Role | ')
@section('master_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('local_css')

    <link href="{{url('vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{url('vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
@endsection
@section('local_style')
    <style>
        .select2-selection--single {
            padding-top: 1px !important;
        }

        .sel2 .parsley-errors-list.filled {
            margin-top: 42px;
            margin-bottom: -60px;
        }

        .sel2 .parsley-errors-list:not(.filled) {
            display: none;
        }

        .sel2 .parsley-errors-list.filled + span.select2 {
            margin-bottom: 30px;
        }

        .sel2 .parsley-errors-list.filled + span.select2 span.select2-selection--single {
            background: #FAEDEC !important;
            border: 1px solid #E85445;
        }
    </style>
@endsection
@section('content')
    <div class="right_col" role="main">

        @section('navbar-title')
            <h3>Assign Roles</h3>
        @endsection
        <div class="page-title">
            <div class="title_left">
                @include('partials.flushMessage')
                @yield("flushError")
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6 ">
                                <div class="x_content">
                                    <form action="{{route('update-userRoles',$userInfo['id'])}}" method="post">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="control-label col-md-4 col-sm-4 ">User</label>
                                            <div class="col-md-8 col-sm-8 ">
                                                <div class="profile_img">
                                                    <div id="crop-avatar">
                                                        <!-- Current avatar -->
                                                        @if(strlen($userInfo['picture']) > 0)
                                                            <img src="{{asset('storage/user-picture/'.
                                                    $userInfo['picture'])}}" width="150px">
                                                        @else
                                                            <img src="{{asset('storage/user-picture/'.
                                                    "profile.png")}}" title="picture missing" alt="picture missing"
                                                                 width="150px">
                                                        @endif
                                                    </div>
                                                </div>
                                                {{$userInfo['name']}}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-md-4 col-sm-4 ">Roles</label>
                                            <div class="col-md-8 col-sm-8 ">
                                                <select id="roles" class="form-control" name="role_ids[]"
                                                        multiple>
                                                    @foreach(ROLES as $k=>$Role)
                                                        @if(in_array($k,$userRoles))
                                                            <option value="{{$k}}" selected>{{$Role}}</option>
                                                        @else
                                                            <option value="{{$k}}">{{$Role}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 offset-md-8">
                                            <button class="btn btn-success left" type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    {{--        <script src="{{url('vendors/parsleyjs/dist/parsley.min.js')}}"></script>--}}
    {{--    <script src="{{url('vendors/validator/validator.js')}}"></script>--}}
    <script src="{{url('vendors/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{url('vendors/iCheck/icheck.min.js')}}"></script>


    <script>
        $("#roles").select2({
            multiple: true,
            placeholder: "Select Roles",
            allowClear: true,
        })
    </script>
@endsection


