@extends('layouts.master')
@section('local_style')
    <style>
        footer,.nav_menu {
            background-color: rgb(42, 63, 84) !important;
            border-bottom: rgb(42, 63, 84) !important;

        }
    </style>

@endsection
@section('content')
    <!-- page content -->
    <div class="col-md-12">
        <div class="col-middle">
            <div class="text-center text-center">
                <h1 class="error-number">403</h1>
                <h2>{{ empty($exception->getMessage())?'Access Denied':$exception->getMessage() }}</h2>
                <p>You are not authorized to access this page.
                </p>
            </div>
        </div>
    </div>

@endsection
