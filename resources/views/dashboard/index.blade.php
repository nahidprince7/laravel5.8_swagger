@extends('layouts.master')
@section('title','Home | ')
@section('local_css')

    <style>
        .clearable{
            position: relative;
            display: inline-block;
        }
        .clearable input[type=text]{
            padding-right: 24px;
            width: 100%;
            box-sizing: border-box;
        }
        .clearable__clear{
            display: none;
            position: absolute;
            right:0; top:4px;
            padding: 0 8px;
            font-style: normal;
            font-size: 2.2em;
            user-select: none;
            cursor: pointer;
        }
        .clearable input::-ms-clear {  /* Remove IE default X */
            display: none;
        }
    </style>

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
    </div>
       
@endsection
@section('footer')
    {{--datatable--}}
    <script src="{{url('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{url('vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{url('vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>

@endsection
