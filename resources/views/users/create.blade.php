@extends('layouts.master')
@section('title','Add User | ')
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
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <h2>Add User </h2>
                            </div>
                            <div class="col-md-7 col-sm-12 col-xs-12">
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-1 col-sm-12 col-xs-12">
                                <a title="Back to list page" class="nav navbar-right btn btn-info btn-info-custom"
                                   href="{{ route('user-list') }}">
                                    <i class="fa fa-list" style="padding-left: 20px"></i>
                                </a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @include('partials.flushMessage')
                            @yield("flushError")
                            <form id="demo-form2" data-parsley-validate method="post" action="{{url('users/add')}}"
                                  class="form-horizontal form-label-left" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                {{--name--}}
                                {{--<div class="form-group row">
                                    <label class="control-label col-md-3" for="name">Name
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <input id="name" class="form-control" name="name"
                                               placeholder="Name" value="{{old('name')}}" required="required"
                                               type="text">
                                    </div>
                                </div>--}}
                                <div class="form-group row">
                                    @php
                                        $input=array('input_name'=>'name','required'=>true,'placeholder'=>'Name');
                                        $label=array('label_title'=>'Name','label_for'=>$input['input_name'],'label_required'=>true);
                                    @endphp
                                    @form(['formType'=>'label','shared'=>$label])@endform
                                    <div class="col-md-7">
                                        @form(['formType'=>'formInput','shared'=>$input])@endform
                                    </div>
                                    {{--                                    @component('components.form',['formType'=>'label','shared'=>$label])@endcomponent--}}
                                </div>

                                {{--pin--}}
                                <div class="form-group row">
                                    @php
                                        $input=array('input_name'=>'pin','required'=>true,'placeholder'=>'PIN');
                                        $label=array('label_title'=>'PIN','label_for'=>$input['input_name'],'label_required'=>true);
                                    @endphp
                                    @form(['formType'=>'label','shared'=>$label])@endform
                                    <div class="col-md-7">
                                        @form(['formType'=>'formInput','shared'=>$input])@endform
                                    </div>
                                </div>

                                {{--designation--}}
                                <div class="form-group row">
                                    @php
                                        $input=array('input_name'=>'designation_id','required'=>true,'placeholder'=>'Designation','selectOptions'=>$designations->toArray());
                                        $label=array('label_title'=>'Designation','label_for'=>$input['input_name'],'label_required'=>true);
                                    @endphp
                                    @form(['formType'=>'label','shared'=>$label])@endform
                                    <div class="col-md-7">
                                        @form(['formType'=>'formSelect','shared'=>$input])
                                        @slot('defaultOption')
                                            <option value="">Select Designation</option>
                                        @endslot
                                        @endform
                                    </div>
                                </div>

                                {{--division--}}
                                <div class="form-group row">
                                    @php
                                        $input=array('input_name'=>'division_id','required'=>true,'placeholder'=>'Division','selectOptions'=>$divisions->toArray());
                                        $label=array('label_title'=>'Division','label_for'=>$input['input_name'],'label_required'=>true);
                                    @endphp
                                    @form(['formType'=>'label','shared'=>$label])@endform
                                    <div class="col-md-7">
                                        @form(['formType'=>'formSelect','shared'=>$input])
                                        @slot('defaultOption')<option value="">Select Division</option>@endslot
                                        @endform
                                    </div>
                                </div>
                                {{--department--}}
                                <div class="form-group row">
                                    @php
                                        $input=array('input_name'=>'department_id','required'=>true,'placeholder'=>'Division','selectOptions'=>$departments->toArray());
                                        $label=array('label_title'=>'Department','label_for'=>$input['input_name'],'label_required'=>true);
                                    @endphp
                                    @form(['formType'=>'label','shared'=>$label])@endform
                                    <div class="col-md-7">
                                        @form(['formType'=>'formSelect','shared'=>$input])
                                        @slot('defaultOption')
                                            <option value="">Select Department</option>
                                        @endslot
                                        @endform
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3" for="email">Email</label>
                                    <div class="col-md-7">
                                        <input id="email" class="form-control" name="email"
                                               placeholder="Email" value=""
                                               type="email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3" for="email">Joining Date</label>
                                    <div class="col-md-7">
                                        <input  class="form-control" name="joining_date"
                                               placeholder="Joining Date" value=""
                                               type="date">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3" >Job Location</label>
                                    <div class="col-md-7">
                                        <select name="job_location_id"  class="form-control"
                                                required>
                                            <option value="">Select Job Location</option>
                                            @if(count($job_locations) > 0)
                                                @foreach($job_locations as $job_location)
                                                        <option value="{{$job_location->id}}">{{$job_location->title}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                @php
                                    $male = '';
                                    $female = '';
                                    if (old('gender') == MALE){
                                      $male = 'checked';
                                    }elseif(old('gender') == FEMALE){
                                      $female = 'checked';
                                    }
                                @endphp
                                <div class="form-group row">
                                    <label class="control-label col-md-3">Gender</label>
                                    <div class="col-md-7">
                                        <label>
                                            <input class="custom-checkbox" type="radio" name="gender" value="{{MALE}}" required="required" > Male &nbsp;
                                        </label>
                                        <label></label><label></label><label></label><label></label><label></label>
                                        <label>
                                            <input class="custom-checkbox" type="radio" name="gender" value="{{FEMALE}}" required="required"> Female
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3">Roles</label>
                                    <div class="col-md-7 ">
                                        <select id="roles" class="form-control" name="role_ids[]"
                                                multiple>
                                            @foreach(ROLES as $k=>$Role)
                                                    <option value="{{$k}}">{{$Role}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3" for="religion">
                                        Select Religion <span class="required">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <select name="religion" id="religion" class="form-control"
                                                required
                                                value="{{old('religion')}}">
                                            <option value="">Select Religion</option>
                                            @if(count($religions) > 0)
                                                @foreach($religions as $key=>$religion)

                                                    @if (old('religion') == $key)
                                                        <option value="{{$key}}" selected>{{$religion}}</option>
                                                    @else
                                                        <option value="{{$key}}">{{$religion}}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="control-label col-md-3">Password</label>
                                    <div class="col-md-7">
                                        <input id="password" type="password" name="password" class="form-control"
                                               required="required">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password_confirmation"
                                           class="control-label col-md-3">Repeat Password</label>
                                    <div class="col-md-7">
                                        <input id="password_confirmation" type="password" name="password_confirmation"
                                               class="form-control" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3" for="picture">Profile
                                        Picture
                                    </label>
                                    <div class="col-md-7">
                                        <b style="color: #17b9d4;">Format:jpeg/jpg/png
                                            Size:<=1mb</b>
                                        <input type="file" id="picture" name="picture"
                                               value="{{old('picture')}}"

                                               data-parsley-filemaxmegabytes="2" data-parsley-trigger="change"
                                               data-parsley-filemimetypes="image/jpeg, image/png"
                                               onchange="loadFile(event)"
                                               class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <img src=""
                                             alt="preview" class="img-responsive"
                                             style="width: 100px; height: 100px"
                                             id="preview"/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3" for="phone">Mobile</label>
                                    <div class="col-md-7">
                                        <input id="contact_number" class="form-control"
                                               data-validate-length-range="6"
                                               name="contact_number"
                                               value="{{old('contact_number')}}"
                                               placeholder="Mobile" type="number">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-7"></div>
                                    <div class="col-md-3">
                                        <button type="reset" class="btn btn-primary">Reset</button>
                                        <button id="send" type="submit" class="btn btn-success btn-info-custom">Submit</button>
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
        defaultAreaFrormClose = '{{--{{ old('area', '') }}--}}';
        defaultPropertyFrormClose = '{{--{{ old('name', '') }}--}}';

        $(document).ready(function () {
            if (defaultAreaFrormClose == '') {
                $('.area_close_first').slideToggle(400, function () {
                });
            }
            if (defaultPropertyFrormClose == '') {
                $('.property_close_first').slideToggle(400, function () {
                });
            }

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
