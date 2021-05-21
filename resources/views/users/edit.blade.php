@extends('layouts.master')
@section('title','Edit User | ')
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

        .custom-checkbox:checked::before {
            border-radius: 4px;
            transform: scale(1) translate(-50%,-50%);
        }
        .custom-checkbox::before {
            content: "\2714";
            font-weight: bold;
            width: 18px;
            height: 18px;
            font-size: 18px;
            font-family: WebComponentsIcons,monospace;
            -webkit-transform: scale(0) translate(-50%,-50%);
            -ms-transform: scale(0) translate(-50%,-50%);
            transform: scale(0) translate(-50%,-50%);
            overflow: hidden;
            position: absolute;
            top: 40%;
            left: 50%;
        }
        .custom-checkbox:checked
        {
            border-color: #c5c5c5;
            color: #f35800;
            background-color: #fff;
        }

        .custom-checkbox{
            border-radius: 4px;
            border-color: #c5c5c5;
            color: #f35800;
            background-color: #fff;


            margin: 0;
            padding: 0;
            width: 22px;
            height: 22px;
            line-height: initial;
            border-width: 1px;
            border-style: solid;
            outline: 0;
            box-sizing: border-box;
            display: inline-block;
            vertical-align: middle;
            position: relative;
            -webkit-appearance: none;
        }
    </style>
@endsection
@section('content')
    <div class="right_col" role="main">
        <div class="">

            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <div class="col-md-4 col-sm-12 ">
                                <h2>Edit User</h2>
                            </div>
                            <div class="col-md-7 col-sm-12 ">
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-1 col-sm-12 ">
                                <a title="Back to list page" class="nav navbar-right btn btn-info btn-info-custom"
                                   href="{{ url('/users/') }}">
                                    <i class="fa fa-list" style="padding-left: 20px"></i>
                                </a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="title_left">
                                @include('partials.flushMessage')
                                @yield("flushError")
                            </div>
                            @php
                                $roles = Auth::user()->role
                            @endphp
                            <form id="demo-form2" data-parsley-validate method="post"
                                  action="{{url('users/update/'.$user['id'])}}"
                                  class="form-horizontal form-label-left" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{--name--}}
                                <div class="form-group row">
                                    <label class="control-label col-md-3" for="name">Name
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-7  ">
                                        <input id="name" class="form-control col-md-7" name="name"
                                               placeholder="Name" value="{{$user['name']}}" required="required"
                                               type="text">
                                    </div>
                                </div>

                                {{--pin--}}
                                <div class="form-group row">
                                    <label class="control-label col-md-3" for="pin">PIN
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        @if (in_array(ADMIN, $roles))
                                            <input id="pin" class="form-control col-md-7 " name="pin"
                                                   placeholder="PIN" value="{{$user['pin']}}" required="required"
                                                   type="number">
                                        @else
                                            {{$user['pin']}}
                                        @endif

                                    </div>
                                </div>

                                {{--designation--}}
                                <div class="form-group row">
                                    <label class="control-label col-md-3" for="designation_id">
                                        Designation
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-7  ">
                                        @if (in_array(ADMIN, $roles))
                                            <select name="designation_id" id="designation_id"
                                                    class="form-control col-md-7 "
                                                    required>
                                                <option value="">Select Designation</option>
                                                <?php
                                                //print_r($userRoles);die;
                                                ?>
                                                @if(count($designations) > 0)
                                                    @foreach($designations as $key=>$d)
                                                        @if ($user['designation_id'] == $key)
                                                            <option value="{{$key}}" selected>{{$d}}</option>
                                                        @else
                                                            <option value="{{$key}}">{{$d}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        @else
                                            @isset($designations[$user['designation_id']])
                                                {{$designations[$user['designation_id']] }}
                                            @else
                                                N/A
                                            @endisset
                                        @endif

                                    </div>
                                </div>
                                {{--division--}}
                                <div class="form-group row">
                                    <label class="control-label col-md-3" for="division_id">
                                        Division
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-7  ">
                                        @if (in_array(ADMIN, $roles))
                                            <select name="division_id" id="division_id"
                                                    class="form-control col-md-7 "
                                                    required>
                                                <option value="">Select Division</option>
                                                @if(count($divisions) > 0)
                                                    @foreach($divisions as $key=>$d)

                                                        @if ($user['division_id'] == $key)
                                                            <option value="{{$key}}" selected>{{$d}}</option>
                                                        @else
                                                            <option value="{{$key}}">{{$d}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        @else
                                            @isset($divisions[$user['division_id']])
                                                {{$divisions[$user['division_id']] }}
                                            @else
                                                N/A
                                            @endisset
                                        @endif

                                    </div>
                                </div>
                                {{--department--}}
                                <div class="form-group row">
                                    <label class="control-label col-md-3" for="department_id">
                                        Department
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-7  ">
                                        @if (in_array(ADMIN, $roles))
                                            <select name="department_id" id="department_id"
                                                    class="form-control col-md-7 "
                                                    required>
                                                <option value="">Select Department</option>
                                                @if(count($departments) > 0)
                                                    @foreach($departments as $key=>$d)
                                                        @if ($user['department_id'] == $key)
                                                            <option value="{{$key}}" selected>{{$d}}</option>
                                                        @else
                                                            <option value="{{$key}}">{{$d}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        @else
                                            @isset($departments[$user['department_id']])
                                                {{$departments[$user['department_id']] }}
                                            @else
                                                N/A
                                            @endisset
                                        @endif


                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3" for="email">Email
                                    </label>
                                    <div class="col-md-7">
                                        @if (in_array(ADMIN, $roles))
                                            <input id="email" class="form-control col-md-7" name="email"
                                                   placeholder="Email" value="{{$user['email']}}"
                                                   type="email">
                                        @else
                                            {{$user['email']}}
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3" for="email">Joining Date</label>
                                    <div class="col-md-7">
                                        <input  class="form-control" name="joining_date"
                                                placeholder="Joining Date" value="{{$user['joining_date']}}"
                                                type="date">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3" >Job Location</label>
                                    <div class="col-md-7">
                                        <select name="job_locations_id"  class="form-control"
                                                required>
                                            <option value="">Select Job Location</option>
                                                @foreach($job_locations as $job_location)
                                                    @if($job_location->id == $user['job_location_id'])
                                                    <option value="{{$job_location->id}}" selected>{{$job_location->title}}</option>
                                               @else
                                                    <option value="{{$job_location->id}}">{{$job_location->title}}</option>
                                                @endif
                                                @endforeach
                                        </select>
                                    </div>
                                </div>

                                @php
                                    $male = '';
                                    $female = '';
                                    if ($user['gender'] == MALE){
                                      $male = 'checked';
                                    }elseif($user['gender'] == FEMALE){
                                      $female = 'checked';
                                    }
                                @endphp
                                <div class="form-group row">
                                    <label class="control-label col-md-3">Gender</label>
                                    <div class="col-md-7">
                                        <label>
                                            <input class="custom-checkbox" type="radio" name="gender" value="{{MALE}}" {{$male}} required="required" > Male &nbsp;
                                        </label>
                                        <label></label><label></label><label></label><label></label><label></label>
                                        <label>
                                            <input class="custom-checkbox" type="radio" name="gender" value="{{FEMALE}}" {{$female}} required="required"> Female
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3  " for="religion">
                                        Select Religion <span class="required">*</span>
                                    </label>
                                    <div class="col-md-7  ">
                                        <select name="religion" id="religion" class="form-control col-md-7 "
                                                required
                                                value="{{old('religion')}}">
                                            <option value="">Select Religion</option>
                                            @foreach(RELIGIONS as $key=>$religion)

                                                @if ($user['religion'] == $key)
                                                    <option value="{{$key}}" selected>{{$religion}}</option>
                                                @else
                                                    <option value="{{$key}}">{{$religion}}</option>
                                                @endif
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3  "></div>
                                    <div class="checkbox col-md-7  ">
                                        <label for="">
                                            <input name="is_password_change" type="checkbox"
                                                   id="chkPasswordEdit" class="flat">
                                            Edit Password?
                                        </label>

                                    </div>
                                </div>

                                <div class="form-group row password-group">
                                    <label for="password" class="control-label col-md-3">Password</label>
                                    <div class="col-md-7  ">
                                        <input id="password" type="password" name="password"

                                               class="form-control col-md-7
                                                " required="required">
                                    </div>
                                </div>
                                <div class="form-group row password-group">
                                    <label for="password_confirmation"
                                           class="control-label col-md-3  ">Repeat Password</label>
                                    <div class="col-md-7  ">
                                        <input id="password_confirmation" type="password" name="password_confirmation"

                                               class="form-control col-md-7 " required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3  " for="picture">Profile
                                        Picture
                                    </label>
                                    <div class="col-md-4 col-sm-4 ">
                                        <b style="color: #17b9d4;">Format:jpeg/jpg/png
                                            Size:<=1mb</b>
                                        <input type="file" id="picture" name="picture"
                                               value="{{$user['picture']}}"

                                               data-parsley-filemaxmegabytes="2" data-parsley-trigger="change"
                                               data-parsley-filemimetypes="image/jpeg, image/png"
                                               onchange="loadFile(event)"
                                               class="form-control col-md-7 ">
                                    </div>
                                    <div class="col-md-2 col-sm-4 ">
                                        <img src="{{asset('storage/user-picture/'.
                                                    $user['picture'])}}"
                                             alt="preview" class="img-responsive"
                                             style="width: 100px;"
                                             id="preview"/>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3  " for="phone">Mobile</label>

                                    <div class="col-md-7  ">
                                        <input id="contact_number" class="form-control col-md-7 "
                                               data-validate-length-range="6"
                                               name="contact_number"
                                               value="{{$user['contact_number']}}"
                                               placeholder="Mobile" type="number">
                                    </div>
                                </div>
                                @if (in_array(ADMIN, $roles))
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Roles</label>
                                        <div class="col-md-7">
                                            <select id="roles" class="form-control form-control col-md-7"
                                                    name="role_ids[]"
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
                                @endif
                                <div class="form-group row">
                                    <div class="col-md-8 col-md-offset-3"></div>
                                    <div class="col-md-4 col-md-offset-3">
                                        <button type="reset" class="btn btn-primary">Reset</button>
                                        <button id="send" type="submit" class="btn btn-success btn-info-custom">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <script src="{{url('vendors/parsleyjs/dist/parsley.min.js')}}"></script>
    {{--    <script src="{{url('vendors/validator/validator.js')}}"></script>--}}
    <script src="{{url('vendors/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{url('vendors/iCheck/icheck.min.js')}}"></script>

    <script>
        $(".password-group").hide();
        $(".password-group :input").prop('required', false);
        $(document).ready(function () {
            function icheckPasswordCheck() {
                var selector = $('#chkPasswordEdit');
                selector.on('ifChecked', function () {
                    $(".password-group").show(200);
                    $(".password-group :input").prop('required', true);
                });
                selector.on('ifUnchecked', function () {
                    $(".password-group").hide(200);
                    $(".password-group :input").prop('required', false);
                })
            }

            icheckPasswordCheck();
        });

        var loadFile = function (event) {
            var output = document.getElementById('preview');
            // console.log(output);
            output.src = URL.createObjectURL(event.target.files[0]);
        };
        $("#roles").select2({
            multiple: true,
            placeholder: "Select Roles",
            allowClear: true,
        })
    </script>
@endsection
